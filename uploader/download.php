<?php
include 'config.php';
if(session_id() == '' || !isset($_SESSION))
{session_start();
 
}

if(isset($_POST["reload"])){ 
    $lastid= $_SESSION['id'];
    echo $lastid;
    echo "hghg";
    $result =$mysqli->query("SELECT * FROM filestore ");

    if($result){
        echo "gfgf";
 
        if($obj = $result->fetch_object()) {
         echo "gfgf";
            header("Content-length: $obj->fsize");
            header("Content-type: $obj->ftype");
            header("Content-Disposition: attachment; filename=$obj->fname");
            echo $obj->filetext; 
            exit;               
                  }
            }     
        }
     //  header('Location:index.php');
?>