<?php
// written by meditext
require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/main.php');
use Roblox\Authentication as Auth;
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;

$currentUser = Auth::GetAuthenticatedUserInfo();
$currentUserId = $currentUser ? (int) $currentUser['id'] : '';
?>


<!DOCTYPE html>
<html xmlns:fb="//www.facebook.com/2008/fbml">
<!-- MachineID: WEB109 -->
<head id="ctl00_ctl00_Head1"><title>
	Trade - ROBLOX
</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___7000c43d73500e63554d81258494fa21_m.css' />

<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___454963b97fe545e3b3f2aaf85eef6d4a_m.css' />
<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="Content-Language" content="en-us" /><meta name="author" content="ROBLOX Corporation" /><meta id="ctl00_ctl00_metadescription" name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." /><meta id="ctl00_ctl00_metakeywords" name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
<script type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>
        <div id="EventStreamData"
             data-default-url="//ecsv2.roblox.local/www/e.png"
             data-www-url="//ecsv2.roblox.local/www/e.png"
             data-studio-url="//ecsv2.roblox.local/pe?t=studio"></div>


<div id="page-heartbeat-event-data-model"
     class="hidden"
     data-page-heartbeat-event-intervals="[2,8,20,60]">
</div><script type='text/javascript' src='//js.rbxcdn.com/f49d858ef181e7cd401d8fcb4245e6e8.js.gzip'></script>
<script type='text/javascript'>Roblox.config.externalResources = [];Roblox.config.paths['Pages.Catalog'] = '//js.rbxcdn.com/c1d70e1b98c87fcdb85e894b5881f60c.js.gzip';Roblox.config.paths['Pages.CatalogShared'] = '//js.rbxcdn.com/bd76a582ffb966eb0af3f16d61defa7f.js.gzip';Roblox.config.paths['Pages.Messages'] = '//js.rbxcdn.com/b123274ceba7c65d8415d28132bb2220.js.gzip';Roblox.config.paths['Resources.Messages'] = '//js.rbxcdn.com/6307f9bd9c09fa9d88c76291f3b68fda.js.gzip';Roblox.config.paths['Widgets.AvatarImage'] = '//js.rbxcdn.com/64f4ed4d4cf1c0480690bc39cbb05b73.js.gzip';Roblox.config.paths['Widgets.DropdownMenu'] = '//js.rbxcdn.com/5cf0eb71249768c86649bbf0c98591b0.js.gzip';Roblox.config.paths['Widgets.GroupImage'] = '//js.rbxcdn.com/556af22c86bce192fb12defcd4d2121c.js.gzip';Roblox.config.paths['Widgets.HierarchicalDropdown'] = '//js.rbxcdn.com/7689b2fd3f7467640cda2d19e5968409.js.gzip';Roblox.config.paths['Widgets.ItemImage'] = '//js.rbxcdn.com/d689e41830fba6bc49155b15a6acd020.js.gzip';Roblox.config.paths['Widgets.PlaceImage'] = '//js.rbxcdn.com/45d46dd8e2bd7f10c17b42f76795150d.js.gzip';Roblox.config.paths['Widgets.SurveyModal'] = '//js.rbxcdn.com/56ad7af86ee4f8bc82af94269ed50148.js.gzip';</script><script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script><script type='text/javascript' src='//js.rbxcdn.com/8220b4ecd0fe4da790391da3fd0b442c.js.gzip'></script>
<script type='text/javascript' src='//js.rbxcdn.com/59e30cf6dc89b69db06bd17fbf8ca97c.js.gzip'></script>
<script type='text/javascript' src='//js.rbxcdn.com/f3251ed8271ce1271b831073a47b65e3.js.gzip'></script>
<script type='text/javascript' src='//js.rbxcdn.com/3f3e6c117b7e1ff6c7644a1b4048a54c.js.gzip'></script>

    <script type="text/javascript">


    googletag.cmd.push(function() {
        Roblox = Roblox || {};
        Roblox.AdsHelper = Roblox.AdsHelper || {};
        Roblox.AdsHelper.slots = [];
        Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_MyRoblox_Top_728x90", [728, 90], "3435333334343131").addService(googletag.pubads()), id: "3435333334343131", path: "/1015347/Roblox_MyRoblox_Top_728x90"});
Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_Message_Right_160x600", [160, 600], "3434323032363537").addService(googletag.pubads()), id: "3434323032363537", path: "/1015347/Roblox_Message_Right_160x600"});

        for (var key in Roblox.AdsHelper.slots) {
            var slot = Roblox.AdsHelper.slots[key].slot;
            var id = Roblox.AdsHelper.slots[key].id;
            var path = Roblox.AdsHelper.slots[key].path;

            if (slot.renderEnded != "undefined") {
                (function(slot, id)
                {
                    slot.renderEndedOld = slot.renderEnded;
                    slot.renderEnded = function() {
                        slot.renderEndedOld();
                        if ($('#' + id + '.gutter').css('display') == "none") {
                            $(document).trigger("GuttersHidden");
                        }
                        if ($('#' + id + '.filmstrip').css('display') == "none") {
                            $(document).trigger("FilmStripHidden");
                        }
                    };
                }(slot, id));
            }
        }

        googletag.pubads().setTargeting("Age", ["36", "18AndOver" ]);
                        googletag.pubads().setTargeting("Env",  "Production");
                                                googletag.pubads().setTargeting("Gender", "Male");
                        googletag.pubads().setTargeting("PLVU", "False");
        googletag.pubads().enableSingleRequest();
        googletag.pubads().collapseEmptyDivs();
        googletag.enableServices();
    });
    </script>  
<script type="text/javascript">
if (typeof(Roblox) === "undefined") { Roblox = {}; }
Roblox.Endpoints = Roblox.Endpoints || {};
Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
Roblox.Endpoints.Urls['/asset/'] = '//assetgame.roblox.local/asset/';
Roblox.Endpoints.Urls['/client-status/set'] = '//www.roblox.local/client-status/set';
Roblox.Endpoints.Urls['/client-status'] = '//www.roblox.local/client-status';
Roblox.Endpoints.Urls['/game/'] = '//assetgame.roblox.local/game/';
Roblox.Endpoints.Urls['/game/edit.ashx'] = '//assetgame.roblox.local/game/edit.ashx';
Roblox.Endpoints.Urls['/game/getauthticket'] = '//assetgame.roblox.local/game/getauthticket';
Roblox.Endpoints.Urls['/game/placelauncher.ashx'] = '//assetgame.roblox.local/game/placelauncher.ashx';
Roblox.Endpoints.Urls['/game/report-stats'] = '//assetgame.roblox.local/game/report-stats';
Roblox.Endpoints.Urls['/game/report-event'] = '//assetgame.roblox.local/game/report-event';
Roblox.Endpoints.Urls['/chat/chat'] = '//misc.roblox.local/chat/chat';
Roblox.Endpoints.Urls['/presence/users'] = '//www.roblox.local/presence/users';
Roblox.Endpoints.Urls['/presence/user'] = '//www.roblox.local/presence/user';
Roblox.Endpoints.Urls['/friends/list'] = '//www.roblox.local/friends/list';
Roblox.Endpoints.Urls['/navigation/getCount'] = '//www.roblox.local/navigation/getCount';
Roblox.Endpoints.Urls['/catalog/browse.aspx'] = '//www.roblox.local/catalog/browse.aspx';
Roblox.Endpoints.Urls['/catalog/html'] = '//search.roblox.local/catalog/html';
Roblox.Endpoints.Urls['/catalog/json'] = '//search.roblox.local/catalog/json';
Roblox.Endpoints.Urls['/catalog/contents'] = '//search.roblox.local/catalog/contents';
Roblox.Endpoints.Urls['/catalog/lists.aspx'] = '//search.roblox.local/catalog/lists.aspx';
Roblox.Endpoints.Urls['/asset-hash-thumbnail/image'] = '//assetgame.roblox.local/asset-hash-thumbnail/image';
Roblox.Endpoints.Urls['/asset-hash-thumbnail/json'] = '//assetgame.roblox.local/asset-hash-thumbnail/json';
Roblox.Endpoints.Urls['/asset-thumbnail-3d/json'] = '//assetgame.roblox.local/asset-thumbnail-3d/json';
Roblox.Endpoints.Urls['/asset-thumbnail/image'] = '//assetgame.roblox.local/asset-thumbnail/image';
Roblox.Endpoints.Urls['/asset-thumbnail/json'] = '//assetgame.roblox.local/asset-thumbnail/json';
Roblox.Endpoints.Urls['/asset-thumbnail/url'] = '//assetgame.roblox.local/asset-thumbnail/url';
Roblox.Endpoints.Urls['/asset/request-thumbnail-fix'] = '//assetgame.roblox.local/asset/request-thumbnail-fix';
Roblox.Endpoints.Urls['/avatar-thumbnail-3d/json'] = '//www.roblox.local/avatar-thumbnail-3d/json';
Roblox.Endpoints.Urls['/avatar-thumbnail/image'] = '//www.roblox.local/avatar-thumbnail/image';
Roblox.Endpoints.Urls['/avatar-thumbnail/json'] = '//www.roblox.local/avatar-thumbnail/json';
Roblox.Endpoints.Urls['/avatar-thumbnails'] = '//www.roblox.local/avatar-thumbnails';
Roblox.Endpoints.Urls['/avatar/request-thumbnail-fix'] = '//www.roblox.local/avatar/request-thumbnail-fix';
Roblox.Endpoints.Urls['/bust-thumbnail/json'] = '//www.roblox.local/bust-thumbnail/json';
Roblox.Endpoints.Urls['/group-thumbnails'] = '//www.roblox.local/group-thumbnails';
Roblox.Endpoints.Urls['/groups/getprimarygroupinfo.ashx'] = '//www.roblox.local/groups/getprimarygroupinfo.ashx';
Roblox.Endpoints.Urls['/headshot-thumbnail/json'] = '//www.roblox.local/headshot-thumbnail/json';
Roblox.Endpoints.Urls['/item-thumbnails'] = '//www.roblox.local/item-thumbnails';
Roblox.Endpoints.Urls['/outfit-thumbnail/json'] = '//www.roblox.local/outfit-thumbnail/json';
Roblox.Endpoints.Urls['/place-thumbnails'] = '//www.roblox.local/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/asset/'] = '//www.roblox.local/thumbnail/asset/';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshot'] = '//www.roblox.local/thumbnail/avatar-headshot';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshots'] = '//www.roblox.local/thumbnail/avatar-headshots';
Roblox.Endpoints.Urls['/thumbnail/user-avatar'] = '//www.roblox.local/thumbnail/user-avatar';
Roblox.Endpoints.Urls['/thumbnail/resolve-hash'] = '//www.roblox.local/thumbnail/resolve-hash';
Roblox.Endpoints.Urls['/thumbnail/place'] = '//www.roblox.local/thumbnail/place';
Roblox.Endpoints.Urls['/thumbnail/get-asset-media'] = '//www.roblox.local/thumbnail/get-asset-media';
Roblox.Endpoints.Urls['/thumbnail/remove-asset-media'] = '//www.roblox.local/thumbnail/remove-asset-media';
Roblox.Endpoints.Urls['/thumbnail/set-asset-media-sort-order'] = '//www.roblox.local/thumbnail/set-asset-media-sort-order';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails'] = '//www.roblox.local/thumbnail/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails-partial'] = '//www.roblox.local/thumbnail/place-thumbnails-partial';
Roblox.Endpoints.Urls['/thumbnail_holder/g'] = '//www.roblox.local/thumbnail_holder/g';
Roblox.Endpoints.Urls['/users/{id}/profile'] = '//www.roblox.local/users/{id}/profile';
Roblox.Endpoints.addCrossDomainOptionsToAllRequests = true;
</script>
<script type="text/javascript">
if (typeof(Roblox) === "undefined") { Roblox = {}; }
Roblox.Endpoints = Roblox.Endpoints || {};
Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
Roblox.Endpoints.Urls['/authentication/is-logged-in'] = '//www.roblox.local/authentication/is-logged-in';
</script>

<script type="text/javascript">
    // IMPORTANT! If the user is logged in, set to user_id; else, set to ''
    var _user_id = '<?php echo htmlspecialchars((string) $currentUserId, ENT_QUOTES, 'UTF-8'); ?>';

    // IMPORTANT! Set to a unique session ID for the visitor's current browsing session.
    var _session_id = '<?php echo htmlspecialchars((string) $currentUserId, ENT_QUOTES, 'UTF-8'); ?>';

    var _sift = window._sift = window._sift || [];

    // IMPORTANT! Insert your JavaScript snippet key here!
    _sift.push(['_setAccount', '5238aa5d58']);

    _sift.push(['_setUserId', _user_id]);
    _sift.push(['_setSessionId', _session_id]);
    _sift.push(['_trackPageview']);

    (function () {
        function ls() {
            var e = document.createElement('script');
            e.type = 'text/javascript';
            e.async = true;
            e.src = ('https:' === document.location.protocol ? 'https://' : '//') + 'cdn.siftscience.com/s.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(e, s);
        }
        if (window.attachEvent) {
            window.attachEvent('onload', ls);
        } else {
            window.addEventListener('load', ls, false);
        }
    }());
