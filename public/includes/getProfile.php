<?php
session_start();

require_once 'conauth.php';
global $mysqli;
$email = $_SESSION['email'];
$getProfileQuery = $mysqli->prepare('SELECT profile from auth where email=?');

$getProfileQuery->bind_param('s',$email);

$getProfileQuery->execute();

$profileResult = $getProfileQuery->get_result();

if($profileResult->num_rows === 0){
    echo 'not Present';
}else{
    $row = $profileResult->fetch_assoc();
    if($row['profile']){
        $json = $row['profile'];
$array = json_decode($json, true);
 
$result = '<table class="table table-hover"><tbody>';
foreach($array as $key => $value){
	$result = $result.'<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
}

$result = $result.'</tbody></table>';


echo $result;
    }
    else{echo '<div class="alert alert-warning" role="alert">
        You haven\'t added your profile yet
      </div>';}
}














?>