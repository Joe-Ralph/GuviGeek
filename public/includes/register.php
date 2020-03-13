<?php

require_once 'conauth.php';

global $mysqli;
$salt = 'GuviGeeks';

$registerJSON = $_POST['registerJSON'];
$registerAssocArray = json_decode($registerJSON,true);

$username = $registerAssocArray['username'];
$password = $registerAssocArray['password'];
$email = $registerAssocArray['email'];
$auth = 1;
// echo $username, $password, $email;

$verifyQuery = $mysqli->prepare('SELECT username From auth Where email = ?');

$verifyQuery->bind_param('s', $email);

$verifyQuery->execute();

$result = $verifyQuery->get_result();

if($result->num_rows === 0){
    
$password = md5($password.$salt);
$insertstmt = $mysqli->prepare(
    'INSERT INTO auth (username,email,password,auth) VALUES (?,?,?,?)'
);

$insertstmt->bind_param('sssi',$username,$email,$password,$auth);


$insertstmt->execute();

if($insertstmt->affected_rows > 0){
    echo "<p class='lead'>User Successfully Created</p><a href='../index.html' class='btn btn-link'>Click Here to Login</a>";
}
else{
    echo "<div class='alert alert-danger' role='alert'>
    Unable to Create User Account!!! The Most Possibe Explanation is DataBase is Down!!!
  </div>";
}
$insertstmt->close();
}
else{
    $row = $result->fetch_assoc();
    echo "<div class='alert alert-danger' role='alert'>
    <p class='lead'>This Email Already Exists with the Username ".$row['username']."</p><a href='../index.html' class='btn btn-link'>Click Here to Login</a>
  </div>";
}

$verifyQuery->close();

?>