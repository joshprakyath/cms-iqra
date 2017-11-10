<ul class="subjects">
  <?php
    $nav_context = " ";
    if(isset($_SESSION["username"])){
    	$layout_context = "admin";
    }
    echo $layout_context;
    if($layout_context === 'public'){
      $nav_context = "hide";
    }
    else{
      $layout_context = 'admin';
      $nav_context = "show";
    }

    $result = get_all_subjects();
    while($subject = mysqli_fetch_assoc($result)){
  ?>
    <li>
    <?php if($nav_context == "hide"){ ?>
    <a href="display_all.php?subject=<?php echo urlencode($subject["ID"])?>" class="black-text">
    <?php
    }
    else{ ?>
      <a href="manage_content.php?subject=<?php echo urlencode($subject["ID"])?>" class="black-text">
    <?php } ?>

      <?php
        echo strtoupper(htmlentities($subject["menu_name"]));
      ?> </a>
      <?php
        $result_1  = get_all_pages_for_sub($subject);
      ?>
      <ul class="pages">
        <?php
          while($pages = mysqli_fetch_assoc($result_1)){
          ?>
          <li
          <?php
            if($pages["ID"] == $selected_page_id){
                echo " class='selected pageselected' ";
            }
          ?> >
          <?php if($nav_context == "hide"){ ?>
              <a href = "display_all.php?page=<?php echo urlencode($pages["ID"]) ?>" class="gray-text">
          <?php
            }
            else{ ?>
              <a href = "manage_content.php?page=<?php echo urlencode($pages["ID"]) ?>" class="gray-text">
          <?php } ?>
          <?php echo $pages["menu_item"]; ?></a>
          </li>
          <?php
            }
            mysqli_free_result($result_1);
          ?>

      </ul>
    </li>
	<li><div class="divider"></div></li>
    <?php
    }
    mysqli_free_result($result);
    ?>
</ul>
