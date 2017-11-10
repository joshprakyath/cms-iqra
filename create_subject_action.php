 <?php
 require_once("static/includes/sessions.php");
 require_once("static/includes/functions.php");
 if(!isset($_SESSION["username"])){
 	redirect_to('index.php');
 }
 require_once("static/includes/dbsetup.php");
require_once("static/includes/validation_functions.php");



if(isset($_POST['submit'])){
  $menu_name = $_POST["menu_name"];
  $position = (int) $_POST["position"];
  $visible = (int) $_POST["visible"];
  $menu_name = mysqli_real_escape_string($conn,$menu_name);

  $required_fields = array("menu_name","position","visible");
  validate_presences($required_fields);
  $fields_with_max_lengths = array("menu_name" => 30);
  validate_max_lengths($fields_with_max_lengths);

  if (!empty($errors)){
    $_SESSION["errors"] = $errors;
    redirect_to("create_subject.php");
  }

  $query = "INSERT INTO subjects (menu_name,position,visible) VALUES ('{$menu_name}',{$position},{$visible})";
  $result = mysqli_query($conn,$query);
  if($result){
    $_SESSION["message"] = "Subject Creation Successful!";
    redirect_to("manage_content.php");
  }
  else{
    $_SESSION["message"] = "Subject Creation Failed!";
    redirect_to("create_subject.php");
  }
}
else{
  redirect_to('create_subject.php');
}


if(isset($conn)){
  mysqli_close($conn);
}
?>
