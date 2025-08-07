<?php
// writen by chloe and should work
include_once $_SERVER['DOCUMENT_ROOT'].'/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Web\SiteAlert;
$user = Auth::GetAuthenticatedUserInfo();
if(!Auth::GetAuthenticatedUser()){
    $url = $_SERVER['REQUEST_URI'];
    $redirect = '/newlogin?redirect-url=' . urlencode($url);
    header('Location: ' . $redirect);
    exit;
}
$userId = (int)$user['id'];
$errors = [];
$success = false;
// this code will be repositioned to /My/Account/Update.php
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $birthMonth = (int)($_POST['BirthMonth'] ?? 0);
    $birthDay = (int)($_POST['BirthDay'] ?? 0);
    $birthYear = (int)($_POST['BirthYear'] ?? 0);
    $gender = ($_POST['gender'] ?? '');
    $description = trim($_POST['PersonalBlurb'] ?? '');
    $chat = $_POST['ChatVisibilityPrivacy'] ?? 'All';
    $party = $_POST['PartyInvitePrivacy'] ?? 'All';
    $pm = $_POST['PrivateMessagePrivacy'] ?? 'All';
    $follow = $_POST['FollowPrivacy'] ?? 'All';
    $inv = $_POST['InventoryPrivacy'] ?? 'All';

    if (!$birthMonth || !$birthDay || !$birthYear) {
        $errors[] = 'Please select a valid birthday.';
    }
    if ($gender !== 'Male' && $gender !== 'Female') {
        $errors[] = 'Please select a gender.';
    }
    if (strlen($description) > 255) {
        $errors[] = 'Personal blurb must be 255 characters or less.';
    }

    if (!$errors) {
        $stmt = $conn->prepare("
            UPDATE users SET
              birthdate = :birthdate,
              gender = :gender,
              description = :description,
              \"ChatVisibilityPrivacy\" = :chat,
              \"PartyInvitePrivacy\" = :party,
              \"PrivateMessagePrivacy\" = :pm,
              \"FollowPrivacy\" = :follow,
              \"InventoryPrivacy\" = :inv,
              updated = NOW()
            WHERE id = :id
        ");
        $stmt->execute([
            'birthdate'=> sprintf('%04d-%02d-%02d',$birthYear,$birthMonth,$birthDay),
            'gender'=> ($gender==='Male') ? 1 : 2,
            'description'=>$description,
            'chat'=>$chat,'party'=>$party,'pm'=>$pm,'follow'=>$follow,'inv'=>$inv,
            'id'=>$userId
        ]);
        $success = true;
    }
} else {
    $birthYear = isset($user['birthdate']) ? (int)substr($user['birthdate'],0,4) : null;
    $birthMonth = isset($user['birthdate']) ? (int)substr($user['birthdate'],5,2) : null;
    $birthDay = isset($user['birthdate']) ? (int)substr($user['birthdate'],8,2) : null;
}
*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Account - <?= $site_properties['Title'] ?></title>
    <link href="/CSS/Pages/Accounts/AccountMVC.css" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___93d7b975be9106ab72cfa4deac3a5583_m.css">
    <link href="/CSS/Base/CSS/FetchCSS?path=page___2ad765c3e4926df9c25fa00b92677eed_m.css" rel="stylesheet">
    <link href="/CSS/Base/CSS/MyAccount.css" rel="stylesheet">
    <link href="/CSS/Pages/Character/Character.css" rel="stylesheet">
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.7.2.min.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
<script type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>
<script type="text/javascript" src="https://js.rbxcdn.com/c57cc32d0db0d462c64bb8ace02fdf13.js.gzip"></script>

    <script type="text/javascript">Roblox.config.externalResources = ['https://<?= $site_properties['hostname'] ?>/js/jquery/jquery-1.7.2.min.js','/js/json2.min.js'];Roblox.config.paths['jQuery'] = 'http://js.rbxcdn.com/e96b59fba745a37cdd847ff394b79aac.js.gzip';Roblox.config.paths['Pagelets.BestFriends'] = 'http://js.rbxcdn.com/9db05af88b1dc737664247f24a0120e0.js.gzip';Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/10a6b22225379eaa8d41dd1c0ffb6dc3.js.gzip';Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/f266eeedec9548a94baf73ccb09e4a5d.js.gzip';Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/6307f9bd9c09fa9d88c76291f3b68fda.js.gzip';Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/9f4404fc11d8b8958d09f6316719cef9.js.gzip';Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/88a3e1afed9aa3b21670a59ddb7775c3.js.gzip';Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/c98baf27bc7feda3206342566db92696.js.gzip';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/3f95857727df4739b29a8385501752fa.js.gzip';Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/152201bc9a4e721fe8c326c78b35e364.js.gzip';Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/4426a131abb3e214ed89338154f6e78a.js.gzip';Roblox.config.paths['Widgets.Suggestions'] = 'http://js.rbxcdn.com/63f96a694a0eedd389b573a5859b8974.js.gzip';Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/56ad7af86ee4f8bc82af94269ed50148.js.gzip';</script>
    
