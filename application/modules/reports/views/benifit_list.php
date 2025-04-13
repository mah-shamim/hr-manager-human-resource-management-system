<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">

                    <div class="panel-heading">
                      <div class="panel-title">
                          <h4>
                          </h4>
                      </div>
                    </div>

                    <div class="panel-body">
                       
                      <div class="row">     
                           
                    
                     <div class="form-group row">
                        <?php echo form_open('reports/Employee_controller/benifit_list',array('class' => 'form-inline', 'id' => 'validate'));?>
                         <label class="select col-sm-2"><?php echo display('search') ?>:</label>
                         <div class="col-sm-4">
                             <?php echo form_dropdown('employee_id', $dropdownemp, (!empty($id)?$id:" "), ' class="form-control"') ?> 
                         </div>
                         <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary"><?php echo display('search') ?></button>
                            <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printData();"/>
                         </div>
                       <?php echo form_close()?>
                     </div>
                        
                           
                     </div>
                    </div>
                </div>

            </div>
        </div>


<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

            <div class="panel-heading">
              <div class="panel-title">
                  <h4>
                    <?php echo display('benifit_info')?>
                  </h4>
              </div>
            </div>

            <div class="panel-body" id="printArea">
              <div class="table-responsive">
                <table width="100%" class="table table-bordered table-hover" border="1" cellspacing="0" cellpadding="6">
                    <thead>
                        <tr>
                           <th><?php echo display('cid') ?></th>
                           <th><?php echo display('name')?></th>
                           <th><?php echo display('benifit_class_code')?></th>
                           <th><?php echo display('benifit_desc')?></th>
                           <th><?php echo display('benifit_acc_date')?></th>
                           <th><?php echo display('benifit_sta')?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($emp_positinal)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($emp_positinal as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                <td><a href="<?php echo base_url("employee/Employees/cv/$row->employee_id");?>" ><?php echo $row->first_name.' '.$row->last_name; ?></a></td>
                                <td><?php echo $row->bnf_cl_code; ?></td>
                                <td><?php echo $row->bnf_cl_code_des; ?></td>
                                <td><?php echo $row->bnff_acural_date; ?></td>
                                <td><?php 
                                  if($row->bnf_status ==1){
                                    echo 'Active';
                                  }else{
                                    echo 'Inactive';
                                  }
                                 ?></td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                 <?php echo  $links ?>
               </div>
            </div>
        </div>
    </div>
</div>
