<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo $title; ?></strong>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                           
                            <div class="panel-body">

                                <?php echo  form_open('payroll/Salary_advance/create_salary_advance') ?>

                                    <div class="form-group row">
                                        <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> *</label>
                                        <div class="col-sm-9">
                                           <?php echo form_dropdown('employee_id',$employee,null,'class="form-control employee_id_perfm_f" id="employee_id" required') ?>
                                        </div>
                                    </div>

                                    <!-- <br> -->

                                    <div class="form-group row">
                                        <label for="amount" class="col-sm-3 col-form-label"><?php echo display('amount') ?><?php if(!empty($setting->currency_symbol)){echo '('.$setting->currency_symbol.')';}?> *</label>
                                        <div class="col-sm-9">
                                            <input type="number" id="amount" name="amount" class="form-control" placeholder="<?php echo display('amount') ?><?php if(!empty($setting->currency_symbol)){echo '('.$setting->currency_symbol.')';}?>" required>
                                        </div>
                                    </div>

                                    <!-- <br> -->

                                    <div class="form-group row">
                                        <label for="salary_month" class="col-sm-3 col-form-label"><?php echo display('salary_month') ?> *</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="salary_month" name="salary_month" class="form-control  monthYearPicker" placeholder="<?php echo display('salar_month') ?>" required>
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
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                        <h4><?php echo $title; ?></h4>
                    </div>
                    <div class="mr-25">

                        <?php if($this->permission->check_label('salary_advance')->create()->access()): ?>

                            <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <?php echo display('add_salary_advance')?></button> 

                        <?php endif; ?>

                        <?php if($this->permission->check_label('salary_advance')->read()->access()): ?>

                            <a href="<?php echo base_url();?>/payroll/Salary_advance/manage_salary_advance" class="btn btn-primary"><?php echo display('manage_salary_advance')?></a>

                        <?php endif; ?>


                    </div>

                </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('employee_name') ?></th>
                            <th><?php echo display('amount') ?></th>
                            <th><?php echo display('release_amount') ?></th>
                            <th><?php echo display('salary_month') ?></th>
                            <th><?php echo display('create_date') ?></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($salary_adv_list)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($salary_adv_list as $salary_adv) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $salary_adv->first_name.' '.$salary_adv->last_name; ?></td>
                                    <td><?php echo $setting->currency_symbol.' '.$salary_adv->amount; ?></td>
                                    <td><?php echo $setting->currency_symbol.' ';?><?php echo $salary_adv->release_amount > 0 ? $salary_adv->release_amount : 0; ?></td>
                                    <td><?php echo $salary_adv->salary_month; ?></td>
                                    <td><?php echo $salary_adv->CreateDate; ?></td>
                                    
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


<script src="<?php echo base_url('assets/js/payroll.js') ?>" type="text/javascript"></script>