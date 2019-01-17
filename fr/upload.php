<?
//print_r($_POST);

if($_POST["action"] == "Upload Image")
{
unset($imagename);

if(!isset($_FILES) && isset($HTTP_POST_FILES))
$_FILES = $HTTP_POST_FILES;

if(!isset($_FILES['image_file']))
$error["image_file"] = "An image was not found.";


$imagename = basename($_FILES['image_file']['name']);
//echo $imagename;

if(empty($imagename))
$error["imagename"] = "The name of the image was not found.";

if(empty($error))
{
$newimage = "images/profile/" . $imagename;
//echo $newimage;
$result = @move_uploaded_file($_FILES['image_file']['tmp_name'], $newimage);
if(empty($result))
$error["result"] = "There was an error moving the uploaded file.";
else
header("location:register1.php?al=''&im=$imagename");  
}


}
if($_POST["action"] <> "Upload Image")
$newimage = "images/no_picture_he.gif";
 

?>


<form method="POST" enctype="multipart/form-data" name="image_upload_form" action="<?$_SERVER["PHP_SELF"];?>">
<p><input type="file" name="image_file" size="20"></p>
<p><input type="submit" value="Upload Image" name="action"></p>
</form>
<label>Bild:
	        <input name="Bild" type="image" id="Bild" src="<?php echo" $newimage"; ?>"/>
          </label>

<?
if(is_array($error))
{
while(list($key, $val) = each($error))
{
echo $val;
echo "<br>\n";
}
}
?>
