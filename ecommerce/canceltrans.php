<?php
include 'config.php';
if(session_id() == '' || !isset($_SESSION)){session_start();}
if(isset($_SESSION['cart'])) {
  $total = 0;
  foreach($_SESSION['cart'] as $product_id => $quantity) {
    echo $product_id;
    $result = $mysqli->query("SELECT * FROM sales WHERE Item_code='$product_id'");
    if($result){
      if($obj = $result->fetch_object()) {

        $Item_sold= $_SESSION['cart'][$product_id];
        $Quantity= $obj->Quantity + $Item_sold;
         $cost = $obj->Unit_price*$Quantity;
           if($mysqli->query("UPDATE sales set Quantity = '$Quantity' , Price = '$cost' where Item_code = '$product_id'")){
             echo 'sucess';
             
         }
        }
      }
    }  
}
 if(isset($_SESSION['cart'])){
unset($_SESSION['cart']);}
header("location:index.php");
?>
