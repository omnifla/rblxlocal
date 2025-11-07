<?php
// written by denied_id
include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">

<head id="ctl00_Head1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <title></title>

    <script type="text/javascript" src="/js/roblox.js"></script>
    <script type="text/javascript" src="/JS/Modules/Widgets/DropdownMenu.js"></script>
    <script type="text/javascript" src="/js/jquery/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" href="/CSS/Base/CSS/StyleGuide.css">
</head>

<body>
    <div>Standard Gray Dropdown With text</div>
    <div class="dropdown">
        <div class="button">Arrow Text</div>
        <ul class="dropdown-list" style="min-width: 83px; display: none;">
            <li>
                <a href="#">Widgets Page</a>
            </li>
            <li>
                <a href="Reference/buttons.cshtml">Buttons Reference Page</a>
            </li>
        </ul>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div>Standard Gray Dropdown With Gear Icon</div>
    <div class="dropdown">
        <div class="button button gear"></div>
        <ul class="dropdown-list" data-align="right" style="min-width: 40px; right: 0px; display: none;">
            <li>
                <a href="#">Widgets Page</a>
            </li>
            <li>
                <a href="Reference/buttons.cshtml">Buttons Reference Page</a>
            </li>
        </ul>
    </div>

    <script type="text/javascript">
        Roblox.require('Widgets.DropdownMenu', function(dropdown) {
            dropdown.InitializeDropdown();
        });
    </script>
</body>