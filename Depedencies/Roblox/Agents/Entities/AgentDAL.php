<?php
namespace Roblox\Agents\Entities;

use Exception;
use PDO;
use Roblox\Agents\AgentType;

class AgentDAL
{
    public int $ID = 0;
    public int $AgentTypeID = 0;
    public int $AgentTargetID = 0;
    public string $Created = '';
    public ?string $Updated = null;

    private static function buildFromRow(array $row, int $id, int $agentTypeId, int $agentTargetId): self
    {
        $dal = new self();
        $dal->ID = $id;
        $dal->AgentTypeID = $agentTypeId;
        $dal->AgentTargetID = $agentTargetId;
        $dal->Created = $row['created'] ?? '';
        $dal->Updated = $row['updated'] ?? null;
        return $dal;
    }

    public static function get(int $id): ?self
    {
        global $conn;
        if ($id === 0) {
            throw new Exception('Required value not specified: ID.');
        }

        $stmt = $conn->prepare('SELECT id, created, updated FROM groups WHERE agent_id = :agent_id LIMIT 1');
        $stmt->execute([':agent_id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return self::buildFromRow($row, $id, AgentType::Group->value, (int) $row['id']);
        }

        $stmt = $conn->prepare('SELECT id, created, updated FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        $userId = (int) $row['id'];
        return self::buildFromRow($row, $userId, AgentType::User->value, $userId);
    }

    public static function getByAgentTypeIdAndAgentTargetId(int $agentTypeId, int $agentTargetId): ?self
    {
        global $conn;
        if ($agentTypeId === 0) {
            throw new Exception('Required value not specified: AgentTypeID.');
        }
        if ($agentTargetId === 0) {
            throw new Exception('Required value not specified: AgentTargetID.');
        }

        if ($agentTypeId === AgentType::User->value) {
            $stmt = $conn->prepare('SELECT id, created, updated FROM users WHERE id = :id LIMIT 1');
            $stmt->execute([':id' => $agentTargetId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                return null;
            }

            $userId = (int) $row['id'];
            return self::buildFromRow($row, $userId, AgentType::User->value, $userId);
        }

        if ($agentTypeId === AgentType::Group->value) {
            $stmt = $conn->prepare('SELECT id, agent_id, created, updated FROM groups WHERE id = :id LIMIT 1');
            $stmt->execute([':id' => $agentTargetId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                return null;
            }

            $agentId = $row['agent_id'] !== null ? (int) $row['agent_id'] : (int) $row['id'];
            return self::buildFromRow($row, $agentId, AgentType::Group->value, (int) $row['id']);
        }

        return null;
    }
}
