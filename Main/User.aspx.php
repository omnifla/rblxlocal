<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;

$id = $_GET['id'] ?? $_GET['Id'] ?? $_GET["ID"] ?? 1;
$user = Auth::GetUserInfo(intval($id));
//var_dump($user);
//exit;
if(!$user){
    http_response_code(404);
    exit;
}
$user['username'] = htmlspecialchars($user['username']);
$user['description'] = htmlspecialchars($user['description'] ?? $user['username']." has no description");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="//www.facebook.com/2008/fbml">
<!-- MachineID: WEB37 -->
<head id="ctl00_Head1"><meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" /><title>
	<?= $user['username'] ." - " .$site_properties['Title'] ?>
</title>
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___dac4a444950639c02cc831a484c826f5_m.css' />

<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___1b22aeedd7f4e73ab0700a149f589336_m.css' />
<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="Content-Language" content="en-us" /><meta name="author" content="ROBLOX Corporation" /><meta id="ctl00_metadescription" name="description" content="View <?= $user['username'] ?>&#39;s profile on ROBLOX.  ROBLOX is the place for free games online, where people like <?= $user['username'] ?> imagine, build, and share their creations with their friends in a kid-safe environment.  There are millions of free games on ROBLOX.  10 of them are <?= $user['username'] ?>&#39;s pics on ROBLOX for best free games.  <?= $user['username'] ?> is the creator of 8 free games.  Visit ROBLOX now to play <?= $user['username'] ?>&#39;s free games and discover thousands of others!" /><meta id="ctl00_metakeywords" name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />	<script type="text/javascript">

        var _gaq = _gaq || [];

		    _gaq.push(['_setAccount', 'UA-11419793-1']);
		    _gaq.push(['_setCampSourceKey', 'rbx_source']);
		    _gaq.push(['_setCampMediumKey', 'rbx_medium']);
		    _gaq.push(['_setCampContentKey', 'rbx_campaign']);
		        _gaq.push(['_setDomainName', 'roblox.com']);
		_gaq.push(['b._setAccount', 'UA-486632-1']);
		_gaq.push(['b._setCampSourceKey', 'rbx_source']);
		_gaq.push(['b._setCampMediumKey', 'rbx_medium']);
		_gaq.push(['b._setCampContentKey', 'rbx_campaign']);

		_gaq.push(['b._setDomainName', 'roblox.com']);
        
        
        
        

		_gaq.push(['c._setAccount', 'UA-26810151-2']);
		_gaq.push(['c._setDomainName', 'roblox.com']);

		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();

	</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.7.2.min.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
<script type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>

<script type='text/javascript' src='//js.rbxcdn.com/8db10b38268e9779c510b84268538ec8.js'></script>
<script type='text/javascript'>Roblox.config.externalResources = ['/js/jquery/jquery-1.7.2.min.js','/js/json2.min.js'];Roblox.config.paths['jQuery'] = '//js.rbxcdn.com/29cf397a226a92ca602cb139e9aae7d7.js';Roblox.config.paths['Pages.Catalog'] = '//js.rbxcdn.com/7123e398c0433de33356ac718bab90d5.js';Roblox.config.paths['Pages.CatalogShared'] = '//js.rbxcdn.com/4eb48eec34ca711d5a7b08a4291ac753.js';Roblox.config.paths['Pages.Messages'] = '//js.rbxcdn.com/9b1b88b531c486003bbf39ae61963c27.js';Roblox.config.paths['Resources.Messages'] = '//js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = '//js.rbxcdn.com/a404577733d1b68e3056a8cd3f31614c.js';Roblox.config.paths['Widgets.DropdownMenu'] = '//js.rbxcdn.com/ff651da6797160efb3ebbb2c2f98fb86.js';Roblox.config.paths['Widgets.GroupImage'] = '//js.rbxcdn.com/3e692c7b60e1e28ce639184f793fdda9.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = '//js.rbxcdn.com/e8b579b8e31f8e7722a5d10900191fe7.js';Roblox.config.paths['Widgets.ItemImage'] = '//js.rbxcdn.com/f676cf25d820c731b5adb4bf362bcd90.js';Roblox.config.paths['Widgets.PlaceImage'] = '//js.rbxcdn.com/08e1942c5b0ef78773b03f02bffec494.js';Roblox.config.paths['Widgets.Suggestions'] = '//js.rbxcdn.com/a63d457706dfbc230cf66a9674a1ca8b.js';Roblox.config.paths['Widgets.SurveyModal'] = '//js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';</script><script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true, 'internalEventListenerPixelEnabled': true});
    });
</script>
<script type='text/javascript' src='//js.rbxcdn.com/1e3dc2b22269576ba0a4616bd6f78f8d.js'></script>

</head>
<body class="">

    <script type="text/javascript">Roblox.XsrfToken.setToken('');</script>
 
    <script type="text/javascript">
        if (top.location != self.location) {
            top.location = self.location.href;
        }
    </script>
  
<style type="text/css">
    
</style>
<form name="aspnetForm" method="post" action="/User.aspx?ID=1025053" id="aspnetForm">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="PWIsMm+/6ji+tBkM4P+1Md1F9TZ2Umitn6ba+qjdYogvoHsIv6FwYs1jkRyxzxA3nKwSLVT10q1IXABX1ireuVc+D6kVaQExrhvLK9KFKARDbEY0MkQAf3tszKduIWtf0Nn7rOizaMVCXrFjFfqtUlVp/1nqF/QUiSEGHUFF0/FUi3tA7S7pTU0fd19HVT91hiRc6mEgZ4gijFiuyqJ2c3hNV0wCF1ZNZFRHt38NSJ3uE3Ieeyl+qmJeRIn/wtmgwEo/uwPaeI6tqwWVa5tQl5huvQSszxU062kEumBLOpalW/ulseVtfCJFQdKogMAW4DO/yDYoNdkbXdN+vWfNy4Jw5hF0OHnh/C1WpzHYMUhWhPHQVPmjc1BQa91Dqqo1eaOKnSMWerzBgQVoXhzz3AwuWAbBgFc3M0JJd7cV3tIBjnrf8lyQkbeMBSsDPwjDVB40tKSpid2ShAFFiHbutx4brkzCoO/DWjWgKlZ5ANhzEM5N2n3RbyYab9yAnn5tsdmOvS6rJxt/GRmbAX8uOdiv4WpMdtjhKOK2om2yxU3aVRqOQseddt1cLo7K8HP/zTM6VJ8UUaX+F+hiwS96GQu0HJPJtpEwrDjn+xUe0U4w3uE9BjvTm1gMIZQwB51RGVT21LbGPA9t2Rin7UD4YP+ms3MnYFQdYL9jBeG8PWADm9qzKeUYws0Q0zcD9GqWTZXy2abvAMDRcUu0aiyUUJMiM4gXVYd7FGNOvfxH1luUBGPskeSaW9bFZlmKm8eqGLJmOGDrh1yOykscS7G6Mdp4hVgQxO3YuzoCxAlxZuqu1rr+wHq1n6qnC9U8VGi4v2lxhEJS591KIrdQZ7arRcp8/7a0D5+76bA3hxfwvZkBu8pZm2GJ+lWVdU9pbi72kTCO/moeX5EffKqhRIR3NFuDjZe9p2vT9r0EkUQb3hH/nuasrgTNP+/lQ6hNEvffyITGNffTmgrv6wv5/N/ZstE8f8WMkRRPzE99eG7Mv0sbXD94sEYlPotruU41sd9OwgdB+jND1skDkyv6cXELTQ62va5nUkuSnCKVxCnXPKLMH7qP1Feu2G0gaHCkl8DgBrM71/cy+GrIkHgja5lVrZ7EQ6fFUsPCZ4SVFfeglq10NgBDXuxlXxy/zjyUdOTjH9siW5a07Ecgpdkz9Y3V+GBvt02K8ijcU5o2YQFoVP19Fj1tYGgJPcBoTxnfm8SKFDHvIVDt6VcCnbJf3c697VgNbiXkiMwr5gysMyj6LDGURd/5ab2WxEsNJRGD4ptcNdFc/74P1lrNdoRrPvsHCjXKM5Ml88JLK0aRSzr6ixD2Wuq0IX656kSm79QA/vchMEqatkMPQ8JS3dUZHQ7epQl1Qtz8HgbKVv36cn/WgwHVeBXaPRQjATzHnwxgxKFdGUSln1b8gkn1699J1e1xXo0+yDNqZiiETJvuyy7BHc/qn+6O2Y1khuF7razWnSudENJF8bhtRAv9CpHBbUblSx+nE80cNolEcUyHJt3LXPpHYvcudkcFJFfJws6cwhCkvLkjGVJPE18m97OogtsEPE4euYX1DTcFCWEp/bg1uv40TD9Cb6nEz7mSaOI7amSmni/7+7LiogD3wXkGAtj2WUIhJ4iPBag3w/C/hO2HrF4IX+WwVVd3DBK7J65VZPDcGgQ0Pwf0WiAP8LXwiOnEdGq+mhJ5J9j+Yohu3JARGiZGOQenSBylp6wmTab0jaRm0+eRZRgGkbN5M4t5PnsCU7tKtQxpDLg4tpTUaqtXGk5GDV+kqQhmOM95mebLVapmrUjabvXKcW7QX51q6hQz3yfP5ZhAqInhSszGuAFfCBIf9j1Q9XjxHcD2Jgg7RmLkVnhoEsj9wH9DpSWw4dF56Ik2suH4PmuD058K9/C/gxobQvgMlt+c1MLGpUdCzMGAL/6tRFchQ1bxDFtVZAPiCvSs14nT0bdGCCNx+pELmhpKA5AbWEBZXKeTPXXRd+RyL9OC7mOPVmrvUABHyI8D26Fk4KGCnaXjnR8ECb4aDxa+DI1N0UOF+DXKFW2rhTrqND4jrNwhyipNjNhfbJYy3aYIyW6dpbLKmwahUperAFJj+4+/B71pnLFnYahHq5Lz8jzvgZ64Jprx2VCRj3N2bHgg6XRJI2Voho0dVWnACcf3zOnKAt5JpXi0IFfCv/56dycT7lfB8Igu/Hz+6EC1ChP5suJCVnsAgzYO3c23rO9/5xbx8aMW9Qn099ehDEtpQ/we48RnSE7VrQuYY3sOST36W7Clv4J7Cj/GPcI6FOHHOcEJTCNHy40U1fLObfx8fxk7lO5jLLrvTRRxGw7fY62MmwHk3dc0z2+l6tobydIRr58HHQxKOvTqoBWupQv6J1hnFgNq2GRHRm+ClheMuutd9haZNFq9GIlO4Zr2MIW4X2mwUJt62ViAicGVPs1pbqCP4sJg1E7usUveb7tM+ZiaMrL5bRjkU0NbjfNQnaoDi8wPErB3s35qHkc2cWwPwIvDHYORk7go/2FOnhC9s9+huRdHJJl35hRyC9+Z22rGl+aM3xRobO1qGUq24sboyzxkvtnXzbxbik9PFTsz0LoqiZBFDnUmWL97EitpHaIXkdQXlbeHkFmDUGuaFuQ7pEz0YG0C3YCH0PlcTHkhOzOQD3xsKFAVkKkvnlOeeG+HurCE651ozrjHmN8c0USUygZOqqbYhQIvMb1p4KhnMFPHgpZcodNIN3ILnp60rWnrmR6ciJHxCnQuhItTdpHSSb7WOMHY4ubc4xHutwRyoOpF4QfB9w0Rph/M8VZLFj2kxdousDMEWollY1aH3bxL1BRCIXGp6j0rD+f87OLaw68Y6jtagZ/tse6UjJ8V92JVSEcphvaL76z7A8TG7QitFqX7PYd6w50g4pccVM+nSAq9Rmt6HubYbjYze5/+aj/K51VjOAGOJYu0nI5bp8KIigzZlx3ufs3OYdSAW+pQEvDukaujRlipqk/pEIW0ZRsvgXNCJePxfNkGI9NWQ6s8P8KTGmvJooOZXQS+RJ/C9VrwOo+ApivH7L7/usKyxTQGctgM5JqI3N5TW6VCrqLZDIxjqukQZvnTdxUtP/Gwa7qe2ssEBcqvoQeyI2bfdjYrO01fP45K0OtUNHYpYg/KZQCOUlq7AQIueZVgmaa6XWOinL2rLa+H5TcvogE8NfSZf3AIdgddZqqzsLnRfM13MNIZPr4DYIzYyhmWgQyLN29j87ATAuqS+hG9AMmBQvEaoKQAzBIXPZ+21dzZ9QDpcUMFYoczvn1uET2//3HIaKIJwtVdkmDwJ8j3o7rkS87oWrU2SJ+kedTeNxNAswtj1AfSPBNA4q+K1QXanjxeGgbP2jo1Wd2FunSxXIW2pv9MCAZoBsmbV1Yynw5IbM3S2NkeszjFznKE5UcntVYbOgbhtIjywdNeY6M/73JeyzDaic7f86Ys3EXCzmZ8KuSZP8HgUZoMdU+O3w8DRjP/Gc1lsBi/bzyqk0OkHq4Jl7AuX296uzJiNQ+pCBSJq+FW6rV8y6W2pqdwm91btnMUc3e8fNNLLa05xboAYhX7OsMlCBfQGY2m7jBjKiMOCceuRA3rhvI+8LOXo0kb3HcJC5MefMRfytRyDZqJxmIsF4jHHRY21qBzh//ZavJ5Cs8H8d7UG1FBHJxV/lk3kR+9yGVe9Ryen2MDPL6kJetA6KWS3QN0MlYXzXGzxNC5xHff1AMXrKFyl7FAF0aw6zQNtnx4PoJoGUwQwjlpArPbHFCR1fosEfS1C6A8s5dqyJQ1+2B0m5wBaCbvUDr8zns6q4WzGshr7Agq+QJkfr38ysWfjdUlZMmgg/PBQRZ5tine6Kvi2nwoBBMmyJu+bs25MV2XbEBCJXfqrmGqKEsI5in++raG25RwKH1ip0XXzdXMyBUor7uCqUgMN7zmZvIaGDKhHTN1yxM20h7l32nAE0PjoTWZ/17eGavIsPfRN08juvfdCZ4BnjXy5kJqYjijx1s0k9oZ/QkrG71Yj8gjpcfI5wNqX15J4lftflnmAUmIGkz7tFYUK5Ak6VXt0spG9WRjPsP/LQiuGcAZBI9prDnUQpeA6kKbxd942vcpTtL25BDKGSyu78ejuB+m2qFXSsHQzkt1mCykDEBj/AdkOSTVlNRW/dRnIW/8d8SqwFGyWFjqH0FKVk6qmPHWqv23vNLx1eooja0oNRgyrm9c2/ro6lh9ObD2LfdU2VEoUSu3SQo5Bf5hMlRH27eKZHPa+8EsKD3JdIUIuQVjoh5+bJ1oggXSv2DXUoufuzytIFQDzw1Km58JgMY5zXCYa7TF0TuZJc7VpLmbeE0dGDwbLx7uxl1UQapHx4QTCdOc19Ms7Gi+imIhXNEMtZ0r7lbJeLmmLHkCjJMbRAAKV3nTg55v1fW3jKqMwStdOKpwI3HItnvE89wUtbCo409+xyXHDTZA3uqrm6YrUdz2yk9DsWRHEHbo/l34UrSCLSFBwCgNfAjVn55CFCQypqUoQ7RuJQwVXNRw7SV2SdlL+UdOUS0iWFeYtMxF+mrE6v779x8b6ubolRCnHNEWnqMYUYBhBLifzgBT/8vkSTVemLA8+XEfhdvOiFW/8Rpd1m0ImeCWc1wHVuzkgKalgNqQhHu3n5KFu8seQNGGzz/mbRZ0aF+6AHs12QcDYtxjOg01gM6k6gOyzO2LyMIzAK46mSxe/A0ycp9WrmrH2KQmTFcb+1gpvzBeqWyt47MDspmn83JQKvSj492Rt7W5ovSDUFpL7BUjrHQoLiJ3TYwrmkU4a9Cqj7Pn7orQa8I+vUB6PETBHgGHAq9YxCMhogMCqSp2M1n4Apfa4ytxpTJqVy4K93nk7Wl/ma/KcUh+AkfEHOTsvUqBJNndRsSmbiA7Bm4q1KAw/B8aq33L4jDf9M4NAqfmrsdKGedu0kyT6mtB4hSqVMv/BmGZCKEOE3/FNRP2bOW5ongpFfCiRBOBFT6BJ7hUqpYsNs9QDQHb3SLQ8emW0shPK81ahlbozWgoWb3Kb+I8n3LFv/J2Lg9OGY0Iy6bW9iwVkqr+wxDDIP4H/KoEWAGhp0OjSEQ7sDGdzmZw9PmeISIyTRHdS1QVqphn471Ru5KPfFB1evtFHzPnC5itFuSAwrmNH2KXLXk66fFcRXy24WuVuf0DxYLtFdJJwWOjMiKSj1VgFhMmOAiLB0ed1QqRclgdDTYCGzdFCNK4gjhd9iDg5wPFOaH//1dCXLNYwusFKlySXFRHVLQ3YiNXyeb4yXmFRhOGHIQRiiWV9UyrBl82Jj3pSfDag0xBQv299Fah4cX1tO/LyVrV+yO5teWLtF0o1pxFtu/w/XpUJ/1GuiqRsntfNYjiWeCpd7RAGre8UB84HZisvaCHB/12waLs1UQ59mSY/KEa8NCnmW0BXHe4SEWp19a2JwXUoroeTuwwSLrF4f2SIHbHYu5GpurKZF0zBztu3xD241kGaYZyF5QJlXaSBaB9kk0H7U6ensy5owxJWkbeA4fvDUHPkvqMOtAH0YbFeymU7O/CYSswc3Ht6PhlbciscB+YZ997ZnGLCn1QEJfwhpPUoPIdB2AL7l6WOMAnWZkCbgblRZmvVUhIo9oMXbPdjN5zJKH1b10hMXyGaBV1VZmQSt2/4NNex7Pa5BqDvgrG82Fs1G78JMVcjMZ8vr+p+TsRPzyjqMXLNy8S/g6L6BwwWRGBTyREpSGMcZsTeP5ix7PDHamLNzqNZ4eqgDUbm7ubAc7WW3R4fmKd8x46qfJ0XulM98MjkjaTM+a2cpCeZqXC5+v7phtIKtQ0Zwb3/TTR76dl7aI+/io5oJ7kkdoJsZu/snpLGvxpul23u4KWOBZfvtN3mImcImJdUOrgr5ZFy2rRPHDGKmqdl7Kv+WOVqc+7bouQC3twcrZKOap9I2XrmWOrA+EoVs+W/wNxagY4ey6lDnzAkxAL/pohL2pRXKRI/+YWMC/w9eUpT7yeFZHqU8m1u70fLr9qw5SmC79ayzf3CSt3XXLcrp2Sf9c5JL94P3UYydfbpg/8H1lsc17ao03TNT4V0GW8RPBjuti7h289glN6eWKb5SrUBwpeEosmUnP5XYSEfyR4tBagPQkQlKqAU8gpFQ7E2cIKObZNTVcxUs+1hg5RllFCthZJswGyYWFIwoonfioG/AM8Y2CLcDuMifpuE/ZD/ZHClTu7vTAs3BWvidXFr8AsUu/VD3jCnkKoJA==" />
</div>


