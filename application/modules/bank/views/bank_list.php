
        <div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('bank_name') ?></th>
                            <th><?php echo display('account_name') ?></th>
                            <th><?php echo display('account_number') ?></th>
                            <th><?php echo display('branch_name') ?></th>
                           <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($banks)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($banks as $bank) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $bank->bank_name; ?></td>
                                    <td><?php echo $bank->account_name; ?></td>
                                    <td><?php echo $bank->account_number; ?></td>
                                   <td><?php echo $bank->branch_name; ?></td> 
                                    <td class="center">
                                    <?php if($this->permission->method('bank_list','update')->access()): ?> 
                                        <a href="<?php echo base_url("bank/Bank/create_bank/$bank->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->method('bank_list','delete')->access()): ?> 
                                        <a href="<?php echo base_url("bank/Bank/delete_bank/$bank->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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

