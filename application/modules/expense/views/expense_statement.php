       <!-- New expense -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('expense_statement') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">

                                 <?php echo form_open('expense/expense/expense_statement', array('class' => 'form-inline', 'method' => 'get')) ?>
                        <?php
                        $today = date('Y-m-d');
                        ?>
                        <div class="form-group form-group-new expstatmnt">
                              <select class="form-control" name="expense_name">
                                <option value="">Select Expense</option>
                                <option value="all">All</option>
                                <?php foreach($item_list as $expenses){?>
                                  <option value="<?php echo $expenses['expense_name']?>" <?php if($expenses['expense_name']==$expense_id){echo 'selected';}?>><?php echo $expenses['expense_name']?></option>
                              <?php }?>
                              </select>
                           
                        </div>
                        <div class="form-group form-group-new">
                            <label class="" for="from_date"><?php echo display('start_date') ?></label>
                            <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo (!empty($from_date)?$from_date:$today) ?>">
                        </div> 

                        <div class="form-group form-group-new">
                            <label class="" for="to_date"><?php echo display('end_date') ?></label>
                            <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo (!empty($to_date)?$to_date:$today) ?>">
                        </div>  

                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                        <a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')"><?php echo display('print') ?></a>
                        <?php echo form_close() ?>
                
                        
                    </div>
                    
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-12" id="printArea">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            
                        </div>
                    </div>
                    <div class="panel-body">
                          <table border="0" width="100%">
                                                
                                                <tr>
                                                    <td align="left">
                                                        <img src="<?php echo base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png')) ?>" alt="logo">
                                                    </td>
                                                    <td align="center">
                                                        <span>
                                                            <?php echo $setting->title;?>
                                                           
                                                        </span><br>
                                                        <?php echo $setting->address;?>
                                                        
                                                        
                                                    </td>
                                                   
                                                     <td align="right">
                                                        <date>
                                                        <?php echo display('date')?>: <?php
                                                        echo date('d-M-Y');
                                                        ?> 
                                                    </date>
                                                    </td>
                                                </tr>            
                                   
                                </table>  
<div class="table-responsive">
    <table class="table table-bordered">
        <caption><center><h2><?php echo  $this->input->get('expense_name'); ?></h2></center></caption>
        <thead>
            <tr>
             <th class="text-center"><?php echo display('date')?></th>
             <th class="text-center"><?php echo display('remark')?></th>   
             <th class="text-center"><?php echo display('amount')?></th>   
                  
            </tr>
        </thead>
        <tbody>
            <?php if($expense_statement){?>
            <?php $Totalamount=0;
             foreach($expense_statement as $statement){?>
            <tr>
                <td class="text-center"><?php echo $statement['VDate']?></td>
                <td class="text-center"><?php echo $statement['Narration']?></td>
                <td class="text-right"><?php echo number_format($statement['Debit'],2,'.',',');
                   
                        $Totalamount += $statement['Debit'];
                ?></td>
                
                  
                      
            </tr>
        <?php }?>
        <?php }else{?>
            <tr><td class="text-center" colspan="3">No Record Found </td></tr>
        <?php }?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-right"><b><?php echo display('total')?></b></td><td class="text-right"><b><?php echo number_format($Totalamount,2,'.',',');?></b></td>
            </tr>
        </tfoot>
    </table>
</div>
                                 
                
                        
                    </div>
                    
                </div>
            </div>
        </div>

<!-- Add new expense statement end -->



