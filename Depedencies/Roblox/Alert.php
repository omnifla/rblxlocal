<?php
// ported and written by SkylerClock
namespace Roblox;

use Roblox\DataAccess\AlertDAL;
use Roblox\Authentication;
use Roblox\Enums\AlertVisibilityType;

class Alert
{
    private AlertDAL $entityDAL;

    public function __construct()
    {
        $this->entityDAL = new AlertDAL();
    }

    public function getID(): int
    {
        return $this->entityDAL->ID;
    }

    public function getUserID(): int
    {
        return $this->entityDAL->UserID;
    }

    public function setUserID(int $userID): void
    {
        $this->entityDAL->UserID = $userID;
    }

    public function getText(): string
    {
        return $this->entityDAL->Text;
    }

    public function setText(string $text): void
    {
        $this->entityDAL->Text = $text;
    }

    public function getCreated(): \DateTime
    {
        return $this->entityDAL->Created;
    }

    public function setCreated(\DateTime $dt): void
    {
        $this->entityDAL->Created = $dt;
    }

    public function getUpdated(): \DateTime
    {
        return $this->entityDAL->Updated;
    }

    public function setUpdated(\DateTime $dt): void
    {
        $this->entityDAL->Updated = $dt;
    }

    public function getVisibilityTypeID(): int
    {
        return $this->entityDAL->VisibilityTypeID;
    }

    public function setVisibilityTypeID(int $id): void
    {
        $this->entityDAL->VisibilityTypeID = $id;
    }

    public function save(): void
    {
        if ($this->entityDAL->ID === 0) {
            $now = new \DateTime();
            $this->entityDAL->Created = $now;
            $this->entityDAL->Updated = $now;
            $this->entityDAL->insert();
        } else {
            $this->entityDAL->Updated = new \DateTime();
            $this->entityDAL->update();
        }
    }

    public static function createNew(int $userID, string $text, AlertVisibilityType $visibilityType): self
    {
        $alert = new self();
        $alert->setUserID($userID);
        $alert->setText($text);
        $alert->setVisibilityTypeID($visibilityType->id);
        $alert->save();
        return $alert;
    }

    public static function get(int $id): ?self
    {
        $dal = AlertDAL::get($id);
        if (!$dal) return null;

        $alert = new self();
        $alert->construct($dal);
        return $alert;
    }

    public static function getMostRecentAlertsPaged(int $start, int $limit): array
    {
        $ids = AlertDAL::getMostRecentIDsPaged($start, $limit);
        $alerts = [];
        foreach ($ids as $id) {
            $alert = self::get($id);
            if ($alert) {
                $alerts[] = $alert;
            }
        }
        return $alerts;
    }

    public static function getLast(): ?self
    {
        $alerts = self::getMostRecentAlertsPaged(0, 1);
        return $alerts[0] ?? null;
    }

    public function construct(AlertDAL $dal): void
    {
        $this->entityDAL = $dal;
    }
}
