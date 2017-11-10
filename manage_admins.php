<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");
include "static/includes/layouts/open.php";
?>

<div class="main">
	<div class="page row  teal lighten-5">
	<table>
    <?php
    $res = display_admins();
    if($res){
        while($admin = mysqli_fetch_assoc($res)){
          echo "<tr><td style='width=30px'>".$admin["username"]."</td>";
          echo "<td style='width=10px'><a href='edit_admin.php?admin=".$admin["ID"]."'><i class='material-icons'>edit</i></a></td>";
					//<a href="delete_subject.php?subject=<?php echo urlencode($a['id'])" onclick="return confirm('Are you Sure?'); "> Delete this Subject</a>
          echo "<td style='width=10px'><a href='delete_admin.php?admin=".$admin["ID"]."' onclick=\"return confirm('are you sure?'); \"><i class='material-icons red-text'>delete</i></a></td></tr>";
        }
    }
    ?></table>
	</div>
	<a href="new_admin.php">Add new Admin</a>
</div>


<?php
include "static/includes/layouts/close.php";
?>
