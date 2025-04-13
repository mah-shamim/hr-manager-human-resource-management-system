<link href="<?php echo base_url('application/modules/payroll/assets/css/payslip.css'); ?>" rel="stylesheet" type="text/css"/>

<div class="container">

    <div class="panel panel-default thumbnail"> 
    

        <br>

        <div id="printArea">

            <div class="salary_approval">

                <div class="row mb-10">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center fs-20">

                                    Payroll posting sheet for <?php echo $salary_sheet_generate_info->name;?>
                                    <br>(<span style="<?php echo $salary_sheet_generate_info->approved == 1?'color:#05f305;':'color:#ef1ea5;';?>"><?php echo $salary_sheet_generate_info->approved == 1?'Approved':'Not Approved';?></span>)
                                    
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="title_firsttwo">
                                <td colspan="">Description</td>
                                <td colspan="2">Amounts</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="title_fourth">Debit</td>
                                <td class="title_fifth">Credit</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="center-item">
                                <th class="center-item">Gross Salary</th>
                                <td><?php echo $setting->currency_symbol.' '.$gross_salary;?></td>
                                <td></td>
                            </tr>
                            <tr class="center-item">
                                <th class="center-item">Net Salary</th>
                                <td></td>
                                <td><?php echo $setting->currency_symbol.' '.$net_salary;?></td>
                            </tr>
                            <tr class="center-item">
                                <th class="center-item">Loans</th>
                                <td></td>
                                <td><?php echo $setting->currency_symbol.' '.$loans;?></td>
                            </tr>
                            <tr class="center-item">
                                <th class="center-item">Salary Advance</th>
                                <td></td>
                                <td><?php echo $setting->currency_symbol.' '.$salary_advance;?></td>
                            </tr>
                            <tr class="center-item">
                                <th class="center-item">State Income Tax</th>
                                <td></td>
                                <td><?php echo $setting->currency_symbol.' '.$state_income_tax;?></td>
                            </tr>
                            <tr class="center-item">
                                <th class="center-item">Employee 5% NPF Contribution</th>
                                <td></td>
                                <td><?php echo $setting->currency_symbol.' '.$employee_npf_contribution;?></td>
                            </tr>
                            <tr class="center-item">
                                <th class="center-item">Employer 10% NPF Contribution</th>
                                <td></td>
                                <td><?php echo $setting->currency_symbol.' '.$employer_npf_contribution;?></td>
                            </tr>
                            <tr class="center-item">
                                <th class="center-item">IICF Contribution</th>
                                <td></td>
                                <td><?php echo $setting->currency_symbol.' '.$icf_amount;?></td>
                            </tr>
                            <tr class="table_foot_bg">
                                <th class="center-item"></th>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="form-group form-group-margin text-right">
                        <button type="button" id="post_button" class="btn btn-success w-md m-b-5" style="<?php echo $salary_sheet_generate_info->approved == 1?'display: none;':'';?>"><?php echo display('post') ?></button>
                    </div>

                </div>

                <?php echo  form_open('payroll/Payroll/save_employee_salary_approval') ?>

                <div class="row" id="payment_area">

                    <!-- Payment for Net Renumeration -->

                    <div class="col-sm-12">
                        <h3>Note: Sum of all payment amount should be equal to Net Salary.</h3>
                    </div>

                    <table class="table table-bordered" id="request_table">
                        <thead>
                            <tr>
                                <th width="50%">Payment Nature</th>
                                <th class="amnt_net_salary" width="40%">Amount(Net Salary <?php echo $setting->currency_symbol.' ';?><span><b><?php echo ' '.$net_salary;?></b></span>)</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="payment_request_item">
                            <tr>
                                <td>
                                    <select name="payment_nature[]" class="form-control payment-nature-select"  required="">
                                            <option value=""> Select Payment Nature</option>
                                        <?php if ($payment_natures) { ?>
                                          <?php foreach($payment_natures as $key => $value){?>
                                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                            
                                        <?php }} ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="amount" name="amount[]" class="form-control payment-amount" required step=".01">
                                </td>
                                <td>
                                    <a  id="add_payment_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="add_key_payment_item('payment_request_item')"  tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                                    <a class="btn btn-danger btn-sm"  value="<?php echo display('delete') ?>" onclick="deleteRow(this)" tabindex="3"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>

                                <input type="hidden" id="payment_list" value='<?php if ($payment_natures) { ?><?php foreach($payment_natures as $key => $value){?><option value="<?php echo $key;?>"><?php echo $value;?></option><?php }}?>' name="">

                                <input type="hidden" id="net_renumeration" value="<?php echo $net_salary;?>" name="net_renumeration">
                                <input type="hidden" id="employee_npf_contribution" value="<?php echo $employee_npf_contribution;?>" name="employee_npf_contribution">
                                <input type="hidden" id="employer_npf_contribution" value="<?php echo $employer_npf_contribution;?>" name="employer_npf_contribution">
                                <input type="hidden" id="icf_amount" value="<?php echo $icf_amount;?>" name="icf_amount">
                                <input type="hidden" id="state_income_tax" value="<?php echo $state_income_tax;?>" name="state_income_tax">

                                <input type="hidden" id="month_year" value="<?php echo $salary_sheet_generate_info->name;?>" name="month_year">
                                <input type="hidden" id="ssg_id" value="<?php echo $ssg_id;?>" name="ssg_id">


                            </tr>
                        </tbody>
                    </table>

                    <!-- End Payment for Net Renumeration -->

                    <?php if(floatval($state_income_tax) > 0){?>

                    <!-- Payment for State Income Tax -->

                    <br>

                    <div class="col-sm-12">
                        <h3>Note: Sum of all payment amount should be equal to State Income Tax.</h3>
                    </div>

                    <table class="table table-bordered" id="tax_request_table">
                        <thead>
                            <tr>
                                <th width="50%">Payment Nature(Bank)</th>
                                <th class="amnt_state_incm_tax" width="40%">Amount(State Income Tax <?php echo $setting->currency_symbol.' ';?><span><b><?php echo ' '.$state_income_tax;?></b></span>)</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tax_payment_request_item">
                            <tr>
                                <td>
                                    <select name="tax_payment_nature[]" class="form-control tax-payment-nature-select"  required="">
                                            <option value=""> Select Payment Nature</option>
                                        <?php if ($bank_payment_natures) { ?>
                                          <?php foreach($bank_payment_natures as $key => $value){?>
                                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                            
                                        <?php }} ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="tax_amount" name="tax_amount[]" class="form-control tax-payment-amount" required step=".01">
                                </td>
                                <td>
                                    <a  id="add_tax_payment_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="add_key_tax_payment_item('tax_payment_request_item')"  tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                                    <a class="btn btn-danger btn-sm"  value="<?php echo display('delete') ?>" onclick="deleteTaxPayRow(this)" tabindex="3"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>

                                <input type="hidden" id="tax_payment_list" value='<?php if ($bank_payment_natures) { ?><?php foreach($bank_payment_natures as $key => $value){?><option value="<?php echo $key;?>"><?php echo $value;?></option><?php }}?>' name="">
                            </tr>
                        </tbody>
                    </table>

                    <!-- End Payment for State Income Tax -->

                    <?php }?>

                    <?php if(floatval($total_npf_contribution) > 0){?>

                    <!-- Payment for NPF Contribution -->

                    <br>

                    <div class="col-sm-12">
                        <h3>Note: Sum of all payment amount should be equal to NPF Contribution Amount.</h3>
                    </div>

                    <table class="table table-bordered" id="npf_request_table">
                        <thead>
                            <tr>
                                <th width="50%">Payment Nature</th>
                                <th class="pay_npf_contribution" width="40%">15% NPF Contribution <?php echo $setting->currency_symbol.' ';?><span><b><?php echo ' '.$total_npf_contribution;?></b></span></th>

                            </tr>
                        </thead>
                        <tbody id="npf_payment_request_item">
                            <tr>
                                <td>
                                    <select name="npf_payment_nature[]" class="form-control npf-payment-nature-select"  required="">
                                            <option value=""> Select Payment Nature</option>
                                        <?php if ($payment_natures) { ?>
                                          <?php foreach($payment_natures as $key => $value){?>
                                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                            
                                        <?php }} ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="npf_amount" name="npf_amount[]" class="form-control npf-payment-amount" required step=".01" value="<?php echo $total_npf_contribution;?>" readonly>
                                </td>

                                <input type="hidden" id="npf_payment_list" value='<?php if ($payment_natures) { ?><?php foreach($payment_natures as $key => $value){?><option value="<?php echo $key;?>"><?php echo $value;?></option><?php }}?>' name="">
                            </tr>
                        </tbody>
                    </table>

                    <!-- End Payment for NPF Contribution -->

                    <?php }?>

                    <?php if(floatval($icf_amount) > 0){?>

                    <!-- Payment for IICF Contribution -->

                    <br>

                    <div class="col-sm-12">
                        <h3>Note: Sum of all payment amount should be equal to IICF Contribution Amount.</h3>
                    </div>

                    <table class="table table-bordered" id="iicf_request_table">
                        <thead>
                            <tr>
                                <th width="50%">Payment Nature</th>
                                <th class="iicf_pay_cotribution" width="40%">1% IICF Contribution <?php echo $setting->currency_symbol.' ';?><span><b><?php echo ' '.$icf_amount;?></b></span></th>

                            </tr>
                        </thead>
                        <tbody id="iicf_payment_request_item">
                            <tr>
                                <td>
                                    <select name="iicf_payment_nature[]" class="form-control iicf-payment-nature-select"  required="">
                                            <option value=""> Select Payment Nature</option>
                                        <?php if ($payment_natures) { ?>
                                          <?php foreach($payment_natures as $key => $value){?>
                                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                            
                                        <?php }} ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="iicf_amount" name="iicf_amount[]" class="form-control iicf-payment-amount" required step=".01" value="<?php echo $icf_amount;?>" readonly>
                                </td>

                                <input type="hidden" id="iicf_payment_list" value='<?php if ($payment_natures) { ?><?php foreach($payment_natures as $key => $value){?><option value="<?php echo $key;?>"><?php echo $value;?></option><?php }}?>' name="">
                            </tr>
                        </tbody>
                    </table>

                    <!-- End Payment for IICF Contribution -->

                    <?php }?>

                    <div class="form-group form-group-margin text-right">
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>

                </div>

                <input type="hidden" id="net_salary_hidden" value="<?php echo $net_salary;?>">
                <input type="hidden" id="total_npf_contribution_hidden" value="<?php echo $total_npf_contribution;?>">
                <input type="hidden" id="icf_amount_hidden" value="<?php echo $icf_amount;?>">
                <input type="hidden" id="state_income_tax_hidden" value="<?php echo $state_income_tax;?>">

                <?php echo form_close() ?>

            </div>

        </div>

        </div>
    </div>

</div>

<script src="<?php echo MOD_URL.'payroll/assets/js/emp_salary_approval.js'; ?>" type="text/javascript"></script>

