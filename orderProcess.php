<?php
$servername = "localhost";
$username = "root";
$password = "";
$myDB = "webstore";

session_start();
//userId is already filtered
$userID = $_SESSION['userID'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $conn->prepare("INSERT INTO processorder
SELECT *
FROM shoppingcart
WHERE shoppingcart.userId='".$userID."';

DELETE FROM shoppingcart
WHERE shoppingcart.userId='".$userID."';

COMMIT;");

	$stmt->execute();
	$stmt = null;
	$conn = null;
	
	}catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }