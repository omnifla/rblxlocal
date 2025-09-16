<?php
// written by skyler
namespace Roblox\Web;
use Roblox\Authentication as Auth;
class SiteHeaderMobile {
    private bool $isAuthenticated;
    public static function render() {
        if (!Auth::GetAuthenticatedUser()) {
            return <<<HTML
            <div data-role="header" data-id="header">
                <div class="header-icons header-icons-left">
                    <a href="#" data-show-menu-link class="header-icons-menu"></a>
                </div>
                <h1 class="header-logo-only"></h1>
            </div>
            HTML;
        }
        $user = Auth::GetAuthenticatedUserInfo();
        $username = htmlspecialchars($user["username"], ENT_QUOTES, 'UTF-8');
        $userId = (int)$user["id"];
        return <<<HTML
        <div data-role="header" data-id="header">
            <div class="header-icons header-icons-left">
                <a href="#" data-show-menu-link class="header-icons-menu"></a>
            </div>
            <h1 class="header-logo-only"></h1>
            <div class="header-icons ui-btn-right">
                <a href="#" data-show-menu-link class="header-icons-friend-requests"></a>
                <a href="#" data-show-menu-link class="header-icons-inbox"></a>
            </div>
        </div>
        HTML;
    }
}
