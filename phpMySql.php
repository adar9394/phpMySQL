<?php

$mysqli = new mysqli('ip_address', 'your_user', 'your_pass', 'databsename');


if ($mysqli->connect_errno) {

    echo "Sorry, this website is experiencing problems.";

    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    
    exit;
}

function post($request) {
	$sql = "SELECT * FROM person WHERE firstname = $request[0]";
	if (!$result = $mysqli->query($sql)) {

		echo "Sorry, the website is experiencing problems.";

		echo "Error: Our query failed to execute and here is why: \n";
		echo "Query: " . $sql . "\n";
		echo "Errno: " . $mysqli->errno . "\n";
		echo "Error: " . $mysqli->error . "\n";
		exit;
	}

	if ($result->num_rows === 0) {
	
		$sql = "insert into person values ($request[0],$request[1],$request[2],$request[3],$request[4]";
		$mysqli->query($sql)
		exit;
	}else{
		echo "An entry already exists under that name";
	}
}
function get($request) {
	$sql = "SELECT * FROM person WHERE firstname = $request[0]";
	if (!$result = $mysqli->query($sql)) {

		echo "Sorry, the website is experiencing problems.";

		echo "Error: Our query failed to execute and here is why: \n";
		echo "Query: " . $sql . "\n";
		echo "Errno: " . $mysqli->errno . "\n";
		echo "Error: " . $mysqli->error . "\n";
		exit;
	}
	if ($result->num_rows === 0) {
	
		echo "Sorry, that entry does not exist in this database";
		exit;
	}else{
		echo "$result"
		}
	}
	
function put($request, $bucket) {
	$sql = "SELECT * FROM person WHERE firstname = $request[0]";
	$result = $mysqli->query($sql)
	if ($result->num_rows > 0) {
		$sql = "UPDATE person set firstname = $request[0], lastname = $request[1],  age = $request[2], email = $request[3], zipcode = $request[4]";
		
		exit;
}
}
function deleter($request){

$sql = "SELECT * FROM person WHERE firstname = $request[0]";
	if (!$result = $mysqli->query($sql)) {

		echo "Sorry, the website is experiencing problems.";


		echo "Error: Our query failed to execute and here is why: \n";
		echo "Query: " . $sql . "\n";
		echo "Errno: " . $mysqli->errno . "\n";
		echo "Error: " . $mysqli->error . "\n";
		exit;
	}
	if ($result->num_rows === 0) {
	
		echo "Sorry, that entry does not exist in this database"
		exit;
	}else{
		$sql = "delete FROM person WHERE firstname = $request[0]";
		echo "That table was deleted"
		}
	}
}




$result->free();
$mysqli->close();
?>