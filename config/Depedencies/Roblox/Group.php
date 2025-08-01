<?php
namespace Roblox\Platform\Groups;

use Roblox\Group as GroupEntity;
use Roblox\Platform\Membership\IUser;
use Roblox\Platform\Groups\Events\GroupEventType;
use Roblox\Platform\Groups\GroupManagement;
use Roblox\Enums\GroupActionType;

class Group implements IGroup
{
    private ?bool $isLocked = null;
    
    public int $id;
    public int $agentId;
    public ?int $ownerUserId;
    public ?int $previousOwnerUserId;
    public string $name;
    public int $emblemId;
    public bool $publicEntryAllowed;
    public bool $bcOnly;
    public bool $hasClan;
    public \DateTime $created;
    public \DateTime $updated;
    public string $description;

    private GroupDomainFactories $domainFactories;

    public function __construct(
        IGroupEntity $groupEntity,
        bool $hasClan,
        GroupDomainFactories $domainFactories
    ) {
        $this->id = $groupEntity->Id;
        $this->agentId = $groupEntity->AgentId;
        $this->ownerUserId = $groupEntity->OwnerUserId;
        $this->previousOwnerUserId = $groupEntity->PreviousOwnerUserId;
        $this->name = $groupEntity->Name;
        $this->emblemId = $groupEntity->EmblemId;
        $this->created = $groupEntity->Created;
        $this->updated = $groupEntity->Updated;
        $this->description = $groupEntity->Description;
        $this->publicEntryAllowed = $groupEntity->PublicEntryAllowed;
        $this->bcOnly = $groupEntity->BCOnly;
        $this->hasClan = $hasClan;
        $this->domainFactories = $domainFactories;
    }

    public function isLocked(): bool
    {
        if ($this->isLocked === null) {
            $db = GroupEntity::get($this->id);
            $this->isLocked = $db ? $db->isLocked() : false;
        }
        return $this->isLocked;
    }

    public function unlock(IUser $user): void
    {
        $db = GroupEntity::get($this->id);
        if ($db) {
            $db->unlock();
            GroupManagement::logGroupAction(
                Settings::get('RobloxUserId'),
                $this->id,
                GroupActionType::Lock()->getID(),
                ['InitiatorId' => $user->getId()]
            );
            $this->isLocked = $db->isLocked();
        }
        $this->domainFactories->getGroupEventPublisher()
            ->publish($this->id, GroupEventType::Updated(), null);
    }

    public function lock(IUser $user): void
    {
        $db = GroupEntity::get($this->id);
        if ($db) {
            $db->lock();
            GroupManagement::logGroupAction(
                Settings::get('RobloxUserId'),
                $this->id,
                GroupActionType::Lock()->getID(),
                ['InitiatorId' => $user->getId()]
            );
            $this->isLocked = $db->isLocked();
        }
        $this->domainFactories->getGroupEventPublisher()
            ->publish($this->id, GroupEventType::Updated(), null);
    }

    public function getGroupRoleSetByUser(IUser $user)
    {
        $entity = $this->domainFactories->getGroupRoleSetEntityFactory()
                       ->getByGroupIdAndUserId($this->id, $user?->getId());
        return $this->domainFactories->getGroupRoleSetAccessorInternal()
                    ->getByEntity($entity);
    }
}
