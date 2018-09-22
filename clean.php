<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 2018/9/22
 * Time: 上午10:34
 */
if (php_sapi_name() !== 'cli') {
  exit('Only in CLI.');
}

$base = 'uploads';
$handle = opendir($base);
if (!$handle) {
  exit('Failed to read dir');
}

while(($entry = readdir($handle)) !== false) {
  if ($entry === '.' || $entry === '..') {
    continue;
  }
  $path = "$base/$entry";
  $date = explode('-', $entry)[0];
  if (time() - strtotime($date) > 86400 * 7) {
    $files = glob("$path/*.*");
    foreach ($files as $file) {
      echo 'Delete file: ' . $file . "\n";
      unlink($file);
    }
    echo 'Delete directory: ' . $path . "\n";
    rmdir($path);
  }
}
