<footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We don't have a bio. Care to give one ? Or maybe we are the anonymous :)
		  </p>
		</div>
	  </div>
    </div>
	
    <div class="footer-copyright">
      <div class="container">
      With Love By <a class="brown-text text-lighten-3" href="index.php">iQra</a>
      </div>
    </div>
</footer>

<!--  Scripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
  <script src="static/scripts/init.js"></script>

</body>
</html>
<?php
if(isset($conn)){
  mysqli_close($conn);
}
?>
