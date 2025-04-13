<style type="text/css">
     table.datatableReport {       
        border-collapse: collapse;
        border: 0;
    }
    table.datatableReport td, table.datatableReport th {
        padding: 6px 15px;
    }
    table.datatableReport td, table.datatableReport th {
        border: 1px solid #ededed;
        border-collapse: collapse;
    }
table.datatableReport td.noborder {
    border: none;
    padding-top: 40px;
}
</style>
<div class="row">    
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            
            <div class="panel-body" id="printArea"> 
                <div class="table-responsive">
                     <table border="0"  width="100%">                                                
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
                                <h3><?php echo display('bank_reconciliation_report').'  on '.date('d-m-Y', strtotime($dtpFromDate)). ' To '  . date('d-m-Y', strtotime($dtpToDate));?></h3>
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

                             <?php if($vauchers) { ?>
                                <table width="100%" class="datatableReport table table-bordered table-hover">     
                                    <thead>
                                        <tr>                                            
                                            <th colspan="6" style="background-color:#151B8D; color: #fff;"> <?php echo display('approved') ?></th>
                                            <th colspan="5"  style="background-color:#5d61af; color: #fff;"> <?php echo display('unapproved') ?></th>
                                        </tr>
                                        <tr>
                                            <th><?php echo display('sl_no') ?></th>
                                            <th><?php echo display('voucher_no') ?></th>
                                            <th><?php echo display('particulars') ?></th>
                                            <th><?php echo display('check_no') ?></th>                                
                                            <th><?php echo display('check_date') ?></th>  
                                            <th><?php echo display('amount') ?></th>
                                            <th><?php echo display('voucher_no') ?></th>
                                            <th><?php echo display('particulars') ?></th>
                                            <th><?php echo display('check_no') ?></th>                                
                                            <th><?php echo display('check_date') ?></th>  
                                            <th><?php echo display('amount') ?></th>                                  
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php $sl = 1; $hsum = 0;$nsum = 0;
                                        foreach($vauchers as $appr) {   ?>
                                        <tr> 
                                            <td><?php echo $sl; ?></td>
                                            <?php if($appr->isHonour == 1) { $hsum += $appr->Debit; ?>
                                            <td><?php echo $appr->VNo; ?></td>                                            
                                            <td><?php echo $appr->accountName; ?></td>
                                            <td><?php echo $appr->chequeno; ?></td>                                
                                            <td><?php echo $appr->chequeDate; ?></td>
                                            <td><?php echo $appr->Debit; ?></td>
                                            <td> &nbsp; </td> 
                                            <td> &nbsp; </td> 
                                            <td> &nbsp; </td> 
                                            <td> &nbsp; </td> 
                                            <td> &nbsp; </td>  
                                           <?php  } else { $nsum += $appr->Debit;?>  
                                            <td> &nbsp; </td> 
                                            <td> &nbsp; </td> 
                                            <td> &nbsp; </td> 
                                            <td> &nbsp; </td> 
                                            <td> &nbsp; </td> 
                                            <td><?php echo $appr->VNo; ?></td>                                            
                                            <td><?php echo $appr->accountName; ?></td>
                                            <td><?php echo $appr->chequeno; ?></td>                                
                                            <td><?php echo $appr->chequeDate; ?></td>
                                            <td><?php echo $appr->Debit; ?></td> 
                                           <?php } ?>
                                         </tr>
                                       <?php $sl++;}?>
                                       <tr>
                                            <td style="border-bottom: 1px solid #ddd;"></td>
                                            <td  style="border-bottom: 1px solid #ddd;"colspan="4" align="right"> <strong><?php echo display('total');?> </strong></td>
                                            <td style="border-bottom: 1px solid #ddd;"><strong><?php echo $hsum; ?></strong></td>
                                            <td  style="border-bottom: 1px solid #ddd;"colspan="4" align="right"> <strong><?php echo display('total');?> </strong></td>
                                            <td style="border-bottom: 1px solid #ddd;"><strong><?php echo $nsum; ?></strong></td>
                                       </tr>
                                    </tbody>
                                    <tfoot><tr bgcolor="#FFF" style="margin-top: 200px;">
                                          <td colspan="11" align="center" height="120" valign="bottom">
                                              <table width="100%" cellpadding="1" cellspacing="20">
                                                <tr>
                                                  <td width="30%" class="noborder" align="center"><?php echo display('prepared_by')?></td>
                                                    <td width="30%" class="noborder" align="center"><?php echo display('checked_by')?></td>
                                                    <td width="30%" class="noborder" align="center"><?php echo display('authorised_by')?></td>
                                                    
                                                </tr>
                                              </table>
                                          </td>
                                        </tr>

                                    </tfoot>

                                </table>
                             <?php } ?>

                    
                </div>
            </div> 
        </div>
       
    </div>
     <?php echo form_close()?>
</div>