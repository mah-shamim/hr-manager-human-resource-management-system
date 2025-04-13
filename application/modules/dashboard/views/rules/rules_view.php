<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                        <h4><?php echo display('rules') ?></h4>
                    </div>
                    <div class="mr-25">

                        <?php if($this->permission->method('rule','read')->access()): ?>  
                            <a href="<?php echo base_url();?>/dashboard/rules/" class="btn btn-primary"><?php echo display('rules_list')?></a>
                        <?php endif; ?>


                    </div>

             </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('name') ?></th>
                            <th><?php echo display('type') ?></th>
                            <th><?php echo display('percent') ?></th>
                            <th><?php echo display('fixed') ?></th>
                            <th><?php echo display('start_time') ?></th>
                            <th><?php echo display('end_time') ?></th>
                            <th><?php echo display('action') ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rules)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($rules as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->type; ?></td>
                                    <td><?php echo $row->percent; ?></td>
                                    <td><?php echo $row->fixed; ?></td>
                                    <td><?php echo $row->start_time; ?></td>
                                    <td><?php echo $row->end_time; ?></td>
                                    <td>

                                        <a href="<?php echo base_url("dashboard/rules/update_rule_form/$row->rule_id ") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>

                                        <a href="<?php echo base_url("dashboard/rules/delete_rule/$row->rule_id ") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>

                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
 
 
 <div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><strong><h4><i class='fa fa-university' aria-hidden='true'></i>Department Form</h4></strong></center>
            </div>
            <div class="modal-body">
               
    
   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                       
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo  form_open('dashboard/rules/create_rule'); ?>
                   
                       <div class="form-group row">
                           
                            <label for="department_name" class="col-sm-3 col-form-label">
                            <?php echo display('department_name') ?></label>
                            <div class="col-sm-9">
                           <input type="text" name="department_name" class=" form-control" placeholder="<?php echo display('department_name') ?>">
                               
                            </div>
                           
                        </div>
                       
                        
             
                        <div class="form-group form-group-margin text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
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


