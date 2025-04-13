<?php 
$this->load->library('Numberconverter');
$numberToword = new Numberconverter();
?>

<link href="<?php echo MOD_URL.'accounts/assets/css/custom.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="col-md-12 jv_view_details" id="printArea">
<div class="row">
               <div class="col-md-3">
                  <img src="<?php echo base_url() . $settings_info->logo; ?>" alt="Logo" height="40px"><br><br>
               </div>
               <div class="col-md-6 text-center">
                    <h6><?php echo $settings_info->title; ?></h6>
                   
                  <strong><u class="pt-4"><?php echo 'Journal Voucher'; ?></u></strong>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                <div class="pull-right vno_vdate">
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
                <th class="text-center"><?php echo display('credit')?> </th>
               
               
            </tr>
           
            
        </thead>
        <tbody>
        	<?php
        	$Debit = 0;
        	$Credit = 0;
            if(!empty($results)){
            	foreach($results->details as $row){ 
                    
            		$Debit += ($row->Debit?$row->Debit:0) + ( $row->Credit? $row->Credit:0);
            		$Credit += ($row->Debit?$row->Debit:0) + ( $row->Credit? $row->Credit:0);
            	?>
            	<tr>
            		<td class="subname_subdate"><strong><?php echo $row->HeadName.($row->subType != 1?'('.$row->subname.')':'');?></strong><br>
                    <span> <?php echo $row->ledgerComment?></span>
                </td>
            		<td class="text-right"><?php echo $settings_info->currency_symbol. ' '. $row->Debit;?></td>
            		<td class="text-right"><?php echo $settings_info->currency_symbol. ' '. $row->Credit;?></td>
                       
            	</tr>
                  <tr>
            		<td class="subname_subdate"><strong><?php echo $row->rHead;?></strong><br>
                    <span> <?php echo $row->ledgerComment?></span>
                </td>
            		<td class="text-right"><?php echo $settings_info->currency_symbol. ' '. $row->Credit;?></td>
            		<td class="text-right"><?php echo $settings_info->currency_symbol. ' '. $row->Debit;?></td>
                      
            	</tr>
        	<?php } }else{ ?>
                <tr>
                    <td colspan="3" class="text-center text-danger"><?php echo display('data_is_not_available');?></td>
                </tr>
            <?php }?>
           
        </tbody>
        <tfoot>
        	<tr>   
        		 <th class="text-right"><?php echo display('total');?></th>
        		<th class="text-right"><?php echo $settings_info->currency_symbol. ' '. number_format($Credit, 2); ?></th>
        		<th class="text-right"><?php echo $settings_info->currency_symbol. ' '. number_format($Credit, 2); ?></th>
        	</tr>
            <tr>
        		
        		<th class="" colspan="3"><?php echo display('in_words');?> : <?php echo $numberToword->convert_number($Credit). " ".$settings_info->currency_in_words; ?></th>
        		
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
