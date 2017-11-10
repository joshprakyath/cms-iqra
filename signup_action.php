<?php
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
require_once("static/includes/dbsetup.php");
if(isset($_POST["submit"])){
   $username1 = mysqli_real_escape_string($conn,$_POST["username_"]);
   $password = mysqli_real_escape_string($conn,$_POST["new_password_"]);
   //$confirm_password = mysqli_real_escape_string($conn,$_POST["confirm_password_"]);
   $password = sha1($password); //ENCRYPTION
   $query_check = "SELECT * FROM admins WHERE username = '".$username1."'";
   $temp = mysqli_query($conn,$query_check);
   if(mysqli_num_rows($temp) != 0){
     redirect_to('signup.php');
   } // TESTED - OK
   $query = "INSERT INTO admins (username,password) VALUES ('{$username1}','{$password}')";
   $result = mysqli_query($conn,$query);
   if($result){
      redirect_to('login.php');
   } else{
     redirect_to('signup.php');
   }
} else{
	redirect_to('signup.php');
}

?>
