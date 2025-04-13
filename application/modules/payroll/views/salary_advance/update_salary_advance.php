<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">

            <?php echo  form_open('payroll/salary_advance/update_salary_advance/'. $data->id) ?>
            

                <input name="id" type="hidden" value="<?php echo $data->id ?>">
             
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> *</label>
                        <div class="col-sm-9">
                            <?php echo form_dropdown('employee_id',$employee,$data->employee_id,'class="form-control employee_id_perfm_f" id="employee_id" disabled') ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label"><?php echo display('amount') ?><?php if(!empty($setting->currency_symbol)){echo '('.$setting->currency_symbol.')';}?> *</label>
                        <div class="col-sm-9">
                            <input type="number" id="amount" name="amount" class="form-control" placeholder="<?php echo display('amount') ?><?php if(!empty($setting->currency_symbol)){echo '('.$setting->currency_symbol.')';}?>" required value="<?php echo $data->amount;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="salary_month" class="col-sm-3 col-form-label"><?php echo display('salary_month') ?> *</label>
                        <div class="col-sm-9">
                            <input type="text" id="salary_month" name="salary_month" class="form-control  monthYearPicker" placeholder="<?php echo display('salar_month') ?>" required value="<?php echo $data->salary_month;?>" disabled>
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

<script src="<?php echo base_url('assets/js/payroll.js') ?>" type="text/javascript"></script>