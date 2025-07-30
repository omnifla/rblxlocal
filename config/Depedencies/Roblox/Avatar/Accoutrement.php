<?php
namespace Roblox\Avatar;

class Accoutrement {
    private AccoutrementDAL $dal;

    public function __construct(?AccoutrementDAL $dal = null) {
        $this->dal = $dal ?? new AccoutrementDAL();
    }

    public function save(): void {
        if ($this->dal->id === 0) {
            $this->dal->insert();
        } else {
            $this->dal->update();
        }
    }

    public function delete(): void {
        $this->dal->delete();
    }

    public static function createNew(int $user_id, int $user_asset_id): Accoutrement {
        $accoutrement = new Accoutrement();
        $accoutrement->dal->user_id = $user_id;
        $accoutrement->dal->user_asset_id = $user_asset_id;
        $accoutrement->dal->created = date('Y-m-d H:i:s');
        $accoutrement->save();
        return $accoutrement;
    }

    public static function get(int $id): ?Accoutrement {
        $dal = AccoutrementDAL::get($id);
        return $dal ? new Accoutrement($dal) : null;
    }

    public static function getByUserAssetID(int $user_asset_id): ?Accoutrement {
        $dal = AccoutrementDAL::getByUserAssetID($user_asset_id);
        return $dal ? new Accoutrement($dal) : null;
    }

    public static function getUserAccoutrements(int $user_id): array {
        $ids = AccoutrementDAL::getUserAccoutrementIDs($user_id);
        return array_map(fn($id) => self::get($id), $ids);
    }
}
