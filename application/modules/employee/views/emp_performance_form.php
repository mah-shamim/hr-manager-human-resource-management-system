<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >
                <div class="panel-title">
                    <h4><?php echo display('employee_performance') ?></h4>
                </div>
                <div class="mr-25">

                    <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Add Performance</button> 
                    <a href="<?php echo base_url();?>/employee/Employees/emp_performance_view" class="btn btn-primary">Manage Performance</a>


                </div>

            </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                                    <th><?php echo display('Sl') ?></th>
                                    <th>Employee Name</th>
                                    <th><?php echo display('employee_id') ?></th>
                                    <th><?php echo display('note') ?></th>
                                    <th><?php echo display('date') ?></th>
                                    <th><?php echo display('note_by') ?></th>
                                    <th><?php echo display('score') ?></th>
                                  
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($emp_perform)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($emp_perform as $que) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo $que->first_name.' '.$que->last_name; ?></td>
                                        <td><?php echo $que->employee_id; ?></td>
                                        <td><?php echo $que->note; ?></td>
                                        <td><?php echo $que->date; ?></td>
                                        <td><?php echo $que->note_by; ?></td>
                                        <td><?php echo $que->score; ?></td>
                                       
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

<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('employee_performance')?></strong>
            </div>
            <div class="modal-body">
           

   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                        
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo  form_open_multipart('employee/Employees/create_emp_performance') ?>
                     
                        <div class="form-group row">
                            <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> *</label>
                            <div class="col-sm-9">
                               <?php echo form_dropdown('employee_id',$employee,null,'class="form-control employee_id_perfm_f" id="employee_id"') ?>
                            </div>
                            </div>

                            <div class="form-group row">
                             <label for="date" class="col-sm-3 col-form-label"><?php echo display('date') ?> </label>
                            <div class="col-sm-9">
                                <input name="date" class="datepicker form-control" type="text" placeholder="<?php echo display('date') ?>" id="date">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="note" class="col-sm-3 col-form-label"><?php echo display('note') ?> </label>
                            <div class="col-sm-9">
                                <textarea name="note" class="form-control"  placeholder="<?php echo display('note') ?>" id="note"></textarea>
                            </div>
                        </div>

                        <br>

                        <div class="form-group row">
                            <label for="score" class="col-sm-3 col-form-label"><?php echo display('score') ?> *</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <input type="range" id="point_bar" name="score" min="0" max="100" oninput="updateTextInput(this.value);" value="0" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <span id="textInput">0</span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div> 

                        <div class="form-group row">
                            
                        </div> 
                    
              <div class="form-group form-group-margin text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5" ><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5" id="sbmt" data-toggle="modal" data-target="#myModal"><?php echo display('ad') ?></button>
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