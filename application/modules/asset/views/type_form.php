
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <h3><center><?php echo  display('add_type')?></center></h3>
                          <?php echo  form_open('asset/type_controller/type_form') ?>
                    <?php echo form_hidden('type_id', (!empty($typeinfo->type_id)?$typeinfo->type_id:null)) ?>

                    <div class="form-group row">
                        <label for="type_name" class="col-sm-3 col-form-label"><?php echo display('type_name') ?> *</label>
                        <div class="col-sm-9">
                                    <input name="type_name" class="form-control" type="text" placeholder="<?php echo display('type_name') ?>" id="type_name" value="<?php echo (!empty($typeinfo->type_name)?$typeinfo->type_name:null) ?>" autocomplete="off" required >
                        </div>
                    </div> 
                     
                    <div class="form-group form-group-margin text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php
                        echo (!empty($typeinfo->type_id)?display('update'):display('save'))  ?></button>
                    </div>
                <?php echo form_close() ?></div>
                        <div class="col-sm-8">
                            <h3><center><?php echo  display('type_list')?></center></h3>
                                <table width="100%" id="datatable1" class=" table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                           <th><?php echo display('cid') ?></th>
                            <th><?php echo display('type_name') ?></th>
                           <th><?php echo display('action') ?></th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($type)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($type as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                               <td><?php echo $row->type_name; ?></td>
                                
                                                           
                                   <td class="center">
                                    
                                    <?php if($this->permission->check_label('asset_type')->update()->access()): ?>
                                        <a href="<?php echo base_url("asset/Type_controller/type_form/$row->type_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->check_label('asset_type')->delete()->access()): ?>
                                        <a href="<?php echo base_url("asset/Type_controller/delete_type/$row->type_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
                                         <?php endif; ?> 
                                    </td>
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
    </div>
</div>

