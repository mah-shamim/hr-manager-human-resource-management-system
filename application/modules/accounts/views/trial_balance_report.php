<script src="<?php echo base_url('application/modules/accounts/assets/js/trial_balance_without_opening_script.js'); ?>" type="text/javascript"></script>
<div class="row">
     <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag">

                    <div class="panel-heading">
                        <div >
                            <h4><?php echo display('trial_balance_filter') ?></h4>
                        </div>
                    </div>

                    <div class="panel-body"> 
                        <?php echo form_open('accounts/trial_balance_report',array('class' => 'form-inline','method'=>'post'))?>
                       
                        
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
                <div >
                    <h4><?php echo display('trial_balance')?></h4>
                </div>
            </div>
            <div id="printArea">
                <div class="panel-body">
                    <table width="100%" class="table_boxnew trial_balance_with_opening_as_tp" >
                       <tr> 
                             <td colspan="4" align="center">
                                <h3 class=" trial_balance_without_openingpxbtn_font_family"><?php echo display('trial_balance')?><br/>
                                       <?php echo display('start_date');?> <?php echo $dtpFromDate; ?> <?php echo display('end_date');?> <?php echo $dtpToDate;?>
                                </h3><br/>
                             </td>
                        </tr>
                    </table>
                    <table width="99%" align="center" class="datatable table table-striped table-bordered table-hover general_ledger_report_tble" title="TriaBalanceReport<?php echo $dtpFromDate; ?><?php echo display('to_date');?><?php echo $dtpToDate;?>">

                        <thead>                          
                            <tr> 
                                <th>Code </th>
                                <th>Account Name </th>                               
                                <th>Opening Balance <br/> Debit </th>
                                <th>Opening Balance <br/> Credit</th>
                                <th>Transational Balance  <br/> Debit </th>
                                <th>Transational Balance  <br/> Credit</th>
                                <th>Closing Balance <br/> Debit </th>
                                <th>Closing Balance <br/> Credit</th>
                                
                            </tr>
                            
                        </thead>
                        <tbody>
                           
                        <?php if (count($results)> 0) {
                            $ix= 0;
                            $totalOpenDebit=0;
                            $totalOpenCredit=0;
                            $totalCurentDebit=0;
                            $totalCurentCredit=0;
                            $totalCloseDebit=0;
                            $totalCloseCredit=0;
                            $totalbalanceDebit=0;
                            $totalbalanceCredit=0;
                            foreach ($results as $result)  {  
                                $totalbalanceDebit=0;
                                $totalbalanceCredit=0;
                                $copenDebit=0;
                                $copenCredit=0;
                               
                               $resultDebit = ($result[0]->debit != null ? $result[0]->debit : '0');
                               $resultCredit = ($result[0]->credit != null ? $result[0]->credit : '0');  
                                if($result['HeadType'] == 'A' || $result['HeadType'] == 'E') { 
                                    if($openings[$result['HeadCode']] !=0) {
                                        $totalOpenDebit += $openings[$result['HeadCode']];
                                        $copenDebit     += $openings[$result['HeadCode']];                                       
                                    } 
                                    $totalbalanceDebit   +=  $copenDebit + ($resultDebit - $resultCredit);
                                } else { 
                                    if($openings[$result['HeadCode']] !=0) {
                                        $totalOpenCredit += $openings[$result['HeadCode']];
                                        $copenCredit     += $openings[$result['HeadCode']];
                                    } 
                                    $totalbalanceCredit  +=  $copenCredit + ($resultCredit - $resultDebit);  
                                }
                                                               
                                $totalCurentDebit   += $resultDebit; 
                                $totalCurentCredit  += $resultCredit;  
                                                           
                                $totalCloseDebit   += $totalbalanceDebit;
                                $totalCloseCredit  += $totalbalanceCredit; ?>
                                 <tr>                                     
                                     <td> 
                                        <a href="javascript:" onClick=" return showTranDetail('<?php echo $result['HeadCode'];?>','<?php echo $dtpFromDate; ?>','<?php echo $dtpToDate;?>');"><?php echo $result['HeadCode'];?>
                                        </a>
                                     </td>
                                     <td> <?php echo $result['HeadName'];?></td>
                                     <td> <?php if($result['HeadType'] == 'A' || $result['HeadType'] == 'E') { echo $setting->currency_symbol. ' '. number_format($openings[$result['HeadCode']],2,'.',',');} else { echo $setting->currency_symbol. ' '. '0.00';}?></td>
                                     <td><?php if($result['HeadType'] == 'L' || $result['HeadType'] == 'I') { echo $setting->currency_symbol. ' '. number_format($openings[$result['HeadCode']],2,'.',',');} else { echo $setting->currency_symbol. ' '. '0.00';}?> </td>
                                     <td><?php echo $setting->currency_symbol. ' '. $resultDebit ;?> </td>
                                     <td><?php echo $setting->currency_symbol. ' '. $resultCredit ;?> </td>
                                     <td><?php echo $setting->currency_symbol. ' '. number_format($totalbalanceDebit,2,'.',',');?> </td>
                                     <td><?php echo $setting->currency_symbol. ' '. number_format($totalbalanceCredit,2,'.',',');?> </td>
                                  </tr>
                           <?php } $ix++; }  ?>
                        </tbody>
                        <tfoot>
                            <tr>   
                                 <th colspan="2" align="right"> <strong><?php echo display('total')?> </strong></th>
                                 <th><strong><?php echo $setting->currency_symbol. ' '. number_format($totalOpenDebit,2,'.',',');?> </strong></th>
                                 <th><strong><?php echo $setting->currency_symbol. ' '. number_format($totalOpenCredit,2,'.',',');?> </strong></th>
                                 <th><strong><?php echo $setting->currency_symbol. ' '. number_format($totalCurentDebit,2,'.',',');?> </strong></th>
                                 <th><strong><?php echo $setting->currency_symbol. ' '. number_format($totalCurentCredit,2,'.',',');?> </strong></th>
                                 <th><strong><?php echo $setting->currency_symbol. ' '. number_format($totalCloseDebit,2,'.',',');?> </strong></th>
                                 <th><strong><?php echo $setting->currency_symbol. ' '. number_format($totalCloseCredit,2,'.',',');?> </strong></th>
                              </tr>                            
                        </tfoot>                        
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- view all transation modal -->
<div class="modal fade " id="allTransationModal" tabindex="-1" role="dialog" aria-labelledby="moduleModalLabel" aria-hidden="true" >
    <div class="modal-dialog custom-modal-dialog">
        <div class="modal-content " >
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" id="allAppointModalLabel">Transation Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body" id="all_transation_view"> 
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>