</script></head>
<body id="rbx-body"
    class=""
    data-performance-relative-value="0.5"
    data-internal-page-name="">
    <div id="roblox-linkify" data-enabled="true" data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9\-]{2,}\.)*(((m|de|www|web|api|blog|wiki|help|corp|polls|bloxcon|developer|devforum|forum)\.roblox\.com|robloxlabs\.com)|(www\.shoproblox\.com))((\/[A-Za-z0-9-+&amp;@#\/%?=~_|!:,.;]*)|(\b|\s))" data-regex-flags="gm"></div>
    <script type="text/javascript">Roblox.XsrfToken.setToken('u256v2GAyfHL');</script>
 
    <script type="text/javascript">
        if (top.location != self.location) {
            top.location = self.location.href;
        }
    </script>
  
<style type="text/css">
    
</style>
<form name="aspnetForm" method="post" action="/My/Money.aspx" onsubmit="javascript:return WebForm_OnSubmit();" id="aspnetForm" class="nav-container no-gutter-ads">
<div>
<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="" />
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="BxeciNUDV6GV8EmeiBUq0vbAVmeYC933jpedMYmfrb58kzBQtPCc8LCKZmx5THElVfjwy65qGeyOxK5rRZhSj0hkDWtI+ZJxLF3AJC7zQEDfcCfBrv+HIFRYswACYKPnYREdApgsUcDk/UWbvQ4ZFc8AcTnGuBRt/0qFykMrlgnOWodnoXPGtYRUh2aZNtXuMqGP51uaCyqgd1ExsM+KAPM78MxsUo+QBsth0Y8OQHb4CE+95EtybGY66zd0A7MghBteiSuxjRbaDWwNehD8lIs4Mrq6uKUJKtyLZASaUsG13k/JmX5kw3oQ6xvbU3eJ/kGSFax/oIG5iUzKm3lmcdDoeqPOG6f33w3Ac5DJookJiWmLE5DwtK8k5JBLJHk4HgWIclPPS4AQ/W1qVwCbY1CfvnrQVgfmVtqIwnBw18ZkwClVv/SOcqKdNcFQqc3fvSfMbAVgqJlmQE5loFlc+ke/wcwGoahwEP2mDrFfFmgIllTvZEkHLbpJ/sQlTaCaU79CXvMbLtjrC+bGqmNJHQTt0IZOzCdYGdLFPwRVx6YgQO/qecIQDvy8TFGZRXPwqnH9cB9v60VNpYq0lkaBjPG/DA7kGK9rjQeHTXKnA8brB6zzcmEhBHMB6GcsJjvE9h0pKWCfKsLMJZylkSuEuURJOCKXXVWOLhpRw9tM5BZPXuOrsoiYPM3z+k3q4E+tBeilUovRFyYVARYztRU37EnnF4CHqZlYqLETq3ens95aHR7lm+b20vRrxxl+FvdPE5fIKBdw6gNI6UPrPllqcimh01uQ+NhSRuqIH2D/08Q7G4sD0w+PEJ1VP7OGfIFAR91SKZiq+6wsGh6aycZNmHK0iyy6g5QcVLqr1Ir0GodFLLojV1bZm7+LV5WTcVmHSSPKP0s2FA1HrbdcD3mIHzAH40f25qhG/9J5auhvfbaNt8vOd6e9niqChdr3BBjLCpGyeckMLu+92ZKyedA0xVV2seCGdMAazksuvmGJCg0vkKW7kvDKBRWlguqiRP41cNyamWZTT7AQrcmYpzjo9wswvzcnUeuSdeeWkX0/GMrdAYcVWG17mfGZGs2zQN9XHpvVn/f3Qaikimuz3VPu8FMV8J0tt7+bTRzhQEuFYJp5qwwLuOGKAQL32Ty5SRrBKdUG4vBny6tar7PS7e+s73Iu9tTUInEhg6p4wV1BhWzo9A0daxXlFX2K7PzT1aCAjnWYOaYG5W4jZu37vstRNZdfUNDjyiapZOJCybt9D7fi2/4Wphi42qHrIeQpSZSoL0pOkwXmioXum9W1R7l/cQD9yh0JuIANVhWkwl+4mpOIVQ39GRjIg8yhwqJVc64gyVaKFNqxGArO0sSJfln3uiCM9kCummLcXiMkhwqfbkENS2Hy8z6/0OZ3HApotWnY9L2U+LawtatOoZwatfQhqkTskFxab8x/vjI2Pvr90TapOWzwIOpLBjKrD0mPhr2foa6s7+mu+B1Qq0RfD+k6/ijNVQlVEQ8cJDpF8iHRk3AeoU7K29EKojfjVoEwBFoGS6UShYgJ+3IQZwMKsXFIfdnPaaPZ4FSKRhwnXBo+Qe2cTcQRbB6MlaGD36bVfVNYCsuURGAPzuLkBbpkp983A2+wo/abSrwsl3NQLl4rUcue6B3Hee2GWX+nyFMeYwZihEvxv1IstzjgjQtaZFLw4VdEouFnT/9KrVDjFtAFxDxEJ2xczprQoju6JSzgQlgBxsr9EDanzXHZOTTWzAubQ7UEb6mx+z5xD8bYMXxGesxomg1pC+Z+gcrd74X/4/0fGFSeurgOH6aK1ZhD00BVg5q+s6svx5b6yWtaK7sD5eOXcOgm9EzBMuI487QEErJobz919AtQ7/ZrU86sEEbHzHhsbsIDpD808UOHhZWdB5Pk6HinTKwqT14wBktEVD+lr38WgF1xsTjnm77LQZlperVDs2WNnECyrgM6KaLMiMqLaB65RUhHyFqe9K/Zi/fByEv/yI4BJCf/HvvhbO4TANsvNJc1VgMEFc+yHYA1xq2QsjEs2sZImn+m7nktINdIGhTqciQ/qMNrID9hf1g59F3Ket7bVbudIzDt6xPag4bTMAvKpi4HMLbPf2Lk1TVb6hTjfo0q1DBx2DKncdjvSDNV77IUnkxQeJ/OskIpdcpg2rkfUlwhirl7+qADMu26+J9/9rs7CR7acqotpY+XpU+rtjHRkvRUsrsUul/AVDOv7i1mA96z9xkQvGevMD+U3mVJ0gOzY8whvNP8tmGLheRXcFQIUSxSjWNyiXurlvCYZB6yH5YClh2TPdm65sVhaOL+ad5spBEzYMqQ/KwCDRkYhD8xvdWIETubdWSj92/tirX6QthDBKTyDee1BTfgO7EG0XjXzEZFtnM3eP6nneQXBwdc0w4fuKCfEMgupGzdOV4wypwlznDnnuq9ziMNUuTAGqmW6tR0bbc+hOLBNwSHSx94yG+tmn5s+3Ad3pqtmFavcT5yy7NBENbMunhtXNxu7VRtoGXcGVFxMsOxVcf0Lw+qTtO6nKcbsmi1a5cclPfaerpeGDL2ALE19ms9SGQA9opWynSC+DhM4HxASWd3qNhllQhP2iZc96A2irtxMO2+YpoYIFtcGysv/QG0s9uemjhrCrhemyTNH91Koobqzf6EspRVa6mEKdn9TQoBnIrs4dKTR4+q/0g5fgdG5xvIKRc7476frmK+pyeFSftqC7JRJEMya2MSDfTyUauLax5OG3lsLQ+Oz/PlhdevYbQTeTOjKzy8jyBNbI04ftDj4GFHnFfH/9eFvfpZLL2zSSnd4pEuKsmF6tnHmMxtU1gbo5zUcPrrzvSyfNS8alAcm+JOwfij5/ShAKwM1c20KFQiz1KLUL7+detE7Trugpoq2n4daF3nwF5tqDSDCX2U5wMk5Gci2KhvP305fOfi+tqm6Q/N6GcV75YCtRHXMQazwxCQSYj4+HTDX2RXaOOPJbI83KqrMMnupQb4i8XgTe7pL7F5oXKK+nMWhdRO3julJOEtIG2Xv4wrtSHSLGyfwcXozZ76ThDSwvYnnNQXdcasC06fNLUYWOxXvhDIkIpXm1w1DYxq3dnmRs8/LmxN9SZoluHh6Eh2d/nKxTCSkUQRSuZQDMv2lKiiLpQIf4vE53UORMsAmGKub5mmJ1LL8mu1f22USEaMINSLY2kt1S05wiNxnY1vL25kgexRcZVMzWK0s1dwTWUZOEygvpvvnS6uzLw8fuJzadl1AKbnw8uQb4Ssylwc9IYxqroFCR2P9ZeUIH9oA3rVXYmwROm5TrmXDDOMVTW58uYB11JbfgNW8Dq2MxjNc1iZ0Hh8bz+KYHwhTtTyhEwogWquHXs7Cc6qI4zVblLIZuMhVaEWNldJ6ReEcdwcm72vwVNw9zbre1kOJNIujKwTGvpP5hJ9fTnb+2hkbujfUVqFRidhmAO02KkjFjM/UMvg41PPfg3XD3WlQG/vGysBVKjpfdkyEuN7PMstwm+ihyIA7uTJXoFM3pfDiJK/xuXxWcPZbriKT8PYGYu3p34+E02eZr+4dnHJ7lIC/zes5bnLOnE/uAVxyAl30ciMvEzTjS0omztdJVlh4RrtDLxILAgPY6uEmnx18yXL2x4xHXtXjQVJZBVxDLIjQV+hhtmnGWll7E5uoHM60J7tcRK5kp8tkHgpswOqq0dHYFtcEjgeqkK9Rc38WqIA5mi6O5FCXgIfG9XD1yy9nVg7jVxa8Dol7EMA4HfSGrM1sVfsVIhE3qS8ZvVeN2m9FQbqMKcw7V1DMyt5lXx83FNrvXlHnb5Ee++o+EtqIxCCBFlDDLMaV2fORa3BJpqqRvEcsxOcSium0M3GYTt8rjQRNyC+26IfttGpGf5IZm7gA/UwpayfUFmQO3Uof0I3np8Lj2x3zvE3zoaOUEqMcdfjTyWi0wCUC/VQYPA/6oMJzLPtmzRrwrbrhk/5flZa8OS7Oo3hPhV58MFXan/LQgCIGA/0jGRsw/C1Rvlr8SFBi5IvBjMFbwk5EpHChfhnZtzwiLND70Wr56H2Y4isEaC0Ymq3KjCE7m2SJJe6wN1Zco/rkinlzfzryhhLcQC+umsL4CfwhQuPcF0c0PfORdZBu6GRmWo7ciNQWaYpL+tgWizXend9yHo5L/fMSlTlSxZbtvw5u03mIpkzO1R2e/UxBkDnw09oDQKd/Z9jrxQ5KuBMW1TcfKiXkfu9SAC9fo0kgSswaM16xEUf4s2vlsScRgCA5xIlJtEKHNIIVbbgD78+fLmgTfTb/DOVd/k5NbenGyXMeRhQu45BzZhGvgVUhyNb8dv6hifMcqVknfeYT3EGlrg4bvlYkV73vLkG0I4/fv3NQuGYuEI25VJ+fVj0wCioewV4y8q79U40d9wAHdbvJ/dmx+jnPB7BhOAWEjsOcZl1xlMTKa19FRSqIBPLMKG5BahN0fk3n3lcV+mQLF2pAQenZX5mWtQ/ux16/b13g97cVPZ9E7K8dorY905Agx7qE79Y2QJjHPWO3sJeezXHiyhpAEp6+pJ0c3XZIIJpJFC7Xn5mAJm/ubpF3b2QFatX0TcqFFHspGIYLE9JadqRl9kPnojoaQAVLeYbngiOsuQUZu90A8ZZNgAcTcFIQD6Ri9qg6Hg4M+Epm1cWmZHKs/mz17w5Lpxp9FxMAFKnMVocd+wad1jkkUAOACmYRcYh8JenhE1bsm3kFWx+xlpyRvIvY5yKy7LQ43YmRsYtdS4mt9pCOAtoT2dlI5if9YkVgyciEOIw6r0=" />
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['aspnetForm'];
if (!theForm) {
    theForm = document.aspnetForm;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>



<script src="/ScriptResource.axd?d=PNxpIlDNxHhNQn8qOu3HPlzJIgROLYl7r-S2vBjZOfnwsFi0I7f5c8cbqCpQFoBqk-PMsxQr12YK88iZ3Zln99R2klscvuI7_3geHZC10UEM_pbL-jX2TFndzF1aWhx5W6x2KxNZC6j8vSGuu6LiB6EaVAsRY8xUxtE1elPTg-fwfpS9Rmmq5Ti1SDnHkC6dmJh5Ya3Ya_3-sHcAOFuU4Edi4wpVSYiUzDp7SVFcRuHpOgCTzsFVGIa50pu28mZVUul-iK5RAckd_BkPeIcySx1TBuhYGdkXhvduLZ2XxrUnRm5Nlo1Zv2ndQz2Qb8us5lZx9gWbo-hp10wSMNxBZuY1gUE2XYt_RJOL8ekvpm5kUVZg9UQ6VSSSJRp6EznSIklBAuA-ukSSw-BMELNxeHOb73N7dk18xwtfp10Tc3UjwCEu0" type="text/javascript"></script>
<script src="/js/Trade/InventoryItem.js" type="text/javascript"></script>
<script src="/Marketplace/EconomyServices.asmx/js" type="text/javascript"></script>
<script src="/WebResource.axd?d=JoBkLzP19aTuxbWOhHobYsfcr93ZedSC25cVo3dMJeknBRMaHtDPkvHM2u4z5zv_3l0fDg2&amp;t=635589219571259667" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function WebForm_OnSubmit() {
if (typeof(ValidatorOnSubmit) == "function" && ValidatorOnSubmit() == false) return false;
return true;
}
//]]>
</script>

<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="42DF5B7A" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="P+Y9ZxESacKlocFc3Fbg6taQET+wAl6P20ZOn1TYlQ7nOM9Nc0LMPqK20GdCJmBU0GLgQtnaWK2vwpWDF0fFTKmKg+gy51sNLji2/v4V/qx3jf9/3VBLkH+MoFVqiDxLfp3rsXQfJmdBSzKLoEAJ4Mk0tZH/3mbelJSdFnwYzalHd4eu3xLf9r321wsbSy8VV/3PUxCVwlczUwVPfrbSi6lTovO11WaOWlRNwJckh9PG9CDzkiobFo/4IbbMVpZCLErGgOmlXND307UY+XGf0qjirLxjlkwQ/24W4aovq1XliXfYNCfhGc4DIUiuZd0k+dLUDA==" />
</div>
    <div id="fb-root">
    </div>
    <script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('ctl00$ctl00$ScriptManager', 'aspnetForm', ['tctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$OpenOffers$OpenOffersUpdatePanel','','tctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$OpenBids$OpenBidsUpdatePanel','','tctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$MyTradesOffers$MyTradesOffersUpdatePanel','','tctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$MyTradesBids$MyTradesBidsUpdatePanel',''], [], [], 90, 'ctl00$ctl00');
//]]>
</script>

<?= SiteHeader::render() ?>

        <div id="navContent" class="nav-content"><div class="nav-content-inner">
    <div id="MasterContainer" >
        

<script type="text/javascript">
    $(function(){
        function trackReturns() {
            function dayDiff(d1, d2) {
                return Math.floor((d1-d2)/86400000);
            }
            if (!localStorage) {
                return false;
            }

            var cookieName = 'RBXReturn';
            var cookieOptions = {expires:9001};
            var cookieStr = localStorage.getItem(cookieName) || "";
            var cookie = {};

            try {
                cookie = JSON.parse(cookieStr);
            } catch (ex) {
                // busted cookie string from old previous version of the code
            }

            try {
                if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
                    localStorage.setItem(cookieName, JSON.stringify({ ts: new Date().toDateString() }));
                    return false;
                }
            } catch (ex) {
                return false;
            }

            var daysSinceFirstVisit = dayDiff(new Date(), new Date(cookie.ts));
            if (daysSinceFirstVisit == 1 && typeof cookie.odr === "undefined") {
                RobloxEventManager.triggerEvent('rbx_evt_odr', {});
                cookie.odr = 1;
            }
            if (daysSinceFirstVisit >= 1 && daysSinceFirstVisit <= 7 && typeof cookie.sdr === "undefined") {
                RobloxEventManager.triggerEvent('rbx_evt_sdr', {});
                cookie.sdr = 1;
            }
            try {
                localStorage.setItem(cookieName, JSON.stringify(cookie));
            } catch (ex) {
                return false;
            }
        }

        GoogleListener.init();


    
        RobloxEventManager.initialize(true);
        RobloxEventManager.triggerEvent('rbx_evt_pageview');
        trackReturns();
        

    
        RobloxEventManager._idleInterval = 450000;
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_start');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_ftp');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_success');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_fmp');
        RobloxEventManager.startMonitor();
        

    });

</script>



        <script type="text/javascript">Roblox.FixedUI.gutterAdsEnabled=false;</script>

        

        <div id="Container">
            
            
        </div>

		
            <div id="AdvertisingLeaderboard">
                

<div style="width: 728px; " class="abp adp-gpt-container">
    <span id='3435333334343131' class="GPTAd banner" data-js-adtype="gptAd">
    </span>
        <div class="ad-annotations " style="width: 728px">
            <span class="ad-identification">
                Advertisement
                    <span> - </span>
                    <a href="" class="UpsellAdButton" title="Click to learn how to remove ads!">Why am I seeing ads?</a>
            </span>
                <a class="BadAdButton" href="//www.roblox.local/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
        </div>
    <script type="text/javascript">
        googletag.cmd.push(function () {
            if (typeof Roblox.AdsHelper !== "undefined" && typeof Roblox.AdsHelper.toggleAdsSlot !== "undefined") {
                Roblox.AdsHelper.toggleAdsSlot("", "3435333334343131");
            } else {
                googletag.display("3435333334343131");
            }
        });
    </script>
</div>


            </div>
        
        
        
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
        
        
        
        
        <div id="BodyWrapper">
            
            <div id="RepositionBody">
                <div id="Body" style='width:970px;'>
                    
    
<style type="text/css">
    #Body {
        padding: 10px;
    }
