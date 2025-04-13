
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      <?php echo display('add_expense')?>   
                    </h4>
                </div>
            </div>
            <div class="panel-body">
              
                         <?php echo  form_open_multipart('expense/Expense/create_expense') ?>
                                <div class="row">
                          <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker" value="<?php  echo date('Y-m-d');?>">

                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-12" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="expense_name" class="col-sm-4 col-form-label"><?php
                                        echo display('expense_name');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select name="expense_type" class="form-control" required="">
                                        <option value="">Select Expense Type</option>
                                        <option value="all">All</option>
                                            <?php foreach($expense_item as $item){?>
                                            <option value="<?php echo $item['expense_name']?>"><?php echo $item['expense_name']?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                 
                                </div>
                            </div>
                            <div class="col-sm-12" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-4 col-form-label"><?php
                                        echo display('payment_type');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select name="paytype" class="form-control" required="" id="paytype" onchange="bank_paymet(this.value)" required="">
                                            <option value="">Select Payment Option</option>
                                            <option value="1">Cash Payment</option>
                                            <option value="2">Bank Payment</option>
                                        </select>
                                    </div>
                                 
                                </div>
                            </div>
                                <div class="col-sm-12" id="bank_div">
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-4 col-form-label"><?php
                                        echo display('bank_name');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                    <select name="bank_name" class="form-control" id="bank">
                                    <option value="">Select Payment Option</option>
                                            <?php foreach($bank_list as $banks){?>
                                            <option value="<?php echo $banks['bank_name']?>"><?php echo $banks['bank_name']?></option>
                                            <?php }?>
                                            
                                        </select>
                                    </div>
                                 
                                </div>
                            </div>
                            <div class="col-sm-12" id="payment_from_1">
                         <div class="form-group row">
                        <label for="date" class="col-sm-4 col-form-label"><?php echo display('amount')?><i class="text-danger"> *</i></label>
                        <div class="col-sm-8">
                             <input type="text" name="amount" id="amount" class="form-control"  required="" placeholder="amount">
                            
                        </div>
                    </div> 
                    </div>
                     <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="remark" class="col-sm-4 col-form-label"><?php echo display('remark') ?>
                                        <i class="text-danger"></i>
                                    </label>
                                    <div class="col-sm-8">
                                       <textarea name="remark" placeholder="Please Write your remark" class="form-control"></textarea>

                                    </div>
                                </div>
                            </div>
           
                       <div class="form-group row">
                           
                            <div class="col-sm-12 text-center">

                                <input type="submit" id="add_receive" class="btn btn-success btn-large" name="save" value="<?php echo display('save') ?>" tabindex="9"/>
                               
                            </div>
                        </div>
                  <?php echo form_close() ?>
            </div>  
        </div>
    </div>
</div>

</div>
