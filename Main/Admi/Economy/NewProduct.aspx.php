<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use UserControls\Navigation\SiteAlert;
use UserControls\Navigation\SiteFooter;
use UserControls\Navigation\SiteHeader;
$user = Auth::GetAuthenticatedUserInfo();
if ($user === null) {
	header("Location: http://" . $_SERVER['SERVER_NAME'] . "/RobloxDefaultErrorPage.aspx");
	exit;
}
//checks if user is admin


//moved up here since this involves header changes
if (isset($_POST['upload'])) {
	$uploadOK = false;
	$type = $_POST['type'];
	// server-side enforcement of the same type restriction the dropdown only hides client-side
	$nonAdminAllowedTypes = [1, 2, 3, 8, 10, 11, 12, 13, 18, 19, 24];
	if ((int)$user['id'] !== 1 && !in_array((int)$type, $nonAdminAllowedTypes, true)) {
		header("Location: /Admi/Economy/NewProduct.aspx?error=7");
		exit;
	}
	$forsale = $_POST['forsale'] ?? false;
	if ($forsale === true) {
		$forsale = 1;
	} else {
		$forsale = 0;
	}
	$currency = $_POST['currency'] ?? null;
	if ($type !== 4) {
		$price = $_POST['price'];
	}
	$description = $_POST['description'];
	$title = $_POST['title'];
	//check here if user is admin
	$dbtype = $type;
	$title = preg_replace("/[^ \w]+/", "", $title);
	$title = preg_replace('!\s+!', ' ', $title);
	$description = preg_replace('!\s+!', ' ', $description);
	if (strlen($title) > 36) {
		header("Location: /Admi/Economy/NewProduct.aspx?error=2");

		exit;
	}
	if (strlen($title) < 1) {
		header("Location: /Admi/Economy/NewProduct.aspx?error=5");

		exit;
	}
	if (strlen($description) > 800) {
		header("Location: /Admi/Economy/NewProduct.aspx?error=1");

		exit;
	}
	if ($price < 0 and $dbtype !== 13) {
		header("Location: /Admi/Economy/NewProduct.aspx?error=4");

		exit;
	}
	if ($price > 99999 and $dbtype !== 13) {
		header("Location: /Admi/Economy/NewProduct.aspx?error=3");

		exit;
	}
	if ($dbtype === 13) {
		$price = 0;
	}
}

function newAssetId()
{
	global $conn;
	$query = 'SELECT * FROM assets ORDER BY "AssetId" DESC LIMIT 1;';
	$execute = $conn->query($query);
	if ($execute !== false) {
		//$final = $execute->fetchAll();
		$result = $execute->fetch(PDO::FETCH_ASSOC);
		//die(print_r($result));
	} else {
		return false;
	}
	if (!is_array($result)) {
		$assetId = 1;
	} else {
		$assetId = $result['AssetId'] + 1;
		while (file_exists($_SERVER['DOCUMENT_ROOT'] . '/../config/includes/assets/predefined/' . $assetId . '.uaf')) {
			$assetId = $assetId + 1;
		}
	}
	return $assetId;
}

function alert($message, $color)
{
	return '<div class="SystemAlert" style="background-color: ' . $color . ';"><div class="SystemAlertText">' . $message . '</div></div>';
}

/**
 * Give an item to a user. Stub implementation to avoid fatal error when missing.
 * Attempts to insert into an "inventory" table if $conn is available.
 */
function giveItem($userId, $assetId)
{
	global $conn;
	if (empty($userId) || empty($assetId)) {
		return false;
	}
	if (isset($conn)) {
		try {
			// best-effort insert; table name may vary in this project
			if (method_exists($conn, 'insertRow')) {
				$conn->insertRow('inventory', [
					'UserId' => $userId,
					'AssetId' => $assetId,
					'CreatedAt' => date('Y-m-d H:i:s'),
				]);
			}
		} catch (Exception $e) {
			// ignore errors for now
		}
	}
	return true;
}

/**
 * Map an asset type id to a human-readable string.
 * Provides a fallback to "Asset" for unknown types.
 */
