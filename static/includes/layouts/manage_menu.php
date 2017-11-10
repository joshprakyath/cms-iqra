<ul id="slide-out" class="side-nav">
	<li>
	<div class="userView">            
      <a href="manage_admins.php"><span class="black-text name"><?php echo $usrnm; ?></span></a>
      <span class="black-text email">iqra admin</span>
    </div></li>
	<?php 
		$res = get_all_subjects();
		if(mysqli_num_rows($res) > 0){
	?>
	<li><a class="subheader">Subjects & pages you manage:</a></li>
		<?php include "navigation.php"; ?>
	<?php } else{ ?>
	<li><a class="subheader">No Subjects available yet</a></li>
	<a class='btn' href='create_subject.php'>add a subject</a>
	<?php } ?>
	
</ul>
		<div>
		<p>Hello there! Here you can manage your subjects or pages.</p>
		<p>Let's start : &nbsp;<a class="btn button-collapse" data-activates="slide-out"><i class="material-icons white-text">list</i></a></p>
		<p>Or maybe, add a new subject  : &nbsp; <a href="create_subject.php" class="btn"><i class='material-icons white-text'>add</i></a>
		</div>