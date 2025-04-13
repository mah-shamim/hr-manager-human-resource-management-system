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
                            <th><?php echo display('good_received') ?></th>
                            <th><?php echo display('vendor_name') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('total') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($good_received)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($good_received as $good_receive) { 
                                ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo 'GR-'.sprintf('%05s', $good_receive->good_received_id ); ?></td>
                                    <td><?php echo $good_receive->vendor_name; ?></td>
                                    <td><?php echo $good_receive->created_date; ?></td>
                                    <td><?php echo $good_receive->grand_total; ?></td>

                                     <td class="center">
                                  
                                    <?php if($this->permission->check_label('quotation_form')->read()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_good_received/good_received_view/$good_receive->good_received_id")?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->check_label('quotation_form')->delete()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_good_received/delete_good_received/$good_receive->good_received_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-close"></i></a>
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
 
 