</style>
<div class="MyMoneyPage text">
    <div class="WhiteSquareTabsContainer">
        <ul class="SquareTabsContainer">
            
            <li class="SquareTabGray selected" contentid="MyTransactions_tab">
                <span><a>My Transactions</a></span>
            </li>
            
            <li class="SquareTabGray " contentid="Summary_tab">
                <span><a>Summary</a></span>
            </li>
            
            <li class="SquareTabGray " contentid="TradeCurrency_tab">
               <span><a>Trade Currency</a></span>
            </li>
            
            <li class="SquareTabGray " contentid="TradeItems_tab">
               <span><a>Trade Items</a></span>
            </li>
            
            <li class="SquareTabGray" contentid="Promotion_tab">
                <span><a>Promotion (Beta)</a></span>
            </li>
            
        </ul>
    </div>
    <a href=https://www.roblox.local/upgrades/robux?ctx=money class="BuyRobuxButton btn-medium btn-primary">Buy Robux</a>
    <div class="StandardPanelContainer">
        <div id="TabsContentContainer" class="StandardPanelWhite">
        
            <div id="MyTransactions_tab" class="TabContent selected uninitialized">
                <div class="SortsAndFilters">
                    <div class="TransactionType">
                        <span class="form-label">Transaction Type:</span>
                        <select class="form-select" id="MyTransactions_TransactionTypeSelect">
                            <option value="purchase">Purchases</option>
                            <option value="sale">Sales</option>
                            <option value="affiliatesale">Commissions</option>
                            
                            <option value="grouppayout">Group Payouts</option>
                            
                        </select>
                    </div>
                    <div style="clear:both;float:none;"></div>
                </div>
                <div class="TransactionsContainer">
                    <table class="table" cellpadding="0" cellspacing="0" border="0">
                        <tr class="table-header">
                            <th class="Date first">Date</th>
                            <th class="Member">Member</th>
                            <th class="Description">Description</th>
                            <th class="Amount">Amount</th>
                        </tr>
                        <tr class="datarow" colspan="4">
                            <td class="loading"></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div id="Summary_tab" class="TabContent uninitialized">
                <div class="SortsAndFilters">
                    <span class="form-label">Time Period:</span>
                    <select class="form-select" id="TimePeriod">
                        <option value="day">Past Day</option>
                        <option value="week">Past Week</option>
                        <option value="month">Past Month</option>
                        <option value="year">Past Year</option>
                    </select>
                </div>
                <div class="ColumnsContainer">
                    <div class="RobuxColumn divider-right">
                        <div>
                            <h2 class="light">
                                    <span class="robux">&nbsp;</span>
                                    <span>Robux</span>
                                    <img src="//images.rbxcdn.com/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="The principal currency of Robloxia, which Builders Club members receive a daily allowance of to live a comfortable life of leisure. For this and other benefits, join Builders Club! Alternately, you can purchase ROBUX using our secure payment system." />
                            </h2>
                            <table class="table" cellpadding="0" cellspacing="0" border="0" >
                            <tr class="table-header">
                                <th class="Categories first">Categories</th>
                                <th class="Credit">Credit</th>
                            </tr>
                            <tr >
                                <td class="Categories">Builders Club Stipend</td>
                                <td class="Credit BCStipend">&nbsp;</td>
                            </tr>
                            <tr >
                                <td class="Categories">Builders Club Stipend Bonus</td>
                                <td class="Credit BCStipendBonus">&nbsp;</td>
                            </tr>
                            <tr >
                                <td class="Categories">Sale of Goods</td>
                                <td class="Credit R_SaleOfGoods">&nbsp;</td>
                            </tr>
                            <tr >
                                <td class="Categories">Currency Purchase</td>
                                <td class="Credit CurrencyPurchase">&nbsp;</td>
                            </tr>
                            
                           
                            <tr >
                                <td class="Categories">Trade System Trades</td>
                                <td class="Credit R_TradeSystem">&nbsp;</td>
                            </tr> 
                           
                            
                            <tr>
                                <td class="Categories">Promoted Page Conversion Revenue</td>
                                <td class="Credit PromotedPageConversionRevenue">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="Categories">Game Page Conversion Revenue</td>
                                <td class="Credit GamePageConversionRevenue">&nbsp;</td>
                            </tr>
                            
                            <tr  >
                                <td class="Categories">Pending Sales <img src="//images.rbxcdn.com/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="As an anti fraud precaution, revenue from certain transactions, such as Game Pass sales, is held for a short period of time before being released to the seller." /></td>
                                <td class="Credit R_PendingSales">&nbsp;</td>
                            </tr> 
                            
                            <tr>
                                <td class="Categories">Group Payouts</td>
                                <td class="Credit R_GroupPayouts">&nbsp;</td>
                            </tr>
                            
                            <tr class="total">
                                <td colspan="3"><h2 class="light">TOTAL&nbsp;</h2><span class="robux money">(xxx)</span></td>
                            </tr>
                            </table>
                        </div>
                    </div>
                    <div class="TicketsColumn">
                        <div>
                            <h2 class="light">
                                <span class="tickets">&nbsp;</span>
                                <span>Tickets</span>
                                <img src="//images.rbxcdn.com/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="Similar to tickets won in an arcade - play the game, earn tickets, and get rewarded with fabulous prizes. Tickets are granted to citizens who help expand and improve Robloxia. The best way to get tickets is to attract a lot of visitors to a cool place that you create. You can also get the daily login bonus just by showing up!" />
                            </h2>
                            <table class="table" cellpadding="0" cellspacing="0" border="0" >
                            <tr class="table-header">
                                <th class="Categories first">Categories</th>
                                <th class="Credit">Credit</th>
                            </tr>
                            <tr >
                                <td class="Categories">Login Award</td>
                                <td class="Credit LoginAward">&nbsp;</td>
                            </tr>
                            <tr >
                                <td class="Categories">Place Traffic Award</td>
                                <td class="Credit PlaceTraffic">&nbsp;</td>
                            </tr>
                            <tr >
                                <td class="Categories">Sale of Goods</td>
                                <td class="Credit T_SaleOfGoods">&nbsp;</td>
                            </tr>
                            

                            <tr  >
                                <td class="Categories">Pending Sales <img src="//images.rbxcdn.com/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="As an anti fraud precaution, revenue from certain transactions, such as Game Pass sales, is held for a short period of time before being released to the seller." /></td>
                                <td class="Credit T_PendingSales">&nbsp;</td>
                            </tr> 
                                
                            
                            <tr>
                                <td class="Categories">Group Payouts</td>
                                <td class="Credit T_GroupPayouts">&nbsp;</td>
                            </tr>
                            
                            <tr class="total">
                                <td colspan="3"><h2 class="light">TOTAL&nbsp;</h2><span class="tickets money">(xxx)</span></td>
                            </tr>

                            </table>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
            
            <div id="TradeCurrency_tab" class="TabContent ">
                  

<div id="TradeCurrencyContainer">
    <div class="LeftColumn">
        
            
        <div class="TradingDashboard">
            <div class="menu-area divider-right">
                <div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_CurrencyTradePane">
                        <a  class="btn-medium btn-primary TradeCurrencyModalBtn">Trade</a>
                    </div>
                
                <div class="tab-item tab-item-selected" contentid="RobuxPositions">My <span class="robux">&nbsp;</span> Positions</div>
                <div class="tab-item" contentid="TicketsPositions">My <span class="tickets">&nbsp;</span> Positions</div>
                <div class="tab-item" contentid="RobuxTradeHistory"><span class="robux">&nbsp;</span> Trade History</div>
                <div class="tab-item" contentid="TicketsTradeHistory"><span class="tickets">&nbsp;</span> Trade History</div>
            </div>
            <div class="content-area divider-right">
                <div id="RobuxPositions" class="tab-content tab-content-selected">
                    

<div class="OpenOffers">
    <div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_OpenOffers_OpenOffersUpdatePanel">
	
            
            
                    <div class="NoResults">You do not have any open ROBUX trades.</div>
                
            <div class="FooterPager">
                <span id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_OpenOffers_OpenOffersDataPager_Footer"><a disabled="disabled">First</a>&nbsp;<a disabled="disabled">Previous</a>&nbsp;<a disabled="disabled">Next</a>&nbsp;<a disabled="disabled">Last</a>&nbsp;</span>
            </div>
        
</div>
</div>
                </div>
                <div id="TicketsPositions" class="tab-content">
                    

<div class="OpenBids">
    <div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_OpenBids_OpenBidsUpdatePanel">
	
            
            
                    <div class="NoResults">You do not have any open Ticket trades.</div>
                
            <div class="FooterPager">
                <span id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_OpenBids_OpenBidsDataPager_Footer"><a disabled="disabled">First</a>&nbsp;<a disabled="disabled">Previous</a>&nbsp;<a disabled="disabled">Next</a>&nbsp;<a disabled="disabled">Last</a>&nbsp;</span>
            </div>
        
</div>
</div>
                </div>
                <div id="RobuxTradeHistory" class="tab-content">
                    

<div class="TradeHistory">
    <div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_MyTradesOffers_MyTradesOffersUpdatePanel">
	
            
            
                    <table class="TradeHistoryContent table" cellpadding="0" cellspacing="0" border="0">
                        <tr class="table-header">
                            <th class="first trade">Trade</th>
                            <th class="rate">Rate</th>
                            <th class="date">Date</th>
                        </tr>
                        
                    <tr class="TileGroup">
                        
                    <td class="trade">3 R$ for 56 Tx</td>
                    <td class="rate">18.666</td>
                    <td class="date">12/23/15</td>
                
                    </tr>
                
                    </table>
                
            <div class="FooterPager">
                <span id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_MyTradesOffers_MyTradesOffersDataPager_Footer"><a disabled="disabled">First</a>&nbsp;<a disabled="disabled">Previous</a>&nbsp;<span>1</span>&nbsp;<a disabled="disabled">Next</a>&nbsp;<a disabled="disabled">Last</a>&nbsp;</span>
            </div>
        
</div>
</div>
                </div>
                <div id="TicketsTradeHistory" class="tab-content">
                    

<div class="TradeHistory">
    <div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_MyTradesBids_MyTradesBidsUpdatePanel">
	
            
            
                    <table class="TradeHistoryContent table" cellpadding="0" cellspacing="0" border="0">
                        <tr class="table-header">
                            <th class="first trade">Trade</th>
                            <th class="rate">Rate</th>
                            <th class="date">Date</th>
                        </tr>
                        
                    <tr class="TileGroup">
                        
                    <td class="trade">180 Tx for 9 R$</td>
                    <td class="rate">20.000</td>
                    <td class="date">12/22/15</td>
                
                    </tr>
                
                    <tr class="TileGroup">
                        
                    <td class="trade">196 Tx for 10 R$</td>
                    <td class="rate">19.600</td>
                    <td class="date">10/3/15</td>
                
                    </tr>
                
                    </table>
                
            <div class="FooterPager">
                <span id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_MyTradesBids_MyTradesBidsDataPager_Footer"><a disabled="disabled">First</a>&nbsp;<a disabled="disabled">Previous</a>&nbsp;<span>1</span>&nbsp;<a disabled="disabled">Next</a>&nbsp;<a disabled="disabled">Last</a>&nbsp;</span>
            </div>
        
</div>
</div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="RightColumn">
        <div id="CurrencyQuotePane">
            

<div class="CurrencyQuote">
    <div class="column">
        <div class="form-label">Pair: </div><div>BUX/TIX</div>
        <div class="form-label padding-top">Spread: </div><div>-1</div>
    </div>
    <div class="column">
        <div class="form-label">Rate: </div><div>18.866/18.864</div>
        <div class="form-label padding-top">High/Low: </div><div>740.00/0.0035</div>
    </div>
</div>
            <div class="clear"></div>
        </div>
        <div id="CurrencyBidsPane">
            

<div class="CurrencyBids padding-top">
    <span class="form-label">Available Tickets:</span>
    
            <div class="CurrencyBid">
                7,339 @ 18.866:1
            </div>
        
            <div class="AlternatingCurrencyBid">
                152,738 @ 18.861:1
            </div>
        
            <div class="CurrencyBid">
                1,886 @ 18.860:1
            </div>
        
            <div class="AlternatingCurrencyBid">
                3,772 @ 18.860:1
            </div>
        
            <div class="CurrencyBid">
                7,128 @ 18.857:1
            </div>
        
            <div class="AlternatingCurrencyBid">
                7,258 @ 18.851:1
            </div>
        
            <div class="CurrencyBid">
                87,157 @ 18.844:1
            </div>
        
            <div class="AlternatingCurrencyBid">
                4,956 @ 18.844:1
            </div>
        
            <div class="CurrencyBid">
                716 @ 18.842:1
            </div>
        
            <div class="AlternatingCurrencyBid">
                7,932 @ 18.840:1
            </div>
        
            <div class="CurrencyBid">
                339 @ 18.833:1
            </div>
        
            <div class="AlternatingCurrencyBid">
                113 @ 18.833:1
            </div>
        
            <div class="CurrencyBid">
                113 @ 18.833:1
            </div>
        
            <div class="AlternatingCurrencyBid">
                27,665 @ 18.832:1
            </div>
        
            <div class="CurrencyBid">
                395,760 @ 18.832:1
            </div>
        
            <div class="AlternatingCurrencyBid">
                410,974 @ 18.828:1
            </div>
        
            <div class="CurrencyBid">
                10,600 @ 18.827:1
            </div>
        
            <div class="AlternatingCurrencyBid">
                546 @ 18.827:1
            </div>
        
            <div class="CurrencyBid">
                5,290 @ 18.825:1
            </div>
        
            <div class="AlternatingCurrencyBid">
                371,937 @ 18.825:1
            </div>
        
    
</div>
        </div>
        <div id="CurrencyOffersPane">
            

