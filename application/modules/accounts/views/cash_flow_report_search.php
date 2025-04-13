
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4></h4>
                </div>
            </div>
            <div id="printArea">
                <div class="panel-body">
                  <div>
                       <table border="0" width="100%">
                                                
                                                 <tr>
                                                    <td align="left" class="account-logocontent">
                                                        <img src="<?php echo base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png')) ?>" alt="logo">
                                                    </td>
                                                    <td align="center" class="account-logocontent">
                                                        <span class="account-companycontent" >
                                                            <?php echo $setting->title;?>
                                                           
                                                        </span><br>
                                                        <?php echo $setting->address;?>
                                                        
                                                        
                                                    </td>
                                                   
                                                     <td align="right" class="account-logocontent">
                                                        <date>
                                                        <?php echo display('date')?>: <?php
                                                        echo date('d-M-Y');
                                                        ?> 
                                                    </date>
                                                    </td>
                                                </tr>      
                                   
                                </table>
                      <table width="100%" class="table_boxnew" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="3" align="center"><h2><?php echo display('cash_flow_statement');?>  </h2></td>
                        </tr>
                        <tr class="table_head">
                            <td colspan="3" align="center" class="cashflow-head" ><b>On <?php echo $dtpFromDate; ?> To <?php echo $dtpToDate;?></b></td>
                        </tr>
                        <tr class="table_head">
                            <td width="73%" height="29" class="acc-particulars" align="center"><b>Particulars</b></td>
                            <td width="2%">&nbsp;</td>
                            <td width="30%" align="right" class="particular-text"><b><?php echo display('amount_in_Dollar');?></b></td>
                        </tr>
                         <tr class="table_head">
                          <td colspan="3" class="cashflow-head"><strong><?php echo display('opening_cash_and_equivalent');?>:</strong></td>
                        </tr>
                        <?php
                          $sql="SELECT * FROM acc_coa WHERE acc_coa.IsTransaction=1 AND acc_coa.HeadType='A' AND acc_coa.IsActive=1 AND acc_coa.HeadCode LIKE '1020101%'";

                          $sql = $this->db->query($sql);
                          $oResultAsset = $sql->result();
                  
                          $TotalOpening=0;
                          for($i=0;$i<count($oResultAsset);$i++)
                          {
                            $COAID=$oResultAsset[$i]->HeadCode;
                            $sql="SELECT SUM(acc_transaction.Debit)- SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%'";

                            $sql1 = $this->db->query($sql);
                            $oResultAmountPre = $sql1->row();
                            if($oResultAmountPre->Amount!=0)
                            {
                        ?>
                          <tr >
                              <td align="left" class="cashflow-head"><?php echo $oResultAsset[$i]->HeadName; ?></td>
                              <td>&nbsp;</td>
                              <td align="right"  class="acc_cashflowamount acc_cashflowamount <?php if($TotalOpening==0) echo "acc_cashflow_commonborder"; ?>">
                                  <?php 
                                      $Total=$oResultAmountPre->Amount;
                                      echo number_format($Total);
                              
                                      $TotalOpening+=$Total; 
                                  ?>
                              </td>
                          </tr>
                                <?php
                            }
                          }
                        ?>
                        <tr>
                          <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="acc_cashflow_commonborder">&nbsp;</td>
                        </tr>
                        <tr>
                         <td align="left" class="cashflow-quipment"><strong>Total Opening Cash & Cash Equivalent</strong></td>
                          <td>&nbsp;</td>
                           <td align="right" class="casflow-total"><strong><?php echo number_format($TotalOpening); ?></strong></td>
                        </tr>
                        <tr class="table_head">
                            <td colspan="3" class="openingbalance-other"><b>Cashflow from Operating Activities</b></td>
                        </tr>
                        <?php
                            $TotalCurrAsset=0;
                            $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '102%' AND IsActive=1 AND HeadCode NOT LIKE '1020101%' AND HeadCode!='102' ";

                            $sql2 = $this->db->query($sql);
                            $oResultCurrAsset = $sql2->result();

                            for($s=0;$s<count($oResultCurrAsset);$s++)
                            {
                              $COAID=$oResultCurrAsset[$s]->HeadCode;
                              $sql="SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%') ";

                              $sql3 = $this->db->query($sql);
                              $oResultAmount = $sql3->row();

                              if($oResultAmount->Amount!=0)
                              {
                                ?>
                                <tr >
                                    <td align="left" class="acc-head-cashflow" ><?php echo $oResultCurrAsset[$s]->HeadName; ?></td>
                                    <td>&nbsp;</td>
                                    <td align="right" class="acc_cashflow_curasset <?php if($TotalCurrAsset==0) echo "acc_cashflow_commonborder"; ?>" >
                                        <?php 
                                            $Total=$oResultAmount->Amount;
                                            echo number_format($Total);
                                            $TotalCurrAsset+=$Total; 
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                          }
                        $sql="SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '4%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%') ";

                        $sql4 = $this->db->query($sql);
                        $oResultAmount = $sql4->row();

                        if($oResultAmount->Amount!=0)
                        {
                          ?>
                         <tr>
                            <td align="left" class="acc-head-cashflow" >Payment for Other Operating Activities</td>
                            <td>&nbsp;</td>
                            <td align="right" class="cashflow-totalamount">
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total,2);
                                    $TotalCurrAsset+=$Total; 
                                ?>
                            </td>
                        </tr>
                        <?php
                      }
                      ?>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td class="acc_cashflow_commonborder">&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cashflow-quipment"><strong>Cash generated from Operating Activites before Changing in Opereating Assets &amp; Liabilities</strong></td>
                             <td>&nbsp;</td>
                           <td align="right" class="casflow-total"><strong><?php echo number_format($TotalCurrAsset); ?></strong></td>
                        </tr>
                        
                        <tr class="table_head">
                            <td colspan="3" class="openingbalance-other"><b>Cashflow from Non Operating Activities</b></td>
                        </tr>
                        <?php
                          $TotalCurrAssetNon=0;
                          $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '3%' AND IsActive=1 ";

                          $sql5 = $this->db->query($sql);
                          $oResultCurrAsset = $sql5->result();

                          for($s=0;$s<count($oResultCurrAsset);$s++)
                          {
                          $COAID=$oResultCurrAsset[$s]->HeadCode;
                          $sql="SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%') ";

                          $sql6 = $this->db->query($sql);
                          $oResultAmount = $sql6->row();

                          if($oResultAmount->Amount!=0)
                          {
                        ?>
                          <tr>
                              <td align="left" class="acc-head-cashflow" ><?php echo $oResultCurrAsset[$s]->HeadName; ?></td>
                              <td>&nbsp;</td>
                              <td align="right" class="cashflow-totalamount <?php if($TotalCurrAssetNon==0) echo "acc_cashflow_commonborder"; ?>">
                          <?php 
                              $Total=$oResultAmount->Amount;
                              echo number_format($Total);
                              $TotalCurrAssetNon+=$Total; 
                          ?>
                              </td>
                          </tr>
                        <?php
                            }
                          }
                        ?>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td class="acc_cashflow_commonborder">&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cashflow-quipment"><strong>Cash generated from Non Operating Activites before Changing in Opereating Assets &amp; Liabilities</strong></td>
                             <td>&nbsp;</td>
                           <td align="right" class="casflow-total"><strong><?php echo number_format($TotalCurrAssetNon); ?></strong></td>
                        </tr>
                        <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                         <tr class="table_head">
                            <td align="left" class="cashflow-quipment"><strong>Increase/Decrease in Operating Assets &amp; Liabilites</strong></td>
                           <td>&nbsp;</td>
                           <td align="right" class="padding-ten">&nbsp;</td>
                      </tr>
                        
                      <?php
                      $TotalCurrLiab=0;
                      $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '20101%' AND HeadCode!=20101 AND IsActive=1";

                      $sql6 = $this->db->query($sql);
                      $oResultLiab = $sql6->result();

                      for($t=0;$t<count($oResultLiab);$t++)
                      {
                      $COAID=$oResultLiab[$t]->HeadCode;

                      $sql="SELECT SUM(acc_transaction.Credit)-SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";
                      $oResultAmount=$oAccount->SqlQuery($sql);

                      $sql7 = $this->Db->query($sql);
                      $oResultAmount = $sql7->row();

                      if($oResultAmount->Amount!=0)
                      {
                        ?>
                        <tr >
                            <td align="left"  class="acc-head-cashflow" ><?php echo $oResultLiab[$t]->HeadName; ?></td>
                            <td>&nbsp;</td>
                            <td align="right" class="acc_cashflowamount <?php if($TotalCurrLiab==0) echo "acc_cashflow_commonborder"; ?>"  >
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total);
                                    $TotalCurrLiab+=$Total;
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                          }
                        ?>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td class="acc_cashflow_commonborder">&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cashflow-quipment"><strong>Total Increase/Decrease</strong></td>
                             <td>&nbsp;</td>
                           <td align="right" class="casflow-total"><strong><?php echo number_format($TotalCurrLiab); ?></strong></td>
                        </tr>
                       <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left" class="cashflow-quipment"><strong>Net Cash From Operating/Non Operating Activities</strong></td>
                            <td>&nbsp;</td>
                            <td align="right" class="casflow-total"><strong><?php echo number_format($TotalCurrAsset+$TotalCurrAssetNon+$TotalCurrLiab); ?></strong></td>
                        </tr>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                        <tr class="table_head">
                            <td colspan="3" class="openingbalance-other"><b>Cash Flow from Investing Activities</b></td>
                        </tr>
                        <?php
                        $TotalNonCurrAsset=0;
                        $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '101%' AND HeadCode!=101 AND IsActive=1";

                        $sql9 = $this->db->query($sql);
                        $oResultNonCurrAsset = $sql9->result();

                        for($t=0;$t<count($oResultNonCurrAsset);$t++)
                        {
                        $COAID=$oResultNonCurrAsset[$t]->HeadCode;

                        $sql="SELECT SUM(acc_transaction.Debit)-SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";

                        $sql8 = $this->db->query($sql);
                        $oResultAmount = $sql8->row();

                        if($oResultAmount->Amount!=0)
                        {
                        ?>
                        <tr >
                            <td align="left" class="acc-head-cashflow" ><?php echo $oResultNonCurrAsset[$t]->HeadName; ?></td>
                            <td>&nbsp;</td>
                            <td align="right" class="acc_cashflowamount <?php if($TotalNonCurrAsset==0) echo "acc_cashflow_commonborder"; ?>">
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total,2);
                                    $TotalNonCurrAsset+=$Total;
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                          }
                        ?>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td class="acc_cashflow_commonborder">&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cashflow-quipment"><strong>Net Cash Used Investing Activities</strong></td>
                            <td>&nbsp;</td>
                            <td align="right" class="total-non-currentasset"><strong><?php echo number_format($TotalNonCurrAsset); ?></strong></td>
                        </tr>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                       
                        <tr class="table_head">
                            <td colspan="3" class="openingbalance-other"><b>Cash Flow from Financing Activities</b></td>
                        </tr>
                        <?php
                        $TotalNonCurrLiab=0;
                        $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '20102%' AND IsActive=1";

                        $sql10 = $this->db->query($sql);
                        $oResultNonCurrLiab = $sql10->result();

                        for($t=0;$t<count($oResultNonCurrLiab);$t++)
                        {
                        $COAID=$oResultNonCurrLiab[$t]->HeadCode;

                        $sql="SELECT SUM(acc_transaction.Credit)-SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";

                        $sql11 = $this->db->query($sql);
                        $oResultAmount = $sql11->row();

                        if($oResultAmount->Amount!=0)
                        {
                            ?>
                        <tr >
                            <td align="left" class="acc-head-cashflow" ><?php echo $oResultNonCurrLiab[$t]->HeadName; ?></td>
                            <td>&nbsp;</td>
                            <td align="right" class="acc_cashflowamount <?php if($TotalNonCurrLiab==0) echo "acc_cashflow_commonborder"; ?>">
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total);
                                    $TotalNonCurrLiab+=$Total;
                                ?>
                            </td>
                        </tr>
                        <?php
                          }
                        }
                        ?>
                        <?php
                        $TotalFund=0;
                        $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '202%' AND IsActive=1";

                        $sql12 = $this->db->query($sql);
                        $oResultFund = $sql12->result();


                        for($t=0;$t<count($oResultFund);$t++)
                        {
                        $COAID=$oResultFund[$t]->HeadCode;

                        $sql="SELECT SUM(acc_transaction.Credit)-SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";

                        $sql13 = $this->db->query($sql);
                        $oResultAmount = $sql13->row();

                        if($oResultAmount->Amount!=0)
                        {
                        ?>
                        <tr >
                            <td align="left" class="acc-head-cashflow" ><?php echo $oResultFund[$t]->HeadName; ?></td>
                            <td>&nbsp;</td>
                            <td align="right" class="acc_cashflowamount">
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total,2);
                                    $TotalFund+=$Total;
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                          }
                        ?>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td class="acc_cashflow_commonborder">&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cashflow-quipment"><strong>Net  Cash Used Financing Activities</strong></td>
                            <td>&nbsp;</td>
                            <td align="right" class="totalfund-liab"><strong><?php echo number_format($TotalFund+$TotalNonCurrLiab); ?></strong></td>
                        </tr>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="padding-left"><strong>Net Cash Inflow/Outflow (Profit Loss <?php echo number_format($TotalCurrAsset+$TotalCurrAssetNon+$TotalCurrLiab+$TotalNonCurrAsset+$TotalFund+$TotalNonCurrLiab); ?>)</strong></td>
                            <td>&nbsp;</td>
                            <td align="right" class="casflow-total"><strong><?php echo number_format($TotalCurrAsset+$TotalCurrAssetNon+$TotalCurrLiab+$TotalNonCurrAsset+$TotalFund+$TotalNonCurrLiab+$TotalOpening); ?></strong></td>
                        </tr>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                      
                      <tr class="table_head">
                          <td colspan="3" class="acc-head-cashflow" ><strong>Closing Cash & Cash Equivalent:</strong></td>
                        </tr>
                      <?php
                        $sql="SELECT * FROM acc_coa WHERE acc_coa.IsTransaction=1 AND acc_coa.HeadType='A' AND acc_coa.IsActive=1 AND acc_coa.HeadCode LIKE '1020101%' ";

                        $sql14 = $this->db->query($sql);
                        $oResultAsset = $sql14->result();

                        $TotalAsset=0;
                        for($i=0;$i<count($oResultAsset);$i++)
                        {
                          $COAID=$oResultAsset[$i]->HeadCode;
                          $sql="SELECT SUM(acc_transaction.Debit)- SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN  '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%'";

                          $sql15 = $this->db->query($sql);
                          $oResultAmount = $sql15->row();

                          if($oResultAmount->Amount!=0)
                          {
                      ?>
                        <tr >
                            <td align="left" class="acc-head-cashflow" ><?php echo $oResultAsset[$i]->HeadName; ?></td>
                            <td>&nbsp;</td>
                            <td align="right" class="acc_cashflowamount <?php if($TotalAsset==0) echo "acc_cashflow_commonborder"; ?>">
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total);
                                        $TotalAsset+=$Total; 
                                ?>
                            </td>
                        </tr>
                              <?php
                          }
                        }
                      ?>
                        <tr>
                          <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="acc_cashflow_commonborder">&nbsp;</td>
                        </tr>
                        <tr>
                         <td align="left" class="cashflow-quipment"><strong>Total Closing Cash & Cash Equivalent</strong></td>
                          <td>&nbsp;</td>
                           <td align="right" class="casflow-total"><strong><?php echo number_format($TotalAsset); ?></strong></td>
                        </tr>
                        <tr>
                          <td align="right" colspan="3">&nbsp;</td>
                        </tr>
                        
                         <tr>
                              <td colspan="3" align="center">
                                <table width="100%" cellpadding="1" cellspacing="20"  class="cashflow-footer">
                                    <tr>
                                        <td width="20%" class="acc_cashflow_commonborder" align="center">Prepared By</td>
                                        <td width="20%" class="acc_cashflow_commonborder" align="center">Accounts</td>
                                        <td width='20%' class="authorized-sign">Authorized Signature</td>
                                        <td  width="20%" class="acc_cashflow_commonborder" align='center'>Chairman</td>
                                    </tr>
                                </table>
                              </td>
                         </tr>
                    </table>
              </div>
                </div>
            </div>
            <div class="text-center" id="print">
                <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/>
                <a href="<?php echo base_url($pdf)?>" download>
                    <input type="button" class="btn btn-success" name="btnPdf" id="btnPdf" value="PDF"/>
                </a>
            </div>
        </div>
    </div>
</div>