<script type="text/javascript" src="https://js.rbxcdn.com/f6ebdcdab40c43bb18d29009ce0880be.js.gzip"></script>

    
<script type="text/javascript" src="https://js.rbxcdn.com/32159205207304027c7e0aa4dd329d32.js.gzip"></script>
    <script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery.validate.unobtrusive.js"></script>
<script type="text/javascript" src="/Services/Secure/AddParentEmail.js"></script>
<script type="text/javascript" src="/js/SignupFormValidator.js"></script>
<script type="text/javascript" src="/js/My/AccountMVC.js"></script>
<script type="text/javascript" src="/js/AddEmail.js"></script>
<script type="text/javascript" src="/js/SuperSafePrivacyIndicator.js"></script>
    <style>
    .closeBtnCircle_20h { width:20px; height:20px; cursor:pointer; position:absolute; top:5px; left:5px; background:url(/images/Buttons/btn-x.png); }
    </style>
</head>
<body>
<?= SiteHeader::render() ?>
<?= SiteAlert::render() ?>
<div id="MasterContainer">
  <div id="BodyWrapper"><div id="RepositionBody"><div id="Body" style="width:970px">
    <div id="AccountPageContainer" data-missingparentemail="false" data-userabove13="true" data-currentdateyear="<?=date("Y")?>" data-currentdatemonth="<?=date("n")?>" data-currentdateday="<?=date("j")?>">
  <div id="AccountPageLeft" class="divider-right">
    <h1>My Account</h1>
    <form action="/My/Account/Update" id="UpdateAccountForm" method="post">
      <div class="tab-container">
        <div class="tab active" data-id="settings_tab">Settings</div>
        <div class="tab" data-id="privacy_tab">Privacy</div>
        <div class="tab" data-id="billing_tab">Billing</div>
      </div>
      <input name="__RequestVerificationToken" type="hidden" value="Eyz0_gyuXxwx74Q6xigT8xOa7HTcrkFCdIXAsP3-5gCh1tvGtCpyPjgdVNGOAAdyxvlOpnrvwDNEiLM29Nn9DCIjp0EaLvoCixZwWQeHglUrLNswAzzeVOCNof8-qDSK-IPHJddxujB2d15i1oRWR55t4yg1"> 
      <div class="tab-content active" id="settings_tab" style="display: block;">
        <div id="AccountSettings" class="settings-section">
          <div class="SettingSubTitle" id="UsernameSetting" <?php if ($user["robux"] < 1000) {echo('data-robux-remaining="'.(1000-$user["robux"]).'"');}?> data-email-verified="True" data-alerturl="https://s3.amazonaws.com/images.roblox.com/cbb24e0c0f1fb97381a065bd1e056fcb.png" data-change-username-verifyurl="/account/username/verifyupdate" data-change-username-url="/account/username/update" data-buy-robux-url="/upgrades/robux">
            <span class="settingLabel form-label">Username:</span> <span id="username"><?=htmlspecialchars($user["username"])?></span>
            <a class="btn-small btn-primary" id="changeUsername">Change My Username<span class="btn-text">Change My Username</span></a>
          </div>
          <div id="BirthdaySetting" class="SettingSubTitle">
            <span class="settingLabel form-label">Birthday:</span>
            <div id="Over13Birthday">
              <select class="accountPageChangeMonitor form-select" data-val="true" data-val-number="The field BirthMonth must be a number." data-val-range="The field BirthMonth must be between 1 and 12." data-val-range-max="12" data-val-range-min="1" data-val-required="The BirthMonth field is required."  id="MonthDropDown" name="BirthMonth">
                <?php
                // format expected on the birthdate row: 1996-01-02
                $birthdate = $user['birthdate'] ?? null;
                $dateParts = $birthdate ? explode('-', $birthdate) : [null, null, null];
                $year = $dateParts[0] ?? null;
                $month = isset($dateParts[1]) ? (int)$dateParts[1] : null;
                $day = isset($dateParts[2]) ? (int)$dateParts[2] : null;
                for ($m = 1; $m <= 12; $m++) {
                    $selected = ($m == $month) ? ' selected="selected"' : '';
                    $monthName = date('M', mktime(0, 0, 0, $m, 10));
                    echo "<option value=\"$m\"$selected>$monthName</option>\n";
                }
                ?>
              </select>
              <select class="accountPageChangeMonitor form-select" data-val="true" data-val-number="The field BirthDay must be a number." data-val-range="The field BirthDay must be between 1 and 31." data-val-range-max="31" data-val-range-min="1" data-val-required="The BirthDay field is required."  id="DayDropDown" name="BirthDay">
                <?php
                for ($d = 1; $d <= 31; $d++) {
                    $selected = ($d == $day) ? ' selected="selected"' : '';
                    echo "<option value=\"$d\"$selected>$d</option>\n";
                }
              ?>
              </select>
              <select class="accountPageChangeMonitor form-select" data-val="true" data-val-number="The field BirthYear must be a number." data-val-required="The BirthYear field is required."  id="YearDropDown" name="BirthYear">
              <?php
                $currentYear = date("Y");
                $startYear = $currentYear - 99;
                for ($y = $currentYear; $y >= $startYear; $y--) {
                    $selected = ($y == $year) ? ' selected="selected"' : '';
                    echo "<option value=\"$y\"$selected>$y</option>";
                }
              ?>
              </select>
              <input id="BirthMonth" name="BirthMonth" type="hidden" value="<?= $month ?>">
              <input id="BirthDay" name="BirthDay" type="hidden" value="<?= $day ?>">
              <input id="BirthYear" name="BirthYear" type="hidden" value="<?= $year ?>">
              <span>
              <a id="AskParentToVerifyAgeLink" class="btn-control btn-control-small" style = "display: none">
              Ask Parent To Change</a>
              </span>
            </div>
          </div>
          <div id="GenderSetting" class="SettingSubTitle">
            <span class="settingLabel form-label">Gender:</span>
            <div id="GenderControl">
              <div id="GenderSelectControl" class="accountPageChangeMonitor">
                <label class="radio-selection"><input <?php if($user['gender'] + 1 == 2){ echo 'checked="checked"';} ?> data-val="true" data-val-required="The Gender field is required." id="Gender_2" name="Gender" type="radio" value="2"><span for="Gender_2">Male</span></label><label class="radio-selection"><input id="Gender_3" <?php if($user['gender'] + 1 == 3){ echo 'checked="checked"';} ?> name="Gender" type="radio" value="3"><span for="Gender_3">Female</span></label>
                <span class="field-validation-valid" data-valmsg-for="Gender" data-valmsg-replace="true"></span>
              </div>
            </div>
          </div>
          <div id="PasswordSetting" class="SettingSubTitle">
            <span class="settingLabel form-label">Password:</span> <span id="securePassword">*********</span>
            <a id="changePassLink" class="changePassWord btn-control btn-control-small" href="/Login/ChangePassword.aspx">
            Change Password</a>
          </div>
          <div id="EmailAddressSetting" class="SettingSubTitle">
            <span id="emailAddressLabel" class="settingLabel form-label">Email address:</span>
            <div id="emailBlock">
              <span id="UserEmail">*******@example.com</span>
              <span id="EmailVerificationStatus" class="verifiedEmail"></span>
              <div id="Under13Email">
                <div>
                  To update your email address, please contact one of the ROBLOX admins.</span>
                </div>
              </div>
              <div id="NewsletterConfirm">
                <input checked="checked" class="accountPageChangeMonitor" data-val="true" data-val-required="The ReceiveNewsletter field is required." id="chkNewsletter" name="ReceiveNewsletter" type="checkbox" value="true" style="margin: 0px 3px 2px 0px; vertical-align: text-bottom;"><input name="ReceiveNewsletter" type="hidden" value="false">
                <span class="field-validation-valid" data-valmsg-for="ReceiveNewsletter" data-valmsg-replace="true"></span>
                <label id="lblNewsletter" class="text" for="chkNewsletter">
                I want to receive newsletters and updates from ROBLOX at this email address!</label>
          </div>
            </div>
          </div>
          <div id="PersonalBlurbSetting" class="SettingSubTitle">
            <span class="settingLabel form-label">Personal blurb:</span>
            <div id="BlurbDesc">
              <textarea class="roblox-blurb-default-text accountPageChangeMonitor text blurbGreyText valid" cols="20" data-val="true" data-val-length="The field Personal Blurb must be a string with a maximum length of 1000." data-val-length-max="1000" id="blurbText" name="PersonalBlurb" value="<?= htmlspecialchars($user['description']) ?>" rows="2" title="Describe yourself here"></textarea>
              <span class="field-validation-valid" data-valmsg-for="PersonalBlurb" data-valmsg-replace="true"></span>
              <br>
              <div id="blurbSubtext" class="footnote">
                Do not provide any details that can be used to identify you outside ROBLOX.
                <span class="footnote"><br>(1000 character limit)</span>
              </div>
            </div>
          </div>
          <div id="LanguageTypeSettings" class="SettingSubTitle">
            <span class="settingLabel form-label">Language:</span>
            <select class="accountPageChangeMonitor form-select valid" data-val="true" data-val-number="The field LanguageId must be a number." data-val-required="The LanguageId field is required." id="LanguageList" name="LanguageId">
              <option selected="selected" value="1">English</option>
              <option value="3">Deutsch</option>
            </select>
            <span class="field-validation-valid" data-valmsg-for="LanguageId" data-valmsg-replace="true"></span>
          </div>
          <div id="CountryTypeSettings" class="SettingSubTitle">
            <span class="settingLabel form-label">Country:</span>
            <select class="accountPageChangeMonitor form-select valid" data-val="true" data-val-number="The field CountryId must be a number." data-val-required="The CountryId field is required." id="CountryList" name="CountryId">
              <option selected="selected" value="0">None</option>
              <option value="9">Canada</option>
              <option value="4">France</option>
              <option value="2">Germany</option>
              <option value="7">Ireland</option>
              <option value="6">Italy</option>
              <option value="3">Netherlands</option>
              <option value="8">Portugal</option>
              <option value="5">Spain</option>
              <option value="1">United States</option>
            </select>
            <span class="field-validation-valid" data-valmsg-for="CountryId" data-valmsg-replace="true"></span>
          </div>
          <div style="clear: both;">
            <a class="btn-medium btn-neutral updateSettingsBtn" id="UpdateSettingsBtn1">Update<span class="btn-text">Update</span></a>
          </div>
        </div>
        <div id="AddEmailScreenModal" class="PurchaseModal simplemodal-data" data-uid="59896360" data-userip="72.211.206.23">
          <div id="CloseAddEmailScreen" class="simplemodal-close">
            <a id="closeEmailModal" runat="server" class="ImageButton closeBtnCircle_20h"></a>
          </div>
          <div id="changeEmailTitle" class="titleBar">
            Change Email Address
          </div>
          <div id="updateEmailBody">
            <div id="AddEmailDialog">
              <br>
              <div id="SubmitEmailButton">
                <a id="SubmitInfoButton" class="btn-medium btn-neutral btn-disabled-neutral">Update<span class="btn-text">Update</span></a> <a id="CancelInfoButton" class="btn-cancel-m btn-negative btn-medium">Cancel<span class="btn-text">Cancel</span></a>
              </div>
            </div>
            <div id="ConfirmationDialog">
              <div id="ConfirmationDialogInner">
                An email has been sent for verification.
              </div>
              <a href="#" id="updateEmailOK" class="ImageButton btn_blue_ok_l"></a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-content" id="privacy_tab">
        <div id="PrivacySettings" class="settings-section">
          <div id="ChatSetting" class="SettingSubTitle">
            <span class="form-label priv-label">Who can chat with me:</span>
            <span class="InlineSuperSafeDiv">
              <select class="accountPageChangeMonitor form-select" id="ChatOptions" name="ChatVisibilityPrivacy">
                <option value="All">All Users</option>
                <option value="TopFriends">Best Friends</option>
                <option selected="selected" value="Friends">Friends</option>
                <option value="Noone">No One</option>
                <option value="Disabled">Off</option>
              </select>
              <span class="field-validation-valid" data-valmsg-for="ChatVisibilityPrivacy" data-valmsg-replace="true"></span> 
            </span>
          </div>
          <div id="PartySetting" class="SettingSubTitle">
            <span class="form-label priv-label">Who can invite me to parties:</span>
            <span class="InlineSuperSafeDiv">
              <select class="accountPageChangeMonitor form-select" id="PatryList" name="PartyInvitePrivacy">
                <option value="All">All Users</option>
                <option value="TopFriends">Best Friends</option>
                <option selected="selected" value="Friends">Friends</option>
                <option value="Noone">No One</option>
                <option value="Disabled">Off</option>
              </select>
              <span class="field-validation-valid" data-valmsg-for="PartyInvitePrivacy" data-valmsg-replace="true"></span> 
            </span>
          </div>
          <div id="PrivateMessageSetting" class="SettingSubTitle">
            <span class="form-label priv-label">Who can send me private messages:</span>
            <span class="InlineSuperSafeDiv">
              <select class="accountPageChangeMonitor form-select" id="MessageList" name="PrivateMessagePrivacy">
                <option value="All">All Users</option>
                <option value="TopFriends">Best Friends</option>
                <option selected="selected" value="Friends">Friends</option>
                <option value="Noone">No One</option>
              </select>
              <span class="field-validation-valid" data-valmsg-for="PrivateMessagePrivacy" data-valmsg-replace="true"></span> 
            </span>
          </div>
          <div id="FollowSetting" class="SettingSubTitle">
            <span class="form-label priv-label">Who can follow me:</span>
            <span class="InlineSuperSafeDiv">
            <span id="SuperPanel" class="SuperSafePanel" data-js-supersafe-specialstyle="False" style="left: 0px;">
            <img class="SuperSafePrivacyModeImg" src="https://s3.amazonaws.com/images.roblox.com/1e9979bd2ad8c88ee8d1250900ca6358.png" alt="" style="">
            </span>
            </span>
            <select class="accountPageChangeMonitor form-select" disabled="disabled" id="FollowList" name="FollowMePrivacy" style="">
              <option selected="selected" value="All">All Users</option>
              <option value="TopFriends">Best Friends</option>
              <option value="Friends">Friends</option>
              <option value="Noone">No One</option>
            </select>
            <div style="position: absolute; top: 0px; left: -5px; width: 2px; height: 23px; z-index: 1000; background-color: rgb(255, 255, 255); opacity: 0;"></div>
          </div>
          <div style="clear: both;">
            <a class="btn-medium btn-neutral updateSettingsBtn btn-update btn-neutral btn-medium" id="UpdateSettingsBtn2">Update<span class="btn-text">Update</span></a>
          </div>
        </div>
      </div>
      <div class="tab-content" id="billing_tab">
        <div id="MembershipSeting">
          <div class="billing-spacer">
            <div id="PendingUnlock" class="SettingSubTitle"></div>
          </div>
          <div class="SettingSubTitle billing-spacer">
            For billing and payment questions: <span class="SL_swap" id="CsEmailLink"><a href="mailto:info@roblox.com">info@roblox.com</a></span>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div id="AccountPageRight">
    <div id="UpgradeAccount" style="margin-left: 10px">
      <h3 style="margin: 10px 0;">
        Upgrade Account
      </h3>
      <div id="buyRobux" class="upgrade-account-button">
        <a href="/upgrades/robux.aspx" class="btn-medium btn-primary">Buy Robux
        <span class="btn-text">Buy Robux</span></a>
      </div>
      <div id="JoinBuildersClub" class="upgrade-account-button">
        <a href="/Upgrades/BuildersClubMemberships.aspx" class="btn-medium btn-primary">
        Join Builders Club
        <span class="btn-text">Join Builders Club</span></a>
      </div>
      <div id="AdvertisementRight">
        <div style="margin-top: 10px">
          <iframe allowtransparency="true" frameborder="0" height="270" scrolling="no" src="/userads/3" width="300" data-js-adtype="iframead" style="display: none !important;"></iframe>
        </div>
      </div>
    </div>
    <div style="clear: both"></div>
  </div>
