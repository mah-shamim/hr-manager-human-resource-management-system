<script src="<?php echo base_url('application/modules/accounts/assets/js/trial_balance_without_opening_script.js'); ?>" type="text/javascript"></script>
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
                                <h3><?php echo display('trial_balance')?> <?php echo display('from_date')?>  <?php echo date('d-m-Y', strtotime($dtpFromDate)) ;?> <?php echo display('to_date')?>  <?php echo date('d-m-Y', strtotime($dtpToDate)) ;?></h3>
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
                               
                               
                                if($result['HeadType'] == 'A' || $result['HeadType'] == 'E') { 
                                    if($openings[$result['HeadCode']] !=0) {
                                        $totalOpenDebit += $openings[$result['HeadCode']];
                                        $copenDebit     += $openings[$result['HeadCode']];                                       
                                    }                                  

                                } else { 
                                    if($openings[$result['HeadCode']] !=0) {
                                        $totalOpenCredit += $openings[$result['HeadCode']];
                                        $copenCredit     += $openings[$result['HeadCode']];
                                    } 
                                }
                                
                                if($result[0]->debit != null) {
                                 $totalCurentDebit   += $result[0]->debit;                                
                               } 
                               if($result[0]->credit != null) {
                                 $totalCurentCredit  += $result[0]->credit; 
                                }  
                                
                                $totalbalanceDebit   +=  $copenDebit + ($result[0]->debit != null? $result[0]->debit : '0');
                                $totalbalanceCredit  +=  $copenCredit + ($result[0]->credit != null ? $result[0]->credit : '0') ;                             
                                 $totalCloseDebit   += $totalbalanceDebit;
                                 $totalCloseCredit  += $totalbalanceCredit; ?>
                                 <tr>                                     
                                     <td> 
                                        <a href="javascript:" onClick=" return showTranDetail('<?php echo $result['HeadCode'];?>','<?php echo $dtpFromDate; ?>','<?php echo $dtpToDate;?>');"><?php echo $result['HeadCode'];?>
                                        </a>
                                     </td>
                                     <td> <?php echo $result['HeadName'];?></td>
                                     <td> <?php if($result['HeadType'] == 'A' || $result['HeadType'] == 'E') { echo number_format($openings[$result['HeadCode']],2,'.',',');} else { echo '0.00';}?></td>
                                     <td><?php if($result['HeadType'] == 'L' || $result['HeadType'] == 'I') { echo number_format($openings[$result['HeadCode']],2,'.',',');} else { echo '0.00';}?> </td>
                                     <td><?php echo $result[0]->debit != null?$result[0]->debit: '0.00' ;?> </td>
                                     <td><?php echo $result[0]->credit!= null?$result[0]->credit: '0.00';?> </td>
                                     <td><?php echo number_format($totalbalanceDebit,2,'.',',');?> </td>
                                     <td><?php echo number_format($totalbalanceCredit,2,'.',',');?> </td>
                                  </tr>
                           <?php } $ix++; }  ?>
                        </tbody>
                        <tfoot>
                            <tr>   
                                 <th colspan="2" align="right"> <strong><?php echo display('total')?> </strong></th>
                                 <th><strong><?php echo number_format($totalOpenDebit,2,'.',',');?> </strong></th>
                                 <th><strong><?php echo number_format($totalOpenCredit,2,'.',',');?> </strong></th>
                                 <th><strong><?php echo number_format($totalCurentDebit,2,'.',',');?> </strong></th>
                                 <th><strong><?php echo number_format($totalCurentCredit,2,'.',',');?> </strong></th>
                                 <th><strong><?php echo number_format($totalCloseDebit,2,'.',',');?> </strong></th>
                                 <th><strong><?php echo number_format($totalCloseCredit,2,'.',',');?> </strong></th>
                              </tr>                            
                        </tfoot>                        
                    </table>
                </div>

                </div>
            </div>          
        </div>
    </div>
</div>