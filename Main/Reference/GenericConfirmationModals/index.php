<?php
// written by denied_id
include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
use Roblox\Web\ConfirmationModal;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">

<head id="ctl00_Head1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <title>
        <?= $site_properties["Title"] ?>.com
    </title>

    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___97cad0883768f57f1b3c21ecbc1579e1_m.css' />
    <script>window.Roblox = window.Roblox || {};</script>
    <script src="/JS/Page.js"></script>
    <script src="/JS/GenericConfirmation.js"></script>
    <script src="/JS/Roblox.js"></script>
</head>

<body class="unfixed">
    <div class=" no-gutter-ads">
        <div class="">
            <div class="">
                <div id="MasterContainer">
                    <div>
                        <?= SiteHeader::render() ?>
                        <?= ConfirmationModal::render() ?>

                        <style>
                            html {
                                background: #123f83;
                            }
                        </style>
                        <div class="forceSpace">&nbsp;</div>
                        <noscript>
                            <div class="SystemAlert">
                                <div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div>
                            </div>
                        </noscript>
                        <div id="BodyWrapper">
                            <div id="RepositionBody">
                                <div id="Body" style="width:970px">

                                    <h1>Generic Confirmation Modal Usage Examples</h1><br>

                                    <input type="button" class="translate" value="Minimal Modal" onclick="minimalModal()">

                                    <input type="button" class="translate" value="Optional X Modal" onclick="cancelModal()">

                                    <input type="button" class="translate" value="Custom X Modal" onclick="cancelCustomModal()">

                                    <input type="button" class="translate" value="Modal With HTML Message Styling" onclick="htmlModal()">

                                    <input type="button" class="translate" value="Modal With Different Button Colors" onclick="buttonColorsModal()">

                                    <input type="button" class="translate" value="Modal With Different Button Text" onclick="buttonTextModal()">

                                    <input type="button" class="translate" value="Modal With Optional Image" onclick="imageModal()">

                                    <input type="button" class="translate" value="Modal With Optional Footer" onclick="footerModal()">

                                    <input type="button" class="translate" value="Non-dismissable modal" onclick="nondismissModal()">

                                    <input type="button" class="translate" value="Modal With The Whole Shebang" onclick="shebangModal()">

                                    <script type="text/javascript">
                                        $(function() {
                                            $("[data-js-do-things]").click(function() {
                                                alert("fu");
                                                return false;
                                            });
                                        });

                                        function minimalModal() {
                                            Roblox.GenericConfirmation.open({
                                                titleText: 'Title',
                                                bodyContent: 'Your message goes here',
                                                onAccept: function() {
                                                    alert("Accepted!");
                                                }
                                            });
                                        }

                                        function cancelModal() {
                                            Roblox.GenericConfirmation.open({
                                                titleText: 'Title',
                                                bodyContent: 'Your message goes here',
                                                xToCancel: true,
                                                onAccept: function() {
                                                    alert("Accepted!");
                                                }
                                            });
                                        }

                                        function cancelCustomModal() {
                                            Roblox.GenericConfirmation.open({
                                                titleText: 'Title',
                                                bodyContent: 'Your message goes here',
                                                xToCancel: true,
                                                onCancel: function() {
                                                    alert("Custom cancel!");
                                                },
                                                onAccept: function() {
                                                    alert("Accepted!");
                                                }
                                            });
                                        }

                                        function htmlModal() {
                                            Roblox.GenericConfirmation.open({
                                                titleText: 'Title',
                                                bodyContent: 'Your <i>message</i> goes here',
                                                onAccept: function() {
                                                    alert("Accepted!");
                                                },
                                                allowHtmlContentInBody: true
                                            });
                                        }

                                        function buttonColorsModal() {
                                            Roblox.GenericConfirmation.open({
                                                titleText: 'Title',
                                                bodyContent: 'Your message goes here',
                                                onAccept: function() {
                                                    alert("Accepted!");
                                                },
                                                acceptColor: Roblox.GenericConfirmation.gray,
                                                declineColor: Roblox.GenericConfirmation.blue
                                            });
                                        }

                                        function buttonTextModal() {
                                            Roblox.GenericConfirmation.open({
                                                titleText: 'Title',
                                                bodyContent: 'Your message goes here',
                                                onAccept: function() {
                                                    alert("Accepted!");
                                                },
                                                acceptColor: Roblox.GenericConfirmation.green,
                                                declineColor: Roblox.GenericConfirmation.blue,
                                                acceptText: "Buy Now",
                                                declineText: "Cancel"
                                            });
                                        }

                                        function imageModal() {
                                            Roblox.GenericConfirmation.open({
                                                titleText: 'Warning',
                                                bodyContent: 'Your message goes here',
                                                onAccept: function() {
                                                    alert("Warned!");
                                                },
                                                imageUrl: "/images/Icons/img-alert.png"
                                            });
                                        }

                                        function footerModal() {
                                            Roblox.GenericConfirmation.open({
                                                titleText: 'Warning',
                                                bodyContent: 'Your message goes here',
                                                onAccept: function() {
                                                    alert("Warned!");
                                                },
                                                footerText: 'Pressing no is not recommended'
                                            });
                                        }

                                        function nondismissModal() {
                                            Roblox.GenericConfirmation.open({
                                                titleText: 'Can\'t close this!',
                                                bodyContent: 'Your message goes here',
                                                onAccept: function() {
                                                    alert("Oh you closed it... cool.");
                                                },
                                                onDecline: function() {
                                                    alert("Oh you closed it... cool.")
                                                },
                                                footerText: 'Clicking yes or no is the only way',
                                                dismissable: false
                                            });
                                        }

                                        function shebangModal() {
                                            Roblox.GenericConfirmation.open({
                                                titleText: "Purchase Roblox",
                                                bodyContent: "Would you like to buy <font color='red'>ROBLOX</font>?",
                                                footerText: "Your US Dollars will be $-999999999 after this transaction",
                                                acceptText: "Buy Now",
                                                declineText: "No Way",
                                                acceptColor: Roblox.GenericConfirmation.green,
                                                declineColor: Roblox.GenericConfirmation.gray,
                                                onAccept: function() {
                                                    alert("Congratulations! You just bought Roblox!");
                                                },
                                                onDecline: function() {
                                                    alert("Awww, you could have bought Roblox!");
                                                },
                                                imageUrl: "/images/Icons/thumbs_up.png",
                                                allowHtmlContentInBody: true,
                                                dismissable: false
                                            });
                                        }
                                    </script>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </div>

                        <?= SiteFooter::render() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>