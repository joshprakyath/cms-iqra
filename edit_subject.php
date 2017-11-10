<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");

require_once("static/includes/validation_functions.php");



if(isset($_POST['submit'])){

  $required_fields = array("menu_name","position","visible");
  validate_presences($required_fields);
  $fields_with_max_lengths = array("menu_name" => 30);
  validate_max_lengths($fields_with_max_lengths);

  if (empty($errors)){

    $id = $_SESSION["ID"];
    $menu_name = $_POST["menu_name"];
    $position = (int) $_POST["position"];
    $visible = (int) $_POST["visible"];
    $menu_name = mysqli_real_escape_string($conn,$menu_name);
    //UPDATE subjects SET menu_name = 'rashtreeyam',position = 1,visible = 1 WHERE id = 1;
    $query = "UPDATE subjects SET menu_name = '".$menu_name."', position = ".$position.", visible = ".$visible." WHERE ID = ".$id." LIMIT 1";
    $result = mysqli_query($conn,$query);
    if($result && mysqli_affected_rows($conn) >= 0){
      $_SESSION["message"] = "Subject Updated!";
      redirect_to("manage_content.php");
    }
    else{
      $message = "Subject Updation Failed!";
    }
  }
  else{

  }

}








if(isset($_GET["subject"])){
	$selected_subject_id = $_GET["subject"];
	if(!is_numeric($selected_subject_id)){
    redirect_to("manage_content.php");
  }
  $selected_subject_id = mysqli_real_escape_string($conn,$selected_subject_id);
  $query = "SELECT * FROM subjects WHERE ID = {$selected_subject_id} LIMIT 1";
  $result = mysqli_query($conn,$query);
  if( (!$result) || mysqli_num_rows($result) < 1){
      redirect_to("manage_content.php");
  }
  $a = mysqli_fetch_assoc($result);
  $_SESSION["ID"] = $a["ID"];

}
else{
	redirect_to("manage_content.php");
}



include "static/includes/layouts/open.php";
?>

<div class="main">
<p> Edit Subject</p>

	<div class="page row  teal lighten-5">

        <form action="edit_subject.php?subject=<?php echo urlencode($a["ID"])?>" method="post">
		<div class="col s4">
			<div class="input-field">
				<input type="text" name="menu_name" value="<?php echo htmlentities($a["menu_name"]);?>" />
				<label for="menu_name">Subject Name</label>
			</div>
          <div>
			<p>Position:
              <select name="position" class="browser-default">
                <?php
                  $subject_set = get_all_subjects();
                  $subject_count = mysqli_num_rows($subject_set);
                  for($count=1;$count<= $subject_count;$count++){
                    if($count === intval($a["position"]))
                      echo "<option value='$count' selected='selected'>$count</option>";
                    else
                      echo "<option value='$count'>$count</option>";
                  }
                ?>
              </select>
			  </p>
          </div>
          <div> <p>Visible:
            <input type="radio" name="visible" id="test1" value="0" <?php if($a["visible"] == 0) echo "checked"; ?>>
			<label for="test1">No</label>
			&nbsp;
            <input type="radio" name="visible" id="test2" value="1" <?php if($a["visible"] == 1) echo "checked"; ?>>
			<label for="test2">Yes</label>
			</p>
          </div><br><br>
            <div>
			<button class="btn waves-effect waves-light" type="submit" name="submit">Confirm Edit</button>
			</div>
		</div>
        </form>

	</div>
	<a href="manage_content.php">Cancel and go back</a>
        &nbsp; &nbsp;
<a href="delete_subject.php?subject=<?php echo urlencode($a["ID"])?>" onclick="return confirm('Are you Sure?'); "> Delete this Subject</a>
</div>



<?php
include "static/includes/layouts/close.php";
?>
