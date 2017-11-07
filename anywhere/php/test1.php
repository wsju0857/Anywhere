<?php 
include('ip2locationlite.class.php');

//Load the class
$ipLite = new ip2location_lite;
$ipLite->setKey('4368f4d1011ccbd5d987ea043945804018e427de19c514bb444ce89b26b6e801');

//Get errors and locations
$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
$errors = $ipLite->getError();

//Getting the result
echo "<p>\n";
echo "<strong>First result</strong><br />\n";
if (!empty($locations) && is_array($locations)) {
	foreach ($locations as $field => $val) {
		echo $field . ' : ' . $val . "<br />\n";
	}
}
echo "</p>\n";

//Show errors
echo "<p>\n";
echo "<strong>Dump of all errors</strong><br />\n";
if (!empty($errors) && is_array($errors)) {
	foreach ($errors as $error) {
		echo var_dump($error) . "<br /><br />\n";
	}
} else {
	echo "No errors" . "<br />\n";
}
echo "</p>\n";
?>