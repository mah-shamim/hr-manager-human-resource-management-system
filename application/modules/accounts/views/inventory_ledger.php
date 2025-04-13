
<?php
include ('Class/CConManager.php');
include ('Class/CResult.php');
include ('Class/CAccount.php');
include ('Class/Ccommon.php');
?>

<?php
if(isset($_POST['btnSave']))
{

    $oAccount=new CAccount();
    $oResult=new CResult();
    $HeadCode=10107;
    $HeadName=$_POST['txtName'];
    $FromDate=$_POST['dtpFromDate'];
    $ToDate=$_POST['dtpToDate'];


    $sql="SELECT SUM(Debit) Debit, SUM(Credit) Credit, IsAppove, COAID FROM acc_transaction
              WHERE VDate < '$FromDate 00:00:00' AND COAID = '$HeadCode' AND IsAppove =1 ";

    $sql.="GROUP BY IsAppove, COAID";
    $oResult=$oAccount->SqlQuery($sql);
    $PreBalance=0;

    if($oResult->num_rows>0)
    {
        $PreBalance=$oResult->row['Debit'];
        $PreBalance=$PreBalance- $oResult->row['Credit'];
    }

     $sql="SELECT acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID, acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType, acc_transaction.Narration 
		 FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode
         WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '$FromDate 00:00:00' AND '$ToDate 00:00:00' AND acc_transaction.COAID='$HeadCode' ORDER BY  acc_transaction.VDate, acc_transaction.VNo";


    $oResult=$oAccount->SqlQuery($sql);  
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('accounts') ?></h1>
            <small><?php echo display('inventory_ledger') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li class="active"><?php echo display('inventory_ledger') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
            <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
            ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('error_message');
        }
        ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>

                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <form name="form1" id="form1" action="" method="post" enctype="multipart/form-data">
                <div class="row" id="">
                    <input type="hidden" id="txtName" name="txtName"/>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('from_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text" name="dtpFromDate" value="<?php echo (!empty($FromDate)?$FromDate:'')?>" placeholder="<?php echo display('date') ?>" class="datepicker form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('to_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text"  name="dtpToDate" value="<?php echo (!empty($ToDate)?$ToDate:'')?>" placeholder="<?php echo display('date') ?>" class="datepicker form-control">
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" name="btnSave" class="btn btn-success w-md m-b-5"><?php echo display('find') ?></button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
            <div class="panel-body"  id="printArea">
                <tr align="center">
                    <td id="ReportName" ><b><?php echo display('bank_book_voucher')?></b></td>
                </tr>
                <div class="">
                               <table border="0" width="100%" >
                                                
                                                <tr>
                                                    <td align="left">
                                                        <img src="<?php echo $software_info[0]->logo;?>" alt="logo">
                                                    </td>
                                                    <td align="left" >
                                                        <span >
                                                            <?php echo $company[0]['company_name'];?>
                                                           
                                                        </span><br>
                                                        <?php echo $company[0]['address'];?>
                                                        <br>
                                                         <?php echo $company[0]['mobile'];?>
                                                        
                                                    </td>
                                                   
                                                     <td align="right" >
                                                        <date>
                                                        <?php echo display('date')?>: <?php
                                                        echo date('d-M-Y');
                                                        ?> 
                                                    </date>
                                                    </td>
                                                </tr>            
                                   
                                </table>
                      <table width="100%" class="table table-stripped" cellpadding="6" cellspacing="1">
                       <caption class="text-center"><font size="+1" > <strong><?php echo display('inventory_ledger_report')?>(<?php echo display('from')?> <?php echo (!empty($HeadName)?$HeadName:'') ?> <?php echo display('on')?> <?php echo (!empty($FromDate)?$FromDate:''); ?> <?php echo display('to')?> <?php echo (!empty($ToDate)?$ToDate:'');?>)</strong></font></caption>

                        <tr class="table_data">
                            <td width="3%" >&nbsp;</td>
                            <td width="10%">&nbsp;</td>
                            <td width="14%">&nbsp;</td>
                            <td width="5%" >&nbsp;</td>
                            <td width="35%" >&nbsp;</td>
                            <td colspan="2" align="right"><strong><?php echo display('opening_balance')?></strong></td>
                            <td width="11%" align="right"><?php echo number_format((!empty($PreBalance)?$PreBalance:0),2,'.',','); ?></td>
                        </tr>
                        <tr class="table_head">
                            <th height="25"><strong><?php echo display('sl')?></strong></th>
                            <th align="center"><strong><?php echo display('date')?></strong></th>
                            <th align="center" ><strong><?php echo display('voucher_no')?></strong></th>
                            <th align="center"><strong><?php echo display('type')?></strong></th>
                            <th align="center"><strong><?php echo display('head_of_account')?></strong></th>
                            <th width="11%" align="right"><strong><?php echo display('debit')?></strong></th>
                            <th width="11%" align="right"><strong><?php echo display('credit')?></strong></th>
                            <th align="right" ><strong><?php echo display('balance')?></strong></th>
                        </tr>
                        <?php
                        $TotalCredit=0;
                        $TotalDebit=0;
                        $VNo="";
                        $CountingNo=1;
                        for($i=0;$i<(!empty($oResult->num_rows)?$oResult->num_rows:0);$i++)
                        {
                            if($i&1)
                                $bg="#E7E0EE";
                            else
                                $bg="#FFFFFF";
                            ?>
                            <tr class="table_data">
                                <?php
                                if($VNo!=$oResult->rows[$i]['VNo'])
                                {
                                    ?>
                                    <td  height="25"><?php echo $CountingNo++;?></td>
                                    <td><?php echo substr($oResult->rows[$i]['VDate'],0,10);?></td>
                                    <td align="left"><?php
                                        if($oResult->rows[$i]['Vtype']=="MR")
                                            echo "<a href=\"?Acc=MoneyRecept&VNo=".base64_encode($oResult->rows[$i]['VNo'])."\" target='_blank'><img src='ic/page.png' alt='Money Receipt Reprint' title='Money Receipt Reprint'></a> &nbsp;";
                                        else if($oResult->rows[$i]['Vtype']=="AVR")
                                        {
                                            $sql="SELECT * FROM advising_register WHERE VNo='".$oResult->rows[$i]['VNo']."'";
                                            $oResultRegi=$oAccount->SqlQuery($sql);

                                        }
                                        else if($oResult->rows[$i]['Vtype']=="AD")
                                        {

                                        }
                                       
                                        echo $oResult->rows[$i]['VNo'];
                                        ?></td>
                                    <td align="center">
                                            <?php echo trim($oResult->rows[$i]['Vtype']);
                                            ?>
<
                                    </td>
                                    <?php
                                    $VNo=$oResult->rows[$i]['VNo'];
                                }
                                else
                                {
                                    ?>
                                    <td colspan="4">&nbsp;</td>
                                    <?php
                                }
                                ?>
                                <td align="left"><?php echo $oResult->rows[$i]['HeadName'];?></td>
                                <td align="right"><?php
                                    $TotalDebit += $oResult->rows[$i]['Debit'];
                                    $PreBalance += $oResult->rows[$i]['Debit'];
                                    echo number_format($oResult->rows[$i]['Debit'],2,'.',',');?></td>
                                <td  align="right"><?php
                                    $TotalCredit += $oResult->rows[$i]['Credit'];
                                    $PreBalance -= $oResult->rows[$i]['Credit'];
                                    echo number_format($oResult->rows[$i]['Credit'],2,'.',',');?></td>
                                <td align="right"><?php printf("%.2f",$PreBalance); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr class="table_data" >
                            <td bgcolor="green">&nbsp;</td>
                            <td align="center" bgcolor="green">&nbsp;</td>
                            <td align="center" bgcolor="green">&nbsp;</td>
                            <td align="center" bgcolor="green">&nbsp;</td>
                            <td  align="right" bgcolor="green"><strong>Total</strong></td>
                            <td  align="right" bgcolor="green"><?php echo number_format($TotalDebit,2,'.',','); ?></td>
                            <td  align="right" bgcolor="green"><?php echo number_format($TotalCredit,2,'.',','); ?></td>
                            <td  align="right" bgcolor="green"><?php echo number_format((!empty($PreBalance)?$PreBalance:0),2,'.',','); ?></td>
                        </tr>

                    </table>

                </div>
               
            </div>
        </div>
         <div class="text-center" id="print">
                    <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/>
                </div>
        </div>
    </div>
</div>
</section>
</div>

