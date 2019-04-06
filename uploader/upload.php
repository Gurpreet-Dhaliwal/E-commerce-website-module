
<?php
include 'config.php';
if(session_id() == '' || !isset($_SESSION))
{session_start();
 
}
if(isset($_POST["upload"])  && $_FILES['pdf_file']['size']){
$fileUpload= $_FILES["pdf_file"];
$fileName = $_FILES['pdf_file']['name'];
$tmpName  = $_FILES['pdf_file']['tmp_name'];
$fileSize = $_FILES['pdf_file']['size'];
$fileType = $_FILES['pdf_file']['type'];
$fileHandle = fopen($fileUpload["tmp_name"], "r");
$fileUpload_size= $fileUpload["size"];
$fileContent = fread($fileHandle, $fileUpload_size);
$fileContent = addslashes($fileContent);
 $result =$mysqli->query("INSERT INTO filestore (filetext, fname ,fsize , ftype) values ('$fileContent','$fileName','$fileSize','$fileType')");

 if($result){
    $lastid= $_SESSION['id']+=1;
echo "Data Submit Successful";
header('Location:index.php');
}
else{
    echo $mysqli_error($result);
    
echo "Data Submit Error!!";
}

/*
$upload_pdf=$_FILES["pdf_file"]["name"];
move_uploaded_file($_FILES["pdf_file"]["tmp_name"],"uploads/". $_FILES["pdf_file"]["name"]);
$result = $mysqli->query("INSERT INTO filestore (filetext) values ('$upload_pdf')");
if($result){
echo "Data Submit Successful";
$_SESSION['id']++;
}
else{
echo "Data Submit Error!!";
}
*/
header('Location:index.php');

}
?>