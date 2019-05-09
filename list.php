<?php

$folder = $_GET['id'];
$folder = $folder ? "./uploads/${folder}" : './uploads';
$files = scandir($folder);

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$result = [
  'code' => 0,
  'data' => array_slice($files, 2),
];

echo json_encode($result, 2);