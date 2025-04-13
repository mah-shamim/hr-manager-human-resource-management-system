<?php
$CI = & get_instance();
$CI->load->model('Web_settings');
$Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>
<!--its for pos style css start--> 
<style type="text/css">
    BODY, TD
    {
        background-color: #ffffff;
        color: #000000;
        font-family: "Times New Roman", Times, serif;
        font-size: 10pt;
    }

</style>
<!--its for pos style css close--> 
<!-- Printable area start -->
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        // document.body.style.marginTop="-45px";
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<!-- Printable area end -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('accounts') ?></h1>
            <small><?php echo display('customer_receive') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li class="active"><?php echo display('customer_receive') ?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
            ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('error_message');
        }
        ?>
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <div class="panel-body">
                            <div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633' style='margin:0;font-family:Arial,Helvetica,sans-serif;border-bottom:1' >
                                <table border="0" width="100%">
                                    <tr>
                                        <td>

                                            <table border="0" width="100%">
                                                
                                                <tr>
                                                    <td align="center" style="border-bottom:2px #333 solid;">
                                                        {company_info}
                                                        <span style="font-size: 17pt; ">
                                                            {company_name}
                                                        </span><br>
                                                        {address}<br>
                                                        {mobile}<br>
                                                        {/company_info}
                                                        
                                                    </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <td align="center"><?= $customer_info[0]['customer_name'];?><br>
                                                        <?php if ($customer_info[0]['customer_address']) { ?>
                                                            <?= $customer_info[0]['customer_address'];?><br>
                                                        <?php } ?>
                                                        <?php if ($customer_info[0]['customer_mobile']) { ?>
                                                           <?= $customer_info[0]['customer_mobile'];?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center"><nobr>
                                                    <date>
                                                        <?= display('date')?>: <?= $payment_info[0]['VDate']?> 
                                                    </date>
                                                </nobr></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><?php echo display('voucher_no'); ?> : <?= $payment_info[0]['VNo']?></td>
                                    </tr>
                                    <tr>
                                    <td class="text-left"><?php echo display('payment_type'); ?> : <?= 'Receive';?></td>
                                    </tr>
                                    <tr>
                                    <td class="text-left"><?php echo display('amount'); ?> : <?= $payment_info[0]['Credit'];?></td>
                                    </tr>
                                     <tr>
                                    <td class="text-left"><?php echo display('remark'); ?> : <?= $payment_info[0]['Narration'];?></td>
                                    </tr>
                                </table>

                               
                               
                                </td>
                                 <tr>
                                    
                                    <td> <?php echo display('paid_by')?>: <?= $this->session->userdata('user_name');?>

                                        <div  style="margin-top:10px;float:right;width:30%;text-align:center;border-top:1px solid #e4e5e7;">
                                        <?php echo display('signature') ?>
                                          
                                    </div></td>
                                   
                                </tr>
                                </tr>
                                <tr>{company_info}
                                    <td>Powered  By: <a href="{website}">{company_name}</a></td>
                                     {/company_info}
                                </tr>
                                </table>


                            </div>


                        </div>
                    </div>

                    <div class="panel-footer text-left">
                        <a  class="btn btn-danger" href="<?php echo base_url('accounts/customer_receive'); ?>"><?php echo display('cancel') ?></a>
                        <a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>

                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

