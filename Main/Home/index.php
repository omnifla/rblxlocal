<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
use UserControls\Navigation\SiteAlert;
use Roblox\UserFeed;
use Roblox\DataAccess\FeedificationDAL;
use UserControls\Markdown;
// e
// redirects the user to /newlogin?redirect-url=url if not logged in (used to show 401 error before)
if(!Auth::GetAuthenticatedUser()){
    $url = $_SERVER['REQUEST_URI'];
    $redirect = '/newlogin?redirect-url=' . urlencode($url);
    header('Location: ' . $redirect);
    exit;
}

$user = Auth::GetAuthenticatedUserInfo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- MachineID: WEB1 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true">
    
    <meta http-equiv="Content-Language" content="en-us">
    <meta name="author" content="ROBLOX Corporation">
    <meta name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine.">
    <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine">
    
    

    <title>ROBLOX Home</title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    
    
<link rel="stylesheet" href="https://<?= $site_properties['hostname'] ?>/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css">

    
<link rel="stylesheet" href="https://<?= $site_properties['hostname'] ?>/CSS/Base/CSS/FetchCSS?path=page___0513ca5a00c9bdedff82380744b7def6_m.css">
<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700" rel="stylesheet" type="text/css">
    
	<script async="" type="text/javascript" src="./<?= $site_properties['hostname'] ?>_files/gpt.js"></script><script type="text/javascript" src="https://js.rbxcdn.com/9db05af88b1dc737664247f24a0120e0.js.gzip"></script><link href="./<?= $site_properties['hostname'] ?>_files/BestFriends.css" rel="stylesheet" type="text/css"><script type="text/javascript" src="https://js.rbxcdn.com/e96b59fba745a37cdd847ff394b79aac.js.gzip"></script><script type="text/javascript" src="https://js.rbxcdn.com/9f4404fc11d8b8958d09f6316719cef9.js.gzip"></script><script type="text/javascript" async="" src="./<?= $site_properties['hostname'] ?>_files/ga.js"></script><script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-11419793-1']);
		_gaq.push(['_setCampSourceKey', 'rbx_source']);
		_gaq.push(['_setCampMediumKey', 'rbx_medium']);
		_gaq.push(['_setCampContentKey', 'rbx_campaign']);
		_gaq.push(['_setDomainName', '<?= $site_properties['hostname'] ?>']);

		_gaq.push(['b._setAccount', 'UA-486632-1']);
		_gaq.push(['b._setCampSourceKey', 'rbx_source']);
		_gaq.push(['b._setCampMediumKey', 'rbx_medium']);
		_gaq.push(['b._setCampContentKey', 'rbx_campaign']);
		_gaq.push(['b._setDomainName', '<?= $site_properties['hostname'] ?>']);
		_gaq.push(['c._setAccount', 'UA-26810151-2']);
		_gaq.push(['c._setDomainName', '<?= $site_properties['hostname'] ?>']);

		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();

	</script>
    <script type='text/javascript' src='//code.jquery.com/jquery-1.7.2.min.js'></script>
<script type='text/javascript' src='//code.jquery.com/jquery-migrate-3.5.2.min.js'></script>

    
<script type="text/javascript" src="https://js.rbxcdn.com/c57cc32d0db0d462c64bb8ace02fdf13.js.gzip"></script>

    <script type="text/javascript">Roblox.config.externalResources = ['https://<?= $site_properties['hostname'] ?>/js/jquery/jquery-1.7.2.min.js','/js/json2.min.js'];Roblox.config.paths['jQuery'] = 'http://js.rbxcdn.com/e96b59fba745a37cdd847ff394b79aac.js.gzip';Roblox.config.paths['Pagelets.BestFriends'] = 'http://js.rbxcdn.com/9db05af88b1dc737664247f24a0120e0.js.gzip';Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/10a6b22225379eaa8d41dd1c0ffb6dc3.js.gzip';Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/f266eeedec9548a94baf73ccb09e4a5d.js.gzip';Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/6307f9bd9c09fa9d88c76291f3b68fda.js.gzip';Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/9f4404fc11d8b8958d09f6316719cef9.js.gzip';Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/88a3e1afed9aa3b21670a59ddb7775c3.js.gzip';Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/c98baf27bc7feda3206342566db92696.js.gzip';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/3f95857727df4739b29a8385501752fa.js.gzip';Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/152201bc9a4e721fe8c326c78b35e364.js.gzip';Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/4426a131abb3e214ed89338154f6e78a.js.gzip';Roblox.config.paths['Widgets.Suggestions'] = 'http://js.rbxcdn.com/63f96a694a0eedd389b573a5859b8974.js.gzip';Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/56ad7af86ee4f8bc82af94269ed50148.js.gzip';</script>
    
