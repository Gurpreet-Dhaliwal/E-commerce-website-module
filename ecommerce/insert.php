<?php
include 'config.php';

//$Serial_no= $_POST["Serial_no"];

if (isset($_POST['add'])) {
$Item_name = $_POST["Item_name"];
$Item_code = $_POST["Item_code"];
$Quantity = $_POST["Quantity"];
$Unit_price = $_POST["Unit_price"];
$cost = $Unit_price*$Quantity;
$result = $mysqli->query("SELECT Item_name , Quantity  FROM sales where Item_code = '$Item_code'");
	if($result->num_rows > 0){
		if($obj = $result->fetch_object()) {
		$quantity= $Quantity + $obj->Quantity;
		if($mysqli->query("UPDATE sales set Item_name = '$Item_name' , Unit_price= '$Unit_price' , Quantity = '$quantity' , Price = '$cost' where Item_code = '$Item_code'")){
			echo 'Data inserted';
			echo '<br/>';
			header ("location:index.php");	
	}}
	}
	else{
		if($mysqli->query("INSERT INTO sales (Item_code, Item_name, Unit_price, Quantity, Price) VALUES('$Item_code', '$Item_name', '$Unit_price', '$Quantity', $cost)")){
			echo 'Data inserted';
			
		}
	header ("location:index.php");	
	}

}

if (isset($_POST['delete'])) {

	if(isset($_POST["Item_code"])){
	$Item_code = $_POST["Item_code"];
	echo $Item_code;

	$result = $mysqli->query("DELETE FROM sales where Item_code = '$Item_code'");
	if($result){
		echo $result;
		echo 'Data Deleted succesfully ';
			
		}
	}
	}
	header ("location:index.php");	

?>
