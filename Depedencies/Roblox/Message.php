<?php
// ported by meditext
namespace Roblox;

use Roblox\DataAccess\MessageDAL;
use Exception;
use DateTime;

class Message
{
    // those fields are going to be completely be replaced with an enum.
    const FILTER_ALL = 0;
    const FILTER_EXCLUDE_INVITATIONS = 1;
    const FILTER_SYSTEM_MESSAGES = 2;
    const FILTER_UNREAD_EXCLUDE_INVITATIONS = 3;
    const FILTER_ARCHIVED_EXCLUDE_INVITATIONS = 4;
    const FILTER_ARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM = 5;
    const FILTER_UNARCHIVED_EXCLUDE_INVITATIONS = 6;
    const FILTER_UNARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM = 7;
    const FILTER_UNREAD_ARCHIVED_EXCLUDE_INVITATIONS = 8;
    const FILTER_UNREAD_UNARCHIVED_EXCLUDE_INVITATIONS = 9;
    const FILTER_UNREAD_UNARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM = 10;

    private const BUILDERMAN_USER_ID = 156;

    private $entityDAL;
    private static $cache = [];
    private static $useUnreadMessagesCounter = true;
    private static $unreadMessagesCounterVerificationPercentage = 0.1;
    private static $unreadMessagesCounterAutoSyncThreshold = 100;
    
    private static $onMessageCreatedHandlers = [];
    private static $onMessageDeletedHandlers = [];

    public function __construct(MessageDAL $dal = null)
    {
        $this->entityDAL = $dal ?? new MessageDAL();
    }

    public function getId()
    {
        return $this->entityDAL->id;
    }

    public function setId($value)
    {
        $this->entityDAL->id = $value;
    }

    public function getMessageTypeId()
    {
        return $this->entityDAL->messageTypeId;
    }

    public function setMessageTypeId($value)
    {
        $this->entityDAL->messageTypeId = $value;
    }

    public function getSubject()
    {
        return $this->entityDAL->subject;
    }

    public function setSubject($value)
    {
        $length = mb_strlen($value);
        $this->entityDAL->subject = mb_substr($value, 0, min($length, 256));
    }

    public function getBody()
    {
        return $this->entityDAL->body;
    }

    public function setBody($value)
    {
        $this->entityDAL->body = $value;
    }

    public function getAuthorId()
    {
        return $this->entityDAL->authorId;
    }

    public function setAuthorId($value)
    {
        $this->entityDAL->authorId = $value;
    }

    public function getRecipientId()
    {
        return $this->entityDAL->recipientId;
    }

    public function setRecipientId($value)
    {
        $this->entityDAL->recipientId = $value;
    }

    public function getIsSystemMessage()
    {
        return $this->entityDAL->isSystemMessage;
    }

    public function setIsSystemMessage($value)
    {
        $this->entityDAL->isSystemMessage = $value;
    }

    public function getIsBroadcastMessage()
    {
        return $this->entityDAL->isBroadcastMessage;
    }

    public function setIsBroadcastMessage($value)
    {
        $this->entityDAL->isBroadcastMessage = $value;
    }

    public function getIsRead()
    {
        return $this->entityDAL->isRead;
    }

    public function setIsRead($value)
    {
        $this->entityDAL->isRead = $value;
    }

    public function getIsArchived()
    {
        return $this->entityDAL->isArchived;
    }

    public function setIsArchived($value)
    {
        $this->entityDAL->isArchived = $value;
    }

    public function getCreated()
    {
        return $this->entityDAL->created;
    }

    public function getUpdated()
    {
        return $this->entityDAL->updated;
    }

    private function isInteractionTrackable()
    {
        if ($this->getMessageTypeId() != 1) {
            return false;
        }
        if ($this->getIsSystemMessage()) {
            return false;
        }
        if ($this->getIsBroadcastMessage()) {
            return false;
        }
        if ($this->getAuthorId() == self::BUILDERMAN_USER_ID) {
            return false;
        }
        return true;
    }

    private function decrementUnreadMessagesCount()
    {
        if (self::$useUnreadMessagesCounter && $this->getMessageTypeId() == 1) { 
            // TODO: Implement decrementation counter logic with UserCounter
        }
    }

    private function incrementUnreadMessagesCount()
    {
        if (self::$useUnreadMessagesCounter && $this->getMessageTypeId() == 1) {
            // TODO: Implement counter increment logic with UserCounter
        }
    }