<script type="text/javascript" src="https://js.rbxcdn.com/f6ebdcdab40c43bb18d29009ce0880be.js.gzip"></script>

    <script type="text/javascript">   
        googletag.cmd.push(function() {
            Roblox = Roblox || {};
            Roblox.AdsHelper = Roblox.AdsHelper || {};
            Roblox.AdsHelper.slots = [];
	        Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_MyHome_Right_160x600", [160, 600], "3439303639313930").addService(googletag.pubads()), id: "3439303639313930"});
 
            for (var key in Roblox.AdsHelper.slots) {
                var slot = Roblox.AdsHelper.slots[key].slot;
                var id = Roblox.AdsHelper.slots[key].id;
                if (slot.renderEnded != "undefined") {
                    (function(slot, id)
                    {
                        slot.renderEndedOld = slot.renderEnded;
                        slot.renderEnded = function() {
                            slot.renderEndedOld();
                            if ($('#' + id + '.gutter').css('display') == "none") {
                                $(document).trigger("GuttersHidden");
                            }
                        };    
                    }(slot, id));
                }
            }

        googletag.pubads().setTargeting("Age", ["13", "13to14" ]);	
            googletag.pubads().setTargeting("Env",  "Production");
        googletag.pubads().enableSingleRequest();
        googletag.pubads().collapseEmptyDivs();
        googletag.enableServices();
	    });
    </script>  
<script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({'internalEventListenerPixelEnabled': true});
    });
</script>        <script type="text/javascript">
            Roblox.XsrfToken.setToken('y5zY3quEFHjD');
        </script>
    <script type="text/javascript">
        Roblox.FixedUI.gutterAdsEnabled = false;
    </script>   
    
<script async="" type="text/javascript" src="./<?= $site_properties['hostname'] ?>_files/pubads_impl_30.js"></script><script type="text/javascript" src="./<?= $site_properties['hostname'] ?>_files/osd.js"></script></head>
<body>
    
<div id="fb-root"></div>
<div id="MasterContainer"><div>

                                                            
<?= SiteHeader::render() ?>
        <div id="navContent" class="nav-content"><div class="nav-content-inner">
		<div class="content">
<div id="HomeContainer" class="row home-container"
     data-facebook-share="/facebook/share-character"
     data-update-status-url="/home/updatestatus"
     data-should-show-enable-two-step-verification-call-to-action=False>
<script>
$(function() {
    function n() {
        if ($("#txtStatusMessage").prop("disabled"))
            return !1;
        var t = $("#HomeContainer").data("update-status-url")
          , i = $("#txtStatusMessage").val()
          , n = $("#statusForm")
          , r = $("#sendToFacebook").is(":checked")
          , u = {
            status: i,
            sendToFacebook: r
        };
        $("#shareButton").hide(),
        $("#loadingImage").show(),
        $.post(t, u).done(function(t) {
            $("#txtStatusMessage").val(t.message),
            n.find(".rbx-form-group").removeClass("rbx-form-has-error"),
            n.find(".rbx-control-label").hide()
        }).fail(function() {
            $("#txtStatusMessage").val(""),
            n.find(".rbx-form-group").addClass("rbx-form-has-error"),
            n.find(".rbx-control-label").show()
        }).always(function() {
            $("#txtStatusMessage").blur(),
            $("#shareButton").show(),
            $("#loadingImage").hide()
        })
    }
    var i = $("#HomeContainer").data("facebook-share"), t;
    $("#btnFacebookShare").click(function() {
        $.post(i, function(n) {
            $("#btnFacebookShare").removeClass(),
            n.success ? $("#facebookShareResult").addClass("status-confirm") : $("#facebookShareResult").addClass("status-error"),
            $("#facebookShareResult").text(n.message),
            $("#facebookShareResult").fadeIn().delay(5e3).fadeOut()
        })
    }),
    $("#HomeContainer *[data-retry-url]").loadRobloxThumbnails(),
    $("#shareButton").click(function() {
        n()
    }),
    $("#txtStatusMessage").keypress(function(t) {
        t.which == "13" && n()
    });
    $(document).on("GuttersHidden", function() {
        $("#LeftGutterAdContainer").hide(),
        $("#RightGutterAdContainer").hide()
    });
    t = function() {
        var n = {
            titleText: "Two Step Verification",
            bodyContent: "Your account does not have two step verification enabled. Enabling it will make your account more secure. Would you like to enable it now?",
            onAccept: function() {
                window.location.href = "/my/account?tab=security"
            }
        };
        Roblox.GenericConfirmation.open(n)
    }
   //var n = $("#HomeContainer").attr("data-should-show-enable-two-step-verification-call-to-action") === "True";
    t()
});

