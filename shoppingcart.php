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
	//prevents people from subtracting more than what they have
	if ((AMOUNT-totalAmount)>0){
		alert("You entered an amount that is greater than what you have in your cart.");
		
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
            //window.alert(data);
			document.location.reload();
        }
    });

		});//jQuery
	}
	//If user enters a number less than 0 or letters
	else{
	}
	}
	
}

function order(){
	
	var address = prompt('What is your address?');
	var ccNum = prompt('What is your credit card number?');
	$(document).ready(function () { //jQuery
	
	$.ajax(
    {
        url: 'finalOrder.php',
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
		$totalPrice +=  $row["amount"]*$row["itemPrice"];
        echo " <td>" . $row["itemName"]. "</td><td id='".$row["itemName"].$row["amount"]."'> " . $row["amount"]. "</td> <td>" . $row["itemPrice"]. "</td><td><button onclick=\"removeFromCart('".$row["amount"]."','".$row["itemId"]."')\" id='".$row["itemName"]."'>Remove from cart</button></td>";
		echo("</tr>");
	}
	echo("</table>");
} else {
    echo "<p>Your shopping cart is empty</p>";
}
$conn->close();
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    }

echo("<p>Your total price is $".$totalPrice."</p>");


?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<div id="paypal-button-container"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
// Render the PayPal button
paypal.Button.render({
// Set your environment
env: 'sandbox', // sandbox | production

// Specify the style of the button
locale: 'en_US',
style: {
 size: 'medium',
 color: 'gold',
 shape: 'pill',
 label: 'checkout',
 tagline: 'true'
},

// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
funding: {
  allowed: [
    paypal.FUNDING.CARD
  ],
  disallowed: []
},

// Enable Pay Now checkout flow (optional)
commit: true,

// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
client: {
  sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
  production: '<insert production client id>'
},

payment: function (data, actions) {
  return actions.payment.create({
    payment: {
      transactions: [
        {
          amount: {
            total: '<?php echo("$totalPrice");?>',
            currency: 'USD'
          }
        }
      ]
    }
  });
},

onAuthorize: function (data, actions) {
  return actions.payment.execute()
    .then(function () {
      window.alert('Payment Complete!');
	  	$(document).ready(function () { //jQuery
	
	$.ajax(
    {
        url: 'orderProcess.php',
        type:'POST',
        dataType: 'text',
        success: function(data)
        {
            window.alert(data);
			document.location.reload();
        }
    });

		});//jQuery
    });
}
}, '#paypal-button-container');
</script>
</body>
</html>