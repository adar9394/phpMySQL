<?php
// Let's pass in a $_GET variable to our example, in this case
// it's aid for actor_id in our Sakila database. Let's make it
// default to 1, and cast it to an integer as to avoid SQL injection
// and/or related security problems. Handling all of this goes beyond
// the scope of this simple example. Example:
//   http://example.org/script.php?aid=42

// Connecting to and selecting a MySQL database named sakila
// Hostname: 127.0.0.1, username: your_user, password: your_pass, db: sakila
$mysqli = new mysqli('ip_address', 'your_user', 'your_pass', 'databsename');

// Oh no! A connect_errno exists so the connection attempt failed!
if ($mysqli->connect_errno) {

    echo "Sorry, this website is experiencing problems.";

    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    
    exit;
}

// Perform an SQL query
function post($request) {
	$sql = "SELECT * FROM person WHERE firstname = $request[0]";
	if (!$result = $mysqli->query($sql)) {
		// Oh no! The query failed. 
		echo "Sorry, the website is experiencing problems.";

		// Again, do not do this on a public site, but we'll show you how
		// to get the error information
		echo "Error: Our query failed to execute and here is why: \n";
		echo "Query: " . $sql . "\n";
		echo "Errno: " . $mysqli->errno . "\n";
		echo "Error: " . $mysqli->error . "\n";
		exit;
	}

	// Phew, we made it. We know our MySQL connection and query 
	// succeeded, but do we have a result?
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
		// Oh no! The query failed. 
		echo "Sorry, the website is experiencing problems.";

		// Again, do not do this on a public site, but we'll show you how
		// to get the error information
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
		// Oh no! The query failed. 
		echo "Sorry, the website is experiencing problems.";

		// Again, do not do this on a public site, but we'll show you how
		// to get the error information
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

// Now, we know only one result will exist in this example so let's 
// fetch it into an associated array where the array's keys are the 
// table's column names
$actor = $result->fetch_assoc();
echo "Sometimes I see " . $actor['first_name'] . " " . $actor['last_name'] . " on TV.";

// Now, let's fetch five random actors and output their names to a list.
// We'll add less error handling here as you can do that on your own now
$sql = "SELECT actor_id, first_name, last_name FROM actor ORDER BY rand() LIMIT 5";
if (!$result = $mysqli->query($sql)) {
    echo "Sorry, the website is experiencing problems.";
    exit;
}

// Print our 5 random actors in a list, and link to each actor
echo "<ul>\n";
while ($actor = $result->fetch_assoc()) {
    echo "<li><a href='" . $_SERVER['SCRIPT_FILENAME'] . "?aid=" . $actor['actor_id'] . "'>\n";
    echo $actor['first_name'] . ' ' . $actor['last_name'];
    echo "</a></li>\n";
}
echo "</ul>\n";

// The script will automatically free the result and close the MySQL
// connection when it exits, but let's just do it anyways
$result->free();
$mysqli->close();
?>