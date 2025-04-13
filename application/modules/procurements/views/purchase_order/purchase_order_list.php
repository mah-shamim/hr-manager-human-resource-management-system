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
                            <th><?php echo display('purchase_order') ?></th>
                            <th><?php echo display('vendor_name') ?></th>
                            <th><?php echo display('location') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('total') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($purchase_orders)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($purchase_orders as $purchase_order) { 
                                ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo 'PO-'.sprintf('%05s', $purchase_order->purchase_order_id); ?></td>
                                    <td><?php echo $purchase_order->vendor_name; ?></td>  
                                    <td><?php echo $purchase_order->location; ?></td>
                                    <td><?php echo $purchase_order->created_date; ?></td>
                                    <td><?php echo $purchase_order->total; ?></td>

                                     <td class="center">
                                  
                                    <?php if($this->permission->check_label('quotation_form')->update()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_purchase_order/purchase_order_update/$purchase_order->purchase_order_id")?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->check_label('quotation_form')->delete()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_purchase_order/delete_purchase_order/$purchase_order->purchase_order_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-close"></i></a>
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
 
 