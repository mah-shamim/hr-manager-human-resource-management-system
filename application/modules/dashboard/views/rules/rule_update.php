<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="panel-title">
                       <h4>
                        <?php echo display('add_division')?>
                      </h4>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="row">

                        <div class="col-sm-6">

                            <?php echo  form_open('dashboard/rules/update_rule/'.(!empty($rule->rule_id)?$rule->rule_id:null)) ?>
                                <?php echo form_hidden('rule_id', (!empty($rule->rule_id)?$rule->rule_id:null)) ?>
                  
                                <div class="form-group row">
                                    <label for="type" class="col-sm-3 col-form-label"><?php echo display('type') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                       
                                        <input type="text" name="type" class=" form-control" readonly value="<?php echo $rule->type;?>">

                                    </div>
                                </div> 


                                <!-- Start of basic salary, allowance, tax, attendance time input  -->

                                <?php if($rule->type == "basic"){?>

                                <div class="form-group row" id="basic_amount">
                                    <label for="basic" class="col-sm-3 col-form-label">
                                    <?php echo display('basic') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="number" name="basic" class=" form-control" placeholder="<?php echo display('basic') ?>" id="basic_a" value="<?php echo $rule->fixed;?>">
                                    </div> 
                                </div>

                                <?php }?>

                                <?php if($rule->type == "tax"){?>

                                <div class="form-group row" id="percent">
                                    <label for="percent" class="col-sm-3 col-form-label">
                                    <?php echo display('percent') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="number" name="percent" class=" form-control" placeholder="<?php echo display('percent') ?>" id="prcnt" value="<?php echo $rule->percent;?>">
                                    </div> 
                                </div>

                                <?php }?>

                                <?php if($rule->type == "allowance"){?>

                                <div class="form-group row" id="allowance_amount">
                                    <label for="allowance_amount" class="col-sm-3 col-form-label">
                                    <?php echo display('allowance') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="number" name="allowance_amount" class=" form-control" placeholder="<?php echo display('allowance') ?>" id="allowance_a" value="<?php echo $rule->fixed;?>">
                                    </div> 
                                </div>

                                <?php }?>

                                <?php if($rule->type == "time"){?>

                                <div class="form-group row" id="start_time">
                                    <label for="start_time" class="col-sm-3 col-form-label">
                                    <?php echo display('start_time') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="time" name="start_time" class=" form-control" id="start_t" value="<?php echo $rule->start_time;?>">
                                    </div> 
                                </div>

                                <div class="form-group row" id="end_time">
                                    <label for="end_time" class="col-sm-3 col-form-label">
                                    <?php echo display('end_time') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="time" name="end_time" class=" form-control" id="end_t" value="<?php echo $rule->end_time;?>">
                                    </div> 
                                </div>

                                <?php }?>

                                <!-- End of basic salary, allowance, tax, attendance time input  -->

                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">
                                    <?php echo display('name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class=" form-control" placeholder="<?php echo display('name') ?>" required value="<?php echo $rule->name;?>">
                                    </div> 
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label">
                                    <?php echo display('description') ?></label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class=" form-control" placeholder="<?php echo display('description') ?>"><?php echo $rule->description;?></textarea>
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
