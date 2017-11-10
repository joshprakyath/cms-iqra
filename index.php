<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
$layout_context = 'public';
require_once("static/includes/sessions.php");
require_once("static/includes/functions.php");
if(isset($_SESSION["username"])){
	$access = "logged_in";
}
require_once("static/includes/dbsetup.php");
include "static/includes/layouts/open.php";

if (isset($_GET["subject"])){
	$selected_subject_id = $_GET["subject"];
	if(!is_numeric($selected_subject_id)){
    redirect_to("index.php");
  }
	$selected_subject_id = mysqli_real_escape_string($conn,$selected_subject_id);
  $query = "SELECT * FROM subjects WHERE id = {$selected_subject_id} LIMIT 1";
  $result = mysqli_query($conn,$query);
  if( (!$result) || mysqli_num_rows($result) < 1){
      redirect_to("index.php");
  }
	$selected_page_id = null;
} // TESTED - OK
elseif (isset($_GET["page"])){
	$selected_page_id = $_GET["page"];
	if(!is_numeric($selected_page_id)){
    redirect_to("index.php");
  }
	$selected_page_id = mysqli_real_escape_string($conn,$selected_page_id);
  $query = "SELECT * FROM pages WHERE id = {$selected_page_id} LIMIT 1";
  $result = mysqli_query($conn,$query);
  if( (!$result) || mysqli_num_rows($result) < 1){
      redirect_to("index.php");
  }
	$selected_subject_id = null;
}
else{
	$selected_page_id = null;
	$selected_subject_id = null;
} 
?>

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center blue-text text-darken-1" style="visibility:hidden;">IQRA</h1>
        <div class="row center">
          <h5 class="header col s12 white-text darken-2">There comes a time when you have to choose between turning the page and closing the book</h5>
        </div>
        <div class="row center">
          <a href="display_all.php" id="download-button" class="btn-large waves-effect waves-light blue lighten-1">Open the book</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="static/images/bg33.jpg" alt="Unsplashed background img 1"></div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Find Interesting Stuff</h5>

            <p class="light">How many times have you felt overwhelmed by the plethora of information out there?! Well, too many times apparently.
			We offer you one thing and that's simplicity. Here you will not find any things that distract you from the stuff
			that you really care about.

			</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Focused</h5>

            <p class="light">We don't put you on a hook and hope that you sit in front of the computer screen or stare at your mobile
			phones for the whole day. We want you to be content, and urges you to give some time to yourself, even if that means less engagement for
			us. That's the user experience we're talking about.
			</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">Half of the world is computer illiterate and we don't want them to be taken aback by the glitter of today's web,
			that sends them in a endless spiral. We want them to feel comfortable.Maybe read too.
			</p>
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">In a good book the best is between the lines.</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="static/images/bg1.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h4>Rekindle that fire</h4>
          <p class="left-align light">There are perhaps no days of our childhood we lived so fully as those we spent with a favorite book.
		  Somewhere between the lines, we lost that touch and kept down that book. We want you to start it all over again. Keep reading.
		  </p>
        </div>
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">A book is a device to ignite the imagination.</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="static/images/bg2.jpg" alt="Unsplashed background img 3"></div>
  </div>


<?php
include "static/includes/layouts/close.php";
?>
