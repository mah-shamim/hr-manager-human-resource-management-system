<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php echo display('day_book')?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                      
              <?php echo  form_open_multipart('accounts/day_book_report') ?>
                <div class="row" id="">
                    <div class="col-sm-6">
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
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
            <div class="panel-body"  id="printArea">
                <tr align="center">
                    <td id="ReportName"><b><?php echo display('voucher')?></b></td>
                </tr>
                <div>
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
                    <table width="100%" class="table table-stripped" cellpadding="6" cellspacing="1">
                       <caption class="text-center"><font size="+1"> <strong> <?php echo display('voucher')?>  (<?php echo display('from')?> <?php echo (!empty($FromDate)?$FromDate:''); ?> <?php echo display('to')?> <?php echo (!empty($ToDate)?$ToDate:'');?>)</font><strong></caption>
                        <tr class="table_data">
                            <td width="3%" >&nbsp;</td>
                            <td width="10%">&nbsp;</td>
                            <td width="14%">&nbsp;</td>
                            <td width="5%" >&nbsp;</td>
                            <td width="35%" >&nbsp;</td>
                            <td colspan="3" align="right"><strong><?php echo display('opening_balance')?></strong></td>
                            <td width="11%" align="right"><?php echo number_format((!empty($PreBalance)?$PreBalance:0),2,'.',','); ?></td>
                        </tr>
                        <tr class="table_head">
                            <th height="25"><strong><?php echo display('sl')?></strong></th>
                            <th class="text-center"><strong><?php echo display('date')?></strong></th>
                            <th class="text-center" ><strong><?php echo display('voucher_no')?></strong></th>
                            <th class="text-center"><strong><?php echo display('voucher_type')?></strong></th>
                            <th class="text-center"><strong><?php echo display('particulars')?></strong></th>
                             <th class="text-center"><strong><?php echo display('remark')?></strong></th>
                            <th width="11%" class="text-center"><strong><?php echo display('debit')?></strong></th>
                            <th width="11%" class="text-center"><strong><?php echo display('credit')?></strong></th>
                                                        
                        </tr>
                        <?php
                        $TotalCredit=0;
                        $TotalDebit=0;
                        $VNo="";
                        $CountingNo=1;
                        if(!empty($oResult)){
                            $oResult = $oResult;
                        }else{
                            $oResult='';

                        }
                        for($i=0;$i<(!empty($oResult->num_rows)?$oResult->num_rows:0);$i++)
                        {
                            if($i&1)
                                $bg="#F8F8F8";
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
                                       <td align="justify" bgcolor="<?php echo $bg; ?>"><?php echo $oResult->rows[$i]['Vtype'];
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
                                <td align="center" bgcolor="<?php echo $bg; ?>"><?php echo $oResult->rows[$i]['HeadName'];?></td>
                                <td align="justify" bgcolor="<?php echo $bg; ?>"><?php echo $oResult->rows[$i]['Narration'];?></td>
                                 <td  align="right" bgcolor="<?php echo $bg; ?>"><?php
                                    $TotalDebit += $oResult->rows[$i]['Debit'];
                                    $PreBalance += $oResult->rows[$i]['Debit'];
                                    echo number_format($oResult->rows[$i]['Debit'],2,'.',',');?></td>
                                <td align="right" bgcolor="<?php echo $bg; ?>"><?php
                                    $TotalCredit += $oResult->rows[$i]['Credit'];
                                    $PreBalance -= $oResult->rows[$i]['Credit'];
                                    echo number_format($oResult->rows[$i]['Credit'],2,'.',',');?></td>
                               
                                <td align="right" bgcolor="<?php echo $bg; ?>"><?php echo number_format($PreBalance,2,'.',','); ?></td>
                               
                            </tr>
                            <?php
                        }
                        ?>
                        <tr class="table_data acfootercontent">
                            <td >&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td  align="right"><strong>Total</strong></td>
                            <td  align="right"><?php echo number_format((!empty($TotalDebit)?$TotalDebit:0),2,'.',','); ?></td>
                            <td  align="right"><?php echo number_format((!empty($TotalCredit)?$TotalCredit:0),2,'.',','); ?></td>
                            <td  align="right"><?php echo number_format((!empty($PreBalance)?$PreBalance:0),2,'.',','); ?></td>
                            
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
</div>











