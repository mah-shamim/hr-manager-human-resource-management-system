<style type="text/css">
     table.datatableReport {       
        border-collapse: collapse;
    }
    table.datatableReport td, table.datatableReport th {
        padding: 6px 15px;
    }
    table.datatableReport td, table.datatableReport th {
        border: 1px solid #ededed;
        border-collapse: collapse;
    }
table.datatableReport td.noborder {
    border: none;
    padding-top: 60px;
}
  
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="panel"  id="printArea">            
            <div class="panel-body">
                <div class="table-responsive">
                     <table border="0" width="100%">                                                
                        <tr>
                            <td width="30%" align="left">
                                <?php
                                $path = base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png'));
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                ?>
                                <img src="<?php echo  $base64; ?>" alt="logo">
                            </td>
                            <td width="40%" align="center"> <h2> <?php echo $setting->title;?>  </h2><h4> <?php echo $setting->address;?> </h4>
                                <h3><?php echo display('receipt_payment')?> <?php echo display('from_date')?>  <?php echo date('d-m-Y', strtotime($dtpFromDate)) ;?> <?php echo display('to_date')?>  <?php echo date('d-m-Y', strtotime($dtpToDate)) ;?></h3>
                            </td>  
                             <td width="30%" align="right">
                                <date>
                                <?php echo display('date')?>: <?php
                                echo date('d-M-Y');
                                ?> 
                            </date>
                            </td>
                        </tr>  
                     </table>  

                
                <table width="99%" align="left" cellpadding="10" border="0" class="datatableReport table table-striped table-bordered table-hover general_ledger_report_tble">
                    <thead>
                         <tr>
                            <th width="60%" bgcolor="#E7E0EE" align="left" ><?php echo display('particulars')?></th>   
                            <th class="profitamount" align="right" width="40%" bgcolor="#E7E0EE" align="left" ><?php echo display('balance')?></th>
                          </tr> 
                                                    
                    </thead>
                    <tbody>
                          <tr> <td height="70"  align="left" colspan="2"><strong><?php echo display('opening_balance')?></strong></td> </tr>
                          <tr>
                            <td align="left" style="padding-left: 160px;"><?php echo  display('cashinhand');?></td>                    
                            <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($cashOpening,2); ?></td>
                         </tr>
                         <tr>
                            <td align="left" style="padding-left: 160px;"><?php echo  display('cash_bank');?></td>                    
                            <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($bankOpening,2); ?></td>
                         </tr>
                         <tr>
                            <td align="left" style="padding-left: 160px;"><?php echo  display('advance');?></td>                    
                            <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($advOpening,2); ?></td>
                         </tr>



                     <tr> <td height="70"  align="left" colspan="2"><strong><?php echo display('receipt')?></strong></td> </tr>
                     <?php if(count($receiptitems) > 0) { $gtotal=0;
                       foreach($receiptitems as $receiptitem) { ?>
                    <tr>
                        <td  align="left"  style="padding-left: 80px;"><?php echo $receiptitem['headName'];?></td>
                        <td  align="right" ></td>
                    </tr>
                   
                    <?php if(count($receiptitem['innerHead']) > 0) { foreach($receiptitem['innerHead'] as $inner) { ?>
                <tr>
                    <td align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>                    
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['credit'],2); ?></td>
                 </tr>
                 <?php } } $gtotal += $inner['credit'];?> 
                   
             <?php } ?>               
                    <tr bgcolor="#E7E0EE">
                    <td   align="right"><strong><?php echo display('total');?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($gtotal ,2); ?></strong></td>                    
                 </tr> 
              <?php } ?>
               <tr bgcolor="#E7E0EE">
                    <td   align="right"><strong><?php echo display('gtotal');?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($gtotal+ $cashOpening+$bankOpening + $advOpening) ,2); ?></strong></td>                    
                 </tr> 

                            <tr> <td height="70"   align="left" colspan="2"><strong><?php echo display('payments')?></strong></td> </tr>
                     <?php if(count($paymentitems) > 0) { $pgtotal=0;
                       foreach($paymentitems as $paymentitem) { ?>
                    <tr>
                        <td  align="left"  style="padding-left: 80px;"><?php echo $paymentitem['headName'];?></td>
                        <td  align="right" ></td>
                    </tr>
                   
                    <?php if(count($paymentitem['innerHead']) > 0) { foreach($paymentitem['innerHead'] as $inner) { ?>
                <tr>
                    <td align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>                    
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['debit'],2); ?></td>
                 </tr>
                 <?php } } $pgtotal += $inner['debit'];?> 
                   
             <?php } ?>               
                    <tr bgcolor="#E7E0EE">
                    <td   align="right"><strong><?php echo display('total');?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($pgtotal ,2); ?></strong></td>                    
                 </tr> 
              <?php } ?>



             <tr> <td height="70"  align="left" colspan="2"><strong><?php echo display('closing_balance')?></strong></td> </tr>
             <tr>
                <td align="left" style="padding-left: 160px;"><?php echo display('cashinhand');?></td>                    
                <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($cashClosing,2); ?></td>
             </tr>
             <tr>
                <td align="left" style="padding-left: 160px;"><?php echo display('cash_bank');?></td>                    
                <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($bankClosing,2); ?></td>
             </tr>
             <tr>
                <td align="left" style="padding-left: 160px;"><?php echo display('advance');?></td>                    
                <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($advClosing,2); ?></td>
             </tr>
             <tr bgcolor="#E7E0EE">
                    <td   align="right"><strong><?php echo display('gtotal');?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($pgtotal+ $advClosing+$bankClosing + $cashClosing) ,2); ?></strong></td>                    
                 </tr> 
                
              </tbody>
              <tfoot>
                   <tr >
                    <td colspan="2" class="noborder">
                        <table border="0" width="100%">                                                
                        <tr>
                            <td align="left" class="noborder">
                                <div class="border-top"><?php echo display('prepared_by')?></div>
                            </td>
                            <td align="center"  class="noborder"> <div class="border-top"><?php echo display('checked_by')?></div>
                            </td>  
                             <td align="right"  class="noborder">
                                <div class="border-top"><?php echo display('authorised_by')?></div>
                            </td>
                        </tr>  
                     </table>  
                    </td>                    
                 </tr> 
              </tfoot>
             </table>
            
           </div>   
                
            </div>
            
        </div>  
        
    </div>
</div>
       