</script>


    <div class="col-xs-12 home-header">  
        <a href="/User.aspx" class="home-thumbnail-bust" >
            <img alt="avatar" src="/Thumbs/Avatar.ashx?userId=<?= $user['id'] ?>&x=250&y=250" />
        </a>
        <div class="home-header-content ">
            <h1><a href="/User.aspx">Hello, <?= htmlspecialchars($user['username']) ?>!</a>
            </h1>
                <span class="rbx-icon-tbc"></span>
        </div>
    </div>
        <div class="col-xs-12 section home-friends">
            <div class="container-header">
                <h3>Friends (1)</h3>
                <a  href="/friends.aspx#FriendsTab" class="rbx-btn-secondary-xs btn-more">See All</a>
            </div>
            
            


<ul class="hlist friend-list">
                <li class="list-item friend">
                    <a href="/User.aspx?id=1" class="friend-link" title="TheGuyWhoIsIdiot">
                        <span class="friend-avatar" data-3d-url="/avatar-thumbnail-3d/json?userId=72230447"  data-js-files='https://js.rbxcdn.com/47e6e85800c4ed3c4eef848c077575a9.js.gzip' ><img alt='TheGuyWhoIsIdiot' class='' src='/Thumbs/Avatar.ashx?userId=2&x=250&y=250' /></span>
                        <span class="friend-name rbx-text-overflow">TheGuyWhoIsIdiot</span>
                                <span class="friend-status rbx-icon-online" title="Website"></span>
                    </a>
                </li>
</ul>


        </div>


        <div id="recently-visited-places" class="col-xs-12 container-list home-games">
            <div class="container-header">
                <h3>Recently Played</h3>
<a  href="/games?sortFilter=6" class="rbx-btn-secondary-xs btn-more">See All</a>            </div>
            
            


<ul class="hlist game-list">
<li class="list-item game">
            <a href="/Place.aspx?placeId=1" class="game-item">
                <span class="game-thumb"><img class="" src="//images.rbxcdn.com/04baeb33ef66ef1395cd5464309fece6.jpg"></span>
                <span class="rbx-title rbx-text-overflow">Crossroads</span>
                    <span class="rbx-text-notes rbx-font-sm">0 Online</span>
            </a>
        </li>

</ul>
        </div>

    <div class="col-xs-12 col-sm-6 home-right-col">
<?php
$dal = new FeedificationDAL();
$feed = $dal->getRecent(1);
if(count($feed) > 0) {
    $f = $feed[0];
    $markdown = new Markdown(htmlspecialchars($f->message));
    $cont = $markdown->toHtml();
    echo
<<<HTML
<div class="section">
            <div class="section-header">
                <h3>ANNOUNCEMENT</h3>
                
            </div>
<div>
    <p>{$cont}</p>
</div>
        </div>
HTML;
}
?>
        <div class="section">
            <div class="section-header">
                <h3>Blog News</h3>
                <a  href="https://blog.<?= $site_properties['hostname'] ?>" class="rbx-btn-control-xs btn-more">See More</a>
            </div>
            
            
<ul class="blog-news">
            <li class="news">
                <span class="rbx-icon-page"></span>
                <span class="news-link"><a href="https://blog.<?= $site_properties['hostname'] ?>/2015/09/get-free-hats-win-prizes-in-the-endless-summer-camp-out/" ref="news-article" class="roblox-interstitial rbx-link rbx-article-title">Get Free Hats &amp; Win Prizes in the Endless Summer Camp Out!</a></span>
            </li>
            <li class="news">
                <span class="rbx-icon-page"></span>
                <span class="news-link"><a href="https://blog.<?= $site_properties['hostname'] ?>/2015/09/new-profile-pages-add-new-features-for-interacting-with-friends/" ref="news-article" class="roblox-interstitial rbx-link rbx-article-title">New Profile Pages Add New Features for Interacting With Friends</a></span>
            </li>


