<script type="text/javascript">
function printDiv() {
    var divName = "printArea";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    // document.body.style.marginTop="-45px";
    window.print();
    document.body.innerHTML = originalContents;
}
</script>

        <!-- New expense -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                   
                    <div class="panel-body">

                                 <?php echo form_open('expense/Expense/expense_statement', array('class' => 'form-inline', 'method' => 'get')) ?>
                        <?php
                        $today = date('Y-m-d');
                        ?>
                        <div class="form-group">
                             <label for="expense"><?php echo display('expense_name') ?><i class="text-danger">*</i></label>
                           
                              <select class="form-control" name="expense_name">
                                <option value="">Select One</option>
                               <option value="all" <?php if($this->input->get('expense_name') == 'all'){echo 'selected';}?>>All</option>
                               <?php foreach($item_list as $expenses){?>
                                  <option value="<?php echo $expenses['expense_name']?>" <?php if($expenses['expense_name']==$expense_id){echo 'selected';}?>><?php echo $expenses['expense_name']?></option>
                              <?php }?>
                              </select>

                           
                        </div>
                        <div class="form-group">
                            <label class="" for="from_date"><?php echo display('start_date') ?></label>
                            <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo (!empty($from_date)?$from_date:$today) ?>">
                        </div> 

                        <div class="form-group">
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
       <table border="0" width="100%" style="margin-bottom: 10px;padding-bottom: 0px">
                                                
                                                <tr>
                                                    <td align="left" style="border-bottom:1px #333 solid;">
                                                        <img src="<?php echo base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png')) ?>" alt="logo">
                                                    </td>
                                                    <td align="center" style="border-bottom:1px #333 solid;padding-right: 10%;">
                                                        <span style="font-size: 17pt; font-weight:bold;">
                                                            <?php echo $setting->title;?>
                                                           
                                                        </span><br>
                                                        <?php echo $setting->address;?>
                                                        
                                                        
                                                    </td>
                                                   
                                                     <td align="right" style="border-bottom:1px #333 solid;">
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
        <caption><center><h3><?= display('expense_statement').' <br> '.display('from').' '.$this->input->get('from_date').' '.display('to').' '.$this->input->get('to_date');?></h3></center></caption>
        <thead>
            <tr>
             <th class="text-center"><?php echo display('particulars')?></th>   
             <th class="text-center"><?php echo display('amount')?></th>   
                  
            </tr>
        </thead>
        <tbody>
            <?php if($expense_statement){?>
            <?php $Totalamount=0;
             foreach($expense_statement as $statement){?>
            <tr>
                <td class="text-center"><?php echo $statement['HeadName']?></td>
                <td class="text-right"><?php echo number_format($statement['Debit'],2,'.',',');
                        $Totalamount += $statement['Debit'];
                ?></td>
                
                  
                      
            </tr>
        <?php }?>
        <?php }else{?>
            <tr><td class="text-center" colspan="2">No Record Found </td></tr>
        <?php }?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1" class="text-right"><b><?php echo display('total')?></b></td><td class="text-right"><b><?php echo number_format($Totalamount,2,'.',',');?></b></td>
            </tr>
        </tfoot>
    </table>
</div>
                                 
                
                        
                    </div>
                    
                </div>
            </div>
        </div>
<script type="text/javascript">
      $(function () {
    $(".datepicker").datepicker({ dateFormat:'yy-mm-dd' });
 $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
  });
</script>
  
<!-- Add new expense statement end -->



