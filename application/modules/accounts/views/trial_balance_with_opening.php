<script src="<?php echo base_url('application/modules/accounts/assets/js/trial_balance_with_opening_script.js'); ?>" type="text/javascript"></script>

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
                        <tr>
                            <td colspan="7" align="center">
                                <h3  class="trial_balance_with_opening_as_h3"><?php echo display('trial_balance_with_opening_as_on');?><br/>
                             <?php echo display('start_date');?> <?php echo $dtpFromDate; ?> <?php echo display('end_date');?> <?php echo $dtpToDate;?></h3>
                            </td>
                        </tr>
                        <tr class="table_head">
                        <td width="7%" align="center"  class="trial_balance_with_opening_mrt_tbl_t"><strong><?php echo display('voucher_no');?></strong></td>
                        <td width="7%" align="center"  class="trial_balance_with_opening_mrt_tbl_t"><strong><?php echo display('voucher_type');?></strong></td>
                        <td width="8%" align="center"  class="trial_balance_with_opening_mrt_tbl_t"><strong><?php echo display('transdate');?></strong></td>
                <td width="15%" align="center" class="trial_balance_without_opening_tp"><strong><?php echo display('code')?></strong></td>
                <td width="33%" align="center" class="trial_balance_without_opening_tp"><strong><?php echo display('account_name')?></strong></td>
                <td width="15%" align="center" class="trial_balance_without_opening_tp"><strong><?php echo display('debit')?></strong></td>
                            <td width="15%" align="center" class="trial_balance_with_opening_mrt_tbl_t t_b_w_o_solid" ><strong><?php echo display('credit');?></strong></td>
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
                            <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_without_opening_tb_l_s"><?php echo $oResultTrial->VNo;?></td>
                            <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_without_opening_tb_l_s"><?php echo $oResultTrial->Vtype;?></td>
                            <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_without_opening_tb_l_s"><?php echo $oResultTrial->VDate;?></td>
                            <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b"><a href="javascript:"><?php echo $oResultTr[$i]['HeadCode'];?>
                               </a>
                              </td>
                              <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b"><?php echo $oResultTr[$i]['HeadName'];?></td>
                              <?php
                                if($oResultTrial->Debit>$oResultTrial->Credit)
                                {
                              ?>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b"><?php 
                                $TotalDebit += $oResultTrial->Debit-$oResultTrial->Credit;
                               echo number_format($oResultTrial->Debit-$oResultTrial->Credit,2);
                               ?></td>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b_t"><?php
                               echo number_format('0.00',2);?></td>
                               <?php
                                }
                                else
                                {
                                ?>
                                 <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b"><?php 
                               echo number_format('0.00',2);
                               ?></td>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b_t"><?php 
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
                            <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_without_opening_tb_l_s"><?php echo $oResultTrial->VNo;?></td>
                    <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_without_opening_tb_l_s"><?php echo $oResultTrial->Vtype;?></td>
                    <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_without_opening_tb_l_s"><?php echo $oResultTrial->VDate;?></td>
                              <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b"><a href="javascript:"><?php echo $oResultInEx[$i]['HeadCode'];?>
                               </a>
                              </td>
                              <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b"><?php echo $oResultInEx[$i]['HeadName'];?></td>
                              <?php
                                if($oResultTrial->Debit>$oResultTrial->Credit)
                                {
                              ?>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b"><?php 
                                $TotalDebit += $oResultTrial->Debit-$oResultTrial->Credit;
                               echo number_format($oResultTrial->Debit-$oResultTrial->Credit,2);
                               ?></td>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b_t"><?php
                               echo number_format('0.00',2);?></td>
                               <?php
                                }
                                else
                                {
                                ?>
                                 <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b"><?php 
                               echo number_format('0.00',2);
                               ?></td>
                              <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b_t"><?php 
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
                          <td colspan="4" align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b">&nbsp;</td>
                           <td  align="left" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b"><?php echo display('pflos') ?></td>
                         <?php
                        }
                         if($ProfitLoss<0)
                         {
                         ?>
                         <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_all_b"><?php 
                            $TotalDebit += abs($ProfitLoss);
                           echo number_format( abs($ProfitLoss),2);
                           ?></td>
                          <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_mrt_sbottom"><?php
                           echo number_format('0.00',2);?></td>
                        <?php
                         echo "</tr>";
                        }
                        else if($ProfitLoss>0)
                        {
                        ?>
                        <td  align="right" bgcolor="<?php echo $bg;?>" class="trial_balance_with_opening_mrt_s"><?php 
                           echo number_format('0.00',2);
                           ?></td>
                          <td  align="right" bgcolor="<?php echo $bg;?>"  class="trial_balance_with_opening_mrt_bg_corbr"><?php
                          $TotalCredit+= abs($ProfitLoss);
                           echo number_format(abs($ProfitLoss),2);?></td>
                         <?php
                         echo "</tr>";
                        }
                        ?>

                        <tr class="table_head">
                          <td colspan="5" align="right"  class="trial_balance_with_opening_mrt_bl_bb_bt"><strong><?php echo display('total') ?></strong></td>
                          <td align="right" class="trial_balance_with_opening_mrt_left_rr"><strong><?php echo number_format($TotalDebit,2); ?></strong></td>
                          <td align="right" class="trial_balance_with_opening_mrt_left_right"><strong><?php echo number_format( $TotalCredit,2); ?></strong></td>
                        </tr>
                        <tr>
                          <td colspan="7" align="center">&nbsp;</td>
                        </tr>
                         <tr>
                          <td colspan="7" align="center">
                            <table width="100%" cellpadding="1" cellspacing="20" class="trial_balance_with_opening_mrt_50">
                                <tr>
                                    <td width="20%" class="trial_balance_with_opening_border" align="center"><?php echo display('prepared_by');?></td>
                                    <td width="20%" class="trial_balance_with_opening_border" align="center"><?php echo display('accounts');?></td>
                                    <td  width="20%" class="trial_balance_with_opening_border" align='center'><?php echo display('chairman');?></td>
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