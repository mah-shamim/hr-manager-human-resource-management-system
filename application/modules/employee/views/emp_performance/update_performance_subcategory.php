<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">

            <?php echo  form_open('employee/employees_performance/update_performance_sub_category/'. $data->id) ?>
            

                <input name="id" type="hidden" value="<?php echo $data->id ?>">
             
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> *</label>
                        <div class="col-sm-9">
                            <input name="name" class="form-control" type="text" value="<?php echo $data->name ; ?>" id="position_name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="details" class="col-sm-3 col-form-label"><?php echo display('details') ?></label>
                        <div class="col-sm-9">
                            <textarea name="details" class="form-control" id="details"><?php echo $data->details?></textarea>
                            
                        </div>
                    </div> 

                   
 
         
                    <div class="form-group form-group-margin text-right">
                        
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                    </div>

                <?php echo form_close() ?>


            </div>  
        </div>
    </div>
</div>
     