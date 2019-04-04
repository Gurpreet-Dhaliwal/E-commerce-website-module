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
            echo '<th>Item code</th>';
            echo '<th>Item name</th>';
            echo '<th>Unit price</th>';
            echo '<th>Quantity</th>';
            echo '<th>Price</th>';
            echo '<th>Enter number of item to be sold</th>';
            echo '<th></th>';
            if(isset($_SESSION['cart'])){
            echo '<th>Items sold</th>';}
            echo '</tr>';
            $result = $mysqli->query("SELECT Serial_no, Item_code, Item_name, Unit_price, Quantity,Price FROM sales");
            if($result){

              while($obj = $result->fetch_object()) {
               

                echo '<tr>';
                echo '<td>'.$obj->Serial_no.'</td>';
                echo '<td>'.$obj->Item_code.'</td>';
                echo '<td>'.$obj->Item_name.'</td>';
                echo '<td>'.$obj->Unit_price.'</td>';
                echo '<td>'.$obj->Quantity.'</td>';
                echo '<td>'.$obj->Price.'</td>';
                echo '<form method = "POST" action = "updatecart.php" id = "form2">';
                echo '<td><input type="number" name="Item_sold" >  <input type="hidden" name="Item_code" value='.$obj->Item_code.'></td>';
                echo '<td><input type = "submit"  value ="sell"  ></td>';
                echo '</form>';
                if(isset($_SESSION['cart'][$obj->Item_code])){
                echo '<td>'.$_SESSION['cart'][$obj->Item_code].'</td>';
              }

                echo '</tr>';
              }
            }
            echo '<tr>';
            echo '</tr>';

            echo '<tr>';
            echo '</tr>';
            echo '<tr>';
            echo '</tr>';


            echo '<form action="insert.php" method="POST" id="form1">';
            echo '<tr>';
            echo '<td><input type="text" name="Serial_no" disabled></td>';
            echo '<td><input type="text" name="Item_code"></td>';
            echo '<td><input type="text" name="Item_name"></td>';
            echo '<td><input type="number" name="Unit_price"></td>';
            echo '<td><input type="number" name="Quantity"></td>';
            echo '<td><input type="number" name="cost" disabled></td>';
            echo '</tr>';
            echo '<tr>';
            echo '</tr>';
            echo '<tr>';
            echo '<td><input type="submit" name="add" value= "Add"> </td>'; 
            echo '<td><input type="submit" name="delete" value= "delete"> </td>'; 
            //echo '<td><a href="delete.php"><input type="button" value="Delete"></a></input> </td>';
            echo '<td><a href="canceltrans.php"><input type="button" value="Cancel"></a></input> </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td><a href="generatebill.php"><input type="button" value="Generate bill" name="bill"></a></input> </td>';
               
          
            echo '</tr>';  
          }
          echo '</table>';
          echo '</div>';
          echo '</div>';
        ?>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
