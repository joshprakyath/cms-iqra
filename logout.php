<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
$layout_context = 'public';
$_SESSION = array();
session_destroy();
if(isset($_COOKIE['username'])){
setcookie('username',null, time() - 3600);
}
redirect_to('login.php');
?>
