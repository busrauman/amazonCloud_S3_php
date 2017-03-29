
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>UPLOAD</title>
</head>
<body>
	<form action="upload.php" method="post" enctype="multipart/form-data" >
		<input type="file" name="file">
		<input type="submit" value="Upload">
	</form>
</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
use Aws\S3\Exception\S3Exception;

require 'start.php';

	/*$name = $file['name'];
	$tmp_name = $file['tmp_name'];
	$extention = explode('.', $name);*/
	//var_dump($extention );
if(isset($_FILES['file'])){

	$file = $_FILES['file'];
	$name = $file['name'];
	$tmp_name = $file['tmp_name'];
	$ex = explode('.', $name);
	//uzantıyı sona ekliyor
	$ex = strtolower(end($ex));
	
	$key = md5(uniqid());
	$tmp_file_name = "{$key}.{$ex}";
	$tmp_file_path = "files/{$tmp_file_name}";


	//var_dump($tmp_file_path);


		//taşıma işlemi
	move_uploaded_file($tmp_name, $tmp_file_path);
	try {
		
			$s3->putObject([
				'Bucket' => $config['s3']['bucket'],
				'Key' => "uploads/{$name}",
				'Body' => fopen($tmp_file_path, 'rb'),
				'ACL' => 'public-read'
				]);

			unlink($tmp_file_path);

	} catch (S3Exception $e) {
		die("Yüklemede bir hata oluştu");
	}
}

	

?>
