<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
use UserControls\Navigation\SiteAlert;
$user = Auth::GetAuthenticatedUserInfo();
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <title>RBLX.local Terms of Service</title>


    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___d535f3b526024f1327687b24aaa375b3_m.css">


    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/CSS/PartialViews/Navigation.css">
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js'></script>
    <script
        type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.7.2.min.js'><\/script>")</script>
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
    <script
        type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>
    <script type="text/javascript">
        if (typeof (Roblox) === "undefined") { Roblox = {}; }
        Roblox.Endpoints = Roblox.Endpoints || {};
        Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
        Roblox.Endpoints.Urls['/asset/'] = 'http://www.roblox.local/asset/';
        Roblox.Endpoints.Urls['/client-status/set'] = 'http://www.roblox.local/client-status/set';
        Roblox.Endpoints.Urls['/client-status'] = 'http://www.roblox.local/client-status';
        Roblox.Endpoints.Urls['/game/'] = 'http://www.roblox.local/game/';
        Roblox.Endpoints.Urls['/game/edit.ashx'] = 'http://www.roblox.local/game/edit.ashx';
        Roblox.Endpoints.Urls['/game/getauthticket'] = 'http://www.roblox.local/game/getauthticket';
        Roblox.Endpoints.Urls['/game/placelauncher.ashx'] = 'http://www.roblox.local/game/placelauncher.ashx';
        Roblox.Endpoints.Urls['/game/report-stats'] = 'http://www.roblox.local/game/report-stats';
        Roblox.Endpoints.Urls['/game/report-event'] = 'http://www.roblox.local/game/report-event';
        Roblox.Endpoints.Urls['/chat/chat'] = 'http://www.roblox.local/chat/chat';
        Roblox.Endpoints.Urls['/chat/party/setting'] = 'http://www.roblox.local/chat/party/setting';
        Roblox.Endpoints.Urls['/chat/get.ashx'] = 'http://www.roblox.local/chat/get.ashx';
        Roblox.Endpoints.Urls['/chat/party.ashx'] = 'http://www.roblox.local/chat/party.ashx';
        Roblox.Endpoints.Urls['/chat/send.ashx'] = 'http://www.roblox.local/chat/send.ashx';
        Roblox.Endpoints.Urls['/chat/utility.ashx'] = 'http://www.roblox.local/chat/utility.ashx';
        Roblox.Endpoints.Urls['/chat/friendhandler.ashx'] = 'http://www.roblox.local/chat/friendhandler.ashx';
        Roblox.Endpoints.Urls['/presence/users'] = 'http://www.roblox.local/presence/users';
        Roblox.Endpoints.Urls['/presence/user'] = 'http://www.roblox.local/presence/user';
        Roblox.Endpoints.Urls['/friends/list'] = 'http://www.roblox.local/friends/list';
        Roblox.Endpoints.Urls['/navigation/getCount'] = 'http://www.roblox.local/navigation/getCount';
        Roblox.Endpoints.Urls['/catalog/browse.aspx'] = 'http://www.roblox.local/catalog/browse.aspx';
        Roblox.Endpoints.Urls['/catalog'] = 'http://www.roblox.local/catalog';
        Roblox.Endpoints.Urls['/catalog/'] = 'http://www.roblox.local/catalog/';
        Roblox.Endpoints.Urls['/catalog/html'] = 'http://www.roblox.local/catalog/html';
        Roblox.Endpoints.Urls['/catalog/json'] = 'http://www.roblox.local/catalog/json';
        Roblox.Endpoints.Urls['/catalog/contents'] = 'http://www.roblox.local/catalog/contents';
        Roblox.Endpoints.Urls['/catalog/lists.aspx'] = 'http://www.roblox.local/catalog/lists.aspx';
        Roblox.Endpoints.Urls['/asset-hash-thumbnail/image'] = 'http://www.roblox.local/asset-hash-thumbnail/image';
        Roblox.Endpoints.Urls['/asset-hash-thumbnail/json'] = 'http://www.roblox.local/asset-hash-thumbnail/json';
        Roblox.Endpoints.Urls['/asset-thumbnail-3d/json'] = 'http://www.roblox.local/asset-thumbnail-3d/json';
        Roblox.Endpoints.Urls['/asset-thumbnail/image'] = 'http://www.roblox.local/asset-thumbnail/image';
        Roblox.Endpoints.Urls['/asset-thumbnail/json'] = 'http://www.roblox.local/asset-thumbnail/json';
        Roblox.Endpoints.Urls['/asset-thumbnail/url'] = 'http://www.roblox.local/asset-thumbnail/url';
        Roblox.Endpoints.Urls['/asset/request-thumbnail-fix'] = 'http://www.roblox.local/asset/request-thumbnail-fix';
        Roblox.Endpoints.Urls['/avatar-thumbnail-3d/json'] = 'http://www.roblox.local/avatar-thumbnail-3d/json';
        Roblox.Endpoints.Urls['/avatar-thumbnail/image'] = 'http://www.roblox.local/avatar-thumbnail/image';
        Roblox.Endpoints.Urls['/avatar-thumbnail/json'] = 'http://www.roblox.local/avatar-thumbnail/json';
        Roblox.Endpoints.Urls['/avatar-thumbnails'] = 'http://www.roblox.local/avatar-thumbnails';
        Roblox.Endpoints.Urls['/avatar/request-thumbnail-fix'] = 'http://www.roblox.local/avatar/request-thumbnail-fix';
        Roblox.Endpoints.Urls['/bust-thumbnail/json'] = 'http://www.roblox.local/bust-thumbnail/json';
        Roblox.Endpoints.Urls['/group-thumbnails'] = 'http://www.roblox.local/group-thumbnails';
        Roblox.Endpoints.Urls['/headshot-thumbnail/json'] = 'http://www.roblox.local/headshot-thumbnail/json';
        Roblox.Endpoints.Urls['/item-thumbnails'] = 'http://www.roblox.local/item-thumbnails';
        Roblox.Endpoints.Urls['/outfit-thumbnail/json'] = 'http://www.roblox.local/outfit-thumbnail/json';
        Roblox.Endpoints.Urls['/place-thumbnails'] = 'http://www.roblox.local/place-thumbnails';
        Roblox.Endpoints.Urls['/thumbnail/avatar-headshot/'] = 'http://www.roblox.local/thumbnail/avatar-headshot/';
        Roblox.Endpoints.Urls['/thumbnail/avatar-headshots/'] = 'http://www.roblox.local/thumbnail/avatar-headshots/';
        Roblox.Endpoints.Urls['/thumbnail/place/'] = 'http://www.roblox.local/thumbnail/place/';
        Roblox.Endpoints.Urls['/thumbnail/user-avatar/'] = 'http://www.roblox.local/thumbnail/user-avatar/';
        Roblox.Endpoints.Urls['/thumbnail/asset/'] = 'http://www.roblox.local/thumbnail/asset/';
        Roblox.Endpoints.Urls['/thumbnail/resolve-hash/'] = 'http://www.roblox.local/thumbnail/resolve-hash/';
        Roblox.Endpoints.Urls['/thumbnail/get-asset-media'] = 'http://www.roblox.local/thumbnail/get-asset-media';
        Roblox.Endpoints.Urls['/thumbnail/remove-asset-media'] = 'http://www.roblox.local/thumbnail/remove-asset-media';
        Roblox.Endpoints.Urls['/thumbnail/set-asset-media-sort-order'] = 'http://www.roblox.local/thumbnail/set-asset-media-sort-order';
        Roblox.Endpoints.Urls['/thumbnail/place-thumbnails'] = 'http://www.roblox.local/thumbnail/place-thumbnails';
        Roblox.Endpoints.Urls['/thumbnail/place-thumbnails-partial'] = 'http://www.roblox.local/thumbnail/place-thumbnails-partial';
        Roblox.Endpoints.Urls['/thumbnail_holder/g'] = 'http://www.roblox.local/thumbnail_holder/g';
        Roblox.Endpoints.Urls['/groups/getprimarygroupinfo.ashx'] = 'http://www.roblox.local/groups/getprimarygroupinfo.ashx';
    </script>
    <script type="text/javascript">
        if (typeof (Roblox) === "undefined") { Roblox = {}; }
        Roblox.Endpoints = Roblox.Endpoints || {};
        Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
    </script>


