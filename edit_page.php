<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");
require_once("static/includes/validation_functions.php");



if(isset($_POST['submit'])){
  $required_fields = array("menu_name","position","visible","content");
  validate_presences($required_fields);
  $fields_with_max_lengths = array("menu_name" => 30);
  validate_max_lengths($fields_with_max_lengths);

  if (empty($errors)){
    $id = $_GET["page"];
    $menu_name = $_POST["menu_name"];
    $position = (int) $_POST["position"];
    $visible = (int) $_POST["visible"];
    $content = mysqli_real_escape_string($conn,$_POST["content"]);
    $menu_name = mysqli_real_escape_string($conn,$menu_name);
    //UPDATE subjects SET menu_name = 'rashtreeyam',position = 1,visible = 1 WHERE id = 1;
    $query = "UPDATE pages SET menu_item = '".$menu_name."', position = ".$position.", visible = ".$visible.", content = '".$content."' WHERE id = ".$id." LIMIT 1";
    $result = mysqli_query($conn,$query);
    if($result && mysqli_affected_rows($conn) >= 0){
      $_SESSION["message"] = "Page Updated!";
      redirect_to("manage_content.php");
    }
    else{
      $message = "Page Updation Failed!";
    }
  }
}








if(isset($_GET["page"])){
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
  $a = mysqli_fetch_assoc($result);
  $_SESSION["ID"] = $a["ID"];

}
else{
	redirect_to("manage_content.php");
}



include "static/includes/layouts/open.php";
?>

<div class="main">
<p> Edit Page <?php echo htmlentities($a["menu_item"]); ?> </p>
	<div class="page row  teal lighten-5">
          <?php
            if(!empty($message)){
              echo "<div class='message'>".htmlentities($message)."</div>";
            }
          ?>


        <form action="edit_page.php?page=<?php echo urlencode($a["ID"])?>" method="post">
		<div class="col s4">
			<div class="input-field">
				<input type="text" name="menu_name" value="<?php echo htmlentities($a["menu_item"]);?>" />
				<label for="menu_name">Subject Name </label>
			</div>
          <div>
			<p>Position:
              <select name="position" class="browser-default">
                <?php
                  $subject = find_subject_by_id($a["subject_id"]);
                  $page_set = get_all_pages_for_sub($subject);
                  $page_count = mysqli_num_rows($page_set);
                  for($count=1;$count<= $page_count;$count++){
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
          <div class="input-field">
            <textarea id="content" class="materialize-textarea" name="content" ><?php echo htmlentities($a['content']);?> </textarea>
			<label for="content">Content</label>
		  </div><br><br>
           <button type="submit" name="submit" class="btn">Confirm Edit</button>
		   </div>
        </form>
	</div>
	<a href="manage_content.php">Cancel and go back</a>
        &nbsp; &nbsp;
        <a href="delete_page.php?page=<?php echo urlencode($a["ID"])?>" onclick="return confirm('Are you Sure?'); "> Delete this Page</a>

</div>



<?php
include "static/includes/layouts/close.php";
?>
