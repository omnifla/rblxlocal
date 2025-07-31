<?php
// written and ported by SkylerClock
namespace Roblox;

use Roblox\DataAccess\GroupDAL;
use Roblox\Helpers\EntityHelper;
use Roblox\Enums\CreatorType;
use DateTime;
use Exception;

class Group
{
    private GroupDAL $entityDAL;

    public function __construct(?GroupDAL $dal = null)
    {
        $this->entityDAL = $dal ?? new GroupDAL();
    }

    public function getID(): int
    {
        return $this->entityDAL->ID;
    }

    public function getName(): string
    {
        return $this->entityDAL->Name;
    }

    public function setName(string $name): void
    {
        $this->entityDAL->Name = $name;
    }

    public function getCreatorType(): int
    {
        return CreatorType::Group;
    }

    public function getAgentID(): ?int
    {
        return $this->entityDAL->AgentID;
    }

    public function setAgentID(?int $id): void
    {
        $this->entityDAL->AgentID = $id;
    }

    public function getOwnerUserID(): ?int
    {
        return $this->entityDAL->OwnerUserID;
    }

    public function setOwnerUserID(?int $id): void
    {
        $this->entityDAL->OwnerUserID = $id;
    }

    public function getPreviousOwnerUserID(): int
    {
        return $this->entityDAL->PreviousOwnerUserID;
    }

    public function setPreviousOwnerUserID(int $id): void
    {
        $this->entityDAL->PreviousOwnerUserID = $id;
    }

    public function getDescription(): string
    {
        return $this->entityDAL->Description;
    }

    public function setDescription(string $desc): void
    {
        $this->entityDAL->Description = $desc;
    }

    public function getEmblemID(): int
    {
        return $this->entityDAL->EmblemID;
    }

    public function setEmblemID(int $id): void
    {
        $this->entityDAL->EmblemID = $id;
    }

    public function isPublicEntryAllowed(): bool
    {
        return $this->entityDAL->PublicEntryAllowed;
    }

    public function setPublicEntryAllowed(bool $val): void
    {
        $this->entityDAL->PublicEntryAllowed = $val;
    }

    public function isBCOnlyJoin(): bool
    {
        return $this->entityDAL->BCOnlyJoin;
    }

    public function setBCOnlyJoin(bool $val): void
    {
        $this->entityDAL->BCOnlyJoin = $val;
    }

    public function isLocked(): bool
    {
        return $this->entityDAL->IsLocked;
    }

    public function setLocked(bool $val): void
    {
        $this->entityDAL->IsLocked = $val;
    }

    public function getCreated(): DateTime
    {
        return $this->entityDAL->Created;
    }

    public function getUpdated(): DateTime
    {
        return $this->entityDAL->Updated;
    }

    public function lock(): void
    {
        $this->setLocked(true);
        $this->save();
    }

    public function unlock(): void
    {
        $this->setLocked(false);
        $this->save();
    }

    public function save(): void
    {
        EntityHelper::saveEntity($this, function () {
            $now = new DateTime();
            $this->entityDAL->Created = $now;
            $this->entityDAL->Updated = $now;
            $this->entityDAL->insert();
        }, function () {
            $this->entityDAL->Updated = new DateTime();
            $this->entityDAL->update();
        });
    }

    public function delete(): void
    {
        EntityHelper::deleteEntity($this, fn () => $this->entityDAL->delete());
    }

    public static function createNew(int $ownerId, string $name, string $desc, int $emblemId, bool $publicJoin, bool $bcOnly): Group
    {
        $group = new Group();
        $group->setOwnerUserID($ownerId);
        $group->setPreviousOwnerUserID($ownerId);
        $group->setName($name);
        $group->setDescription($desc);
        $group->setEmblemID($emblemId);
        $group->setPublicEntryAllowed($publicJoin);
        $group->setBCOnlyJoin($bcOnly);
        $group->setLocked(false);
        $group->save();

        try {
            $agentId = User::getOrCreateGroupAgentId($group->getID());
            $group->setAgentID($agentId);
            $group->save();
        } catch (Exception $e) {
            $group->delete();
            throw $e;
        }

        return $group;
    }

    public static function get(int $id): ?Group
    {
        $dal = GroupDAL::get($id);
        return $dal ? new Group($dal) : null;
    }

    public static function getByName(string $name): ?Group
    {
        $dal = GroupDAL::getByName($name);
        return $dal ? new Group($dal) : null;
    }

    public function construct(GroupDAL $dal): void
    {
        $this->entityDAL = $dal;
    }
}
