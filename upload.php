<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

<?php
include ('database.php');
	

?>
<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) 
{
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	$image = basename( $_FILES["fileToUpload"]["name"]);
	$category_id = $_POST['category'];
	
	$query = "INSERT INTO products(category_id, title, description, image, price) 
			VALUES ('$category_id', '$title', '$description', '$image', '$price')";
	if(!mysqli_query($conn, $query))
		{
			die('Error: '.mysqli_error($conn));
		}		
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) 
{
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
else 
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	{
      echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. <a href='admin.php'>Return</a>" ;
    } 
	else 
	{
      echo "Sorry, there was an error uploading your file.";
    }
}
?>

</head>

<body>
</body>
</html>