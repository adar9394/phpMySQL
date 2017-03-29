<?php
function post($request, $mysqli) {
  if (isset($request[0]) && isset($request[1])) {
    $username=$request[0];
    $fname=$request[1];
    $lname=$request[2];
    $email=$request[3];
    $zip=$request[4];
    $sql="SELECT id from tbl_users where username='$username'";
    $result = $mysqli->query($sql); echo $mysqli->error;
    if ($result->num_rows > 0) {
      echo "Object already exists!";
      http_response_code(404);
    }
    else {
        $sql = "INSERT into tbl_users (username, firstname, lastname, email, zipcode) VALUES ('$username', '$fname', '$lname','$email','$zip')";
        if ($mysqli->query($sql) === TRUE) {
          echo json_encode(array("username"=>$username,"lastname"=>$lname,"email"=>$email,"zipcode"=>$zip,"action"=>"completed"));
        }
        else { http_response_code(404); echo $mysqli->error; }
    }
  }
  else {
    echo "You need to set both username and firstname";
    http_response_code(404);
  }
}
function deleter($request, $mysqli){
  $username=$request[0];
  $sql="SELECT id from tbl_users where username='$username'";
  $result = $mysqli->query($sql); echo $mysqli->error;
  if ($result->num_rows > 0) {
    $sql = "DELETE from tbl_users where username='$username'";
    $mysqli->query($sql); echo $mysqli->error;
    echo json_encode(array("username"=>$username, "action"=>"deleted"));
  }
  else {
    echo "Object doesn't exist!";
    http_response_code(404);
  }
}

function get($request, $mysqli){
  $username=$request[0];
  $sql="SELECT * from tbl_users where username='$username'";
  $result = $mysqli->query($sql); echo $mysqli->error;
  if ($result->num_rows > 0) {
    $sql = "DELETE from tbl_users where username='$username'";
    $mysqli->query($sql); echo $mysqli->error;
    echo $result;);
  }
  else {
    echo "Object doesn't exist!";
    http_response_code(404);
  }
}


$host='<database ip address>';
$dbuser='<databse username>';
$dbpass='<databse password>';
$db='<db name>';
$mysqli = new mysqli($host, $dbuser, $dbpass, $db);
if ($mysqli->connect_errno) {
  http_response_code(404);
  echo "error connecting";
  exit;
}
$method = $_SERVER['REQUEST_METHOD'];
if (isset($_SERVER['PATH_INFO'])) {
  $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
  switch ($method) {
	case 'GET':
      get($request, $mysqli); break;
    case 'PUT':
      post($request, $mysqli); break;
    case 'POST':
      post($request, $mysqli); break;
    case 'DELETE':
      deleter($request, $mysqli); break;
  }
}
else {
  echo "Nothing here, use http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'/username/firstname to use the API';
}
?>