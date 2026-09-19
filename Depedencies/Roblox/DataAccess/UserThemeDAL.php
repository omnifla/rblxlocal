<?php

namespace Roblox\DataAccess;

class UserThemeDAL
{
    public int $ID = 0;
    public int $UserID = 0;
    public int $ThemeTypeID = 0;
    public ?\DateTime $Created = null;
    public ?\DateTime $Updated = null;

    public function insert(): void {}
    public function update(): void {}
    public function delete(): void {}

    public static function get(int $id): ?self
    {
        return null;
    }

    public static function getByUserID(int $userId): ?self
    {
        return null;
    }
}
