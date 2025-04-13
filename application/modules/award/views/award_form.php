<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

            <div class="panel-heading panel-aligner" >

                <div class="panel-title">
                    <h4><?php echo display('award') ?></h4>
                </div>

                <div class="mr-25">

                 <?php if($this->permission->check_label('new_award')->create()->access()): ?>
                <button type="button" class="btn btn-primary btn-md" data-target="#add" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                <?php echo display('add_new_award') ?></button> 
                <?php endif; ?>

                 <?php if($this->permission->check_label('new_award')->read()->access()): ?>
                <a href="<?php echo base_url();?>/award/Award_controller/award_view" class="btn btn-primary"><?php echo display('manage_award') ?></a>
                <?php endif; ?>
                </div>

            </div>

            <div class="panel-body">
                <div class="table-responsive">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('award_name') ?></th>
                            <th><?php echo display('aw_description') ?></th>
                            <th><?php echo display('awr_gift_item') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('employee_name') ?></th>
                            <th><?php echo display('awarded_by') ?></th>
                           
                           
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($mang)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($mang as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->award_name; ?></td>
                                <td><?php   $text=$row->aw_description;

                    $pieces = substr($text, 0, 20);
                    $ps = substr($pieces, 0, 16)."...";
                    $cn=strlen($text);
                    if ($cn>20) {
                      echo $ps;
                    }else
                    {
                    echo $text;
                    }
                                ?></td>
                                <td><?php echo $row->awr_gift_item; ?></td>
                                
                                <td><?php echo $row->date; ?></td>
                                <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                <td><?php echo $row->awarded_by; ?></td>
                                
                                                           
                                   
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
</div>
 
 
 <div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><strong><h4><i class='fa fa-trophy' aria-hidden='true'></i>Award Form</h4></strong></center>
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

                    <?php echo  form_open_multipart('award/Award_controller/create_award') ?>
                   
                       <div class="form-group row">
                           
                            <label for="award_name" class="col-sm-3 col-form-label">
                            <?php echo display('award_name') ?></label>
                            <div class="col-sm-9">
                           <input type="text" name="award_name" placeholder="<?php echo display('award_name') ?>" class=" form-control">
                               
                            </div>
                           
                        </div>
                        <div class="form-group row">
                           
                            <label for="aw_description" class="col-sm-3 col-form-label">
                            <?php echo display('aw_description') ?></label>
                            <div class="col-sm-9">
                           <textarea  name="aw_description" placeholder="<?php echo display('aw_description') ?>" class=" form-control"></textarea>
                               
                            </div>
                           
                        </div>
                         <div class="form-group row">
                           
                            <label for="awr_gift_item" class="col-sm-3 col-form-label">
                            <?php echo display('awr_gift_item') ?></label>
                            <div class="col-sm-9">
                           <input type="text" name="awr_gift_item" placeholder="<?php echo display('awr_gift_item') ?>" class=" form-control" id="awr_gift_item">
                               
                            </div>
                           
                        </div>
                     
                         <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label">
                            <?php echo display('date') ?></label>
                            <div class="col-sm-9">
                           <input type="text" name="date" placeholder=" <?php echo display('date') ?>" id="date" class="datepicker form-control">
                               
                            </div>
                            </div>
                         <div class="form-group row">
                           
                            <label for="employee_id" class="col-sm-3 col-form-label">
                            <?php echo display('employee_name') ?></label>
                            <div class="col-sm-9">
                            <?php echo form_dropdown('employee_id',$dropdown,null,'class="form-control codeigniterselect"') ?>
                               
                            </div>
                           
                        </div>
                        <div class="form-group row">
                           
                            <label for="awarded_by" class="col-sm-3 col-form-label">
                            <?php echo display('awarded_by') ?></label>
                            <div class="col-sm-9">
                           <input type="text" name="awarded_by" class=" form-control">
                               
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

