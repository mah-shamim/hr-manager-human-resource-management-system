<style type="text/css">
     table.table {       
        border-collapse: collapse;   
        margin-top: 50px;     
    }
    table.table td, table.table th {
        padding: 6px 15px;
    }
    table.table td, table.table th {
        border: 1px solid #ededed;
        border-collapse: collapse;
    }
table.table td.noborder {
    border: none;
    padding-top: 60px;
}
</style>
<?php 
$this->load->library('Numberconverter');
$numberToword = new Numberconverter();
?>
<div class="col-md-12" id="printArea">
    <div class="row">
               <div class="col-md-12">
                 <div class="table-responsive">
                   <table border="0" width="99%" >                                                
                    <tr>
                        <td width="30%" align="left">
                            <?php
                            $path = base_url((!empty($settings_info->logo)?$settings_info->logo:'assets/img/icons/mini-logo.png'));
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $data = file_get_contents($path);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            ?>
                            <img src="<?php echo  $base64; ?>" alt="logo">
                        </td>
                        <td width="40%" align="center">  <h2><?php echo $settings_info->title; ?></h2>
                   
                          <strong><u class="pt-4">Journal Voucher</u></strong>
                        </td>  
                         <td width="30%" align="right">
                            <div class="pull-right" style="margin-right:20px;">
                            <label class="font-weight-600 mb-0"><?php echo display('voucher_no')?></label> : <?php echo $results->VNo;?><br>
                            <label class="font-weight-600 mb-0"><?php echo display('voucher_date')?></label> : <?php echo date('d/m/Y', strtotime($results->VDate));?>
                            </div>
                        </td>
                    </tr>  
                 </table>       
                 </div>
               </div>
            </div>       
    <table  width="99%" class="table table-bordered table-sm mt-2">
        
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
            		<td align="left"><strong style="font-size: 15px;;"><?php echo $row->HeadName.($row->subType != 1?'('.$row->subname.')':'');?></strong><br>
                    <span> <?php echo $row->ledgerComment?></span>
                </td>
            		<td align="right" class="text-right"><?php echo $settings_info->currency_symbol. ' '. $row->Debit;?></td>
            		<td align="right" class="text-right"><?php echo $settings_info->currency_symbol. ' '. $row->Credit;?></td>
                       
            	</tr>
                  <tr>
            		<td align="left"><strong style="font-size: 15px;"><?php echo $row->rHead;?></strong><br>
                    <span> <?php echo $row->ledgerComment?></span>
                </td>
            		<td align="right" class="text-right"><?php echo $settings_info->currency_symbol. ' '. $row->Credit;?></td>
            		<td align="right" class="text-right"><?php echo $settings_info->currency_symbol. ' '. $row->Debit;?></td>
                      
            	</tr>
        	<?php } }else{ ?>
                <tr>
                    <td align="left" colspan="3" class="text-center text-danger"><?php echo display('data_is_not_available');?></td>
                </tr>
            <?php }?>
           
        </tbody>
        <tfoot>
        	<tr>   
        		 <th align="right" class="text-right"><?php echo display('total');?></th>
        		<th align="right" class="text-right"><?php echo $settings_info->currency_symbol. ' '. number_format($Credit, 2); ?></th>
        		<th align="right" class="text-right"><?php echo $settings_info->currency_symbol. ' '. number_format($Credit, 2); ?></th>
        	</tr>
            <tr>
        		
        		<th align="left" class="" colspan="3"><?php echo display('in_words');?> : <?php echo $numberToword->convert_number($Credit). " ".$settings_info->currency_in_words; ?></th>
        		
        	</tr>
            <tr>
        		
        		
        		<th align="left" class="" colspan="3"><?php echo display('remarks')?> : <?php echo $results->Narration; ?></th>
        	</tr>
        </tfoot>
        <tfoot>
                   <tr >
                    <td colspan="3" class="noborder">
                       <table border="0" width="100%">                                                
                        <tr>
                            <td width="25%" align="left" class="noborder">
                                <div class="border-top"><?php echo display('prepared_by')?>: <?php echo $results->created_by;?></div>
                            </td>
                            <td width="25%"  align="center"  class="noborder"> <div class="border-top"><?php echo display('checked_by')?></div>
                            </td>  
                             <td width="25%"  align="right"  class="noborder">
                                <div class="border-top"><?php echo display('authorised_by')?></div>
                            </td>
                            <td width="25%"  align="right"  class="noborder">
                                <div class="border-top"><?php echo display('pay_by')?></div>
                            </td>
                        </tr>  
                     </table>  
                    </td>                    
                 </tr> 
              </tfoot>
    </table>
   
</div>
