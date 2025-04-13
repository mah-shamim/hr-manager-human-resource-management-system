<link href="<?php //echo base_url('application/modules/reports/assets/css/payroll_reports.css'); ?>" rel="stylesheet" type="text/css"/>

<style type="text/css">
     table.payrollDatatableReport {       
        border-collapse: collapse;
        border: 0;
        text-align: left;
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
    
                    <?php echo  form_open('reports/Payroll_report/get_npf3_soc_sec_tax','id="lateness_early_closing"') ?>

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



<?php if(isset($tax_data) && !empty($tax_data)){?>

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
                            <td class="text-center" style="border:none;text-align: center;">
                                <img src="<?php echo base_url('/').$setting->logo;?>">
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center fs-20" style="border:none;text-align: center;">Social security and housing finance corporation remittance adivce form</th>
                        </tr>
                    </thead>
                </table>
            </div> 

            <br>

            <div class="row mb-10">
                <table class="info-section" cellspacing="0" cellpadding="1" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td width="33%" style="border-top:none;">EMPLOYER REGISTRATION NUMBER:</td>
                            <td width="33%" style="border-top:none;text-align: center;">5968</td>
                            <td width="33%" style="border-top:none;padding-left: 20px;">NPF 3 <br>YEAR:<?php echo $year;?></td>
                        </tr>
                        <tr>
                            <td width="33%" style="border-top:none;">EMPLOYER NAME:</td>
                            <td width="33%" style="border-top:none;text-align: center;"><?php echo $setting->title;?></td>
                            <td width="33%" style="border-top:none;"></td>
                        </tr>
                        <tr>
                            <td width="33%" style="border-top:none;">ADDRESS:</td>
                            <td width="33%" style="border-top:none;text-align: center;"><?php echo $setting->address;?></td>
                            <td width="33%" style="border-top:none;"></td>
                        </tr>
                        <tr>
                            <td width="33%" style="border-top:none;">CONTRIBUTION FOR MONTH OF: </td>
                            <td width="33%" style="border-top:none;text-align: center;"><?php echo $month.'-'.$year;?></td>
                            <td width="33%" style="border-top:none;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br>

            <div class="row">
                <table width="99%" class="payrollDatatableReport table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                            <td>Employee</td>
                            <td>Employee</td>
                            <td>Basic</td>
                            <td>5%</td>
                            <td>10%</td>
                            <td>15%</td>
                            <td>NEW EMPLOYEES INDICATE</td>
                        </tr>

                        <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                            <td>Soc.Sec.#</td>
                            <td>Full Name</td>
                            <td>Pay</td>
                            <td>Contr.</td>
                            <td>Contr.</td>
                            <td>Contr.</td>
                            <td>LAST EMPLOYER &S.S NO.</td>
                        </tr>

                    </thead>
                    <tbody>

                        <?php 

                        $total_basic             = 0.0;
                        $total_soc_sec           = 0.0;
                        $total_empr_contr        = 0.0;
                        $total_soc_sec_and_contr = 0.0;

                        foreach ($tax_data as $key => $row) { 

                            $total_contribution = 0.0;
                            $total_contribution = floatval($row->soc_sec_npf_tax) + floatval($row->employer_contribution);

                            $total_basic              = $total_basic + floatval($row->basic_salary_pro_rated);
                            $total_soc_sec            = $total_soc_sec + floatval($row->soc_sec_npf_tax);
                            $total_empr_contr         = $total_empr_contr + floatval($row->employer_contribution);
                            $total_soc_sec_and_contr  = $total_soc_sec_and_contr + floatval($total_contribution);

                        ?>

                        <tr style="text-align: center;">
                            <th style="text-align: left;"><?php echo $row->social_security_no;?></th>
                            <td><?php echo $row->first_name.' '.$row->last_name;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$row->basic_salary_pro_rated;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$row->soc_sec_npf_tax;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$row->employer_contribution;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_contribution;?></td>
                            <td></td>
                        </tr>

                         <?php }?>

                        <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                            <th></th>
                            <td></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_basic;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_soc_sec;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_empr_contr;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_soc_sec_and_contr;?></td>
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

    <?php if(!isset($tax_data)){?>

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
      'border-collapse: collapse;border: 0;text-align: left;' +
      '}'+
    'table.payrollDatatableReport td, table.payrollDatatableReport th {' +
    'padding: 6px 15px;text-align: left;' +
    '}' +
    'table.payrollDatatableReport td, table.payrollDatatableReport th {' +
    'border: 1px solid #ededed;border-collapse: collapse;text-align: left;' +
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