<?php
// written by omnifla
namespace Roblox\Web;

class UpsellAdModal
{
    public static function render()
    {
        return <<<HTML
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
        HTML;
    }
}