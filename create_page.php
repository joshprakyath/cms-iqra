<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");
include "static/includes/layouts/open.php";




//check if a subject is set or not
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

?>


<div class="main">
<p> Create Page for <?php echo $a["menu_name"]; ?></p>
	<div class="page row  teal lighten-5">
          <?php
            echo message();
          ?>
          <form action="create_page_action.php" method="post">
		    <div class="col s4">
				<div class="input-field">
					<input type="text" name="menu_name" placeholder="eg. health" class="validate"/>
					<label for="menu_name">Page Name</label>
				</div>
				<div>
					<label>Position</label>
					<select name="position" class="browser-default">
					  <?php
						$page_set = get_all_pages_for_sub($a);
						$page_count = mysqli_num_rows($page_set);
						for($count=1;$count< ($page_count + 1);$count++){
						  echo "<option value='$count'>$count</option>";
						}
						echo "<option value='$count' selected='selected'>$count</option>";
					  ?>
					</select>
				</div><br>
				<div>
					<label>Visible</label>
					<input name="visible" type="radio" id="test1" value="1">
					<label for="test1">Yes</label>
					&nbsp;
					<input name="visible" type="radio" id="test2" value="0">
					<label for="test2">No</label>
				</div><br>
				<div class="input-field">
					<textarea id="content" class="materialize-textarea" name="content"></textarea>
					<label for="content">Content</label>
				</div>
				<br><br>


              <input type="hidden" name="ID" value="<?php echo $a["ID"]; ?>">
              <button class="btn" type="submit" name="submit">Create Page</button>
			  </div>
			</form><br>

	</div>
	 <a href="manage_content.php">Cancel and Go back</a>
</div>



<?php
include "static/includes/layouts/close.php";

?>
