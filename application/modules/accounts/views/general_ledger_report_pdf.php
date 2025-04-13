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
    padding-top: 40px;
}
</style>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">            
         <div id="printArea">
            <div class="table-responsive">
                <table border="0" width="99%" >                                                
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
                            <h3><?php echo display('general_ledger_of').' '.$ledger->HeadName.' on '.date('d-m-Y', strtotime($dtpFromDate)). ' To '  .date('d-m-Y', strtotime($dtpToDate));?></h3>
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
            <table width="99%"  class="datatableReport table table-striped table-bordered table-hover general_ledger_report_tble"> 
                <thead>               
                <tr>
                    <td height="25" width="5%"><strong><?php echo display('sl');?></strong></td>
                    <td  width="10%"><strong><?php echo display('transdate');?></strong></td>
                    <td width="10%"><strong><?php echo display('voucher_no');?></strong></td>
                    <td width="8%"><strong><?php echo display('voucher_type');?></strong></td>
                    
                    <td width="12%"><strong><?php echo "Head Name";?></strong></td>
                    
                     <td width="25%"><strong><?php echo display('ledger_comment')?></strong></td>
                   
                    <td width="10%" align="right"><strong><?php echo display('debit');?></strong></td>
                    <td width="10%" align="right"><strong><?php echo display('credit');?></strong></td>
                    <td width="10%" align="right"><strong><?php echo display('balance');?></strong></td>
                </tr>
                </thead>
                <tbody>
                <?php              
                $TotalCredit=0;
                $TotalDebit  = 0;
                $CurBalance =$prebalance;
                $openid = 1; ?>
               <tr>
                    <td height="25"><?php echo $openid ;?></td>
                    <td><?php echo date('d-m-Y', strtotime($dtpFromDate)); ?></td>
                    
                    <td colspan="4"  align="right"> <strong>Opening Balance</strong></td>
                    <td  align="right"><?php echo $setting->currency_symbol. ' '. number_format(0,2,'.',','); ?></td>
                    <td  align="right"><?php echo $setting->currency_symbol. ' '. number_format(0,2,'.',','); ?></td>
                    <td  align="right"><strong><?php echo $setting->currency_symbol. ' '. number_format($prebalance,2,'.',','); ?></strong></td>
                </tr>
                <?php  
                foreach($HeadName2 as $key=>$data) { ?>
                <tr>
                    <td height="25"><?php echo (++$key + $openid) ;?></td>
                    <td><?php echo date('d-m-Y', strtotime($data->VDate)); ?></td>
                    <td><?php echo $data->VNo; ?></td>
                    <td><?php if($data->Vtype=='DV') {echo 'Debit';} else if($data->Vtype=='CV') { echo 'Credit';} else if ($data->Vtype=='JV') { echo 'Journal';} else { echo 'Contra';} ?></td>                        
                    <td><?php echo $data->HeadName; ?></td>
                    <td><?php echo $data->ledgerComment; ?></td>  
                   
                    <td align="right"><?php echo $setting->currency_symbol. ' '. number_format($data->Debit,2,'.',','); ?></td>
                    <td align="right"><?php echo $setting->currency_symbol. ' '. number_format($data->Credit,2,'.',','); ?></td>  
                                                   
                    <?php 
                     $TotalDebit += $data->Debit;
                     $TotalCredit += $data->Credit;
                     if($HeadName->HeadType == 'A' || $HeadName->HeadType == 'E') {
                          if($data->Debit > 0) {
                            $CurBalance += $data->Debit;
                          }
                          if($data->Credit > 0) {
                            $CurBalance -= $data->Credit;
                          }                          
                      } else {                       
                        if($data->Debit > 0) {
                            $CurBalance -= $data->Debit;
                          }                          
                          if($data->Credit > 0) {
                            $CurBalance += $data->Credit;
                          } 
;                     } ?>
                      <td align="right"><?php echo $setting->currency_symbol. ' '.  number_format($CurBalance,2,'.',','); ?></td>                       
               </tr>
              <?php } ?>
               <tr class="table_data"> 
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td colspan="3" align="right"><strong><?php echo display('total')?></strong></td>
                    <td align="right"><strong><?php echo $setting->currency_symbol. ' '. number_format($TotalDebit,2,'.',','); ?></strong></td>
                    <td align="right"><strong><?php echo $setting->currency_symbol. ' '. number_format($TotalCredit,2,'.',','); ?></strong></td>
                    <td align="right"><strong><?php echo $setting->currency_symbol. ' '. number_format($CurBalance,2,'.',','); ?></strong></td>
                </tr>
                <tr>
                    <td  style=" padding-top: 15px; font-weight: bold; font-size: 18px;" colspan="7">
                    <?php echo display('opening_balance')?> : <?php echo $setting->currency_symbol. ' '. number_format($prebalance,2,'.',','); ?>
                    <br /> <?php echo display('closing_balance')?> : <?php echo $setting->currency_symbol. ' '. number_format($CurBalance,2,'.',','); ?>
                </td>
                </tr>
               <tfoot>
                   <tr >
                    <td colspan="7" class="noborder">
                        <table border="0" width="100%" style="padding-top:100px;">                                                
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
</div></div>