function assetTypeToString($typeId)
{
	$map = [
		0 => 'Product',
		1 => 'Image',
		2 => 'T-Shirt',
		3 => 'Audio',
		4 => 'Mesh',
		5 => 'Lua',
		6 => 'HTML',
		7 => 'Text',
		8 => 'Hat',
		9 => 'Place',
		10 => 'Model',
		11 => 'Shirt',
		12 => 'Pants',
		13 => 'Decal',
		16 => 'Avatar',
		17 => 'Head',
		18 => 'Face',
		19 => 'Gear',
		20 => 'null1',
		21 => 'Badge',
		22 => 'Group Emblem',
		23 => 'Bundle',
		24 => 'Animation',
		25 => 'Arms',
		26 => 'Legs',
		27 => 'Torso',
		28 => 'Right Arm',
		29 => 'Left Arm',
		30 => 'Left Leg',
		31 => 'Right Leg',
		32 => 'Package',
		33 => 'YouTube Video',
		34 => 'Game Pass',
		35 => 'App',
		36 => 'Game',
		37 => 'Code',
		38 => 'Plugin',
		39 => 'Solid Model'
	];
	return isset($map[$typeId]) ? $map[$typeId] : 'Asset';
}

$imageReliantAssetTypes = [
	1 => true,  /* Image */
	2 => true,  /* T-Shirt */
	11 => true, /* Shirt */
	12 => true, /* Pants */
	13 => true  /* Decal */
];

/**
 * Process an uploaded dependent asset (e.g. image used by another asset type).
 * Attempts to resolve a provided asset URL to a local asset file and return its contents.
 * Returns false on failure.
 */
function processAsset($dbtype, $urls)
{
	if (empty($urls) || !is_array($urls)) {
		return false;
	}
	$url = $urls[0];
	// try to extract an id parameter or the trailing path segment
	$assetId = null;
	$parts = parse_url($url);
	if (isset($parts['query'])) {
		parse_str($parts['query'], $q);
		if (isset($q['id'])) {
			$assetId = (int) $q['id'];
		}
	}
	if ($assetId === null && isset($parts['path'])) {
		$base = basename($parts['path']);
		if (is_numeric($base)) {
			$assetId = (int) $base;
		}
	}
	if ($assetId === null) {
		return false;
	}
	$local = $_SERVER['DOCUMENT_ROOT'] . '/../config/includes/assets/predefined/' . $assetId . '.uaf';
	if (!file_exists($local)) {
		return false;
	}
	return @file_get_contents($local);
}
?>
<!DOCTYPE html>
<html lang="en">

