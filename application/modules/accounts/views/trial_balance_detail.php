<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">           
         <div id="printArea">
            <table width="99%" align="center" class="general_ledger_report_tble"  cellpadding="5" cellspacing="5" border="2"> 
                <thead>
                <tr align="center">

                    <td colspan="7"><font size="+1"  class="general_ledger_report_fontfamily"> <strong><?php echo display('general_ledger_of').' '. $achead->HeadName.' on '.date('d-m-Y', strtotime($sdate)). ' To '  . date('d-m-Y', strtotime($edate));?></strong></font><strong></th></strong>
                </tr>

                <tr>
                    <td height="25"><strong><?php echo display('sl');?></strong></td>
                    <td align="center"><strong><?php echo display('transdate');?></strong></td>
                    <td><strong><?php echo display('voucher_no');?></strong></td>
                    <td><strong><?php echo display('voucher_type');?></strong></td>                   
                    <td><strong><?php echo "Head Name";?></strong></td>
                    <td><strong><?php echo display('particulars')?></strong></td>
                    <td align="right"><strong><?php echo display('debit');?></strong></td>
                    <td align="right"><strong><?php echo display('credit');?></strong></td>
                    <td align="right"><strong><?php echo display('balance');?></strong></td>
                </tr>
                </thead>
                <tbody>

              <?php
                $TotalCredit=0;
                $TotalDebit  = 0; 
                $CurBalance = 0;
               
                foreach($results as $key=>$data) { ?>
                <tr>
                    <td  colspan="9"><?php echo $key;?></td>
                </tr>
                <?php $totalrow = count($data);  $si=1;  $indvTotalCredit=0; $indvTotalDebit  = 0; $indCurBalance = 0;
                 foreach($data as $child){ ?>
                    <tr>
                        <td height="25"><?php echo $si;?></td>
                        <td align="center"><?php echo date('d-m-Y', strtotime($child['VDate'])); ?></td>
                        <td><?php echo $child['VNo']; ?></td>
                        <td><?php echo $child['Vtype']; ?></td>                       
                        <td><?php echo $child['HeadName']; ?></td>                       
                        <td><?php echo $child['Narration']; ?></td>                            
                       
                        <td align="right"><?php echo $settings->currency_symbol. ' '. number_format($child['Debit'],2,'.',','); ?></td>
                        <td align="right"><?php echo $settings->currency_symbol. ' '. number_format($child['Credit'],2,'.',','); ?></td>
                        <?php 
                            $indvTotalDebit += $child['Debit'];
                            $indCurBalance += $child['Debit'];
    
                            $indvTotalCredit += $child['Credit'];
                            $indCurBalance -= $child['Credit'];                      
                        ?>
                        <td align="right"><?php echo  number_format($indCurBalance,2,'.',','); ?></td>
                       
                    </tr>
                      <?php  $si++; 
                      if( $si > $totalrow) { ?>
                        <tr>
                             <th align="right" height="40" colspan="6"> Total </th>
                             <th align="right"><?php echo $settings->currency_symbol. ' '. number_format($indvTotalDebit,2,'.',',');?></th>
                             <th align="right"><?php echo $settings->currency_symbol. ' '. number_format($indvTotalCredit,2,'.',',');?></th>
                             <th align="right"><?php echo $settings->currency_symbol. ' '. number_format($indCurBalance,2,'.',','); ?></th>
                        </tr>
                     <?php }                
                    } 
                    $TotalDebit += $indvTotalDebit;
                    $CurBalance += $indvTotalDebit;
                    $TotalCredit += $indvTotalCredit;
                    $CurBalance -= $indvTotalCredit;
                } ?>

                <tfoot>
                <tr class="table_data">
                    
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td colspan="3" align="right"><strong> Grand Total </strong></td>
                    <td align="right"><strong><?php echo $settings->currency_symbol. ' '. number_format($TotalDebit,2,'.',','); ?></strong></td>
                    <td align="right"><strong><?php echo  $settings->currency_symbol. ' '.number_format($TotalCredit,2,'.',','); ?></strong></td>
                    <td align="right"><strong><?php echo $settings->currency_symbol. ' '.   number_format($CurBalance,2,'.',','); ?></strong></td>
                </tr>
                </tfoot>
                <?php
                //}
                ?>
                </tbody>  
                <h4>
                   <?php echo display('pre_balance')?> : <?php echo $settings->currency_symbol. ' '. number_format($prebalance,2,'.',',');?>
                    <br /> <?php echo display('current_balance')?> : <?php echo $settings->currency_symbol. ' '. number_format($CurBalance,2,'.',','); ?>             
                </h4>
            </table>
        </div>
            <div class="text-center general_ledger_report_btn" id="print">
                <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/>
                
            </div>
        </div>
    </div></div>