    private function trackInteraction()
    {
        if ($this->isInteractionTrackable()) {
            // TODO: Implement interaction tracking
        }
    }

    public function delete()
    {
        if ($this->getId() == 0) {
            throw new Exception("Required value not specified: ID.");
        }

        $isRead = $this->getIsRead();
        $recipientId = $this->getRecipientId();
        $messageId = $this->getId();

        $this->entityDAL->delete();
        self::clearCache($messageId);

        if (!$isRead) {
            $this->decrementUnreadMessagesCount();
        }

        self::triggerMessageDeleted($messageId, $recipientId);
    }

    public function save()
    {
        if ($this->entityDAL === null) {
            throw new Exception("Required object not provided: EntityDAL.");
        }

        if ($this->getId() == 0) {
            $this->entityDAL->created = date('Y-m-d H:i:s');
            $this->entityDAL->updated = $this->entityDAL->created;
            $this->entityDAL->insert();
            self::cacheEntity($this);
        } else {
            $this->entityDAL->updated = date('Y-m-d H:i:s');
            $this->entityDAL->update();
            self::clearCache($this->getId());
        }
    }

    public function send()
    {
        if ($this->getIsSystemMessage() || $this->getIsBroadcastMessage() || $this->getMessageTypeId() == 2) {
            $this->doSaveAsync();
        } elseif ($this->getMessageTypeId() == 1) {
            error_log("SCL method used to send private message: " . $this->getAuthorId());
        } else {
            $this->doSaveAsync();
        }
    }

    private function doSaveAsync()
    {
        // in php, we can't easily do background processing without additional infrastructure (ex: an external phar code)
        // so i made this code that just does it synchronously but catches errors and logs them instead of throwing.
        try {
            $this->save();
            $this->incrementUnreadMessagesCount();
            $this->trackInteraction();
            self::triggerMessageCreated($this->getId(), $this->getRecipientId());
        } catch (Exception $e) {
            error_log("Error saving message: " . $e->getMessage());
        }
    }

    public static function get($id)
    {
        if ($id == 0 || $id === null) {
            return null;
        }

        if (isset(self::$cache[$id])) {
            return self::$cache[$id];
        }

        $dal = MessageDAL::get($id);
        if ($dal === null) {
            return null;
        }

        $message = new Message($dal);
        self::cacheEntity($message);
        return $message;
    }

    public static function multiGet(array $ids)
    {
        if (empty($ids)) {
            return [];
        }

        $messages = [];
        $uncachedIds = [];

        foreach ($ids as $id) {
            if (isset(self::$cache[$id])) {
                $messages[$id] = self::$cache[$id];
            } else {
                $uncachedIds[] = $id;
            }
        }

        if (!empty($uncachedIds)) {
            $dals = MessageDAL::multiGet($uncachedIds);
            foreach ($dals as $dal) {
                $message = new Message($dal);
                self::cacheEntity($message);
                $messages[$dal->id] = $message;
            }
        }

        return array_values($messages);
    }

    public static function getMessages($exclusiveStartId, $maximumRows)
    {
        $ids = MessageDAL::getMessageIDs($exclusiveStartId, $maximumRows);
        return self::multiGet($ids);
    }

    public static function getUserMessageSentPaged($authorId, $startRowIndex, $maximumRows)
    {
        $ids = MessageDAL::getUserMessageIDsSentPaged($authorId, $startRowIndex + 1, $maximumRows);
        return self::multiGet($ids);
    }

    public static function getUserMessagesReceivedPagedAndSorted($recipientId, $filter, $sortExpression, $startRowIndex, $maximumRows) {
        $dalFilter = self::convertFilterToDALFilter($filter);
        $ids = MessageDAL::getUserMessageIDsReceivedPagedAndSorted(
            $recipientId,
            $dalFilter,
            $sortExpression,
            $startRowIndex + 1,
            $maximumRows
        );
        return self::multiGet($ids);
    }

    public static function getTotalNumberOfUserMessagesReceived($recipientId, $filter)
    {
        if ($recipientId == 0) {
            throw new Exception("Required value not specified: RecipientID");
        }

        $dalFilter = self::convertFilterToDALFilter($filter);
        return MessageDAL::getTotalNumberOfUserMessagesReceived($recipientId, $dalFilter);
    }

    public static function getTotalNumberOfMessages($userId)
    {
        return self::getTotalNumberOfUserMessagesReceived($userId, self::FILTER_EXCLUDE_INVITATIONS);
    }

