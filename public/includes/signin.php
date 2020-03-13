<?php
require_once 'conauth.php';

global $mysqli;
$salt = 'GuviGeeks';
$signinJSON = $_POST['signinJSON'];
$signinAssocArray = json_decode($signinJSON,true);
$email = $signinAssocArray['email'];
$password = $signinAssocArray['password'];
$verifyQuery = $mysqli->prepare('SELECT password From auth Where email = ?');

$verifyQuery->bind_param('s', $email);

$verifyQuery->execute();

$result = $verifyQuery->get_result();

if ($result->num_rows === 0) {
    echo 'user email not found';
} else {
    $row = $result->fetch_assoc();
    if ($row['password'] === md5($password.$salt)) {
        session_start();
        $_SESSION['email'] = $email;
        if (isset($_SESSION['email'])) {
            echo 'success';
        }
    } else {
        echo 'Wrong Email or Password';
    }
}

$verifyQuery->close();

?>
