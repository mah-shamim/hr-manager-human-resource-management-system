<link href="<?php //echo base_url('application/modules/payroll/assets/css/payslip.css'); ?>" rel="stylesheet" type="text/css"/>

<style type="text/css">

    table{font-size: 13px;}

    table.payrollDatatableReport {       
        border-collapse: collapse;
        border: 0;
        text-align: left !important;
    }
    table.payrollDatatableReport td, table.payrollDatatableReport th {
        padding: 6px 15px;
        text-align: left !important;
    }
    table.payrollDatatableReport td, table.payrollDatatableReport th {
        border: 1px solid #ededed;
        border-collapse: collapse;
    }
    table.payrollDatatableReport td.noborder {
        border: none;
        padding-top: 40px;
        text-align: left !important;
    }
    table.payrollDatatableReport tbody tr td {
        font-size: 10px;
        padding-left: 5px;
        font-size: 13px;
        text-align: left !important;
    }

    table.payrollDatatableReport thead tr th {
        font-size: 13px;
        padding-left: 5px;
        text-align: left;
        text-align: left !important;
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

            <div class="text-right" id="print">
               <button type="button" class="btn btn-warning" id="btnPrint" onclick="printPageArea('printArea');"><i class="fa fa-print"></i></button>

               <a href="<?php echo base_url($pdf)?>" target="_blank" title="download pdf">
                    <button  class="btn btn-success btn-md" name="btnPdf" id="btnPdf" ><i class="fa-file-pdf-o"></i> PDF</button>
                </a>
                
            </div>

        <br>

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

                <div class="row">
                    <table width="99%" class="payrollDatatableReport table table-striped table-bordered table-hover">
                        <thead>
                            <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                                <td width="10%">Employee ID</td>
                                <td width="20%">Employee Name</td>
                                <td width="10%">Amount Requested</td>
                                <td width="20%">Approve Date</td>
                                <td width="20%">Signature of Receipt</td>
                                <td width="20%">Date of Receipt</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align: center;height: 50px;">
                                <th style="text-align: center;"><?php echo $loan_info->employee_id;?></th>
                                <th style="text-align: center;"><?php echo $loan_info->first_name.' '.$loan_info->last_name;?></th>
                                <th style="text-align: center;"><?php if(!empty($setting->currency_symbol)){echo $setting->currency_symbol.' ';}?><?php echo $loan_info->amount;?></th>
                                <th style="text-align: center;"><?php echo $loan_info->date_of_approve;?></th>
                                <th style="text-align: center;"></th>
                                <th style="text-align: center;"></th>
                            </tr>
                        </tbody>

                        <br>

                        <tfoot>
                            <tr>
                                <td colspan="6" class="noborder">
                                    <table border="0" width="100%" style="padding-top: 50px;border: none !important;">                                                
                                    <tr border="0" style="height:50px;padding-top: 50px;border-left: none !important;">
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


<script type="text/javascript">
    
function printPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=650');

    var htmlToPrint = '' +
    '<style type="text/css">' +
    'table.payrollDatatableReport {' +
      'border-collapse: collapse;border: 0;text-align: left !important;' +
      '}'+
    'table.payrollDatatableReport td, table.payrollDatatableReport th {' +
    'padding: 6px 15px;text-align: left !important;' +
    '}' +
    'table.payrollDatatableReport td, table.payrollDatatableReport th {' +
    'border: 1px solid #ededed;border-collapse: collapse;' +
    '}' +
    'table.payrollDatatableReport td.noborder {' +
    'border: none;padding-top: 40px;text-align: left !important;' +
    '}' +
    '</style>';

    htmlToPrint += printContent.innerHTML;
    // nWindow.document.write(htmlToPrint);

    WinPrint.document.write(htmlToPrint);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}

</script>