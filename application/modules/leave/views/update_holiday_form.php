
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo (!empty($title)?$title:null) ?></h4>
                    </div>
                </div>
                <div class="panel-body">

                <?php echo  form_open('leave/Leave/update_holiday_form/'. $data->payrl_holi_id) ?>
                

                    <input name="payrl_holi_id" type="hidden" value="<?php echo $data->payrl_holi_id ?>">
                 
                         <div class="form-group row">
                            <label for="holiday_name" class="col-sm-3 col-form-label"><?php echo display('holiday_name') ?> *</label>
                            <div class="col-sm-9">
                                <input type="text" name="holiday_name" class="form-control" id="holiday_name" value="<?php echo $data->holiday_name?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-sm-3 col-form-label"><?php echo display('start_date') ?> *</label>
                            <div class="col-sm-9">
                                <input type="text" name="start_date" class="dp form-control" id="start_date" value="<?php echo $data->start_date?>">
                            </div>
                        </div> 

                       <div class="form-group row">
                            <label for="end_date" class="col-sm-3 col-form-label"><?php echo display('end_date') ?> *</label>
                            <div class="col-sm-9">
                                <input type="text" name="end_date" class="dp form-control" id="end_date" value="<?php echo $data->end_date?>">
                            </div>
                        </div> 
                         <div class="form-group row">
                            <label for="no_of_days" class="col-sm-3 col-form-label"><?php echo display('no_of_days') ?> *</label>
                            <div class="col-sm-9">
                                <input type="text" name="no_of_days" class="form-control" id="no_of_days" value="<?php echo $data->no_of_days?>" readonly>
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
       <script src="<?php echo base_url('assets/js/leave.js') ?>" type="text/javascript"></script>