<script src="/ScriptResource.axd?d=X-TGQ30F3VnfxHT9dWyG6yFJmtQD69Lm0eMwV4hQ-4u73uhB13Z4lp0qZjro2ATlpkRt7sEIhrNm4kB289hR5VL1-bhwNKnyUwm6Yp9fujxJnuEfrMYY69rJmjL-XdUywFdCFaG6KTG_r0XoTinnN_0S_b1X4UTdOePMr-RmMKN3vwsODseIVwn5n0dNyRgA5D2c_HAtb0uMI5TiE_DOprkfUUn629e2kfv5sldecSQ6Uj7OsCFXlg4YRliZ1bOuRp4b3YS4z2F4u86nuai70E-4LRNOepYZy9pwSfDxj3Cica589eh5xFXs5E45lsZ8IqBMA9jJ1PnDXm8BoT-m0c9QxukCHWM5jLiXTpaH98VzwsmEOkqwjPQV2TZtbPLyS6CWC54zBRPJuAOluEkSRM8eN5DWjpI2VNbcsg0Pv746s7ZHJlIr66YJdaZEV45kgUqgNA2" type="text/javascript"></script>
<script src="/ScriptResource.axd?d=CWoArlWjS2F1NydwJXSK8DrL-Br5fSxfzoxqcyFnTH6sXzR_KNm7Ob_9tcNfPOuLB7mC_TJu_en6ERB3wotdQ_yMei5oFAkmUKI8QYyjuz7JlJrgNMjOtPmBXR84Q_u3iwsz1g2&amp;t=ffffffffa10097f3" type="text/javascript"></script>
<script src="Thumbs/Avatar.asmx/js" type="text/javascript"></script>
<div>

	<input type="hidden" name="__VIEWSTATEENCRYPTED" id="__VIEWSTATEENCRYPTED" value="" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="2MA5X5gb9im4IPA20ruXJKDCAIw9WCqT9p4d9xBIGailHre66hTzuVdg6ZUTmK/t/lQH3roGB1Jz86cOmVduO6gWWUrnsseyr2QgRYE/ZDUTC8r5UjuGJoUpfJXC76mWvAhOLCCuGG2MwYD1bN6hKN/LpnibVGhiUiVQhImaYDbYMH+sR+KRPRqh67X5TGjk/aBn2VcAJYI5y9HXxSDUG4DMywDN2TVCFuhdqB5h2ouaMlf1F/lJK4EO9AFJiMwWhoUBLYY92Ea3yi2Ue6PJ63k2eQNrrsBmDMXLAAo/zZwFNvWCJ+m3tDHQ55w6YUQnxnW2JMWTUL5YWjrN/NkYJ/3XyvlskWD890izUPdHybOTaxa+" />
</div>
    <div id="fb-root">
    </div>
    
    
         
    
    
    
        <div class=""><div class="">
    <div id="MasterContainer" >
           
        

