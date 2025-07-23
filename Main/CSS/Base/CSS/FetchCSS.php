<?php
// written by meditext
set_time_limit(120);
$path = $_GET['path'] ?? '';
$bundleFile = __DIR__ . '/bundles.json';

$css_bundle_hashes = [];
if (file_exists($bundleFile)) {
    $css_bundle_hashes = json_decode(file_get_contents($bundleFile), true) ?: [];
}
function extractCssPath($cssContent) {
    if (preg_match('/\\/\\*\\s*(~?\\/[^*]+)\\s*\\*\\//', $cssContent, $matches)) {
        return trim($matches[1]);
    }
    return null;
}
$allowedExtensions = ['css']; // only allow .css since theree is a weird ass bug.

function fetchRemoteCss($cssPath) {
    $cssName = basename($cssPath);
    $urls = [
        "http://www.roblox.com$cssPath",
        "http://web.archive.org/web/0id_/https://www.roblox.com$cssPath"
    ];
    foreach ($urls as $url) {
        $data = @file_get_contents($url);
        if ($data !== false) return $data;
    }
    return false;
}

if (isset($css_bundle_hashes[$path])) {
    $bundlePaths = $css_bundle_hashes[$path];
    $cssContents = '';
    $cssFiles = [];
 
    foreach ($bundlePaths as $cssPath) {
        $ext = strtolower(pathinfo($cssPath, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExtensions)) {
            error_log("Skipped non-CSS file: $cssPath");
            continue;
        }
        if (strpos($cssPath, '~') === 0) {
            $realPath = str_replace('~', $_SERVER['DOCUMENT_ROOT'], $cssPath);
        } elseif (strpos($cssPath, '/') === 0) {
            $realPath = $_SERVER['DOCUMENT_ROOT'] . $cssPath;
        } else {
            $realPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($cssPath, '/');
        }
        $dir = dirname($realPath);
        if (!is_dir($dir)) {
            if (!@mkdir($dir, 0777, true)) {
                echo("// Failed to create directory: $dir");
            }
        }
        if (file_exists($realPath) && is_readable($realPath)) {
            $content = file_get_contents($realPath);
            $cssContents .= "/* ".$cssPath . " */\n". trim($content, "\xEF\xBB\xBF") . "\n";
            $commentPath = extractCssPath($content);
            if ($commentPath) {
                $cssFiles[] = trim($commentPath);
            } else {
                $cssFiles[] = trim($cssPath);
            }
        } else {
            $remoteContent = fetchRemoteCss(str_replace('~', "", $cssPath));
            if ($remoteContent !== false) {
                if (is_writable($dir)) {
                    $result = @file_put_contents($realPath, $remoteContent);
                    if ($result === false) {
                        echo("// Failed to write file: $realPath");
                    }
                } else {
                    echo("// Directory not writable: $dir");
                }
                $cssContents .= $remoteContent . "\n";
                $commentPath = extractCssPath($remoteContent);
                if ($commentPath) {
                    $cssFiles[] = trim($commentPath);
                } else {
                    $cssFiles[] = trim($cssPath);
                }
            } else {
                echo ("// Failed to fetch or read: $cssPath");
                $cssContents .= "/* Failed to load $cssPath on $realPath */\n";
                $cssFiles[] = $cssPath;
            }
        }
    }
    if (!empty($cssFiles)) {
        $fp = fopen($bundleFile, 'c+');
        if ($fp) {
            flock($fp, LOCK_EX);
            rewind($fp);
            $latest = stream_get_contents($fp);
            $latestBundles = $latest ? json_decode($latest, true) : [];
            if (!is_array($latestBundles)) $latestBundles = [];
            $latestBundles[$path] = $cssFiles;
            ftruncate($fp, 0);
            rewind($fp);
            fwrite($fp, json_encode($latestBundles, JSON_PRETTY_PRINT));
            fflush($fp);
            flock($fp, LOCK_UN);
            fclose($fp);
        } else {
            file_put_contents($bundleFile, json_encode([$path => $cssFiles], JSON_PRETTY_PRINT));
        }
    }

    header('Content-Type: text/css');
    
    echo rtrim($cssContents);
    exit;
}

$bundleUrls = [
    "http://www.roblox.com/CSS/Base/CSS/FetchCSS?path=$path",
    "http://web.archive.org/web/0id_/https://www.roblox.com/CSS/Base/CSS/FetchCSS?path=$path"
];
foreach ($bundleUrls as $url) {
    // I HAD SO MUCH PAIN TO FIX THIS, TOOK ME 3 HOURS TO FIX THIS.
    $bundleContent = @file_get_contents($url);
    if ($bundleContent !== false) {
        preg_match_all('/\/\*\s*(~?\/[^\*]+)\s*\*\//', $bundleContent, $matches);
        $cssFiles = array_map('trim', $matches[1] ?? []);
        $cssFiles = array_filter($cssFiles, function($file) use ($allowedExtensions) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            return in_array($ext, $allowedExtensions) && strpos($file, '/CSS/') !== false;
        });

        $fp = fopen($bundleFile, 'c+');
        if ($fp) {
            flock($fp, LOCK_EX);
            rewind($fp);
            $latest = stream_get_contents($fp);
            $latestBundles = $latest ? json_decode($latest, true) : [];
            if (!is_array($latestBundles)) $latestBundles = [];
            if (!isset($latestBundles[$path])) {
                $latestBundles[$path] = $cssFiles;
                ftruncate($fp, 0);
                rewind($fp);
                fwrite($fp, json_encode($latestBundles, JSON_PRETTY_PRINT));
                fflush($fp);
            }
            flock($fp, LOCK_UN);
            fclose($fp);
        } else {
            file_put_contents($bundleFile, json_encode([$path => $cssFiles], JSON_PRETTY_PRINT));
        }

        header('Content-Type: text/css');
        echo $bundleContent;
        exit;
    }
}

echo "// Bundle not found.";
exit;