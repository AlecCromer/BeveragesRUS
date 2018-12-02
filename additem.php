<?php

$servername = "localhost";
$username = "root";
$password = "";
$myDB = "webstore";

session_start();

	$userID = $_SESSION['userID'];
	$itemID = $_REQUEST['itemid'];
	$AMOUNT = $_REQUEST['amount'];
	$itemamount = $_REQUEST['item'];
	$n = rand(0, 999999);
try {
    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

	$stmt = $conn->prepare("INSERT INTO shoppingcart (orderId,userId, itemId, amount) VALUES (:orderID,:userID,:itemID,:AMOUNT)");
	
	$stmt->bindParam(':orderID',$n);
	$stmt->bindParam('userID', $userID);
	$stmt->bindParam(':itemID', $itemID);
    $stmt->bindParam(':AMOUNT', $AMOUNT);
	$stmt->execute();
	$stmt = null;
	
	$stmt2 = $conn->prepare("UPDATE items SET amount = amount - :AMOUNTCOLUMN WHERE items.itemId = :itemCOLUMN");
	$stmt2->bindParam(':AMOUNTCOLUMN',$AMOUNT );
	$stmt2->bindParam(':itemCOLUMN', $itemID);
	$stmt2->execute();
	$stmt2 = null;
	$conn = null;
	echo "Product added to shopping cart";
	
}catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>