<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
} else{
	$usrnm = $_SESSION["username"];
}
require_once("static/includes/dbsetup.php");
include "static/includes/layouts/open.php";

if (isset($_GET["subject"])){ // is user requesting for a subject ?
	$selected_subject_id = $_GET["subject"];
	if(!is_numeric($selected_subject_id)){
    redirect_to("manage_content.php");
  }
	$selected_subject_id = mysqli_real_escape_string($conn,$selected_subject_id);
  $query = "SELECT * FROM subjects WHERE id = {$selected_subject_id} LIMIT 1";
  $result = mysqli_query($conn,$query);
  if( (!$result) || mysqli_num_rows($result) < 1){
      redirect_to("manage_content.php");
  }
	$selected_page_id = null;
}
elseif (isset($_GET["page"])){
	$selected_page_id = $_GET["page"];
	if(!is_numeric($selected_page_id)){
    redirect_to("manage_content.php");
  }
	$selected_page_id = mysqli_real_escape_string($conn,$selected_page_id);
  $query = "SELECT * FROM pages WHERE id = {$selected_page_id} LIMIT 1";
  $result = mysqli_query($conn,$query);
  if( (!$result) || mysqli_num_rows($result) < 1){
      redirect_to("manage_content.php");
  }
	$selected_subject_id = null;
}
else{
	$selected_page_id = null;
	$selected_subject_id = null;
}

?>

<div class="main">
	<?php include "static/includes/layouts/manage_menu.php"; ?>
	<div class="page teal lighten-5">
				<?php
					// echo message();
					display_page();
				 ?>
	</div>
</div>


<?php
include "static/includes/layouts/close.php";
?>
<script>
function checkboxValidation(){
	if($(".checks").is(':checked')){
		var x = confirm('Are you sure?!');
		if(x == false)
			return false;
		else
			return true;
	}
	else{
		alert('Please select a page');
		return false;
	}
}
</script>
