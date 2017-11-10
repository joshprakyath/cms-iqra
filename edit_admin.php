<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");
require_once("static/includes/validation_functions.php");

if(isset($_POST['submit'])){

    $id = $_SESSION["ID"];
    $username = $_POST["username"];
    $username = mysqli_real_escape_string($conn,$username);
    //UPDATE subjects SET menu_name = 'rashtreeyam',position = 1,visible = 1 WHERE id = 1;
    $query = "UPDATE admins SET username = '".$username."' WHERE ID = ".$id." LIMIT 1";
    $result = mysqli_query($conn,$query);
    if($result && mysqli_affected_rows($conn) >= 0){
      redirect_to("manage_admins.php");
    } else{ // CHECk - FAILED
      $message = "Username already in use. Try Something Unique";
    }

}


if(isset($_GET["admin"])){
	$selected_admin_id = $_GET["admin"];
	if(!is_numeric($selected_admin_id)){
    redirect_to("manage_admins.php");
  }
  $selected_admin_id = mysqli_real_escape_string($conn,$selected_admin_id);
  $query = "SELECT * FROM admins WHERE ID = {$selected_admin_id} LIMIT 1";
  $result = mysqli_query($conn,$query);
  if( (!$result) || mysqli_num_rows($result) < 1){
      redirect_to("manage_admins.php");
  }
  $a = mysqli_fetch_assoc($result);
  $_SESSION["ID"] = $a["ID"];
} else{
	redirect_to("manage_admins.php");
}

include "static/includes/layouts/open.php";
?>

<div class="main">
	<p> Edit Admin Details:</p>
	<div class="page row  teal lighten-5">
          <?php
            if(!empty($message)){
              echo "<div class='message red-text'>".htmlentities($message)."</div><br><br>";
            }
          ?>

  <form action="edit_admin.php?admin=<?php echo urlencode($a["ID"])?>" method="post">
		<div class="col s4">
			<div class="input-field">
				<input type="text" name="username" value="<?php echo htmlentities($a["username"]);?>" />
				<label for="menu_name">Username</label>
			</div>
    	<button type="submit" class="btn" name="submit">Confirm Edit</button>
		</div>
	</form>
        &nbsp; &nbsp;
	</div>
	<a href="manage_admins.php">Cancel and go back</a>
</div>



<?php
include "static/includes/layouts/close.php";
?>
