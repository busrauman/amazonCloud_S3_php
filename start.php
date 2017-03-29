<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
use Aws\S3\S3Client;

 require 'vendor/autoload.php'; 
 $config = require('config.php');
 //s3 nesnesi

// $credentials = new Aws\Credentials\Credentials('AKIAJOZU633XR4XW6DBQ', 'KyQDw1aZ0RU0ibPMJTgq7aiYJ1iIeeqiXaFV+a61');
$s3 = S3Client::factory([
 		'key' => $config['s3']['key'],
 		'secret' => $config['s3']['secret'],
 		 'version' => $config['s3']['version'],
 		 'credentials' => $config['s3']['credentials'],
 		 'region' => $config['s3']['region']
 	]);
$bucket = $s3->listBuckects();

echo $bucket;

?>