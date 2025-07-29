<?php
// im gonna say it here but idfk what feedtypedal is, if meditext ever sees this please explain to me what this is because i ported this for no reason
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

namespace Roblox.DataAccess;

class FeedTypeDAL
{
    public int $ID = 0;
    public string $FeedType = '';
    public int $Lifetime = 0;
    public bool $Enabled = false;

    private PDO $db;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    public function update(): void
    {
        if ($this->ID === 0) {
            throw new Exception('Required value not specified: ID');
        }
        if (trim($this->FeedType) === '') {
            throw new Exception('Required value not specified: FeedType');
        }

        $stmt = $this->db->prepare("UPDATE feed_types SET feed_type = :FeedType, lifetime = :Lifetime, enabled = :Enabled WHERE id = :ID");
        $stmt->execute([':ID' => $this->ID, ':FeedType' => $this->FeedType, ':Lifetime' => $this->Lifetime,':Enabled' => $this->Enabled,]);
    }

    public static function get(string $feedType): ?FeedTypeDAL
    {
        if (trim($feedType) === '') {
            return null;
        }

        global $conn;
        $stmt = $conn->prepare("SELECT * FROM feed_types WHERE feed_type = :FeedType LIMIT 1");
        $stmt->execute([':FeedType' => $feedType]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $obj = new FeedTypeDAL();
        $obj->ID = (int)$row['id'];
        $obj->FeedType = $row['feed_type'];
        $obj->Lifetime = (int)$row['lifetime'];
        $obj->Enabled = (bool)$row['enabled'];
        return $obj;
    }
}
