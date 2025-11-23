<?php
// ported by meditext
// this file defines the BrickColor class and its dependencies
namespace Roblox;
class Color { // php doesnt have a built in color class, hence why class Color exists.
    public int $R;
    public int $G;
    public int $B;

    public function __construct(int $r, int $g, int $b) {
        $this->R = $r;
        $this->G = $g;
        $this->B = $b;
    }

    public static function FromArgb(int $r, int $g, int $b): self {
        return new self($r, $g, $b);
    }
}

class BrickColor {
    public int $ID;
    public string $Name;
    public Color $Color;

    private static array $_Colors = [];
    private static array $_PrimaryColors = [];
    private static array $_HeadColors = [];

    public function __construct(int $id, string $name, Color $color) {
        $this->ID = $id;
        $this->Name = $name;
        $this->Color = $color;
    }
    /// The following Lua script generates this table:
    /// 
    /// function printBrick(i)
    ///   local bc = BrickColor.new(i)

    ///local s = string.format([==[
    ///   new BrickColor(%d, "%s", Color.FromArgb(%d, %d, %d)),
    ///   ]==],
    ///   bc.number, bc.name, 255 * bc.r, 255 * bc.g, 255 * bc.b)
    ///   print(s)
    ///end
    ///       printBrick(1);
    ///       printBrick(208);
    ///       printBrick(194);
    ///       printBrick(199);
    ///       printBrick(26);
    ///       printBrick(21);
    ///       printBrick(24);
    ///       printBrick(226);
    ///       printBrick(23);
    ///       printBrick(107);
    ///       printBrick(102);
    ///       printBrick(11);
    ///       printBrick(45);
    ///       printBrick(135);
    ///       printBrick(106);
    ///       printBrick(105);
    ///       printBrick(141);
    ///       printBrick(28);
    ///       printBrick(37);
    ///       printBrick(119);
    ///       printBrick(29);
    ///       printBrick(151);
    ///       printBrick(38);
    ///       printBrick(192);
    ///       printBrick(104);
    ///       printBrick(9);
    ///       printBrick(101);
    ///       printBrick(5);
    ///       printBrick(153);
    ///       printBrick(217);
    ///       printBrick(18);
    ///       printBrick(125);
    public static function init(): void {
        if (!empty(self::$_Colors)) return; // Avoid re-initialization

        self::$_Colors = [
            new BrickColor(1, "White", Color::FromArgb(242, 243, 243)),
            new BrickColor(208, "Light stone grey", Color::FromArgb(229, 228, 223)),
            new BrickColor(194, "Medium stone grey", Color::FromArgb(163, 162, 165)),
            new BrickColor(199, "Dark stone grey", Color::FromArgb(99, 95, 98)),
            new BrickColor(26, "Black", Color::FromArgb(27, 42, 53)),
            new BrickColor(21, "Bright red", Color::FromArgb(196, 40, 28)),
            new BrickColor(24, "Bright yellow", Color::FromArgb(245, 205, 48)),
            new BrickColor(226, "Cool yellow", Color::FromArgb(253, 234, 141)),
            new BrickColor(23, "Bright blue", Color::FromArgb(13, 105, 172)),
            new BrickColor(107, "Bright bluish green", Color::FromArgb(0, 143, 156)),
            new BrickColor(102, "Medium blue", Color::FromArgb(110, 153, 202)),
            new BrickColor(11, "Pastel Blue", Color::FromArgb(128, 187, 220)),
            new BrickColor(45, "Light blue", Color::FromArgb(180, 210, 228)),
            new BrickColor(135, "Sand blue", Color::FromArgb(116, 134, 157)),
            new BrickColor(106, "Bright orange", Color::FromArgb(218, 133, 65)),
            new BrickColor(105, "Br. yellowish orange", Color::FromArgb(226, 155, 64)),
            new BrickColor(141, "Earth green", Color::FromArgb(39, 70, 45)),
            new BrickColor(28, "Dark green", Color::FromArgb(40, 127, 71)),
            new BrickColor(37, "Bright green", Color::FromArgb(75, 151, 75)),
            new BrickColor(119, "Br. yellowish green", Color::FromArgb(164, 189, 71)),
            new BrickColor(29, "Medium green", Color::FromArgb(161, 196, 140)),
            new BrickColor(151, "Sand green", Color::FromArgb(120, 144, 130)),
            new BrickColor(38, "Dark orange", Color::FromArgb(160, 95, 53)),
            new BrickColor(192, "Reddish brown", Color::FromArgb(105, 64, 40)),
            new BrickColor(104, "Bright violet", Color::FromArgb(107, 50, 124)),
            new BrickColor(9, "Light reddish violet", Color::FromArgb(232, 186, 200)),
            new BrickColor(101, "Medium red", Color::FromArgb(218, 134, 122)),
            new BrickColor(5, "Brick yellow", Color::FromArgb(215, 197, 154)),
            new BrickColor(153, "Sand red", Color::FromArgb(149, 121, 119)),
            new BrickColor(217, "Brown", Color::FromArgb(124, 92, 70)),
            new BrickColor(18, "Nougat", Color::FromArgb(204, 142, 105)),
            new BrickColor(125, "Light orange", Color::FromArgb(234, 184, 146)),
            new BrickColor(1001, "Institutional white", Color::FromArgb(248, 248, 248)),
            new BrickColor(1002, "Mid gray", Color::FromArgb(205, 205, 205)),
            new BrickColor(1003, "Really black", Color::FromArgb(17, 17, 17)),
            new BrickColor(1022, "Grime", Color::FromArgb(127, 142, 100)),
            new BrickColor(1023, "Lavender", Color::FromArgb(140, 91, 159)),
            new BrickColor(1005, "Neon orange", Color::FromArgb(255, 175, 0)),
            new BrickColor(1018, "Teal", Color::FromArgb(18, 238, 212)),
            new BrickColor(1030, "Pastel brown", Color::FromArgb(255, 204, 153)),
            new BrickColor(1029, "Pastel yellow", Color::FromArgb(255, 255, 204)),
            new BrickColor(1025, "Pastel orange", Color::FromArgb(255, 201, 201)),
            new BrickColor(1016, "Pink", Color::FromArgb(255, 102, 204)),
            new BrickColor(1026, "Pastel violet", Color::FromArgb(177, 167, 255)),
            new BrickColor(1024, "Pastel light blue", Color::FromArgb(175, 221, 255)),
            new BrickColor(1027, "Pastel blue-green", Color::FromArgb(159, 243, 233)),
            new BrickColor(1028, "Pastel green", Color::FromArgb(204, 255, 204)),
            new BrickColor(1008, "Olive", Color::FromArgb(193, 190, 66)),
            new BrickColor(1009, "New Yeller", Color::FromArgb(255, 255, 0)),
            new BrickColor(1017, "Deep orange", Color::FromArgb(255, 175, 0)),
            new BrickColor(1004, "Really red", Color::FromArgb(255, 0, 0)),
            new BrickColor(1032, "Hot pink", Color::FromArgb(255, 0, 191)),
            new BrickColor(1010, "Really blue", Color::FromArgb(0, 0, 255)),
            new BrickColor(1019, "Toothpaste", Color::FromArgb(0, 255, 255)),
            new BrickColor(1020, "Lime green", Color::FromArgb(0, 255, 0)),
            new BrickColor(1031, "Royal purple", Color::FromArgb(98, 37, 209)),
            new BrickColor(1006, "Alder", Color::FromArgb(180, 128, 255)),
            new BrickColor(1013, "Cyan", Color::FromArgb(4, 175, 236)),
            new BrickColor(1021, "Camo", Color::FromArgb(58, 125, 21)),
            new BrickColor(1014, "CGA brown", Color::FromArgb(170, 85, 0)),
            new BrickColor(1007, "Dusty Rose", Color::FromArgb(163, 75, 75)),
            new BrickColor(1015, "Magenta", Color::FromArgb(170, 0, 170)),
            new BrickColor(1012, "Deep blue", Color::FromArgb(33, 84, 185)),
            new BrickColor(1011, "Navy blue", Color::FromArgb(0, 32, 96)),
        ];

        self::$_PrimaryColors = [
            self::Get(1), // "White"
            self::Get(208), // "Light stone grey"
            self::Get(194), // "Medium stone grey"
            self::Get(199), // "Dark stone grey"
            self::Get(26), // "Black"
            self::Get(21), // "Bright red"
            self::Get(24), // "Bright yellow"
            self::Get(23), // "Bright blue"
            self::Get(102), // "Medium blue"
            self::Get(141), // "Earth green"
            self::Get(37), // "Bright green"
            self::Get(29), // "Medium green"
        ];

        self::$_HeadColors = [
            self::Get(1), // "White"
            self::Get(208), // "Light stone grey"
            self::Get(194), // "Medium stone grey"
            self::Get(226), // "Cool yellow"
        ];
    }

    public static function Get(int $id): ?BrickColor {
        foreach (self::$_Colors as $color) {
            if ($color->ID === $id) return $color;
        }
        return null;
    }

    public static function GetAll(): array {
        return self::$_Colors;
    }

    public static function GetRandom(): ?BrickColor {
        $i = random_int(0, count(self::$_PrimaryColors) - 1);
        return self::$_PrimaryColors[$i] ?? null;
    }

    public static function GetRandomHeadColor(): ?BrickColor {
        $i = random_int(0, count(self::$_HeadColors) - 1);
        return self::$_HeadColors[$i] ?? null;
    }
}

BrickColor::init();
