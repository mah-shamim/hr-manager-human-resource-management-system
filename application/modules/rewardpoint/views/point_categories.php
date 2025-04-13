
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php if(!empty($pointcategoryinfo->id)){echo  display('update_point_category');}else{ echo  display('add_point_category');} ?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                    <div class="col-sm-5">
                        <h3><center><?php if(!empty($pointcategoryinfo->id)){echo  display('update_point_category');}else{ echo  display('add_point_category');}?></center></h3>
                        <?php echo  form_open('rewardpoint/rewardpoints/point_categories') ?>
                            <?php echo form_hidden('id', (!empty($pointcategoryinfo->id)?$pointcategoryinfo->id:null)) ?>

                            <div class="form-group row">
                                <label for="point_category" class="col-sm-3 col-form-label"><?php echo display('point_category') ?> *</label>
                                <div class="col-sm-9">
                                    <input name="point_category" class="form-control" type="text" placeholder="<?php echo display('point_category') ?>" id="point_category" value="<?php echo (!empty($pointcategoryinfo->point_category)?$pointcategoryinfo->point_category:null) ?>" autocomplete="off" required >
                                </div>
                            </div> 
                         
                            <div class="form-group form-group-margin text-right">
                                <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                <button type="submit" class="btn btn-success w-md m-b-5"><?php
                                echo (!empty($pointcategoryinfo->id)?display('update'):display('save'))  ?></button>
                            </div>
                        <?php echo form_close() ?>
                        </div>

                    <div class="col-sm-7">
                        <h3><center><?php echo  display('point_categories')?></center></h3>
                        <table width="100%" id="datatable1" class=" table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                   <th><?php echo display('cid') ?></th>
                                    <th><?php echo display('point_category') ?></th>
                                   <th><?php echo display('action') ?></th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($point_categories)) { ?>
                                    <?php $sl = 1; ?>
                                    <?php foreach ($point_categories as $row) { ?>
                                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                            <td><?php echo $sl; ?></td>
                                       <td><?php echo $row->point_category; ?></td>
                                        
                                                                   
                                           <td class="center">
                                          
                                            <?php if($this->permission->check_label('point_categories')->update()->access()): ?>
                                                <a href="<?php echo base_url("rewardpoint/rewardpoints/point_categories/$row->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                                <?php endif; ?>
                                            
                                            <?php if($this->permission->check_label('point_categories')->delete()->access()): ?>  
                                                <a href="<?php echo base_url("rewardpoint/rewardpoints/delete_point_category/$row->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
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

