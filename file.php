<?php
$conn = new mysqli("localhost","root","","testing");

if(isset($_POST["submit"])){

	if($_FILES['file']['name']){
		$filename = explode('.',$_FILES['file']['name']);
		// print_r($filename);
		if($filename[1] == 'csv'){
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			while($data = fgetcsv($handle)){
				$name = mysqli_real_escape_string($conn, $data[0]);
				$email = mysqli_real_escape_string($conn, $data[1]);
				$sql = $conn->query("INSERT INTO `excel`(`name`, `email`) VALUES ('$name','$email')");
				// print_r($data);
			}
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	
</head>
<body>
	<form action="" method="POST" enctype="multipart/form-data">
		<p>Upload CSV: <input type="file" name="file" class="form-control"></p>
		<p><input type="submit" name="submit" value="Import"></p>
</form>
</body>
</html>