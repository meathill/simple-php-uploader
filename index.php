<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 2018/8/21
 * Time: 上午11:11
 */

use Dotenv\Dotenv;

require './vendor/autoload.php';

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

header('Content-Type: text/plain; charset=utf-8');

$access_key = $_POST['access_key'];
if ($access_key != getenv('ACCESS_KEY')) {
  header('HTTP/1.0 403 Forbidden');

  exit('Wrong access key');
}

try {

  // Undefined | Multiple Files | $_FILES Corruption Attack
  // If this request falls under any of them, treat it invalid.
  if (!isset($_FILES['upfile']['error']) ||
      is_array($_FILES['upfile']['error'])
  ) {
    throw new RuntimeException('Invalid parameters.');
  }

  // Check $_FILES['upfile']['error'] value.
  switch ($_FILES['upfile']['error']) {
    case UPLOAD_ERR_OK:
      break;
    case UPLOAD_ERR_NO_FILE:
      throw new RuntimeException('No file sent.');
    case UPLOAD_ERR_INI_SIZE:
    case UPLOAD_ERR_FORM_SIZE:
      throw new RuntimeException('Exceeded filesize limit.');
    default:
      throw new RuntimeException('Unknown errors.');
  }

  // You should also check filesize here.
  if ($_FILES['upfile']['size'] > getenv('MAX_FILE_SIZE')) {
    throw new RuntimeException('Exceeded filesize limit.');
  }

  // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
  // Check MIME Type by yourself.
  $finfo = new finfo(FILEINFO_MIME_TYPE);
  if (false === $ext = array_search(
      $finfo->file($_FILES['upfile']['tmp_name']),
      [
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
      ],
      true
    )) {
    throw new RuntimeException('Invalid file format.');
  }

  // You should name it uniquely.
  // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
  // On this example, obtain safe unique name from its binary data.
  $folder = $_POST['to'] ? trim($_POST['to']) : date('Ymd-His');
  $folder = getenv('SAVE_TO') . $folder;
  if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
  }
  if (!move_uploaded_file(
    $_FILES['upfile']['tmp_name'],
    sprintf("$folder/%s.%s",
      sha1_file($_FILES['upfile']['tmp_name']),
      $ext
    )
  )) {
    throw new RuntimeException('Failed to move uploaded file.');
  }

  echo 'File is uploaded successfully.';

} catch (RuntimeException $e) {

  echo $e->getMessage();

}
