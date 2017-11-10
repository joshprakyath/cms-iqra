<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");
include "static/includes/layouts/open.php";
/*
if (isset($_GET["subject"])){
	$selected_subject_id = $_GET["subject"];
	$selected_page_id = null;
}
elseif (isset($_GET["page"])){
	$selected_page_id = $_GET["page"];
	$selected_subject_id = null;
}
else{
	$selected_page_id = null;
	$selected_subject_id = null;
}
*/

?>

<div class="main">	
		<div>				
		<p>Create a new subject easily!</p>		
		</div>	
	
	<div class="page row  teal lighten-5">
          <?php
				echo message();			
          ?>					
          <form action="create_subject_action.php" method="post">
		  <div class="col s4">
		  <div class="input-field">
			<input type="text" name="menu_name" placeholder="eg. health" class="validate"/>			
			<label for="menu_name">Subject Name</label>
		  </div>            
            <div>
				<label>Position</label>
                <select name="position" class="browser-default">
                  <?php
                    $subject_set = get_all_subjects();
                    $subject_count = mysqli_num_rows($subject_set);
                    for($count=1;$count< ($subject_count + 1);$count++){
                      echo "<option value='$count'>$count</option>";
                    }
                    echo "<option value='$count' selected='selected'>$count</option>";
                  ?>
                </select>
				
            </div>            	
			<div>
				<label>Visible</label>
				<input name="visible" type="radio" id="test1" value="1">
				<label for="test1">Yes</label>
				&nbsp;
				<input name="visible" type="radio" id="test2" value="0">
				<label for="test2">No</label>
			</div>
			<br><br>
			<button class="btn waves-effect waves-light" type="submit" name="submit">Create Subject			
			</button>
            			
		  </div>
        </form><br>        		
	</div>
	<a href="manage_content.php">Cancel and Go back</a>
</div>



<?php
include "static/includes/layouts/close.php";
?>
