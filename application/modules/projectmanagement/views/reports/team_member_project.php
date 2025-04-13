
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php echo display('pm_reports') ?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo  form_open_multipart('projectmanagement/pm_project_reports/employee_project_tasks') ?>
                <div class="row" id="">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('team_member')?></label>
                            <div class="col-sm-8">

                                <select name="employee_id" id="employee_id" class="form-control"  required="">
                                    <option value=""> Select Team Member</option>
                                    <?php if ($project_all_employees_list) { ?>
                                      <?php foreach($project_all_employees_list as $key => $value){?>
                                        <option value="<?php echo $key; ?>"><?php echo $value;?></option>
                                        
                                    <?php }} ?>
                                </select>

                            </div>
                        </div>

                        <input type="hidden" name="csrftoken" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrftoken">
                        
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('projects')?></label>
                            <div class="col-sm-8">
                                <select name="project_id" class="form-control" id="project_id">

                                </select>
                            </div>
                        </div>

                        <div class="form-group form-group-margin text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('find') ?></button>
                            <input type="hidden" name="" id="base_url" value="<?php echo base_url();?>">
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo MOD_URL.'projectmanagement/assets/js/team_member.js'; ?>" type="text/javascript"></script>