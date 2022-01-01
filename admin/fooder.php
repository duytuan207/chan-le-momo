<?php if ($_SESSION['admin_message'] == true) { ?>
<script>  
	swal({
  title: "<?= $_SESSION['admin_message']; ?>",
  //text: "You clicked the button!",
  icon: "<?php if (empty($_SESSION['success'])) {echo'error';}else{echo'success';} ?>",
  button: "Đã Hiểu!",
});
 
</script>

<?php unset($_SESSION['admin_message']); unset($_SESSION['success']);} ?>	      
   

                    <!-- [ style Customizer ] end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="/admin/files/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/admin/files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="/admin/files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- waves js -->
    <script src="/admin/files/assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="/admin/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- Float Chart js -->
    <script src="/admin/files/assets/pages/chart/float/jquery.flot.js"></script>
    <script src="/admin/files/assets/pages/chart/float/jquery.flot.categories.js"></script>
    <script src="/admin/files/assets/pages/chart/float/curvedLines.js"></script>
    <script src="/admin/files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>
    <!-- amchart js -->
    <script src="/admin/files/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="/admin/files/assets/pages/widget/amchart/serial.js"></script>
    <script src="/admin/files/assets/pages/widget/amchart/light.js"></script>
    <!-- Custom js -->
    <script src="/admin/files/assets/js/pcoded.min.js"></script>
    <script src="/admin/files/assets/js/vertical/vertical-layout.min.js"></script>
    <script type="text/javascript" src="/admin/files/assets/pages/dashboard/custom-dashboard.min.js"></script>
    
    <script type="text/javascript" src="/admin/files/assets/js/script.min.js"></script>
        	<script src="/admin/files/assets/js/jquery.validate.min.js"></script>
</body>


</html>
