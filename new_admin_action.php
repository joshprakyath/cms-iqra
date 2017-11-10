<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(!isset($_SESSION["username"])){
	redirect_to('index.php');
}
require_once("static/includes/dbsetup.php");

if(isset($_POST["submit"])){
   $username1 = mysqli_real_escape_string($conn,$_POST["username"]);
   $password = mysqli_real_escape_string($conn,$_POST["password"]);
   $password = sha1($password);
   $query_check = "SELECT * FROM admins WHERE username = '".$username1."'";
   $temp = mysqli_query($conn,$query_check);
   if(mysqli_num_rows($temp) != 0){ // if username already present
     redirect_to('index.php');
   }
   $query = "INSERT INTO admins (username,password) VALUES ('{$username1}','{$password}')";
   $result = mysqli_query($conn,$query);
   if($result){
      redirect_to('manage_admins.php');
   } else{
     redirect_to('new_admin.php');
   }
} else{
	redirect_to('new_admin.php');
} // TESTED - OK WHOLE PAGE

?>
