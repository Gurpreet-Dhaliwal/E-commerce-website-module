<?php
include 'config.php';
?>
<?php
if(session_id() == '' || !isset($_SESSION))
{session_start();

}
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>File Uplaoder</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">File Uploader</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>
    </nav>

    <div class="row" style="margin-top:10px;">
    <h1>Sales</h1>
      <div class="large-12">

      <form method = "POST" action = "upload.php" id = "form1" enctype= "multipart/form-data">
      <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" >
                <input type = "submit"  value ="upload" name ="upload"  >
       </form>

       <form method = "POST" action = "download.php" id = "form2">
             
                <input type = "submit"  value ="reload" name ="reload"  >
       </form>
              
      
       

     

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
