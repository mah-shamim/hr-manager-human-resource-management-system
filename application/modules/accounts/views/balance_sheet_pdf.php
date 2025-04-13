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
    <div class="col-sm-12 col-md-12" >
        <div class="panel panel-bd lobidrag">           
            <div id="printArea">
                <div class="panel-body">
                    <table border="0" style="width: 1200px!important;">                                                
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
                                <h3><?php echo display('balance_sheet').'  on '.date('d-m-Y', strtotime($dtpFromDate)). ' To '  . date('d-m-Y', strtotime($dtpToDate));?></h3>
                            </td>  
                             <td width="30%" align="left">
                                <date>
                                <?php echo display('date')?>: <?php
                                echo date('d-M-Y');
                                ?> 
                            </date>
                            </td>
                        </tr>  
                     </table>    
                   <table width="99%" align="left" class="datatableReport table table-striped table-bordered table-hover general_ledger_report_tble">
                    
                   
                    <thead>                    
                    <tr>
                          <td width="40%" bgcolor="#E7E0EE" align="center" ><strong><?php echo display('particulars')?></strong></td>
                          <td width="15%" bgcolor="#E7E0EE" align="left" class="profitamount"><strong><?php echo $this->session->userdata('fyearName')?></strong></th>
                          <?php foreach($financialyears as $financialyear) { ?>
                            <td width="15%" bgcolor="#E7E0EE" align="left" class="profitamount"><strong><?php echo $financialyear ;?></strong></td>
                          <?php } ?>
                           
                     </tr>               
                    </thead>
                    <tbody>  
                          
                    <?php foreach($assets as $asset) { ?>
                      <tr>
                          <td  align="left"   ><?php echo $asset['head'];?></td>
                          <td  align="left" colspan="4" ></td>
                     </tr>
                     <?php  if(count($asset['nextlevel']) > 0) { foreach ($asset['nextlevel'] as  $value) { ?>
                        <tr>
                            <td  align="left" style="padding-left: 80px;"><?php echo $value['headName'];?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['subtotal'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['ssubtotal'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['tsubtotal'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['fsubtotal'],2); ?></td>
                            
                        </tr>
                        <?php if(count($value['innerHead']) > 0) { foreach($value['innerHead'] as $inner) { ?>
                         <tr>
                            <td  align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['amount'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['secondyear'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['thirdyear'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['fourthyear'],2); ?></td>
                            
                        </tr>
                      <?php } }  } } } ?>
                     
                      <tr>
                            <td   align="left"><strong><?php echo display('total_assets');?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($assets[0]['gtotal'] ,2); ?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($assets[0]['sgtotal'] ,2); ?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($assets[0]['tgtotal'] ,2); ?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($assets[0]['fgtotal'] ,2); ?></strong></td>
                            
                        </tr>


                   
                       


                        <tr bgcolor="#E7E0EE">
                           <td  colspan="5"> &nbsp;</td>
                        </tr>

                        <?php foreach($liabilities as $liability) { ?>
                      <tr>
                          <td  align="left"   ><?php echo $liability['head'];?></td>
                          <td  align="left" colspan="4" ></td>
                     </tr>
                     <?php  if(count($liability['nextlevel']) > 0) { foreach ($liability['nextlevel'] as  $value) { ?>
                        <tr>
                            <td  align="left" style="padding-left: 80px;"><?php echo $value['headName'];?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['subtotal'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['ssubtotal'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['tsubtotal'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['fsubtotal'],2); ?></td>
                            
                        </tr>
                        <?php if(count($value['innerHead']) > 0) { foreach($value['innerHead'] as $inner) { ?>
                         <tr>
                            <td  align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['amount'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['secondyear'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['thirdyear'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['fourthyear'],2); ?></td>
                            
                        </tr>
                      <?php } }  } } } ?>
                     
                      <tr>
                            <td   align="left"><strong><?php echo display('total_liabilities');?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($liabilities[0]['gtotal'] ,2); ?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($liabilities[0]['sgtotal'] ,2); ?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($liabilities[0]['tgtotal'] ,2); ?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($liabilities[0]['fgtotal'] ,2); ?></strong></td>
                            
                        </tr>



                        <tr bgcolor="#E7E0EE">
                           <td  colspan="5"> &nbsp;</td>
                        </tr>

                        <?php foreach($equitys as $equity) { ?>
                      <tr>
                          <td  align="left"   ><?php echo $equity['head'];?></td>
                          <td  align="left" colspan="4" ></td>
                     </tr>
                     <?php  if(count($equity['nextlevel']) > 0) { foreach ($equity['nextlevel'] as  $value) { ?>
                        <tr>
                            <td  align="left" style="padding-left: 80px;"><?php echo $value['headName'];?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['subtotal'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['ssubtotal'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['tsubtotal'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['fsubtotal'],2); ?></td>
                            
                        </tr>
                        <?php if(count($value['innerHead']) > 0) { foreach($value['innerHead'] as $inner) { ?>
                         <tr>
                            <td  align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['amount'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['secondyear'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['thirdyear'],2); ?></td>
                            <td   align="left" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['fourthyear'],2); ?></td>
                            
                        </tr>
                      <?php } }  } } } ?>
                     
                        <tr>
                            <td   align="left"><strong><?php echo display('total_equity');?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($equitys[0]['gtotal'] ,2); ?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($equitys[0]['sgtotal'] ,2); ?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($equitys[0]['tgtotal'] ,2); ?></strong></td>
                            <td  align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($equitys[0]['fgtotal'] ,2); ?></strong></td>
                            
                        </tr>
                         


                </tbody>
                <tfoot>
                       <tr>
                            <td align="left"><strong><?php echo display('total_liabilities_equity');?></strong></td>
                            <td align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format(($liabilities[0]['gtotal'] + $equitys[0]['gtotal'] ),2); ?></strong></td>
                            <td align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format(($liabilities[0]['sgtotal'] + $equitys[0]['sgtotal']) ,2); ?></strong></td>
                            <td align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format(($liabilities[0]['tgtotal'] + $equitys[0]['tgtotal']) ,2); ?></strong></td>
                            <td align="left" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format(($liabilities[0]['fgtotal'] + $equitys[0]['fgtotal']) ,2); ?></strong></td>                            
                        </tr>
                         <tr bgcolor="#FFF" >
                      <td colspan="5" align="center" height="120" valign="bottom">
                          <table width="100%" cellpadding="1" cellspacing="20" style="padding-top: 100px;">
                            <tr>
                              <td width="30%" class="noborder" align="center"><?php echo display('prepared_by')?></td>
                                <td width="40%" class="noborder" align="center"><?php echo display('checked_by')?></td>
                                <td width="30%" class="noborder" align="center"><?php echo display('authorised_by')?></td>                               
                            </tr>
                          </table>
                      </td>
                    </tr>
                   </tfoot>


                  </table>
                </div>
            </div>
            
        </div>
    </div>
</div>