<?php

$servername = "localhost";
$username = "root";
$password = "";
$myDB = "webstore";

session_start();

	$userID = $_SESSION['userID'];
	$itemID = $_REQUEST['itemID'];
	//user requested to remove from shoppingcart
	$AMOUNT = $_REQUEST['amount'];
	
	//total amount
	$itemamount = $_REQUEST['item'];
	
	//final amount of product to be updated in the shopping cart
	$finalAmount = $itemamount - $AMOUNT;
	$n = rand(0, 999999);
try {
    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
	if($finalAmount>0){
	
		//update shopping cart
	$stmt = $conn->prepare("update shoppingcart SET amount=:finalAmount WHERE userID = :userID AND itemID =:itemID");
	$stmt->bindParam(':userID', $userID);
	$stmt->bindParam(':itemID', $itemID);
    $stmt->bindParam(':finalAmount', $finalAmount);
	$stmt->execute();
	$stmt = null;
	
	//update main listing
	$stmt2 = $conn->prepare("UPDATE items SET amount = amount + :AMOUNT WHERE items.itemID = :itemID");
	$stmt2->bindParam(':itemID',$itemID);
	$stmt2->bindParam(':AMOUNT', $AMOUNT);
	$stmt2->execute();
	$stmt2 = null;
	$conn = null;
		
		
	}else{
		if($finalAmount<=0){
			$stmt = $conn->prepare("DELETE FROM shoppingcart WHERE userID = :userID AND itemID =:itemID");
	
	$stmt->bindParam(':userID', $userID);
	$stmt->bindParam(':itemID', $itemID);
	$stmt->execute();
	$stmt = null;
	//update main listing
	
	//FIX
	$stmt2 = $conn->prepare("UPDATE items SET amount = amount + :AMOUNT WHERE items.itemID = :itemID");
	$stmt2->bindParam(':$AMOUNT',$AMOUNT);
	$stmt2->bindParam(':itemID', $itemID);
	$stmt2->execute();
	$stmt2 = null;
	$conn = null;
		}
	


		}
	}catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>