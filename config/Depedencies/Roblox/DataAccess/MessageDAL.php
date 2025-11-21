<?php
// ported by meditext
namespace Roblox\DataAccess;

use Exception;

class MessageDAL
{
    const FILTER_ALL = 0;
    const FILTER_EXCLUDE_INVITATIONS = 1;
    const FILTER_SYSTEM_MESSAGES = 2;
    const FILTER_UNREAD_EXCLUDE_INVITATIONS = 3;
    const FILTER_ARCHIVED_EXCLUDE_INVITATIONS = 4;
    const FILTER_UNARCHIVED_EXCLUDE_INVITATIONS = 5;
    const FILTER_UNREAD_ARCHIVED_EXCLUDE_INVITATIONS = 6;
    const FILTER_UNREAD_UNARCHIVED_EXCLUDE_INVITATIONS = 7;
    const FILTER_UNARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM = 8;
    const FILTER_ARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM = 9;

    public $id;
    public $messageTypeId;
    public $subject;
    public $body;
    public $authorId;
    public $recipientId;
    public $isSystemMessage;
    public $isBroadcastMessage;
    public $isRead;
    public $isArchived;
    public $created;
    public $updated;

    private static $pdo = null;

    public function __construct()
    {
        $this->id = 0;
        $this->messageTypeId = 0;
        $this->subject = '';
        $this->body = '';
        $this->authorId = 0;
        $this->recipientId = 0;
        $this->isSystemMessage = false;
        $this->isBroadcastMessage = false;
        $this->isRead = false;
        $this->isArchived = false;
        $this->created = null;
        $this->updated = null;
    }

    private static function getConnection()
    {
        global $conn;
        return $conn;
    }

    public function delete()
    {
        if ($this->id == 0) {
            throw new Exception("Required value not specified: ID.");
        }

        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT messages_v2_delete_message_v2_by_id(:p_id)");
        $stmt->execute(['p_id' => $this->id]);
    }

    public function insert()
    {
        if ($this->messageTypeId == 0) {
            throw new Exception("Required value not specified: MessageTypeID.");
        }
        if ($this->created === null) {
            throw new Exception("Required value not specified: Created.");
        }
        if ($this->updated === null) {
            throw new Exception("Required value not specified: Updated.");
        }

        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT messages_v2_insert_message_v2(:p_message_type_id, :p_subject, :p_body, :p_author_id, :p_recipient_id, :p_is_system_message, :p_is_broadcast_message, :p_is_read, :p_is_archived, :p_created, :p_updated)");

        $stmt->execute([
            'p_message_type_id' => $this->messageTypeId,
            'p_subject' => trim($this->subject) !== '' ? $this->subject : null,
            'p_body' => trim($this->body) !== '' ? $this->body : null,
            'p_author_id' => $this->authorId > 0 ? $this->authorId : null,
            'p_recipient_id' => $this->recipientId > 0 ? $this->recipientId : null,
            'p_is_system_message' => $this->isSystemMessage,
            'p_is_broadcast_message' => $this->isBroadcastMessage,
            'p_is_read' => $this->isRead,
            'p_is_archived' => $this->isArchived,
            'p_created' => $this->created,
            'p_updated' => $this->updated
        ]);

        $result = $stmt->fetch();
        $this->id = $result['messages_v2_insert_message_v2'];
    }

    public function update()
    {
        if ($this->id == 0) {
            throw new Exception("Required value not specified: ID.");
        }
        if ($this->messageTypeId == 0) {
            throw new Exception("Required value not specified: MessageTypeID.");
        }
        if ($this->created === null) {
            throw new Exception("Required value not specified: Created.");
        }
        if ($this->updated === null) {
            throw new Exception("Required value not specified: Updated.");
        }

        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT messages_v2_update_message_v2_by_id(:p_id, :p_message_type_id, :p_subject, :p_body, :p_author_id, :p_recipient_id, :p_is_system_message, :p_is_broadcast_message, :p_is_read, :p_is_archived, :p_created, :p_updated)");

        $stmt->execute([
            'p_id' => $this->id,
            'p_message_type_id' => $this->messageTypeId,
            'p_subject' => trim($this->subject) !== '' ? $this->subject : null,
            'p_body' => trim($this->body) !== '' ? $this->body : null,
            'p_author_id' => $this->authorId > 0 ? $this->authorId : null,
            'p_recipient_id' => $this->recipientId > 0 ? $this->recipientId : null,
            'p_is_system_message' => $this->isSystemMessage,
            'p_is_broadcast_message' => $this->isBroadcastMessage,
            'p_is_read' => $this->isRead,
            'p_is_archived' => $this->isArchived,
            'p_created' => $this->created,
            'p_updated' => $this->updated
        ]);
    }