<div class="CurrencyOffers padding-top">
    <span class="form-label">Available Robux:</span>
    
            <div class="CurrencyOffer">
                <span class="notranslate">6,181</span> @ 1:18.864
            </div>
        
            <div class="AlternatingCurrencyOffer">
                <span class="notranslate">250,421</span> @ 1:18.874
            </div>
        
            <div class="CurrencyOffer">
                <span class="notranslate">9,086</span> @ 1:18.884
            </div>
        
            <div class="AlternatingCurrencyOffer">
                <span class="notranslate">141</span> @ 1:18.893
            </div>
        
            <div class="CurrencyOffer">
                <span class="notranslate">95</span> @ 1:18.894
            </div>
        
            <div class="AlternatingCurrencyOffer">
                <span class="notranslate">69</span> @ 1:18.898
            </div>
        
            <div class="CurrencyOffer">
                <span class="notranslate">10</span> @ 1:18.900
            </div>
        
            <div class="AlternatingCurrencyOffer">
                <span class="notranslate">7,562</span> @ 1:18.989
            </div>
        
            <div class="CurrencyOffer">
                <span class="notranslate">1,394</span> @ 1:18.999
            </div>
        
            <div class="AlternatingCurrencyOffer">
                <span class="notranslate">38,995</span> @ 1:18.999
            </div>
        
            <div class="CurrencyOffer">
                <span class="notranslate">20</span> @ 1:19.000
            </div>
        
            <div class="AlternatingCurrencyOffer">
                <span class="notranslate">20</span> @ 1:19.000
            </div>
        
            <div class="CurrencyOffer">
                <span class="notranslate">20</span> @ 1:19.000
            </div>
        
            <div class="AlternatingCurrencyOffer">
                <span class="notranslate">20</span> @ 1:19.000
            </div>
        
            <div class="CurrencyOffer">
                <span class="notranslate">20</span> @ 1:19.000
            </div>
        
            <div class="AlternatingCurrencyOffer">
                <span class="notranslate">12</span> @ 1:19.000
            </div>
        
            <div class="CurrencyOffer">
                <span class="notranslate">11</span> @ 1:19.000
            </div>
        
            <div class="AlternatingCurrencyOffer">
                <span class="notranslate">16</span> @ 1:19.000
            </div>
        
            <div class="CurrencyOffer">
                <span class="notranslate">3</span> @ 1:19.000
            </div>
        
            <div class="AlternatingCurrencyOffer">
                <span class="notranslate">2</span> @ 1:19.000
            </div>
        
    
</div>

        </div>
    </div>
                    
    <div id="TradeCurrencyModal" class="PurchaseModal text">
        <div class="titleBar" style="text-align:center">Trade Currency</div>
        <div class="PurchaseModalBody">
            <div class="PurchaseModalMessage" style="height:auto;">
                <div class="validation-summary-errors" style="display:none">
                    Market Orders must be at least <span class="tickets">20</span>.
                </div>
                <div class="CurrencyTradeDetails" >
                    <div class="CurrencyTradeDetail">
                        <span class="form-label">Trade Type: </span>
                        <span class="MarketOrderRadioButton"><input id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_MarketOrderRadioButton" type="radio" name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$OrderType" value="MarketOrderRadioButton" checked="checked" /><label for="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_MarketOrderRadioButton">Market Order</label></span>
                        <span class="info-tool-tip tooltip" 
                            title="A market order is a buy or sell order to be executed immediately at current market prices. As long as there are willing sellers and buyers, a market order will be filled." >&nbsp;</span>
                            
                        <span class="LimitOrderRadioButton"><input id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_LimitOrderRadioButton" type="radio" name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$OrderType" value="LimitOrderRadioButton" /><label for="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_LimitOrderRadioButton">Limit Order</label></span>
                        <span class="info-tool-tip tooltip" 
                            title="A limit order is an order to buy at no more (or sell at no less) than a specific price. This gives you some control over the price at which the trade is executed, but may prevent the order from being executed." >&nbsp;</span>
                    </div>
                    <div class="CurrencyTradeDetail">
                        <span class="form-label">What I'll give:</span>
                        <input name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$HaveAmountTextBoxRestyle" type="text" maxlength="9" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountTextBoxRestyle" tabindex="1" class="TradeBox HaveAmountTextBox text-box text-box-medium" autocomplete="off" />
                        <select name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$HaveCurrencyDropDownList" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveCurrencyDropDownList" class="HaveCurrencyDropDownList form-select">
	<option value="Tickets">Tickets</option>
	<option value="Robux">Robux</option>

</select>
                        <span id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle" class="HaveAmountRequiredFieldValidator" style="color:Red;display:none;"></span>
                        <span id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle" style="color:Red;visibility:hidden;"></span>&nbsp;
                    </div>
                    <div id="LimitOrder" class="CurrencyTradeDetail" style="display: none;">
                        <span class="form-label">What I want:</span>
                        <input name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$WantAmountTextBox" type="text" maxlength="9" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountTextBox" tabindex="2" class="TradeBox WantAmountTextBox text-box text-box-medium" autocomplete="off" />
                            <span id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle" class="WantAmountRequiredFieldValidator" style="color:Red;display:none;">!</span>
                        &nbsp;
                        <select name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$WantCurrencyDropDownList" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantCurrencyDropDownList" class="WantCurrencyDropDownList form-select">
	<option value="Robux">Robux</option>
	<option value="Tickets">Tickets</option>

