<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('includes/head') ?>
    </head>

    <body class="hold-transition sidebar-mini">
      
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header"> 
                <?php $this->load->view('includes/header') ?>
            </header>

 
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar -->
                <?php $this->load->view('includes/sidebar') ?>
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                
                <?php $gui_p = $this->uri->segment(1);
                if($gui_p != 'gui_pos'){
                ?>    
                <ol class="breadcrumb breadcrumb-new">
                    <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                    <li><a href="#"><?php echo ucwords($module); ?></a></li>
                    <li class="active"><?php echo ucwords(@$title); ?></li>
                </ol>
                <?php }?>


                <!-- Main content -->
                <div class="content">

                    <!-- load messages -->
                    <?php $this->load->view('includes/messages') ?>
                    <div class="se-pre-con"></div>
                    <!-- load custom page -->
                    <?php echo $this->load->view($module.'/'.$page) ?>
                </div> <!-- /.content -->


            </div> <!-- /.content-wrapper -->


            <footer class="main-footer">
                <input type="hidden" name="" id="base_url" value="<?php echo base_url();?>">
                <div class="pull-right hidden-xs">
                    <?php echo (!empty($setting->address)?$setting->address:null) ?> 
                </div>

                <strong>
                    <?php echo (!empty($setting->footer_text)?$setting->footer_text:null) ?>
                </strong>
                    <a href="<?php echo current_url() ?>">
                    <?php echo (!empty($setting->title)?$setting->title:null) ?></a>
            </footer>

            
        </div> <!-- ./wrapper -->
 
        <!-- Start Core Plugins-->
        <?php $this->load->view('includes/js') ?>
        
       
    </body>
</html>
