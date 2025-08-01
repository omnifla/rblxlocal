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
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Account - <?= $site_properties['Title'] ?></title>
    <link href="/CSS/Accounts/AccountMVC.css" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___93d7b975be9106ab72cfa4deac3a5583_m.css">
    <link href="/CSS/Base/CSS/FetchCSS?path=page___2ad765c3e4926df9c25fa00b92677eed_m.css" rel="stylesheet">
    <link href="/CSS/Pages/Character/Character.css" rel="stylesheet">
    <style>
    .closeBtnCircle_20h { width:20px; height:20px; cursor:pointer; position:absolute; top:5px; left:5px; background:url(/images/Buttons/btn-x.png); }
    </style>
</head>
<body>
<?= SiteHeader::render() ?>
<?= SiteAlert::render() ?>
<div id="MasterContainer">
  <div id="BodyWrapper"><div id="RepositionBody"><div id="Body" style="width:970px">
    <div id="AccountPageContainer">
      <div id="AccountPageLeft" class="divider-right">
        <h1>My Account</h1>
        <div class="tab-container">
          <div class="tab tab-active active" data-id="settings_tab">Settings</div>
          <div class="tab" data-id="privacy_tab">Privacy</div>
          <div class="tab" data-id="billing_tab">Billing</div>
        </div>

        <?php if ($errors): ?>
          <div style="color:red;margin-top:10px;">
            <?php foreach ($errors as $e): ?>
              <div><?=htmlspecialchars($e)?></div>
            <?php endforeach; ?>
          </div>
        <?php elseif ($success): ?>
          <div style="color:green;font-weight:bold;margin-top:10px;">
            Settings updated successfully!
          </div>
        <?php endif; ?>

        <form method="POST">
          <div class="tab-content active" id="settings_tab" style="display:block;">
            <div id="AccountSettings" class="settings-section">

              <div class="SettingSubTitle" id="UsernameSetting">
                <span class="settingLabel form-label">Username:</span>
                <span id="username"><?=htmlspecialchars($user['username']??'Unknown')?></span>
              </div>

              <div id="BirthdaySetting" class="SettingSubTitle">
                <span class="settingLabel form-label">Birthday:</span>
                <select name="BirthMonth"><?php for($i=1;$i<=12;$i++):?><!-- omitted --><?php endfor;?></select>
                <select name="BirthDay"><?php for($i=1;$i<=31;$i++):?><!-- omitted --><?php endfor;?></select>
                <select name="BirthYear"><?php for($i=date('Y');$i>=1914;$i--):?><!-- omitted --><?php endfor;?></select>
              </div>

              <div id="GenderSetting" class="SettingSubTitle">
                <span class="settingLabel form-label">Gender:</span>
                <label><input type="radio" name="gender" value="Male" <?=($user['gender']==1)?'checked':''?>> Male</label>
                <label><input type="radio" name="gender" value="Female" <?=($user['gender']==2)?'checked':''?>> Female</label>
              </div>

              <div id="PersonalBlurbSetting" class="SettingSubTitle">
                <span class="settingLabel form-label">Personal blurb:</span>
                <textarea name="PersonalBlurb" maxlength="255"><?=htmlspecialchars($user['description']??'')?></textarea>
              </div>

              <div style="clear:both;">
                <button type="submit">Update</button>
              </div>
            </div>
          </div>

          <div class="tab-content" id="privacy_tab" style="display:none;">
            <div class="settings-section">
              <?php foreach (['Chat'=>'ChatVisibilityPrivacy','Party'=>'PartyInvitePrivacy','PrivateMessage'=>'PrivateMessagePrivacy','Follow'=>'FollowPrivacy','Inventory'=>'InventoryPrivacy'] as $label => $field): ?>
                <div class="SettingSubTitle">
                  <span class="form-label"><?=$label?>:</span>
                  <select name="<?=$field?>">
                    <?php foreach (['All','TopFriends','Friends','Noone','Disabled'] as $opt): ?>
                      <option value="<?=$opt?>" <?=($user[$field]===$opt)?'selected':''?>><?=$opt?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              <?php endforeach; ?>
              <div style="clear:both;"><button type="submit">Update</button></div>
            </div>
          </div>

          <div class="tab-content" id="billing_tab" style="display:none;">
            <div id="MembershipSeting">
              <div class="billing-spacer"><div id="PendingUnlock" class="SettingSubTitle"></div></div>
              <div class="SettingSubTitle billing-spacer">
                For billing and payment questions:
                <a href="mailto:info@roblox.com">info@roblox.com</a>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div></div></div>
</div>
<?= SiteFooter::render() ?>
</body>
</html>
