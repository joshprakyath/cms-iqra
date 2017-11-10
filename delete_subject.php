<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");
?>

<?php
  $current_subject =  find_subject_by_id($_GET["subject"]);
  if(!$current_subject){
    redirect_to("manage_content.php");
  }

  $id = $current_subject["ID"];
  $child_pages = get_all_pages_for_sub($current_subject);
  if(mysqli_num_rows($child_pages) > 0){
    $_SESSION["message"] = "Can't delete a subject with pages";
    redirect_to("manage_content.php?subject={$id}");
  }
  $query = "DELETE FROM subjects WHERE ID = ".$id." LIMIT 1";
  $result = mysqli_query($conn,$query);
  if($result && mysqli_affected_rows($conn) == 1){
    $_SESSION["message"] = "Subject deleted!";
    redirect_to("manage_content.php");
  }
  else{
    $_SESSION["message"] = "Subject deletion failed!";
    redirect_to("manage_content.php?subject = {$id}");
  }
?>
