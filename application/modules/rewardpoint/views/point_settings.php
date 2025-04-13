<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">


                <?php echo form_open_multipart("rewardpoint/rewardpoints/manage_point_settings") ?>
                     <?php echo form_hidden('id', (!empty($point_settings_info->id)?$point_settings_info->id:null)) ?>
                    
                    <div class="form-group row">
                        <label for="general_point" class="col-sm-3 col-form-label">General Point *</label>
                        <div class="col-sm-4">
                            <input name="general_point" class="form-control" type="number" placeholder="General Point" id="general_point" required  value="<?php echo (!empty($point_settings_info->general_point)?$point_settings_info->general_point:null) ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="attendence_point" class="col-sm-3 col-form-label">Collaborative Point Starts*</label>
                        <div class="col-sm-4">
                            <input name="collaborative_start" class="form-control datepicker" data-toggle="tooltip" title="Collaborative point start date must be for a specific month and lesser than end date" type="" placeholder="Collaborative Point Start Day" id="collaborative_start" required value="<?php echo (!empty($point_settings_info->collaborative_start)?$point_settings_info->collaborative_start:null) ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="attendence_point" class="col-sm-3 col-form-label">Collaborative Point Ends *</label>
                        <div class="col-sm-4">
                            <input name="collaborative_end" class="form-control datepicker" data-toggle="tooltip" title="Collaborative point start date must be for a specific month and greater than end date" type="" placeholder="Collaborative Point End Day" id="collaborative_end" required value="<?php echo (!empty($point_settings_info->collaborative_end)?$point_settings_info->collaborative_end:null) ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="attendence_point" class="col-sm-3 col-form-label">Attendance Point *</label>
                        <div class="col-sm-4">
                            <input name="attendence_point" class="form-control" type="number" placeholder="Attendance Point" id="attendence_point" required value="<?php echo (!empty($point_settings_info->attendence_point)?$point_settings_info->attendence_point:null) ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="attendence_start" class="col-sm-3 col-form-label">Start Time *</label>
                        <div class="col-sm-4">
                            <input name="attendence_start" class="form-control timePicker" placeholder="Attendace Start" id="attendence_start" required value="<?php echo (!empty($point_settings_info->attendence_start)?$point_settings_info->attendence_start:null) ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="attendence_end" class="col-sm-3 col-form-label">End Time *</label>
                        <div class="col-sm-4">
                            <input name="attendence_end" class="form-control timePicker" placeholder="Attendace End" id="attendence_end" required value="<?php echo (!empty($point_settings_info->attendence_end)?$point_settings_info->attendence_end:null) ?>">
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <div class="form-group text-right col-sm-7">
                            <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                            <button type="submit"  class="btn btn-success w-md m-b-5">Save</button>
                        </div>
                    </div>
                    
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>

 