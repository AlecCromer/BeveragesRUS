<?php
$servername = "localhost";
$username = "root";
$password = "";
$myDB = "webstore";


   $itemID = $_POST['itemID'];
   $amount = $_POST['amount'];
try {
if(isset($_POST['Description']) && isset($_POST['itemPrice'])){
    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
	$itemName = $_POST['Name'];
	$Description = $_POST['Description'];
	$itemPrice = $_POST['itemPrice'];

	$stmt = $conn->prepare("INSERT INTO items (itemID, itemName, itemPrice, itemDescription, amount) VALUES (:itemID,:itemName,:itemPrice,:Description,:amount)");
	
	$stmt->bindParam(':itemID', $itemID);
	$stmt->bindParam(':itemName', $itemName);
	$stmt->bindParam(':itemPrice', $itemPrice);
	$stmt->bindParam(':Description', $Description);
    $stmt->bindParam(':amount', $amount);
	$stmt->execute();
	$stmt = null;
	$conn = null;
	
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Item found Successfully');
    window.location.href='order.php';
    </script>");
}else{
    $conn2 = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    // set the PDO error mode to exception
    $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//update main listing
	$stmt2 = $conn2->prepare("UPDATE items SET amount = amount + :AMOUNT WHERE items.itemId = :itemID");
	$stmt2->bindParam(':itemID',$itemID);
	$stmt2->bindParam(':AMOUNT', $amount);
	$stmt2->execute();
		
	$count = $stmt2->rowCount();
if($count !='0'){
			echo ("<script LANGUAGE='JavaScript'>
    window.alert('Successfully updated listing');
    window.location.href='order.php';
    </script>");
	}else{
			echo ("<script LANGUAGE='JavaScript'>
    window.alert('Not a correct item id');
    window.location.href='order.php';
    </script>");
	}
	$stmt2 = null;
	$conn2 = null;

		}
}
	
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>