<style type="text/css">

     table{font-size: 11.5px;}

     table thead{background-color: #E7E0EE;}

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
        font-size: 10px;
        padding-left: 5px;
    }

    table.payrollDatatableReport thead tr th {
        font-size: 11px;
        padding-left: 5px;
    }
</style>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">            
            <div id="printArea">
                <div class="panel-body">
                     <div class="table-responsive">
                        <table border="0" style="width: 1200px!important;">                                                
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
                                    <br>
                                    <h3><?php echo $title; ?> for <?php echo $salary_sheet_generate_info->name; ?></h3>

                                </td>  
                                 <td width="30%" align="right">
                                </date>
                                </td>
                            </tr>  
                         </table> 

                         <?php

                        $curncy_symbol = '';
                        $social_security_tax_percnt = '';
                        if(!empty($setting->currency_symbol)){
                            $curncy_symbol = '('.$setting->currency_symbol.')';
                            $social_security_tax_percnt = $setting->soc_sec_npf_tax;
                        }

                        ?>

                        <table  style="width: 1200px!important;" class="payrollDatatableReport table table-striped table-bordered table-hover">

                            <thead bgcolor="#E7E0EE">

                              <tr>
                                <th class="text-left" width="2%">Sl</th>
                                <th class="text-left" width="5%">Employee Name</th>
                                <th class="text-left" width="8%">Basic Salary<?php echo $curncy_symbol;?></th>
                                <th class="text-left" width="8%">Total Benefit<?php echo $curncy_symbol;?></th>
                                <th class="text-left" width="9%">Transport Allowance<?php echo $curncy_symbol;?></th>
                                <th class="text-left" width="8%">Gross Salary<?php echo $curncy_symbol;?></th>
                                <th class="text-left" width="8%">State Income Tax<?php echo $curncy_symbol;?></th>
                                <th class="text-left" width="9%">Soc.Sec.NPF<?php echo ' '.$social_security_tax_percnt.'%'.$curncy_symbol;?></th>
                                <th class="text-left" width="9%">Employer Contribution 10%<?php echo $curncy_symbol;?></th>
                                <th class="text-left" width="8%">Loan Deduction<?php echo $curncy_symbol;?></th>
                                <th class="text-left" width="8%">Salary Advance<?php echo $curncy_symbol;?></th>
                                <th class="text-left" width="10%">Total Deductions<?php echo $curncy_symbol;?></th>
                                <th class="text-left" width="8%">Net Salary<?php echo $curncy_symbol;?></th>
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
                                    <table border="0" width="100%" style="padding-top: 10px;border: none !important;">                                                
                                    <tr>
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