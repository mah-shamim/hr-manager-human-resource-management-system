<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-heading panel-aligner" >
                <div class="panel-title">
                    <h4><?php echo display('opening_balance') ?></h4>
                </div>
                <div class="mr-25">

                    <?php if($this->permission->check_label('opening_balance')->create()->access()): ?>
                    <a href="<?php echo base_url("accounts/accounts/add_opening_balance") ?>" class="btn btn-primary btn-md" ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <?php echo display('create_opening_balance');?></a> 
                    
                    <?php endif; ?> 
                </div>

            </div>
    
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('year') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('account_name') ?></th>
                            <th><?php echo display('subtype') ?></th>
                            <th><?php echo display('debit') ?></th>
                            <th><?php echo display('credit') ?></th>
                            <th><?php echo display('action') ?></th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($openingBalances)) { ?>
                            <?php $sl = 1; $tdebit =0; $tcredit=0;?>
                            <?php foreach ($openingBalances as $row) { $tdebit += $row->Debit ;$tcredit += $row->Credit ; ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC"; ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->yearName ;?> </td> 
                                    <td><?php echo date('d-m-Y', strtotime($row->openDate)); ?></td>              
                                    <td><?php echo $row->HeadName; ?></td> 
                                    <td><?php echo $row->name; ?></td>              
                                    <td><?php echo $setting->currency_symbol. ' '. $row->Debit; ?></td>              
                                    <td><?php echo $setting->currency_symbol. ' '. $row->Credit; ?></td>              
                                                 
                                                  
                                   <td class="center">
                                       <?php if($this->permission->check_label('opening_balance')->update()->access()): ?>
                                        <a href="<?php echo base_url("accounts/accounts/edit_opening_balance/$row->id") ?>" class="btn btn-xs btn-success" ><i class="fa fa-pencil"></i></a> 
                                           <?php endif; ?>

                                        
                                        <?php if($this->permission->check_label('opening_balance')->delete()->access()): ?>  
                                             <a href="<?php echo base_url("accounts/accounts/delete_opening_balance/$row->id") ?>" class="btn btn-xs btn-danger"  onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
                                             <?php endif;  ?> 
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" align="right"><strong><?php echo display('total');?></strong></td>
                            <td><strong><?php echo $tdebit; ?></strong></td>
                            <td><strong><?php echo $tcredit; ?></strong></td>
                        </tr>
                    </tfoot>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>