<style type="text/css">

     table .logo-head{text-align: center !important;}

     table.payrollDatatableReport {       
        border-collapse: collapse;
        border: 0;
        text-align: left !important;
    }
    table.payrollDatatableReport td, table.payrollDatatableReport th {
        padding: 6px 15px;
    }
    table.payrollDatatableReport td, table.payrollDatatableReport th {
        border: 1px solid #ededed;
        border-collapse: collapse;
    }
    table.payrollDatatableReport td.noborder {
        border: none;
        padding-top: 40px;
    }
    table.payrollDatatableReport tbody tr td {
        font-size: 13px;
        padding-left: 5px;
    }

    table.payrollDatatableReport thead tr th {
        font-size: 10px;
        padding-left: 5px;
    }
</style>

<?php if(isset($salary_confirmation_emp_list) && !empty($salary_confirmation_emp_list)){?>

<div class="panel panel-bd"> 
    
    <div class="panel-body">

    <div id="printArea">

        <div style="padding:20px;">

            <div class="row mb-10">
                <table class="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <td class="text-left" style="border:none;">
                                <?php
                                    $path = base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png'));
                                    $type = pathinfo($path, PATHINFO_EXTENSION);
                                    $data = file_get_contents($path);
                                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                ?>

                                <img src="<?php echo  $base64; ?>" alt="logo">
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="row mb-10">
                <table class="table table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center fs-20">Salary Confirmation Form for <?php echo $month.' '.$year;?></th>
                        </tr>
                    </thead>
                </table>
            </div>

            <br>

            <div class="row">
                <table width="99%" class="payrollDatatableReport table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                            <td>Employee ID</td>
                            <td>Employee Name</td>
                            <td>Net Salary</td>
                            <td>Signature</td>
                        </tr>

                    </thead>
                    <tbody>

                        <?php 

                        $total_net_salary = 0.0;

                        foreach ($salary_confirmation_emp_list as $key => $row) {

                            $total_net_salary =$total_net_salary + floatval($row->net_salary);

                        ?>

                        <tr style="text-align: center;">
                            <td style="text-align: center;"><?php echo $row->employee_id;?></td>
                            <th><?php echo $row->first_name.' '.$row->last_name;?></th>
                            <td><?php echo $setting->currency_symbol.' '.$row->net_salary;?></td>
                            <td></td>
                        </tr>

                         <?php }?>

                        <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                            <td colspan="2">Grand Total</td>
                            <td><?php echo $setting->currency_symbol.' '.$total_net_salary;?></td>
                            <td></td>
                        </tr>
                    </tbody>

                    <tfoot>
                       <tr>
                            <td colspan="7" class="noborder">
                                <table border="0" width="100%" style="padding-top: 30px;border: none !important;">                                                
                                <tr style="height:50px;padding-top: 30px;border-left: none !important;">
                                    <td align="left" class="noborder" width="30%">
                                        <div class="border-top"><?php echo display('prepared_by')?>: <b><?php echo $user_info['fullname'];?></b></div>
                                    </td>
                                    <td align="left"  class="noborder" width="30%"> <div class="border-top"><?php echo display('checked_by')?></div>
                                    </td>  
                                     <td align="left"  class="noborder" width="20%">
                                        <div class="border-top"><?php echo display('authorised_by')?></div>
                                    </td>
                                </tr>  
                             </table>  
                            </td>                    
                        </tr> 
                   </tfoot>


                </table>

            </div>


        </div>

    </div>

    </div>
</div>

<?php }else{?>

    <?php if(!isset($salary_confirmation_emp_list)){?>

        <div class="panel panel-bd"> 
            
            <div class="panel-body">

                <div class="row mb-10 text-center">
                    <h3 style="color:green;">Please select a date to get the report !</h3>
                </div>

            </div>

        </div>

    <?php }else{?>

    <div class="panel panel-bd"> 
        
        <div class="panel-body">

            <div class="row mb-10 text-center">
                <h3 style="color:red;">No data available, please check for other date !</h3>
            </div>

        </div>

    </div>

<?php }

}?>

<style type="text/css">
    
    .underline {
        border-bottom: 2px solid #000;
    }

    .justify-content-center {
        justify-content: center;
    }

    .d-flex {
        display: flex;
    }

</style>