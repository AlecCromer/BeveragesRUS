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

<body>

<h1>Welcome to Beverages R Us!</h1>

<p>Here is our list of beverages that we offer.</p>
<?php
session_start();
$servername = "localhost";
$username = "root";
$passwordDB = "";
$myDB = "webstore";
if(isset($_POST['Email']) && isset($_POST['Password'])){
	$_SESSION['Email'] = $_POST['Email'];
	$_SESSION['Password'] = $_POST['Password'];

}

if(isset($_SESSION['Email']) && isset($_SESSION['Password'])){
try {
    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $passwordDB);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//users submitted email and password
	$Email = $_SESSION['Email'];
	$userPassword = $_SESSION['Password'];
	//retrieves user info
	$stmt = $conn->prepare("SELECT * FROM customer WHERE customerEmail = :Email AND customerPassword = :Password LIMIT 1");
	
	$stmt->bindParam(':Email', $Email);
	$stmt->bindParam(':Password', $userPassword);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
if( ! $row)
{
	echo("<SCRIPT>alert('Sorry that user does not exist')</SCRIPT>");
	echo("<p><a href='index.php'>Return to main menu</a></p>");
	die();
}
	if($stmt->execute()){
		//all of the users' information is available here
	$userRow = $stmt->fetch();
	
	$_SESSION['userID'] = $userRow[0];
	$_SESSION['userEmail'] = $userRow[1];
	$_SESSION['userPassword'] = $userRow[2];
	$_SESSION['userName'] = $userRow[3];
	$_SESSION['admin'] = $userRow[4];
	$stmt = null;
	$conn = null;
	echo("Welcome ".$_SESSION['userName']);
	try {
	
	// Create connection
	$conn = new mysqli($servername, $username, $passwordDB, $myDB);
	$sql = "SELECT * FROM items";
	$result = $conn->query($sql);
	
	echo("<table class=\"items\">");
	if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		echo("<tr id=\"".$row["itemId"]."\">");
        echo " <td>" . $row["itemName"]. "</td><td>$" . $row["itemPrice"]. "</td> <td>" . $row["itemDescription"]. "</td><td id='".$row["itemId"]."amount'>".$row['amount']."</td>";
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
	}else{
		echo("something went wrong");
	}
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
}
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
var elements= document.getElementsByTagName('tr');
for(var i=0; i<elements.length;i++) //for loop
{
(elements)[i].addEventListener("click", function(){ //event listener
	var id=this.id;
	var AMOUNT = prompt('How many of this item do you want');
	var itemamount = document.getElementById(id+'amount').innerText;
	//prevents people from adding more than the amount remaining
	if ((itemamount-AMOUNT)<0){
		alert("Sorry, we don't have enough in stock for that amount.");
		
	}else{
	if(AMOUNT>0 && !isNaN(AMOUNT)){
		$(document).ready(function () { //jQuery
	
	$.ajax(
    {
        url: 'additem.php',
        type:'POST',
        dataType: 'text',
        data: {itemid:id, amount:AMOUNT, item:itemamount},
        success: function(data)
        {
            window.alert(data);
			document.location.reload();
        }
    });
		});//jQuery
	
	}
	//If user enters a number less than 0 or letters
	else{
	}
	}
	
	
}); //eventlistener
} //forloop
</script>
<p> <a href="shoppingcart.php">Check your shopping cart here</a></p>

<?php
	if($_SESSION['admin'] == "a"){
		echo("
		<form action=\"entry.php\" method=\"POST\">
			<input  name=\"itemID\" type=\"number\" placeholder=\"Enter item ID\" required><br>
			<input  name=\"Name\" type=\"text\" placeholder=\"Enter Name\" required><br>
			<input  name=\"Description\" type=\"text\" placeholder=\"Enter Description\" required><br>
			<input  name=\"itemPrice\" type=\"number\" placeholder=\"Enter item price\" required><br>
			<input  name=\"amount\" type=\"number\" placeholder=\"Enter amount in stock\" required><br>
			<button type=\"sumbit\">Submit</button>
		</form>");
		echo("
		<form action=\"entry.php\" method=\"POST\">
			<input  name=\"itemID\" type=\"text\" placeholder=\"Enter item ID\" required><br>
			<input  name=\"amount\" type=\"text\" placeholder=\"Enter amount in stock\" required><br>
			<button type=\"sumbit\">Submit</button>
		</form>");	
	}

	
	?>

</body>
</html>