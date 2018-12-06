<!doctype html>
<!-- Final Project,Alexander Cromer , 10/30/2018-->
<html>
<head>
<meta charset="utf-8">
<title>Beverages R Us.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
 <link href="css/bootstrap.css" rel="stylesheet">
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
<p>Our Company is a homegrown drink manufacturer founded by Alec Cromer, Matthew Williams, and Carter Lawrence. Our history? Man do we have history. We so much history it’s ridiculous. We were around for prohibition, we were around for the great depression, and we were around for the Spanish inquisition. Family ties? Man do we have family ties. My grandmother hand juices all of the fruit we use in our drinks; sometimes we even feed her. DRINKS?! OH BOY do we sell drinks. Wait, do we sell drinks</p>
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
<div class="move">
<p>Don't have an account? Register Here!</p>
<form class="padding" id="register" action="insert.php" method="POST">
			<input  name="Name" type="text" placeholder="Enter Name"><br>
			<input  name="Email" type="text" placeholder="Enter Email"><br>
			<input  name="Password" type="password" placeholder="Enter Password"><br>
			<button class="padding" type="sumbit">Submit</button>
		</form>	
		
		<button class="button padding"><a href="login.php">Existing Users Login</a></button>
		</div>
</div>
</div>
</div>
</body>
</html>
