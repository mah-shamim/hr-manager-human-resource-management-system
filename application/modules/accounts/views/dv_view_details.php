<?php 
$this->load->library('Numberconverter');
$numberToword = new Numberconverter();
?>

<link href="<?php echo MOD_URL.'accounts/assets/css/custom.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="col-md-12 dv_view_details" id="vaucherPrintArea">
<div class="row">
               <div class="col-md-3">
                  <img src="<?php echo base_url() . $settings_info->logo; ?>" alt="Logo" height="40px"><br><br>
               </div>
               <div class="col-md-6 text-center">
                    <h2><?php echo $settings_info->title; ?></h2>
                   
                  <strong><u class="pt-4"><?php echo display('debit_voucher')?></u></strong>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                <div class="pull-right v-no-date">
            <label class="font-weight-600 mb-0"><?php echo display('voucher_no')?></label> : <?php echo $results->VNo;?><br>
            <label class="font-weight-600 mb-0"><?php echo display('voucher_date')?></label> : <?php echo date('d/m/Y', strtotime($results->VDate));?>
            </div>
                </div>
            </div>
           
    <table class="table table-bordered table-sm mt-2">
        
        <thead>
            <tr>
                <th class="text-center"><?php echo display('particulars');?></th>
                <th class="text-center"><?php echo display('debit')?></th>
                <th class="text-center"><?php echo display('credit')?></th>
               
            </tr>
           
            
        </thead>
        <tbody>
        	<?php
        	$Debit = 0;
        	$Credit = 0;
            $createBy='';
            if(!empty($results)){
            	foreach($results->details as $row){ 
            		$Debit += $row->Debit;
            		$Credit += $row->Credit;
                    $createBy= $row->created_by;
            	?>
            	<tr>
            		<td><strong class="font-fifteenpx"><?php echo $row->HeadName.($row->subType != 1?'('.$row->subname.')':'');?></strong><br>
                    <span> <?php echo $row->ledgerComment?></span>
                </td>
            		<td class="text-right"><?php echo $row->created_by . $settings_info->currency_symbol. ' '. $row->Debit;?></td>
            		<td class="text-right"><?php echo $settings_info->currency_symbol. ' '. $row->Credit;?></td>
            	</tr>
        	<?php } }else{ ?>
                <tr>
                    <td colspan="3" class="text-center text-danger"><?php echo display('data_is_not_available');?></td>
                </tr>
            <?php }?>
            <tr>
                <td class="text-left"><strong class="font-fifteenpx"><?php echo $results->dbtcrdHead;?></strong></td>
                <td class="text-right"><?php echo $settings_info->currency_symbol ;?> 0.00</td>
                <td class="text-right"><?php echo $settings_info->currency_symbol. ' '. number_format($Debit, 2); ?></td>

            </tr>
        </tbody>
        <tfoot>
        	<tr>
        		<th class="text-right"><?php echo display('total');?></th>
        		<th class="text-right"><?php echo $settings_info->currency_symbol. ' '. number_format($Debit, 2); ?></th>
        		<th class="text-right"><?php echo $settings_info->currency_symbol. ' '. number_format($Debit, 2); ?></th>
        	</tr>
            <tr>
        		
        		<th class="" colspan="3"><?php echo display('in_words');?> : <?php echo $numberToword->convert_number($Debit) ." ".$settings_info->currency_in_words; ?></th>
        		
        	</tr>
            <tr>
        		
        		
        		<th class="" colspan="3"><?php echo display('remarks')?> : <?php echo $results->Narration; ?></th>
        	</tr>
        </tfoot>
    </table>
    <div class="form-group row mt-100-50" >
    <label for="name" class="col-lg-3 col-md-3 col-sm-3  col-form-label text-center"> <div class="border-top"><?php echo display('prepared_by')?>: <?php echo $results->created_by;?></div></label>
    <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-form-label text-center"> <div class="border-top"><?php echo display('checked_by')?></div></label>
    <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-form-label text-center"> <div class="border-top"><?php echo display('authorised_by')?></div></label>
    <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-form-label text-center"> <div class="border-top"><?php echo display('pay_by')?></div></label>
               
    </div>
</div>