<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('perform_sub_category') ?></strong>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                           
                            <div class="panel-body">

                                <?php echo  form_open('employee/Employees_performance/create_performance_sub_category') ?>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> *</label>
                                        <div class="col-sm-9">
                                            <input name="name" class="form-control" type="text" placeholder="<?php echo display('name') ?>" id="name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="details" class="col-sm-3 col-form-label"><?php echo display('details') ?></label>
                                        <div class="col-sm-9">
                                            <textarea name="details" class="form-control"  placeholder="<?php echo display('details') ?>" id="details" ></textarea>
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
                        <?php echo display('add_sub_category')?></button> 
                        <a href="<?php echo base_url();?>/employee/employees_performance/manage_performance_sub_category" class="btn btn-primary"><?php echo display('manage_sub_category')?></a>


                    </div>

                </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('name') ?></th>
                            <th><?php echo display('details') ?></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($perform_sub_categories)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($perform_sub_categories as $sub_cat) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $sub_cat->name; ?></td>
                                    <td><?php echo $sub_cat->details; ?></td>
                                    
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

     
