
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                  <div class="panel-heading" >
                    <div class="panel-title">
                        <h4><?php echo display('employee_on_leave') ?></h4>
                        <span id="almsg"></span>
                    </div>
                </div>
                    <div class="panel-body">
                        
                      
                          <?php echo  form_open('reports/leave_report/employee_on_leave','id="form"') ?>
                           <div class="form-group row">
                         
                            <label for="from_date" class="col-sm-3 col-form-label"><?php echo display('from_date') ?> *</label>
                            <div class="col-sm-4">
                              <input type="text" name="from_date" placeholder="<?php echo display('from_date') ?>" value="<?php echo (!empty($from_date)?$from_date:'')?>" class="form-control datepicker">
                            </div>
                        </div> 

                        <div class="form-group row">
                         
                            <label for="to_date" class="col-sm-3 col-form-label"><?php echo display('to_date') ?> *</label>
                            <div class="col-sm-4">
                              <input type="text" name="to_date" class="form-control datepicker" value="<?php echo (!empty($to_date)?$to_date:'')?>" placeholder="<?php echo display('to_date') ?>">
                            </div>
                        </div> 
                          
                          <div class="form-group row">
                          <label for="department" class="col-sm-3 col-form-label"><?php echo display('department')?>*</label>
                          <div class="col-sm-4">
                           <?php echo form_dropdown('department_id', $departments, $department_id, ' class="form-control" id="department_id"') ?>
                          </div>
                          

                        </div>

                       <div class="form-group row">
                         
                            <label for="leave_type" class="col-sm-3 col-form-label"><?php echo display('leave_type') ?> *</label>
                            <div class="col-sm-4">
                              <?php echo form_dropdown('leave_type',$leave,$leavtype,'class="form-control" id="leave_type" ') ?>
                            </div>
                        </div> 

                       

                     <div class="form-group row">
                          <div class="col-sm-8 text-center">
                            <button type="submit"  class="btn btn-success w-md m-b-5"><?php echo display('search') ?></button>
                        </div>
                     </div>
                         <?php echo form_close() ?>

                    </div>
                </div>

            </div>
        </div>

       <?php  if($issearch){?>
     <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="panel ">
                <div class="panel-heading" >
                    <div class="panel-title">
                        <span class="text-left"><?php echo display('employee_on_leave') ?></span> <span class="text-right"><input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/></span>
                    </div>
                </div>
                <div class="panel-body" id="printArea">
                  <table class="table table-responsive table-hover">
                    <thead class="tableheads">
                      <tr>
                        <th class="text-center">sl</th>
                        <th class="text-center">Employee Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Leave Type</th>
                        <th class="text-center">Start Date</th>
                        <th class="text-center">End Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($results)){?>
                            <tr><td colspan="7" class="text-center"> No Result Found </td></tr>
                        <?php }else{
                            $sl = 1;
                            $i = 0;
                            foreach ($results as $result) {
                           
                            ?>
                      <tr>
                        <td class="text-center"><?php echo $sl;?></td>
                        <td class="text-center"><?php echo $result['employee_id'];?></td>
                        <td class="text-center"><?php echo $result['first_name'].' '.$result['last_name'];?></td>
                        <td class="text-center"><?php echo $result['department_name'];?></td>
                        <td class="text-center"><?php echo $result['ltype'];?></td>
                        <td class="text-center"><?php echo $result['leave_aprv_strt_date'];?></td>
                        <td class="text-center"><?php echo $result['leave_aprv_end_date'];?></td>

                      </tr>
                      <?php $sl++;$i++;}}?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php }?>