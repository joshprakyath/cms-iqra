<ul class="collapsible"  data-collapsible="accordion">

  <?php
    $nav_context = "hide";
    $layout_context === 'public';
    $result = get_all_subjects();

    while($subject = mysqli_fetch_assoc($result)){
      $result_1  = get_all_pages_for_sub($subject);
      if(mysqli_num_rows($result_1) > 0){
  ?>
  <li>
  <div class="collapsible-header"><a href="#"><?php echo htmlentities($subject["menu_name"]); ?> </a>	</div>
  <?php
	while($pag = mysqli_fetch_assoc($result_1)){
  ?>
		<div class="collapsible-body"><p>
		<?php
		echo '<a href = "display_all.php?page='.urlencode($pag["ID"]).'" class="deep-orange-text">'; 
		echo htmlentities($pag["menu_item"]).'</a>';
  ?>
  </p>
  </div>
	<?php } ?>
  </li>
    <?php
	}}
    mysqli_free_result($result);
    ?>
</ul>
