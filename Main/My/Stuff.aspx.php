<?php
// writen by chloe
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Web\SiteAlert;
$user = Auth::GetAuthenticatedUserInfo();
$userId = (int)$user["id"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="//www.facebook.com/2008/fbml">
<head id="ctl00_Head1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
  <title>
    <?= "My Inventory" . " - " .$site_properties['Title'] ?>
  </title>
  <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___dac4a444950639c02cc831a484c826f5_m.css' />
  <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___1b22aeedd7f4e73ab0700a149f589336_m.css' />
</head>
<body class="">
<div>
</div>

<div>

</div>
<div id="fb-root">
</div>

<div class=""><div class="">
<div id="MasterContainer">
<div id="BodyWrapper">
<div id="RepositionBody">
<?= SiteHeader::render() ?>
<?= SiteAlert::render() ?>
<div id="Body" style="width:970px;">
<div id="Container">
<div id="UserContainer">
    <div id="UserAssetsPane" style="border-top: 1px solid #ccc;">
        <div id="ctl00_cphRoblox_rbxUserAssetsPane_upUserAssetsPane">

            <h2 class="title" display="block" style="width:970px">
                <span>
                    Inventory
                </span>
            </h2>
            <div id="UserAssets">
                <div id="AssetsMenu" class="divider-right">
                    <?php
                    $categories = [
                        0 => "Heads",
                        1 => "Faces",
                        2 => "Gear",
                        3 => "Hats",
                        4 => "T-Shirts",
                        5 => "Shirts",
                        6 => "Pants",
                        7 => "Decals",
                        8 => "Models",
                        9 => "Plugins",
                        10 => "Animations",
                        11 => "Places",
                        12 => "Game Passes",
                        13 => "Audio",
                        14 => "Badges",
                        15 => "Left Arms",
                        16 => "Right Arms",
                        17 => "Left Legs",
                        18 => "Right Legs",
                        19 => "Torsos",
                        20 => "Packages",
                    ];
                    $currentCat = isset($_GET['cat']) ? intval($_GET['cat']) : 3;
                    foreach ($categories as $catId => $catName) {
                        $selectedClass = ($catId === $currentCat) ? "verticaltab selected" : "verticaltab";
                        echo "<div class='$selectedClass'><a href='javascript:void(0)' onclick='setCategory($catId)'>$catName</a></div>";
                    }
                    ?>
                </div>

                <div id="AssetsContent" style="width:745px; height:900px; position:relative;">
                    <div id="iframe-loader" style="position: absolute; top: 20px; left: 50%; transform: translateX(-50%); z-index: 10;">
                        <img src="/images/ProgressIndicator4.gif" alt="Loading...">
                    </div>

                    <iframe id="inventory_iframe" style="width:745px; height:100%; border:none; display:none;"
                        src="/Users/Inventory.php?id=<?php echo $userId ?>&page=1&cat=<?php echo $currentCat ?>">
                    </iframe>

                    <script>
                        const iframe = document.getElementById("inventory_iframe");
                        const loader = document.getElementById("iframe-loader");

                        iframe.addEventListener("load", function () {
                            loader.style.display = "none";
                            iframe.style.display = "block";
                        });

                        function setCategory(cat) {
                            const userId = '<?php echo $userId ?>';

                            loader.style.display = "block";
                            iframe.style.display = "none";
                            iframe.src = `/Users/Inventory.php?id=${userId}&page=1&cat=${cat}`;

                            document.querySelectorAll('.verticaltab').forEach(tab => tab.classList.remove('selected'));
                            event.target.closest('.verticaltab').classList.add('selected');
                        }
                    </script>
                </div>

                <div style="clear: both;">
                </div>
            </div>
        </div>
    </div>
</div>

<?= SiteFooter::render() ?>

</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
