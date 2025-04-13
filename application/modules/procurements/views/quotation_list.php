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
                            <th><?php echo display('quote') ?></th>
                            <th><?php echo display('name_of_company') ?></th>
                            <th><?php echo display('pin_or_equivalent') ?></th>
                            <th><?php echo display('expected_date_delivery') ?></th>
                            <th><?php echo display('place_of_delivery') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($quotations)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($quotations as $quotation) { 
                                ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo 'QT-'.sprintf('%05s', $quotation->quotation_form_id); ?></td>
                                    <td><?php echo $quotation->name_of_company; ?></td>  
                                    <td><?php echo $quotation->pin_or_equivalent; ?></td>
                                    <td><?php echo $quotation->expected_date_delivery; ?></td>
                                    <td><?php echo $quotation->place_of_delivery; ?></td>
                                    <td><?php echo $quotation->create_date; ?></td>

                                     <td class="center">
                                  
                                    <?php if($this->permission->check_label('quotation_form')->update()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_quotation/quotation_update/$quotation->quotation_form_id ") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->check_label('quotation_form')->delete()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_quotation/delete_quotation/$quotation->quotation_form_id ") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
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
 
 