<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;

$code = $_GET['code'] ?? null;
if (!in_array($code, ['404', '403', '500'])) {
  header("Location: /RobloxDefaultErrorPage.aspx?code=404");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="author" content="ROBLOX Corporation">
  <meta name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine.">
  <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine">
  <meta name="robots" content="all">
  <title>ROBLOX Error</title>

  <link rel="stylesheet" type="text/css" href="https://web-static.archive.org/_static/css/banner-styles.css?v=1B2M2Y8A">
  <link rel="stylesheet" type="text/css" href="https://web-static.archive.org/_static/css/iconochive.css?v=1B2M2Y8A">
  <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___511743e6d5fad94c26c0ebadead4fea1_m.css">
  <link rel="icon" type="image/vnd.microsoft.icon" href="<?= $site_properties['hostname'] ?>/favicon.ico">
  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-11419793-1']);
    _gaq.push(['_setCampSourceKey', 'rbx_source']);
    _gaq.push(['_setCampMediumKey', 'rbx_medium']);
    _gaq.push(['_setCampContentKey', 'rbx_campaign']);
    _gaq.push(['b._setAccount', 'UA-486632-1']);
    _gaq.push(['b._setCampSourceKey', 'rbx_source']);
    _gaq.push(['b._setCampMediumKey', 'rbx_medium']);
    _gaq.push(['b._setCampContentKey', 'rbx_campaign']);
    _gaq.push(['c._setAccount', 'UA-26810151-2']);
    (function () {
      var ga = document.createElement('script');
      ga.type = 'text/javascript';
      ga.async = true;
      ga.src = ('https:' === document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ga, s);
    })();
  </script>
  <script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js"></script>
  <script>window.jQuery || document.write("<script src='/js/jquery/jquery-1.7.2.min.js'><\/script>")</script>
  <script src="//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js"></script>
  <script>window.Sys || document.write("<script src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>
  <script src="http://jsak.roblox.com/f036e697dcd593e31534edd129a44b7e.js"></script>
  <script>Roblox.JSErrorTracker.initialize({ 'internalEventListenerPixelEnabled': true });</script>
  <script>
    $(function () {
      $('.tooltip').tipsy();
      $('.tooltip-top').tipsy({ gravity: 's' });
      $('.tooltip-right').tipsy({ gravity: 'w' });
      $('.tooltip-left').tipsy({ gravity: 'e' });
      $('.tooltip-bottom').tipsy({ gravity: 'n' });
    });
  </script>
</head>

<body>
  <div>
    <?= SiteHeader::render() ?>
    <div class="forceSpaceUnderSubmenu">&nbsp;</div>
    <div class="forceSpace">&nbsp;</div>
    <noscript>
      &lt;div class="SystemAlert"&gt;&lt;div class="SystemAlertText"&gt;Please enable Javascript to use all the features on this site.&lt;/div&gt;&lt;/div&gt;
    </noscript>
    <div class="SystemAlert" style="background-color: green;">
      <div class="SystemAlertText">hello chat -Skyler</div>
    </div>
    <div id="BodyWrapper">
      <div id="RepositionBody">
        <div id="Body" style="width:970px">
          <div id="ErrorPage">
            <?php
            if ($code == '404') {
              echo <<<HTML
<img src="/images/4bd2ab534d227b98097ab7730f61f49a.png" class="ErrorAlert" alt="Alert">
<h1><span>Requested page not found</span></h1>
<h3><span>You may have clicked an expired link or mistyped the address.</span></h3>
<p><span></span></p>
<pre style="text-align:left;margin-left:10px;"><span></span></pre>
<div class="divideTitleAndBackButtons">&nbsp;</div>
HTML;
            } elseif ($code == '403') {
              echo <<<HTML
<img src="/images/05636e8bda24cdc11428e091e386605c.png" class="ErrorAlert" alt="Alert">
<h1><span>Access Denied</span></h1>
<h3><span>Sorry, you don't have permission to view this page!</span></h3>
<p><span>If you continue to receive this page, please contact the developers.</span></p>
<pre style="text-align:left;margin-left:10px;"><span></span></pre>
<div class="divideTitleAndBackButtons">&nbsp;</div>
HTML;
            } elseif ($code == '500') {
              echo <<<HTML
<img src="/images/b47ba5565699c01cb4521af3f339b36b.png" class="ErrorAlert" alt="Alert">
<h1><span>Access Denied</span></h1>
<h3><span>Sorry, you don't have permission to view this page!</span></h3>
<p><span>If you continue to receive this page, please contact the developers.</span></p>
<pre style="text-align:left;margin-left:10px;"><span></span></pre>
<div class="divideTitleAndBackButtons">&nbsp;</div>
HTML;
            }
            ?>
            <div class="CenterNavigationButtonsForFloat">
              <a class="btn-small btn-neutral" onclick="history.back();return false;" href="#">Go to Previous Page</a>
              <a class="btn-neutral btn-small" href="/Home/">Return Home</a>
              <div style="clear:both"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?= SiteFooter::render() ?>
  </div>
</body>

</html>