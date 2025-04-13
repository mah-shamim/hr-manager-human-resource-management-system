<style type="text/css">
    @media print {
      table.datatable {       
        border-collapse: collapse;
        border: 0;
    }
    table.datatable td, table.datatableReport th {
        padding: 6px 15px;
    }
    table.datatable td, table.datatableReport th {
        border: 1px solid #ededed;
        border-collapse: collapse;
    }
table.signature td.noborder {
    border: none;
    padding-top: 40px;
 }
}
</style>
<script src="<?php echo base_url('application/modules/accounts/assets/js/general_ledger_report_script.js'); ?>" type="text/javascript"></script>
<div class="row">
     <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag">

                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('general-ledger-filter') ?></h4>
                        </div>
                    </div>

                    <div class="panel-body"> 
                        <?php echo form_open('accounts/accounts/accounts_report_search',array('class' => 'form-inline','method'=>'post'))?>
                        <div class="form-group form-group-margin">
                                <label for="employeelist"><?php echo display('transaction_head')?>:</label>
                              
                            </div> 
                         <div class="form-group form-group-new empdropdown">
                               
                                <select class="form-control" name="cmbCode" id="cmbCode">
                                    <option></option>
                                    <?php
                                    foreach($general_ledger as $g_data){
                                        ?>
                                        <option value="<?php echo $g_data->HeadCode;?>" <?php echo  $g_data->HeadCode == $cmbCode  ? 'selected' : '' ;?> ><?php echo $g_data->HeadName;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div> 
                            <div class="form-group form-group-new">
                                <label for="dtpFromDate"><?php echo display('from_date')?> :</label>
                                <input type="text" name="dtpFromDate"  value="<?php echo   isset($dtpFromDate)? $dtpFromDate : date('Y-m-d'); ?>" class="datepicker form-control" />
                            </div> 
                          <div class="form-group form-group-new">
                                <label for="dtpToDate"><?php echo display('to_date')?> :</label>
                                <input type="text" class="datepicker form-control" name="dtpToDate" value="<?php echo  isset($dtpToDate)? $dtpToDate : date('Y-m-d'); ?>"  />
                            </div> 
                            <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                          
                       <?php echo form_close()?>
                    </div> 
             </div>
       </div>
 </div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php echo display('general_ledger');?>
                    </h4>
                </div>
            </div>
         <div id="printArea">
            <table width="99%"  class="table table-striped table-bordered table-hover general_ledger_report_tble"> 
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
            </tbody>
            <tfoot>
                   <tr >
                    <td colspan="9" class="noborder">
                        <table class="signature" border="0" width="100%" style="margin-top:100px;">                                                
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
           
                <h4 style="margin-left: 10px; margin-top: 15px;">
                    <?php echo display('opening_balance')?> : <?php echo $setting->currency_symbol. ' '. number_format($prebalance,2,'.',','); ?>
                    <br /> <?php echo display('closing_balance')?> : <?php echo $setting->currency_symbol. ' '. number_format($CurBalance,2,'.',','); ?>
                </h4>
       </table>
    </div>
    
  <div class="text-center" id="print">                

                <button class="btn btn-warning btn-md" name="btnPrint" id="btnPrint"  onclick="printDiv('printArea');"><i class="fa fa-print"></i> Print </button>
             <a href="<?php echo base_url($pdf)?>" target="_blank" title="download pdf">
                    <button  class="btn btn-success btn-md" name="btnPdf" id="btnPdf" ><i class="fa-file-pdf-o"></i> PDF</button>
             </a>
              <a href="<?php echo base_url('accounts/general_ledger_report_excel/'.$dtpFromDate.'/'.$dtpToDate.'/'.$cmbCode)?>" target="_blank" title="download Excel">
                    <button  class="btn btn-primary btn-md" name="btnexcel" id="btnexcel" ><i class="fa fa-file-excel-o"></i> Excel</button>
             </a>




            </div>
 </div>
</div></div>