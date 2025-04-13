<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">

            <?php echo  form_open('employee/employees_performance/update_category_wise_performance/'. $data->id) ?>
            

                <input name="id" type="hidden" value="<?php echo $data->id ?>">
             
                <div class="form-group row">
                    <label for="employee_id" class="col-sm-2 col-form-label"><?php echo display('employee_name') ?> *</label>
                    <div class="col-sm-4">
                       <?php echo form_dropdown('employee_id',$employee,$data->employee_id,'class="form-control employee_id_perfm_f" id="employee_id" disabled') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sub_cat_id" class="col-sm-2 col-form-label"><?php echo display('sub_category') ?> *</label>
                    <div class="col-sm-4">
                       <?php echo form_dropdown('sub_cat_id',$paerform_sub_category_list,$data->sub_cat_id,'class="form-control" id="sub_category_id" disabled') ?>
                    </div>
                </div>

                <br>

                <div class="form-group row">
                    <label for="points" class="col-sm-2 col-form-label"><?php echo display('score') ?> *</label>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-10">
                                <input type="range" id="point_bar" name="points" min="0" max="100" oninput="updateTextInput(this.value);" value="<?php echo $data->points?$data->points:0?>" required>
                            </div>
                            <div class="col-sm-2">
                                <span id="textInput"><?php echo $data->points?$data->points:0?></span>
                            </div>
                            
                        </div>
                    </div>
                </div>

                 <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4 text-right">
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                    </div>
                </div>

            <?php echo form_close() ?>


            </div>  
        </div>
    </div>
</div>
     