</select>
                    </div>
                    <div id="SplitTrades" class="CurrencyTradeDetail" style="display: none;">
                        <span class="form-label">Allow Split Trades: </span>
                        <input id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_AllowSplitTradesCheckBox" type="checkbox" name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$AllowSplitTradesCheckBox" checked="checked" tabindex="3" />
                    </div>
                    <div id="MarketOrder" class="CurrencyTradeDetail">
                        <span class="form-label">What I'll get:</span>
                        <span id="EstimatedTrade"></span><span class="estimated invisible">&nbsp;(estimated)</span>
                    </div>
                </div>
                                        
            </div>
            <div class="PurchaseModalButtonContainer">
                <a onclick="return Roblox.TradeCurrency.confirmTrade();" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_SubmitTradeButton" tabindex="4" class="btn-medium btn-primary translate" href="javascript:__doPostBack(&#39;ctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$SubmitTradeButton&#39;,&#39;&#39;)">Trade</a>&nbsp;
                <a class="btn-medium btn-negative" onclick="$.modal.close();">
                    Cancel
                </a>
            </div>
            <div class="PurchaseModalFooter">
                Your money will be held for safe-keeping until either the trade executes or you cancel your position.
            </div>
        </div>
    </div>
</div>

<div id="FundsPopupBux" class="modalPopup PurchaseModal trade-currency">
    <div class="titleBar">
        Insufficient Funds
    </div>
    <div class="PurchaseModalBody">
        <div class="PurchaseModalMessage">
            <div>
                <p>
                    You need
                    
                    more ROBUX to execute this trade.</p>
            </div>
        </div>
        <div class="PurchaseModalButtonContainer">
            <a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_CurrencyPurchaseButton" class="btn-medium btn-primary" href="javascript:__doPostBack(&#39;ctl00$ctl00$cphRoblox$cphMyRobloxContent$ctl00$CurrencyPurchaseButton&#39;,&#39;&#39;)">Buy Robux</a>
            <a class="btn-medium btn-negative" onclick="Roblox.TradeCurrency.FundsPopupBux.close()">Cancel</a>
        </div>
        <div class="PurchaseModalFooter"></div>
    </div>
</div>
                
<div id="FundsPopupTix" class="modalPopup PurchaseModal trade-currency">
    <div class="titleBar">
        Insufficient Funds
    </div>
    <div class="PurchaseModalBody">
        <div class="PurchaseModalMessage">
            <div>
                <p>You need
                    -66
                    more Tickets to execute this trade.</p>
            </div>
        </div>
        <div class="PurchaseModalButtonContainer">
            <a class="btn-medium btn-negative" onclick="Roblox.TradeCurrency.FundsPopupBux.close()">Cancel</a>
        </div>
        <div class="PurchaseModalFooter"></div>
    </div>
</div>


<script type="text/javascript">
$(function() {
    if (typeof Roblox === "undefined") {
	    Roblox = {};
    }
    if (typeof Roblox.TradeCurrency === "undefined") {
	    Roblox.TradeCurrency = {};
    }
    Roblox.TradeCurrency.Resources = {
        unableToEstimate: 'Unable to estimate at this time.'
    };
    
});

</script>

            </div>
            
                <div id="TradeItems_tab" class="TabContent uninitialized">
                    <div class="status-confirm" style="display:none;"></div>   
                    <div class="SortsAndFilters">
                    <div class="TradeType">
                        <span class="form-label">Trade Type:</span>
                        <select class="form-select" id="TradeItems_TradeType">
                            <option value="inbound">Inbound</option>
                            <option value="outbound">Outbound</option>
                            <option value="completed">Completed</option>
                            <option value="inactive">Inactive</option>
                        </select>
						<a href="" target="_blank" id="trade-help-link" class="text-link">How do I send a trade?</a>
                        <span class="tool-tip" style="display:none;" data-js-trade-write-disabled ><img src="/images/UI/img-tail-left.png" class="left"/>Trading is currently disabled. Trades can be viewed, but they may not be changed. Please check back later.</span>
                    </div>
                    <div style="clear:both;float:none;"></div>
                </div>
                <div class="TradeItemsContainer">
                    <table class="table" cellpadding="0" cellspacing="0" border="0">
                        <tr class="table-header">
                            <th class="Date first">Date</th>
                            <th class="Expires">Expires</th>
                            <th class="TradePartner">Trade Partner</th>
                            <th class="Status">Status</th>
                            <th class="Action">Action</th>
                        </tr>
                        <tr class="datarow" colspan="4">
                            <td class="loading"></td>
                        </tr>
                    </table>
                </div>
                    <table class="template table">
                        <tr class="datarow">
                            <td class="Date" data-se="trade-date"></td>
                            <td class="Expires" data-se="trade-expires"></td>
                            <td class="TradePartner" data-se="trade-tradepartner"></td>
                            <td class="Status" data-se="trade-status"></td>
                            <td class="Action" data-se="trade-Action"></td>
                        </tr>
                    </table>
                </div>
                <div TradeUpdater></div>
            
                <div id="Promotion_tab" class="TabContent uninitialized">
                    


<div class="info">
    When you share a promotional link to any ROBLOX page and new players come to ROBLOX from your link, you earn 5% of every purchase they make. You can use the Share button on any place page to generate a link that includes your promoter code.<br /><br />
    You can also create promotional links with this link generator:
</div>
<div>
    <div class="form-label">ROBLOX url:</div>
    <input type="text" id="LinkGeneratorInput" data-rbx-id="<?php echo htmlspecialchars((string) $currentUserId, ENT_QUOTES, 'UTF-8'); ?>" />
</div>
<div>
    <div class="form-label">Promotion link:</div>
    <div id="LinkGeneratorOutput">Please link to a page on www.roblox.local!</div>
</div>
<ul class="nav nav-pills">
    <li class="active" data-rbx-time="hourly"><a>Hourly</a></li>
    <li data-rbx-time="daily"><a>Daily</a></li>
    <li data-rbx-time="monthly"><a>Monthly</a></li>
</ul>
<div id="PromotionAcquisitionsContainer">
    <div class="separator-horizontal"></div>
    <h2>
        New Visitors
        <img src="//images.rbxcdn.com/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="Number of people who clicked on your links who have never been on ROBLOX before." />
    </h2>
    <div class="separator-horizontal"></div>
    
    <div data-rbx-organic-acquisition-type="0" data-rbx-time="hourly" data-rbx-series-names='["Visitors"]' data-rbx-series-units='["Visitors"]'>
        <div id="new-visitors-hourly" class="stats-chart loading"></div>
        <div id="new-visitors-hourly-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-rbx-organic-acquisition-type="0" data-rbx-time="daily" data-rbx-series-names='["Visitors"]' data-rbx-series-units='["Visitors"]'>
        <div id="new-visitors-daily" class="stats-chart loading"></div>
        <div id="new-visitors-daily-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-rbx-organic-acquisition-type="0" data-rbx-time="monthly" data-rbx-series-names='["Visitors"]' data-rbx-series-units='["Visitors"]'>
        <div id="new-visitors-monthly" class="stats-chart loading"></div>
        <div id="new-visitors-monthly-legend" class="stats-legend"></div>
    </div>
</div>
<div id="PromotionConversionsContainer">
    <div class="separator-horizontal"></div>
    <h2>
        Signups
        <img src="//images.rbxcdn.com/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="Number of new visitors from your links who signed up." />
    </h2>
    <div class="separator-horizontal"></div>

    <div data-rbx-organic-acquisition-type="1" data-rbx-time="hourly" data-rbx-series-names='["Signups"]' data-rbx-series-units='["Signups"]'>
        <div id="signups-hourly" class="stats-chart loading"></div>
        <div id="signups-hourly-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-rbx-organic-acquisition-type="1" data-rbx-time="daily" data-rbx-series-names='["Signups"]' data-rbx-series-units='["Signups"]'>
        <div id="signups-daily" class="stats-chart loading"></div>
        <div id="signups-daily-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-rbx-organic-acquisition-type="1" data-rbx-time="monthly" data-rbx-series-names='["Signups"]' data-rbx-series-units='["Signups"]'>
        <div id="signups-monthly" class="stats-chart loading"></div>
        <div id="signups-monthly-legend" class="stats-legend"></div>
    </div>
</div>
<div id="PromotionRevenueContainer">
    <div class="separator-horizontal"></div>
    <h2>
        Promotional Revenue
        <img src="//images.rbxcdn.com/d3246f1ece35d773099f876a31a38e5a.png" class="tooltip" title="ROBUX earned through your promotional links." />
    </h2>
    <div class="separator-horizontal"></div>

    <div data-rbx-organic-acquisition-type="3" data-rbx-time="hourly" data-rbx-series-names='["Revenue"]' data-rbx-series-units='["R$"]'>
        <div id="revenue-hourly" class="stats-chart loading"></div>
        <div id="revenue-hourly-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-rbx-organic-acquisition-type="3" data-rbx-time="daily" data-rbx-series-names='["Revenue"]' data-rbx-series-units='["R$"]'>
        <div id="revenue-daily" class="stats-chart loading"></div>
        <div id="revenue-daily-legend" class="stats-legend"></div>
    </div>

    <div style="display:none" data-rbx-organic-acquisition-type="3" data-rbx-time="monthly" data-rbx-series-names='["Revenue"]' data-rbx-series-units='["R$"]'>
        <div id="revenue-monthly" class="stats-chart loading"></div>
        <div id="revenue-monthly-legend" class="stats-legend"></div>
    </div>
</div>
<div class="separator-horizontal"></div>

<table class="table" id="promotion-data-table">
    <tr class="table-header">
        <th class="first">Time</th>
        <th class="acquisitions" data-rbx-organic-acquisition-type="0">New Visitors</th>
        <th class="conversions" data-rbx-organic-acquisition-type="1">Signups</th>
        <th class="revenue" data-rbx-organic-acquisition-type="3">Promotional Revenue (R$)</th>
    </tr>
</table>
                </div>
            
            <div id="AdContainer" class="Ads_WideSkyscraper">
                

<div style="width: 160px; " class="abp adp-gpt-container">
    <span id='3434323032363537' class="GPTAd skyscraper" data-js-adtype="gptAd">
    </span>
        <div class="ad-annotations " style="width: 160px">
            <span class="ad-identification">
                Advertisement
            </span>
                <a class="BadAdButton" href="//www.roblox.local/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
        </div>
    <script type="text/javascript">
        googletag.cmd.push(function () {
            if (typeof Roblox.AdsHelper !== "undefined" && typeof Roblox.AdsHelper.toggleAdsSlot !== "undefined") {
                Roblox.AdsHelper.toggleAdsSlot("", "3434323032363537");
            } else {
                googletag.display("3434323032363537");
            }
        });
    </script>
</div>


            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

</div>
<div id="TradeRequest" class="modalPopup unifiedModal smallModal TraderSystemRobux" UserID="<?php echo htmlspecialchars((string) $currentUserId, ENT_QUOTES, 'UTF-8'); ?>" style="display:none;">
	
    <div style="height:38px;padding-top:2px;">
        <span>Trade Request</span>
    </div>
    <div class="simplemodal-close">
        <a class="ImageButton closeBtnCircle_20h" data-se="trade-close"></a>
    </div>
    <div class="unifiedModalContent" style="min-height:385px;width:584px; padding:5px;margin: 0 auto;" >
        <div class="GenericModalErrorMessage status-error" style="display:none;"></div>
        <div class="LeftContentContainer" >
            <div class="roblox-avatar-image" data-user-id="" data-image-size="medium" data-se="trade-partner-avatar"></div>
            <p class="TradeRequestText"></p>
            <p class="TradeExpiration">Expires <span id="TradeRequestExpiration" data-se="trade-expire"></span></p>
        </div>
        <div style="padding-left: 5px; float:left;display:inline;">
            <div class="OfferContainer" >
                <div class="OfferList"  list-id="OfferList0">
		            <div class="OfferHeaderWrapper">
			            <h3 class="OfferHeader">ITEMS YOU WILL GIVE</h3>
                        <div class="OfferValueContainer">
                            Value: <img class="RBXImg" width="18" height="12" src="/images/Icons/img-robux.png" alt="RBX" /><span class="OfferValue" data-se="trade-give-value">0</span>
		                </div>
		            </div>                   
                    <div class="OfferItems"></div>
                </div>
                    <img src="/images/trade_divider2.jpg" style="margin-left:-5px;" alt="" /> 
                <div class="OfferList"  list-id="OfferList1">
		            <div class="OfferHeaderWrapper">
			            <h3 class="OfferHeader">ITEMS YOU WILL RECEIVE</h3>
                        <div class="OfferValueContainer">
                            Value: <img class="RBXImg" width="18" height="12" src="/images/Icons/img-robux.png" alt="RBX" /><span class="OfferValue" data-se="trade-receive-value">0</span>
		                </div>
		            </div>
                    <div class="OfferItems"></div>  
                    <div class="FeeNoteContainer"><div class="FeeNote" data-js="feenote" style="display:none;"><span class="Asterisk" >*</span> A  30% fee was taken from the amount.</div></div>
		        </div> 
	        </div> 
            <div style="clear:both;"></div>
        </div>  
        <div style="clear:both;"></div>
        <div class="ActionButtonContainer"  style="height:50px;display:none">
            <div id="ButtonAcceptTrade" class="btn-large btn-neutral" data-se="trade-accept">Accept</div>
            <div id="ButtonCounterTrade" class="btn-large btn-neutral" data-se="trade-counter">Counter</div>
            <div id="ButtonDeclineTrade" class="btn-large btn-negative" data-se="trade-decline">Decline</div>
            <div style="clear:both;"></div>
        </div>
        <div class="ReviewButtonContainer" style="height:50px;display:none">
            <div roblox-ok class="btn-large btn-neutral" data-se="trade-ok">OK</div>
            <div id="ButtonCancelTrade" class="btn-large btn-negative" data-se="trade-cancel">Cancel</div>
            <div style="clear:both;"></div>
        </div>
        <div class="ViewButtonContainer" style="height:50px;display:none">
            <div roblox-ok class="btn-large btn-neutral" data-se="trade-ok">OK</div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
    </div>
    <script type="text/javascript">
        $(function () {
         Roblox.Trade.TradeRequestModal.initialize(4, true, 0.3);
        });
    </script>

</div>
<div id="InventoryItemTemplate" style="display:none;">
    

<div class="InventoryItemContainerOuter"  data-se="trade-item" >
    <div fieldname="InventoryItemSize">
		<div templateid="DefaultContent" class="InventoryItemContainerInner">
            <div class="HeaderButtonPlaceHolder"></div>
            <div class="InventoryNameWrapper">
			    <a class="InventoryItemLink" href="#" target="_blank"><div class="InventoryItemName"></div></a>
            </div>
			<div class="ItemLinkDiv">
				<img class="ItemImg" alt="Item Image" />
			</div>
			<div class="HoverContent">
				<div><span class="ItemInfoLabel">Avg. Price:</span><img class="RBXImg" width="14" height="9" src="/images/cssspecific/rbx2/head_bux.png" alt="RBX" /><span class="ItemInfoData InventoryItemAveragePrice"></span></div>
				<div><span class="ItemInfoLabel">Orig. Price:</span><img class="RBXImg" width="14" height="9" src="/images/cssspecific/rbx2/head_bux.png" alt="RBX"/><span class="ItemInfoData InventoryItemOriginalPrice"></span></div>
				<div><span class="ItemInfoLabel">Serial # :&nbsp;</span><span class="InventoryItemSerial"></span><span class="ItemInfoLabel" style="margin:0 2px 0 2px;">/</span><span class="SerialNumberTotal"></span></div>
				<div class="FooterButtonPlaceHolder"></div>
            </div>
            <img class="BuildersClubOverlay">
		</div>
	</div>	
</div>

</div>
<div id="BlankTemplate" style="display:none;">
    <div class="BlankItem LargeInventoryItem"  style="padding-right:4px;">
    </div>
</div>
<div id="RobuxTemplate" style="display:none;">
    <div class="RobuxTradeRequestItem" >
        <div class="RobuxAmountWrapper" style="">
			<div><span class="RobuxAmount" ></span><span class="RobuxItemAsterisk" >*</span> </div>
            <div>Robux</div>
        </div>
		<div style="margin:auto; width:51px;">
			<img class="ItemImg"src="/images/ROBUX.jpg" />
        </div>
    </div>
</div>
<div missing-user-asset-template style="display:none;">
    <div class="LargeInventoryItem MissingItemContainer">
        <div class="MissingItem " style="padding-right:4px;"></div>
    </div>
</div>
<div deleted-user-asset-template style="display:none;">
    <div class="LargeInventoryItem MissingItemContainer">
        <div class="MissingItem Deleted" style="padding-right:4px;"></div>
    </div>
</div>


    
    


                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
        </div>
        
            <div id="Footer" class="footer-container">
    <div class="FooterNav">
        <a href="//www.roblox.local/info/Privacy.aspx">Privacy Policy</a>
        &nbsp;|&nbsp;
        <a href="//corp.roblox.local/advertise-on-roblox" class="roblox-interstitial">Advertise with Us</a>
        &nbsp;|&nbsp;
        <a href="//corp.roblox.local/press" class="roblox-interstitial">Press</a>
        &nbsp;|&nbsp;
        <a href="//corp.roblox.local/contact-us" class="roblox-interstitial">Contact Us</a>
        &nbsp;|&nbsp;
            <a href="//corp.roblox.local/about" class="roblox-interstitial">About Us</a>
&nbsp;|&nbsp;        <a href="//blog.roblox.local">Blog</a>
        &nbsp;|&nbsp;
            <a href="//corp.roblox.local/careers" class="roblox-interstitial">Jobs</a>
&nbsp;|&nbsp;        <a href="//corp.roblox.local/parents" class="roblox-interstitial">Parents</a>
    </div>
    <div class="legal">
            <div class="left">
                <div id="a15b1695-1a5a-49a9-94f0-9cd25ae6c3b2">
    <a href="//privacy.truste.com/privacy-seal/Roblox-Corporation/validation?rid=2428aa2a-f278-4b6d-9095-98c4a2954215" title="TRUSTe Children privacy certification" target="_blank">
        <img style="border: none" src="//privacy-policy.truste.com/privacy-seal/Roblox-Corporation/seal?rid=2428aa2a-f278-4b6d-9095-98c4a2954215" width="133" height="45" alt="TRUSTe Children privacy certification"/>
    </a>
</div>
            </div>
            <div class="right">
                <p class="Legalese">
    ROBLOX, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a href="//corp.roblox.local/" ref="footer-smallabout" class="roblox-interstitial">ROBLOX Corporation</a>, ©2015. Patents pending.
    ROBLOX is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, and no resemblance to the products of these companies is intended.
    Use of this site signifies your acceptance of the <a href="//www.roblox.local/info/terms-of-service" ref="footer-terms">Terms and Conditions</a>.
</p>
            </div>
        <div class="clear"></div>
    </div>

</div>
        
        </div></div>
    </div>
    

<div id="usernotifications-data-model"
     class="hidden"
     data-notificationsdomain="https://notifications.roblox.local/"
     data-notificationstestinterval="5000"
     data-notificationsmaxconnectiontime="43200000">
</div>
        <script type="text/javascript">
            function urchinTracker() { };
            GoogleAnalyticsReplaceUrchinWithGAJS = true;
        </script>
    

    
<script type="text/javascript">
//<![CDATA[
var Page_Validators =  new Array(document.getElementById("ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle"), document.getElementById("ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle"), document.getElementById("ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle"));
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
var ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle = document.all ? document.all["ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle"] : document.getElementById("ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle");
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle.controltovalidate = "ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountTextBoxRestyle";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle.focusOnError = "t";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle.display = "Dynamic";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle.validationGroup = "TradeCurrencyRestyle";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle.initialvalue = "";
var ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle = document.all ? document.all["ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle"] : document.getElementById("ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle");
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle.controltovalidate = "ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountTextBoxRestyle";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle.focusOnError = "t";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle.validationGroup = "TradeCurrencyRestyle";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle.evaluationfunction = "RangeValidatorEvaluateIsValid";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle.maximumvalue = "999999999";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle.minimumvalue = "1";
var ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle = document.all ? document.all["ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle"] : document.getElementById("ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle");
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle.controltovalidate = "ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountTextBox";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle.focusOnError = "t";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle.errormessage = "!";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle.display = "Dynamic";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle.enabled = "False";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle.validationGroup = "TradeCurrencyRestyle";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle.initialvalue = "";
//]]>
</script>


<script type="text/javascript">
//<![CDATA[

var Page_ValidationActive = false;
if (typeof(ValidatorOnLoad) == "function") {
    ValidatorOnLoad();
}

function ValidatorOnSubmit() {
    if (Page_ValidationActive) {
        return ValidatorCommonOnSubmit();
    }
    else {
        return true;
    }
}
        WebForm_AutoFocus('ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountTextBoxRestyle');
document.getElementById('ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle').dispose = function() {
    Array.remove(Page_Validators, document.getElementById('ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRequiredFieldValidatorRestyle'));
}

document.getElementById('ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle').dispose = function() {
    Array.remove(Page_Validators, document.getElementById('ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_HaveAmountRangeValidatorRestyle'));
}

document.getElementById('ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle').dispose = function() {
    Array.remove(Page_Validators, document.getElementById('ctl00_ctl00_cphRoblox_cphMyRobloxContent_ctl00_WantAmountRequiredFieldValidatorRestyle'));
}
//]]>
</script>
</form>
        <script type="text/javascript">
        var Roblox = Roblox || {};
        Roblox.ChatTemplates = {
            ChatBarTemplate: "chat-bar",
            AbuseReportTemplate: "chat-abuse-report",
            DialogTemplate: "chat-dialog",
            FriendsSelectionTemplate: "chat-friends-selection",
            GroupDialogTemplate: "chat-group-dialog",
            NewGroupTemplate: "chat-new-group",
            DialogMinimizeTemplate: "chat-dialog-minimize"
        };
        Roblox.Chat = {
            SoundFile: "//www.roblox.local/Chat/sound/chatsound.mp3"
        };
        Roblox.Party = {};
        Roblox.Party.SetGoogleAnalyticsCallback = function () {
            RobloxLaunch._GoogleAnalyticsCallback = function() { var isInsideRobloxIDE = 'website'; if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) { isInsideRobloxIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideRobloxIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Play']);EventTracker.fireEvent('GameLaunchAttempt_Win32', 'GameLaunchAttempt_Win32_Plugin'); if (typeof Roblox.GamePlayEvents != 'undefined') { Roblox.GamePlayEvents.SendClientStartAttempt(null, play_placeId); }  }; 
        };

    </script>


<div id="chat-container" class="chat chat-container"
     ng-modules="robloxApp, chat"
     ng-controller="chatController"
     ng-class="{'collapsed': chatLibrary.chatLayout.collapsed}"
     ng-cloak>
    <!--chatLibrary.deviceType === deviceType.TABLET && ,
                'tablet-inapp': chatLibrary.tabletInApp-->
<div id="chat-data-model"
     class="hidden"
     chat-data
     chat-view-model="chatViewModel"
     chat-library="chatLibrary"
     data-userid="<?php echo htmlspecialchars((string) $currentUserId, ENT_QUOTES, 'UTF-8'); ?>"
     data-domain="roblox.local"
     data-gamespagelink="//www.roblox.local/games"
     data-chatdomain="https://chat.roblox.local"
     data-numberofmembersforpartychrome="6"
     data-avatarheadshotsmultigetlimit="100"
     data-userpresencemultigetlimit="100"
     data-intervalofchangetitleforpartychrome="500"
     data-spinner="//images.rbxcdn.com/4bed93c91f909002b1f17f05c0ce13d1.gif"
     data-notificationsdomain="https://notifications.roblox.local/"
     data-devicetype="Computer"
     data-inapp=false
     data-smallerchatenabled=true
     data-cleanpartyfromconversationenabled=false>
</div>
    <div chat-bar></div>
    <script type="text/ng-template" id="chat-bar">
    <div id="chat-main" class="chat-main"
         ng-class="{'chat-main-empty': chatLibrary.chatLayout.chatLandingEnabled}" ng-cloak>
        <div id="chat-header"
             class="chat-windows-header chat-header">
            <div class="chat-header-label"
                 ng-click="toggleChatContainer()">
                <span class="rbx-font-bold chat-header-title">Chat & Party</span>
            </div>
            <div class="chat-header-action">
                <span class="rbx-notification-red"
                      ng-show="chatLibrary.chatLayout.collapsed && chatViewModel.conversationCount > 0"
                      ng-cloak>{{chatViewModel.conversationCount}}</span>
                <span id="chat-group-create"
                      class="rbx-icon-chat-group-create"
                      ng-hide="chatLibrary.chatLayout.collapsed || chatLibrary.chatLayout.errorMaskEnable || chatLibrary.chatLayout.chatLandingEnabled || chatLibrary.chatLayout.pageDataLoading"
                      ng-click="launchDialog(newGroup.layoutId)"
                      data-toggle="tooltip"
                      title="Add at least 2 people to create chat group"
                      ng-cloak></span>
            </div>
        </div>
        <div id="chat-body"
             class="chat-body"
             ng-hide="chatLibrary.chatLayout.errorMaskEnable || chatLibrary.chatLayout.pageDataLoading"
             ng-if="!chatLibrary.chatLayout.chatLandingEnabled">
            <div class="chat-search"
                 ng-class="{'chat-search-focus': chatLibrary.chatLayout.searchFocus}">
                <input type="text"
                       placeholder="Search"
                       class="chat-search-input"
                       ng-model="chatViewModel.searchTerm"
                       ng-focus="chatLibrary.chatLayout.searchFocus = true" />
                <span class="rbx-icon-chat-search"></span>
                <span class="rbx-icon-chat-cancel-search"
                      ng-click="cancelSearch()"></span>
            </div>
            <button id="chat-group-create-btn"
                    type="button"
                    class="btn rbx-btn-control-xs"
                    ng-click="launchDialog(newGroup.layoutId)"
                    title="Add at least 2 people to create chat group"
                    ng-cloak>
                <span>Create Chat Group</span>
            </button>
            <div id="chat-friend-list" class="rbx-scrollbar chat-friend-list" lazy-load>
                <ul id="chat-friends" class="chat-friends">
                    <li ng-repeat="chatUser in chatUserDict | orderList: chatLibrary.chatLayoutIds | filter : {name: chatViewModel.searchTerm}"
                        class="chat-friend">
                        <div ng-click="launchDialog(chatUser.layoutId)"
                             ng-if="chatUser.dialogType === dialogType.CHAT && chatUser.isConversation"
                             class="chat-friend-container">
                            <div class="chat-friend-avatar">
                                <img ng-src="{{chatLibrary.friendsDict[chatUser.displayUserId].AvatarThumb.Url}}"
                                     class="chat-avatar"
                                     thumbnail="chatLibrary.friendsDict[chatUser.displayUserId].AvatarThumb"
                                     image-retry
                                     ng-if="chatUser.isConversation">
                                <div class="chat-friend-status" ng-class="userPresenceTypes[chatLibrary.friendsDict[chatUser.displayUserId].UserPresenceType]['className']"></div>
                            </div>
                            <div class="chat-friend-info">
                                <span class="rbx-text-overflow chat-friend-name" ng-if="chatUser.isConversation">{{chatUser.name}}</span>
                                <span class="rbx-font-sm chat-friend-message"
                                      ng-class="{'rbx-font-bold': chatUser.HasUnreadMessages}"
                                      ng-bind-html="chatUser.DisplayMessage.Content"
                                      ng-if="chatUser.DisplayMessage"></span>
                            </div>
                        </div>

                        <div ng-click="launchDialog(chatUser.layoutId)"
                             ng-if="chatUser.dialogType === dialogType.GROUPCHAT && chatUser.isConversation"
                             class="chat-friend-container chat-friend-groups">
                            <div class="chat-friend-avatar">
                                <ul class="chat-avatar-groups">
                                    <li ng-repeat="userId in chatUser.userIds | limitTo : 4"
                                        class="chat-avatar">
                                        <img ng-src="{{chatLibrary.friendsDict[userId].AvatarThumb.Url}}"
                                             thumbnail="chatLibrary.friendsDict[userId].AvatarThumb"
                                             image-retry>
                                    </li>
                                </ul>
                            </div>
                            <div class="chat-friend-info">
                                <span class="rbx-text-overflow chat-friend-name">{{chatUser.name}}</span>
                                <span class="rbx-font-sm chat-friend-message"
                                      ng-class="{'rbx-font-bold': chatUser.HasUnreadMessages}"
                                      ng-bind-html="chatUser.DisplayMessage.Content"
                                      ng-if="chatUser.DisplayMessage"></span>
                            </div>
                        </div>

                        <div ng-click="launchDialog(chatUser.layoutId)"
                             ng-if="chatUser.dialogType === dialogType.PARTY && chatUser.isConversation"
                             class="chat-friend-container">
                            <div class="chat-friend-avatar chat-party-avatar">
                                <span class="rbx-icon-chat-party-avatar"></span>
                            </div>
                            <div class="chat-friend-info">
                                <span class="rbx-text-overflow chat-friend-name">{{chatUser.name}}</span>
                                <span class="rbx-font-sm chat-friend-message"
                                      ng-class="{'rbx-font-bold': chatUser.HasUnreadMessages}"
                                      ng-bind-html="chatUser.DisplayMessage.Content"
                                      ng-if="chatUser.DisplayMessage"></span>
                            </div>
                        </div>
                        <div ng-click="launchDialog(chatUser.layoutId)"
                             ng-if="chatUser.dialogType === dialogType.PENDINGPARTY  && chatUser.isConversation"
                             class="chat-friend-container chat-pending-party">
                            <div class="chat-friend-avatar">
                                <ul class="chat-avatar-groups">
                                    <li ng-repeat="userId in chatUser.userIds | limitTo : 3"
                                        class="chat-avatar">
                                        <img ng-src="{{chatLibrary.friendsDict[userId].AvatarThumb.Url}}"
                                             thumbnail="chatLibrary.friendsDict[userId].AvatarThumb"
                                             image-retry>
                                    </li>
                                    <li class="chat-avatar-party-icon">
                                        <span class="rbx-icon-chat-party-avatar"></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="chat-friend-info">
                                <span class="rbx-text-overflow chat-friend-name">{{chatUser.name}}</span>
                                <span class="rbx-font-sm chat-friend-message party-pending-msg"
                                      ng-if="chatUser.incomingPartyInvite">{{chatUser.pendingPartyMsg}}</span>
                                <span class="rbx-font-sm chat-friend-message"
                                      ng-class="{'rbx-font-bold': chatUser.HasUnreadMessages}"
                                      ng-bind-html="chatUser.DisplayMessage.Content"
                                      ng-if="chatUser.DisplayMessage && !chatUser.incomingPartyInvite"></span>
                            </div>
                        </div>
                        <div ng-click="launchDialog(chatUser.layoutId)"
                             ng-if="!chatUser.isConversation"
                             class="chat-friend-container">
                            <div class="chat-friend-avatar">
                                <img ng-src="{{chatUser.AvatarThumb.Url}}" class="chat-avatar"
                                     thumbnail="chatUser.AvatarThumb"
                                     image-retry>
                                <div class="chat-friend-status" ng-class="userPresenceTypes[chatUser.UserPresenceType]['className']"></div>

                            </div>
                            <div class="chat-friend-info">
                                <span class="rbx-text-overflow chat-friend-name">{{chatUser.name}}</span>
                                <span class="rbx-font-xs chat-friend-message">{{userPresenceTypes[chatUser.UserPresenceType].title}}</span>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="chat-loading loading-bottom"
                     ng-show="chatLibrary.chatLayout.isChatLoading">
                    <img ng-src="{{chatLibrary.spinner}}" alt="loading ...">
                </div>
            </div>
        </div>
        <div id="chat-disconnect"
             class="chat-disconnect"
             ng-show="chatLibrary.chatLayout.errorMaskEnable || chatLibrary.chatLayout.pageDataLoading"
             ng-cloak>
            <p ng-show="chatLibrary.chatLayout.errorMaskEnable">Trying to connect ...</p>
            <img ng-src="{{chatLibrary.spinner}}" alt="loading ...">
        </div>
        <div id="chat-empty-list"
             class="chat-disconnect"
             ng-hide="chatLibrary.chatLayout.errorMaskEnable"
             ng-if="chatLibrary.chatLayout.chatLandingEnabled">
            <span class="rbx-icon-chat-friends"></span>
            <p class="rbx-lead">Make friends to start chatting and partying!</p>
        </div>
    </div>
</script>
    <div id="dialogs"
         class="dialogs"
         ng-controller="dialogsController">
        <div dialog
             id="{{chatLayoutId}}"
             dialog-data="chatUserDict[chatLayoutId]"
             chat-library="chatLibrary"
             close-dialog="closeDialog(chatLayoutId)"
             send-invite="sendInvite(chatLayoutId)"
             ng-repeat="chatLayoutId in chatLibrary.layoutIdList"></div>
        <script type="text/ng-template" id="chat-abuse-report">
    <div class="dialog-report-container"
         ng-show="dialogLayout.isConfirmationOn">
        <div class="dialog-report-content">
            <h4>Continue to report?</h4>
            <button id="chat-abuse-report-btn"
                    class="rbx-btn-primary-xs"
                    ng-click="abuseReport(null, true)">
                Report
            </button>

            <button class="rbx-btn-control-xs"
                    ng-click="dialogLayout.isConfirmationOn = false">
                Cancel
            </button>
        </div>
    </div>
</script>

        <script type="text/ng-template" id="chat-friends-selection">
    <div class="chat-friends-container">
        <div class="chat-search"
             ng-class="{'group-select-container' : dialogData.selectedUserIds.length > 0}"
             group-select>
            <div class="group-select">
                <ul class="group-select-friends">
                    <li class="rbx-font-sm group-select-friend"
                        ng-repeat="userId in dialogData.selectedUserIds">
                        {{dialogData.selectedUsersDict[userId].Username}}
                        <span class="rbx-icon-chat-cancel-search group-select-cancel" ng-click="selectFriends(userId)"></span>
                    </li>
                </ul>
                <input type="text"
                       placeholder="Search"
                       class="chat-search-input"
                       focus-me="chatLibrary.inApp ? false: true"
                       ng-model="dialogData.searchTerm" />
            </div>
            <button id="friends-selection-btn"
                    class="rbx-btn-secondary-xs friends-invite-btn"
                    ng-disabled="dialogLayout.inviteBtnDisabled"
                    ng-click="sendInvite()">
                Invite
            </button>
        </div>

        <div id="scrollbar_friend_{{dialogData.dialogType}}_{{dialogData.layoutId}}" class="rbx-scrollbar chat-friend-list"
             friends-lazy-load>
            <ul class="chat-friends">
                <li ng-repeat="friend in chatLibrary.friendsDict | orderList: dialogData.friendIds  | filter: {Username: dialogData.searchTerm}"
                    class="chat-friend">
                    <div class="chat-friend-container chat-friend-select"
                         ng-click="selectFriends(friend.Id)">
                        <div class="chat-friend-avatar">
                            <img ng-src="{{friend.AvatarThumb.Url}}"
                                 thumbnail="friend.AvatarThumb"
                                 image-retry
                                 class="chat-avatar">
                            <div class="chat-friend-status" ng-class="userPresenceTypes[friend.UserPresenceType]['className']"></div>
                        </div>
                        <div class="chat-friend-info">
                            <span class="chat-friend-name">{{friend.Username}}</span>
                            <span class="rbx-font-sm chat-friend-message">{{userPresenceTypes[friend.UserPresenceType].title}}</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</script>
        <script type="text/ng-template" id="chat-dialog">
    <div id="dialog-container" class="dialog-container"
         ng-class="{'group-has-banner': dialogData.isPartyExisted || dialogData.partyInGame,
                    'dialog-party': dialogData.dialogType == dialogType.PARTY,
                    'collapsed': dialogLayout.collapsed && chatLibrary.deviceType === deviceType.COMPUTER,
                    'active': dialogLayout.active && !dialogLayout.hasFocus}"
         ng-controller="dialogController"
         ng-focus="focusDialog()">
        <div class="dialog-main">
            <div class="chat-windows-header dialog-header">
                <div class="chat-header-label">
                    <span class="rbx-icon-chat-party-label"
                          ng-show="dialogData.dialogType == dialogType.PARTY"
                          title="Party"
                          ng-cloak></span>
                    <span id="chat-title"
                          class="rbx-font-bold chat-header-title dialog-header-title" 
                          ng-click="toggleDialogContainer()" 
                          ng-if="dialogData.dialogType != dialogType.PARTY">
                        <a class="rbx-font-bold"
                           ng-click="linkToProfile($event)"
                           ng-href="{{dialogData.nameLink}}">{{dialogData.name}}</a>
                    </span>
                    <span id="party-title"
                          class="rbx-font-bold chat-header-title dialog-header-title"
                          ng-click="toggleDialogContainer()" 
                          ng-if="dialogData.dialogType == dialogType.PARTY">{{dialogData.name}}
                    </span>
                </div>
                <div class="chat-header-action"
                     chat-setting>
                    <span class="rbx-icon-chat-close"
                          ng-click="closeDialog(dialogData.layoutId)"
                          data-toggle="tooltip"
                          title="Close"></span>
                    <span class="rbx-icon-chat-setting"
                          data-toggle="popover"
                          data-bind="group-settings-{{dialogData.Id}}"
                          ng-hide="(dialogLayout.collapsed && chatLibrary.deviceType === deviceType.COMPUTER) || chatLibrary.chatLayout.errorMaskEnable"></span>
                    <div class="rbx-popover-content" data-toggle="group-settings-{{dialogData.Id}}">
                        <ul class="rbx-dropdown-menu" role="menu">
                            <li>
                                <a id="abuse-report"
                                   ng-click="abuseReport(dialogData.userIds[0], false)">Report Abuse</a>
                            </li>
                            <li>
                                <a id="leave-group"
                                   ng-click="leaveGroup()"
                                   ng-if="dialogData.dialogType === dialogType.PARTY">Leave Party</a>
                            </li>
                        </ul>
                    </div>
                    <span id="create-party"
                          class="rbx-icon-chat-party-label"
                          ng-click="sendInvite(dialogData.layoutId)"
                          data-toggle="tooltip"
                          title="Play Together"
                          ng-hide="dialogData.party || (dialogLayout.collapsed && chatLibrary.deviceType === deviceType.COMPUTER)  || chatLibrary.chatLayout.errorMaskEnable"></span>
                </div>
            </div>

            <div id="dialog-member-header"
                 class="dialog-member-header"
                 ng-show="dialogData.isPartyExisted && !dialogData.partyInGame">
                <ul class="group-members">
                    <li class="group-member"
                        title="{{chatLibrary.friendsDict[userId].Username}}{{dialogData.membersDict[userId].statusTooltip}}"
                        ng-repeat="userId in dialogData.userIds">
                        <img ng-src="{{chatLibrary.friendsDict[userId].AvatarThumb.Url}}"
                             thumbnail="chatLibrary.friendsDict[userId].AvatarThumb"
                             image-retry
                             alt="{{chatLibrary.friendsDict[userId].Username}}"
                             class="group-member-avatar"
                             ng-class="{'group-leader': dialogData.membersDict[userId].memberStatus === memberStatus.LEADER,
                                        'group-pending':dialogData.membersDict[userId].memberStatus === memberStatus.PENDING}">
                    </li>
                </ul>
                <a id="find-game"
                   class="rbx-btn-primary-xs"
                   ng-show="dialogData.dialogType === dialogType.PARTY && dialogData.party.LeaderUser.Id === chatLibrary.userId"
                   ng-href="{{chatLibrary.gamesPageLink}}">Find Game</a>
                <a id="join-party"
                   class="rbx-btn-control-xs"
                   ng-hide="dialogData.dialogType === dialogType.PARTY || !dialogData.party"
                   ng-click="joinParty()">
                    Join Party
                </a>
            </div>

            <div id="party-ingame-header"
                 class="party-ingame-header"
                 ng-show="dialogData.dialogType === dialogType.PARTY && dialogData.isPartyExisted && dialogData.partyInGame">
                <img ng-src="{{dialogData.placeThumbnail.Url}}"
                     thumbnail="dialogData.placeThumbnail" image-retry
                     class="party-ingame-thumbnail">
                <div class="party-ingame-label"
                     ng-class="{'party-ingame-member': chatLibrary.userId !== dialogData.party.LeaderUser.Id}">
                    <span class="rbx-font-sm">Playing</span>
                    <span class="rbx-font-sm rbx-font-bold party-ingame-name">{{dialogData.party.GameName}}</span>
                </div>
                <a id="join-game"
                   class="rbx-btn-control-xs"
                   ng-hide="chatLibrary.userId === dialogData.party.LeaderUser.Id"
                   ng-click="joinGame()">
                    Join Game
                </a>
            </div>
            <div id="scrollbar_{{dialogData.dialogType}}_{{dialogData.layoutId}}"
                 class="rbx-scrollbar dialog-body"
                 dialog-lazy-load>
                <ul class="dialog-messages">
                    <li class="dialog-message-container"
                        ng-repeat="message in dialogData.ChatMessages | reverse"
                        ng-class="{'message-inbound': message.SenderUserId != chatLibrary.userId && !message.isSystemMessage,
                                    'system-message': message.isSystemMessage}">
                        <div class="rbx-font-sm dialog-message dialog-triangle dialog-message-content"
                             ng-bind-html="message.Content" 
                             ng-hide="message.isSystemMessage"></div>
                        <div class="rbx-font-xs dialog-sending" ng-show="message.sendingMessage">Sending...</div>
                        <div class="rbx-font-xs rbx-text-danger dialog-sending" ng-show="message.sendMessageHasError"
                             ng-bind="message.error || 'Error'"></div>
                        <span class="system-message-content"
                              ng-show="message.isSystemMessage"
                              ng-bind-html="message.Content"></span>
                    </li>
                </ul>
            </div>
            <div class="chat-loading loading-top"
                 ng-show="dialogLayout.isChatLoading">
                <img ng-src="{{chatLibrary.spinner}}" alt="loading ...">
            </div>
            <div class="dialog-input-container">
                <textarea id="dialog-input"
                          msd-elastic
                          focus-me="{{dialogLayout.focusMeEnabled}}"
                          ng-focus="toggleDialogFocusStatus(true)"
                          ng-blur="toggleDialogFocusStatus(false)"
                          placeholder="Send a message ..."
                          ng-model="dialogData.messageForSend"
                          key-press-enter="sendMessage()"
                          class="dialog-input"
                          maxlength="{{dialogLayout.limitCharacterCount}}"
                          ng-disabled="chatLibrary.chatLayout.errorMaskEnable"></textarea>
            </div>

            <div abuse-report></div>
        </div>
    </div>
