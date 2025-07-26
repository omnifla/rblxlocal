<?php
// written by denied_id
include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">

<head id="ctl00_Head1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <title>
        <?= $site_properties["Title"] ?>.com
    </title>

    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___97cad0883768f57f1b3c21ecbc1579e1_m.css' />
</head>

<body class="unfixed">
    <div class=" no-gutter-ads">
        <div class="">
            <div class="">
                <?= SiteHeader::render() ?>
                <div id="MasterContainer">
                    <div class="forceSpace">&nbsp;</div>
                    <div id="Body" style="width:970px">

                        <h1 class="notranslate">Translation Reference Page</h1><br>

                        <h2 class="notranslate">HTML</h2><br>
                        <div class="notranslate">
                            I'm html that shouldn't be translated
                        </div>
                        <div>
                            I'm html that should be translated
                        </div>
                        <div>
                            I'm html and should be templated <span class="”notranslate”">not translated</span> translated <span class="”notranslate”">10 not translated</span>
                        </div>
                        <div>
                            <input type="button" class="translate" value="I'm a button and should be translated">
                        </div>

                        <h2 class="notranslate">Javascript</h2><br>
                        <h3 class="notranslate">In Page</h3><br>
                        <div id="jsvariable">Hi! I'm variable and should be translated</div>
                        <div id="jsonvalue">I'm from json on this page and should be translated</div> or
                        <div id="jsonvalue2">I'm from json on this page and should be translated</div> or
                        <div id="jsonvalueInBody">I'm from json on this page and should be translated</div>

                        <h3 class="notranslate">Text Loaded from Javascript File</h3><br>
                        <div id="fromfiletranslated">Hi! I'm variable value from a js file. This text should be translated</div>
                        <div id="fromfileuntranslated">Hi! I'm variable value from a js file. This text should be translated</div>

                        <h3 class="notranslate">Text Loaded from JSON Request</h3><br>
                        <div id="fromrequesttranslated"></div>

                        <div></div>
                        <script type="text/javascript">
                            $(function() {
                                /*<sl:translate>*/
                                var variableTranslated = "Hi! I'm variable and should be translated";
                                /*</sl:translate>*/

                                //<sl:translate_json> 
                                jsonInJavascriptTranslatedAttr = {
                                    "shouldbetranslated": "I'm from json on this page and should be translated",
                                    "requiredField": "Required field",
                                    "tooLong": "Too long"
                                };
                                //</sl:translate_json> 

                                //<sl:translate> 
                                jsonInJavascriptTranslatedAttr2 = {
                                    "shouldbetranslated": "I'm from json on this page and should be translated",
                                    "requiredField": "Required field",
                                    "tooLong": "Too long"
                                };
                                //</sl:translate> 

                                jsonInJavascriptTranslatedInBody = {
                                    "sl_translate": "sl_all",
                                    "shouldbetranslated": "I'm from json on this page and should be translated",
                                    "requiredField": "Required field",
                                    "tooLong": "Too long"
                                };

                                $("#jsvariable").html(variableTranslated);
                                $("#jsonvalue").html(jsonInJavascriptTranslatedAttr.shouldbetranslated);
                                $("#jsonvalue2").html(jsonInJavascriptTranslatedAttr2.shouldbetranslated);
                                $("#jsonvalueInBody").html(jsonInJavascriptTranslatedInBody.shouldbetranslated);
                            });
                        </script>
                        <div style="clear:both"></div>
                    </div>
                </div>
                <?= SiteFooter::render() ?>
            </div>
        </div>
    </div>
</body>