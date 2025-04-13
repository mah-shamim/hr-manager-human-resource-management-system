
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">

                    <button type="button" class="btn btn-success my-modal pull-right" onclick="add_role()" >
                      <?php echo display('add_role')?>
                    </button>

                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
 
                    <table class="table table-bordered table-hover" id="RoleTbl">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('role_name') ?></th>
                                <th><?php echo display('description') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($role_list)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($role_list as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $value->role_name; ?></td>
                                <td><?php echo $value->role_description; ?></td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="edit('<?php echo $value->role_id?>')" data-toggle="tooltip" data-placement="left" title="Update"  ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="<?php echo base_url("dashboard/role/delete_role/$value->role_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>


            </div>
        </div>
    </div>
</div>




<div class="modal fade"  tabindex="-1" role="dialog" id="modal_form" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $title?></h4>
            </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div id="resultmsg" class="col-sm-9 col-sm-offset-3"></div>
                    </div>
                   
                        <?php echo form_open("#", array("id" => "MyForm")); ?>

                        <div class="form-group row">
                            <label for="role_name" class="col-xs-3 col-form-label"><?php echo display('role_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <input name="role_name" type="text" class="form-control" id="role_name" placeholder="<?php echo display('role_name') ?>"  >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role_description" class="col-xs-3 col-form-label"><?php echo display('description') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <textarea class="form-control" rows="4" name="role_description" id="role_description"></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="role_id">

                <!-- </form>  -->
                <?php echo form_close(); ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary save_btn save" data-action='save' onclick="save()"></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo display('close')?></button>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url('application/modules/dashboard/assets/js/rolescript.js'); ?>" type="text/javascript"></script>



 