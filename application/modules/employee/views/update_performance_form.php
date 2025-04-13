
   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('update') ?></h4>
                    </div>
                </div>
                <div class="panel-body">

                <?php echo  form_open('employee/Employees/update_emp_performance_form/'. $data->emp_per_id) ?>
                

                    <input name="emp_per_id" type="hidden" value="<?php echo $data->emp_per_id ?>">
                 
                         <div class="form-group row">
                            <label for="employee_id" class="col-sm-2 col-form-label"><?php echo display('employee_name') ?> </label>
                            <div class="col-sm-4">
                                
                                  <?php echo form_dropdown('employee_id',$employee,(!empty($data->employee_id)?$data->employee_id:null),'class="form-control" id="employee_id"') ?>
                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="note" class="col-sm-2 col-form-label"><?php echo display('note') ?></label>
                            <div class="col-sm-4">
                                <input type="text" name="note" class="form-control" id="note" value="<?php echo $data->note?>">
                            </div>
                        </div> 

                       <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label"><?php echo display('date') ?> </label>
                            <div class="col-sm-4">
                                <input type="text" name="date" class="form-control datepicker" id="date" value="<?php echo $data->date?>">
                            </div>
                        </div> 
                         <div class="form-group row">
                            <label for="note_by" class="col-sm-2 col-form-label"><?php echo display('note_by') ?> </label>
                            <div class="col-sm-4">
                                <input type="text" name="note_by" class="form-control" id="note_by" value="<?php echo $data->note_by?>">
                            </div>
                        </div> 
                        
                        <br>

                        <div class="form-group row">
                            <label for="score" class="col-sm-2 col-form-label"><?php echo display('score') ?> *</label>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <input type="range" id="point_bar" name="score" min="0" max="100" oninput="updateTextInput(this.value);" value="<?php echo $data->score?$data->score:0?>" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <span id="textInput"><?php echo $data->score?$data->score:0?></span>
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
