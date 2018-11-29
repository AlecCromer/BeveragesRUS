<?php
$servername = "localhost";
$username = "root";
$password = "";
$myDB = "webstore";



try {
    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
	$customerId = mt_rand(0,1000000);
	$Name = $_POST['Name'];
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];

	$stmt = $conn->prepare("INSERT INTO customer (customerID,customerEmail, customerPassword, customerName) VALUES (:customerID,:Email,:Password,:Name)");
	
	$stmt->bindParam(':customerID', $customerId);
	$stmt->bindParam(':Email', $Email);
	$stmt->bindParam(':Password', $Password);
    $stmt->bindParam(':Name', $Name);



	$stmt->execute();
	$stmt = null;
	$conn = null;
	
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('User Registered Successfully');
    window.location.href='index.php';
    </script>");
    }
	
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	
?>

<html>
<html>
<head>
<meta charset="utf-8">
<title>Beverages R Us.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!--external CSS and Scrolling JS-->
<link rel="stylesheet" href="css/style.css">
<script src=""></script>
<body>
</body>
</html>
