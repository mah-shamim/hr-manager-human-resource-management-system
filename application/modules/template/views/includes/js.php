<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script> 
        <!-- bootstrap js -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>  
        <!-- pace js -->
        <script src="<?php echo base_url('assets/js/pace.min.js') ?>" type="text/javascript"></script>  
        <!-- SlimScroll -->
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>  
        <!-- bootstrap timepicker -->
        <script src="<?php echo base_url() ?>assets/js/jquery-ui-sliderAccess.js" type="text/javascript"></script> 
        <script src="<?php echo base_url() ?>assets/js/jquery-ui-timepicker-addon.min.js" type="text/javascript"></script> 
        <!-- select2 js -->
        <script src="<?php echo base_url() ?>assets/js/select2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/sparkline.min.js') ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('assets/js/jquery.counterup.min.js') ?>" type="text/javascript"></script>
        <!-- ChartJs JavaScript -->
        <script src="<?php echo base_url('assets/js/Chart.min.js?v=2.5') ?>" type="text/javascript"></script>
        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url("assets/datatables/js/dataTables.min.js?v=2019") ?>"></script>
        <!-- Table Head Fixer -->
        <script src="<?php echo base_url() ?>assets/js/tableHeadFixer.js" type="text/javascript"></script> 
        <!-- Admin Script -->
        <script src="<?php echo base_url('assets/js/frame.js') ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('assets/js/bootstrap-toggle.min.js') ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url() ?>assets/js/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url() ?>assets/js/custom.js?v=<?php echo date('m').'.'.date('d')?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/datetimepicker.js') ?>" type="text/javascript"></script>
         <script src="<?php echo base_url('assets/js/waypoints.js') ?>" type="text/javascript"></script>


<!-- End Core Plugins -->
 <!-- Start Page Lavel Plugins
        =====================================================================-->
    
        <!-- End Page Lavel Plugins
        =====================================================================-->

<!-- Dashboard js -->
<script src="<?php echo base_url('assets/js/dashboard.js') ?>" type="text/javascript"></script>

<!-- End Theme label Script-->


<!-- Include module Script -->
<?php
    $path = 'application/modules/';
    $map  = directory_map($path);
    if (is_array($map) && sizeof($map) > 0)
    foreach ($map as $key => $value) {
        $js   = str_replace("\\", '/', $path.$key.'assets/js/script.js'); 
        if (file_exists($js)) {
            echo "<script src=".base_url($js)." type=\"text/javascript\"></script>";
        }   
    }   
?>