<script type="text/javascript">
$(function(){
    function trackReturns() {
	    function dayDiff(d1, d2) {
		    return Math.floor((d1-d2)/86400000);
	    }
        if (!localStorage) return; 

	    var cookieName = 'RBXReturn';
	    var cookieOptions = {expires:9001};
        var cookie = localStorage.getItem(cookieName) || {};

	    if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
	        localStorage.setItem(cookieName, { ts: new Date().toDateString() });
		    return;
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
	
	    localStorage.setItem(cookieName, cookie);
    }

    
        RobloxListener.restUrl = window.location.protocol + "//" + "roblox.com/Game/EventTracker.ashx";
        RobloxListener.init();
    
    
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
            
                
                                                            
<?= SiteHeader::render() ?>
<script type="text/javascript">
    $(function () {
        $('.more-list-item').bind('showDropDown', function () {
            var maxWidth = $('#navigation-menu .dropdownnavcontainer').width();
            $('a.dropdownoption span').each(function (index, elem) {
                elem = $(elem);
                if (elem.outerWidth() > maxWidth) {
                    maxWidth = elem.outerWidth();
                }
            });
            maxWidth = maxWidth + 5;
            $('#navigation-menu .dropdownoption').each(function (index, elem) {
                elem = $(elem);
                if (elem.width() < maxWidth) {
                    elem.width(maxWidth);
                }
            });
        });
    });
    
    
</script>
                <style>
                    html {
                        background: #123f83;
                    }
                </style>
                
        </div>

        


        <div class="forceSpace">&nbsp;</div>
    <div id="AdvertisingLeaderboard">
        
<iframe
    allowtransparency="true"
    frameborder="0"
    height="110"
    scrolling="no"
    src="/userads/1"
    width="728"
    data-js-adtype="iframead"></iframe>
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
    <div>
        
<div style="width:900px;height:30px;clear:both; display:none;">
    <span id="ctl00_cphRoblox_rbxHeaderPane_nameRegion" style="font-size:20px; font-weight:bold;"><?= $user['username'] ?></span>
</div>




        
        <div style="clear: both; margin: 0; padding: 0;"></div>
        <div class="divider-right" style="width: 484px; float: left">
            

<h2 class="title">
    <span id="ctl00_cphRoblox_rbxUserPane_lUserRobloxURL"><?= $user['username'] ?>'s Profile</span></h2>
<div class="divider-bottom" style="position: relative;z-index:3;padding-bottom: 20px">
    <div style="width: 100%">
        <div id="ctl00_cphRoblox_rbxUserPane_onlineStatusRow">
            <div style="text-align: center;">
                
                <span id="ctl00_cphRoblox_rbxUserPane_lUserOnlineStatus" class="UserOfflineMessage">[ Offline ]</span>
                
            </div>
        </div>
        <div>
            <div>
                <center class="UserPaneContainer">
                    <div style="margin-bottom: 10px;">
                        
                    </div>
                    <a id="ctl00_cphRoblox_rbxUserPane_AvatarImage" disabled="disabled" class=" notranslate" title="<?= $user['username'] ?>" class=" notranslate" onclick="return false" style="display:inline-block;height:352px;width:352px;"><img src="/Images/Placeholder1024x1024.png" height="352" width="352" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?= $user['username'] ?>" class=" notranslate" /></a>
                    <br />
                    <div class="PointsContainer">
                        
<img class="points-image" src="//images.rbxcdn.com/d73731e112f8a06ce3978d7755b2ab8d.png" alt="User Points"/><span class="points-text">Player Points: <span class="roblox-se-player-points " title="0">0</span></span>

                    </div>
                    
                    

<div class="UserBlurb" style="margin-top: 10px; overflow-y: auto; max-height: 450px; ">
    <?= $user['description'] ?>
</div>
<div id="ProfileButtons" style="margin:10px auto;">
    
            <a id="FriendButton" class="btn-control btn-control-large disabled">Send Friend Request</a>
        
    <div class="SendMessageProfileBtnDiv">
        
        <a  id="MessageButton" style="margin:0 5px" class="btn-control btn-control-large "  href="/My/NewMessage.aspx?RecipientID=1025053">Send Message</a>
    </div>
	
    <div class="clear"></div>
    <script type="text/javascript">
        function hideDropdowns() {
            $('.GrayDropdown .Button.Active').removeClass('Active').siblings('.Menu').hide();
        }

        $('#ProfileButtons').width($('#FriendButton').outerWidth() + $('#MessageButton').outerWidth() + $('#MoreButton').outerWidth() + 18);
        $('.GrayDropdown .Button').click(function () {
            var show = !$(this).hasClass('Active');
            hideDropdowns();
            if (show) {
                $(this).addClass('Active').siblings('.Menu').show();
            }

            return false;
        });
        $(document).click(function () {
            hideDropdowns();
        });
        $('#MoreButton [original-title]').tipsy();
        var friendRequestButton = $(".friend-request-button");
        
            friendRequestButton.click(function () { window.location = "/Login/Signup.aspx"; });
        
    </script>
</div>

                    <div class="ProfileAlertPanel" style='display: none; margin: 15px auto 0px auto; width: 205px;'>
                        
                        <br />
                    </div>
                    <div style="margin-right: 20px">
                        
                    </div>
                    
                    
                </center>
            </div>
        </div>
    </div>
</div>

            


<h2 class="title">
<span>ROBLOX Badges</span>
</h2>

<div class="divider-bottom" style="padding-bottom: 20px">
    <div style="display: inline-block">
	    <table id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges" cellspacing="0" align="Left" border="0" style="border-collapse:collapse;">
	<tr>
		<td>
			    <div class="Badge" class="notranslate">
				    <div class="BadgeImage"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl00_hlHeader" href="Badges.aspx#Badge3"><img id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl00_iBadge" src="//images.rbxcdn.com/d111059fca163b9824716cff2fe4aec5.png" alt="This badge is given to any player who has proven his or her combat abilities by accumulating 10 victories in battle. Players who have this badge are not complete newbies and probably know how to handle their weapons." style="height:75px;width:75px;border-width:0px;" /></a></div>
				    <div class="BadgeLabel"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl00_HyperLink1" href="Badges.aspx#Badge3">Combat Initiation</a></div>
			    </div>
		    </td><td>
			    <div class="Badge" class="notranslate">
				    <div class="BadgeImage"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl01_hlHeader" href="Badges.aspx#Badge4"><img id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl01_iBadge" src="//images.rbxcdn.com/14652f1598ba5520515965b4038214c0.png" alt="This badge is given to the warriors of Robloxia, who have time and time again overwhelmed their foes in battle. To earn this badge, you must rack up 100 knockouts. Anyone with this badge knows what to do in a fight!" style="height:75px;width:75px;border-width:0px;" /></a></div>
				    <div class="BadgeLabel"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl01_HyperLink1" href="Badges.aspx#Badge4">Warrior</a></div>
			    </div>
		    </td><td>
			    <div class="Badge" class="notranslate">
				    <div class="BadgeImage"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl02_hlHeader" href="Badges.aspx#Badge2"><img id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl02_iBadge" src="//images.rbxcdn.com/46c15f2030a8c68ab1ff4329765e515a.png" alt="This badge is given to players who have embraced the Roblox community and have made at least 20 friends. People who have this badge are good people to know and can probably help you out if you are having trouble." style="height:75px;width:75px;border-width:0px;" /></a></div>
				    <div class="BadgeLabel"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl02_HyperLink1" href="Badges.aspx#Badge2">Friendship</a></div>
			    </div>
		    </td><td>
			    <div class="Badge" class="notranslate">
				    <div class="BadgeImage"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl03_hlHeader" href="Badges.aspx#Badge5"><img id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl03_iBadge" src="//images.rbxcdn.com/4cb4d69560f1f3478c314b24a52d2644.png" alt="Anyone who has earned this badge is a very dangerous player indeed. Those Robloxians who excel at combat can one day hope to achieve this honor, the Bloxxer Badge. It is given to the warrior who has bloxxed at least 250 enemies and who has tasted victory more times than he or she has suffered defeat. Salute!" style="height:75px;width:75px;border-width:0px;" /></a></div>
				    <div class="BadgeLabel"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl03_HyperLink1" href="Badges.aspx#Badge5">Bloxxer</a></div>
			    </div>
		    </td><td>
			    <div class="Badge" class="notranslate">
				    <div class="BadgeImage"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl04_hlHeader" href="Badges.aspx#Badge12"><img id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl04_iBadge" src="//images.rbxcdn.com/088451f70609387491bbf8e85f285065.png" alt="This decoration is awarded to all citizens who have played ROBLOX for at least a year. It recognizes stalwart community members who have stuck with us over countless releases and have helped shape ROBLOX into the game that it is today. These medalists are the true steel, the core of the Robloxian history ... and its future." style="height:75px;width:75px;border-width:0px;" /></a></div>
				    <div class="BadgeLabel"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl04_HyperLink1" href="Badges.aspx#Badge12">Veteran</a></div>
			    </div>
		    </td>
	</tr><tr>
		<td>
			    <div class="Badge" class="notranslate">
				    <div class="BadgeImage"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl05_hlHeader" href="Badges.aspx#Badge14"><img id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl05_iBadge" src="//images.rbxcdn.com/216b8349596e3293affe6dada49cea6a.png" alt="The Ambassador Badge is earned by participating in the Roblox Ambassador Program. Submit at least 3 unique links to the program to win this badge. Spread the glory of Robloxia to the furthest corners of the known Internet!" style="height:75px;width:75px;border-width:0px;" /></a></div>
				    <div class="BadgeLabel"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl05_HyperLink1" href="Badges.aspx#Badge14">Ambassador</a></div>
			    </div>
		    </td><td>
			    <div class="Badge" class="notranslate">
				    <div class="BadgeImage"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl06_hlHeader" href="Badges.aspx#Badge6"><img id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl06_iBadge" src="//images.rbxcdn.com/26bdc9274d6c2520b3d72ebaa71e50f7.png" alt="The homestead badge is earned by having your personal place visited 100 times. Players who achieve this have demonstrated their ability to build cool things that other Robloxians were interested enough in to check out. Get a jump-start on earning this reward by inviting people to come visit your place." style="height:75px;width:75px;border-width:0px;" /></a></div>
				    <div class="BadgeLabel"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl06_HyperLink1" href="Badges.aspx#Badge6">Homestead</a></div>
			    </div>
		    </td><td></td><td></td><td></td>
	</tr>
</table>
	    
    </div>
</div>

            <div id="BadgesDisplayPane" class="divider-bottom" style="clear: both; padding-bottom: 20px">
                



<h2 class="title"><span>Player Badges</span></h2>
<div class="" style="min-height:300px;">
	    
    <div id="ctl00_cphRoblox_rbxBadgesDisplay_BadgesUpdatePanel" class="BadgesUpdatePanel">
	
            <div class="BadgesLoading_Container"></div>
            <div class="BadgesListView_Container">
                
                         
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl0_AssetThumbnailHyperLink" title="The Last Egg (Creator: Games)" href="/The-Last-Egg-item?id=76680134" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t5.rbxcdn.com/ae84e241a7ffd439c412704d0c2e041f" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="The Last Egg (Creator: Games)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo1013329633">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl0_AssetNameHyperLink" title="click to view" href="/The-Last-Egg-item?id=76680134">The Last Egg</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl0_AssetCreatorHyperLink" href="User.aspx?ID=21557">Games</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl1_AssetThumbnailHyperLink" title="50k Visits PARTY (Creator: Wehttam664)" href="/50k-Visits-PARTY-item?id=25561737" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t6.rbxcdn.com/981ae810c69a167527e6da81fcbe1c86" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="50k Visits PARTY (Creator: Wehttam664)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo754505320">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl1_AssetNameHyperLink" title="click to view" href="/50k-Visits-PARTY-item?id=25561737">50k Visits PARTY</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl1_AssetCreatorHyperLink" href="User.aspx?ID=4714828">Wehttam664</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl2_AssetThumbnailHyperLink" title="Skilled Knight (Creator: stickmasterluke)" href="/Skilled-Knight-item?id=27414750" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t2.rbxcdn.com/97e58afda1eb6b9adfce024b5c88c446" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Skilled Knight (Creator: stickmasterluke)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo562522755">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl2_AssetNameHyperLink" title="click to view" href="/Skilled-Knight-item?id=27414750">Skilled Knight</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl2_AssetCreatorHyperLink" href="User.aspx?ID=80254">stickmasterluke</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl3_AssetThumbnailHyperLink" title="Thanks for coming! (Creator: bl0wmeup)" href="/Thanks-for-coming-item?id=32211757" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t7.rbxcdn.com/4c46606b237cbf326ac7d3dcf36b4a08" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Thanks for coming! (Creator: bl0wmeup)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo516248131">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl3_AssetNameHyperLink" title="click to view" href="/Thanks-for-coming-item?id=32211757">Thanks for coming!</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl3_AssetCreatorHyperLink" href="User.aspx?ID=5397041">bl0wmeup</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl4_AssetThumbnailHyperLink" title="Gateway to the stars! (Creator: dragonare)" href="/Gateway-to-the-stars-item?id=14444640" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t4.rbxcdn.com/de89044a2726207908b76094d711b63e" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Gateway to the stars! (Creator: dragonare)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo508023265">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl4_AssetNameHyperLink" title="click to view" href="/Gateway-to-the-stars-item?id=14444640">Gateway to the stars!</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl4_AssetCreatorHyperLink" href="User.aspx?ID=696009">dragonare</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl5_AssetThumbnailHyperLink" title="The Bandit Cave (Creator: Nawtz)" href="/The-Bandit-Cave-item?id=35648350" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t0.rbxcdn.com/ea3abac8378c9ece75c80990500371e0" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="The Bandit Cave (Creator: Nawtz)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo504748967">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl5_AssetNameHyperLink" title="click to view" href="/The-Bandit-Cave-item?id=35648350">The Bandit Cave</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl5_AssetCreatorHyperLink" href="User.aspx?ID=2898823">Nawtz</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl6_AssetThumbnailHyperLink" title="Woah you was rich! (Creator: Infinitive)" href="/Woah-you-was-rich-item?id=28897121" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t6.rbxcdn.com/13d68a53759427f282d3ec8cafc1585e" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Woah you was rich! (Creator: Infinitive)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo503785783">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl6_AssetNameHyperLink" title="click to view" href="/Woah-you-was-rich-item?id=28897121">Woah you was rich!</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl6_AssetCreatorHyperLink" href="User.aspx?ID=7644128">Infinitive</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl7_AssetThumbnailHyperLink" title="1,000,000 Visits! (Creator: ZamSonGod)" href="/1-000-000-Visits-item?id=42306045" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t6.rbxcdn.com/47d1af21b59c8eef032be6320c85637e" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="1,000,000 Visits! (Creator: ZamSonGod)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo464669362">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl7_AssetNameHyperLink" title="click to view" href="/1-000-000-Visits-item?id=42306045">1,000,000 Visits!</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl7_AssetCreatorHyperLink" href="User.aspx?ID=1660343">ZamSonGod</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl8_AssetThumbnailHyperLink" title="Traveller (Creator: ZamSonGod)" href="/Traveller-item?id=36145315" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t1.rbxcdn.com/3165ac9f3e6514251630b43fd1e6d822" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Traveller (Creator: ZamSonGod)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo464669358">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl8_AssetNameHyperLink" title="click to view" href="/Traveller-item?id=36145315">Traveller</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl8_AssetCreatorHyperLink" href="User.aspx?ID=1660343">ZamSonGod</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl9_AssetThumbnailHyperLink" title="I Played RainyDude&#39;s Obstical Course  (Creator: RainyDude)" href="/I-Played-RainyDudes-Obstical-Course-item?id=32291378" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t6.rbxcdn.com/5f937dd6468a468ba9cdd1f720d99c37" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="I Played RainyDude&#39;s Obstical Course  (Creator: RainyDude)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo384328727">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl9_AssetNameHyperLink" title="click to view" href="/I-Played-RainyDudes-Obstical-Course-item?id=32291378">I Played RainyDude's Obstical Course </a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl9_AssetCreatorHyperLink" href="User.aspx?ID=3735903">RainyDude</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl10_AssetThumbnailHyperLink" title="Your now a Knight! (Creator: JonnyRockz)" href="/Your-now-a-Knight-item?id=21070811" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t6.rbxcdn.com/7a0f1c3d1814840c3abc76453969c3e4" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Your now a Knight! (Creator: JonnyRockz)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo382516022">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl10_AssetNameHyperLink" title="click to view" href="/Your-now-a-Knight-item?id=21070811">Your now a Knight!</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl10_AssetCreatorHyperLink" href="User.aspx?ID=1271319">JonnyRockz</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl11_AssetThumbnailHyperLink" title="Rainbow (Creator: sanchez002)" href="/Rainbow-item?id=32455022" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t7.rbxcdn.com/81fdea28d42affc8078221f4d06e1b58" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Rainbow (Creator: sanchez002)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo382016814">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl11_AssetNameHyperLink" title="click to view" href="/Rainbow-item?id=32455022">Rainbow</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl11_AssetCreatorHyperLink" href="User.aspx?ID=6460548">sanchez002</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl12_AssetThumbnailHyperLink" title="Welcome (Creator: sanchez002)" href="/Welcome-item?id=31177718" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t4.rbxcdn.com/f47b36958cd2c639dd93ddc2d0949073" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Welcome (Creator: sanchez002)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo382016630">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl12_AssetNameHyperLink" title="click to view" href="/Welcome-item?id=31177718">Welcome</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl12_AssetCreatorHyperLink" href="User.aspx?ID=6460548">sanchez002</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl13_AssetThumbnailHyperLink" title="Pyramid (Creator: Aurarus)" href="/Pyramid-item?id=18268422" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t7.rbxcdn.com/01c6657e722a4be5faa8417bdee78697" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Pyramid (Creator: Aurarus)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo380745946">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl13_AssetNameHyperLink" title="click to view" href="/Pyramid-item?id=18268422">Pyramid</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl13_AssetCreatorHyperLink" href="User.aspx?ID=1826533">Aurarus</a></span></div>
                            </div>
                        </div>
                    
                        <div class="TileBadges">
                                <a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl14_AssetThumbnailHyperLink" title="Thank You For Playing! (Creator: Aurarus)" href="/Thank-You-For-Playing-item?id=18267740" style="display:inline-block;height:75px;width:75px;cursor:pointer;"><img src="//t7.rbxcdn.com/ab1cc5909594a4799f506eded1e05ce7" height="75" width="75" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Thank You For Playing! (Creator: Aurarus)" /></a>
                        
                    
                            <div class="AssetDetails" style="display:none;" id="badgeInfo380743751">
                                <div class="AssetName notranslate"><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl14_AssetNameHyperLink" title="click to view" href="/Thank-You-For-Playing-item?id=18267740">Thank You For Playing!</a></div>
                                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail notranslate" ><a id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeListView_ctrl14_AssetCreatorHyperLink" href="User.aspx?ID=1826533">Aurarus</a></span></div>
                            </div>
                        </div>
                    
                    
            </div>
            
            <div class="BadgesPager_Container" style="clear:both;text-align:center;bottom: 5px;left: 75px;">
                <span id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeDataPagerFooter"><a disabled="disabled" class="pager previous"></a>&nbsp;
                        <span style="display: inline-block; padding: 5px; vertical-align: top">
                        Page
                        <span id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeDataPagerFooter_ctl01_CurrentPageLabel">1</span>
                        of
                        <span id="ctl00_cphRoblox_rbxBadgesDisplay_BadgeDataPagerFooter_ctl01_TotalPagesLabel">11</span>
                        </span>
                        <a class="pager next" href="javascript:__doPostBack(&#39;ctl00$cphRoblox$rbxBadgesDisplay$BadgeDataPagerFooter$ctl02$ctl00&#39;,&#39;&#39;)"></a>&nbsp;</span>
            </div>
        
</div>
	<div style="clear:both;"></div>
</div>

<script type="text/javascript">
    $('#' + 'ctl00_cphRoblox_rbxBadgesDisplay_BadgesUpdatePanel').bind('click', function (e) {
        var target = $(e.target);
        if (target.parentsUntil('.BadgesUpdatePanel', '.BadgesPager_Container').length > 0 && target[0].tagName == 'A') {
            //put up loading sign
            $('.BadgesListView_Container').html("");

            window.setTimeout(function () {
                if ($('.BadgesListView_Container').html() == "") {
                    $('.BadgesLoading_Container').html('<div style="text-align: center;margin-top: 25px;"><img src="/images/ProgressIndicator4.gif" alt="Loading..." /></div>');
                }
            }, 1000);
        }
    });
</script>
            </div>
            <div id="UserGroupsPane" style="clear:both;">
                <h2 class="title">
                    <span>Groups</span></h2>
                

<div class="divider-bottom" style="clear:both; padding-bottom: 20px;">
    <div id="ctl00_cphRoblox_rbxUserGroupsPane_pNoResults">
	
		<p class="NoResults"><span id="ctl00_cphRoblox_rbxUserGroupsPane_lNoResults"><?= $user['username'] ?> is not in any groups.</span></p>
	
</div>
    <div id="ctl00_cphRoblox_rbxUserGroupsPane_ctl00">
	
            
            
        
</div>
    <div style="clear:both"></div>
</div>

            </div>
            

<style>
.statsLabel { font-weight:bold; width:200px; text-align:right; padding-right:10px;}
.statsValue { font-weight:normal; width:200px; text-align:left;}
.statsTable { width:400px; }
</style>
<h2 class="title"><span>Statistics</span></h2>

<div class="divider-bottom" style="padding-bottom: 20px">
<table class="statsTable">
    <tr>
        <td class="statsLabel">
        <acronym title="The number of this user's friends.">Friends</acronym>:
        </td>
        <td class="statsValue">
        <span id="ctl00_cphRoblox_rbxUserStatisticsPane_lFriendsStatistics">0</span>
        </td>
    </tr>
    
    <tr>
        <td class="statsLabel"><acronym title="The number of posts this user has made to the ROBLOX forum.">Forum Posts</acronym>:</td>
        <td class="statsValue"><span id="ctl00_cphRoblox_rbxUserStatisticsPane_lForumPostsStatistics" class="notranslate">0</span></td>
    </tr>
    <tr>
        <td class="statsLabel"><acronym title="The number of times this user's place has been visited.">Place Visits</acronym>:</td>
        <td class="statsValue"><span id="ctl00_cphRoblox_rbxUserStatisticsPane_lPlaceVisitsStatistics" class="notranslate">0</span></td>
    </tr>
    <tr>
        <td class="statsLabel"><acronym title="The number of times this user's character has destroyed another user's character in-game.">Knockouts</acronym>:</td>
        <td class="statsValue"><span id="ctl00_cphRoblox_rbxUserStatisticsPane_lKillsStatistics" class="notranslate"><?= number_format($user['knockouts']) ?></span></td>
    </tr>
    
     <tr>
        <td class="statsLabel"><acronym title="The all-time highest voting accuracy this user has achieved when voting in contests.">Highest Ever Voting Accuracy</acronym>:</td>
        <td class="statsValue"><span id="ctl00_cphRoblox_rbxUserStatisticsPane_lHighestEverVotingAccuracyStatistics">100</span>%</td>
    </tr>
     
</table>    
</div>
            

<div style="padding-bottom: 20px">
    <div>
        <h2 class="title" style="display:block;float: left;">
            <span class="notranslate"><?= $user['username'] ?></span>'s Sets
        </h2>
        <a data-js-my-button href class="btn-small btn-neutral" id="ToggleBetweenOwnedSubscribedSets" style="float: right; margin-right: 20px; margin-top: 25px" onclick="Roblox.SetsPaneObject.toggleBetweenSetsOwnedSubscribed();return false;" >View Subscribed<span class="btn-text" id="SetsToggleSpan">View Subscribed</span></a>
        <div class="clear"></div>
    </div>
    <div id="OwnedSetsContainerDiv" style="padding-bottom:0;">
        <div id="SetsItemContainer" style="margin-bottom: 30px; margin-left: 15px"></div>
        <div style="clear:both;"></div>
        <div class="SetsPager_Container" style="position: relative">
            <div id="SetsPagerContainer"></div>
        </div>
    </div>
    <div id="SubscribedSetsContainerDiv" style="display:none; padding-bottom: 0px">
        <div id="SubscribedSetsItemContainer" style="margin-bottom: 30px; margin-left: 15px"></div>
        <div style="clear:both;"></div>
        <div class="SetsPager_Container" style="position: relative">
            <div id="SubscribedSetsPagerContainer"></div>
        </div>
    </div>
    
    <div id="SetsPaneItemTemplate" style="display:none;">
        <div class="AssetThumbnail">
            <img class="$ImageAssetID"></img>
        </div>
        <div class="AssetDetails">
            <div class="AssetName notranslate" >
                <a href="/My/Sets.aspx?id=$ID">$Name</a>
            </div>
            <div class="AssetCreator">
                <span class="Label">Creator:&nbsp;</span>
                <span class="Detail">
                    <a href="/User.aspx?id=$CreatorUserID" class="notranslate">$CreatorName</a>
                </span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    if (typeof Roblox === "undefined") {
        Roblox = {};
    }

    $(function () {
        Roblox.SetsPaneObject = Roblox.SetsPane('//www.roblox.com/', 1025053);

        var options = { Paging_PageNumbers_AreLinks: false };
        Roblox.OwnedSetsJSDataPager = new DataPager(0, 9, 'SetsItemContainer', 'SetsPagerContainer',
            Roblox.SetsPaneObject.getSetsPaged, Roblox.SetsPaneObject.ownedItemFormatter, Roblox.SetsPaneObject.getSetAssetImageThumbnail, options
        );
        Roblox.SubscribedSetsJSDataPager = new DataPager(0, 9, 'SubscribedSetsItemContainer', 'SubscribedSetsPagerContainer',
            Roblox.SetsPaneObject.getSubscribedSetsPaged, Roblox.SetsPaneObject.subscribedItemFormatter, Roblox.SetsPaneObject.getSetAssetImageThumbnail, options
        );
    });
</script>

            
        </div>
        <div class="divider-left" style="width: 478px; float: left; position: relative; left: -1px">
            <div class="divider-bottom" style="padding-bottom: 20px; padding-left: 20px">
                <h2 class="title" style="float: left">
                    <span>Active Places</span>
                </h2>
                
                <div id="UserPlacesPane">
                    <div id="ctl00_cphRoblox_rbxUserPlacesPane_pnlUserPlaces">
	
<div id="UserPlaces" style="overflow: hidden">

    <div id="accordion" class="accordion">
    
        <div class="accord-section accord-section-open">
            <div class="accord-header notranslate">
                <div class="accord-arrow">&#x25b6;</div>
			    Create Stuff, Including Weapons
            </div>
            <div class="accord-content notranslate">
			    

<div class="Place">
    
    <div class="PlayStatus">
        
<span class="PlaceAccessIndicator">
	<span id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcasePlaces_ctl00_rbxPlatform_rbxPlaceAccessIndicator_FriendsOnlyLocked" style="display: none">
        <a class="iLocked tooltip" title="Friends Only"></a><span class="invisible">&nbsp;Friends-only</span>
	</span>
    <span id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcasePlaces_ctl00_rbxPlatform_rbxPlaceAccessIndicator_FriendsOnlyUnlocked" style="display: none">
        <a class="iUnlocked tooltip" title="Friends Only - You are friends"></a><span class="invisible">&nbsp;Friends-only: You are friends</span>
	</span>
	<span id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcasePlaces_ctl00_rbxPlatform_rbxPlaceAccessIndicator_ExpiredSelf" style="display: none">
        <a class="iLocked tooltip" title="Locked"></a>
        <span class="invisible">&nbsp;Your Outrageous Builders Club, Turbo Builders Club, or Builders Club membership has expired, so you can
        only have one open place. Your places will not be deleted, and you can <a id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcasePlaces_ctl00_rbxPlatform_rbxPlaceAccessIndicator_RBXLDownloadLink">download the RBXL here.</a> To unlock all of your places,
        please <a href="/upgrades/BuildersClubMemberships.aspx">re-order Outrageous Builders Club, Turbo Builders Club, or Builders
            Club </a>.<br /></span>
    </span>
    <span id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcasePlaces_ctl00_rbxPlatform_rbxPlaceAccessIndicator_ExpiredOther" style="display: none">
        <a class="iLocked tooltip" title="Locked"></a>
        <span class="invisible">This place is locked because the creator's <a href="/upgrades/BuildersClubMemberships.aspx">Builders
            Club / Turbo Builders Club / Outrageous Builders Club </a>has expired.
		</span>
	</span>	
</span>
	
    </div>
    <br>
    <div class="Statistics" style="color: #999; font-size: 14px; letter-spacing: normal">
        <span id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcasePlaces_ctl00_rbxPlatform_lStatistics">Visited 589 times (6 last week)</span></div>
    <div class="Thumbnail" style="width:414px;overflow:hidden;position: relative;">
        <a id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcasePlaces_ctl00_rbxPlatform_rbxPlaceThumbnail" title="Create Stuff, Including Weapons" href="/Create-Stuff-Including-Weapons-place?id=34459309" style="display:inline-block;height:230px;width:420px;cursor:pointer;"><img src="//t6.rbxcdn.com/11072470efdbf5067d9b4029ed4c4813" height="230" width="420" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Create Stuff, Including Weapons" /></a>
        
    </div>
    <div id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcasePlaces_ctl00_rbxPlatform_pDescription">
		
        <div class="Description" style="overflow-y: auto; max-height: 160px; font-family: arial; color: #666; font-size: 12px;">
            <span id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcasePlaces_ctl00_rbxPlatform_lDescription">Further information about building weapons can be found in the server.

If you've visited this place, you're probably wondering "Is this place complete?" The answer is no... I couldn't build anything because Roblox went trough an update while the server was under construction.</span>
        </div>
    
	</div>
    <div class="PlayOptions" style="display:block" >
        
        <div class="VisitButtonContainer"  data-item-id="34459309">
            
        <div class="VisitButtonsLeft Centered">
            
            <div id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcasePlaces_ctl00_rbxPlatform_rbxVisitButtons_MultiplayerVisitButton" class="VisitButton VisitButtonPlay" placeid="34459309">
                <a  class="btn-medium btn-primary">Play</a>
            </div>  
            
            
        </div>
    

    <script type="text/javascript">
        var play_placeId = 34459309;
        function redirectPlaceLauncherToLogin() {
            location.href = "/login/default.aspx?ReturnUrl=" + encodeURIComponent("/User.aspx?ID=1025053");
        }
        function redirectPlaceLauncherToRegister() {
            location.href = "/login/NewAge.aspx?ReturnUrl=" + encodeURIComponent("/User.aspx?ID=1025053");
        }
        function fireEventAction(action) {
            RobloxEventManager.triggerEvent('rbx_evt_popup_action', { action: action });
        }
    </script>
    

<div id="BCOnlyModal" class="modalPopup unifiedModal smallModal" style="display:none;">
 	<div style="margin:4px 0px;">
        <span>Builders Club Only</span>
    </div>
    <div class="simplemodal-close">
        <a class="ImageButton closeBtnCircle_20h" style="margin-left:400px;"></a>
    </div>
    <div class="unifiedModalContent" style="padding-top:5px; margin-bottom: 3px; margin-left: 3px; margin-right: 3px">
        <div class="ImageContainer" >
            <img class="GenericModalImage BCModalImage" alt="Builder's Club" src="//images.rbxcdn.com/ae345c0d59b00329758518edc104d573.png" />
            <div id="BCMessageDiv" class="BCMessage Message">
                Builders Club membership is required to play in this place.
            </div>
        </div>
        <div style="clear:both;"></div>
        <div style="clear:both;"></div>
        <div class="GenericModalButtonContainer" style="padding-bottom: 13px">
            <div style="text-align:center">
                <a id="BClink" href="/Upgrades/BuildersClubMemberships.aspx" class="btn-primary btn-large">Upgrade Now</a>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
    </div>
</div>

<script type="text/javascript">
    function showBCOnlyModal(modalId) {
        var modalProperties = { overlayClose: true, escClose: true, opacity: 80, overlayCss: { backgroundColor: "#000" } };
        if (typeof modalId === "undefined")
            $("#BCOnlyModal").modal(modalProperties);
        else
            $("#" + modalId).modal(modalProperties);
    }
    $(document).ready(function () {
        $('#VOID').click(function () {
            showBCOnlyModal("BCOnlyModal");
            return false;
        });
    });
</script>
 

<div class="GenericModal modalPopup unifiedModal smallModal" style="display:none;">
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div>
            <div class="ImageContainer roblox-item-image"  data-image-size="small" data-no-overlays data-no-click>
                <img class="GenericModalImage" alt="generic image" />
            </div>
            <div class="Message"></div>  
            <div style="clear:both"></div>
        </div>
        <div class="GenericModalButtonContainer">
            <a class="ImageButton btn-neutral btn-large roblox-ok" >OK<span class="btn-text">OK</span></a> 
        </div>  
    </div>
</div>



        </div>
    </div>
</div>

			    
            </div>
        </div>
		
    </div>
    



	<div id="ctl00_cphRoblox_rbxUserPlacesPane_ShowcaseFooter" class="PanelFooter" style="margin-top:5px;margin-left:20px;padding:3px;">
		
	    
	    
	
	</div>
 </div>
 
</div>
 
 <div class="ItemPurchaseAjaxContainer">
    

<div id="ItemPurchaseAjaxData"
        data-authenticateduser-isnull="True"
        data-user-balance-robux="0"
        data-user-balance-tickets="0"
        data-user-bc="0"
        data-continueshopping-url=""
        data-imageurl="" 
        data-alerturl="//images.rbxcdn.com/cbb24e0c0f1fb97381a065bd1e056fcb.png"
        data-builderscluburl="//images.rbxcdn.com/ae345c0d59b00329758518edc104d573.png"></div>

    <div id="ProcessingView" style="display:none">
        <div class="ProcessingModalBody">
            <p style="margin:0px"><img src='//images.rbxcdn.com/ec4e85b0c4396cf753a06fade0a8d8af.gif' alt="Processing..." /></p>
            <p style="margin:7px 0px">Processing Transaction</p>
        </div>
    </div>
    
    <script type="text/javascript">
        //<sl:translate>
        Roblox.ItemPurchase.strings = {
            insufficientFundsTitle : "Insufficient Funds",
            insufficientFundsText : "You need {0} more to purchase this item.",
            cancelText : "Cancel",
            okText : "OK",
            buyText : "Buy",
            buyTextLower : "buy",
            tradeCurrencyText : "Trade Currency",
            priceChangeTitle : "Item Price Has Changed",
            priceChangeText : "While you were shopping, the price of this item changed from {0} to {1}.",
            buyNowText : "Buy Now",
            buyAccessText: "Buy Access",
            buildersClubOnlyTitle : "{0} Only",
            buildersClubOnlyText : "You need {0} to buy this item!",
            buyItemTitle : "Buy Item",
            buyItemText : "Would you like to {0} {5}the {1} {2} from {3} for {4}?",
            balanceText : "Your balance after this transaction will be {0}",
            freeText : "Free",
            purchaseCompleteTitle : "Purchase Complete!",
            purchaseCompleteText : "You have successfully {0} {5}the {1} {2} from {3} for {4}.",
            continueShoppingText : "Return to Profile",
            customizeCharacterText : "Customize Character",
            orText : "or",
            rentText : "rent",
            accessText: "access to "
        }
    //</sl:translate>
    </script>

</div>
 <script type="text/javascript">
     Roblox.require('Widgets.DropdownMenu', function (dropdown) {
         dropdown.InitializeDropdown();
     });
</script>

                </div>
            </div>
            <div style="padding-left: 20px" class="divider-bottom">
                

<div style="margin: 12px 0 20px; overflow:visible">
    <h2 style="float: left"><?= $user['username'] ?>'s Friends</h2>
    
    <a data-js-my-button style="float: right" href="Friends.aspx?UserID=1025053" class="btn-small btn-neutral" id="HeaderButton">See All 97<span class="btn-text">See All 97</span></a>
    
</div>
<div style="padding-top: 50px">
    
	<table id="ctl00_cphRoblox_rbxFriendsPane_dlFriends" cellspacing="0" align="Center" border="0" style="border-collapse:collapse;">
	<tr>
		<td>
			<div class="Friend notranslate">
				<div class="Avatar"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl00_hlAvatar" class=" notranslate" title="jeroentje153" class=" notranslate" href="/User.aspx?ID=994676" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="//t4.rbxcdn.com/2cd49458b64bcf6b72c6e0a9472b103e" height="100" width="100" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="jeroentje153" class=" notranslate" /></a></div>
				<div class="Summary">
					<span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl00_iOnlineStatus" src="images/offline.png" alt="jeroentje153 is offline (last seen at 5/24/2014 4:32:46 PM." style="border-width:0px;" /></span>
					<span class="Name"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl00_hlFriend" href="User.aspx?ID=994676">jeroentje153</a></span>
				</div>
			</div>
		</td><td>
			<div class="Friend notranslate">
				<div class="Avatar"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl01_hlAvatar" class=" notranslate" title="buddy4550" class=" notranslate" href="/User.aspx?ID=932650" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="//t7.rbxcdn.com/b6418e6bdabc83b41c87ae0a7afe5b7d" height="100" width="100" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="buddy4550" class=" notranslate" /></a></div>
				<div class="Summary">
					<span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl01_iOnlineStatus" src="images/offline.png" alt="buddy4550 is offline (last seen at 5/4/2014 6:39:57 PM." style="border-width:0px;" /></span>
					<span class="Name"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl01_hlFriend" href="User.aspx?ID=932650">buddy4550</a></span>
				</div>
			</div>
		</td><td>
			<div class="Friend notranslate">
				<div class="Avatar"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl02_hlAvatar" class=" notranslate" title="TaroDark" class=" notranslate" href="/User.aspx?ID=1095527" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="//t3.rbxcdn.com/c370531b35d2067f850abbdd078bb80b" height="100" width="100" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="TaroDark" class=" notranslate" /></a></div>
				<div class="Summary">
					<span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl02_iOnlineStatus" src="images/offline.png" alt="TaroDark is offline (last seen at 4/4/2014 7:40:26 AM." style="border-width:0px;" /></span>
					<span class="Name"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl02_hlFriend" href="User.aspx?ID=1095527">TaroDark</a></span>
				</div>
			</div>
		</td>
	</tr><tr>
		<td>
			<div class="Friend notranslate">
				<div class="Avatar"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl03_hlAvatar" class=" notranslate" title="Shedletsky" class=" notranslate" href="/User.aspx?ID=261" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="//t3.rbxcdn.com/a3aa397148447f9c9550e43baa884189" height="100" width="100" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Shedletsky" class=" notranslate" /><img src="/images/icons/overlay_obcOnly.png" align="left" style="position:relative;top:-19px;" /></a></div>
				<div class="Summary">
					<span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl03_iOnlineStatus" src="images/offline.png" alt="Shedletsky is offline (last seen at 5/24/2014 11:58:41 AM." style="border-width:0px;" /></span>
					<span class="Name"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl03_hlFriend" href="User.aspx?ID=261">Shedletsky</a></span>
				</div>
			</div>
		</td><td>
			<div class="Friend notranslate">
				<div class="Avatar"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl04_hlAvatar" class=" notranslate" title="lego802" class=" notranslate" href="/User.aspx?ID=1259027" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="//t5.rbxcdn.com/f0babcb474272d512c577a95f2fcacce" height="100" width="100" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="lego802" class=" notranslate" /></a></div>
				<div class="Summary">
					<span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl04_iOnlineStatus" src="images/offline.png" alt="lego802 is offline (last seen at 10/12/2008 6:58:38 AM." style="border-width:0px;" /></span>
					<span class="Name"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl04_hlFriend" href="User.aspx?ID=1259027">lego802</a></span>
				</div>
			</div>
		</td><td>
			<div class="Friend notranslate">
				<div class="Avatar"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl05_hlAvatar" class=" notranslate" title="okama" class=" notranslate" href="/User.aspx?ID=1179539" style="display:inline-block;height:100px;width:100px;cursor:pointer;"><img src="//t7.rbxcdn.com/f9a1aa45f1b310eb23d4b54dfa6d0401" height="100" width="100" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="okama" class=" notranslate" /></a></div>
				<div class="Summary">
					<span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl05_iOnlineStatus" src="images/offline.png" alt="okama is offline (last seen at 9/30/2008 10:23:18 AM." style="border-width:0px;" /></span>
					<span class="Name"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl05_hlFriend" href="User.aspx?ID=1179539">okama</a></span>
				</div>
			</div>
		</td>
	</tr>
</table>
	
</div>

            </div>
            

<div class="divider-bottom" style="padding-left: 20px; padding-bottom: 20px">
    <div id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesPane">
	
	        <div  style="overflow: auto">
                <h2 class="title" style="float: left">Favorites</h2>
                <div class="PanelFooter" style="float: right;">
			        Category:&nbsp;
			        <select name="ctl00$cphRoblox$rbxFavoritesPane$AssetCategoryDropDownList" id="ctl00_cphRoblox_rbxFavoritesPane_AssetCategoryDropDownList">
		<option value="17">Heads</option>
		<option value="18">Faces</option>
		<option value="19">Gear</option>
		<option value="8">Hats</option>
		<option value="2">T-Shirts</option>
		<option value="11">Shirts</option>
		<option value="12">Pants</option>
		<option value="13">Decals</option>
		<option value="10">Models</option>
		<option selected="selected" value="9">Places</option>

	</select>
		        </div>
            </div>
		    <div>
			
			    <div id="FavoritesContent">
				    <table id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList" cellspacing="0" border="0" style="border-collapse:collapse;">
		<tr>
			<td class="Asset" valign="top">
					        <div style="padding:5px; margin-right: 30px; margin-left: 10px">
						        <div class="AssetThumbnail notranslate" >
							        <a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl00_AssetThumbnailHyperLink" class=" notranslate" title="Stargate: Final War" class=" notranslate" href="/Stargate-Final-War-place?id=4123204" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t6.rbxcdn.com/6d148d814a629005bbed2eb2c65a4782" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Stargate: Final War" class=" notranslate" /></a>
							    
						        </div>
						        <div class="AssetDetails notranslate" style="clear:both;">
							        <div class="AssetName"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl00_AssetNameHyperLink" href="/Stargate-Final-War-place?id=4123204">Stargate: Final War</a></div>
							        <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl00_AssetCreatorHyperLink" href="User.aspx?ID=1021552">Legend26</a></span></div>
						            
						        </div>
						    </div>
					    </td><td class="Asset" valign="top">
					        <div style="padding:5px; margin-right: 30px; margin-left: 10px">
						        <div class="AssetThumbnail notranslate" >
							        <a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl01_AssetThumbnailHyperLink" class=" notranslate" title="Survival 303 (Paid Access due to exploits)" class=" notranslate" href="/Survival-303-Paid-Access-due-to-exploits-place?id=4321846" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t6.rbxcdn.com/ab6d2909ba2abfc866d983c94b0b355f" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Survival 303 (Paid Access due to exploits)" class=" notranslate" /></a>
							    
						        </div>
						        <div class="AssetDetails notranslate" style="clear:both;">
							        <div class="AssetName"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl01_AssetNameHyperLink" href="/Survival-303-Paid-Access-due-to-exploits-place?id=4321846">Survival 303 (Paid Access due to exploits)</a></div>
							        <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl01_AssetCreatorHyperLink" href="User.aspx?ID=1093419">Davidii2</a></span></div>
						            
						        </div>
						    </div>
					    </td><td class="Asset" valign="top">
					        <div style="padding:5px; margin-right: 30px; margin-left: 10px">
						        <div class="AssetThumbnail notranslate" >
							        <a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl02_AssetThumbnailHyperLink" class=" notranslate" title="Create Stuff, Including Weapons" class=" notranslate" href="/Create-Stuff-Including-Weapons-place?id=34459309" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t3.rbxcdn.com/f8fa8311b6b422faabf7e959424e94ab" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Create Stuff, Including Weapons" class=" notranslate" /></a>
							    
						        </div>
						        <div class="AssetDetails notranslate" style="clear:both;">
							        <div class="AssetName"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl02_AssetNameHyperLink" href="/Create-Stuff-Including-Weapons-place?id=34459309">Create Stuff, Including Weapons</a></div>
							        <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl02_AssetCreatorHyperLink" href="User.aspx?ID=1025053"><?= $user['username'] ?></a></span></div>
						            
						        </div>
						    </div>
					    </td>
		</tr><tr>
			<td class="Asset" valign="top">
					        <div style="padding:5px; margin-right: 30px; margin-left: 10px">
						        <div class="AssetThumbnail notranslate" >
							        <a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl03_AssetThumbnailHyperLink" class=" notranslate" title="THE Disaster Lobby! [22]" class=" notranslate" href="/THE-Disaster-Lobby-22-place?id=19138408" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t0.rbxcdn.com/a4a288b775e1793079e173d3fac10af4" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="THE Disaster Lobby! [22]" class=" notranslate" /></a>
							    
						        </div>
						        <div class="AssetDetails notranslate" style="clear:both;">
							        <div class="AssetName"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl03_AssetNameHyperLink" href="/THE-Disaster-Lobby-22-place?id=19138408">THE Disaster Lobby! [22]</a></div>
							        <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl03_AssetCreatorHyperLink" href="User.aspx?ID=2837719">asimo3089</a></span></div>
						            
						        </div>
						    </div>
					    </td><td class="Asset" valign="top">
					        <div style="padding:5px; margin-right: 30px; margin-left: 10px">
						        <div class="AssetThumbnail notranslate" >
							        <a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl04_AssetThumbnailHyperLink" class=" notranslate" title="Bawxing! -Classic-" class=" notranslate" href="/Bawxing-Classic-place?id=2543590" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t5.rbxcdn.com/aa7db5ebe2b0bc1023d70c333183ce82" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Bawxing! -Classic-" class=" notranslate" /></a>
							    
						        </div>
						        <div class="AssetDetails notranslate" style="clear:both;">
							        <div class="AssetName"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl04_AssetNameHyperLink" href="/Bawxing-Classic-place?id=2543590">Bawxing! -Classic-</a></div>
							        <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl04_AssetCreatorHyperLink" href="User.aspx?ID=554630">sellethore</a></span></div>
						            
						        </div>
						    </div>
					    </td><td class="Asset" valign="top">
					        <div style="padding:5px; margin-right: 30px; margin-left: 10px">
						        <div class="AssetThumbnail notranslate" >
							        <a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl05_AssetThumbnailHyperLink" class=" notranslate" title="Grow-a-brick v1.3" class=" notranslate" href="/Grow-a-brick-v1-3-place?id=249214" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t6.rbxcdn.com/ad1a1153958d7b58da9d0635f758def1" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Grow-a-brick v1.3" class=" notranslate" /></a>
							    
						        </div>
						        <div class="AssetDetails notranslate" style="clear:both;">
							        <div class="AssetName"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl05_AssetNameHyperLink" href="/Grow-a-brick-v1-3-place?id=249214">Grow-a-brick v1.3</a></div>
							        <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxFavoritesPane_FavoritesDataList_ctl05_AssetCreatorHyperLink" href="User.aspx?ID=114276">uberubert</a></span></div>
						            
						        </div>
						    </div>
					    </td>
		</tr>
	</table>
				    
				    <div id="ctl00_cphRoblox_rbxFavoritesPane_FooterPagerPanel" style="text-align: center" class="FooterPager">
				        <span class="pager previous disabled"></span>
					    
					    <span id="ctl00_cphRoblox_rbxFavoritesPane_FooterPagerLabel" style="vertical-align: top; display: inline-block; padding: 5px; padding-top: 6px">Page 1 of 2</span>
					    <a id="ctl00_cphRoblox_rbxFavoritesPane_FooterPageSelector_Next" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxFavoritesPane$FooterPageSelector_Next&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))"><span class="pager next"></span></a>
                        
				    </div>
			    </div>
		    </div>
	    
</div>
</div>

            <div style="clear: both; margin: 20px;width:300px;">
                
<iframe
    allowtransparency="true"
    frameborder="0"
    height="270"
    scrolling="no"
    src="/userads/3"
    width="300"
    data-js-adtype="iframead"></iframe>
            </div>
        </div>
        <br clear="all" />
    </div>
    <div id="UserContainer">
        <div id="UserAssetsPane" style="border-top: 1px solid #ccc;">
            <div id="ctl00_cphRoblox_rbxUserAssetsPane_upUserAssetsPane">
	
        <h2 class="title" display="block" style="width:970px">
            <span>
                Inventory
                
        </span>
        </h2>
        <div id="UserAssets">
            <div id="AssetsMenu"  class="divider-right">
                
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl00_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl00_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl00$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Heads</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl01$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Faces</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl02_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl02$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Gear</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl03_AssetCategorySelectorPanel" class="verticaltab selected">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl03_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl03$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Hats</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl04_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl04_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl04$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">T-Shirts</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl05_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl05_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl05$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Shirts</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl06_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl06_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl06$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Pants</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl07_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl07_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl07$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Decals</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl08_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl08_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl08$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Models</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl09_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl09_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl09$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Plugins</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl10_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl10_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl10$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Animations</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl11_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl11_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl11$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Places</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl12_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl12_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl12$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Game Passes</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl13_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl13_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl13$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Audio</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl14_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl14_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl14$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Badges</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl15_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl15_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl15$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Left Arms</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl16_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl16_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl16$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Right Arms</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl17_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl17_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl17$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Left Legs</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl18_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl18_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl18$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Right Legs</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl19_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl19_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl19$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Torsos</a>
	</div>
                    
                        <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl20_AssetCategorySelectorPanel" class="verticaltab">
		
                            <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl20_AssetCategorySelector" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl20$AssetCategorySelector&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Packages</a>
	</div>
                    
            </div>
            <div id="AssetsContent">
                
                
                <div id="RepeatingUserAssetData">
                
                <table id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList" cellspacing="0" border="0" style="border-collapse:collapse;">
		<tr>
			<td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_AssetThumbnailHyperLink" class=" notranslate" title="The Last Egg" class=" notranslate" href="/The-Last-Egg-item?id=76692407" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t2.rbxcdn.com/963a5a43c76036fe02eb981e16181312" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="The Last Egg" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_AssetNameHyperLink" class="noranslate" href="/The-Last-Egg-item?id=76692407">The Last Egg</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl01_AssetThumbnailHyperLink" class=" notranslate" title="Cowl" class=" notranslate" href="/Cowl-item?id=21754986" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t2.rbxcdn.com/7f98b65d6e59b64c9b7bc9261e9684b9" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Cowl" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl01_AssetNameHyperLink" class="noranslate" href="/Cowl-item?id=21754986">Cowl</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl01_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                <div id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl01_Div2" class="AssetPrice">
                                    <span class="PriceInTickets notranslate">
                                        Tx: 500</span></div>
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl02_AssetThumbnailHyperLink" class=" notranslate" title="Messenger Boy" class=" notranslate" href="/Messenger-Boy-item?id=53035233" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t7.rbxcdn.com/c83083f3c4d5f24f35c79428185edb37" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Messenger Boy" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl02_AssetNameHyperLink" class="noranslate" href="/Messenger-Boy-item?id=53035233">Messenger Boy</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl02_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                <div id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl02_Div2" class="AssetPrice">
                                    <span class="PriceInTickets notranslate">
                                        Tx: 10</span></div>
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl03_AssetThumbnailHyperLink" class=" notranslate" title="ROBLOX Veteran&#39;s Medal" class=" notranslate" href="/ROBLOX-Veterans-Medal-item?id=42839214" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t1.rbxcdn.com/17a5c24fb789b7615917503c0185fab7" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="ROBLOX Veteran&#39;s Medal" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl03_AssetNameHyperLink" class="noranslate" href="/ROBLOX-Veterans-Medal-item?id=42839214">ROBLOX Veteran&#39;s Medal</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl03_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl04_AssetThumbnailHyperLink" class=" notranslate" title="Ghost of ROBLOX Past" class=" notranslate" href="/Ghost-of-ROBLOX-Past-item?id=42800983" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t6.rbxcdn.com/880c10399981a4ad9a45c5c283cef70b" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Ghost of ROBLOX Past" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl04_AssetNameHyperLink" class="noranslate" href="/Ghost-of-ROBLOX-Past-item?id=42800983">Ghost of ROBLOX Past</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl04_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl05_AssetThumbnailHyperLink" class=" notranslate" title="Opened Forest Camo Gift of Veterans" class=" notranslate" href="/Opened-Forest-Camo-Gift-of-Veterans-item?id=42141207" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t2.rbxcdn.com/e5a10286628a0c93095d3ddf1317293d" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Opened Forest Camo Gift of Veterans" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl05_AssetNameHyperLink" class="noranslate" href="/Opened-Forest-Camo-Gift-of-Veterans-item?id=42141207">Opened Forest Camo Gift of Veterans</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl05_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td>
		</tr><tr>
			<td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl06_AssetThumbnailHyperLink" class=" notranslate" title="Opened Retro ROBLOXian Gift of Yesteryore" class=" notranslate" href="/Opened-Retro-ROBLOXian-Gift-of-Yesteryore-item?id=41453949" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t7.rbxcdn.com/84196ff6d62f90d368367cbb13eacae2" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Opened Retro ROBLOXian Gift of Yesteryore" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl06_AssetNameHyperLink" class="noranslate" href="/Opened-Retro-ROBLOXian-Gift-of-Yesteryore-item?id=41453949">Opened Retro ROBLOXian Gift of Yesteryore</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl06_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl07_AssetThumbnailHyperLink" class=" notranslate" title="Autumn Leaves" class=" notranslate" href="/Autumn-Leaves-item?id=35631125" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t1.rbxcdn.com/4816f9a0a9e68e513057c54bc688e5fc" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Autumn Leaves" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl07_AssetNameHyperLink" class="noranslate" href="/Autumn-Leaves-item?id=35631125">Autumn Leaves</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl07_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl08_AssetThumbnailHyperLink" class=" notranslate" title="Train Conductor" class=" notranslate" href="/Train-Conductor-item?id=12436561" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t0.rbxcdn.com/2ea722a6c82e1dabaf5578c2bf8e879e" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Train Conductor" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl08_AssetNameHyperLink" class="noranslate" href="/Train-Conductor-item?id=12436561">Train Conductor</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl08_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl09_AssetThumbnailHyperLink" class=" notranslate" title="Fire Ant" class=" notranslate" href="/Fire-Ant-item?id=23635380" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t4.rbxcdn.com/fefe4c52592afac99fc2334d5463bc4f" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Fire Ant" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl09_AssetNameHyperLink" class="noranslate" href="/Fire-Ant-item?id=23635380">Fire Ant</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl09_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl10_AssetThumbnailHyperLink" class=" notranslate" title="Ancient Tribal Foot Soldier" class=" notranslate" href="/Ancient-Tribal-Foot-Soldier-item?id=34763413" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t6.rbxcdn.com/b4a1123b9efc54198c42f7803644888d" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Ancient Tribal Foot Soldier" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl10_AssetNameHyperLink" class="noranslate" href="/Ancient-Tribal-Foot-Soldier-item?id=34763413">Ancient Tribal Foot Soldier</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl10_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                <div id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl10_Div2" class="AssetPrice">
                                    <span class="PriceInTickets notranslate">
                                        Tx: 120</span></div>
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl11_AssetThumbnailHyperLink" class=" notranslate" title="Pikeman Helmet" class=" notranslate" href="/Pikeman-Helmet-item?id=11421585" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t5.rbxcdn.com/475b4dc6a4adc294d7ad6c7a89396f81" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Pikeman Helmet" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl11_AssetNameHyperLink" class="noranslate" href="/Pikeman-Helmet-item?id=11421585">Pikeman Helmet</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl11_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td>
		</tr><tr>
			<td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl12_AssetThumbnailHyperLink" class=" notranslate" title="Chainmail Helmet" class=" notranslate" href="/Chainmail-Helmet-item?id=17640922" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t2.rbxcdn.com/ca95211b6e54bfeb0686cb7dd64f1de0" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Chainmail Helmet" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl12_AssetNameHyperLink" class="noranslate" href="/Chainmail-Helmet-item?id=17640922">Chainmail Helmet</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl12_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl13_AssetThumbnailHyperLink" class=" notranslate" title="Opened Gift of Birthday Fun" class=" notranslate" href="/Opened-Gift-of-Birthday-Fun-item?id=34115865" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t3.rbxcdn.com/6234ca962be66aaaafa6d83bde060664" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Opened Gift of Birthday Fun" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl13_AssetNameHyperLink" class="noranslate" href="/Opened-Gift-of-Birthday-Fun-item?id=34115865">Opened Gift of Birthday Fun</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl13_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl14_AssetThumbnailHyperLink" class=" notranslate" title="Ninja Mask of Light" class=" notranslate" href="/Ninja-Mask-of-Light-item?id=5808672" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t3.rbxcdn.com/e9e18c77c7203dc9ad307737a57031f9" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Ninja Mask of Light" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl14_AssetNameHyperLink" class="noranslate" href="/Ninja-Mask-of-Light-item?id=5808672">Ninja Mask of Light</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl14_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                <div id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl14_Div2" class="AssetPrice">
                                    <span class="PriceInTickets notranslate">
                                        Tx: 80</span></div>
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl15_AssetThumbnailHyperLink" class=" notranslate" title="Bandit" class=" notranslate" href="/Bandit-item?id=20642008" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t1.rbxcdn.com/ccc7953ecf1c30dc9a591eb8b50b61ab" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Bandit" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl15_AssetNameHyperLink" class="noranslate" href="/Bandit-item?id=20642008">Bandit</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl15_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                <div id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl15_Div1" class="AssetPrice">
                                    <span class="PriceInRobux notranslate">
                                        R$: 40</span></div>
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl16_AssetThumbnailHyperLink" class=" notranslate" title="Comedy" class=" notranslate" href="/Comedy-item?id=13702134" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t5.rbxcdn.com/57a364b75a55444e91ebc94cfabc6f73" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Comedy" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl16_AssetNameHyperLink" class="noranslate" href="/Comedy-item?id=13702134">Comedy</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl16_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                <div id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl16_Div1" class="AssetPrice">
                                    <span class="PriceInRobux notranslate">
                                        R$: 31</span></div>
                                
                                
                            </div>
                        </div>
                    </td><td class="Asset" valign="top">
                        <div style="padding: 5px">
                            <div class="AssetThumbnail">
                                <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl17_AssetThumbnailHyperLink" class=" notranslate" title="Golden Egg Beaters" class=" notranslate" href="/Golden-Egg-Beaters-item?id=25090182" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t3.rbxcdn.com/7357363c92c9f22694ebf47a47fd4926" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Golden Egg Beaters" class=" notranslate" /></a>
                                
                            </div>
                            <div class="AssetDetails">
                                <div class="AssetName">
                                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl17_AssetNameHyperLink" class="noranslate" href="/Golden-Egg-Beaters-item?id=25090182">Golden Egg Beaters</a></div>
                                <div class="AssetCreator">
                                    <span class="Label">Creator: </span><span class="Detail notranslate">
                                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl17_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
                                
                                
                                
                            </div>
                        </div>
                    </td>
		</tr>
	</table>
                <div id="ctl00_cphRoblox_rbxUserAssetsPane_FooterPagerPanel" class="FooterPager" style="width: 780px">
                    <span class="pager previous disabled"></span>
                    
                    <span id="ctl00_cphRoblox_rbxUserAssetsPane_FooterPagerLabel" style="vertical-align: top; display: inline-block; padding: 5px; padding-top: 6px">Page 1 of 2</span>
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_FooterPageSelector_Next" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$rbxUserAssetsPane$FooterPageSelector_Next&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))"><span class="pager next"></span></a>
                    
                </div>
                </div>
                <div style="width:784px;">
                    
    <h3 class="RecommendationHeader2">
        Recommended Hats
        <a href='/Catalog/' >See All <span>&#187;</span></a>
    </h3>


    <div class="AssetRecommenderContainer">
    <table id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets" cellspacing="0" align="Center" border="0" style="height:175px;width:784px;border-collapse:collapse;">
		<tr>
			<td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-0">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl00_AssetThumbnailHyperLink" class=" notranslate" title="Electro Hood" class=" notranslate" href="/Electro-Hood-item?id=151679909" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t0.rbxcdn.com/3408a044964ac768c9bba859816b49ec" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Electro Hood" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl00_AssetNameHyperLinkPortrait" href="/Electro-Hood-item?id=151679909">Electro Hood</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl00_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID=1">ROBLOX</a></span>
                    </div>
                </div>
            </div>
        </td><td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-1">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl01_AssetThumbnailHyperLink" class=" notranslate" title="Extreme Sports Helmet: BASE Jump Black" class=" notranslate" href="/Extreme-Sports-Helmet-BASE-Jump-Black-item?id=9466840" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t5.rbxcdn.com/c2b5f7a6239c673e99ccd1bd7b8bcc7e" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Extreme Sports Helmet: BASE Jump Black" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl01_AssetNameHyperLinkPortrait" href="/Extreme-Sports-Helmet-BASE-Jump-Black-item?id=9466840">Extreme Sports Helmet: BASE Jump Black</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl01_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID=1">ROBLOX</a></span>
                    </div>
                </div>
            </div>
        </td><td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-2">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl02_AssetThumbnailHyperLink" class=" notranslate" title="Aussie Slouch" class=" notranslate" href="/Aussie-Slouch-item?id=10860590" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t5.rbxcdn.com/366091e5f6ae9e25779dc8bb5d13b62e" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Aussie Slouch" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl02_AssetNameHyperLinkPortrait" href="/Aussie-Slouch-item?id=10860590">Aussie Slouch</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl02_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID=1">ROBLOX</a></span>
                    </div>
                </div>
            </div>
        </td><td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-3">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl03_AssetThumbnailHyperLink" class=" notranslate" title="Opened Gift of Birthday Fun" class=" notranslate" href="/Opened-Gift-of-Birthday-Fun-item?id=34115865" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t3.rbxcdn.com/a1bd828ea1acf7bffe682d2d3d358134" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Opened Gift of Birthday Fun" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl03_AssetNameHyperLinkPortrait" href="/Opened-Gift-of-Birthday-Fun-item?id=34115865">Opened Gift of Birthday Fun</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl03_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID=1">ROBLOX</a></span>
                    </div>
                </div>
            </div>
        </td><td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-4">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl04_AssetThumbnailHyperLink" class=" notranslate" title="Beautiful Hair for Beautiful People" class=" notranslate" href="/Beautiful-Hair-for-Beautiful-People-item?id=16630147" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t3.rbxcdn.com/53c09c7102cb2390fb88151fb49b76d9" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Beautiful Hair for Beautiful People" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl04_AssetNameHyperLinkPortrait" href="/Beautiful-Hair-for-Beautiful-People-item?id=16630147">Beautiful Hair for Beautiful People</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl04_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID=1">ROBLOX</a></span>
                    </div>
                </div>
            </div>
        </td>
		</tr><tr>
			<td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-5">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl05_AssetThumbnailHyperLink" class=" notranslate" title="LOL Day Cap" class=" notranslate" href="/LOL-Day-Cap-item?id=96678344" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t1.rbxcdn.com/c06f353c6ecf900c94813cfff5b11129" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="LOL Day Cap" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl05_AssetNameHyperLinkPortrait" href="/LOL-Day-Cap-item?id=96678344">LOL Day Cap</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl05_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID=1">ROBLOX</a></span>
                    </div>
                </div>
            </div>
        </td><td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-6">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl06_AssetThumbnailHyperLink" class=" notranslate" title="ROBLOX Visor 2011" class=" notranslate" href="/ROBLOX-Visor-2011-item?id=42900214" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t4.rbxcdn.com/7f556690677430023d5c48e6e74fea6d" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="ROBLOX Visor 2011" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl06_AssetNameHyperLinkPortrait" href="/ROBLOX-Visor-2011-item?id=42900214">ROBLOX Visor 2011</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl06_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID=1">ROBLOX</a></span>
                    </div>
                </div>
            </div>
        </td><td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-7">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl07_AssetThumbnailHyperLink" class=" notranslate" title="ROBLOX Cadet" class=" notranslate" href="/ROBLOX-Cadet-item?id=113332797" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t5.rbxcdn.com/d827c93bf76ed36c4c98597f1c96a135" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="ROBLOX Cadet" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl07_AssetNameHyperLinkPortrait" href="/ROBLOX-Cadet-item?id=113332797">ROBLOX Cadet</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl07_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID=1">ROBLOX</a></span>
                    </div>
                </div>
            </div>
        </td><td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-8">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl08_AssetThumbnailHyperLink" class=" notranslate" title="Firefighter Helmet" class=" notranslate" href="/Firefighter-Helmet-item?id=1081381" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t6.rbxcdn.com/73193b02c611b63d1b89614f6b6bc4a1" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Firefighter Helmet" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl08_AssetNameHyperLinkPortrait" href="/Firefighter-Helmet-item?id=1081381">Firefighter Helmet</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl08_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID=1">ROBLOX</a></span>
                    </div>
                </div>
            </div>
        </td><td>
            <div class="PortraitDiv" style="width: 140px;overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-9">
                <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl09_AssetThumbnailHyperLink" class=" notranslate" title="Backwards &#39;R&#39; Cap" class=" notranslate" href="/Backwards-R-Cap-item?id=17903982" style="display:inline-block;height:110px;width:110px;cursor:pointer;"><img src="//t2.rbxcdn.com/0ce41ae726e1037f385bddc5efffca26" height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Backwards &#39;R&#39; Cap" class=" notranslate" /></a>
                </div>
                <div class="AssetDetails">
                    <div class="AssetName noTranslate">
                        <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl09_AssetNameHyperLinkPortrait" href="/Backwards-R-Cap-item?id=17903982">Backwards &#39;R&#39; Cap</a>
                    </div>
                    <div class="AssetCreator">
                        <span class="stat-label">Creator:</span> <span class="Detail stat"><a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetRec_dlAssets_ctl09_CreatorHyperLinkPortrait" class="notranslate" href="User.aspx?ID=1">ROBLOX</a></span>
                    </div>
                </div>
            </div>
        </td>
		</tr>
	</table>
    
</div>

<script type="text/javascript">
    $(function () {
        var itemNames = $('.PortraitDiv .AssetDetails .AssetName a');
        $.each(itemNames, function (index) {
            var elem = $(itemNames[index]);
            elem.html(fitStringToWidthSafe(elem.html(), 200));
        });
        var userNames = $('.PortraitDiv .AssetDetails .AssetCreator .Detail a');
        $.each(userNames, function (index) {
            var elem = $(userNames[index]);
            elem.html(fitStringToWidthSafe(elem.html(), 70));
        });
    });
</script>

                </div>
            </div>
            <div style="clear: both;">
            </div>
        </div>
        <div id="ctl00_cphRoblox_rbxUserAssetsPane_CreateSetPanelDiv" class="createSetPanelPopup" style="width: 400px; height: 100%; padding: 0; float: left; display: none">
		
            
        
	</div>

    
</div>

<div class="PlaceSelectorModal modalPopup unifiedModal" style="display:none;">
    <div class="Title">Select Place</div>
    <div class="GenericModalBody text">
        <div class="place-selector-modal" data-place-loader-url="/universes/get-places-by-context?creationContext=NonGameCreation&amp;universeId=0">
            <div class="place-selector-container">
                <div id="PlaceSelectorItemContainer" class="place-selector-item-container"></div>
                <div id="PlaceSelectorPagerContainer" class="place-selector-pager-container"></div>
            </div>
            <div class="place-selector template" title="Place" style="display: none">
                <div class="place-image" data-retry-url-template="/asset-thumbnail/json?height=100&amp;width=160&amp;format=jpeg">
                    <img alt="^_^" class="item-image" src="//images.rbxcdn.com/ec5c01d220bf1b73403fa51519267742.gif"/>
                </div>
                <div class="InfoContainer">
                    <div class="place-name"></div>
                    <div class="game-name"><span class="form-label">Game: </span><span class="game-name-text"></span></div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        Roblox.PlaceSelector.Init();
        Roblox.PlaceSelector.Resources = {
            anErrorOccurred: 'An error occurred, please try again.'
        };
    });
</script>
        </div>
    </div>
    

                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
        </div>
        
            <div id="Footer" class="footer-container">
    <div class="FooterNav">
        <a href="/info/Privacy.aspx">Privacy Policy</a>
        &nbsp;|&nbsp; 
        <a href="//corp.roblox.com/advertise-on-roblox" class="roblox-interstitial">Advertise with Us</a>
        &nbsp;|&nbsp; 
        <a href="//corp.roblox.com/roblox-press" class="roblox-interstitial">Press</a>
        &nbsp;|&nbsp; 
        <a href="//corp.roblox.com/contact-us" class="roblox-interstitial">Contact Us</a>
        &nbsp;|&nbsp;
        <a href="//corp.roblox.com/" class="roblox-interstitial">About Us</a>
        &nbsp;|&nbsp;
        <a href="//blog.roblox.com" class="roblox-interstitial">Blog</a>
        &nbsp;|&nbsp;
        <a href="//corp.roblox.com/jobs" class="roblox-interstitial">Jobs</a>
        &nbsp;|&nbsp;
        <a href="//corp.roblox.com/parents" class="roblox-interstitial">Parents</a>
            <span class="LanguageOptionElement">&nbsp;|&nbsp;</span>
            <span ref="footer-parents" class="LanguageOptionElement LanguageTrigger roblox-interstitial" drop-down-nav-button="LanguageTrigger">English&nbsp;<span class="FooterArrow">▼</span>
                <div class="dropuplanguagecontainer" style="display:none;" data-drop-down-nav-container="LanguageTrigger">
                    <div class="dropdownmainnav" style="z-index:1023">
                            <a href="/UserLanguage/LanguageRedirect?languageCode=de&amp;relativePath=%2fUser.aspx%3fID%3d1025053"class="LanguageOption js-lang" data-js-langcode="de"><span class="notranslate">Deutsch</span>&nbsp;(German) </a>
                    </div>
                </div>
            </span>
    </div>
    <div class="FooterNav">
        <div id="SEOGenreLinks" class="SEOGenreLinks">
                  <a href="/all-games">All Games</a> 
                      <span>|</span>
                  <a href="/building-games">Building</a> 
                      <span>|</span>
                  <a href="/horror-games">Horror</a> 
                      <span>|</span>
                  <a href="/town-and-city-games">Town and City</a> 
                      <span>|</span>
                  <a href="/military-games">Military</a> 
                      <span>|</span>
                  <a href="/comedy-games">Comedy</a> 
                      <span>|</span>
                  <a href="/medieval-games">Medieval</a> 
                      <span>|</span>
                  <a href="/adventure-games">Adventure</a> 
                      <span>|</span>
                  <a href="/sci-fi-games">Sci-Fi</a> 
                      <span>|</span>
                  <a href="/naval-games">Naval</a> 
                      <span>|</span>
                  <a href="/fps-games">FPS</a> 
                      <span>|</span>
                  <a href="/rpg-games">RPG</a> 
                      <span>|</span>
                  <a href="/sports-games">Sports</a> 
                      <span>|</span>
                  <a href="/fighting-games">Fighting</a> 
                      <span>|</span>
                  <a href="/western-games">Western</a> 

        </div>
    </div>
    <div class="legal">
        <div class="left">
            <div id="a15b1695-1a5a-49a9-94f0-9cd25ae6c3b2">
    <a href="https://privacy.truste.com/privacy-seal/Roblox-Corporation/validation?rid=2428aa2a-f278-4b6d-9095-98c4a2954215" title="TRUSTe Children privacy certification" target="_blank">
        <img style="border: none" src="https://privacy-policy.truste.com/privacy-seal/Roblox-Corporation/seal?rid=2428aa2a-f278-4b6d-9095-98c4a2954215" width="133" height="45" alt="TRUSTe Children privacy certification"/>
    </a>
</div>
        </div>
        <div class="right">
            <p class="Legalese">
    ROBLOX, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a href="//corp.roblox.com/" ref="footer-smallabout" class="roblox-interstitial">ROBLOX Corporation</a>, ©2014. Patents pending.
    ROBLOX is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, and no resemblance to the products of these companies is intended. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" ref="footer-terms">Terms and Conditions</a>.
</p>
        </div>
        <div class="clear"></div>
    </div>
</div>
        
        </div></div>
    </div>
    <div id="ChatContainer" style="position: fixed; bottom: 0; right: 0; z-index: 10020">
        

    </div>

        
        <script src="//www.google-analytics.com/urchin.js" type="text/javascript"></script>
        <script type="text/javascript">
            _uacct = "UA-486632-1";
            _udn = "roblox.com";
            _uccn = "rbx_campaign";
            _ucmd = "rbx_medium";
            _ucsr = "rbx_source";
            urchinTracker();
            __utmSetVar('Visitor/Spider');
        </script>
    

    

<script type="text/javascript">
//<![CDATA[
if(typeof __utmSetVar !== 'undefined'){ __utmSetVar(''); }if(typeof __utmSetVar !== 'undefined'){ __utmSetVar('Roblox_User_Top_728x90'); }Roblox.Controls.Image.ErrorUrl = "//www.roblox.com/Analytics/BadHtmlImage.ashx";$(function () { $('.VisitButtonPlay').click(function () {play_placeId=$(this).attr('placeid');Roblox.CharacterSelect.placeid = play_placeId;Roblox.CharacterSelect.show();});$('.VisitButtonPersonalServer').click(function () {play_placeId=$(this).attr('placeid');Roblox.CharacterSelect.placeid = play_placeId;Roblox.CharacterSelect.show();});$('.VisitButtonBuild').click(function () {RobloxLaunch._GoogleAnalyticsCallback = function() { var isInsideRobloxIDE = 'website'; if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) { isInsideRobloxIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Build Location', 'Guest', isInsideRobloxIDE]);GoogleAnalyticsEvents.FireEvent(['Build', 'Guest', '']); }; play_placeId = (typeof $(this).attr('placeid') === 'undefined') ? play_placeId : $(this).attr('placeid'); Roblox.Client.WaitForRoblox(function() { window.location = '/Login/Default.aspx?ReturnUrl=http%3a%2f%2fwww.roblox.com%2fUser.aspx%3fID%3d1025053' }); return false;});$('.VisitButtonEdit').click(function () {RobloxLaunch._GoogleAnalyticsCallback = function() { var isInsideRobloxIDE = 'website'; if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) { isInsideRobloxIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Edit Location', 'Guest', isInsideRobloxIDE]);GoogleAnalyticsEvents.FireEvent(['Edit', 'Guest', '']); }; play_placeId = (typeof $(this).attr('placeid') === 'undefined') ? play_placeId : $(this).attr('placeid'); Roblox.Client.WaitForRoblox(function() { RobloxLaunch.StartGame('//www.roblox.com//Game/edit.ashx?PlaceID='+play_placeId+'&upload=', 'edit.ashx', 'https://www.roblox.com//Login/Negotiate.ashx', 'FETCH', true) }); return false;});Roblox.CharacterSelect.robloxLaunchFunction = function (genderTypeID) { if (genderTypeID == 3) { var isInsideRobloxIDE = 'website'; if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) { isInsideRobloxIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Play Location', 'Guest', isInsideRobloxIDE]);GoogleAnalyticsEvents.FireEvent(['Play', 'Guest', '', 0]);$(function(){ RobloxEventManager.triggerEvent('rbx_evt_play_guest', {age:'Unknown',gender:'Female'});});} else { var isInsideRobloxIDE = 'website'; if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) { isInsideRobloxIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Play Location', 'Guest', isInsideRobloxIDE]);GoogleAnalyticsEvents.FireEvent(['Play', 'Guest', '', 1]);$(function(){ RobloxEventManager.triggerEvent('rbx_evt_play_guest', {age:'Unknown',gender:'Male'});});}play_placeId = (typeof $(this).attr('placeid') === 'undefined') ? play_placeId : $(this).attr('placeid'); Roblox.Client.WaitForRoblox(function() { RobloxLaunch.RequestGame('PlaceLauncherStatusPanel', play_placeId, genderTypeID); }); return false;};});;(function() {var fn = function() {Roblox.Thumbs.AvatarImage.updateUrl('ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl02_hlAvatar');Sys.Application.remove_load(fn);};Sys.Application.add_load(fn);})();if(typeof __utmSetVar !== 'undefined'){ __utmSetVar('Roblox_User_Middle_300x250'); }Sys.Application.add_init(function() {
    $create(Roblox.Thumbs.AvatarImage, {"fileExtension":"Png","pollTime":"6000","spinnerUrl":"/Thumbs/ProgressIndicator.gif","thumbnailFormatID":41,"userID":1095527}, null, null, $get("ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl02_hlAvatar"));
});
//]]>
</script>
</form>
    
    
    

