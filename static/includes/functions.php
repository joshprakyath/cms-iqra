<?php
  global $layout_context;
  if( !(isset($layout_context)) || ($layout_context==null) ){
    $layout_context = 'public';
  }
  if($layout_context === 'public'){
    $nav_context = "hide";
  } else{
    $layout_context = 'admin';
    $nav_context = "show";
  }

  function redirect_to($new_location){
    header("Location: ".$new_location);
    exit;
  }


  function confirm_query($result_set){
    if(!$result_set){
      die("Database query failed!");
    }
  }

  function get_all_subjects(){
    global $conn,$layout_context,$nav_context;
    if($nav_context === "hide"){ // it's general public - so hide subjects that are NOT visible
      $query = "SELECT * FROM subjects WHERE visible = 1 ORDER BY position ASC";
    } else{
      $query = "SELECT * FROM subjects  ORDER BY position ASC";
    }
    $result = mysqli_query($conn,$query);    
    confirm_query($result);
    return $result;
  }

  function get_all_pages_for_sub($subject){
    global $conn,$layout_context,$nav_context;
    $subject_ = $subject["ID"];
    $subject_ = mysqli_real_escape_string($conn,$subject_);
    if($nav_context == "hide"){
      $query = "SELECT * FROM pages WHERE subject_id = $subject_ AND visible = 1 ORDER BY position ASC";
    } else{
      $query = "SELECT * FROM pages WHERE subject_id = $subject_ ORDER BY position ASC";
    }
    $result_1 = mysqli_query($conn,$query);
    confirm_query($result_1);
    return $result_1;
  }




  function get_content($page_id){
    global $conn;
    $page_id = mysqli_real_escape_string($conn,$page_id);
    $query = "SELECT * FROM pages WHERE ID = $page_id";
    $result = mysqli_query($conn,$query);
    confirm_query($result);
    return $result;
  }

  function find_subject_by_id($subject_id){
    global $conn;
    $subject_id = mysqli_real_escape_string($conn,$subject_id);
    $query = "SELECT * FROM subjects WHERE ID = {$subject_id} LIMIT 1";
    $result = mysqli_query($conn,$query);
    confirm_query($result);
    if($subject = mysqli_fetch_assoc($result)){
        return $subject;
    } else{
      return null;
    }
  }

  //get all the contents - uses get_content & find_subject_by_id methods
  function display_page(){
    global $selected_subject_id, $selected_page_id;
    $current_sub = null;
    if ($selected_subject_id){
      echo "<hr><h5> Manage Subject</h5>";
      $current_sub = find_subject_by_id($selected_subject_id);
      echo "<p>Menu Item: <strong>".htmlentities($current_sub["menu_name"]);
      echo "</strong></p>";
      echo "<p>Position: <strong>".$current_sub["position"]."</strong></p>";
      echo "<p>Visible: <strong>";
      echo $current_sub["visible"] == 1 ? 'yes' : 'no';
      $link = "</strong></p><p><a href='edit_subject.php?subject=".urlencode($selected_subject_id)."' class='white-text btn'><i class='material-icons white-text'>edit</i></a></p>";
      echo $link;
      echo "<br>";
      $pages_for_this_sub = get_all_pages_for_sub($current_sub);
      if(mysqli_num_rows($pages_for_this_sub) > 0){
        echo "<hr>Page(s) under this subject: ";
		echo "<form method='get' action='delete_pages_multiple.php' onsubmit='return checkboxValidation();' >";
        while($pg = mysqli_fetch_assoc($pages_for_this_sub)){
		echo "<p><input type='checkbox' class='checks' id='".$pg["ID"]."' name='pagelist[]' value='".$pg["ID"]."'>";
		echo "<label for='".$pg["ID"]."'><strong><a href='manage_content.php?page=".$pg["ID"]."'>".$pg['menu_item']."</a></strong></label>";
        echo "</p>";
		}
		echo "<button type='submit' class='btn'><i class='material-icons white-text'>delete</i></button>";
		//echo "<p><a href='delete_pages_multiple.php?subject=".urlencode(pagelist)."[]' class='btn'></a></p>";
		echo "</form>";
      }
	  else{
		  echo "<hr>There are no pages under this subject,yet.";
	  }
      echo "<br><p>Add a new page :&nbsp;&nbsp;<a href='create_page.php?subject=".urlencode($selected_subject_id)."' class='btn'><i class='material-icons white-text'>add</i></a></p>";
	  echo "<br><br>";
	  ?>
	  <a href="delete_subject.php?subject=<?php echo urlencode($selected_subject_id) ?>" onclick="return confirm('Are you Sure?'); "> Delete this Subject</a>
	  <?php

    }
    elseif ($selected_page_id){
      echo "<hr><h5> Manage Page </h5>";
      $result = get_content($selected_page_id);
      $a = mysqli_fetch_assoc($result);
      $menu_name = htmlentities($a["menu_item"]);
      echo  "</p><p>Menu Item: <strong>".$menu_name."</strong></p>";
      echo "<p>Position: <strong>".$a["position"]."</strong></p>";
      echo "<p>Visible: <strong>";
      echo $a["visible"] == 1 ? 'yes' : 'no';
      $cont = nl2br(htmlentities($a["content"]));
      echo  "</strong><p>Content:</p><p><strong>".$cont."</strong></p>";
      $link = "</p><p><a href='edit_page.php?page=".urlencode($selected_page_id)."' class='btn'><i class='material-icons white-text'>edit</i></a></p>";
      echo $link;

     }
	else{
		echo "<blockquote>This website led me to think about gravity and stuff.<br> The apple story is just a hoax</blockquote>~Sir Isac Newton";
	}
  }

  function display_page_public(){
    global $selected_subject_id, $selected_page_id;
    $current_sub = null;
    if($selected_subject_id){
      $current_sub = find_subject_by_id($selected_subject_id);
      echo htmlentities($current_sub["menu_name"]);

      //asdasd
      $result_1  = get_all_pages_for_sub($current_sub);
      echo   '<ul class="pages">';
      while($pages = mysqli_fetch_assoc($result_1)){
      echo '<li>';
      echo '<a href = "display_all.php?page='.urlencode($pages["ID"]).'">';
      echo htmlentities($pages["menu_item"]).'</a></li>';
      //mysqli_free_result($result_1);

      }
    }
    elseif ($selected_page_id){
      $result = get_content($selected_page_id);
      $a = mysqli_fetch_assoc($result);
      if($a["visible"] === '0'){
        redirect_to('index.php');
      }
	  echo "<div class='main'>";
      $menu_name = htmlentities($a["menu_item"]);
      echo  "<b><u><p>".$menu_name."</p></u></b>";
      $cont = nl2br(htmlentities($a["content"]));
      echo  "<p>".$cont."</p>";
	  echo "</div>";
     }
  }


  function form_errors($errors = array()){
    $output = "";
    if(!empty($errors)){
      $output = "<div class='error'>Please fix the following errors:";
      $output .= "<ul>";
      foreach($errors as $key => $error){
        $output .= "<li>".htmlentities($error)."</li>";
      }
      $output .= "</ul></div>";
    }
    return $output;
  }


  /*ADMIN*/

  function display_admins(){
    global $conn;
    $query = "SELECT * FROM admins ORDER BY username ASC";
    $res = mysqli_query($conn,$query);
    confirm_query($res);
    return $res;
  }

?>