</script>
        <script type="text/ng-template" id="chat-group-dialog">
    <div class="dialog-container group-dialog"
         ng-class="{'group-has-banner': dialogData.isPartyExisted || dialogData.partyInGame,
                    'dialog-party': dialogData.dialogType == dialogType.PARTY,
                    'collapsed': dialogLayout.collapsed && chatLibrary.deviceType === deviceType.COMPUTER,
                    'active': dialogLayout.active && !dialogLayout.hasFocus}"
         ng-controller="dialogController">
        <div class="dialog-main" 
             ng-hide="dialogLayout.isConfirmationOn || dialogLayout.lookUpMembers || dialogData.addMoreFriends">
            <div class="chat-windows-header dialog-header">
                <div class="chat-header-label">
                    <span class="rbx-icon-chat-party-label"
                          ng-show="dialogData.dialogType == dialogType.PARTY"
                          title="Party"
                          ng-cloak></span>
                    <span class="rbx-icon-chat-group-label"
                          ng-show="dialogData.dialogType != dialogType.PARTY"
                          title="Group Chat"
                          ng-cloak></span>
                    <span id="party-title"
                          class="rbx-font-bold dialog-header-title"
                          title="{{dialogData.partyName}}"
                          ng-click="toggleDialogContainer()" ng-if="dialogData.dialogType == dialogType.PARTY">{{dialogData.partyName}}</span>
                    <span id="group-chat-title"
                          class="rbx-font-bold dialog-header-title"
                          title="{{dialogData.groupName}}"
                          ng-click="toggleDialogContainer()" ng-if="dialogData.dialogType != dialogType.PARTY">{{dialogData.groupName}}</span>
                </div>
                <div class="chat-header-action"
                     chat-setting>
                    <span class="rbx-icon-chat-close"
                          ng-click="closeDialog(dialogData.layoutId)"
                          data-toggle="tooltip"
                          title="Close"></span>
                    <span class="rbx-icon-chat-setting"
                          data-toggle="popover"
                          data-bind="group-settings-{{dialogData.Id}}"
                          ng-hide="(dialogLayout.collapsed && chatLibrary.deviceType === deviceType.COMPUTER) || chatLibrary.chatLayout.errorMaskEnable"></span>
                    <div class="rbx-popover-content" data-toggle="group-settings-{{dialogData.Id}}">
                        <ul class="rbx-dropdown-menu" role="menu">
                            <li><a id="add-friends" ng-click="addFriends()">Add Friends</a></li>
                            <li><a id="view-participants" ng-click="viewParticipants()">View Participants</a></li>
                            <li>
                                <a id="leave-group" ng-click="leaveGroup()" ng-bind="dialogData.dialogType === dialogType.PARTY ? 'Leave Party' : 'Leave Group'"></a>
                            </li>
                        </ul>
                    </div>
                    <span id="create-party"
                          class="rbx-icon-chat-party-label"
                          ng-click="sendInvite(dialogData.layoutId)"
                          data-toggle="tooltip"
                          title="Play Together"
                          ng-hide="dialogData.party || (dialogLayout.collapsed && chatLibrary.deviceType === deviceType.COMPUTER) || chatLibrary.chatLayout.errorMaskEnable"></span>
                </div>
            </div>
            <div id="dialog-member-header"
                 class="dialog-member-header"
                 ng-show="dialogData.isPartyExisted && (!dialogData.partyInGame || dialogData.dialogType === dialogType.PENDINGPARTY)">
                <ul class="group-members">
                    <li class="group-member"
                        title="{{chatLibrary.friendsDict[userId].Username}}{{dialogData.membersDict[userId].statusTooltip}}"
                        ng-repeat="userId in dialogData.userIds | limitTo: dialogLayout.limitMemberDisplay">
                        <img ng-src="{{chatLibrary.friendsDict[userId].AvatarThumb.Url}}"
                             thumbnail="chatLibrary.friendsDict[userId].AvatarThumb"
                             image-retry
                             alt="{{chatLibrary.friendsDict[userId].Username}}"
                             class="group-member-avatar"
                             ng-class="{'group-leader': dialogData.membersDict[userId].memberStatus === memberStatus.LEADER,
                                        'group-pending':dialogData.membersDict[userId].memberStatus === memberStatus.PENDING}">
                    </li>
                    <li ng-show="dialogData.userIds.length === (dialogLayout.limitMemberDisplay + 1)"
                        title="{{chatLibrary.friendsDict[dialogData.userIds[dialogLayout.limitMemberDisplay]].Username}}{{dialogData.membersDict[dialogData.userIds[dialogLayout.limitMemberDisplay]].statusTooltip}}"
                        class="group-member">
                        <img ng-src="{{chatLibrary.friendsDict[dialogData.userIds[dialogLayout.limitMemberDisplay]].AvatarThumb.Url}}"
                             thumbnail="chatLibrary.friendsDict[dialogData.userIds[dialogLayout.limitMemberDisplay]].AvatarThumb"
                             image-retry
                             alt="{{chatLibrary.friendsDict[dialogData.userIds[dialogLayout.limitMemberDisplay]].Username}}"
                             class="group-member-avatar"
                             ng-class="{'group-pending': dialogData.membersDict[dialogData.userIds[dialogLayout.limitMemberDisplay]].memberStatus === memberStatus.PENDING}">
                    </li>
                    <li ng-show="dialogData.userIds.length > (dialogLayout.limitMemberDisplay + 1)"
                        ng-click="dialogLayout.lookUpMembers = !dialogLayout.lookUpMembers"
                        class="group-member group-member-plus"
                        ng-cloak>+{{dialogData.userIds.length - dialogLayout.limitMemberDisplay}}</li>
                </ul>
                <a id="find-game"
                   class="rbx-btn-primary-xs"
                   ng-show="dialogData.dialogType === dialogType.PARTY && dialogData.party.LeaderUser.Id === chatLibrary.userId && !chatLibrary.inApp"
                   ng-href="{{chatLibrary.gamesPageLink}}">Find Game</a>
                <a id="join-party"
                   class="rbx-btn-control-xs"
                   ng-hide="dialogData.dialogType === dialogType.PARTY || !dialogData.party"
                   ng-click="joinParty()">
                    Join Party
                </a>
            </div>

            <div id="party-ingame-header"
                 class="party-ingame-header"
                 ng-show="dialogData.dialogType === dialogType.PARTY && dialogData.isPartyExisted && dialogData.partyInGame">
                <img ng-src="{{dialogData.placeThumbnail.Url}}"
                     thumbnail="dialogData.placeThumbnail" image-retry
                     class="party-ingame-thumbnail">
                <div class="party-ingame-label"
                     ng-class="{'party-ingame-member': chatLibrary.userId !== dialogData.party.LeaderUser.Id}">
                    <span class="rbx-font-sm">Playing</span>
                    <span class="rbx-font-sm rbx-font-bold party-ingame-name">{{dialogData.party.GameName}}</span>
                </div>
                <a id="join-game"
                   class="rbx-btn-control-xs"
                   ng-hide="chatLibrary.userId === dialogData.party.LeaderUser.Id"
                   ng-click="joinGame()">
                    Join Game
                </a>
            </div>
            <div id="scrollbar_{{dialogData.dialogType}}_{{dialogData.layoutId}}"
                 class="rbx-scrollbar dialog-body"
                 dialog-lazy-load>
                <ul class="dialog-messages">
                    <li class="dialog-message-container"
                        ng-repeat="message in dialogData.ChatMessages | reverse"
                        ng-class="{'message-inbound': message.SenderUserId != chatLibrary.userId && !message.isSystemMessage,
                                    'system-message': message.isSystemMessage}">
                        <a ng-href="{{chatLibrary.friendsDict[message.SenderUserId].UserProfileLink}}"
                           ng-hide="message.isSystemMessage">
                            <img ng-if="message.SenderUserId != chatLibrary.userId"
                                 ng-src="{{chatLibrary.friendsDict[message.SenderUserId].AvatarThumb.Url}}"
                                 thumbnail="chatLibrary.friendsDict[message.SenderUserId].AvatarThumb"
                                 image-retry
                                 class="dialog-message-avatar">
                        </a>
                        <div class="dialog-message dialog-triangle" 
                             ng-hide="message.isSystemMessage">
                            <span ng-if="chatLibrary.friendsDict[message.SenderUserId] && message.SenderUserId != chatLibrary.userId"
                                  class="rbx-font-xs dialog-message-author">{{chatLibrary.friendsDict[message.SenderUserId].Username}}</span>
                            <span class="rbx-font-sm dialog-message-content" ng-bind-html="message.Content"></span>
                        </div>
                        <div class="rbx-font-xs dialog-sending" ng-show="message.sendingMessage">Sending...</div>
                        <div class="rbx-font-xs rbx-text-danger dialog-sending" ng-show="message.sendMessageHasError"
                             ng-bind="message.error || 'Error'"></div>
                        <span class="system-message-content"
                              ng-show="message.isSystemMessage"
                              ng-bind-html="message.Content"></span>
                    </li>
                </ul>
            </div>
            <div class="chat-loading loading-top"
                 ng-show="dialogLayout.isChatLoading">
                <img ng-src="{{chatLibrary.spinner}}" alt="loading ...">
            </div>
            <div class="dialog-input-container">
                <textarea msd-elastic
                          focus-me="{{dialogLayout.focusMeEnabled}}"
                          ng-focus="toggleDialogFocusStatus(true)"
                          ng-blur="toggleDialogFocusStatus(false)"
                          placeholder="Send a message ..."
                          ng-model="dialogData.messageForSend"
                          key-press-enter="sendMessage()"
                          class="dialog-input"
                          maxlength="{{dialogLayout.limitCharacterCount}}"
                          ng-disabled="chatLibrary.chatLayout.errorMaskEnable"></textarea>
            </div>
        </div>
        <div class="group-members-container"
             ng-show="dialogLayout.lookUpMembers">
            <div class="chat-windows-header">
                <span class="rbx-icon-chat-arrow-left"
                      ng-click="viewParticipants()"></span>
                <span class="rbx-font-bold">Participants</span>
            </div>
            <div id="group-members" class="rbx-scrollbar chat-friend-list">
                <ul class="chat-friends">
                    <li ng-repeat="userId in dialogData.userIds"
                        class="chat-friend">
                        <div class="chat-friend-container">
                            <div class="chat-friend-avatar">
                                <img ng-src="{{chatLibrary.friendsDict[userId].AvatarThumb.Url}}"
                                     thumbnail="chatLibrary.friendsDict[userId].AvatarThumb"
                                     image-retry
                                     class="chat-avatar">
                                <div class="chat-friend-status" ng-class="userPresenceTypes[chatLibrary.friendsDict[userId].UserPresenceType]['className']"></div>
                            </div>
                            <div class="chat-friend-info">
                                <span class="rbx-text-overflow chat-friend-name">{{chatLibrary.friendsDict[userId].Username}}</span>
                                <span class="rbx-font-sm rbx-text-notes" ng-show="dialogData.party && dialogData.membersDict[userId].memberStatus == memberStatus.LEADER">Leader</span>
                                <span class="rbx-font-sm rbx-text-notes" ng-show="dialogData.party && dialogData.membersDict[userId].memberStatus == memberStatus.MEMBER">In party</span>
                            </div>
                            <div class="group-member-action">
                                <span ng-if="chatLibrary.userId != userId && chatLibrary.userId === dialogData.party.LeaderUser.Id && dialogData.dialogType == dialogType.PARTY"
                                      class="rbx-icon-chat-remove"
                                      ng-click="removeMember(userId)"></span>
                                <span ng-if="chatLibrary.userId != userId && chatLibrary.userId === dialogData.InitiatorUser.Id && dialogData.dialogType != dialogType.PARTY"
                                      class="rbx-icon-chat-remove"
                                      ng-click="removeMember(userId)"></span>
                                <span class="rbx-icon-chat-report-person"
                                      ng-if="chatLibrary.userId != userId"
                                      ng-click="abuseReport(userId, false)"></span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div abuse-report></div>
        <div class="group-friends-container"
             ng-show="dialogData.addMoreFriends">
            <div class="chat-windows-header">
                <div class="chat-header-label">
                    <span class="rbx-icon-chat-arrow-left"
                          ng-click="dialogData.addMoreFriends = false"></span>
                    <span class="rbx-font-bold">Add Friends</span>
                    <span class="rbx-font-bold"
                          ng-class="{'group-overload': dialogLayout.isMembersOverloaded}">
                        ({{(dialogData.numberOfSelected)}}/{{chatLibrary.quotaOfPartyMembers}})
                    </span>
                </div>
            </div>
            <div friends-selection></div>
        </div>
    </div>
