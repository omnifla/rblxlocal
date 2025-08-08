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
                        <td align="left"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1" name="Whereami1">
                                <div>
                                    <nobr>
                                        <a class="linkMenuSink notranslate" href="/Forum/Default.aspx">ROBLOX Forum</a>
                                    </nobr>
                                </div>
                            </span></td>
                        <td align="right"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1">

                                <div id="forum-nav" style="text-align: right">
                                    <a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
                                    <a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
                                </div>
                            </span></td>
                    </tr>
                    <td class="LeftColumn">&nbsp;</td>
                    <td id="ctl00_cphRoblox_CenterColumn" class="CenterColumn">
                        <br>
                        <table class="table" width="100%" cellpadding="2" cellspacing="1" border="0">
                            <div style="height:7px;"></div>
                            <tr class="table-header forum-table-header">
                                <th class="first" colspan="2" width="55%">&nbsp;Subject</th>
                                <th style="width:15%;" align="center">Author</th>
                                <th style="width:5%;" align="center">Replies</th>
                                <th style="width:5%;" align="center">Views</th>
                                <th style="width:20%;" align="center">Last Post&nbsp;</th>
                            </tr>
