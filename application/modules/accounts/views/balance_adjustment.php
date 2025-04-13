
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      <?php echo display('balance_adjustment')?>   
                    </h4>
                </div>
            </div>
            <div class="panel-body">
              
                         <?= form_open_multipart('accounts/accounts/create_balance_adjustment') ?>
                     <div class="form-group row">
                        <label for="vo_no" class="col-sm-2 col-form-label"><?php echo display('voucher_no')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="txtVNo" id="txtVNo" value="<?php if(!empty($voucher_no->voucher)){
                               $vn = substr($voucher_no->voucher,4)+1;
                              echo $voucher_n = 'BLA-'.$vn;
                             }else{
                               echo $voucher_n = 'BLA-1';
                             } ?>" class="form-control" readonly>
                        </div>
                    </div> 
                     <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label"><?php echo display('date')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker" value="<?php  echo date('Y-m-d');?>">
                        </div>
                    </div> 
                  <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label"><?php echo display('amount')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="amount" id="amount" class="form-control" onkeyup="formatcheck(this)" value="">
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label"><?php echo display('adjustment_type')?></label>
                        <div class="col-sm-4">
                         <select name="type" class="form-control">
                          <option value=""><?php echo display('adjustment_type')?></option>
                           <option value="1"><?php echo display('debit')?></option>
                           <option value="2"><?php echo display('credit')?></option>
                         </select>
                        </div>
                    </div> 


                          <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label"><?php echo display('parent_head')?></label>
                        <div class="col-sm-4">
                         <select name="parent_type" class="form-control" onchange="parentchange()" id="paytype">
               <option value=""><?php echo display('parent_head')?></option>
                  <?php foreach($paytype as $ptypes){?>
                <option value="<?php echo $ptypes->HeadName?>"><?php echo $ptypes->HeadName?></option>
                           <?php }?>
                         </select>
                        </div>
                    </div> 

                <div class="form-group row">
                 <label for="type" class="col-sm-2 col-form-label"><?php echo display('child_head')?></label>
                <div class="col-sm-4">
                    <select name="headcode" class="form-control" id="headcode">
                 <option></option>
                         </select>
                        </div>
                    </div> 
                       <div class="form-group row">
                        <label for="txtRemarks" class="col-sm-2 col-form-label"><?php echo display('remark')?></label>
                        <div class="col-sm-4">
                          <textarea  name="txtRemarks" id="txtRemarks" class="form-control"></textarea>
                        </div>
                        <input type="hidden" id="baseUrl" value="<?php echo base_url();?>" name="">
                    </div> 
                   
         
                        <div class="form-group row">
                           
                            <div class="col-sm-4 text-right">

                                <input type="submit" id="add_adjustment" class="btn btn-success btn-large" name="save" value="<?php echo display('save') ?>" tabindex="9"/>
                               
                            </div>
                        </div>
                  <?php echo form_close() ?>
            </div>  
        </div>
    </div>
</div>
<script type="text/javascript">
    function parentchange() {
            var  hdcode     = $('#paytype').val();
            var dataString  = 'paytype='+ hdcode;
            var base_url    = $('#baseUrl').val();
            var paymentcode = '#headcode';
              $.ajax
                   ({
                        type: "POST",
                        url: base_url+"/income/income/retrieve_paytypedata",
                        data: dataString,
                        cache: false,
                        success: function(data)
                        {
                            var obj = jQuery.parseJSON(data);
                            $(paymentcode).html(obj.headcode);
                        } 
                    });

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

