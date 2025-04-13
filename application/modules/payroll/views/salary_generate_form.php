
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">

                <div class="panel-heading">
                  <div class="panel-title">
                      <h4>
                        <?php echo display('selectionlist')?>
                      </h4>
                  </div>
                </div>
                
                <div class="panel-body">
                <div class="col-sm-5 col-md-5">
                   
                   
                        <?php echo form_open('payroll/Payroll/create_salary_generate','id="salary_form"')?>
                    
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><?php echo display('salar_month') ?></label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control monthYearPicker" name="name" placeholder="<?php echo display('salar_month') ?>" id="name">
                         
                        
                            </div>
                            </div>
                           
                        <div class="form-group text-center">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('generate') ?></button>
                        </div>
          <?php echo form_close();?>
          </div>
          <div class="col-sm-7 col-md-7">
                  <table width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                            <tr>
                                <th><?php echo display('cid') ?></th>
                                <th><?php echo display('sal_name') ?></th>
                                <th><?php echo display('gdate') ?></th>
                                <th><?php echo display('generate_by') ?></th>
                                <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($salgen)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($salgen as $que) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $que->name; ?></td>
                                    <td><?php echo $que->gdate; ?></td>
                                    <td><?php echo $que->generate_by; ?></td>
                                                                
                                    <td class="center">
                                   
                                    <?php if($this->permission->method('employee','delete')->access()): ?> 
                                        <a href="<?php echo base_url("payroll/Payroll/delete_sal_gen/$que->ssg_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
                                        <?php endif; ?>
                                    </td>
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
    <script src="<?php echo base_url('assets/js/payroll.js') ?>" type="text/javascript"></script>
             
 