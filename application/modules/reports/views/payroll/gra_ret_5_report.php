<link href="<?php //echo base_url('application/modules/reports/assets/css/payroll_reports.css'); ?>" rel="stylesheet" type="text/css"/>

<style type="text/css">
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
        text-align: left !important;
    }
table.payrollDatatableReport td.noborder {
    border: none;
    padding-top: 40px;
    text-align: left !important;
}
</style>

<div class="row" style="padding:15px;">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
                <div class="panel-heading">
                  <div class="panel-title">
                      <h4>
                        <?php echo $title;?>
                      </h4>
                  </div>
                </div>
                <div class="panel-body">
    
                    <?php echo  form_open('reports/Payroll_report/get_gra_ret_5_report','id="lateness_early_closing"') ?>

                        <div class="form-group row">

                            <label for="date" class="col-sm-2 col-form-label"><?php echo display('date') ?> *</label>
                            <div class="col-sm-3">

                              <input type="month" class="form-control" id="start" name="month_year" min="2020-01" value="<?php if(isset($month_year) && !empty($month_year)){echo $month_year;}else{echo date('Y').'-'.date('m');}?>" required>

                               
                            </div>

                        </div>

                        <div class="form-group row text-center">
                            <div class="col-sm-5" style="text-align: right;">
                                <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('submit') ?></button>
                            </div>
                            
                        </div>

                   </form>
                           
                </div>

            </div>  
        </div>
</div>



<?php if(isset($gra_ret_5_data) && !empty($gra_ret_5_data)){?>

<div class="panel panel-bd"> 
    
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
                <table class="table" style="width: 100%;text-align: center;">
                    <thead>
                        <tr>
                            <td class="text-center" style="border:none;">
                                <img src="<?php echo base_url('/').$setting->logo;?>">
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center fs-20" style="border:none;">EMPLOYERS SCHEDULE OF MONTHLY PAYE DEDUCTIONS FROM EMPLOYEES REMUNERATION</th>
                        </tr>
                    </thead>
                </table>
            </div> 

             <br>

            <div class="row mb-10">
                <table class="info-section" cellspacing="0" cellpadding="1" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td width="33%" style="border-top:none;">EMPLOYERs TIN:</td>
                            <td width="33%" style="border-top:none;text-align: center;">1810082912</td>
                            <td width="33%" style="border-top:none;padding-left: 20px;">GRA RET 5</td>
                        </tr>
                        <tr>
                            <td width="33%" style="border-top:none;">NAME OF EMPLOYER:</td>
                            <td width="33%" style="border-top:none;text-align: center;"><?php echo $setting->title;?></td>
                            <td width="33%" style="border-top:none;"></td>
                        </tr>
                        <tr>
                            <td width="33%" style="border-top:none;">ADDRESS OF EMPLOYER a. POSTAL:</td>
                            <td width="33%" style="border-top:none;text-align: center;"><?php echo $setting->address;?></td>
                            <td width="33%" style="border-top:none;"></td>
                        </tr>
                        <tr>
                            <td width="33%" style="border-top:none;">FOR MONTH OF: </td>
                            <td width="33%" style="border-top:none;text-align: center;"><?php echo $month.'-'.$year;?></td>
                            <td width="33%" style="border-top:none;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br>

            <div class="row">
                <table width="99%" class="payrollDatatableReport table table-striped table-bordered table-hover" style="text-align: left !important;">
                    <thead>
                        <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                            <td width="10%">Employee TIN</td>
                            <td width="10%">Name of Employee</td>
                            <td width="20%">Gross Salary/Wages</td>
                            <td width="20%">Cumulative Salary Up To Date</td>
                            <td width="20%">Monthly Tax Deduction</td>
                            <td width="20%">Cumulative Tax Deduction Up To Date</td>
                        </tr>

                    </thead>
                    <tbody>

                        <?php 

                        $total_gross             = 0.0;
                        $total_cumulative_gross  = 0.0;

                        $total_state_income_tax             = 0.0;
                        $total_cumulative_state_income_tax  = 0.0;

                        foreach ($gra_ret_5_data as $key => $row) {

                            $gra_ret_5_monthly = $gra_ret_5_report_monthly[$row->employee_id];

                            $gross_salary = $gra_ret_5_monthly['gross_salary'];
                            $income_tax   = $gra_ret_5_monthly['income_tax'];
                            $tin_no       = $gra_ret_5_monthly['tin_no'];

                            $total_gross             = $total_gross + floatval($gross_salary);
                            $total_state_income_tax  = $total_state_income_tax + floatval($income_tax);

                            $total_cumulative_gross              = $total_cumulative_gross + floatval($row->cumilative_gross_salary);
                            $total_cumulative_state_income_tax  = $total_cumulative_state_income_tax + floatval($row->cumilative_income_tax);

                        ?>

                        <tr style="text-align: center;">
                            <td style="text-align: center;"><?php echo $tin_no;?></td>
                            <td><?php echo $row->first_name.' '.$row->last_name;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$gross_salary;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$row->cumilative_gross_salary;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$income_tax;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$row->cumilative_income_tax;?></td>
                        </tr>

                         <?php }?>

                        <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                            <td>Totals</td>
                            <td></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_gross;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_cumulative_gross;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_state_income_tax;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_cumulative_state_income_tax;?></td>
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

    <?php if(!isset($gra_ret_5_data)){?>

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
    'border: 1px solid #ededed;border-collapse: collapse;text-align: left !important;' +
    '}' +
    'table.payrollDatatableReport td.noborder {' +
    'border: none;padding-top: 40px;' +
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