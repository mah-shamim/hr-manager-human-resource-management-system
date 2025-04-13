<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('vendor_name') ?></th>
                            <th><?php echo display('email') ?></th>
                            <th><?php echo display('city') ?></th>
                            <th><?php echo display('zip') ?></th>
                            <th><?php echo display('state') ?></th>
                            <th><?php echo display('previous_balance') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($vendors)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($vendors as $vendor) { 
                                ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $vendor->vendor_name; ?></td>
                                    <td><?php echo $vendor->email; ?></td>  
                                    <td><?php echo $vendor->city; ?></td>
                                    <td><?php echo $vendor->zip; ?></td>
                                    <td><?php echo $vendor->country; ?></td>
                                    <td><?php echo $vendor->previous_balance; ?></td>

                                     <td class="center">
                                  
                                    <?php if($this->permission->check_label('vendor')->update()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_vendor/vendor_update/$vendor->id ") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>  
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->check_label('vendor')->delete()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_vendor/delete_vendor/$vendor->id ") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
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
 
 