</ul>
        </div>
                            <div id="FacebookConnectCard" class="section">
                
                

<center>
<img src="https://images.rbxcdn.com/4ec0c6c40a454f2f6537946d00f09b56.png">
<p style="width:70%;">Link your ROBLOX account with your Facebook account to let your Facebook friends see what you're doing on ROBLOX!</p>
</center>
<div id="connect-facebook">
    
    


<div id="SocialIdentitiesInformation" 
    data-rbx-login="/social/notify-login"
    data-rbx-update="/social/update-info"
    data-rbx-disconnect="/social/disconnect"
    data-rbx-login-redirect-url="/social/postlogin"
    data-user-is-authenticated></div>
    <div class="connect-button" data-rbx-provider="facebook" style="background-image:url('https://cdns3.gigya.com/gs/GetSprite.ashx?path=%2FHTMLLogin%2FFullLogo%2F%5Bfacebook%5D_30.png%7C78%2C30');width:78px;height:30px;background-repeat:no-repeat"></div>
    <div class="disconnect-link" data-rbx-provider="facebook"></div>
    <div class="nickname"></div>
</div>
            </div>
    </div><!-- .home-right-col -->


    <div class="col-xs-12 col-sm-6 home-left-col">
        <div class="section">
            <div class="section-header">
                <h3>My Feed</h3>
            </div>
            <div class="rbx-form-horizontal" id="statusForm" role="form">
                <div class="rbx-form-group" id="groupYes">
                    <input class="form-control rbx-input-field" id="txtStatusMessage" maxlength="254" placeholder="What are you up to?" />
                    <p class="rbx-control-label">Status update failed.</p>
                </div>
                <a  type="button" class="rbx-btn-primary-sm" id="shareButton">Share</a>
                <img id="loadingImage" class="share-login" style="display: none" alt="Sharing..." src="https://images.rbxcdn.com/ec4e85b0c4396cf753a06fade0a8d8af.gif" height="17" width="48" />
            </div>
            
            


<ul class="vlist feeds">
<?php
$limit = 20;
$feeds = UserFeed::getRecent($limit);
if (empty($feeds)) {
    echo '<div class="no-feeds">No feeds available.</div>';
    exit;
}
foreach ($feeds as $feed) {
    $feed_content = htmlspecialchars($feed->getFeedContent());
    $feed_timestamp = $feed->getFeedPostTime();
    $feed_date = date('m/d/Y', $feed_timestamp) . " at " . date('h:i A', $feed_timestamp);
    $author_id = $feed->getFeedAuthorId();
    if ($author_id === null) continue;
    $author = \Roblox\Authentication::GetUserInfo($author_id);
    if(!$author){ $author = [username => "[ Account Deleted $author_id ]", "id" => $author_id]; }
    $username = htmlspecialchars($author['username']);
    echo <<<HTML
            <li class="list-item"><a href="/User.aspx?id={$author['id']}" class="list-header" ><img  class="header-thumb" src="/Thumbs/Avatar.ashx?userId={$author['id']}&x=250&y=250" /></a>
            <div class="list-body">
                <p class="list-content"><a href="/User.aspx?id={$author['id']}">{$username}</a><div class="feedtext linkify">"{$feed_content}"</div></p>
                <span class="rbx-text-notes rbx-font-sm">{$feed_date}</span>
                    <a href="/abusereport/Feed?id={$feed->getPostId()}&amp;amp;redirectUrl=%2Fhome">
                        <span class="rbx-icon-report"></span>
                    </a>
            </div>
        </li>
    HTML;
}
?>
</ul>
        </div>
    </div>


    
    


    
    






</div>




                <div id="Skyscraper-Adp-Right" class="abp abp-container right-abp">
                    
                    


    <iframe allowtransparency="true"
            frameborder="0"
            height="612"
            scrolling="no"
            src="/userads/2"
            width="160"
            data-js-adtype="iframead"></iframe>


                </div>
            
            
        </div>
            </div> 


                    <div style="clear:both"></div>
                </div>
            </div>
        </div>

<?= SiteFooter::renderNextStyleGuide() ?>