</div>
<div class="GenericModal modalPopup unifiedModal smallModal" style="display:none;">
  <div class="Title"></div>
  <div class="GenericModalBody">
    <div>
      <div class="ImageContainer">
        <img class="GenericModalImage" alt="generic image">
      </div>
      <div class="Message"></div>
    </div>
    <div class="clear"></div>
    <div id="GenericModalButtonContainer" class="GenericModalButtonContainer">
      <a class="ImageButton btn-neutral btn-large roblox-ok">OK<span class="btn-text">OK</span></a>
    </div>
  </div>
</div>
<style type="text/css">
  #Body  /*Needs to be on the Page to override MasterPage #Body */
  {
  width:970px;
  padding:10px;
  }
</style>
<script type="text/javascript">
  $(function () {
      if (typeof Roblox === "undefined") {
          Roblox = {};
      }
      if (typeof Roblox.ChangeUsername === "undefined") {
          Roblox.ChangeUsername = {};
      }
      //<sl:translate>
      Roblox.AccountResources = {
          addParentEmailText: "Add Parent Email",
          missingParentBodyText: "To update or add your parent\'s email address, please have your parent contact our Customer Service Department at info@roblox.com.",
          okText: "OK",
          cancelText: "Cancel",
          facebookConnectText: "Facebook Connect",
          facebookConnectBodyText: "Your Facebook account has been disconnected."
      };
      Roblox.SignupFormValidator.Resources = {
          doesntMatch: "Doesn't match",
          requiredField: "Required field",
          tooLong: "Too long",
          tooShort: "Too short",
          containsInvalidCharacters: "Contains invalid characters",
          needsFourLetters: "Needs 4 letters",
          needsTwoNumbers: "Needs 2 numbers",
          noSpaces: "No spaces allowed",
          weakKey: "Weak key combination.",
          invalidName: "Can't be your character name",
          alreadyTaken: "Already taken",
          cantBeUsed: "Can't be used",
          password: "password"
      };
      Roblox.ChangeUsername.Resources = {
          insufficientFundsTitle: "Insufficient Funds",
          insufficientFundsText: "You need {0} more to change your username.",
          insufficientFundsAcceptText: "Buy Robux",
          insufficientFundsFooter: "or " + "<a href='/My/Money.aspx?tab=TradeCurrency' style='font-weight:bold'>Trade Currency</a>",
          emailVerifiedTitle: "Verified Email Required",
          emailVerifiedMessage: "You must verify your email before you can change your username.",
          verify: "Verify",
          changeUsernameTitle: "Change Username",
          proceedToBuyText: "Buy for R$ 1,000",
          confirmUsernameChangeText: 'Would you like to change your username to {0} for <span class="robux notranslate">1,000</span>?',
          passwordRequiredText: "Please enter your current password.",
          unknownErrorText: "An unknown error occurred.",
          newUsernameFieldLabel: "Desired Username:",
          newUsernameHintText: "3-20 letters & numbers",
          passwordLabel: "Password:",
          warningText: "IMPORTANT: <ul><li>Original account creation date and forum post count will carry over to your new username.</li><li>Previous forum posts will appear under your old username and will NOT carry over to your new username.</li></ul>",
          processingText: "Processing...",
          processIndicatorImageUrl: "https://s3.amazonaws.com/images.roblox.com/ec4e85b0c4396cf753a06fade0a8d8af.gif",
          confirmUsernameChangeFooterText: "Your balance after this transaction will be {0}.",
          confirmUsernameChangeAccept: "Buy Now",
          usernameChangedText: "Congratulations, {0}! Your username has been changed.",
          usernameChangeErrorTitle: "Username Change Error",
          usernameChangeErrorText: "There was an error changing your username: "
      };
  
      Roblox.ChangeUsername.initializeStrings();
      Roblox.ChangeUsername.initializeChangeUsernameButton();
      //</sl:translate>
          if ($("#FacebookDisconnectModal").length > 0) {
      
      Roblox.GenericConfirmation.open({
              titleText: Roblox.AccountResources.facebookConnectText,
              bodyContent: Roblox.AccountResources.facebookConnectBodyText,
              acceptText: Roblox.AccountResources.okText,
              declineColor: Roblox.GenericConfirmation.none,
              dismissable: false
          });
  
      }
  });
</script>
<div class="ConfirmationModal modalPopup unifiedModal smallModal" data-modal-handle="confirmation" style="display:none;">
    <a class="genericmodal-close ImageButton closeBtnCircle_20h"></a>
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div class="TopBody">
            <div class="ImageContainer roblox-item-image" data-image-size="small" data-no-overlays="" data-no-click="">
                <img class="GenericModalImage" alt="generic image">
            </div>
            <div class="Message"></div>
        </div>
        <div class="ConfirmationModalButtonContainer">
            <a href="" roblox-confirm-btn=""><span></span></a>
            <a href="" roblox-decline-btn=""><span></span></a>
        </div>
        <div class="ConfirmationModalFooter">
        
        </div>  
    </div>  
    <script type="text/javascript">
        var Roblox = Roblox || {};
        Roblox.GenericConfirmation = Roblox.GenericConfirmation || {};
        
        //<sl:translate>
        Roblox.GenericConfirmation.Resources = { yes: "Yes", No: "No" };
        //</sl:translate>
    </script>
</div>
<div style="clear:both"></div>
  </div></div></div>
</div>
<?= SiteFooter::render() ?>
</body>
</html>
