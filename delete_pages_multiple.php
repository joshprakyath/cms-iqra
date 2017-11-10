<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");
?>

<?php

  $page_ids = $_GET["pagelist"];
  if(!$page_ids){
    redirect_to("manage_content.php");
  }
	$sql = "DELETE FROM pages WHERE ID in ";
	$sql.= "('".implode("','",array_values($page_ids))."')";

	$result = mysqli_query($conn,$sql);
	if($result && mysqli_affected_rows($conn) == 1){
		$_SESSION["message"] = "Page deleted!";
		redirect_to($_SERVER['HTTP_REFERER']);
	}
	else{
		$_SESSION["message"] = "Page deletion failed!";
		redirect_to('manage_content.php');
	}


?>
