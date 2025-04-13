<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <strong><?php echo display('collaborative_point') ?></strong>
                </div>
            <div class="modal-body">
               

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                <div class="panel">
                    
                    <div class="panel-body">

                        <?php echo  form_open('rewardpoint/rewardpoints/collaborative_point') ?>

                            <div class="form-group row">
                              <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> *</label>
                              <div class="col-sm-9">
                               <?php echo form_dropdown('employee_id',$employee,null,'class="form-control" id="employee_id"') ?>
                             </div>
                           </div>

                            <div class="form-group row">
                                <label for="reason" class="col-sm-3 col-form-label"><?php echo display('reason') ?> *</label>
                                <div class="col-sm-9">
                                    <textarea  name="reason" required placeholder="<?php echo display('reason') ?>" class=" form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="point" class="col-sm-3 col-form-label"><?php echo display('point') ?> *</label>
                                <div class="col-sm-9">
                                    <input name="point" class="form-control" type="number" placeholder="<?php echo display('point') ?>" id="point" value="1" readonly>
                                </div>
                            </div>
                            
                        
                 
                            <div class="form-group form-group-margin text-right">
                                <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
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

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd">

            <div class="panel-heading panel-aligner" >
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
                <div class="mr-25">

                    <?php if($this->permission->check_label('collaborative_point')->create()->access()): ?>
                    <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <?php echo display('add_collaborative_point') ?></button> 
                    <?php endif; ?>
                    <?php if($this->permission->check_label('collaborative_point')->read()->access()): ?>
                    <a href="<?php echo base_url();?>rewardpoint/rewardpoints/collaborative_point_view" class="btn btn-primary"><?php echo display('collaborative_point')?></a>
                    <?php endif; ?>


                </div>

            </div>
            
            <div class="panel-body">
                <table  width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('point_shared_by') ?></th>
                            <th><?php echo display('employee_name') ?></th>
                            <th><?php echo display('point') ?></th>
                            <th><?php echo display('reason') ?></th>
                            <th><?php echo display('date') ?></th>
                             
                          
                        </tr>
                    </thead>

                    <tbody>

                         <?php if (!empty($collaborative_points)) { ?>

                            <?php $sl = 1; ?>
                                <?php foreach ($collaborative_points as $que) { ?>
                                    <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo $que->shared_firstname.' '.$que->shared_lastname; ?></td>  
                                        <td><?php echo $que->received_firstname.' '.$que->received_lastname; ?></td>   
                                        <td><?php echo $que->point; ?></td>
                                        <td><?php echo $que->reason; ?></td>
                                        <td><?php echo $que->create_date; ?></td>                  
                                    </tr>
                                    <?php $sl++; ?>
                                <?php } ?>

                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>