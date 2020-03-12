<?php 
    session_start();
    unset($_SESSION['email']);
    if(!isset($_SESSION['email'])){
        echo 'ok';
    }
    else{
        echo 'NOT OK!!!!!!';
    }

?>