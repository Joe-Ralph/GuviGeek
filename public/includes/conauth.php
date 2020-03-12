<?php
$mysqli = new mysqli('localhost','joeral','123456' ,'guvi');
if(!$mysqli){
    die("Could not connect".mysqli_error());
}
?>