</script>

        <div dialog
             id="{{newGroup.layoutId}}"
             dialog-data="newGroup"
             chat-library="chatLibrary"
             close-dialog="closeDialog('newGroup')"
             send-invite="sendInvite(newGroup.layoutId)"
             ng-if="newGroup"></div>
        <script type="text/ng-template" id="chat-new-group">
    <div class="dialog-container group-create-container"
         ng-controller="friendsController">
        <div class="chat-windows-header">
            <div class="chat-header-title">
                <span class="rbx-font-bold">{{dialogLayout.title}}</span>
                <span class="rbx-font-bold"
                      ng-class="{'group-overload': dialogLayout.isMembersOverloaded}">
                    ({{(dialogData.numberOfSelected)}}/{{chatLibrary.quotaOfPartyMembers}})
                </span>
            </div>
            <div class="chat-header-action">
                <span class="rbx-icon-chat-close"
                      ng-click="closeDialog(dialogData.layoutId)"
                      data-toggle="tooltip"
                      title="Close"></span>
            </div>
        </div>
        <div friends-selection></div>
    </div>
</script>
        <script type="text/ng-template" id="chat-dialog-minimize">
    <div id="dialogs-minimize-container"
         class="dialogs-minimize-container"
         ng-show="hasMinimizedDialogs"
         data-toggle="popover"
         data-bind="dialogs">
        <span class="rbx-icon-chat-minimize"></span>
        <span class="minimize-count">{{chatLibrary.minimizedDialogIdList.length}}</span>
        <div class="rbx-popover-content" data-toggle="dialogs">
            <ul class="rbx-dropdown-menu minimize-list" role="menu">
                <li ng-repeat="dialogLayoutId in chatLibrary.minimizedDialogIdList"
                    class="minimize-item"
                    id="{{dialogLayoutId}}"
                    minimize-item>
                    <a class="rbx-text-overflow minimize-title">
                        <span>
                            {{chatLibrary.minimizedDialogData[dialogLayoutId].name}}
                        </span>
                    </a>
                    <span class="rbx-icon-chat-cancel-search minimize-close"></span>
                </li>
            </ul>
        </div>
    </div>
