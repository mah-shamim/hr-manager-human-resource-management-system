<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                                    <th><?php echo display('Sl') ?></th>
                                    <th><?php echo display('salary_month') ?></th>
                                    <th><?php echo display('employee_name') ?></th>
                                    <th><?php echo display('total_salary') ?></th>
                                    <th><?php echo display('total_working_minutes') ?></th>
                                    <th><?php echo display('working_day') ?></th>
                                    <th><?php echo display('payment_date') ?></th>
                                    <th><?php echo display('paid_by') ?></th>
                                    <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($emp_pay)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($emp_pay as $que) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo $que->salary_name; ?></td>
                                        <td><?php echo $que->first_name.' '.$que->last_name; ?></td>
                                        <td><?php echo $que->total_salary; ?></td>
                                        <td><?php echo $que->total_working_minutes; ?></td>
                                        <td><?php echo $que->working_period; ?></td>
                                        <td><?php echo $que->payment_date; ?></td>
                                        <td><?php echo $que->paid_by; ?></td>
                                        <td class="center">
                                   
                                       <?php 
                                        if($que->payment_due =='paid'){?>
                                            <a href='<?php echo base_url("payroll/Payroll/payslip/$que->emp_sal_pay_id") ?>' class='btn btn-info btn-xs'><?php echo 'Payslip' ?></a>       
                                       <?php } 
                                        else {?>
                                          
                                            <a href='#' class='btn btn-success btn-xs' onclick='Payment(<?php echo $que->emp_sal_pay_id; ?>,"<?php echo $que->employee_id; ?>","<?php echo $que->total_salary; ?>","<?php echo $que->total_working_minutes; ?>","<?php echo $que->working_period; ?>")'><?php echo display('pay_now') ?></a>
                                      <?php  }

                                        ?>
                                                                           
                                </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                 <?= $links ?> 
            </div>
        </div>
    </div>
     <div id="PaymentMOdal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color:green;color:white">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><center> <?php echo display('payment')?></center></strong>
            </div>
            <div class="modal-body">
           
   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo 'Payment Form'; ?></h4>
                    </div>
                </div>
                <div class="panel-body">

                <?= form_open('employee/Employees/payconfirm/') ?>
                

                    <input name="emp_sal_pay_id" id="salType" type="hidden" value="">
                 
                         <div class="form-group row">
                            <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="empname" class="form-control" id="employee_name" value="" readonly>
                                <input type="hidden" name="employee_id" class="form-control" id="employee_id" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_salary" class="col-sm-3 col-form-label"><?php echo display('total_salary') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="total_salary" class="form-control" id="total_salary" value="" readonly>
                            </div>
                        </div> 

                       <div class="form-group row">
                            <label for="total_working_minutes" class="col-sm-3 col-form-label"><?php echo display('total_working_minutes') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="total_working_minutes" class="form-control" id="total_working_minutes" value="" readonly>
                            </div>
                        </div> 
                         <div class="form-group row">
                            <label for="working_period" class="col-sm-3 col-form-label"><?php echo display('working_period') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="working_period" class="form-control" id="working_period" value="" readonly>
                            </div>
                        </div> 
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-3 col-form-label"><?php
                                        echo display('payment_type');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <select name="paytype" class="form-control" required="" id="paytype" onchange="bank_paymet(this.value)" required="" style="width: 100%">
                                            <option value="">Select Payment Option</option>
                                            <option value="1">Cash Payment</option>
                                            <option value="2">Bank Payment</option>
                                        </select>
                                    </div>
                                 
                                </div>
                      
                          
                                <div class="form-group row" id="bank_div" style="display: none;">
                                    <label for="payment_type" class="col-sm-3 col-form-label"><?php
                                        echo display('bank_name');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                    <select name="bank_name" class="form-control" id="bank" style="width: 100%">
                                    <option value="">Select Payment Option</option>
                                            <?php foreach($bank_list as $banks){?>
                                            <option value="<?php echo $banks['bank_name']?>"><?php echo $banks['bank_name']?></option>
                                            <?php }?>
                                            
                                        </select>
                                    </div>
                                 
                                </div>
                          
                    
               <div class="form-group text-center">
                            <button type="submit" class="btn btn-danger" data-dismiss="modal">&times; Cancel</button>
                            <button type="submit" class="btn btn-primary"><?php echo display('confirm')?></button>
                        </div>

                    <?php echo form_close() ?>


                </div>  
            </div>
        </div>
    </div>
             
    </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
</div>
 
 <script type="text/javascript">
function Payment(salpayid,employee_id,TotalSalary,WorkHour,Period){
  
   var sal_id = salpayid;
   var employee_id = employee_id;
    $.ajax({
    url:"<?php echo base_url('employee/Employees/EmployeePayment/')?>",
    method:'post',
    dataType:'json',
    data:{
     'sal_id':sal_id,
     'employee_id':employee_id,
     'totalamount':TotalSalary,
    },
    success:function(data){
 document.getElementById('employee_name').value= data.Ename;
 document.getElementById('employee_id').value  = data.employee_id;
 document.getElementById('salType').value      = salpayid;
 document.getElementById('total_salary').value = TotalSalary;
 document.getElementById('total_working_minutes').value = WorkHour;
 document.getElementById('working_period').value = Period;
   $("#PaymentMOdal").modal('show');
    },
    error:function(jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }

    });
}
</script>
<script type="text/javascript">

    function bank_paymet(val){
        if(val==2){
           var style = 'block'; 
           
        }else{
   var style ='none';
   
        }
           
    document.getElementById('bank_div').style.display = style;
    }
    
</script>