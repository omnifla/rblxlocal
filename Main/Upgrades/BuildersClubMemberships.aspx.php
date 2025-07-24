<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" style="--wm-toolbar-height: 67px;">
<!-- MachineID: WEB203 -->
<!-- MachineID: WEB79 -->
<head id="ctl00_Head1"><meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" /><title>
	<?= $site_properties['Title'] ?> - Builders Club
</title>

<head id="ctl00_Head1">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___3f022c119bae81d03158987f73441ea8_m.css" />
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=reset___90041b2af2fb6b9b7864ee66001ba812_m.css' /> 
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___97cad0883768f57f1b3c21ecbc1579e1_m.css' />
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___471556a667fe48abaf7ce2023f7a6fd9_m.css' />
</head>

<body class="unfixed">
	<script type="text/javascript">
	Roblox.XsrfToken.setToken('');
	</script>
	<script type="text/javascript">
	if(top.location != self.location) {
		top.location = self.location.href;
	}
	</script>
	<style type="text/css">

	</style>
	<form name="aspnetForm" method="post" action="https://<?= $site_properties['hostname'] ?>/Upgrades/BuildersClubMemberships.php" id="aspnetForm">
		<div>
			<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTQwMzUyMDY4Mg9kFgJmD2QWAgIBEBYCHgZhY3Rpb24FJi9VcGdyYWRlcy9CdWlsZGVyc0NsdWJNZW1iZXJzaGlwcy5hc3B4ZBYGAgIPDxYCHgdWaXNpYmxlaGRkAggPDxYCHwFoZGQCCw9kFgJmD2QWAgIDD2QWAmYPZBYGAgIPZBYGAgEPZBYEAgEPZBYCZg8VAQROb25lZAICD2QWAmYPFQEAZAICD2QWBAIBD2QWAmYPFQECTm9kAgIPZBYCZg8VAQJOb2QCAw9kFgQCAQ9kFgJmDxUBCHh4L3h4L3h4ZAICD2QWAmYPFQEIeHgveHgveHhkAgMPFQEIeHgveHgveHhkAgQPFgIeBGhyZWYFI34vVXBncmFkZXMvUGF5bWVudE1ldGhvZHMuYXNweD9hcD0wZBgDBSNjdGwwMCRyYnhHb29nbGVBbmFseXRpY3MkTXVsdGlWaWV3MQ8PZAIBZAUkY3RsMDAkUmlnaHRHdXR0ZXJBZCRBc3luY0FkTXVsdGlWaWV3Dw9kAgNkBSNjdGwwMCRMZWZ0R3V0dGVyQWQkQXN5bmNBZE11bHRpVmlldw8PZAIDZEqB3GAPF8DTfRovy/2YZLGboDBD"> </div>
		<script src="https://<?= $site_properties['hostname'] ?>/ScriptResource.axd?d=_N1An8P2Pkfqm0X7bY0tY0ki9xzgFypv5XL8mPznGn9mcEJLpfhxHl5AvGIlRMAwalUsTdfObbcA6d8S8g33JgCKUyRFCB8PIkSKNK21-sMDwtebHfJmgaFkZfKdfZEQJYR6-QwQcq_x1MUisWKPJ88g33mdHav3djd7uC8lOBiwWdwgwFC6DHvXu-r9kGKTXJktytLicDqAyb9do-a4xfckbkupkIuxFCIr-ShCbtDfTALAYKaxR0bLULmU1FMNBT3thYW1LAQxatc_F1BU8SOVKlf860nn_RVseQEqiL7Bl7Un65p2A8dletaTL48z6XnXAxW57byQq5dn-UP1Efz42vBchxvOwXmDJJrrRfUv4r7TYH9PLhW9mzzPCB213OHhSc5Fs1cGF_ptwDeWeAEg117xhw7fSMWyqNw4zULpUX6iMc-rW0QWVD9VmO26jFUf_w2" type="text/javascript"></script>
		<div id="fb-root"> </div>
		<div class="">
			<div class="">
				<div id="MasterContainer" class="unfixed">
					<script type="text/javascript">
					$(function() {
						function trackReturns() {
							function dayDiff(d1, d2) {
								return Math.floor((d1 - d2) / 86400000);
							}
							var cookieName = 'RBXReturn';
							var cookieOptions = {
								expires: 9001
							};
							var cookie = $.getJSONCookie(cookieName);
							if(typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
								$.setJSONCookie(cookieName, {
									ts: new Date().toDateString()
								}, cookieOptions);
								return;
							}
							var daysSinceFirstVisit = dayDiff(new Date(), new Date(cookie.ts));
							if(daysSinceFirstVisit == 1 && typeof cookie.odr === "undefined") {
								RobloxEventManager.triggerEvent('rbx_evt_odr', {});
								cookie.odr = 1;
							}
							if(daysSinceFirstVisit >= 1 && daysSinceFirstVisit <= 7 && typeof cookie.sdr === "undefined") {
								RobloxEventManager.triggerEvent('rbx_evt_sdr', {});
								cookie.sdr = 1;
							}
							$.setJSONCookie(cookieName, cookie, cookieOptions);
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
					<script type="text/javascript">
					Roblox.FixedUI.gutterAdsEnabled = false;
					</script>
					<div id="Container" class="unfixed">
					<?= SiteHeader::render() ?>
					<div class="forceSpace unfixed">&nbsp;</div>
					<noscript>
						<div class="SystemAlert">
							<div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div>
						</div>
					</noscript>
					<div id="BodyWrapper">
						<div id="RepositionBody">
							<div id="Body" style="">
								<style>
								#Body {
									width: 970px;
									padding: 10px;
								}
								</style>
								<div id="BCPageContainer">
									<div id="UserDataInfo" data-auth="false" data-active-bc="false"></div>
									<div class="header"> <span><h1>Upgrade to ROBLOX Builders Club</h1></span> </div>
									<div class="left-column">
										<table cellspacing="0" border="0">
											<thead class="product-title">
												<tr>
													<td class="center-bold">
														<h2 class="product-space">Free</h2> <img src="https://web.archive.org/web/20140124075241im_/https://s3.amazonaws.com/images.roblox.com/77add140640c3388e6c9603bc5983846.png" alt="bc"> </td>
													<td class="center-bold">
														<h2 class="product-space">Classic</h2> <img src="https://web.archive.org/web/20140124075241im_/https://s3.amazonaws.com/images.roblox.com/ba707f47bb20a1f4804da461fb5d3c31.png" alt="bc"> </td>
													<td class="center-bold">
														<h2 class="product-space">Turbo</h2> <img src="https://web.archive.org/web/20140124075241im_/https://s3.amazonaws.com/images.roblox.com/d7eb3ed186e351d99ce8c11503675721.png" alt="tbc"> </td>
													<td class="center-bold">
														<h2 class="product-space">Outrageous</h2> <img src="https://web.archive.org/web/20140124075241im_/https://s3.amazonaws.com/images.roblox.com/ca1d0aef06c5fc06a2d8b23aea5e20d2.png" alt="obc"> </td>
												</tr>
											</thead>
											<tbody class="product-summary summary-big">
												<tr>
													<td class="divider-top"> <span class="product-description">Daily ROBUX</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product "> R$15 </td>
													<td class="divider-top tbc-product 		emphasis
"> R$35 </td>
													<td class="divider-top obc-product 		emphasis
"> R$60 </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Active Places</span> <span class="nbc-product">1</span> </td>
													<td class="divider-top bc-product "> 10 </td>
													<td class="divider-top tbc-product 		emphasis
"> 25 </td>
													<td class="divider-top obc-product 		emphasis
"> 100! </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Join Groups</span> <span class="nbc-product">5</span> </td>
													<td class="divider-top bc-product "> 10 </td>
													<td class="divider-top tbc-product "> 20 </td>
													<td class="divider-top obc-product "> 100! </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Create Groups</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product "> 10 </td>
													<td class="divider-top tbc-product "> 20 </td>
													<td class="divider-top obc-product "> 100! </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Signing Bonus</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product "> R$100 </td>
													<td class="divider-top tbc-product "> R$100 </td>
													<td class="divider-top obc-product "> R$100 </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Paid Access</span> <span class="nbc-product">10%</span> </td>
													<td class="divider-top bc-product "> 70% </td>
													<td class="divider-top tbc-product "> 70% </td>
													<td class="divider-top obc-product "> 70% </td>
												</tr>
											</tbody>
											<tbody class="product-grid">
												<tr>
													<td class="product-cell divider-left">
														<div class="product-nbc divider-bottom"></div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>Monthly</h3> </div> <a data-pid="1" data-rank="BC" data-duration="Monthly" class="btn-medium btn-primary product-button">$5.95</a> </div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>Monthly</h3> </div> <a data-pid="34" data-rank="TBC" data-duration="Monthly" class="btn-medium btn-primary product-button">$11.95</a> </div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>Monthly</h3> </div> <a data-pid="28" data-rank="OBC" data-duration="Monthly" class="btn-medium btn-primary product-button">$19.95</a> </div>
													</td>
												</tr>
												<tr>
													<td class="product-cell divider-left">
														<div class="product-nbc divider-bottom"></div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>6 Months</h3> </div> <a data-pid="6" data-rank="BC" data-duration="6 Months" class="btn-medium btn-primary product-button">$29.95</a> </div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>6 Months</h3> </div> <a data-pid="36" data-rank="TBC" data-duration="6 Months" class="btn-medium btn-primary product-button">$44.95</a> </div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>6 Months</h3> </div> <a data-pid="30" data-rank="OBC" data-duration="6 Months" class="btn-medium btn-primary product-button">$69.95</a> </div>
													</td>
												</tr>
												<tr>
													<td class="product-cell divider-left">
														<div class="product-nbc divider-bottom"></div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>12 Months</h3> </div> <a data-pid="8" data-rank="BC" data-duration="12 Months" class="btn-medium btn-primary product-button">$57.95</a> </div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>12 Months</h3> </div> <a data-pid="37" data-rank="TBC" data-duration="12 Months" class="btn-medium btn-primary product-button">$85.95</a> </div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell product-popular
">
															<div class="product-text">
																<div>
																	<h3>12 Months</h3></div>
																<h4 style="position:relative; top: -2px;">Best Value</h4> </div> <a data-pid="31" data-rank="OBC" data-duration="12 Months" class="btn-medium btn-primary product-button">$129.95</a> </div>
													</td>
												</tr>
												<tr>
													<td class="product-cell divider-left">
														<div class="product-nbc divider-bottom"></div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>Lifetime</h3> </div> <a data-pid="9" data-rank="BC" data-duration="Lifetime" class="btn-medium btn-primary product-button">$199.95</a> </div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>Lifetime</h3> </div> <a data-pid="38" data-rank="TBC" data-duration="Lifetime" class="btn-medium btn-primary product-button">$299.95</a> </div>
													</td>
													<td class="product-cell divider-left">
														<div class="		product-cell
">
															<div class="product-text">
																<h3>Lifetime</h3> </div> <a data-pid="53" data-rank="OBC" data-duration="Lifetime" class="btn-medium btn-primary product-button">$349.95</a> </div>
													</td>
												</tr>
											</tbody>
											<tbody class="product-summary summary-small">
												<tr>
													<td class="divider-top"> <span class="product-description">Ad Free</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product 		emphasis
"> ✔ </td>
													<td class="divider-top tbc-product 		emphasis
"> ✔ </td>
													<td class="divider-top obc-product 		emphasis
"> ✔ </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Sell Stuff</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product 		emphasis
"> ✔ </td>
													<td class="divider-top tbc-product 		emphasis
"> ✔ </td>
													<td class="divider-top obc-product 		emphasis
"> ✔ </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Virtual Hat</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product 		emphasis
"> ✔ </td>
													<td class="divider-top tbc-product 		emphasis
"> ✔ </td>
													<td class="divider-top obc-product 		emphasis
"> ✔ </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Bonus Gear</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product 		emphasis
"> ✔ </td>
													<td class="divider-top tbc-product 		emphasis
"> ✔ </td>
													<td class="divider-top obc-product 		emphasis
"> ✔ </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Create Badges</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product 		emphasis
"> ✔ </td>
													<td class="divider-top tbc-product 		emphasis
"> ✔ </td>
													<td class="divider-top obc-product 		emphasis
"> ✔ </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">BC Beta Features</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product 		emphasis
"> ✔ </td>
													<td class="divider-top tbc-product 		emphasis
"> ✔ </td>
													<td class="divider-top obc-product 		emphasis
"> ✔ </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Personal Servers</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product 		emphasis
"> ✔ </td>
													<td class="divider-top tbc-product 		emphasis
"> ✔ </td>
													<td class="divider-top obc-product 		emphasis
"> ✔ </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Trade System</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product 		emphasis
"> ✔ </td>
													<td class="divider-top tbc-product 		emphasis
"> ✔ </td>
													<td class="divider-top obc-product 		emphasis
"> ✔ </td>
												</tr>
												<tr>
													<td class="divider-top"> <span class="product-description">Mega Places</span> <span class="nbc-product">No</span> </td>
													<td class="divider-top bc-product 		emphasis
"> ✔ </td>
													<td class="divider-top tbc-product 		emphasis
"> ✔ </td>
													<td class="divider-top obc-product 		emphasis
"> ✔ </td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="right-column">
										<div id="RightColumnWrapper">
											<div class="cell cellDivider"> For billing and payment questions: <span class="SL_swap" id="CsEmailLink"><a href="https://web.archive.orgmailto:info@roblox.com">info@roblox.com</a></span> </div>
											<div class="">
												<div class="GenericModal modalPopup unifiedModal smallModal" style="display:none;">
													<div class="Title"></div>
													<div class="GenericModalBody">
														<div>
															<div class="ImageContainer"> <img class="GenericModalImage" alt="generic image"> </div>
															<div class="Message"></div>
														</div>
														<div class="clear"></div>
														<div id="GenericModalButtonContainer" class="GenericModalButtonContainer"> <a class="ImageButton btn-neutral btn-large roblox-ok">OK<span class="btn-text">OK</span></a> </div>
													</div>
												</div>
											</div>
											<div class="cell cellDivider">
												<h3>Buy ROBUX</h3>
												<p>Use ROBUX to buy virtual goods for your character - shirts, pants, hats, faces, and even heads! You can also buy gear, like hammers, potions, jet boots, swords, and BLOXI Cola.</p>
												<p> <a href="https://<?= $site_properties['hostname'] ?>/upgrades/robux.aspx" class="btn-medium btn-primary">Buy ROBUX</a> </p>
												<h3>Buy ROBUX with</h3>
												<br>
												<br>
												<a href="https://<?= $site_properties['hostname'] ?>/micropay"><img src="https://web.archive.org/web/20140124075241im_/https://s3.amazonaws.com/images.roblox.com/d3ac0f6384162cef74cfd79f7692612e.png" alt="boku"></a>
												<br>
												<br>
												<a href="https://<?= $site_properties['hostname'] ?>/rixtypin"><img src="https://web.archive.org/web/20140124075241im_/https://s3.amazonaws.com/images.roblox.com/93e037df4111777c7463d97eadebc59e.png" alt="rixty"></a>
												<br>
												<br>
												<a href="https://web.archive.orghttp://itunes.apple.com/us/app/roblox-mobile/id431946152?mt=8"><img src="https://web.archive.org/web/20140124075241im_/https://s3.amazonaws.com/images.roblox.com/70deff83e869746b0bbc41a86f420844.png" alt="itunes"></a>
											</div>
											<div class="cell cellDivider">
												<h3>Gift Cards</h3>
												<br>
												<a href="https://<?= $site_properties['hostname'] ?>/upgrades/giftcards.aspx" class="giftCardImage"><img src="https://web.archive.org/web/20140124075241im_/https://s3.amazonaws.com/images.roblox.com/bf9f4b65f937ad01f07ae6714eaba723.png" alt="giftcard"></a>
												<div>
													<div class="giftCardButton"> <a href="https://<?= $site_properties['hostname'] ?>/upgrades/giftcards.aspx" class="btn-small btn-primary">Buy Card</a> </div>
													<div><a href="https://<?= $site_properties['hostname'] ?>/gamecard" class="redeemLink">Redeem card</a></div>
													<div style="clear: both"></div>
												</div>
											</div>
											<div class="cell cellDivider">
												<h3>Game Cards</h3>
												<a href="https://<?= $site_properties['hostname'] ?>/gamecards"><img alt="ROBLOX Gamecards" src="https://web.archive.org/web/20140124075241im_/https://s3.amazonaws.com/images.roblox.com/863c65342816d665de28411cf47cde42.png"></a>
												<div class="gameCardControls">
													<div class="gameCardButton"> <a href="https://<?= $site_properties['hostname'] ?>/gamecards" class="btn-small btn-primary">Where to Buy</a> </div>
													<div><a href="https://<?= $site_properties['hostname'] ?>/gamecard" class="redeemLink">Redeem Card</a></div>
													<div style="clear: both"></div>
												</div>
											</div>
											<div class="cell">
												<h3>Need Builders Club Now?</h3>
												<p>Fill out our fun, interactive form, and print it out or send it your friends and family!</p> <a href="https://<?= $site_properties['hostname'] ?>/my/share/pleaseupgrademe.aspx" class="btn-small btn-primary">Please Upgrade Me!</a>
												<p>Warning: "Please Upgrade Me!" may be very convincing.</p>
												<h3>Parents</h3>
												<p>Learn more about builders club and how we help <a href="https://web.archive.orghttp://corp.roblox.com/parents/builders-club" class="roblox-interstitial">keep kids safe.</a></p>
												<h3>Other Accounts</h3>
												<p>To cancel the memberships for one or more other accounts, please contact customer service at info@Roblox.com. Please Note: You can cancel monthly recurring memberships any time before the renewal date. 6 and 12 month memberships cannot be canceled. Memberships are not refundable.</p>
											</div>
										</div>
									</div>
									<div id="dialog-confirmation" style="display: none;"></div>
								</div>
								<div id="BuyBCComparePanel" class="modalPopup blueAndWhite" style="width: 500px; min-height: 100px; display: none; position:relative; top:-150px;">
									<div id="simplemodal-close" class="simplemodal-close">
										<a id="ctl00_cphRoblox_BCCompareModal_A2" class="ImageButton closeBtnCircle_35h" style="cursor: pointer; margin-left:486px; position:absolute; top:-15px;"></a>
									</div>
									<div id="BCCompareModal" style="border:none;">
										<div id="ctl00_cphRoblox_BCCompareModal_BCCompareModalUpdatePanel" class="BCCompareModalUpdatePanel">
											<div id="BuyBCComparePanelTopInfo" style="width:390px;">
												<div id="ComparePanelImg" style="margin-bottom:15px;text-align: center;margin-top:-10px;"> <span style="font-weight:bold;font-size:13px;">Product Selected</span>
													<br> <img id="ctl00_cphRoblox_BCCompareModal_BuyBCComparePanelImage" src="/web/20140124075241im_/https://<?= $site_properties['hostname'] ?>/Upgrades/BuildersClubMemberships.php" style="border-width:0px;margin-top:5px;"> </div> <span id="ctl00_cphRoblox_BCCompareModal_BCCompareConversionInfo"></span> </div>
											<div style="border:1px solid #D3D3D3;">
												<br>
												<table id="ctl00_cphRoblox_BCCompareModal_verid" class="BuyBCComparePanelTable" cellspacing="0" cellpadding="0" align="Center" border="0" style="border-collapse:collapse;margin-left:auto;margin-right:auto;width:450px;">
													<tbody>
														<tr class="BCCompareHeaderRow">
															<th class="titlecolumn"></th>
															<th style="padding:10px 0px 5px 8px;width:130px;color:#666;text-align: left;">Your Current
																<br> Membership</th>
															<th class="BCCompareModalRow" style="padding:10px 0px 5px 8px;border-top:1px solid #000;text-align: left;">Your New
																<br> Membership</th>
														</tr>
														<tr class="BBCCompareRow">
															<td class="titlecolumn"> Builders Club Type </td>
															<td id="ctl00_cphRoblox_BCCompareModal_currentBC" style="width:130px;color:#666;">None</td>
															<td class="BCCompareModalRow"></td>
														</tr>
														<tr class="BBCCompareRow">
															<td class="titlecolumn"> Recurring </td>
															<td style="width:130px;color:#666;">No</td>
															<td class="BCCompareModalRow">No<span class="subscriptionHelp" style="margin-left: 3px; position: absolute; font-size: 16px; color: red; display: none;">*</span> </td>
														</tr>
														<tr class="BBCCompareRow">
															<td style="border-bottom:none;">Expiration</td>
															<td style="border-bottom:none;width:130px;color:#666;">xx/xx/xx</td>
															<td class="BCCompareModalRow" style="border-bottom:1px solid #000;">xx/xx/xx</td>
														</tr>
													</tbody>
												</table>
												<div class="subscriptionHelp" style="margin-bottom: 15px; margin-left: 15px; display: none;"><span style="color:Red;">*</span> You will be automatically billed every month starting xx/xx/xx </div>
												<script type="text/javascript">
												$(function() {
													$('.subscriptionHelp').hide();
												});
												</script>
											</div>
											<div id="BCCompareButtons" style="width:390px;margin-top:15px;height:50px"> <a href="PaymentMethods.aspx?ap=0" id="ctl00_cphRoblox_BCCompareModal_PurchaseLink" class="btn-primary btn-medium" style="margin-left:auto;margin-right:auto;cursor: pointer; text-decoration:none;">Purchase</a> </div>
										</div>
									</div>
								</div>
								<script type="text/javascript">
								function BCCompareClick(preloaded) {
									if(preloaded == null) {
										preloaded = false;
									}
									if($('#HasBCMembership').length > 0 && $('#HasBCMembership')[0].value == "False") {
										return;
									}
									var modalProperties = {
										overlayClose: true,
										escClose: true,
										opacity: 80,
										overlayCss: {
											backgroundColor: "#000"
										}
									};
									if(!preloaded) {
										$('.BCCompareModalUpdatePanel').html('<div style="background: url(/images/ProgressIndicator4.gif) center no-repeat;height:420px;width:100%;" >&nbsp;</div>');
									}
									$("#BuyBCComparePanel").modal(modalProperties);
								}
								</script>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
				</div>
				<?= SiteFooter::render() ?>
		<div id="ChatContainer" style="position: fixed; bottom: 0; right: 0; z-index: 10020"> </div>
		<script src="https://web.archive.orghttps://ssl.google-analytics.com/urchin.js" type="text/javascript"></script>
		<script type="text/javascript">
		_uacct = "UA-486632-1";
		_udn = "roblox.com";
		_uccn = "rbx_campaign";
		_ucmd = "rbx_medium";
		_ucsr = "rbx_source";
		urchinTracker();
		__utmSetVar('Visitor/Anonymous');
		</script>
		<script type="text/javascript">
		//<![CDATA[
		if(typeof __utmSetVar !== 'undefined') {
			__utmSetVar('');
		} //]]>
		</script>
	</form>
	<div id="InstallationInstructions" class="modalPopup blueAndWhite" style="display:none;overflow:hidden">
		<a id="CancelButton2" onclick="return Roblox.Client._onCancel();" class="ImageButton closeBtnCircle_35h ABCloseCircle"></a>
		<div style="padding-bottom:10px;text-align:center">
			<br>
			<br> </div>
	</div>
	<div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
	<iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute" data-ruffle-polyfilled=""></iframe>
	<script type="text/javascript" src="https://web.archive.orghttps://s3.amazonaws.com/js.roblox.com/8bcdddfb9aa61c2e1d92e5b8b5afff52.js"></script>
	<script type="text/javascript">
	Roblox.Client._skip = '/install/unsupported.aspx';
	Roblox.Client._CLSID = '';
	Roblox.Client._installHost = '';
	Roblox.Client.ImplementsProxy = false;
	Roblox.Client._silentModeEnabled = false;
	Roblox.Client._bringAppToFrontEnabled = false;
	Roblox.Client._installSuccess = function() {
		urchinTracker('InstallSuccess');
	};
	$(function() {
		Roblox.Client.Resources = {
			//<sl:translate>
			here: "here",
			youNeedTheLatest: "You need Our Plugin for this.  Get the latest version from ",
			plugInInstallationFailed: "Plugin installation failed!",
			errorUpdating: "Error updating: "
				//</sl:translate>
		};
	});
	</script>
	<div id="PlaceLauncherStatusPanel" style="display:none;width:300px">
		<div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
			<div id="Spinner" class="Spinner" style="margin:0 1em 1em 0; padding:20px 0;"> <img src="https://web.archive.org/web/20140124075241im_/https://s3.amazonaws.com/images.roblox.com/e998fb4c03e8c2e30792f2f3436e9416.gif" alt="Progress"> </div>
			<div id="status" style="min-height:40px;text-align:center;margin:5px 20px">
				<div id="Starting" class="PlaceLauncherStatus MadStatusStarting" style="display:block"> Starting Roblox... </div>
				<div id="Waiting" class="PlaceLauncherStatus MadStatusField">Connecting to Players...</div>
				<div id="StatusBackBuffer" class="PlaceLauncherStatus PlaceLauncherStatusBackBuffer MadStatusBackBuffer"></div>
			</div>
			<div style="text-align:center;margin-top:1em">
				<input type="button" class="Button CancelPlaceLauncherButton translate" value="Cancel"> </div>
		</div>
	</div>
	<script type="text/javascript" src="https://web.archive.orghttps://s3.amazonaws.com/js.roblox.com/507606ba77acf2ff29dd3ec7cb668f06.js"></script>
	<div id="videoPrerollPanel" style="display:none">
		<div id="videoPrerollTitleDiv"> Gameplay sponsored by: </div>
		<div id="videoPrerollMainDiv"></div>
		<div id="videoPrerollCompanionAd"></div>
		<div id="videoPrerollLoadingDiv"> Loading <span id="videoPrerollLoadingPercent">0%</span> - <span id="videoPrerollMadStatus" class="MadStatusField">Starting game...</span><span id="videoPrerollMadStatusBackBuffer" class="MadStatusBackBuffer"></span>
			<div id="videoPrerollLoadingBar">
				<div id="videoPrerollLoadingBarCompleted"> </div>
			</div>
		</div>
		<div id="videoPrerollJoinBC"> <span>Get more with Builders Club!</span>
			<a href="https://<?= $site_properties['hostname'] ?>/Upgrades/BuildersClubMemberships.php?ref=vpr" target="_blank" id="videoPrerollJoinBCButton"></a>
		</div>
	</div>
	<script type="text/javascript">
	Roblox.VideoPreRoll.showVideoPreRoll = false;
	Roblox.VideoPreRoll.loadingBarMaxTime = 30000;
	Roblox.VideoPreRoll.videoOptions.key = "robloxcorporation";
	Roblox.VideoPreRoll.videoOptions.categories = "NonBC,IsLoggedIn,AgeUnknown,GenderUnknown";
	Roblox.VideoPreRoll.videoOptions.id = "games";
	Roblox.VideoPreRoll.videoLoadingTimeout = 11000;
	Roblox.VideoPreRoll.videoPlayingTimeout = 23000;
	Roblox.VideoPreRoll.videoLogNote = "NotWindows";
	Roblox.VideoPreRoll.logsEnabled = true;
	Roblox.VideoPreRoll.excludedPlaceIds = "32373412";
	Roblox.VideoPreRoll.specificAdOnPlacePageEnabled = true;
	Roblox.VideoPreRoll.specificAdOnPlacePageId = 140438051;
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
		<div class="Title"> Choose Your Character </div>
		<div style="min-height: 275px; background-color: white;">
			<div style="clear:both; height:25px;"></div>
			<div style="text-align: center;">
				<div class="VisitButtonsGuestCharacter VisitButtonBoyGuest" style="float:left; margin-left:45px;"></div>
				<div class="VisitButtonsGuestCharacter VisitButtonGirlGuest" style="float:right; margin-right:45px;"></div>
			</div>
			<div style="clear:both; height:25px;"></div>
			<div class="RevisedFooter">
				<div style="width:200px;margin:10px auto 0 auto;">
					<a href="#" onclick="redirectPlaceLauncherToRegister(); return false;">
						<div class="RevisedCharacterSelectSignup"></div>
					</a> <a class="HaveAccount" href="#" onclick="redirectPlaceLauncherToLogin();return false;">I have an account</a> </div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	function checkRobloxInstall() {
		window.location = '/install/unsupported.aspx';
		return false;
	}
	if(typeof MadStatus === "undefined") {
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
				<div class="ImageContainer roblox-item-image" data-image-size="small" data-no-overlays="" data-no-click=""> <img class="GenericModalImage" alt="generic image"> </div>
				<div class="Message"></div>
			</div>
			<div class="ConfirmationModalButtonContainer"> <a href="" roblox-confirm-btn=""><span></span></a> <a href="" roblox-decline-btn=""><span></span></a> </div>
			<div class="ConfirmationModalFooter"> </div>
		</div>
		<script type="text/javascript">
		//<sl:translate>
		Roblox.GenericConfirmation.Resources = {
				yes: "Yes",
				No: "No"
			}
			//</sl:translate>
		</script>
	</div>
</body>

</html>
