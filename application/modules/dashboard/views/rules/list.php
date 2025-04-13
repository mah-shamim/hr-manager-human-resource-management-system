<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                        <h4><?php echo display('rules') ?></h4>
                    </div>
                    <div class="mr-25">

                       <?php if($this->permission->method('rule','create')->access()): ?>  
                        <button type="button" class="btn btn-primary btn-md" data-target="#add" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <?php echo display('add_new_rule')?></button> 
                        <?php endif; ?>
                         <?php if($this->permission->method('rule','read')->access()): ?>  
                        <a href="<?php echo base_url();?>/dashboard/rules/rules_view" class="btn btn-primary"><?php echo display('manage_rules')?></a>
                        <?php endif; ?>


                    </div>

             </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('name') ?></th>
                            <th><?php echo display('type') ?></th>
                            <th><?php echo display('percent') ?></th>
                            <th><?php echo display('fixed') ?></th>
                            <th><?php echo display('start_time') ?></th>
                            <th><?php echo display('end_time') ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rules)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($rules as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->type; ?></td>
                                    <td><?php echo $row->percent; ?></td>
                                    <td><?php echo $row->fixed; ?></td>
                                    <td><?php echo $row->start_time; ?></td>
                                    <td><?php echo $row->end_time; ?></td>
                                     
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
 
 
<div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><strong><h4><i class='fa fa-university' aria-hidden='true'></i>Setup Rule Form</h4></strong></center>
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

                                <?php echo  form_open('dashboard/rules/create_rule'); ?>

                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label"><?php echo display('type') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                           
                                            <select name="type" class="form-control"  placeholder="<?php echo display('type') ?>" id="type" required>

                                               <option value="">Select Type</option>
                                               <option value="time">Time</option>
                                               <option value="basic">Basic</option>
                                               <option value="allowance">Allowance</option>
                                               <option value="tax">Tax</option>

                                            </select>

                                        </div>
                                    </div>

                                    <!-- Start of basic salary, allowance, tax, attendance time input  -->

                                    <div class="form-group row" id="basic_amount">
                                        <label for="basic" class="col-sm-3 col-form-label">
                                        <?php echo display('basic') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                            <input type="number" name="basic" class=" form-control" placeholder="<?php echo display('basic') ?>" id="basic_a">
                                        </div> 
                                    </div>

                                    <div class="form-group row" id="percent">
                                        <label for="percent" class="col-sm-3 col-form-label">
                                        <?php echo display('percent') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                            <input type="number" name="percent" class=" form-control" placeholder="<?php echo display('percent') ?>" id="prcnt">
                                        </div> 
                                    </div>

                                    <div class="form-group row" id="allowance_amount">
                                        <label for="allowance_amount" class="col-sm-3 col-form-label">
                                        <?php echo display('allowance') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                            <input type="number" name="allowance_amount" class=" form-control" placeholder="<?php echo display('allowance') ?>" id="allowance_a">
                                        </div> 
                                    </div>

                                    <div class="form-group row" id="start_time">
                                        <label for="start_time" class="col-sm-3 col-form-label">
                                        <?php echo display('start_time') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                            <input type="time" name="start_time" class=" form-control" placeholder="<?php echo display('start_time') ?>" id="start_t">
                                        </div> 
                                    </div>

                                    <div class="form-group row" id="end_time">
                                        <label for="end_time" class="col-sm-3 col-form-label">
                                        <?php echo display('end_time') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                            <input type="time" name="end_time" class=" form-control" placeholder="<?php echo display('end_time') ?>" id="end_t">
                                        </div> 
                                    </div>

                                    <!-- End of basic salary, allowance, tax, attendance time input  -->

                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">
                                        <?php echo display('name') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class=" form-control" placeholder="<?php echo display('name') ?>" required>
                                        </div> 
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 col-form-label">
                                        <?php echo display('description') ?></label>
                                        <div class="col-sm-9">
                                            <textarea name="description" class=" form-control" placeholder="<?php echo display('description') ?>"></textarea>
                                        </div> 
                                    </div>
                         
                                    <div class="form-group form-group-margin text-right">
                                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
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

<script src="<?php echo MOD_URL.'dashboard/assets/js/rules_list.js'; ?>" type="text/javascript"></script>