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
        <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___1cacbba05e42ebf55ef7a6de7f5dd3f0_m.css' />
        <style>
            /* aspect ratio 16:9 for game thumbnails */
            .game-item {
                width: 175px;
                height: 135px;
                border: 1px solid #ccc;
                margin: 2px;
                display: inline-block;
                vertical-align: top;
                text-align: center;
            }
            .game-item img {
                width: 175px;
                height: 100px;
                display: block;
            }
            .game-item-nameplate {
                width: 175px;
                height: 35px;
                background-color: #dfdfdf;
                font-weight: bold;
                text-align: center;
                vertical-align: middle;
                line-height: 35px;
                text-overflow: ellipsis;
                overflow: hidden;
                white-space: nowrap;
            }
            .see-more img {
                width:175px;
                height:135px;
                vertical-align: center;
                display:block;
            }
            .game-list {
                display: flex;
                flex-wrap: wrap;
            }
        </style>
    </head>
    <body>
        <div class="section">
            <div class="header">
                <h2>Popular</h2>
            </div>
            <div class="game-list">
                <div class="game-item">
                    <a href="#"><img src="https://w0.peakpx.com/wallpaper/59/594/HD-wallpaper-puppy-dog-cute-fluffy-pet-widescreen-16-9-background-2560x1440-dog.jpg" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Foo Bar</div>
                </div>
                <div class="game-item">
                    <a href="#"><img src="https://www.shutterstock.com/image-photo/maine-coon-cat-gracefully-posing-600nw-2531325881.jpg" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Bar Foo</div>
                </div>
                <div class="game-item">
                    <a href="#"><img src="https://images.unsplash.com/photo-1474511320723-9a56873867b5?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cmVkJTIwZm94fGVufDB8fDB8fHww" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">The Quick Brown Fox jumps at a burrow</div>
                </div>
                <a href="/games/list/?page=popular" class="game-item see-more"><img src="/images/mobileapp/see-more.png"></a>
            </div>
        <div class="section">
            <div class="header">
                <h2>Top Earning</h2>
            </div>
            <div class="game-list">
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/c/c4/6thAnnualBloxys.png/revision/latest/scale-to-width-down/1200?cb=20190118234346" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Bloxy Awards</div>
                </div>
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/f/f3/Natural_Disaster_Survival.jpg/revision/latest?cb=20190419230948" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Natural Disaster Survival</div>
                </div>
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/4/4e/Cross.png/revision/latest?cb=20170401144551" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Classic: Crossroads</div>
                </div>
                <a href="/games/list/?page=earning" class="game-item see-more"><img src="/images/mobileapp/see-more.png"></a>
            </div>
        </div>
        <div class="section">
            <div class="header">
                <h2>Top Rated</h2>
            </div>
            <div class="game-list">
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/c/c4/6thAnnualBloxys.png/revision/latest/scale-to-width-down/1200?cb=20190118234346" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Bloxy Awards</div>
                </div>
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/f/f3/Natural_Disaster_Survival.jpg/revision/latest?cb=20190419230948" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Natural Disaster Survival</div>
                </div>
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/4/4e/Cross.png/revision/latest?cb=20170401144551" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Classic: Crossroads</div>
                </div>
                <a href="/games/list/?page=rated" class="game-item see-more"><img src="/images/mobileapp/see-more.png"></a>
            </div>
        </div>
        <div class="section">
            <div class="header">
                <h2>Recommended</h2>
            </div>
            <div class="game-list">
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/c/c4/6thAnnualBloxys.png/revision/latest/scale-to-width-down/1200?cb=20190118234346" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Bloxy Awards</div>
                </div>
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/f/f3/Natural_Disaster_Survival.jpg/revision/latest?cb=20190419230948" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Natural Disaster Survival</div>
                </div>
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/4/4e/Cross.png/revision/latest?cb=20170401144551" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Classic: Crossroads</div>
                </div>
                <a href="/games/list/?page=recommended" class="game-item see-more"><img src="/images/mobileapp/see-more.png"></a>
            </div>
        </div>
        <div class="section">
            <div class="header">
                <h2>Featured</h2>
            </div>
            <div class="game-list">
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/c/c4/6thAnnualBloxys.png/revision/latest/scale-to-width-down/1200?cb=20190118234346" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Bloxy Awards</div>
                </div>
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/f/f3/Natural_Disaster_Survival.jpg/revision/latest?cb=20190419230948" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Natural Disaster Survival</div>
                </div>
                <div class="game-item">
                    <a href="#"><img src="https://static.wikia.nocookie.net/roblox/images/4/4e/Cross.png/revision/latest?cb=20170401144551" alt="Game Thumbnail"></a>
                    <div class="game-item-nameplate">Classic: Crossroads</div>
                </div>
                <a href="/games/list/?page=featured" class="game-item see-more"><img src="/images/mobileapp/see-more.png"></a>
            </div>
        </div>
    </body>
</html>