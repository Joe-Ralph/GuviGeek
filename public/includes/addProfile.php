<?php

require_once 'conauth.php';
global $mysqli;
session_start();
$profile = $_POST['profile'];
$email =$_SESSION['email'];
$addProfile = $mysqli->prepare("UPDATE auth set profile=? where email=?");

$addProfile->bind_param('ss',$profile,$email );
$addProfile->execute();

if($addProfile->affected_rows>0){
    echo 'ok';
}else{
    echo 'NOT OK!!!!!';
}
$addProfile->close();

?>
