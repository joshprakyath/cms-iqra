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
    <form  method="POST" action="new_admin_action.php" name="admins" onsubmit="return validateForm()">
	<div class="col s4">
      <p id="error"></p><br><br>
	  <div class="input-field">
				<input type="text" name="username">&nbsp&nbsp<span id="error1"></span>
				<label for="username">Username</label>
	   </div>
		<div class="input-field">
				<input type="password" name="password" autocomplete="new-password">&nbsp&nbsp<span id="error2"></span>
				<label for="password">Password</label>
	   </div>	   
      <br><br>
      <button class="btn" type="submit" name="submit">Done</button>
	  </div>
    </form>

	</div>
</div>

<script>
  function validateForm(){
      var fields = ["username","password"]
      var flag=0;
      document.getElementById("error1").innerHTML = "";
      document.getElementById("error2").innerHTML = "";
      if (document.forms["admins"][fields[0]].value === "") {
          document.getElementById("error1").innerHTML = "username can't be blank";
          flag=1;
      }
      if (document.forms["admins"][fields[1]].value === "") {
          document.getElementById("error2").innerHTML = "password can't be blank";
          flag=1;
      }
      if(flag === 1){
        return false;
      }
      return true;
  }
</script>
<?php
include "static/includes/layouts/close.php";
?>
