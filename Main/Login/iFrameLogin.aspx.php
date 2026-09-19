<!DOCTYPE html>
<html>

<head>
    <title>
        ROBLOX Login
    </title>
    <link rel="stylesheet"
        href="/CSS/Base/CSS/FetchCSS?path=reset___90041b2af2fb6b9b7864ee66001ba812_m.css">

    <link rel="stylesheet"
        href="/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css">

    <link rel="stylesheet"
        href="/CSS/Base/CSS/FetchCSS?path=page___5a8ff58299be0fe55dfc145a90d39e8c_m.css">
    <!-- <script type="text/javascript"
        src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script> -->
    <script
        type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
    <!-- <script type="text/javascript"
        src="//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js"></script> -->
    <script
        type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
    <!-- <script type="text/javascript"
        src="//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js"></script> -->
    <script
        type="text/javascript">window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>
    <script type="text/javascript"
        src="//s3.amazonaws.com/js.roblox.com/fbf1ee7f87e15b4da11fda4617461836.js"></script>
</head>

<body>







    <div id="TwoStepVerificationApiPaths"
        data-request-code-unauthenticated="//api.roblox.com/twostepverification/request-unauthenticated"
        data-request-code="//api.roblox.com/twostepverification/request"
        data-verify-code-unauthenticated="//api.roblox.com/twostepverification/verify-unauthenticated"
        data-verify-code="//api.roblox.com/twostepverification/verify">
    </div>
    <div id="NotLoggedInPanel" class="rbx-login-form">
        <form name="FacebookLoginForm" method="post"
            action="/Login/iFrameLogin.aspx" id="FacebookLoginForm"
            class="rbx-form-horizontal" role="form">
            <div>
                <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE"
                    value="H0aydn/kuvJX/hAMaAVwBKO/UrIv5fHX61W+029ZRLK4d6OVRr9OWFMfGAvyCnDiEXBBWLfQecKKYFwt0aOYgsT8rz678TrNcj03S7StXP6J7M8mlClYTM5lsqIkos4y4G9Zc3bjgIKbp+FbRNUWbVRFAkU=">
            </div>


            <script
                src="/ScriptResource.axd?d=_93_rgQ5E6-wjuz8R2_fwh8uTqa3-RhXY1Phqp0LA0Y1geO99XLeod1wEPn4kc-s9PZLGYDPr7J4CCoI5YBGNXJ3Zc8XGhkBgJ6dQbjCoQksswaoBe81T8tYqvfUUzNS9TjilXkcAeHQVW0XAlE7JoksTgg50KdI2Qf2imFIhhKT2nopOGrnYbQMl_raTHlLINNksacp-SNmGAMiWDmEsAQYx9cVYmRMLvgQ8ukEMaF_Z9THHSMySVpDTqvkAETr4H2AXyDyii3uoYpuZTILklblp3U1"
                type="text/javascript"></script>
            <script src="/Services/Secure/LoginService.asmx/js"
                type="text/javascript"></script>
            <div>

                <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="2DF76423">
                <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION"
                    value="Jqlu7knrwvg+tVulhI8pX+PWJ0FLzMZ+VRv9RYKrmGIp0vb7G28a9eISYwjoaK0P7fyibxKOgwFLoxkeIUUKwqsNGNxHL1/qNOipwlQF8RfNpEkurxtmpP8ow23f5rEuVAIcp6oiLb4SYzLaGOluuCVn1UQ=">
            </div>

            <div id="LoginForm" class="rbx-newLogin">
                <div id="credentials-section" class="log-in-form">
                    <div class="rbx-form-group">
                        <input name="UserName" type="text" id="UserName"
                            class="form-control rbx-input-field LoginFormInput hidden" placeholder="Username"
                            tabindex="1">
                    </div>
                    <div class="rbx-form-group">
                        <input name="Password" type="password" id="Password"
                            class="form-control rbx-input-field LoginFormInput" placeholder="Password" tabindex="2">
                    </div>
                    <div id="iFrameCaptchaControl">

                    </div>
                    <div class="rbx-login-btns">
                        <a class="rbx-btn-secondary-sm" id="LoginButton" tabindex="4">Log In</a>
                        <a class="rbx-btn-control-sm" href="/newlogin?returnUrl="
                            target="_top">Sign up</a>
                    </div>
                    <span id="LoggingInStatus" class="rbx-login-status">
                        <img src="//s3.amazonaws.com/images.roblox.com/6ec6fa292c1dcdb130dcf316ac050719.gif"
                            alt="">
                        <span>Logging in...</span>
                    </span>
                </div>
                <div id="two-step-verification-section" class="log-in-form" style="display: none">
                    <div class="rbx-form-group">
                        <div id="TwoStepVerificationMessage" class="two-step-verification-message">Enter your two step
                            verification code.</div>
                    </div>
                    <div class="rbx-form-group">
                        <input name="TwoStepVerificationCodeInput" type="text" id="TwoStepVerificationCodeInput"
                            class="form-control rbx-input-field LoginFormInput" placeholder="Code" tabindex="3">
                    </div>
                    <div class="rbx-login-btns">
                        <a id="TwoStepVerificationNewCodeButton" class="rbx-btn-secondary-sm" style="display:none">New
                            Code</a>
                        <a id="TwoStepVerificationSubmitButton" class="rbx-btn-secondary-sm">Submit</a>
                        <a id="TwoStepVerificationCancelButton" class="rbx-btn-control-sm">Cancel</a>
                    </div>
                </div>
                <div class="rbx-login-msg">
                    <span id="ForgotPasswordLink">
                        <a href="ResetPasswordRequest.aspx" target="_top" class="rbx-link rbx-font-sm">Forgot
                            Password?</a>
                    </span>
                    <span id="ErrorMessage" class="rbx-text-danger rbx-font-sm"></span>
                </div>
                <div id="SocialNetworkSignIn" class="rbx-social-signin">
                    <div id="fb-root"></div>

                    <div class="rbx-facebook-login">
                        <a class="rbx-btn-generic-edit-sm iframe-login"
                            href="/social/redirect-to-facebook" target="_top">
                            <span class="rbx-icon-facebook"></span>
                            <span>Connect with Facebook</span>
                        </a>
                    </div>


                    <div id="SocialIdentitiesInformation" data-rbx-login="/social/notify-login"
                        data-rbx-update="/social/update-info" data-rbx-disconnect="/social/disconnect"
                        data-rbx-login-redirect-url="/social/postlogin">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            Roblox.iFrameLogin.Resources = {
                //<sl:translate>
                invalidCaptchaEntry: 'Invalid Captcha entry',
                //</sl:translate>
                useSignOnApi: 'False' === 'True',
                signOnApiPath: '//api.roblox.com/login/v1',
                requestCodeUnauthenticatedPath: '//api.roblox.com/twostepverification/request-unauthenticated',
                verifyCodeUnauthenticatedPath: '//api.roblox.com/twostepverification/verify-unauthenticated',
                enterTwoStepCodeMessage: 'Enter your two step verification code.',
                invalidCodeMessage: 'Sorry, but the code you entered was invalid or has expired.',
                floodedTwoStepMessage: 'Too many unsuccessful attempts. Please try again later.',
                verifyEmailMessage: 'You do not have a verified email address. Please contact customer support.',
                unknownTwoStepErrorMessage: 'Sorry, an unknown error has occurred.'
            };
            Roblox.iFrameLogin.init();
        });
    </script>



</body>

</html>