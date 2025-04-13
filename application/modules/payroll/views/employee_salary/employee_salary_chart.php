<link href="<?php echo MOD_URL.'payroll/assets/css/employee_salary_chart.css'; ?>" rel="stylesheet" type="text/css"/>  


<div class="row">
 <div class="col-sm-12 col-md-12">
    <div class="panel panel-bd">
        <div class="panel-heading" >
            <div class="panel-title">
                <h3><?php echo $title; ?></h3>
            </div>
        </div>
        <div class="panel-body emp_sal_chart">

        <div class="text-right" id="print">

           <button type="button" class="btn btn-warning" id="btnPrint" onclick="printPageArea('printArea');"><i class="fa fa-print"></i></button>

           <a href="<?php echo base_url($pdf)?>" target="_blank" title="download pdf">
                <button  class="btn btn-success btn-md" name="btnPdf" id="btnPdf" ><i class="fa-file-pdf-o"></i> PDF</button>
            </a>
            
        </div>

        <br>

        <div id="printArea">

        <div>

            <div class="row mb-10">
                <table class="table" width="99%">
                    <thead>
                        <tr>
                            <td align="center" class="text-center logo-image">
                                <img src="<?php echo base_url('/').$setting->logo;?>">
                            </td>
                        </tr>
                        <tr>
                            <th align="center" class="text-center fs-20 chart_title"><?php echo $title.' for '.$salary_sheet_generate_info->name; ?></th>
                        </tr>
                    </thead>
                </table>
            </div>

            <?php

            $curncy_symbol = '';
            $social_security_tax_percnt = '';
            if(!empty($setting->currency_symbol)){
                $curncy_symbol = '('.$setting->currency_symbol.')';
                $social_security_tax_percnt = $setting->soc_sec_npf_tax;
            }

            ?>

            <table width="99%" class="payrollDatatableReport table table-striped table-bordered table-hover">
                <thead bgcolor="#E7E0EE">

                  <tr>
                    <th class="text-left" width="2%">Sl</th>
                    <th class="text-left" width="5%">Employee Name</th>
                    <th class="text-left" width="8%">Basic Salary</th>
                    <th class="text-left" width="8%">Total Benefit</th>
                    <th class="text-left" width="9%">Transport Allowance</th>
                    <th class="text-left" width="8%">Gross Salary</th>
                    <th class="text-left" width="8%">State Income Tax</th>
                    <th class="text-left" width="9%">Soc.Sec.NPF<?php echo ' '.$social_security_tax_percnt.'%';?></th>
                    <th class="text-left" width="9%">Employer Contribution 10%</th>
                    <th class="text-left" width="8%">Loan Deduction</th>
                    <th class="text-left" width="8%">Salary Advance</th>
                    <th class="text-left" width="10%">Total Deductions</th>
                    <th class="text-left" width="8%">Net Salary</th>
                  </tr>

                </thead>

                <tbody class="employee_salary_chart">

                   <?php 

                  $i = 1;
                  $total_benefits = 0.0;
                  $total_deductions = 0.0;

                  foreach ($employee_salary_charts as $key => $row) {

                    $total_benefits = floatval($row->medical_benefit) + floatval($row->family_benefit) + floatval($row->transportation_benefit) + floatval($row->other_benefit);

                    $total_deductions = floatval($row->income_tax) + floatval($row->soc_sec_npf_tax) + floatval($row->loan_deduct) + floatval($row->salary_advance);

                  ?>

                  <tr>
                    <td class="text-left"><?php echo $i;?></td>
                    <td class="text-left"><?php echo $row->first_name.' '.$row->last_name;?></td>
                    <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->basic_salary_pro_rated;?></td>
                    <td class="text-left"><?php echo $setting->currency_symbol.' '.$total_benefits;?></td>
                    <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->transport_allowance_pro_rated;?></td>
                    <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->gross_salary;?></td>
                    <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->income_tax;?></td>
                    <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->soc_sec_npf_tax;?></td>
                    <td class="text-left"><?php echo $setting->currency_symbol.' '.floatval($row->employer_contribution);?></td>
                    <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->loan_deduct;?></td>
                    <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->salary_advance;?></td>
                    
                    <td class="text-left"><?php echo $setting->currency_symbol.' '.$total_deductions;?></td>

                    <td class="text-left"><?php echo $setting->currency_symbol.' '.$row->net_salary;?></td>
                  </tr>

                  <?php

                  $i++;

                  }

                  ?>
                  
                </tbody>

                <tfoot>
                   <tr >
                    <td colspan="13" class="noborder">
                        <table class="chart_foot" border="0" width="100%">                                                
                        <tr>
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
</div>

<script src="<?php echo MOD_URL.'payroll/assets/js/employee_salary_chart.js'; ?>" type="text/javascript"></script>
