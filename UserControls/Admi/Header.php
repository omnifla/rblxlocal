<?php
// written by omnifla
// ik my code sucks :p
namespace UserControls\Admi;
use Roblox\Authentication as Auth; // gonna use this to check if admin but ill implement it soon dwww

class Header
{
    private static function getStats(): array
    {
        global $conn;
        try {
            $bannedUsers = $conn->query("SELECT COUNT(*) FROM users WHERE account_status_id = 2")->fetchColumn();
        } catch (\Exception $e) {
            $bannedUsers = 0;
        }
        return ['bannedUsers' => $bannedUsers];
    }

    public static function render(): string
    {
        $stats = self::getStats();
        $bannedUsers = $stats['bannedUsers'];
        ob_start();
        ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="adminStyle">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true">
    <title>ROBLOX | Administration</title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="/js/Microsoft/MicrosoftAjaxTreeView.js" type="text/javascript"></script>
    <script src="/js/JsTree/jquery.js" type="text/javascript"></script>
    <script src="/js/JsTree/jstree.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/CSS/Base/CSS/Roblox.css">
    <link rel="stylesheet" href="/CSS/RBXCommon.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/AccountBalance.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Admin.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Admin2.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Ads.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/AgeUpEmailVerifyPage.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Asset.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Badges.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/carouselpager.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Catalog.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CharacterCustomization.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CharacterSelectAndInstallInstructions.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CommonForms.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/ContentAdapters.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/ContentBuilder.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Contest.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CreditCardExpireModal.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CuratedGames.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CurrencyExchange.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/DarkGradientBox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Frontpage.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Games.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/GenericModal.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/GroupRoleSetMembersPane.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Groups.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Help.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/IframeHeader.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/iFrameLogin.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Inbox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Info.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Install.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Item.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/LandingGames.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/LinkInventory.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/ManageAccount.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Membership.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/MenuRedesign.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Message.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/MyAccount.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/MyMoney.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/NewCatalog.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/NewToolBox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Parents.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/party.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/PersonalServerAccessPrivilegesRoleSet.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Place.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/PlaceLauncher.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Profile.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Q.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/RevisedCharacterSelectModal.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Sets.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/ShadowedStandardBox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/ShareRoblox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Signup.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Store.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Studio2Alert.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/StyleGuide.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/tipsy.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Toolbox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Trade.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/UnifiedModal.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Upgrades.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Upload.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/User.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Utility.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/VideoPreRoll.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/BuildersClub.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Catalog.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/DarkGradientBox.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Games.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Inbox.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Item.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/MyRoblox.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Roblox.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Upgrades.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Utility.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/jstree.css">
    <style>
        html, body { height: auto; margin: 0; padding: 0; background: #fff; }
        form { height: auto !important; }
        #Body { min-height: 0 !important; }
        .AdminNavigation { position: relative !important; top: auto !important; bottom: auto !important; height: auto !important; width: 100% !important; }
        #Container { width: 100% !important; margin: 0 !important; padding: 0 !important; }
        #sidebar {
            position: fixed !important;
            top: 0; left: 0;
            width: 196px !important;
            height: 100vh !important;
            background: #eaeaea;
            border-right: 1px solid #000;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 9999;
            box-sizing: border-box;
        }
        #sidebar + div {
            margin-left: 206px !important;
            padding: 10px;
            box-sizing: border-box;
            width: calc(100% - 206px);
            background: #fff;
            overflow-x: auto;
        }
    </style>
</head>
<body class="pageStyle">
    <div id="Container">
        <div id="sidebar">
            <div style="padding-left:11px;">
                <div style="padding-right:11px;padding-top:11px;">
                    <div class="logo_spacer" style="width:auto;height:50px;padding-right:4px;">
                        <a href="/" style="display:block;margin-left:auto;margin-right:auto;width:106px;height:28px;">
                            <img width="106px" height="28px" src="/Images/roblox_logo.png">
                        </a>
                    </div>
                    <div>
                        <div><a href="/Admi/Thumbs.aspx">Configs</a> | <a>Machines</a>: <b>0</b>% of <b>0</b></div>
                        <div><a>Cores</a>: <b>0</b>% in use of <b>0</b></div>
                        <div><b>0</b> running, <b>0</b> waiting</div>
                        <div><b>0</b> <a>players</a> in <b>0</b> games (<b>0:1</b>)</div>
                        <hr>
                        <div>
                            <h6><b>0</b> <a href="/Admi/Moderation/Default.aspx">abuse reports</a>,</h6>
                            <h6><b>0</b> <a>images</a>,</h6>
                            <h6><b>0</b> <a>videos</a>,</h6>
                            <h6><b><?= $bannedUsers ?></b> <a href="/Admi/Users/ModerateUser.aspx">users</a></h6>
                        </div>
                        <div><a href="/">Roblox</a>, <a href="/Admi/Users/Find.aspx">FindUser</a></div>
                    </div>
                </div>
                <div style="padding-right:2px;">
                    <hr>
                    <div style="padding-right:6px;">
                        <div><a>Change Theme</a></div>
                        <div><a>RBX1</a> <a>RBX2</a> <a>RBX3</a> <a>OBC1</a> <a>OBC2</a></div>
                    </div>
                </div>
                <div class="right" style="padding-right:10px;width:100%;text-align:right;">
                    <a class="highlight">Stop Chat</a>&nbsp;&nbsp;&nbsp;<a class="highlight">Pause Polling</a>
                </div>
            </div>
            <div class="AdminNavigation">
                <div style="border:dotted 1px grey;">
                    <div id="ctl00_cphRoblox_AdminNavigationTree"></div>
                </div>
            </div>
        </div>
        <div style="margin-left:206px;padding:10px;">
            <div class="Panel" style="padding-top:10px;border:none;"></div>
        <?php
        return ob_get_clean();
    }

    public static function renderFooter(): string
    {
        ob_start();
        ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    var treeview = $('#ctl00_cphRoblox_AdminNavigationTree');
    var options = {
        'core': {
            'data': [{ "text": "Admin Dashboard", "a_attr": { "href": "/Admi/Thumbs.aspx" }, "children": [{ "text": "Configuration", "a_attr": { "href": "/Admi/Config/Default.aspx" }, "children": [{ "text": "AB Tests", "a_attr": { "href": "/Admi/Config/ABTests.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Test Sites", "a_attr": { "href": "/Admi/Config/TestSites.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }], "state": { "selected": false }, "icon": "jstree-bullet-black" }, { "text": "Shoutbox", "a_attr": { "href": "/Admi/Shoutbox/Default.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Site-wide alert", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Notifications", "a_attr": { "href": "/Admi/Notifications.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Chat", "a_attr": { "href": "/Admi/Chat.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Scripts", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [{ "text": "Review Scripts", "a_attr": { "href": "/Admi/UserScripts/Scripts.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Reputation System", "a_attr": { "href": "/Admi/UserScripts/ReputationSystem.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }], "state": { "selected": false }, "icon": "jstree-bullet-black" }, { "text": "People", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [{ "text": "Find", "a_attr": { "href": "/Admi/Users/Find.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "User Admin", "a_attr": { "href": "/Admi/Users/UserAdmin.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Machine Config", "a_attr": { "href": "/Admi/Diagnostics/MachineConfiguration.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Builders Club", "a_attr": { "href": "/Admi/AccountUpgrades/BuildersClub.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Referral Program", "a_attr": { "href": "/Admi/AccountUpgrades/Referrals.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Find Payments", "a_attr": { "href": "/Admi/AccountUpgrades/Payments.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Find Parent", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Blacklist Email", "a_attr": { "href": "/Admi/Users/BlacklistEmail.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Manage Forum Moderation", "a_attr": { "href": "/Admi/Users/ManageForumModeration.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }], "state": { "selected": false }, "icon": "jstree-bullet-black" }, { "text": "Groups", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [{ "text": "Find Group", "a_attr": { "href": "/Admi/Groups/FindGroup.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Group Admin", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Group Building", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }], "state": { "selected": false }, "icon": "jstree-bullet-black" }, { "text": "Moderation", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [{ "text": "Image Queue", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Abuse Queue", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "User Queue", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Regular Expressions", "a_attr": { "href": "/Admi/ContentFilter/RegularExpressionView.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Moderator Review", "a_attr": { "href": "/Admi/Moderation/ModeratorReview.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }], "state": { "selected": false }, "icon": "jstree-bullet-black" }, { "text": "Games", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [{ "text": "FPS", "a_attr": { "href": "/Admi/Users/FPSSummary.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }, { "text": "Places", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }], "state": { "selected": false }, "icon": "jstree-bullet-black" }, { "text": "Grid", "a_attr": { "href": "/Admi/Default.aspx" }, "children": [], "state": { "selected": false }, "icon": "jstree-bullet-grey" }], "state": { "selected": false }, "icon": "jstree-bullet-black" }],
            'themes': { 'icons': true, 'dots': true, 'dir': '/Admi' }
        }
    };
    treeview.jstree(options).on('loaded.jstree', function () { treeview.jstree('open_all'); });
    treeview.bind('select_node.jstree', function (e, data) { document.location.href = data.node.a_attr.href; });
</script>
</body>
</html>
        <?php
        return ob_get_clean();
    }
}
