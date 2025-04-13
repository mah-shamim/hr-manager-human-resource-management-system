
<?php
include ('Class/CConManager.php');
include ('Class/Ccommon.php');
include ('Class/CResult.php');
include ('Class/CAccount.php'); 
?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-body"  id="printArea">
                    <tr align="center">
                        <td id="ReportName"><b></b></td>
                    </tr>
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
                        <table cellpadding="3" cellspacing="0" border="1" width="99%"  >
                            <?php
                            $oResult=new CResult();
                            $oAccount=new CAccount();

                            $sql="SELECT * FROM acc_coa WHERE IsActive=1 ORDER BY HeadCode";
                            $oResult=$oAccount->SqlQuery($sql);
                            for ($i = 0; $i < $oResult->num_rows; $i++)
                            {
                                $sql="SELECT MAX(HeadLevel) as MHL FROM acc_coa WHERE IsActive=1";
                                $oResultLevel=$oAccount->SqlQuery($sql);
                                $maxLevel=$oResultLevel->row['MHL'];

                                $HL=$oResult->rows[$i]['HeadLevel'];
                                $Level=$maxLevel+1;
                                $HL1=$Level-$HL;

                                echo '<tr>';
                                for($j=0; $j<$HL; $j++)
                                {
                                    echo '<td>&nbsp;</td>';
                                }
                                echo '<td>'.$oResult->rows[$i]['HeadCode'].'</td>';
                                echo '<td colspan='.$HL1.'>'.$oResult->rows[$i]['HeadName'].'</td>';
                                echo '</tr>';

                            }
                            ?>
                        </table>

                    </div>
                    <div class="text-center" id="print">
                        <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printCoa();"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
