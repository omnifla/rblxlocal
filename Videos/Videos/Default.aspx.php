<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeaderVideos;
use Roblox\Web\SiteFooter;
$user = Auth::GetAuthenticatedUserInfo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- MachineID: WEB1 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true">
    
    <meta http-equiv="Content-Language" content="en-us">
    <meta name="author" content="RBLX.Vidoes">
    <meta name="description" content="Publish your own videos about RBLX.local inside of RBLX.Videos">
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

                                                            
<?= SiteHeaderVideos::render() ?>
        <div id="navContent" class="nav-content"><div class="nav-content-inner">
		<div class="content">
</div>     
        </div>
            </div> 


                    <div style="clear:both"></div>
                </div>
            </div>
        </div>

<?= SiteFooter::render() ?>
