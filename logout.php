// REFERENCES www.tutoralrepublic.com and stackoverflow.com.
// for validating and directing users when logging out in

<?php
session_start();
 
// Unset
$_SESSION = array();
 
// Destroy
session_destroy();
 
// Redirect
header("location: login.php");
exit;
?>