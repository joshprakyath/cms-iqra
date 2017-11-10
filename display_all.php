<?php
$layout_context = 'public';
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(isset($_SESSION["username"])){
	$access = "logged_in";
}
require_once("static/includes/dbsetup.php");
include "static/includes/layouts/open.php";

if (isset($_GET["subject"])){
	$selected_subject_id = $_GET["subject"];
	if(!is_numeric($selected_subject_id)){
    redirect_to("index.php");
  }
	$selected_subject_id = mysqli_real_escape_string($conn,$selected_subject_id);
  $query = "SELECT * FROM subjects WHERE ID = {$selected_subject_id} LIMIT 1";
  $result = mysqli_query($conn,$query);
  if( (!$result) || mysqli_num_rows($result) < 1){
      redirect_to("index.php");
  }
	$selected_page_id = null;
}
elseif (isset($_GET["page"])){
	$selected_page_id = $_GET["page"];
	if(!is_numeric($selected_page_id)){
    redirect_to("index.php");
  }
	$selected_page_id = mysqli_real_escape_string($conn,$selected_page_id);
  $query = "SELECT * FROM pages WHERE ID = {$selected_page_id} LIMIT 1";
  $result = mysqli_query($conn,$query);
  if( (!$result) || mysqli_num_rows($result) < 1){
      redirect_to("index.php");
  }
	$selected_subject_id = null;
}
else{
	$selected_page_id = null;
	$selected_subject_id = null;
}

?>


  <div class="container display_all">
  <p> select any topic from below:</p>
  <?php
		include "static/includes/public_navigation.php";
		echo message();
		display_page_public();

	?>
  </div>



<?php
include "static/includes/layouts/close.php";
?>
