<?php
$layout_context = 'public';
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(isset($_SESSION["username"])){
	redirect_to('admin.php');
}
require_once("static/includes/dbsetup.php");
include "static/includes/layouts/open.php";

?>


<div class="main">
	<h5>Log In to Iqra</h5>
	<div class="page row  teal lighten-5">                                
	
	<form role="form" name="login" action="login_action.php" method="post" onsubmit="return validateForm();" >
	<div class="col s4">
	
	<div class="input-field">
		<input type="text" name="username_" ><span id="error1"></span>
		<label for="menu_name">Username</label>
	</div>
	<div class="input-field">
		<input type="password" name="password_" autocomplete="new-password"><span id="error2"></span>
		<label for="menu_name">Password</label>
	</div><br><br>
	<button class="btn" type="submit" name="submit">Log In</button>    	
	</div>
	</form>

	</div>
</div>

<script>
  function validateForm(){
      var fields = ["username_","password_"]
      var flag=0;
      document.getElementById("error1").innerHTML = "";
      document.getElementById("error2").innerHTML = "";
      if (document.forms["login"][fields[0]].value === "") {
          document.getElementById("error1").innerHTML = "username can't be blank";
          flag=1;
      }
      if (document.forms["login"][fields[1]].value === "") {
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
