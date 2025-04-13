<div class="row">
	<div class="panel panel-defalult">
		 <div class="panel-heading">
           <div class="panel-title text-center">
                   <h4 style="font-family: serif;border:2px solid #e4e5e7;margin-left:20%;margin-right: 20%"><?= display('cash_in_hand').' '.display('balance');?> = <?= $cash;?> | <?= display('bank').' '.display('balance');?> = <?= $balance;?> </h4>   
             </div>
                </div>
		<div class="panel-body">
			 <?= form_open('expense/expense/expensesheet_add') ?>
			<table id="expensfield" border="0">
        <tr style="text-align: center;font-weight: bold">
            <td><?php echo display('date') ?> <i class="text-danger">*</i></td>
            <td><?php echo display('particular') ?> <i class="text-danger">*</i></td>
            <td><?php echo display('voucher_no') ?> <i class="text-danger">*</i></td>
            <td><?php echo display('amount') ?> <i class="text-danger">*</i></td>
            <td><?php echo display('payment_type') ?> <i class="text-danger">*</i></td>
            <td><?php echo display('head_name') ?></td>
            <td><?php echo display('remark') ?></td>
            <td><?php echo display('action') ?>?</td>
        </tr>
        <tbody id="paymentbody">
        	<?php $sl = 1;
        	 foreach($item_list as $items){?>
        <tr>
           <td style="padding:2px;width: 120px"><input  type="text" class="form-control datepicker" id="" name="date[]" value="<?php echo date('Y-m-d')?>" /></td>
            <td style="padding:2px;"><input  type="text" class="form-control" id="particular_<?php echo $sl;?>" value="<?= $items['expense_name'];?>" readonly name="particular[]" /></td>
            <td style="padding:2px"><input  type="text" class="form-control" id="voucher_no_<?php echo $sl;?>" value="" name="voucher_no[]" /></td> 
            <td style="padding:2px;width: 100px"><input  type="text" class="form-control" id="amount_<?php echo $sl;?>" name="amount[]"  onInput="checkrequired(<?php echo $sl;?>)" onkeyup="formatcheck(this)" /></td>
             <td style="padding:2px;width: 120px">
            <select name="parent_type[]" class="form-control" onchange="paymentypeselect(<?php echo $sl;?>)" id="paytype_<?php echo $sl;?>">
                 <option value=""><?php echo display('select_type')?></option>
                          <?php foreach($paytype as $ptypes){?>
                          <option value="<?php echo $ptypes->HeadName?>"><?php echo $ptypes->HeadName?></option>
                           <?php }?>
                         </select></td>
            <td style="padding:2px;width: 120px">
            	<select name="headcode[]" class="form-control" id="headcode_<?php echo $sl;?>">
                 <option></option>
                         </select></td>
             <td style="padding:2px;"><input  type="text" class="form-control" id="remarks" name="remarks[]" /></td>
            <td style="padding:2px"></td>
            
        </tr>
        <?php $sl++;}?>
    </tbody>
   
        </table>
       
		</div>
		  <div class="form-group text-center">
		  	<input type="hidden" id="baseUrl" value="<?php echo base_url();?>" name="">
		  	  <button type="button" class="btn btn-info w-md m-b-5" onClick="addpaymentfield('paymentbody');"><?php echo display('add_more') ?></button>
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>

		
	</div>

</div>
<script type="text/javascript">
	    function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('expensfield').deleteRow(i);
}

function insRow()
{
	var rnumber = $('#expensfield tr').length-1;
    var x=document.getElementById('expensfield');
    var new_row = x.rows[""+rnumber+""].cloneNode(true);
    x.appendChild( new_row );
}
</script>
<script type="text/javascript">
	function paymentypeselect(sl) {
            var  hdcode     = $('#paytype_'+sl).val();
            var dataString  = 'paytype='+ hdcode;
            var base_url    = $('#baseUrl').val();
            var paymentcode = '#headcode_'+sl;
              $.ajax
                   ({
                        type: "POST",
                        url: base_url+"/expense/expense/retrieve_paytypedata",
                        data: dataString,
                        cache: false,
                        success: function(data)
                        {
                            var obj = jQuery.parseJSON(data);
                            $(paymentcode).html(obj.headcode);
                        } 
                    });

}


    var count = 1;
    var limits = 500;

    function addpaymentfield(divName){

   var row = $("#expensfield tbody tr").length;
    var count = row;
        if (count == limits)  {
            alert("<?php echo display('you_have_reached_the_limit_of_adding')?> " + count + "<?php echo display('inputs')?> ");
        }
        else{
            var newdiv = document.createElement('tr');
           newdiv = document.createElement("tr");
            newdiv.innerHTML ='<td style="padding:2px;width: 120px"><input  type="text" value="<?php echo date('Y-m-d')?>" class="form-control datepicker" id="" name="date[]" /></td><td style="padding:2px;"><input  type="text" class="form-control" id="particular_'+count+'" name="particular[]" /></td><td style="padding:2px;width: 100px"><input  type="text" class="form-control" id="voucher_no_'+count+'" value="" name="voucher_no[]" /></td><td style="padding:2px"><input  type="text" class="form-control" id="amount_'+count+'" name="amount[]" onkeyup="formatcheck(this)" onInput="checkrequired('+count+')" /></td><td style="padding:2px;width: 120px"><select name="parent_type[]" class="form-control" onchange="paymentypeselect('+count+')" id="paytype_'+count+'"><option value=""><?php echo display('select_type')?></option><?php foreach($paytype as $ptypes){?>
<option value="<?php echo $ptypes->HeadName?>"><?php echo $ptypes->HeadName?></option><?php }?></select></td><td style="padding:2px;width: 120px"><select name="headcode[]" class="form-control" id="headcode_'+count+'"><option></option></select></td><td style="padding:2px;"><input  type="text" class="form-control" id="remarks" name="remarks[]" /></td><td style="padding:2px"><button type="button" id="delPOIbutton" class="btn btn-danger" value="Delete" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></td>';
            document.getElementById(divName).appendChild(newdiv);
            count++;
$(".datepicker").datepicker({ dateFormat:'yy-mm-dd' });
 $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
           
        }
    }

</script>
<script type="text/javascript">
	function formatcheck(input) {

  var nStr = input.value + '';  
  nStr = nStr.replace(/[^0-9]/g, "");
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';  
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  input.value = x1 + x2;

}


$(document).ready(function(){
    $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });
});
</script>
<script type="text/javascript">
    function checkrequired(sl) {
       var amount = 'amount_' + sl;
       var voucher ='voucher_no_'+sl;
       var paytype = 'paytype_'+sl;
       var particular = 'particular_'+sl;
var amounts = document.getElementById(amount);
var am = amounts.value;
       if(am != ''){
        document.getElementById(voucher).setAttribute("required", "required");
        document.getElementById(paytype).setAttribute("required", "required");
        document.getElementById(particular).setAttribute("required", "required");
       }
       if(am == ''){
       document.getElementById(voucher).removeAttribute("required");
       document.getElementById(paytype).removeAttribute("required");
       document.getElementById(particular).removeAttribute("required");
       }
    }
</script>