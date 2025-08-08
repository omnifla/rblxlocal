<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Web\SiteAlert;
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">

<head>
    <title><?= $site_properties['Title'] ?>.com</title>
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___3254191a0cea4af8e8a0fecd1a2685b0_m.css' />
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___d0a32d7530b30a6f5d85fd297f8b6898_m.css' />
    <link rel="stylesheet" href="/Forum/skins/default/style/default.css" type="text/css" />
</head>

<body>
    <div id="BodyWrapper">
        <div id="RepositionBody">
            <?= SiteHeader::render() ?>
            <?= SiteAlert::render() ?>
            <div class="forceSpace">&nbsp;</div>
            <div id="Body" style="width:970px;">
                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr valign="top">
                    <tr>
                        <td align="left"></td>
                        <td align="right"><span id="ctl00_cphRoblox_ThreadView1">

<table cellpadding="0" width="100%">
	<tbody><tr>
		<td align="left"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1" name="Whereami1">
<div>
    <nobr>
        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_LinkHome" class="linkMenuSink notranslate" href="/Forum/Default.aspx">ROBLOX Forum</a>
    </nobr>
</div></span></td>
        <td align="right"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1">

<div id="forum-nav" style="text-align: right">
	<a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
	<a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
	
	
	
	
	
	
	
</div>
</span></td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td valign="top" colspan="2">
		    <div style="height:7px"></div>
		    <table id="ctl00_cphRoblox_ThreadView1_ctl00_ThreadList" class="tableBorder" cellspacing="1" cellpadding="3" border="0" style="width:100%;">
	<tbody><tr class="forum-table-header">
		<th align="left" colspan="3" style="height:25px;">&nbsp;Subject&nbsp;</th><th align="left" style="white-space:nowrap;">&nbsp;Author&nbsp;</th><th align="center">&nbsp;Replies&nbsp;</th><th align="center">&nbsp;Views&nbsp;</th><th align="center" style="white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
	</tr><tr class="forum-table-footer">
		<td colspan="7">&nbsp;</td>
	</tr>
</tbody></span>
            
            
		</td>
	</tr>
	<tr>
		<td colspan="2">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</tbody></table>
</span>