    private static function buildDALFromRow($row)
    {
        $dal = new MessageDAL();
        $dal->id = $row['id'];
        $dal->messageTypeId = $row['message_type_id'];
        $dal->subject = $row['subject'] ?? '';
        $dal->body = $row['body'] ?? '';
        $dal->authorId = $row['author_id'] ?? 0;
        $dal->recipientId = $row['recipient_id'] ?? 0;
        $dal->isSystemMessage = $row['is_system_message'];
        $dal->isBroadcastMessage = $row['is_broadcast_message'];
        $dal->isRead = $row['is_read'];
        $dal->isArchived = $row['is_archived'];
        $dal->created = $row['created'];
        $dal->updated = $row['updated'];
        return $dal;
    }

    public static function multiGet(array $ids)
    {
        if (empty($ids)) {
            return [];
        }

        $pdo = self::getConnection();
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $pdo->prepare("SELECT * FROM messages_v2_get_messages_v2_by_ids(ARRAY[$placeholders]::BIGINT[])");
        $stmt->execute($ids);

        $dals = [];
        while ($row = $stmt->fetch()) {
            $dals[] = self::buildDALFromRow($row);
        }
        return $dals;
    }

    public static function get($id)
    {
        if ($id == 0) {
            return null;
        }

        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM messages_v2_get_message_v2_by_id(:p_id)");
        $stmt->execute(['p_id' => $id]);

        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        return self::buildDALFromRow($row);
    }

    public static function getUserMessageIDsReceivedPagedAndSorted($recipientId, $filter, $sortExpression, $startRowIndex, $maximumRows) {
        $functionName = self::getFunctionNameForFilter($filter);
        
        $pdo = self::getConnection();
        
        if (self::shouldPassSortExpression($filter)) {
            $stmt = $pdo->prepare("SELECT * FROM $functionName(
                :p_recipient_id,
                :p_start_row_index,
                :p_maximum_rows,
                :p_sort_expression
            )");
            $stmt->execute([
                'p_recipient_id' => $recipientId,
                'p_start_row_index' => $startRowIndex,
                'p_maximum_rows' => $maximumRows,
                'p_sort_expression' => trim($sortExpression) !== '' ? $sortExpression : null
            ]);
        } else {
            $stmt = $pdo->prepare("SELECT * FROM $functionName(
                :p_recipient_id,
                :p_start_row_index,
                :p_maximum_rows
            )");
            $stmt->execute([
                'p_recipient_id' => $recipientId,
                'p_start_row_index' => $startRowIndex,
                'p_maximum_rows' => $maximumRows
            ]);
        }

        $ids = [];
        while ($row = $stmt->fetch()) {
            $ids[] = $row['id'];
        }
        return $ids;
    }

    private static function getFunctionNameForFilter($filter)
    {
        switch ($filter) {
            case self::FILTER_ALL:
                return 'messages_v2_get_message_v2_ids_by_recipient_id_paged_and_sorted';
            case self::FILTER_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted';
            case self::FILTER_UNREAD_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_unread_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted';
            case self::FILTER_ARCHIVED_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_archived_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted';
            case self::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_unarchived_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted';
            case self::FILTER_UNREAD_ARCHIVED_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_unread_archived_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted';
            case self::FILTER_UNREAD_UNARCHIVED_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_unread_unarchived_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted';
            case self::FILTER_SYSTEM_MESSAGES:
                return 'messages_v2_get_system_messages_v2_by_recipient_id_paged';
            case self::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM:
                return 'messages_v2_get_unarchived_messages_v2_excluding_invitations_and_system_by_recipient_id_paged';
            case self::FILTER_ARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM:
                return 'messages_v2_get_archived_message_v2_ids_excluding_invitations_and_system_by_recipient_id_paged';
            default:
                throw new Exception("Invalid filter: $filter");
        }
    }

