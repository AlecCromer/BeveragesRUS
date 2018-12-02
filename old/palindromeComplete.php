<?php
$palindrome = $_POST['palin'];

$palindrome2 = strrev($palindrome);
if($palindrome2 == $palindrome){
	echo("That is a palindrome!");
}else{
	echo("Sorry, that's not a palindrome");
}

?>

