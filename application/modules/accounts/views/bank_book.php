<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
<?php  foreach($banks as $bank) { echo $bank->HeadName; ?>
                                        

                                   <?php  }   ?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo  form_open_multipart('accounts/bank_book_report') ?>               
                <div class="row" id="">
                   
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('bank')?></label>
                            <div class="col-sm-8">

                                <select name="cmbCode" class="form-control" id="cmbCode" required >
                                    <option value="">Select Bank</option>
                                    <?php  foreach($banks as $bank) { echo $bank->HeadName; ?>
                                        <option value="<?php echo $bank->HeadCode;?>"><?php echo $bank->HeadName;?></option>

                                   <?php  }   ?>
                                </select>
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('from_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text" name="dtpFromDate" value="<?php echo date('Y-m-d');?>" placeholder="<?php echo display('date') ?>" class="datepicker form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('to_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text"  name="dtpToDate" value="<?php echo date('Y-m-d');?>" placeholder="<?php echo display('date') ?>" class="datepicker form-control">
                            </div>
                        </div>

                        <div class="form-group form-group-margin text-right">
                            <button type="submit" name="btnSave" class="btn btn-success w-md m-b-5"><?php echo display('find') ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
            <div class="panel-body"  id="printArea">
               
                <div class="">
                              <div class="row">
                    <div class="col-sm-4 col-xs-12">
                        <img src="<?php echo base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png')) ?>" alt="logo">
                    </div>
                    <div class="col-sm-4 col-xs-12">
                         <span class="" >
                                                            <?php echo $setting->title;?>
                                                           
                                                        </span><br>
                                                        <?php echo $setting->address;?>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <date>
                                                        <?php echo display('date')?>: <?php
                                                        echo date('d-M-Y');
                                                        ?> 
                                                    </date>
                    </div>
                </div>
                    <div class="table-responsive">            
                    <table width="100%" class="table table-stripped" cellpadding="1" cellspacing="1">
                        <caption class="text-center">
                            <font size="+1"> <strong><?php echo display('bank_book_report_of')?> <?php echo (!empty($HeadName)?$HeadName:'') ?> <?php echo display('on')?> <?php echo (!empty($FromDate)?$FromDate:''); ?> <?php echo display('to')?> <?php echo (!empty($ToDate)?$ToDate:'');?></strong></font>
                        </caption> 
                        <tr class="table_data">
                            <td width="3%" >&nbsp;</td>
                            <td width="10%">&nbsp;</td>
                            <td width="14%">&nbsp;</td>
                            <td width="5%" >&nbsp;</td>
                            <td width="35%" >&nbsp;</td>
                            <td colspan="2" align="right"><strong><?php echo display('opening_balance')?></strong></td>
                            <td width="11%" align="left"><?php echo number_format((!empty($PreBalance)?$PreBalance:0),2,'.',','); ?></td>
                        </tr>
                        <tr class="table_head">
                            <th height="25"><strong><?php echo display('sl')?></strong></th>
                            <th align="center"><strong><?php echo display('date')?></strong></th>
                            <th align="center" ><strong><?php echo display('voucher_no')?></strong></th>
                            <th align="center"><strong><?php echo display('type')?></strong></th>
                            <th align="center"><strong><?php echo display('head_of_account')?></strong></th>
                            <th align="right"><strong><?php echo display('debit')?></strong></th>
                            <th align="right"><strong><?php echo display('credit')?></strong></th>
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
                                    <td  height="25" bgcolor="<?php echo $bg; ?>"><?php echo $CountingNo++;?></td>
                                    <td bgcolor="<?php echo $bg; ?>"><?php echo substr($oResult->rows[$i]['VDate'],0,10);?></td>
                                    <td align="left" bgcolor="<?php echo $bg; ?>"><?php
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
                                    <td align="center" bgcolor="<?php echo $bg; ?>">
                                            <?php echo trim($oResult->rows[$i]['Vtype']);
                                            ?>

                                    </td>
                                    <?php
                                    $VNo=$oResult->rows[$i]['VNo'];
                                }
                                else
                                {
                                    ?>
                                    <td bgcolor="<?php echo $bg; ?>" colspan="4">&nbsp;</td>
                                    <?php
                                }
                                ?>
                                <td align="left" bgcolor="<?php echo $bg; ?>"><?php echo $oResult->rows[$i]['HeadName'];?></td>
                                <td align="left" bgcolor="<?php echo $bg; ?>"><?php
                                    $TotalDebit += $oResult->rows[$i]['Debit'];
                                    $PreBalance += $oResult->rows[$i]['Debit'];
                                    echo number_format($oResult->rows[$i]['Debit'],2,'.',',');?></td>
                                <td  align="left" bgcolor="<?php echo $bg; ?>"><?php
                                    $TotalCredit += $oResult->rows[$i]['Credit'];
                                    $PreBalance -= $oResult->rows[$i]['Credit'];
                                    echo number_format($oResult->rows[$i]['Credit'],2,'.',',');?></td>
                                <td align="left" bgcolor="<?php echo $bg; ?>"><?php printf("%.2f",$PreBalance); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr class="table_data datacontent">
                            <td >&nbsp;</td>
                            <td align="center" bgcolor="green">&nbsp;</td>
                            <td align="center" bgcolor="green">&nbsp;</td>
                            <td align="center" bgcolor="green">&nbsp;</td>
                            <td  align="right" bgcolor="green"><strong>Total</strong></td>
                            <td  align="left" bgcolor="green"><?php echo number_format($TotalDebit,2,'.',','); ?></td>
                            <td  align="left" bgcolor="green"><?php echo number_format($TotalCredit,2,'.',','); ?></td>
                            <td  align="left" bgcolor="green"><?php echo number_format((!empty($PreBalance)?$PreBalance:0),2,'.',','); ?></td>
                        </tr>

                    </table>
                </div>

                </div>
               
            </div>
        </div>
         <div class="text-center" id="print">
                    <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/>
                </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/js/dist/jstree.min.js" ></script>
<script src="<?php echo base_url('assets/js/account.js') ?>" type="text/javascript"></script>