<div id="InstallationInstructions"  class="modalPopup blueAndWhite" style="display:none;overflow:hidden" >
    <a id="CancelButton2" onclick="return Roblox.Client._onCancel();" class="ImageButton closeBtnCircle_35h ABCloseCircle"></a>
    <div style="padding-bottom:10px;text-align:center">
        <br /><br />
    </div>
</div>



<div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
<iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>


<script type='text/javascript' src='//js.rbxcdn.com/d387e54149ead170a1a8d204d0e7f1ed.js'></script>

<script type="text/javascript">
    Roblox.Client._skip = null;
    Roblox.Client._CLSID = '';
    Roblox.Client._installHost = '';
    Roblox.Client.ImplementsProxy = false;
    Roblox.Client._silentModeEnabled = false;
    Roblox.Client._bringAppToFrontEnabled = false;

         Roblox.Client._installSuccess = function() { GoogleAnalyticsEvents && GoogleAnalyticsEvents.ViewVirtual('InstallSuccess'); };
    </script>


<div id="PlaceLauncherStatusPanel" style="display:none;width:300px">
    <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
        <div id="Spinner" class="Spinner" style="margin:0 1em 1em 0; padding:20px 0;">
            <img src="https://images.rbxcdn.com/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" />
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



<script type='text/javascript' src='https://js.rbxcdn.com/507606ba77acf2ff29dd3ec7cb668f06.js'></script>

    <div id="videoPrerollPanel" style="display:none">
        <div id="videoPrerollTitleDiv">
            Gameplay sponsored by:
        </div>
        <div id="videoPrerollMainDiv"></div>
        <div id="videoPrerollCompanionAd"></div>
        <div id="videoPrerollLoadingDiv">
            Loading <span id="videoPrerollLoadingPercent">0%</span> - <span id="videoPrerollMadStatus" class="MadStatusField">Starting game...</span><span id="videoPrerollMadStatusBackBuffer" class="MadStatusBackBuffer"></span>
            <div id="videoPrerollLoadingBar">
                <div id="videoPrerollLoadingBarCompleted">
                </div>
            </div>
        </div>
        <div id="videoPrerollJoinBC">
            <span>Get more with Builders Club!</span>
            <a href="/Upgrades/BuildersClubMemberships.aspx?ref=vpr" target="_blank" id="videoPrerollJoinBCButton"></a>
        </div>
    </div>
    <script type="text/javascript">
        Roblox.VideoPreRoll.showVideoPreRoll = false;
        Roblox.VideoPreRoll.loadingBarMaxTime = 33000;
        Roblox.VideoPreRoll.videoOptions.key = "robloxcorporation";
        Roblox.VideoPreRoll.videoOptions.categories = "NonBC,IsLoggedIn,AgeUnknown,GenderUnknown";
             Roblox.VideoPreRoll.videoOptions.id = "games";
        Roblox.VideoPreRoll.videoLoadingTimeout = 11000;
        Roblox.VideoPreRoll.videoPlayingTimeout = 41000;
        Roblox.VideoPreRoll.videoLogNote = "NotWindows";
        Roblox.VideoPreRoll.logsEnabled = true;
        Roblox.VideoPreRoll.excludedPlaceIds = "32373412";
            
                Roblox.VideoPreRoll.specificAdOnPlacePageEnabled = true;
                Roblox.VideoPreRoll.specificAdOnPlacePageId = 57507247;
                Roblox.VideoPreRoll.specificAdOnPlacePageCategory = "stooges";
            
                    
                Roblox.VideoPreRoll.specificAdOnPlacePage2Enabled = true;
                Roblox.VideoPreRoll.specificAdOnPlacePage2Id = 122911678;
                Roblox.VideoPreRoll.specificAdOnPlacePage2Category = "lego";
            
        $(Roblox.VideoPreRoll.checkEligibility);
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
        <div class="RevisedFooter" >
            <div style="width:200px;margin:10px auto 0 auto;">
                <a href="#" onclick="redirectPlaceLauncherToRegister(); return false;"><div class="RevisedCharacterSelectSignup"></div></a>
                <a class="HaveAccount" href="#" onclick="redirectPlaceLauncherToLogin();return false;">I have an account</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function checkRobloxInstall() {
                 window.location= '/install/unsupported.aspx'; return false;
    }
        if (typeof MadStatus === "undefined") {
            MadStatus = {};
        }

        MadStatus.Resources = {
            //<sl:translate>
            accelerating: "Accelerating",
			aggregating: "Aggregating",
			allocating: "Allocating",
            acquiring: "Acquiring",
			automating: "Automating",
			backtracing: "Backtracing",
			bloxxing: "Bloxxing",
			bootstrapping: "Bootstrapping",
			calibrating: "Calibrating",
			correlating: "Correlating",
			denoobing: "De-noobing",
			deionizing: "De-ionizing",
			deriving: "Deriving",
            energizing: "Energizing",
			filtering: "Filtering",
			generating: "Generating",
			indexing: "Indexing",
			loading: "Loading",
			noobing: "Noobing",
			optimizing: "Optimizing",
			oxidizing: "Oxidizing",
			queueing: "Queueing",
			parsing: "Parsing",
			processing: "Processing",
			rasterizing: "Rasterizing",
			reading: "Reading",
			registering: "Registering",
			rerouting: "Re-routing",
			resolving: "Resolving",
			sampling: "Sampling",
			updating: "Updating",
			writing: "Writing",
            blox: "Blox",
			countzero: "Count Zero",
			cylon: "Cylon",
			data: "Data",
			ectoplasm: "Ectoplasm",
			encryption: "Encryption",
			event: "Event",
			farnsworth: "Farnsworth",
			bebop: "Bebop",
			fluxcapacitor: "Flux Capacitor",
			fusion: "Fusion",
			game: "Game",
			gibson: "Gibson",
			host: "Host",
			mainframe: "Mainframe",
			metaverse: "Metaverse",
			nerfherder: "Nerf Herder",
			neutron: "Neutron",
			noob: "Noob",
			photon: "Photon",
			profile: "Profile",
			script: "Script",
			skynet: "Skynet",
			tardis: "TARDIS",
			virtual: "Virtual",
            analogs: "Analogs",
			blocks: "Blocks",
			cannon: "Cannon",
			channels: "Channels",
			core: "Core",
			database: "Database",
			dimensions: "Dimensions",
			directives: "Directives",
			engine: "Engine",
			files: "Files",
			gear: "Gear",
			index: "Index",
			layer: "Layer",
			matrix: "Matrix",
			paradox: "Paradox",
			parameters: "Parameters",
			parsecs: "Parsecs",
			pipeline: "Pipeline",
			players: "Players",
			ports: "Ports",
			protocols: "Protocols",
			reactors: "Reactors",
			sphere: "Sphere",
			spooler: "Spooler",
			stream: "Stream",
			switches: "Switches",
			table: "Table",
			targets: "Targets",
			throttle: "Throttle",
			tokens: "Tokens",
			torpedoes: "Torpedoes",
			tubes: "Tubes"
            //</sl:translate>
        };
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
        //<sl:translate>
        Roblox.GenericConfirmation.Resources = { yes: "Yes", No: "No" }
        //</sl:translate>
    </script>
</div>


        <img src="https://secure.adnxs.com/seg?add=550800&t=2" width="1" height="1" style="display:none;"/>

</body>                
</html>
