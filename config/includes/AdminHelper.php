<?php
namespace Roblox\Admin;

use Roblox\Authentication as Auth;

class AdminHelper
{
    /**
     * List of user IDs that have admin privileges
     * Add/remove user IDs as needed
     */
    private static $admin_user_ids = [
        -1,
        1,
    ];

    /**
     * Check if the currently authenticated user has admin privileges
     * 
     * @return bool True if user is admin, false otherwise
     */
    public static function isCurrentUserAdmin(): bool
    {
        $current_user = Auth::GetAuthenticatedUser();
        
        if (!$current_user || $current_user['account_status_id'] != 1) {
            return false;
        }
        
        return in_array($current_user['id'], self::$admin_user_ids);
    }

    /**
     * Check if a specific user ID has admin privileges
     * 
     * @param int $user_id The user ID to check
     * @return bool True if user is admin, false otherwise
     */
    public static function isUserAdmin(int $user_id): bool
    {
        return in_array($user_id, self::$admin_user_ids);
    }

    /**
     * Require admin access - redirects to login or home if not admin
     * Call this at the top of admin pages
     * 
     * @param string $redirect_url Where to redirect non-admins (default: home page)
     */
    public static function requireAdmin(string $redirect_url = '/'): void
    {
        $current_user = Auth::GetAuthenticatedUser();
        
        // Not logged in or account not active
        if (!$current_user || $current_user['account_status_id'] != 1) {
            header("Location: /newlogin");
            exit;
        }
        
        // Not an admin
        if (!self::isCurrentUserAdmin()) {
            header("Location: $redirect_url");
            exit;
        }
    }

    /**
     * Get the list of admin user IDs (for management purposes)
     * 
     * @return array Array of admin user IDs
     */
    public static function getAdminUserIds(): array
    {
        return self::$admin_user_ids;
    }

    /**
     * Add a user ID to the admin list (requires existing admin to call)
     * Note: This only affects the current request - permanent changes need code updates
     * 
     * @param int $user_id User ID to add as admin
     * @return bool True if added successfully, false if not admin or already exists
     */
    public static function addAdminUser(int $user_id): bool
    {
        if (!self::isCurrentUserAdmin()) {
            return false;
        }
        
        if (!in_array($user_id, self::$admin_user_ids)) {
            self::$admin_user_ids[] = $user_id;
            return true;
        }
        
        return false; // Already exists
    }
}
