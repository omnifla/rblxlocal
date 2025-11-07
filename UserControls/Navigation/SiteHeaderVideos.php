<?php
// written by skyler
namespace Roblox\Web;
use Roblox\Authentication as Auth;
class SiteHeaderVideos{
    private bool $isAuthenticated;
    public static function render()
    {
        global $site_properties;
        if(!Auth::GetAuthenticatedUser()){
            return <<<HTML
            <div id="header" class="navbar-fixed-top rbx-header" role="navigation">
                <div class="container-fluid">
                    <div class="rbx-navbar-header">
                        <div data-behavior="nav-notification" class="rbx-nav-collapse" onselectstart="return false;">
                                        </div>
                        <div class="navbar-header">
                            <a class="navbar-brand" href="/"><span class="logo"></span></a>
                        </div>
                    </div>
                    <div class="navbar-right rbx-navbar-right col-xs-4 col-sm-3">
                            <ul class="nav navbar-right rbx-navbar-right-nav" data-display-opened="False">
                                <li>
                                    <a id="header-login" class="rbx-navbar-login" data-behavior="login" data-toggle="popover" data-bind="popover-login" data-viewport="#header">Log In</a>
                                </li>
                                <div id="iFrameLogin" class="rbx-popover-content" data-toggle="popover-login" role="menu">
                                    <iframe class="rbx-navbar-login-iframe" src="/Login/iFrameLogin.aspx" scrolling="no" frameborder="0" width="320"></iframe>
                                </div>
                                <li>
                                    <a class="rbx-navbar-signup" href="https://www.aftwld.xyz/">Sign Up</a>
                                </li>
                                <li class="rbx-navbar-right-search" data-toggle="toggle-search">
                                    <a class="rbx-menu-icon">
                                        <span class="rbx-icon-nav-search-white"></span>
                                    </a>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
            <!-- LEFT NAV MENU -->

            HTML;
        }else{
            $user = Auth::GetAuthenticatedUserInfo();
            $username = htmlspecialchars($user["username"], ENT_QUOTES, 'UTF-8');
            $userId = (int)$user["id"];
$html = <<<HTML
                <script type="text/javascript" src="//js.rbxcdn.com/9715e76471ffacd5f6d9c24a5ab101ad.js"></script>
            	<div id="header" class="navbar-fixed-top rbx-header" role="navigation">
                <div class="container-fluid">
                    <div class="rbx-navbar-header">
                        <div data-behavior="nav-notification" class="rbx-nav-collapse" onselectstart="return false;">
                                <span class="rbx-icon-nav-menu"></span>
                            
                            
                            <div class="rbx-nav-notification hide rbx-font-xs"
                                   title="0">
                                
                                
                            </div>
                            
                            
                        </div>
                        <div class="navbar-header">
                            <a class="navbar-brand" href="/"><span class="logo"></span></a>
                        </div>
                    </div>
                    <div class="navbar-right rbx-navbar-right col-xs-4 col-sm-3">
                    
                    
            <ul class="nav navbar-right rbx-navbar-icon-group">
                <li>
                    <a class="rbx-menu-item" data-toggle="popover" data-bind="popover-setting" data-viewport="#header">
                        <span class="rbx-icon-nav-settings" id="nav-settings"></span>
                        <span class="rbx-font-xs nav-setting-highlight hidden">0</span>
                    </a>
                    <div class="rbx-popover-content" data-toggle="popover-setting">
                        <ul class="rbx-dropdown-menu" role="menu">
                            <li>
                                <a class="rbx-menu-item" href="/my/account">
                                    Settings
                                    <span class="rbx-font-xs nav-setting-highlight hidden">0</span>
                                </a>
                            </li>
                            <li><a href="/Help/Builderman.aspx" target="_blank">Help</a></li>
                            <li><a data-behavior="logout" data-bind="/authentication/logout">Logout</a></li>
                        </ul>
                    </div>
                </li>
                <li class="rbx-navbar-right-search" data-toggle="toggle-search">
                    <a class="rbx-menu-icon">
                        <span class="rbx-icon-nav-search-white"></span>
                    </a>
                </li>
            </ul>        </div>
                </div>
            </div>
                    
            <!-- LEFT NAV MENU -->
                <div id="navigation" class="rbx-left-col" data-behavior="left-col">
                    <ul>
                        <li class="rbx-lead">
                            <a href="/videos/user.aspx">{$username}</a>
                        </li>
                        <li class="rbx-divider"></li>
                    </ul>
                    <div class="rbx-scrollbar" data-toggle="scrollbar" onselectstart="return false;">
                        <ul>
                            <li><a href="/" id="nav-home"><span class="rbx-icon-nav-home"></span><span>Home</span></a></li>
                            <li><a href="/videos/user.aspx" id="nav-profile"><span class="rbx-icon-nav-profile"></span><span>Profile</span></a></li>
                            <li><a href="/videos/search" id="nav-search"><span class="rbx-icon-nav-search"></span><span>Search</span></a></li>
                            <li class="rbx-upgrade-now">
                                <a href="https://www.aftwld.xyz/Upgrades/BuildersClubMemberships.aspx?ctx=leftnav" class="rbx-btn-secondary-xs" id="upgrade-now-button">Upgrade Now</a>
                            </li>
                        </ul>
                    </div>
                </div>
            HTML;
            return $html;
        }
    }
}
