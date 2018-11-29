<!doctype html>
<!-- Final Project,Alexander Cromer , 10/30/2018-->
<html>
<head>
<meta charset="utf-8">
<title>Beverages R Us - Shopping Cart</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!--external CSS and Scrolling JS-->
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript">

function removeFromCart(totalAmount, itemID){
	

	var AMOUNT = prompt('How many would you like to remove?');
	
	alert(AMOUNT);
	alert(totalAmount);
	alert(itemID);
	
	//prevents people from subtracting more than what they have
	if ((AMOUNT-totalAmount)>0){
		alert("Sorry, we don't have enough in stock for that amount.");
		
	}
	else{

	if(AMOUNT>0 && !isNaN(AMOUNT)){
		
		
		$(document).ready(function () { //jQuery
	
	$.ajax(
    {
        url: 'removeitem.php',
        type:'POST',
        dataType: 'text',
        data: {itemID:itemID, amount:AMOUNT, item:totalAmount},
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
		alert("Sorry, that is not a correct amount");
	}
	}
	
}
</script>
<body>

<h1>Welcome to Beverages R Us!</h1>

<p>Here is your shopping cart</p>
<?php
session_start();
$servername = "localhost";
$username = "root";
$passwordDB = "";
$myDB = "webstore";

$userID = $_SESSION['userID'];
$totalPrice = 0;

	
	try {
	
	// Create connection
	$conn = new mysqli($servername, $username, $passwordDB, $myDB);

	$sql = "SELECT items.itemName, shoppingcart.amount, items.itemPrice, items.itemId FROM items, shoppingcart WHERE items.itemId = shoppingcart.itemId AND shoppingcart.userId=".$userID;
	$result = $conn->query($sql);
	
	echo("<table class=\"items\">");
	if ($result->num_rows > 0) {
    // output data of each row
	

    while($row = $result->fetch_assoc()) {
		echo("<tr>");
		$totalPrice +=  $row["amount"];
        echo " <td>" . $row["itemName"]. "</td><td id='".$row["itemName"].$row["amount"]."'> " . $row["amount"]. "</td> <td>" . $row["itemPrice"]. "</td><td><button onclick=\"removeFromCart('".$row["amount"]."','".$row["itemId"]."')\" id='".$row["itemName"]."'>Remove from cart</button></td>";
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

echo("Your total price is $".$totalPrice);


?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

</body>
</html>