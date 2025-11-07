<?php
// written by meditext
// anti Google Safety Filters so anyone's sites doesnt get flagged
// we will use the following cookie "AgreedToSafetyFilters" to check if the user agreed to safety filters
// if not, we will show a modal asking them to agree
$cookie = $_COOKIE['AgreedToSafetyFilters'] ?? null;
if ($cookie == "true") {
    header("Location: /");
    exit; // user agreed, redirect to home
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Landing - RBLX.local</title>
        <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
        <script type="text/javascript" src="//code.jquery.com/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-3.5.2.min.js"></script>
        </script><script type="text/javascript" src="/js/roblox.js"></script>
        <link rel="stylesheet" href="/CSS/Base/CSS/StyleGuide.css">
    </head>
    <body>
        <div class="container">
            <center><h1>Safety Filters Agreement</h1></center>
            <div style="margin:0 auto;position:relative;width:970px;">
                <p>As ROBLOX Corporation is trying to low down revivals and partnered with an anti-phising AI project to prevent sites that mimic their official ones, we put this page as a landing to intentionally deflect the detection.</p>
                <p>By clicking "Agree", you acknowledge that:</p>
                <ul>
                    <li>This site is not affiliated with ROBLOX Corporation.</li>
                    <li>You are accessing a third-party website (not an official one).</li>
                    <li>You agree to use this site at your own risk.</li>
                    <li>You understand that this site has <b>no</b> relation with any of the transactions done on ROBLOX, and your accounts aren't linked by.</li>
                    <li>You agree to <b>follow</b> ROBLOX's and RBLX.local's Terms of Service and Community Standsards while using this site.<span class="info-tool-tip tooltip" title="Any term broken inside this site may lead you to a permament ban."></span></li>
                </ul>
                <button class="btn-medium btn-primary" id="agreeButton">Agree</button>
            </div>
            
        </div>
        <script>
            document.getElementById('agreeButton').addEventListener('click', function() {
                document.cookie = "AgreedToSafetyFilters=true; path=/; max-age=" + 60*60*24*365;
                window.location.href = "/";
            });
        </script>
    </body>
</html>
