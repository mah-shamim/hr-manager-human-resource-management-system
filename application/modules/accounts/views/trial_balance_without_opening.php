<script src="<?php echo base_url('application/modules/accounts/assets/js/trial_balance_without_opening_script.js'); ?>" type="text/javascript"></script>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('trial_balance')?></h4>
                </div>
            </div>
            <div id="printArea">
                <div class="panel-body">
                    <table width="100%" class="table_boxnew trial_balance_with_opening_as_tp" >
                         <tr> <td colspan="4" align="center">
                        <h3 class=" trial_balance_without_openingpxbtn_font_family"><?php echo display('trial_balance')?><br/>
        <?php echo display('start_date');?> <?php echo $dtpFromDate; ?> <?php echo display('end_date');?> <?php echo $dtpToDate;?></h3></td></tr>
                        <tr class="table_head">
                        
                <td width="15%" align="center" class="trialsecondclass"><strong><?php echo display('code')?></strong></td>
                <td width="33%" align="center" class="trialsecondclass"><strong><?php echo display('account_name')?></strong></td>
                <td width="20%" align="center" class="trialsecondclass"><strong><?php echo display('debit')?></strong></td>
                            <td width="20%" align="center" class="trialsecondclass t_b_w_o_solid" ><strong><?php echo display('credit');?></strong></td>
                        </tr>
                        <?php
                            $TotalCredit=0;
                            $TotalDebit=0;  
                            $k=0;
                            $fyear = $this->session->userdata("fyear");

                            for($i=0;$i<count($oResultTr);$i++)
                            {

                                $COAID=$oResultTr[$i]['HeadCode'];
                                
                                $sql="SELECT SUM(acc_transaction.Debit) AS Debit, SUM(acc_transaction.Credit) AS Credit,VNo,Vtype,  VDate FROM acc_transaction WHERE acc_transaction.IsAppove =1 AND acc_transaction.fyear = '$fyear' AND VDate BETWEEN '$dtpFromDate' AND '$dtpToDate' AND COAID LIKE '$COAID%' ";
                                
                                $q1=$this->db->query($sql);
                                $oResultTrial = $q1->row();

                                $bg=$k&1?"#FFFFFF":"#E7E0EE";

                                if($oResultTrial->Credit != $oResultTrial->Debit)
                                {
                                 
                                    $k++; 
                        ?>
                        <tr class="table_data">                            
                            <td  align="left" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><a  href="javascript:" onClick=" return showTranDetail('<?php echo $oResultTr[$i]['HeadCode'];?>','<?php echo $dtpFromDate; ?>','<?php echo $dtpToDate;?>');"><?php echo $oResultTr[$i]['HeadCode'];?>
                               </a>
                              </td>
                              <td  align="left" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php echo $oResultTr[$i]['HeadName'];?></td>
                              <?php
                                if($oResultTrial->Debit>$oResultTrial->Credit)
                                {
                              ?>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php 
                                $TotalDebit += $oResultTrial->Debit-$oResultTrial->Credit;
                               echo number_format($oResultTrial->Debit-$oResultTrial->Credit,2);
                               ?></td>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php
                               echo number_format('0.00',2);?></td>
                               <?php
                                }
                                else
                                {
                                ?>
                                 <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php 
                               echo number_format('0.00',2);
                               ?></td>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php 
                                $TotalCredit += $oResultTrial->Credit-$oResultTrial->Debit;
                               echo number_format($oResultTrial->Credit-$oResultTrial->Debit,2);?></td>
                               <?php
                                }
                                ?>
                            </tr>
                        <?php
                                }
                            }
                            for($i=0;$i<count($oResultInEx);$i++)
                            {
                            $COAID=$oResultInEx[$i]['HeadCode'];
                            
                            $sql="SELECT SUM(acc_transaction.Debit) AS Debit, SUM(acc_transaction.Credit) AS Credit,VNo,Vtype,VDate FROM acc_transaction WHERE acc_transaction.IsAppove =1 AND acc_transaction.fyear = '$fyear' AND VDate BETWEEN '$dtpFromDate' AND '$dtpToDate' AND COAID LIKE '$COAID%' ";
                            
                            $q2=$this->db->query($sql);
                            $oResultTrial = $q2->row();

                            $bg=$k&1?"#FFFFFF":"#E7E0EE";
                            if($oResultTrial->Credit!=$oResultTrial->Debit)
                            {
                              
                                $k++; ?>
                            <tr class="table_data">
                           
                              <td  align="left" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><a href="javascript:;" onClick="return showTranDetail('<?php echo $oResultInEx[$i]['HeadCode'];?>','<?php echo $dtpFromDate; ?>','<?php echo $dtpToDate;?>');"><?php echo $oResultInEx[$i]['HeadCode'];?>
                               </a>
                              </td>
                              <td  align="left" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php echo $oResultInEx[$i]['HeadName'];?></td>
                              <?php
                                if($oResultTrial->Debit>$oResultTrial->Credit)
                                {
                              ?>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php 
                                $TotalDebit += $oResultTrial->Debit-$oResultTrial->Credit;
                               echo number_format($oResultTrial->Debit-$oResultTrial->Credit,2);
                               ?></td>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php
                               echo number_format('0.00',2);?></td>
                               <?php
                                }
                                else
                                {
                                ?>
                                 <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php 
                               echo number_format('0.00',2);
                               ?></td>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php 
                                $TotalCredit += $oResultTrial->Credit-$oResultTrial->Debit;
                               echo number_format($oResultTrial->Credit-$oResultTrial->Debit,2);?></td>
                               <?php
                                }
                                ?>
                            </tr>
                        <?php
                                }
                            }
            
                        $ProfitLoss=$TotalDebit-$TotalCredit;
                        if($ProfitLoss!=0)
                        {
                        ?>
                        <tr class="table_data">
                          <td align="left" bgcolor="<?php echo $bg;?>" class="trialsecondclass">&nbsp;</td>
                           <td  align="left" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php echo display('pflos') ?></td>
                         <?php
                        }
                         if($ProfitLoss<0)
                         {
                         ?>
                         <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php 
                            $TotalDebit += abs($ProfitLoss);
                           echo number_format( abs($ProfitLoss),2);
                           ?></td>
                          <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php
                           echo number_format('0.00',2);?></td>
                        <?php
                         echo "</tr>";
                        }
                        else if($ProfitLoss>0)
                        {
                        ?>
                        <td  align="right" bgcolor="<?php echo $bg;?>" class="trialsecondclass"><?php 
                           echo number_format('0.00',2);
                           ?></td>
                          <td  align="right" bgcolor="<?php echo $bg;?>"  class="trialsecondclass"><?php
                          $TotalCredit+= abs($ProfitLoss);
                           echo number_format(abs($ProfitLoss),2);?></td>
                         <?php
                         echo "</tr>";
                        }
                        ?>

                        <tr class="table_head">
                          <td colspan="2" align="right"  class="trialsecondclass"><strong><?php echo display('total') ?></strong></td>
                          <td align="right" class="trialsecondclass"><strong><?php echo number_format($TotalDebit,2); ?></strong></td>
                          <td align="right" class="trialsecondclass"><strong><?php echo number_format( $TotalCredit,2); ?></strong></td>
                        </tr>
                        <tr>
                          <td colspan="7" align="center">&nbsp;</td>
                        </tr>
                         <tr>
                          <td colspan="7" align="center">
                            <table width="100%" cellpadding="1" cellspacing="20" class="trial_balance_with_opening_mrt_50">
                                <tr>
                                    <td width="20%" class="trialsecondclass" align="center"><?php echo display('prepared_by');?></td>
                                    <td width="20%" class="trialsecondclass" align="center"><?php echo display('accounts');?></td>
                                    <td  width="20%" class="trialsecondclass" align='center'><?php echo display('chairman');?></td>
                                </tr>
                            </table>
                          </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="text-center trial_balance_with_opening_btn" id="print">
                <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/>
                <a href="<?php echo base_url($pdf)?>"download>
                    <input type="button" class="btn btn-success" name="btnPdf" id="btnPdf" value="PDF"/>
                </a>
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