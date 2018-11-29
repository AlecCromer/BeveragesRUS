<!doctype html>
<!-- Final Project,Alexander Cromer , 10/30/2018-->
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

<h1>Welcome to Beverages R Us!</h1>

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
        echo " <td>" . $row["itemName"]. "</td><td> " . $row["itemPrice"]. "</td> <td>" . $row["itemDescription"]. "</td>";
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
<p>Login To Order!</p>
<form id="login" action="order.php" method="POST">
			<input  name="Email" type="text" placeholder="Enter Email"></div>
			<input  name="Password" type="password" placeholder="Enter Password" ></div>
			<button type="sumbit">Submit</button>
			</form>
<p>Don't have an account? Register Here!</p>
<form id="register" action="insert.php" method="POST">
			<input  name="Name" type="text" placeholder="Enter Name"></div>
			<input  name="Email" type="text" placeholder="Enter Email"></div>
			<input  name="Password" type="password" placeholder="Enter Password"></div>
			<button type="sumbit">Submit</button>
		</form>	
</body>
</html>
