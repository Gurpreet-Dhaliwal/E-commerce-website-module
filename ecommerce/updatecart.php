<?php
include 'config.php';
if(session_id() == '' || !isset($_SESSION)){session_start();}
$product_id = $_POST['Item_code'];
$Item_sold = $_POST['Item_sold'];
$action = "add";

$result = $mysqli->query("SELECT * FROM sales WHERE Item_code = '$product_id'");
if($result){

  if($obj = $result->fetch_object()) {
    $Quantity= $obj->Quantity - $Item_sold;
    if($Quantity >0){
      $_SESSION['cart'][$product_id]+= $Item_sold;
     
       $cost = $obj->Unit_price*$Quantity;
         if($mysqli->query("UPDATE sales set Quantity = '$Quantity' , Price = '$cost' where Item_code = '$product_id'")){
           echo 'sucess';
    
    }}
  }
}

header("location:index.php");

?>
