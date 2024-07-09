 <?php 
@session_start(); 
if(!isset($_SESSION['username']) && !isset($_SESSION['user_id'])){
   header('location:../index.php');
 
}
 ?>
    <!-- footer content -->
        <footer>
          <div class="text-center">
            Developed By <a href="https://www.facebook.com/jsmahara0810/" class="text-primary">JANAK MAHARA</a>
            <p class="text-secondary">version 1.0.0.1 </p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
   <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
<script>
  // JavaScript to show loader while page content is loading
  window.addEventListener('load', function() {
    var loader = document.getElementById('loader');
    // Hide loader with a slight delay
    setTimeout(function() {
      loader.style.display = 'none';
    }, 1000); // 50 milliseconds delay
  });
</script>