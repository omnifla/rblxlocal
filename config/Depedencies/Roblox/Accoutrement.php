<?php
// ported by meditext
namespace Roblox;
use Roblox\AccoutrementDAL;
use Roblox\UserAvatar;
use Exception;

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
        UserAvatar::getOrCreate($this->getUser())->appearanceChanged();
    }

    public function getUser(): User {
        return User::mustGet($this->dal->user_id);
    }

    public function getUserAsset(): UserAsset {
        return UserAsset::mustGet($this->dal->user_asset_id);
    }

    public static function createNew(UserAsset $userAsset): Accoutrement {
        $accoutrement = new Accoutrement();
        $accoutrement->dal->user_id = $userAsset->user_id;
        $accoutrement->dal->user_asset_id = $userAsset->id;
        $accoutrement->dal->created = date('Y-m-d H:i:s');
        $accoutrement->save();
        return $accoutrement;
    }

    public static function get(int $id): ?Accoutrement {
        $dal = AccoutrementDAL::get($id);
        return $dal ? new Accoutrement($dal) : null;
    }

    public static function getByUserAssetID(int $userAssetId): ?Accoutrement {
        $dal = AccoutrementDAL::getByUserAssetID($userAssetId);
        return $dal ? new Accoutrement($dal) : null;
    }

    public static function getUserAccoutrements(int $userId): array {
        $ids = AccoutrementDAL::getUserAccoutrementIDs($userId);
        $accoutrements = array_map(fn($id) => self::get($id), $ids);
        return self::filterUserAccoutrements($accoutrements);
    }

    private static function filterUserAccoutrements(array $userAccoutrements): array {
        $assetTypesWorn = [];
        $filteredAccoutrements = [];

        foreach ($userAccoutrements as $accoutrement) {
            try {
                $userAsset = $accoutrement->getUserAsset();
            } catch (Exception $e) {
                $accoutrement->delete();
                continue;
            }

            if ($userAsset->isExpired()) {
                $accoutrement->delete();
                continue;
            }

            $assetTypeId = $userAsset->asset_type_id;
            $count = $assetTypesWorn[$assetTypeId] ?? 0;

            if (($count < 1) || ($assetTypeId === AssetType::HAT_ID && $count < 3)) {
                $assetTypesWorn[$assetTypeId] = $count + 1;
                $filteredAccoutrements[] = $accoutrement;
            } else {
                $accoutrement->delete();
            }
        }

        return $filteredAccoutrements;
    }

    public static function wear(UserAsset $userAsset): void {
        $userId = $userAsset->user_id;

        if ($userId !== $userAsset->user_id) {
            throw new Exception("User $userId is not the owner of UserAsset {$userAsset->id}.");
        }

        $assetTypeId = $userAsset->asset_type_id;
        if (!self::isValidAssetType($assetTypeId)) {
            throw new Exception("Invalid AssetTypeID: $assetTypeId.");
        }

        $currentlyWornAccoutrements = self::getUserAccoutrements($userId);
        $currentlyWornOfType = array_filter($currentlyWornAccoutrements, fn($a) => $a->getUserAsset()->asset_type_id === $assetTypeId);

        if (count($currentlyWornOfType) >= ($assetTypeId === AssetType::HAT_ID ? 3 : 1)) {
            foreach ($currentlyWornOfType as $accoutrement) {
                $accoutrement->delete();
            }
        }

        self::createNew($userAsset);
    }

    public static function isValidAssetType(int $assetTypeId): bool {
        $validAssetTypes = [
            AssetType::HEAD_ID,
            AssetType::FACE_ID,
            AssetType::GEAR_ID,
            AssetType::HAT_ID,
            AssetType::TEE_SHIRT_ID,
            AssetType::SHIRT_ID,
            AssetType::PANTS_ID,
            AssetType::PACKAGE_ID,
        ];

        if (Settings::TORSO_ASSET_TYPE_ENABLED) {
            $validAssetTypes[] = AssetType::TORSO_ID;
        }

        if (Settings::INDIVIDUAL_ARMS_ASSET_TYPE_ENABLED) {
            $validAssetTypes[] = AssetType::RIGHT_ARM_ID;
            $validAssetTypes[] = AssetType::LEFT_ARM_ID;
        }

        if (Settings::INDIVIDUAL_LEGS_ASSET_TYPE_ENABLED) {
            $validAssetTypes[] = AssetType::RIGHT_LEG_ID;
            $validAssetTypes[] = AssetType::LEFT_LEG_ID;
        }

        return in_array($assetTypeId, $validAssetTypes, true);
    }
}
