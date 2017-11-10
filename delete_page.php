<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");
?>

<?php
  //$current_page =  find_subject_by_id($_GET["subject"]);
  $page_id = $_GET["page"];
  if(!$page_id){
    redirect_to("manage_content.php");
  }


  $query = "DELETE FROM pages WHERE ID = ".$page_id." LIMIT 1";
  $result = mysqli_query($conn,$query);
  if($result && mysqli_affected_rows($conn) == 1){
    $_SESSION["message"] = "Page deleted!";
    redirect_to("manage_content.php");
  }
  else{
    $_SESSION["message"] = "Page deletion failed!";
    redirect_to("manage_content.php?page = {$page_id}");
  }
?>
