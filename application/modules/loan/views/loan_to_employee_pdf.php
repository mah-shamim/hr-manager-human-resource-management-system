<style type="text/css">

     table .logo-head{text-align: center !important;}

     table.payrollDatatableReport {       
        border-collapse: collapse;
        border: 0;
        text-align: left !important;
    }
    table.payrollDatatableReport td, table.payrollDatatableReport th {
        padding: 6px 15px;
        text-align: left;
    }
    table.payrollDatatableReport td, table.payrollDatatableReport th {
        border: 1px solid #ededed;
        border-collapse: collapse;
        text-align: left;
    }
    table.payrollDatatableReport td.noborder {
        border: none;
        padding-top: 40px;
    }
    table.payrollDatatableReport tbody tr td {
        font-size: 13px;
        padding-left: 5px;
        text-align: left;
    }

    table.payrollDatatableReport thead tr th {
        font-size: 10px;
        padding-left: 5px;
        text-align: left;
    }
</style>

<?php

    $curncy_symbol = '';
    $social_security_tax_percnt = '';
    if(!empty($setting->currency_symbol)){
        $curncy_symbol = '('.$setting->currency_symbol.')';
        $social_security_tax_percnt = $setting->soc_sec_npf_tax;
    }

?>

<div class="container">

    <div class="panel panel-default thumbnail"> 
        
        <div class="panel-body">

        <div id="printArea">

            <div style="padding:20px;">

                <div class="row mb-10">
                    <table width="99%">                                         
                        <tr>
                            <td width="30%" align="left">
                                <?php
                                $path = base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png'));
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                ?>
                                
                            </td>
                            <td width="40%" align="center">
                                <img src="<?php echo  $base64; ?>" alt="logo">
                                <p><?php echo  $setting->title; ?></p>

                            </td>  
                             <td width="30%" align="right">
                            </date>
                            </td>
                        </tr>  
                     </table> 
                </div>

                <div class="row mb-10">
                   <table width="99%">
                        <thead>
                            <tr style="height: 40px;">
                                <th class="text-center fs-20"><h3>Loan to employee</h3></th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <br>

                <div class="row">
                    <table width="99%" class="payrollDatatableReport table table-striped table-bordered table-hover">
                        <thead>
                            <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;">
                                <th width="10%">Employee ID</th>
                                <th width="15%">Employee Name</th>
                                <th width="15%">Amount Requested</th>
                                <th width="20%">Approve Date</th>
                                <th width="20%">Signature of Receipt</th>
                                <th width="19%">Date of Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $loan_info->employee_id;?></td>
                                <td><?php echo $loan_info->first_name.' '.$loan_info->last_name;?></td>
                                <td><?php if(!empty($setting->currency_symbol)){echo $setting->currency_symbol.' ';}?><?php echo $loan_info->amount;?></td>
                                <td><?php echo $loan_info->date_of_approve;?></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="6" class="noborder">
                                    <table border="0" width="100%" style="padding-top: 20px;border: none !important;">                                                
                                    <tr border="0" style="height:40px;padding-top: 20px;border-left: none !important;">
                                        <td align="left" class="noborder" width="30%">
                                            <div class="border-top"><?php echo display('prepared_by')?>: <b><?php echo $user_info['fullname'];?><b></div>
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

</div>