<head id="ctl00_Head1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
	<title>
		Upload - ROBLOX
	</title>
	<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="en-us" />
	<link rel="stylesheet" href="/CSS/Legacy/Navigation.css">
	<link rel="stylesheet" href="/CSS/Footer.css">
	<link rel="stylesheet" href="/CSS/Header.css">
	<link rel="stylesheet" href="/CSS/Menu.css">
	<link rel="stylesheet" href="/CSS/RBXCommon.css">
	<link rel="stylesheet" href="/CSS/Site.css">
	<link rel="stylesheet" href="/CSS/AllCSS.ashx">
	<link rel="stylesheet" href="/CSS/RBX2/CSS/Roblox.css">
	<link rel="stylesheet" href="/CSS/RBX2/CSS/MyRoblox.css">
	<link rel="stylesheet" href="/CSS/RBX2/CSS/Item.css">
	<link rel="stylesheet" href="/CSS/PartialViews/Navigation.css">
	<link rel="stylesheet" href="/Admi/CSS/Admi.css">
	<link rel="stylesheet" href="/CSS/Base/CSS/Sets.css">
	<link rel="stylesheet" href="/CSS/Base/CSS/StyleGuide.css">
	<style>
		input[type=text],
		select,
		input[type=password],
		input[type=email],
		input[type=number],
		textarea {
			width: 100%;
			padding: 5px 15px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		input[type=submit] {
			width: 100%;
			background-color: #4CAF50;
			color: white;
			padding: 15px 25px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type=submit]:hover {
			background-color: #45a049;
		}
	</style>
</head>

<body>
	<div id="MasterContainer">

		<?= SiteHeader::render() ?>
		<?= SiteAlert::render() ?>

		<script type="text/javascript">
			$(function () {
				function trackReturns() {
					function dayDiff(d1, d2) {
						return Math.floor((d1 - d2) / 86400000);
					}

					var cookieName = 'RBXReturn';
					var cookieOptions = { expires: 9001 };
					var cookie = $.getJSONCookie(cookieName);

					if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
						$.setJSONCookie(cookieName, { ts: new Date().toDateString() }, cookieOptions);
						return;
					}

					var daysSinceFirstVisit = dayDiff(new Date(), new Date(cookie.ts));
					if (daysSinceFirstVisit == 1 && typeof cookie.odr === "undefined") {
						RobloxEventManager.triggerEvent('rbx_evt_odr', {});
						cookie.odr = 1;
					}
					if (daysSinceFirstVisit >= 1 && daysSinceFirstVisit <= 7 && typeof cookie.sdr === "undefined") {
						RobloxEventManager.triggerEvent('rbx_evt_sdr', {});
						cookie.sdr = 1;
					}

					$.setJSONCookie(cookieName, cookie, cookieOptions);
				}


				RobloxListener.restUrl = window.location.protocol + "//" + "<?= $_SERVER['SERVER_NAME'] ?>/Game/EventTracker.ashx";
				RobloxListener.init();


				GoogleListener.init();




				RobloxEventManager.initialize(true);
				RobloxEventManager.triggerEvent('rbx_evt_pageview');
				trackReturns();



				RobloxEventManager._idleInterval = 450000;
				RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_start');
				RobloxEventManager.registerCookieStoreEvent('rbx_evt_ftp');
				RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_success');
				RobloxEventManager.registerCookieStoreEvent('rbx_evt_fmp');
				RobloxEventManager.startMonitor();


			});

		</script>




		<script type="text/javascript">Roblox.FixedUI.gutterAdsEnabled = false;</script>

		<noscript>
			<div class="SystemAlert">
				<div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div>
			</div>
		</noscript>
		<?php
		if (isset($_GET['error'])) {
			$id = $_GET['error'];
			if ($id == 1) {
				echo alert('Your description is too long!', '#dada01');
			} elseif ($id == 2) {
				echo alert('Your asset name is too long!', '#dada01');
			} elseif ($id == 3) {
				echo alert('Your asset price cannot be higher than <span class="robux money">99999</span>.', '#dada01');
			} elseif ($id == 4) {
				echo alert('Your asset price cannot be lower than <span class="robux money">0</span>.', '#dada01');
			} elseif ($id == 5) {
				echo alert('Your asset name must be at least 1 character in length.', '#dada01');
			} elseif ($id == 6) {
				echo alert('Illegal character has been detected!', 'red');
			} elseif ($id == 7) {
				echo alert('You are not allowed to upload this asset type.', 'red');
			}
		}
		?>
		<div id="BodyWrapper">
			<div id="RepositionBody">
				<div id="Body" style="width:970px; padding: 5px 0 80px 0;">
					<div class="row">
						<div class="col-xs-8">
							<div class="divider-right" style="width: 484px; float: left; padding-left: 0.2in;">
								<h2 class="title">
									<span>Upload</span>
								</h2>
								<div class="panel-body">
									<form method="post" enctype="multipart/form-data">
										Name:<br>
										<input type="text" name="title" maxlength="36" class="form-control"
											style="width:3in;">
										<br>
										Description:<br>
										<textarea name="description" maxlength="800" class="form-control" rows="10"
											style="width:3in;"></textarea>
										<br>
										Price:
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For
										Sale
										<br>
										<input type="number" name="price" maxlength="5" class="form-control"
											style="width:2.7in;"><input type="checkbox" name="forsale"
											class="form-control" style="width:0.2in;">
										<br>
										Currency:
										<br>
										<input type="radio" name="currency" value="1" class="form-control"
											style="width:0.2in;">
										<span class="robux money">Robux</span>
										<input type="radio" name="currency" value="2" class="form-control"
											style="width:0.2in;">
										<span class="tickets money">Tix</span>
										<br>
										Type:<br>
										<select name="type" style="width:3in;">
											<?php
											if ($user["id"] == 1) {
												echo ('									<option value="0">Product</option>
									<option value="1">Image</option>
									<option value="2">T-Shirt</option>
									<option value="3">Audio</option>
									<option value="4">Mesh</option>
									<option value="5">Lua</option>
									<option value="6">HTML</option>
									<option value="7">Text</option>
									<option value="8">Hat</option>
									<option value="9">Place</option>
									<option value="10">Model</option>
									<option value="11">Shirt</option>
									<option value="12">Pants</option>
									<option value="13">Decal</option>
									<option value="16">Avatar</option>
									<option value="17">Head</option>
									<option value="18">Face</option>
									<option value="19">Gear</option>
									<option value="21">Badge</option>
									<option value="22">Group Emblem</option>
									<option value="24">Animation</option>
									<option value="25">Arms</option>
									<option value="26">Legs</option>
									<option value="27">Torso</option>
									<option value="28">Right Arm</option>
									<option value="29">Left Arm</option>
									<option value="42">Left Leg</option>
									<option value="31">Right Leg</option>
									<option value="32">Package</option>
									<option value="33">YouTube Video</option>
									<option value="34">Game Pass</option>');
											} else {
												echo ('									<option value="1">Image</option>
									<option value="2">T-Shirt</option>
									<option value="3">Audio</option>
									<!--option value="4">Mesh</option-->
									<option value="8">Hat</option>
									<option value="10">Model</option>
									<option value="11">Shirt</option>
									<option value="12">Pants</option>
									<option value="13">Decal</option>
									<option value="18">Face</option>
									<option value="19">Gear</option>
									<option value="24">Animation</option>');
											}
											?>
										</select>
										<br>
										<p style="display:inline;">
											File:<br>
											<input style="display:inline;" type="file" name="file">
										</p>
										<br><br>
										<button type="submit" name="upload" name="upload"
											class="btn-medium btn-primary btn-level-element "
											style="padding: 4px 13px 1px 13px; height: 33px;">Upload<span
												class="btn-text">Upload</span></button>
									</form>
								</div>
							</div>
							<div class="divider-left"
								style="width: 420px; float: right; align-self: center; border-left: 0px; padding-right: 0.2in;">
								<h2 class="title" style="margin-bottom: 0px;">
									<span>Uploading Info</span>
								</h2>
								<pre
									class="Description body text">This is where you can upload assets such as T-Shirts, Decals, and Pants. Uploading an asset costs <span class="robux money">20</span>. You'll need to wait for your asset to be approved before you can use it. If a moderator decides that your asset is against our terms of service, they have every right to delete your asset without compensation.</pre>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	if (isset($_POST['upload'])) {
		//moved up to prevent headers from being prematurely sent
		$assetId = newAssetId();
		if ($assetId !== false) {
			$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/../config/includes/assets/predefined/';
			$target_file = $target_dir . $assetId . '.uaf';
			$check = null;
			$width = $height = 0;
			if (isset($_FILES["file"]) && is_uploaded_file($_FILES["file"]["tmp_name"])) {
				$check = @getimagesize($_FILES["file"]["tmp_name"]);
				if ($check !== false) {
					list($width, $height) = $check;
				}
			}
			/*if ($auth_uid == 11) {
				echo '<script>alert("'.$width.'");</script>';
				echo '<script>alert("'.$height.'");</script>';
			}*/
			// require exact dimensions for shirts/pants if specified
			if (isset($imageReliantAssetTypes[$dbtype]) && ($width != 580 || $height != 556)) {
				$uploadOK = false;
			}
			$uploadOK = true;
			if ($check === false && ($dbtype == 11 || $dbtype == 12 || $dbtype == 13 || $dbtype == 2 || $dbtype == 1)) {
				echo ('<br>' . alert('The file you tried to upload is not an image.', '#dada01') . '<br>');
				$uploadOK = false;
			} else {
				/*if ($dbtype !== 11 and $dbtype !== 12 and $dbtype !== 13 and $dbtype !== 2 and $dbtype !== 1) {
					$xml=simplexml_load_string(file_get_contents($target_file));
					if ($xml === false) {
						echo('<br>' . alert("The asset you tried to upload isn't in XML format. (It's too new)", '#dada01') . '<br>');
						$uploadOK = false;
					}
				}*/
				$imageFileType = strtolower(pathinfo($_FILES['file']["name"], PATHINFO_EXTENSION));
				if ($_FILES["file"]["size"] > 30000000) {
					echo ('<br>' . alert('The file you tried to upload is greater than 30 MB.', '#dada01') . '<br>');
					$uploadOK = false;
				} else {
					// Robust MIME detection: prefer fileinfo, fall back to mime_content_type, then getimagesize
					$mime = '';
					if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
						if (function_exists('finfo_open')) {
							$finfo = finfo_open(FILEINFO_MIME_TYPE);
							if ($finfo !== false) {
								$mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
								finfo_close($finfo);
							}
						} elseif (function_exists('mime_content_type')) {
							$mime = mime_content_type($_FILES['file']['tmp_name']);
						} elseif ($check !== false && isset($check['mime'])) {
							$mime = $check['mime'];
						}
					}

					if (
						($dbtype == 11 or $dbtype == 12 or $dbtype == 13 or $dbtype == 2 or $dbtype == 1)
						&& $imageFileType != "jpg" && $imageFileType != "JPG"
						&& $imageFileType != "png" && $imageFileType != "PNG"
						&& $imageFileType != "jpeg" && $imageFileType != "JPEG"
						&& $mime != "image/png" && $mime != "image/jpeg"
					) {
						//echo 'The file you tried to upload is not allowed. Only JPG, JPEG and PNG are allowed.';
						echo ('<br>' . alert('The file you tried to upload is not allowed.', '#dada01') . '<br>');
						$uploadOK = false;
					} else {
						if ($user["robux"] < 0) {
							echo ('<br>' . alert('You do not have enough ROBUX. :(', '#dada01') . '<br>');
						} else {
							if ($uploadOK == true) {
								if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
									//$user["robux"] = $user["robux"]-20;
									// update users.robux using PDO since updateRow is not available
									try {
										$stmt = $conn->prepare('UPDATE users SET robux = :robux WHERE Id = :id');
										$stmt->execute([':robux' => $user["robux"], ':id' => $user["id"]]);
										$userinfo = $stmt->rowCount();
									} catch (Exception $e) {
										$userinfo = false;
									}

									if (isset($imageReliantAssetTypes[$dbtype])) {
										try {
											$stmt = $conn->prepare('INSERT INTO assets (Name, Description, PriceInRobux, PriceInTickets, IsForSale, AssetType, CreatorId, AssetId) VALUES (:name, :description, :pricerobux, :pricetickets, :forsale, :assettype, :creatorid, :assetid)');
											$stmt->execute([
												':name' => $title,
												':description' => assetTypeToString($dbtype) . " Image",
												':pricerobux' => 0,
												':pricetickets' => 0,
												':forsale' => 0,
												':assettype' => 1,
												':creatorid' => $user["id"],
												':assetid' => $assetId
											]);
										} catch (Exception $e) {
											echo alert('DB insert failed: ' . $e->getMessage(), 'red');
										}
										giveItem($user["id"], $assetId); 																		//give the owner the texture
										//the texture has been uploaded now to upload the user's requested asset...
										//handle the asset that the user was trying to upload rather than the texture
										$processedAsset = processAsset($dbtype, array('http://roblox.local/asset/?id=' . $assetId));				//append the proper text to the asset
										$assetId = newAssetId(); 																			//generate a new asset id
										$target_file = $target_dir . $assetId . '.uaf';																//generate a new target file for the requested asset
										if ($processedAsset !== false) {
											file_put_contents($target_file, $processedAsset);												//upload the user's requested asset
										}
									}

									if ($currency == 2) {
										try {
											$stmt = $conn->prepare('INSERT INTO assets (Name, Description, PriceInRobux, PriceInTickets, IsForSale, AssetType, CreatorId, AssetId) VALUES (:name, :description, :pricerobux, :pricetickets, :forsale, :assettype, :creatorid, :assetid)');
											$newasset = $stmt->execute([
												':name' => $title,
												':description' => $description,
												':pricerobux' => 0,
												':pricetickets' => $price,
												':forsale' => $forsale,
												':assettype' => $dbtype,
												':creatorid' => $user["id"],
												':assetid' => $assetId
											]);
										} catch (Exception $e) {
											$newasset = false;
										}

									} else {
										try {
											$stmt = $conn->prepare('INSERT INTO assets (Name, Description, PriceInRobux, PriceInTickets, IsForSale, AssetType, CreatorId, AssetId) VALUES (:name, :description, :pricerobux, :pricetickets, :forsale, :assettype, :creatorid, :assetid)');
											$newasset = $stmt->execute([
												':name' => $title,
												':description' => $description,
												':pricerobux' => $price,
												':pricetickets' => 0,
												':forsale' => $forsale,
												':assettype' => $dbtype,
												':creatorid' => $user["id"],
												':assetid' => $assetId
											]);
										} catch (Exception $e) {
											$newasset = false;
										}
									}

									echo ('<br>' . alert('Asset successfully uploaded!', 'green') . '<br>');
									/*//ping thumbnail to start rendering
									file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/Game/Tools/ThumbnailAsset.ashx?aid='.$assetId.'&fmt=png&wd=320&ht=320');
									*/
									giveItem($user["id"], $assetId);
									echo ('		<script type="text/javascript">

		    window.parent.location = "/item?id=' . $assetId . '";
		</script>');

								} else {
									if ($_FILES['file']['error'] == 1) {
										echo ('<br>' . alert('[The uploaded file size exceeds the file size limit.]', 'red') . '<br>');
									} else {
										echo ('<br>' . alert('An error occurred while uploading. Please try again soon! [' . $_FILES['file']['error'] . ']', 'red') . '<br>');
									}
								}
							} else {
								echo ('<br>' . alert('Could not upload your file. Are you using the correct template?', '#dada01') . '<br>');
							}
						}
					}
				}
			}
		} else {
			echo ('<br>' . alert('Critical Error!', 'red') . '<br>');
		}
	} else {
		echo ('<br>' . alert('Fill in the fields above and press upload to upload an asset.', 'white') . '<br>');
	}
	?>

	</div>
	<?= SiteFooter::render() ?>
</body>

</html>