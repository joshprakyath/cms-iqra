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
    $id = $_SESSION["ID"];
    $sid = $_POST["ID"];
    $menu_name = $_POST["menu_name"];
    $position = (int) $_POST["position"];
    $visible = (int) $_POST["visible"];
    $content = mysqli_real_escape_string($conn,$_POST["content"]);
    $menu_name = mysqli_real_escape_string($conn,$menu_name);
    //UPDATE subjects SET menu_name = 'rashtreeyam',position = 1,visible = 1 WHERE id = 1;
    $query = "INSERT INTO pages (subject_id,menu_item,position,content,visible) VALUES ({$sid},'{$menu_name}',{$position},'{$content}',{$visible})";
    $result = mysqli_query($conn,$query);
    if($result){
      $_SESSION["message"] = "Page Creation Successful!";
      redirect_to("manage_content.php");
    }
    else{
      $_SESSION["message"] = "Page Creation Failed!";
      redirect_to("create_page.php?subject=".urlencode($_POST["ID"]));
    }
  }
  else{
    redirect_to("create_page.php?subject=".urlencode($_POST["ID"]));
  }
}

if(isset($conn)){
  mysqli_close($conn);
}
?>
