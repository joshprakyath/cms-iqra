<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){ // if NO log-in is detected
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");
include "static/includes/layouts/open.php";
?>

<div class="main">
		<h5>Admin Menu</h5>
		<div class="page row  teal lighten-5">
		<p>Welcome to the Admin Area</p>
			<ul>
				<li><a href="manage_content.php" class="tooltipped" data-position="right" data-delay="50" data-tooltip="Let you create , read , update and delete subjects and pages">Manage Website Content</a></li>
				<li><a href="manage_admins.php" class="tooltipped" data-position="right" data-delay="50" data-tooltip="Let you manage various admins of the system">Manage Admins</a></li>
				<li><a href="display_all.php" class="tooltipped" data-position="right" data-delay="50" data-tooltip="See all the visible stuff as displayed to the public">Public Page</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
</div>

<?php
mysqli_free_result($result); // free the memory associated with the result
include "static/includes/layouts/close.php";
?>
