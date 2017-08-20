<?php 

session_start();

//Make sure that the token POST variable exists.
if(!isset($_GET['token'])){
    throw new Exception('No token found!');
}
 
//It exists, so compare the token we received against the 
//token that we have stored as a session variable.
if(strcasecmp($_GET['token'], $_SESSION['token']) != 0){
    throw new Exception('Token mismatch!');
}

session_destroy();

header('Location:login.php');