    public static function getTotalNumberOfSentMessages($authorId)
    {
        return MessageDAL::getTotalNumberOfSentUserMessages($authorId);
    }

    public static function getTotalNumberOfUnreadMessages($userId)
    {
        // Simplified, we need to implement Roblox.UserCounter logic.
        return self::getTotalNumberOfUserMessagesReceived($userId, self::FILTER_UNREAD_EXCLUDE_INVITATIONS);
    }

    public static function getTotalNumberOfSystemMessages($userId)
    {
        return self::getTotalNumberOfUserMessagesReceived($userId, self::FILTER_SYSTEM_MESSAGES);
    }

    public static function getTotalNumberOfUnarchivedMessagesExcludingSystem($userId)
    {
        return self::getTotalNumberOfUserMessagesReceived($userId, self::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM);
    }

    public static function getTotalNumberOfArchivedMessagesExcludingSystem($userId)
    {
        return self::getTotalNumberOfUserMessagesReceived($userId, self::FILTER_ARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM);
    }

    public static function getTotalNumberOfUnarchivedMessages($userId)
    {
        return self::getTotalNumberOfUserMessagesReceived($userId, self::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS);
    }

    public static function getTotalNumberOfArchivedMessages($userId)
    {
        return self::getTotalNumberOfUserMessagesReceived($userId, self::FILTER_ARCHIVED_EXCLUDE_INVITATIONS);
    }

    public static function getTotalNumberOfUnreadUnarchivedMessages($userId)
    {
        return self::getTotalNumberOfUserMessagesReceived($userId, self::FILTER_UNREAD_UNARCHIVED_EXCLUDE_INVITATIONS);
    }

    public static function getTotalNumberOfUnreadArchivedMessages($userId)
    {
        return self::getTotalNumberOfUserMessagesReceived($userId, self::FILTER_UNREAD_ARCHIVED_EXCLUDE_INVITATIONS);
    }

    private static function convertFilterToDALFilter($filter)
    {
        switch ($filter) {
            case self::FILTER_ALL:
                return MessageDAL::FILTER_ALL;
            case self::FILTER_EXCLUDE_INVITATIONS:
                return MessageDAL::FILTER_EXCLUDE_INVITATIONS;
            case self::FILTER_UNREAD_EXCLUDE_INVITATIONS:
                return MessageDAL::FILTER_UNREAD_EXCLUDE_INVITATIONS;
            case self::FILTER_ARCHIVED_EXCLUDE_INVITATIONS:
                return MessageDAL::FILTER_ARCHIVED_EXCLUDE_INVITATIONS;
            case self::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS:
                return MessageDAL::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS;
            case self::FILTER_UNREAD_ARCHIVED_EXCLUDE_INVITATIONS:
                return MessageDAL::FILTER_UNREAD_ARCHIVED_EXCLUDE_INVITATIONS;
            case self::FILTER_UNREAD_UNARCHIVED_EXCLUDE_INVITATIONS:
                return MessageDAL::FILTER_UNREAD_UNARCHIVED_EXCLUDE_INVITATIONS;
            case self::FILTER_SYSTEM_MESSAGES:
                return MessageDAL::FILTER_SYSTEM_MESSAGES;
            case self::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM:
                return MessageDAL::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM;
            case self::FILTER_ARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM:
                return MessageDAL::FILTER_ARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM;
            default:
                throw new Exception("Invalid filter: $filter");
        }
    }

    private static function cacheEntity(Message $message)
    {
        self::$cache[$message->getId()] = $message;
    }

    private static function clearCache($id)
    {
        unset(self::$cache[$id]);
    }

    public static function addMessageCreatedHandler(callable $handler)
    {
        self::$onMessageCreatedHandlers[] = $handler;
    }

    public static function addMessageDeletedHandler(callable $handler)
    {
        self::$onMessageDeletedHandlers[] = $handler;
    }

    private static function triggerMessageCreated($messageId, $recipientId)
    {
        foreach (self::$onMessageCreatedHandlers as $handler) {
            call_user_func($handler, $messageId, $recipientId);
        }
    }

    private static function triggerMessageDeleted($messageId, $recipientId)
    {
        foreach (self::$onMessageDeletedHandlers as $handler) {
            call_user_func($handler, $messageId, $recipientId);
        }
    }

    public function getSerializable()
    {
        return $this->entityDAL;
    }
}