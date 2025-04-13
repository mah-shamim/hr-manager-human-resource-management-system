<div class="row">
	<div class="panel panel-bd">

        <div class="panel-heading">
           <div class="panel-title">
                    <h4>
                        <?php echo display('income_sheet')?>
                    </h4>
                   
             </div>
         </div>

         <div class="expense-info text-center mt-20">
             <h4 class="expensesheettitle"><?php echo  display('cash_in_hand').' '.display('balance');?> = <?php echo  $cash;?> | <?php echo  display('bank').' '.display('balance');?> = <?php echo  $balance;?> </h4>     
         </div>

		<div class="panel-body">
            <div class="table-responsive">
			 <?php echo  form_open('income/income/incomeheet_add') ?>
			<table id="incomefields" border="0">
        <tr class="expensincoemtblhead">
            <td><?php echo display('date') ?> <i class="text-danger">*</i></td>
            <td><?php echo display('particular') ?> <i class="text-danger">*</i></td>
            <td><?php echo display('money_receipt') ?> <i class="text-danger">*</i></td>
            <td><?php echo display('amount') ?> <i class="text-danger">*</i></td>
            <td><?php echo display('payment_type') ?> <i class="text-danger">*</i></td>
            <td><?php echo display('head_name') ?></td>
            <td><?php echo display('remark') ?></td>
            <td><?php echo display('action') ?>?</td>
        </tr>
        <tbody id="paymentbody">
            <?php if($item_list){?>
        	<?php $sl = 1;
        	 foreach($item_list as $items){?>
        <tr>
           <td class="expenseincometd"><input  type="text" class="form-control datepicker"  name="date[]" value="<?php echo date('Y-m-d')?>" /></td>
            <td class="expenseincomesndtd"><input  type="text" class="form-control" id="particular_<?php echo $sl;?>" value="<?php echo  $items['income_field'];?>" readonly name="particular[]" /></td>
            <td class="expenseincomesndtd"><input  type="text" class="form-control" id="voucher_no_<?php echo $sl;?>" value="" name="voucher_no[]" /></td> 
            <td class="expenseincomesndtd"><input  type="number" class="form-control" id="amount_<?php echo $sl;?>" name="amount[]"  onInput="checkrequired(<?php echo $sl;?>)" /></td>
             <td class="expenseincometd">
            <select name="parent_type[]" class="form-control" onchange="paymentypeselectIncome(<?php echo $sl;?>)" id="paytype_<?php echo $sl;?>">
                 <option value=""><?php echo display('select_type')?></option>
                          <?php foreach($paytype as $ptypes){?>
                          <option value="<?php echo $ptypes->HeadName?>"><?php echo $ptypes->HeadName?></option>
                           <?php }?>
                         </select></td>
            <td class="expenseincometd">
            	<select name="headcode[]" class="form-control" id="headcode_<?php echo $sl;?>">
                 <option></option>
                         </select></td>
             <td class="expenseincomesndtd"><input  type="text" class="form-control" id="remarks" name="remarks[]" /></td>
            <td class="expenseincomesndtd"></td>
            
        </tr>
        <?php $sl++;}}else{?>
       <tr id="notfound"><td colspan="7"><center><h1> No Expense Item Found </h1></center></td></tr>     
        <?php }?>
    </tbody>
   
        </table>
    </div>
       
		</div>
		  <div class="form-group text-center">
		  	<input type="hidden" id="baseUrl" value="<?php echo base_url();?>" name="">
		  	  <button type="button" class="btn btn-info w-md m-b-5" onClick="addpaymentfieldIncome('paymentbody');"><?php echo display('add_more') ?></button>
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
<input type="hidden" name="" id="paytypelist" value='<option value=""><?php echo display('select_type')?></option><?php foreach($paytype as $ptypes){?>
<option value="<?php echo $ptypes->HeadName?>"><?php echo $ptypes->HeadName?></option><?php }?>'>
		
	</div>

</div>
<script src="<?php echo base_url('assets/js/incomeexpense.js') ?>" type="text/javascript"></script>