</script>


        <div id="dialogs-minimize"
             class="dialogs-minimize"
             dialog-minimize
             chat-library="chatLibrary">
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            // Because of placeLauncher.js, has to add this stupid global "play_placeId"
            $(document).on('Roblox.Chat.PartyInGame', function (event, args) {
                play_placeId = args.placeId;
            });
        });
    </script>

</div>
    
    

    <div id="InstallationInstructions" style="display:none;">
        <div class="ph-installinstructions">
            <div class="ph-modal-header">
                <span class="rbx-icon-close simplemodal-close"></span>
                <h3>Thanks for playing ROBLOX</h3>
            </div>
            <div class="ph-installinstructions-body">
                    <div class="ph-install-step ph-installinstructions-step1-of4">
                        <h1>1</h1>
                        <p class="larger-font-size">Click RobloxPlayerLauncher.exe to run the ROBLOX installer, which just downloaded via your web browser.</p>
                        <img width="230" height="180" src="//images.rbxcdn.com/8b0052e4ff81d8e14f19faff2a22fcf7.png" />
                    </div>
                    <div class="ph-install-step ph-installinstructions-step2-of4">
                        <h1>2</h1>
                        <p class="larger-font-size">Click <strong>Run</strong> when prompted by your computer to begin the installation process.</p>
                        <img width="230" height="180" src="//images.rbxcdn.com/4a3f96d30df0f7879abde4ed837446c6.png" />
                    </div>
                    <div class="ph-install-step ph-installinstructions-step3-of4">
                        <h1>3</h1>
                        <p class="larger-font-size">Click <strong>Ok</strong> once you've successfully installed ROBLOX.</p>
                        <img width="230" height="180" src="//images.rbxcdn.com/6e23e4971ee146e719fb1abcb1d67d59.png" />
                    </div>
                    <div class="ph-install-step ph-installinstructions-step4-of4">
                        <h1>4</h1>
                        <p class="larger-font-size">After installation, click <strong>Play</strong> below to join the action!</p>
                        <div class="VisitButton VisitButtonContinuePH">
                            <a class="btn rbx-btn-primary-lg disabled">Play</a>
                        </div>
                    </div>
            </div>
            <div class="rbx-font-sm rbx-text-notes">
                The ROBLOX installer should download shortly. If it doesn’t, <a href="#" onclick="Roblox.ProtocolHandlerClientInterface.startDownload(); return false;">start the download now.</a>
            </div>
        </div>
    </div>
    <div class="InstallInstructionsImage" data-modalwidth="970" style="display:none;"></div>



<div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
<iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>

<script type='text/javascript' src='//js.rbxcdn.com/6b9fed5e91a508780b95c302464d62ef.js.gzip'></script>

<script type="text/javascript">
    Roblox.Client._skip = null;
    Roblox.Client._CLSID = '76D50904-6780-4c8b-8986-1A7EE0B1716D';
    Roblox.Client._installHost = 'setup.roblox.local';
    Roblox.Client.ImplementsProxy = true;
    Roblox.Client._silentModeEnabled = true;
    Roblox.Client._bringAppToFrontEnabled = false;
    Roblox.Client._currentPluginVersion = '';
    Roblox.Client._eventStreamLoggingEnabled = true;

        
        Roblox.Client._installSuccess = function() {
            if(GoogleAnalyticsEvents){
                GoogleAnalyticsEvents.ViewVirtual('InstallSuccess');
                GoogleAnalyticsEvents.FireEvent(['Plugin','Install Success']);
                if (Roblox.Client._eventStreamLoggingEnabled && typeof Roblox.GamePlayEvents != "undefined") {
                    Roblox.GamePlayEvents.SendInstallSuccess(Roblox.Client._launchMode, play_placeId);
                }
            }
        }
        
            
        if ((window.chrome || window.safari) && window.location.hash == '#chromeInstall') {
            window.location.hash = '';
            var continuation = '(' + $.cookie('chromeInstall') + ')';
            play_placeId = $.cookie('chromeInstallPlaceId');
            Roblox.GamePlayEvents.lastContext = $.cookie('chromeInstallLaunchMode');
            $.cookie('chromeInstallPlaceId', null);
            $.cookie('chromeInstallLaunchMode', null);
            $.cookie('chromeInstall', null);
            RobloxLaunch._GoogleAnalyticsCallback = function() { var isInsideRobloxIDE = 'website'; if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) { isInsideRobloxIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideRobloxIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Play']);EventTracker.fireEvent('GameLaunchAttempt_Win32', 'GameLaunchAttempt_Win32_Plugin'); if (typeof Roblox.GamePlayEvents != 'undefined') { Roblox.GamePlayEvents.SendClientStartAttempt(null, play_placeId); }  }; 
            Roblox.Client.ResumeTimer(eval(continuation));
        }
        
</script>


<div id="PlaceLauncherStatusPanel" style="display:none;width:300px"
     data-new-plugin-events-enabled="True"
     data-event-stream-for-plugin-enabled="True"
     data-event-stream-for-protocol-enabled="True"
     data-is-protocol-handler-launch-enabled="True"
     data-is-user-logged-in="True"
     data-os-name="Windows"
     data-protocol-name-for-client="roblox-player"
     data-protocol-name-for-studio="roblox-studio"
     data-protocol-url-includes-launchtime="true"
     data-protocol-detection-enabled="true">
    <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
        <div id="Spinner" class="Spinner" style="padding:20px 0;">
            <img src="//images.rbxcdn.com/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" />
        </div>
        <div id="status" style="min-height:40px;text-align:center;margin:5px 20px">
            <div id="Starting" class="PlaceLauncherStatus MadStatusStarting" style="display:block">
                Starting Roblox...
            </div>
            <div id="Waiting" class="PlaceLauncherStatus MadStatusField">Connecting to Players...</div>
            <div id="StatusBackBuffer" class="PlaceLauncherStatus PlaceLauncherStatusBackBuffer MadStatusBackBuffer"></div>
        </div>
        <div style="text-align:center;margin-top:1em">
            <input type="button" class="Button CancelPlaceLauncherButton translate" value="Cancel" />
        </div>
    </div>
</div>
<div id="ProtocolHandlerStartingDialog" style="display:none;">
    <div class="modalPopup ph-modal-popup">
        <div class="ph-modal-header">

        </div>
        <div class="ph-logo-row">
            <img src="/images/Logo/logo_R.svg" width="90" height="90" alt="R" />
        </div>
        <div class="ph-areyouinstalleddialog-content">
            <p class="larger-font-size">
                ROBLOX is now loading. Get ready to play!
            </p>
            <div class="ph-startingdialog-spinner-row">
                <img src="//images.rbxcdn.com/4bed93c91f909002b1f17f05c0ce13d1.gif" width="82" height="24" />
            </div>
        </div>
    </div>
</div>
<div id="ProtocolHandlerAreYouInstalled" style="display:none;">
    <div class="modalPopup ph-modal-popup">
        <div class="ph-modal-header">
            <span class="rbx-icon-close simplemodal-close"></span>
        </div>
        <div class="ph-logo-row">
            <img src="/images/Logo/logo_R.svg" width="90" height="90" alt="R" />
        </div>
        <div class="ph-areyouinstalleddialog-content">
            <p class="larger-font-size">
                You're moments away from getting into the game!
            </p>
            <div>
                <button type="button" class="btn rbx-btn-primary-sm" id="ProtocolHandlerInstallButton">
                    Download and Install ROBLOX
                </button>
            </div>
            <div class="rbx-small rbx-text-notes">
                <a href="https://en.help.roblox.local/hc/en-us/articles/204473560" class="rbx-link" target="_blank">Click here for help</a>
            </div>

        </div>
    </div>
</div>
<div id="ProtocolHandlerClickAlwaysAllowed" class="ph-clickalwaysallowed" style="display:none;">
    <p class="larger-font-size">
        <span class="rbx-icon-moreinfo"></span>
        Check <b>Remember my choice</b> and click <img src="//images.rbxcdn.com/7c8d7a39b4335931221857cca2b5430b.png" alt="Launch Application" />  in the dialog box above to join games faster in the future!
    </p>
</div>


    <div id="videoPrerollPanel" style="display:none">
        <div id="videoPrerollTitleDiv">
            Gameplay sponsored by:
        </div>
        <div id="content">
            <video id="contentElement" style="width:0; height:0;" />
        </div>
        <div id="videoPrerollMainDiv"></div>
        <div id="videoPrerollCompanionAd">
            
        </div>
        <div id="videoPrerollLoadingDiv">
            Loading <span id="videoPrerollLoadingPercent">0%</span> - <span id="videoPrerollMadStatus" class="MadStatusField">Starting game...</span><span id="videoPrerollMadStatusBackBuffer" class="MadStatusBackBuffer"></span>
            <div id="videoPrerollLoadingBar">
                <div id="videoPrerollLoadingBarCompleted">
                </div>
            </div>
        </div>
        <div id="videoPrerollJoinBC">
            <span>Get more with Builders Club!</span>
            <a href="https://www.roblox.local/premium/membership?ctx=preroll" target="_blank" class="btn-medium btn-primary" id="videoPrerollJoinBCButton">Join Builders Club</a>
        </div>
    </div>   
    <script type="text/javascript">
        $(function () {
            var videoPreRollDFP = Roblox.VideoPreRollDFP;
            if (videoPreRollDFP) {
                var customTargeting = Roblox.VideoPreRollDFP.customTargeting;
                videoPreRollDFP.showVideoPreRoll = false;
                videoPreRollDFP.loadingBarMaxTime = 33000;
                videoPreRollDFP.videoLoadingTimeout = 11000;
                videoPreRollDFP.videoPlayingTimeout = 41000;
                videoPreRollDFP.videoLogNote = "Flooded";
                videoPreRollDFP.logsEnabled = true;
                videoPreRollDFP.excludedPlaceIds = "32373412";
                videoPreRollDFP.adUnit = "/1015347/VideoPreroll";
                videoPreRollDFP.adTime = 15;
                videoPreRollDFP.isSwfPreloaderEnabled = true;
                videoPreRollDFP.isPrerollShownEveryXMinutesEnabled = true;
                customTargeting.userAge = "36";
                customTargeting.userGender = "Male";
                customTargeting.gameGenres = "";
                customTargeting.environment = "Production";
                customTargeting.adTime = "15";
                customTargeting.PLVU = false;
                $(videoPreRollDFP.checkEligibility);
            }
        });
    </script>                                                     


<div id="GuestModePrompt_BoyGirl" class="Revised GuestModePromptModal" style="display:none;">
    <div class="simplemodal-close">
        <a class="ImageButton closeBtnCircle_20h" style="cursor: pointer; margin-left:455px;top:7px; position:absolute;"></a>
    </div>
    <div class="Title">
        Choose Your Character
    </div>
    <div style="min-height: 275px; background-color: white;">
        <div style="clear:both; height:25px;"></div>

        <div style="text-align: center;">
            <div class="VisitButtonsGuestCharacter VisitButtonBoyGuest" style="float:left; margin-left:45px;"></div>
            <div class="VisitButtonsGuestCharacter VisitButtonGirlGuest" style="float:right; margin-right:45px;"></div>
        </div>
        <div style="clear:both; height:25px;"></div>
        <div class="RevisedFooter">
            <div style="width:200px;margin:10px auto 0 auto;">
                <a href="//www.roblox.local/?returnUrl=http%3A%2F%2Fwww.roblox.local%2FMy%2FMoney.aspx"><div class="RevisedCharacterSelectSignup"></div></a>
                <a class="HaveAccount" href="https://www.roblox.local/newlogin?returnUrl=http%3A%2F%2Fwww.roblox.local%2FMy%2FMoney.aspx">I have an account</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function checkRobloxInstall() {
             return RobloxLaunch.CheckRobloxInstall('/install/download.aspx');
    }

</script>

<script type="text/javascript">
    var Roblox = Roblox || {};
    Roblox.UpsellAdModal = Roblox.UpsellAdModal || {};

    Roblox.UpsellAdModal.Resources = {
        //<sl:translate>
        title: "Remove Ads Like This",
        body: "Builders Club members do not see external ads like these.",
        accept: "Upgrade Now",
        decline: "No, thanks"
        //</sl:translate>
    };
</script>  

<div class="ConfirmationModal modalPopup unifiedModal smallModal" data-modal-handle="confirmation" style="display:none;">
    <a class="genericmodal-close ImageButton closeBtnCircle_20h"></a>
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div class="TopBody">
            <div class="ImageContainer roblox-item-image"  data-image-size="small" data-no-overlays data-no-click>
                <img class="GenericModalImage" alt="generic image" />
            </div>
            <div class="Message"></div>
        </div>
        <div class="ConfirmationModalButtonContainer">
            <a href id="roblox-confirm-btn"><span></span></a>
            <a href id="roblox-decline-btn"><span></span></a>
        </div>
        <div class="ConfirmationModalFooter">
        
        </div>  
    </div>   
    <script type="text/javascript">
        Roblox = Roblox || {};
        Roblox.Resources = Roblox.Resources || {};

        //<sl:translate>
        Roblox.Resources.GenericConfirmation = {
            yes: "Yes",
            No: "No",
            Confirm: "Confirm",
            Cancel: "Cancel"
        };
        //</sl:translate>
    </script>
</div>


    
        <script>
            $(function () {
                Roblox.DeveloperConsoleWarning.showWarning();
            });
        </script>
    

    <script type="text/javascript">
        $(function () {
            Roblox.CookieUpgrader.domain = 'roblox.local';
            Roblox.CookieUpgrader.upgrade("GuestData", { expires: Roblox.CookieUpgrader.thirtyYearsFromNow });
            Roblox.CookieUpgrader.upgrade("RBXSource", { expires: function (cookie) { return Roblox.CookieUpgrader.getExpirationFromCookieValue("rbx_acquisition_time", cookie); } });
            Roblox.CookieUpgrader.upgrade("RBXViralAcquisition", { expires: function (cookie) { return Roblox.CookieUpgrader.getExpirationFromCookieValue("time", cookie); } });
                
                Roblox.CookieUpgrader.upgrade("RBXMarketing", { expires: Roblox.CookieUpgrader.thirtyYearsFromNow });
                
                            
                Roblox.CookieUpgrader.upgrade("RBXSessionTracker", { expires: Roblox.CookieUpgrader.fourHoursFromNow });
                
                    });
    </script>
    <script>
        var _comscore = _comscore || [];
        _comscore.push({ c1: "2", c2: "6035605", c3: "", c4: "", c15: "Over13" });

        (function() {
            var s = document.createElement("script"), el = document.getElementsByTagName("script")[0];
            s.async = true;
            s.src = (document.location.protocol == "https:" ? "https://sb" : "//b") + ".scorecardresearch.com/beacon.js";
            el.parentNode.insertBefore(s, el);
        })();
    </script>
    <noscript>
        <img src="//b.scorecardresearch.com/p?c1=2&c2=&c3=&c4=&c5=&c6=&c15=&cv=2.0&cj=1"/>
    </noscript>

</body>                
</html>
