<?php
// written by meditext
// this is my attempt to recreate ROBLOX's game listing page from 2012-2015.
require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games - ROBLOX</title>
    
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/CSS/Base/CSS/StyleGuide.css">
    <link rel="stylesheet" href="/CSS/MobileCommon.css">
    <link rel="stylesheet" href="/CSS/MobileGamesNew.css">
</head>
<body class="bodyStyle">
    <div>
        <form action="/games/search.php" method="get" id="GameSearch">
            <input type="text" name="keyword" placeholder="Search All Games" class="SearchInput searchBox" />
            <input type="submit" value="" class="SearchButtonTxt" />
        </form>

    </div>
    <div class="GamesHeader">
        <h2>Popular</h2>
    </div>

    <div class="GamesContainer">
        <a href="#" class="GameItemContainer GameItemAnchor" >
            <img class="GameItemImage" src="https://w0.peakpx.com/wallpaper/59/594/HD-wallpaper-puppy-dog-cute-fluffy-pet-widescreen-16-9-background-2560x1440-dog.jpg">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Foo Bar</div>
            </div>
        </a>
        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://www.shutterstock.com/image-photo/maine-coon-cat-gracefully-posing-600nw-2531325881.jpg">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Bar Foo</div>
            </div>
        </a>
        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://w0.peakpx.com/wallpaper/59/594/HD-wallpaper-puppy-dog-cute-fluffy-pet-widescreen-16-9-background-2560x1440-dog.jpg">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Another Game</div>
            </div>
        </a>

        <a href="/games/list/?page=popular" class="GameItemContainer GameItemAnchor">
            <div class="SeeMoreImage"></div>
        </a>
    </div>

    <div class="GamesHeader">
        <h2>Top Earning</h2>
    </div>

    <div class="GamesContainer">
        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/c/c4/6thAnnualBloxys.png/revision/latest/scale-to-width-down/1200?cb=20190118234346">
            <div class="TitleButtonContainer">
                <div class="TitleButton">6th Annual Bloxys</div>
            </div>
        </a>

        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/f/f3/Natural_Disaster_Survival.jpg/revision/latest?cb=20190419230948">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Natural Disaster Survival</div>
            </div>
        </a>

        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/4/4e/Cross.png/revision/latest?cb=20170401144551">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Crossroads</div>
            </div>
        </a>

        <a href="/games/list/?page=earning" class="GameItemContainer GameItemAnchor">
            <div class="SeeMoreImage"></div>
        </a>
    </div>

    <div class="GamesHeader">
        <h2>Top Rated</h2>
    </div>

    <div class="GamesContainer">
        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/c/c4/6thAnnualBloxys.png/revision/latest/scale-to-width-down/1200?cb=20190118234346">
            <div class="TitleButtonContainer">
                <div class="TitleButton">6th Annual Bloxys</div>
            </div>
        </a>

        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/f/f3/Natural_Disaster_Survival.jpg/revision/latest?cb=20190419230948">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Natural Disaster Survival</div>
            </div>
        </a>

        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/4/4e/Cross.png/revision/latest?cb=20170401144551">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Crossroads</div>
            </div>
        </a>

        <a href="/games/list/?page=rated" class="GameItemContainer GameItemAnchor">
            <div class="SeeMoreImage"></div>
        </a>
    </div>
    <div class="GamesHeader">
        <h2>Recommended</h2>
    </div>

    <div class="GamesContainer">
        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/c/c4/6thAnnualBloxys.png/revision/latest/scale-to-width-down/1200?cb=20190118234346">
            <div class="TitleButtonContainer">
                <div class="TitleButton">6th Annual Bloxys</div>
            </div>
        </a>

        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/f/f3/Natural_Disaster_Survival.jpg/revision/latest?cb=20190419230948">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Natural Disaster Survival</div>
            </div>
        </a>

        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/4/4e/Cross.png/revision/latest?cb=20170401144551">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Crossroads</div>
            </div>
        </a>

        <a href="/games/list/?page=recommended" class="GameItemContainer GameItemAnchor">
            <div class="SeeMoreImage"></div>
        </a>
    </div>

    <div class="GamesHeader">
        <h2>Featured</h2>
    </div>

    <div class="GamesContainer">
        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/c/c4/6thAnnualBloxys.png/revision/latest/scale-to-width-down/1200?cb=20190118234346">
            <div class="TitleButtonContainer">
                <div class="TitleButton">6th Annual Bloxys</div>
            </div>
        </a>

        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/f/f3/Natural_Disaster_Survival.jpg/revision/latest?cb=20190419230948">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Natural Disaster Survival</div>
            </div>
        </a>

        <a href="#" class="GameItemContainer GameItemAnchor">
            <img class="GameItemImage" src="https://static.wikia.nocookie.net/roblox/images/4/4e/Cross.png/revision/latest?cb=20170401144551">
            <div class="TitleButtonContainer">
                <div class="TitleButton">Crossroads</div>
            </div>
        </a>

        <a href="/games/list/?page=featured" class="GameItemContainer GameItemAnchor">
            <div class="SeeMoreImage"></div>
        </a>
    </div>
    <div class="bcRequiredContainer">
        <div class="upgrade-bc-box" style="">
            <div class="header">Builders Club Required</div>
            <div class="desc">
                Upgrade to BC to play exclusive Games!
            </div>
            <button class="upgradeNowButton bt">Upgrade Now!</button>
            <span class="popover-arrow"></span>
        </div>
    </div>
</body>
</html>