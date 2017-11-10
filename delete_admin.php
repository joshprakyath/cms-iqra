<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");
?>

<?php
  $admin_id = $_GET["admin"];
  if(!$admin_id){
    redirect_to("manage_admins.php");
  }
  $query = "DELETE FROM admins WHERE id = ".$admin_id." LIMIT 1";
  $result = mysqli_query($conn,$query);  
  redirect_to("manage_admins.php");
?>
