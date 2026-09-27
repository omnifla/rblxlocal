<?php
namespace Roblox\Agents\Entities;

use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use RuntimeException;

class Agent
{
    private AgentDAL $_EntityDAL;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?AgentDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new AgentDAL();
    }

    public function getID(): int
    {
        return $this->_EntityDAL->ID;
    }

    public function getAgentTypeID(): int
    {
        return $this->_EntityDAL->AgentTypeID;
    }

    public function setAgentTypeID(int $value): void
    {
        $this->_EntityDAL->AgentTypeID = $value;
    }

    public function getAgentTargetID(): int
    {
        return $this->_EntityDAL->AgentTargetID;
    }

    public function setAgentTargetID(int $value): void
    {
        $this->_EntityDAL->AgentTargetID = $value;
    }

    public function getCreated()
    {
        return $this->_EntityDAL->Created;
    }

    public function getCacheInfo(): CacheInfo
    {
        return self::$EntityCacheInfo;
    }

    public static function get(int $id): ?self
    {
        $dal = AgentDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getByAgentTypeIdAndAgentTargetId(int $agentTypeId, int $agentTargetId): ?self
    {
        $dal = AgentDAL::getByAgentTypeIdAndAgentTargetId($agentTypeId, $agentTargetId);
        return $dal ? new self($dal) : null;
    }

    public static function mustGet(int $id): self
    {
        return self::get($id)
            ?? throw new RuntimeException("Could not retrieve Agent with ID=$id.");
    }

    public function buildEntityIDLookups(): array
    {
        return ['AgentTypeID:' . $this->getAgentTypeID() . '_AgentTargetID:' . $this->getAgentTargetID()];
    }

    public function buildStateTokenCollection(): array
    {
        return [];
    }

    public function construct(AgentDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function getSerializable(): AgentDAL
    {
        return $this->_EntityDAL;
    }

    public function __get(string $name)
    {
        return match ($name) {
            'ID' => $this->getID(),
            'AgentTypeID' => $this->getAgentTypeID(),
            'AgentTargetID' => $this->getAgentTargetID(),
            'Created' => $this->getCreated(),
            default => throw new \OutOfBoundsException("Unknown Agent property: $name"),
        };
    }

    public function __set(string $name, mixed $value): void
    {
        switch ($name) {
            case 'AgentTypeID':
                $this->setAgentTypeID((int) $value);
                return;
            case 'AgentTargetID':
                $this->setAgentTargetID((int) $value);
                return;
            default:
                throw new \OutOfBoundsException("Agent property is read-only or unknown: $name");
        }
    }
}

Agent::$EntityCacheInfo = new CacheInfo(
    new CacheabilitySettings(
        collectionsAreCacheable: false,
        countsAreCacheable: false,
        entityIsCacheable: true,
        idLookupsAreCacheable: true,
        hasUnqualifiedCollections: false
    ),
    'Roblox.Agent',
    isNullCacheable: true
);
