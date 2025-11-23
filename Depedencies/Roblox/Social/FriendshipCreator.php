<?php
namespace Roblox\Social;

use Roblox\ApiClientBase\IFriendsClient;
use Roblox\Friends\Client\FriendsClientException;
use Roblox\Core\FriendshipOperationException;
use Roblox\Core\FriendshipOperationErrorType;
use Roblox\Core\FriendshipOperationUnavailableException;
use Roblox\Membership\IUserFactory;
use Roblox\Permissions\Core\IPermissionsChecker;
use Roblox\PolicyLookup\IUserPolicyLookup;
use Roblox\UserBlock\Core\IUserBlockAuthority;
use Roblox\RequestContext\IRequestContextLoader;
use Roblox\Sentinels\CircuitBreakerException;
use Roblox\ApiClientBase\ApiClientException;
use DateTime;
use Exception;

class FriendshipCreator extends FriendshipProducerBase implements IFriendshipCreator
{
    private const SEND_FRIEND_REQUEST_ACTION_TYPE = 'SendFriendRequest';

    private IPermissionsChecker $permissionsChecker;
    private IUserFactory $userFactory;
    private IRequestContextLoader $requestContextLoader;
    private IUserPolicyLookup $userPolicyLookup;

    /** @var FriendRequestSent|null */
    public $onFriendRequestSent = null;

    public function __construct(
        IFriendsClient $client,
        IUserBlockAuthority $userBlockAuthority,
        IPermissionsChecker $permissionsChecker,
        IUserFactory $userFactory,
        IRequestContextLoader $requestContextLoader,
        IUserPolicyLookup $userPolicyLookup
    ) {
        parent::__construct($client, $userBlockAuthority);

        $this->permissionsChecker = $permissionsChecker;
        $this->userFactory = $userFactory;
        $this->requestContextLoader = $requestContextLoader;
        $this->userPolicyLookup = $userPolicyLookup;
    }

    public function sendFriendRequest(
        int $userId,
        int $recipientId,
        AntiAbuseFlags $antiAbuseFlags,
        string $message = '',
        int $friendshipOriginSourceType = 0
    ): void {
        if ($userId <= 0 || $recipientId <= 0) {
            throw new FriendshipOperationException(
                FriendshipOperationErrorType::InvalidParameters,
                "Invalid parameters passed to SendFriendRequest. UserId:$userId, RecipientId:$recipientId"
            );
        }

        $user = $this->userFactory->getUser($userId);
        $recipientUser = $this->userFactory->getUser($recipientId);

        if (!$user || !$recipientUser) {
            throw new FriendshipOperationException(
                FriendshipOperationErrorType::InvalidParameters,
                "Invalid parameters passed to SendFriendRequest. UserId:$userId, RecipientId:$recipientId"
            );
        }

        if ($this->blockExistsBetweenUsers($user, $recipientUser)) {
            throw new FriendshipOperationException(
                FriendshipOperationErrorType::BlockedUser,
                'Block exists between the two users.'
            );
        }

        $friendsErrorType = $antiAbuseFlags->checkIfSendFriendRequestIsAllowed();
        if ($friendsErrorType !== null) {
            switch ($friendsErrorType) {
                case FriendshipOperationErrorType::UsersAreNotInSameGame:
                    throw new FriendshipOperationException($friendsErrorType, 'Users are not in the same game');
                case FriendshipOperationErrorType::UserHasNotPassedCaptcha:
                    throw new FriendshipOperationException($friendsErrorType, 'Friendship requestor has not passed Captcha');
            }
        }

        $this->verifySendFriendRequestPoliciesAndPermissions($userId, $recipientId);

        try {
            $this->client->sendFriendRequest($userId, $recipientId, $message, $friendshipOriginSourceType);

            if (Settings::get('FriendshipSendEventEnabled') && $this->onFriendRequestSent instanceof FriendRequestSent) {
                ($this->onFriendRequestSent)(
                    $userId,
                    $recipientId,
                    $antiAbuseFlags->isRecipientInSameGameAsUser(),
                    $antiAbuseFlags->isUserInApp()
                );
            }
        } catch (FriendsClientException $e) {
            throw new FriendshipOperationException($e->getErrorMetaData());
        } catch (ApiClientException $e) {
            throw new FriendshipOperationUnavailableException('Friends Service Unavailable', $e);
        } catch (CircuitBreakerException $e) {
            throw new FriendshipOperationUnavailableException('Friends Service Unavailable', $e);
        }
    }

    private function verifySendFriendRequestPoliciesAndPermissions(int $userId, int $recipientId): void
    {
        try {
            if (Settings::get('ShouldUseRequestContextToCheckSendFriendRequestPermission')) {
                $currentContext = $this->requestContextLoader->getCurrentContext();
                $targetUserPolicies = $this->userPolicyLookup->getApplicablePoliciesForTargetUser($currentContext, $recipientId);

                if ($currentContext->getApplicablePolicies()->contains(Policy::CommercialChina)) {
                    if (!$targetUserPolicies->contains(Policy::CommercialChina)) {
                        throw new FriendshipOperationException(
                            FriendshipOperationErrorType::PolicyCheckUnsuccessful,
                            "SendFriendRequest not permitted from userId $userId to userId $recipientId due to policy violation."
                        );
                    }
                } elseif ($targetUserPolicies->contains(Policy::CommercialChina)) {
                    throw new FriendshipOperationException(
                        FriendshipOperationErrorType::PolicyCheckUnsuccessful,
                        "SendFriendRequest not permitted from userId $userId to userId $recipientId due to policy violation."
                    );
                }
            }

            if (Settings::get('IsPermissionsCheckForSendFriendRequestEnabled')) {
                $permissionsStatus = $this->permissionsChecker->checkPermissions(self::SEND_FRIEND_REQUEST_ACTION_TYPE, [
                    'subjectUserId' => $userId,
                    'targetUserId'  => $recipientId
                ]);

                if (!$permissionsStatus->wasTested() || !$permissionsStatus->isSuccess()) {
                    throw new FriendshipOperationException(
                        FriendshipOperationErrorType::PermissionsCheckUnsuccessful,
                        "SendFriendRequest not permitted from userId $userId to userId $recipientId; Permissions Service returned $permissionsStatus"
                    );
                }
            }
        } catch (\InvalidArgumentException $e) {
            throw new FriendshipOperationException(
                FriendshipOperationErrorType::PermissionsCheckUnsuccessful,
                "Exception verifying SendFriendRequest permissions from userId $userId to userId $recipientId: {$e->getMessage()}"
            );
        }
    }
}
