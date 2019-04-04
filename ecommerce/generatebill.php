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
    <title>Ecommerce module</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">Sales</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>
    </nav>
    <div class="row" style="margin-top:10px;">
    <h1>Sales</h1>
      <div class="large-12">
        <?php
          {

            $total = 0;
            echo '<table>';
            echo '<tr>';
            echo '<th>Serial no</th>';
            echo '<th>Item name</th>';
            echo '<th>Unit purchased</th>';
            echo '<th>Quantity</th>';
            echo '<th>Price</th>';

            echo '</tr>';
            if(isset($_SESSION['cart'] )){

            foreach($_SESSION['cart'] as $product_id => $quantity) {

            $result = $mysqli->query("SELECT * FROM sales WHERE Item_code='$product_id'");
            if($result){
            if($obj = $result->fetch_object()) {
                $total+=$obj->Unit_price*$quantity;
                echo '<tr>';
                echo '<td>'.$obj->Serial_no.'</td>';
                echo '<td>'.$obj->Item_name.'</td>';
                echo '<td>'.$obj->Unit_price.'</td>';
                echo '<td>'.$quantity.'</td>';
                echo '<td>'.$obj->Unit_price*$quantity.'</td>';
                echo '</tr>';
              }
            }
            }
            echo '<tr>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td><p>Total<p></td>';
            echo '<td>'.$total.'</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td><a href="index.php"><input type="button" value="Back to Sales page"></a></input> </td>';
            echo '</tr>';
            echo '<tr>';
           
          
            echo '</tr>';  
          
          echo '</table>';
          echo '</div>';
          echo '</div>';
        }
    }
        ?>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