    private static function shouldPassSortExpression($filter)
    {
        return !in_array($filter, [
            self::FILTER_SYSTEM_MESSAGES,
            self::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM,
            self::FILTER_ARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM
        ]);
    }

    public static function getTotalNumberOfSentUserMessages($authorId)
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT messages_v2_get_total_number_of_sent_messages_v2_excluding_invitations_by_author_id(:p_author_id)");
        $stmt->execute(['p_author_id' => $authorId]);
        $result = $stmt->fetch();
        return (int)$result['messages_v2_get_total_number_of_sent_messages_v2_excluding_invitations_by_author_id'];
    }

    public static function getUserMessageIDsSentPaged($authorId, $startRowIndex, $maximumRows)
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM messages_v2_get_message_v2_ids_excluding_invitations_by_author_id_paged(
            :p_author_id,
            :p_start_row_index,
            :p_maximum_rows
        )");
        $stmt->execute([
            'p_author_id' => $authorId,
            'p_start_row_index' => $startRowIndex,
            'p_maximum_rows' => $maximumRows
        ]);

        $ids = [];
        while ($row = $stmt->fetch()) {
            $ids[] = $row['id'];
        }
        return $ids;
    }

    public static function getTotalNumberOfUserMessagesReceived($recipientId, $filter)
    {
        $functionName = self::getCountFunctionNameForFilter($filter);
        
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT $functionName(:p_recipient_id)");
        $stmt->execute(['p_recipient_id' => $recipientId]);
        $result = $stmt->fetch();
        return (int)$result[$functionName];
    }

    private static function getCountFunctionNameForFilter($filter)
    {
        switch ($filter) {
            case self::FILTER_ALL:
                return 'messages_v2_get_total_number_of_messages_v2_by_recipient_id';
            case self::FILTER_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_total_number_of_messages_v2_excluding_invitations_by_recipient_id';
            case self::FILTER_UNREAD_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_total_number_of_unread_messages_v2_excluding_invitations_by_recipient_id';
            case self::FILTER_ARCHIVED_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_total_number_of_archived_messages_v2_excluding_invitations_by_recipient_id';
            case self::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_total_number_of_unarchived_messages_v2_excluding_invitations_by_recipient_id';
            case self::FILTER_UNREAD_ARCHIVED_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_total_number_of_unread_archived_messages_v2_excluding_invitations_by_recipient_id';
            case self::FILTER_UNREAD_UNARCHIVED_EXCLUDE_INVITATIONS:
                return 'messages_v2_get_total_number_of_unread_unarchived_messages_v2_excluding_invitations_by_recipient_id';
            case self::FILTER_UNARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM:
                return 'messages_v2_get_total_number_of_unarchived_messages_v2_excluding_invitations_and_system_by_recipient_id';
            case self::FILTER_ARCHIVED_EXCLUDE_INVITATIONS_AND_SYSTEM:
                return 'messages_v2_get_total_number_of_archived_messages_v2_excluding_invitations_and_system_by_recipient_id';
            case self::FILTER_SYSTEM_MESSAGES:
                return 'messages_v2_get_total_number_of_system_messages_v2_by_recipient_id';
            default:
                throw new Exception("Invalid filter: $filter");
        }
    }

    public static function getMessageIDs($exclusiveStartRow, $batchSize)
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM messages_v2_get_message_v2_ids(:p_exclusive_start_id, :p_maximum_rows)");
        $stmt->execute([
            'p_exclusive_start_id' => $exclusiveStartRow,
            'p_maximum_rows' => $batchSize
        ]);

        $ids = [];
        while ($row = $stmt->fetch()) {
            $ids[] = $row['id'];
        }
        return $ids;
    }
}