</head>

<body class="">
    <div class="">


        <?= SiteHeader::render() ?>
        <?= SiteAlert::render() ?>
        <div class="">
            <div class="">
                <div id="Container">

                    <div class="forceSpace">&nbsp;</div>
                    <div style="clear:both"></div>
                    <div id="Body">

                        <style type="text/css">
                            .tos-section {
                                margin-bottom: 24px;
                            }

                            .tos-section p {
                                margin-bottom: 12px;
                            }
                        </style>

                        <div style="margin-top: 10px;">
                            <div>
                                <h2>Terms Of Service</h2>
                            </div>
                            <div>
                                <p>
                                    It is very important that you review the
                                    following rules so that you know what you can and cannot do on RBLX.local. By using
                                    this site, you and your parents agree to abide by the following terms and
                                    conditions:
                                </p>
                                <div style="padding:0 20px;">
                                    <div class="tos-section">
                                        1. You must be 13 or above to access RBLX.local
                                        <p>
                                            This is a common rule on every Roblox Revival and if we catch you being
                                            underage we will terminate your account off from the website.
                                        </p>
                                    </div>
                                    <div class="tos-section">
                                        <p>
                                            2. Most models, games and content on the message boards come straight from
                                            other
                                            RBLX.local users, not from someone at RBLX.local. If you see anything mean
                                            or nasty on the
                                            site, or anyone sends you anything that makes you uncomfortable or asks for
                                            your
                                            password or personal information (such as your name, address or phone
                                            number), please
                                            let us know immediately at <span class="SL_swap" id="CsEmailLink"><a
                                                    href="mailto:info@roblox.local">info@roblox.local</a></span>
                                            so that we can handle it right away! However, reporting false abuse or
                                            inappropriate
                                            feedback will not be tolerated and will likely result in a frozen account.
                                        </p>
                                    </div>
                                    <div class="tos-section">
                                        3. All user content and communications on the RBLX.local site&nbsp;may
                                        be&nbsp;filtered
                                        and monitored. RBLX.local does not pre-screen all submitted content, but
                                        RBLX.local and its
                                        designees shall have the right in their sole discretion to reject or remove any
                                        content
                                        that is available via the site. So that everyone has a good time, you understand
                                        and agree that you
                                        will not post or send through the site any words, images or links containing or
                                        relating to:
                                        <p>
                                        <ul>
                                            <li>profanity, slurs, sexual content (express or implied, including
                                                inappropriate acts with or by your pets for "real" or in role play)</li>
                                            <li>attacks, comments, or opinions about other people or things that
                                                slander, defame,
                                                threaten, insult or harass another person</li>
                                            <li>gangs, gang-slang, or the promotion of gangs</li>
                                            <li>promotions offering prizes of any sort (including contests, raffles,
                                                lotteries,
                                                chain letters or any kind of giveaway)</li>
                                            <li>materials created by someone else without their express written
                                                permission</li>
                                            <li>text or images that infringe on any intellectual property rights,
                                                including but not limited to,
                                                copyrights, trademarks and rights of privacy and publicity</li>
                                            <li>information that might identify another user</li>
                                            <li>model&nbsp;names, game names, account usernames, store fronts, or any
                                                descriptions
                                                or names that would be considered inappropriate under our Terms and
                                                Conditions</li>
                                            <li>"cheats" or "hacks", or information or links to sites claiming to have
                                                these</li>
                                            <li>requests for user passwords</li>
                                            <li>requests for money by using your models, RBLX.local Points or any other
                                                RBLX.local property
                                                on third party sites or your personal websites (including Ebay)</li>
                                            <li>scams of any kind (including requests to users to change their email
                                                address)</li>
                                            <li>"spamming" (repeatedly posting the same message) or "party boards"</li>
                                            <li>anything that suggests it's from a member of the RBLX.local staff</li>
                                            <li>other information that RBLX.local deems, in its sole discretion, to be
                                                inappropriate
                                                for this site </li>
                                        </ul>
                                        <p>
                                            <b>BEWARE:</b> If you do <b>any of the above</b> we may <b>terminate your
                                                account without prior notice.</b>
                                        </p>
                                        <p>&nbsp;</p>
                                        </p>
                                        <b>Copyright Notice</b><br />
                                        RBLX.local respects the intellectual property rights of others and we ask our
                                        users to do the same.
                                        RBLX.local is a community made project made to revive the old days of ROBLOX.
                                        All of RBLX.local's logos, characters, names, and all related indicia are
                                        trademarks of Roblox
                                        Corporation, We will take down this project if Roblox wants us to.
                                    </div>
                                    <div class="tos-section">
                                        <p>
                                            4. If you cheat on RBLX.local games or use cheat programs, including
                                            non-RBLX.local software
                                            or programs, to play the games we will terminate your account.
                                        </p>
                                    </div>
                                    <div class="tos-section">
                                        <p>
                                            5. Remember, this is a free website and we reserve the right to prohibit the
                                            use
                                            of the site to any user at any time.
                                        </p>
                                    </div>
                                </div>
                                <p>
                                    There are additional rules and guidelines for behavior on RBLX.local beyond the
                                    Terms
                                    of Service. They can be found in our <a
                                        href="http://www.roblox.local/Help/Builderman.aspx?id=221897">
                                        Community Guidelines</a>, and in the rules posted by staff on the Forums.</p>
                                <br />
                                <center>
                                    <font color="red" size="3">Remember - No member of RBLX.local staff will EVER ask
                                        you for
                                        your password!</font>
                                </center>
                                <center>
                                    <font color="red" size="3">If you feel like you wanna provide feedback about the
                                        website and the development of this project, visit the RBLX.local Github page.
                                    </font>
                                </center>
                            </div>
                        </div>

                    </div>
                    <?= SiteFooter::render() ?>