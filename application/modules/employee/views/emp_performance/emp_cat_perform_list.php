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

                                <?php echo  form_open('employee/Employees_performance/add_performance_by_sub_category') ?>

                                    <div class="form-group row">
                                        <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> *</label>
                                        <div class="col-sm-9">
                                           <?php echo form_dropdown('employee_id',$employee,null,'class="form-control employee_id_perfm_f" id="employee_id" required') ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sub_cat_id" class="col-sm-3 col-form-label"><?php echo display('sub_category') ?> *</label>
                                        <div class="col-sm-9">
                                           <?php echo form_dropdown('sub_cat_id',$paerform_sub_category_list,null,'class="form-control" id="sub_category_id" required') ?>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group row">
                                        <label for="points" class="col-sm-3 col-form-label"><?php echo display('score') ?> *</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <input type="range" id="point_bar" name="points" min="0" max="100" oninput="updateTextInput(this.value);" value="0" required>
                                                </div>
                                                <div class="col-sm-2">
                                                    <span id="textInput">0</span>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div> 


                                    <div class="form-group form-group-margin text-right">
                                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
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
                        <h4><?php echo display('perform_sub_category') ?></h4>
                    </div>
                    <div class="mr-25">

                      <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <?php echo display('add_category_wise_performance')?></button> 
                        <a href="<?php echo base_url();?>/employee/employees_performance/manage_category_wise_performance_view" class="btn btn-primary"><?php echo display('manage_category_wise_performance')?></a>


                    </div>

                </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('employee_name') ?></th>
                            <th><?php echo display('sub_category') ?></th>
                            <th><?php echo display('score') ?></th>
                            <th><?php echo display('date') ?></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($category_wise_performances)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($category_wise_performances as $cat_perfrm) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $cat_perfrm->first_name.' '.$cat_perfrm->last_name; ?></td>
                                    <td><?php echo $cat_perfrm->perform_category_name; ?></td>
                                    <td><?php echo $cat_perfrm->points; ?></td>
                                    <td><?php echo $cat_perfrm->CreateDate; ?></td>
                                    
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

     
<script type="text/javascript">
    
    function updateTextInput(val) {
      $('#textInput').text(val);
    }

</script>