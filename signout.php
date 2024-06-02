<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php
$_SESSION["UserId"]=null;
$_SESSION["email"]=null;
session_destroy();
Redirect_to("./pages/signin.php");
exit();
?>
