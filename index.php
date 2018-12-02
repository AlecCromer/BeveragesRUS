<!doctype html>
<!-- Final Project,Alexander Cromer , 10/30/2018-->
<html>
<head>
<meta charset="utf-8">
<title>Beverages R Us.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
 <link href="css/bootstrap.min.css" rel="stylesheet">
<!--external CSS and Scrolling JS-->
<link rel="stylesheet" href="css/style.css">
<script src=""></script>
<body>
<div class="container-fluid">
<div class="header col-12">
<h1>Welcome to Beverages R Us!</h1>
</div>
<div class="row">
<div class="mainlist col-6">
<p>Here is our list of beverages that we offer.</p>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$myDB = "webstore";

try {
	
// Create connection
$conn = new mysqli($servername, $username, $password, $myDB);

$sql = "SELECT * FROM items";
$result = $conn->query($sql);
	echo("<table class=\"items\">");
if ($result->num_rows > 0) {
    // output data of each row
	

    while($row = $result->fetch_assoc()) {
		echo("<tr>");
        echo " <td>" . $row["itemName"]. "</td><td>$" . $row["itemPrice"]. "</td> <td>" . $row["itemDescription"]. "</td>";
		echo("</tr>");
	}
	echo("</table>");
} else {
    echo "0 results";
}
$conn->close();
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    }
?>
</div>
<div class="registration col-4">
<p>Don't have an account? Register Here!</p>
<form id="register" action="insert.php" method="POST">
			<input  name="Name" type="text" placeholder="Enter Name"><br>
			<input  name="Email" type="text" placeholder="Enter Email"><br>
			<input  name="Password" type="password" placeholder="Enter Password"><br>
			<button type="sumbit">Submit</button>
		</form>	
		
		<button class="button"><a href="login.php">Existing Users Login</a></button>
</div>
</div>
</div>
</body>
</html>
