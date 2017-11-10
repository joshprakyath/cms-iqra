<?php session_start(); ?>

<?php
function message(){
  if(isset($_SESSION["message"])){
    $html = "<div class='message red-text'>".htmlentities($_SESSION["message"])."</div>";
    $_SESSION["message"] = null;
    return $html;
  }
}
function errors(){
  if(isset($_SESSION["errors"])){
    $errors = $_SESSION["errors"];
    $_SESSION["errors"] = null;
    return $errors;
  }
}
?>
