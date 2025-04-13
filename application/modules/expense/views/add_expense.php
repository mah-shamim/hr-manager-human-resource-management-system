  <style type="text/css">
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0.5em;
    display: inline-block;
    width: 100px;
}
</style> 
  <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                       
                    </div>
                </div>
                <div class="panel-body">
                 <div class="col-sm-6 col-md-6">
                    <?= form_open('expense/Expense/expense_item'); ?>
                   <?php echo form_hidden('id', (!empty($expenseinfo->id)?$expenseinfo->id:null)) ?>
                       <div class="form-group row">
                           
                            <label for="expense_name" class="col-sm-3 col-form-label">
                            <?php echo display('expense_name') ?></label>
                            <div class="col-sm-6">
                           <input type="text" name="expense_name" class="form-control" value="<?php echo (!empty($expenseinfo->expense_name)?$expenseinfo->expense_name:null) ?>" placeholder="<?php echo display('expense_name') ?>">
                            <input type="hidden" name="oldname" class=" form-control" value="<?php echo (!empty($expenseinfo->expense_name)?$expenseinfo->expense_name:null) ?>" placeholder="<?php echo display('expense_name') ?>">
                               
                            </div>
                           
                        </div>
                             
                        
                        <div class="form-group text-center">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo (!empty($expenseinfo->expense_name)?display('update'):display('save')) ?></button>
                        </div>
                    <?php echo form_close() ?>
                  </div>
                  <div class="col-sm-6 col-md-6">
                     <table width="100%" id="datatable1" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('expense_name') ?></th>
                           <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($expenses)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($expenses as $expense) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $expense->expense_name; ?></td>
                                    <td class="center">
                                    <?php if($this->permission->method('expense_item','update')->access()): ?> 
                                        <a href="<?php echo base_url("expense/expense/expense_item/$expense->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->method('expense_item','delete')->access()): ?> 
                                        <a href="<?php echo base_url("expense/expense/delete_expense/$expense->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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
    <script type="text/javascript">
    $(document).ready(function () {
        $('#datatable1').DataTable({ 
        responsive: true, 
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [   
            {extend: 'pdf', title: 'Expense Item List', className: 'btn-sm'}, 
            {extend: 'print', className: 'btn-sm'} 
        ] 
    });
          });
</script>