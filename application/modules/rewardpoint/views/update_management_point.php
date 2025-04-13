<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">

                <?php echo  form_open('rewardpoint/rewardpoints/update_management_point/'.$data->id) ?>

               <input name="id" type="hidden" value="<?php echo $data->id ?>">
               
                <div class="form-group row">
                  <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> *</label>
                  <div class="col-sm-9">
                   <?php echo form_dropdown('employee_id',$employee,(!empty($data->employee_id)?$data->employee_id:null),'class="form-control" id="employee_id"') ?>
                 </div>
               </div>

               <div class="form-group row">
                  <label for="point_category" class="col-sm-3 col-form-label"><?php echo display('point_category') ?> *</label>
                  <div class="col-sm-9">
                   <?php echo form_dropdown('point_category',$point_categories,(!empty($data->point_category)?$data->point_category:null),'class="form-control" id="point_category"') ?>
                 </div>
               </div>

               <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label"><?php echo display('description') ?> *</label>
                    <div class="col-sm-9">
                        <textarea  name="description" placeholder="<?php echo display('description') ?>" class=" form-control"><?php echo $data->description;?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="point" class="col-sm-3 col-form-label"><?php echo display('point') ?> *</label>
                    <div class="col-sm-9">
                        <input name="point" class="form-control" type="number" placeholder="<?php echo display('point') ?>" id="point" value="<?php echo $data->point;?>">
                    </div>
                </div>

                <input name="previous_point" type="hidden" value="<?php echo $data->point ?>">
                
                <div class="form-group form-group-margin text-right">
                    
                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                </div>

                <?php echo form_close() ?>


        </div>  
    </div>
</div>
</div>
