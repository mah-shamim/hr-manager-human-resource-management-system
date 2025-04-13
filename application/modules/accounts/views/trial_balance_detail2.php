<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            
         <div id="printArea">
            <table width="99%" align="center" class="datatable table table-striped table-bordered table-hover general_ledger_report_tble">
                <thead>
                <tr align="center">
                    <td colspan="9"><font size="+1"  class="general_ledger_report_fontfamily"> <strong><?php echo display('general_ledger_of').' '.$ledger->HeadName.' on '.date('d-m-Y', strtotime($dtpFromDate)). ' To '  .date('d-m-Y', strtotime($dtpToDate));?></strong></font><strong></th></strong>
                </tr>
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
                    <td  align="right"><?php echo $settings->currency_symbol. ' '. number_format(0,2,'.',','); ?></td>
                    <td  align="right"><?php echo $settings->currency_symbol. ' '. number_format(0,2,'.',','); ?></td>
                    <td  align="right"><strong><?php echo $settings->currency_symbol. ' '. number_format($prebalance,2,'.',','); ?></strong></td>
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
                   
                    <td align="right"><?php echo $settings->currency_symbol. ' '. number_format($data->Debit,2,'.',','); ?></td>
                    <td align="right"><?php echo $settings->currency_symbol. ' '. number_format($data->Credit,2,'.',','); ?></td>  
                                                   
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
                      <td align="right"><?php echo $settings->currency_symbol. ' '.  number_format($CurBalance,2,'.',','); ?></td>                       
               </tr>
              <?php } ?>
          <tfoot>
                <tr class="table_data"> 
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td colspan="3" align="right"><strong><?php echo display('total')?></strong></td>
                    <td align="right"><strong><?php echo  $settings->currency_symbol. ' '.number_format($TotalDebit,2,'.',','); ?></strong></td>
                    <td align="right"><strong><?php echo $settings->currency_symbol. ' '. number_format($TotalCredit,2,'.',','); ?></strong></td>
                    <td align="right"><strong><?php echo $settings->currency_symbol. ' '. number_format($CurBalance,2,'.',','); ?></strong></td>
                </tr>
           </tfoot>               
           </tbody>
                <h4>
                    <?php echo display('opening_balance')?> : <?php echo $settings->currency_symbol. ' '. number_format($prebalance,2,'.',','); ?>
                    <br /> <?php echo display('closing_balance')?> : <?php echo $settings->currency_symbol. ' '. number_format($CurBalance,2,'.',','); ?>
                </h4>
       </table>
    </div>

 </div>
</div></div>