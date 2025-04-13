<link href="<?php echo MOD_URL.'accounts/assets/css/custom.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
                <div class="panel-title">
                    <h4> 
                        <strong><?php echo display('balance_sheet');?></strong>
                    </h4>
                </div>
            </div>
        <div class="panel-body"> 
            <?php echo form_open('accounts/accounts/balance_sheet', array('class' => 'form-inline', 'method' => 'post')) ?>
            <?php
            $today = date('Y-m-d');
            ?>
            <div class="form-group">
                <label class="" for="dtpFromDate"><?php echo display('start_date') ?></label>
                <input type="text" name="dtpFromDate" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo $dtpFromDate ?>">
            </div> 

            <div class="form-group">
                <label class="" for="dtpToDate"><?php echo display('end_date') ?></label>
                <input type="text" name="dtpToDate" class="form-control datepicker" id="dtpToDate" placeholder="<?php echo display('end_date') ?>" value="<?php echo $dtpToDate ?>">
            </div>  

            <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
          
            <?php echo form_close() ?>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12" >
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>   <strong><?php echo display('balance_sheet').'  on '.date('d-m-Y', strtotime($dtpFromDate)). ' To '  . date('d-m-Y', strtotime($dtpToDate));?></strong>
                    </h4>
                </div>
            </div>
            <div id="printArea">
                <div class="panel-body">
                   <table width="99%" align="left" class="table table-striped table-bordered table-hover general_ledger_report_tble">
                    
                   
                    <thead>                    
                    <tr>
                          <td width="40%" bgcolor="#E7E0EE" align="center" ><strong><?php echo display('particulars')?></strong></td>
                          <td width="15%" bgcolor="#E7E0EE" align="right" class="profitamount"><strong><?php echo $this->session->userdata('fyearName')?></strong></th>
                          <?php foreach($financialyears as $financialyear) { ?>
                            <td width="15%" bgcolor="#E7E0EE" align="right" class="profitamount"><strong><?php echo $financialyear ;?></strong></td>
                          <?php } ?>
                           
                     </tr>               
                    </thead>
                    <tbody>  
                          
                    <?php foreach($assets as $asset) { ?>
                      <tr>
                          <td  align="left"   ><?php echo $asset['head'];?></td>
                          <td  align="right" colspan="4" ></td>
                     </tr>
                     <?php  if(count($asset['nextlevel']) > 0) { foreach ($asset['nextlevel'] as  $value) { ?>
                        <tr>
                            <td  align="left" style="padding-left: 80px;"><?php echo $value['headName'];?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($value['subtotal'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['ssubtotal'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['tsubtotal'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['fsubtotal'],2); ?></td>
                            
                        </tr>
                        <?php if(count($value['innerHead']) > 0) { foreach($value['innerHead'] as $inner) { ?>
                         <tr>
                            <td  align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['amount'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['secondyear'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['thirdyear'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['fourthyear'],2); ?></td>
                            
                        </tr>
                      <?php } }  } } } ?>
                     
                      <tr>
                            <td   align="right"><strong><?php echo display('total_assets');?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($assets[0]['gtotal'] ,2); ?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($assets[0]['sgtotal'] ,2); ?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($assets[0]['tgtotal'] ,2); ?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($assets[0]['fgtotal'] ,2); ?></strong></td>
                            
                        </tr>


                   
                       


                        <tr bgcolor="#E7E0EE">
                           <td  colspan="5"> &nbsp;</td>
                        </tr>

                        <?php foreach($liabilities as $liability) { ?>
                      <tr>
                          <td  align="left"   ><?php echo $liability['head'];?></td>
                          <td  align="right" colspan="4" ></td>
                     </tr>
                     <?php  if(count($liability['nextlevel']) > 0) { foreach ($liability['nextlevel'] as  $value) { ?>
                        <tr>
                            <td  align="left" style="padding-left: 80px;"><?php echo $value['headName'];?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['subtotal'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['ssubtotal'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['tsubtotal'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['fsubtotal'],2); ?></td>
                            
                        </tr>
                        <?php if(count($value['innerHead']) > 0) { foreach($value['innerHead'] as $inner) { ?>
                         <tr>
                            <td  align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['amount'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['secondyear'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['thirdyear'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['fourthyear'],2); ?></td>
                            
                        </tr>
                      <?php } }  } } } ?>
                     
                      <tr>
                            <td   align="right"><strong><?php echo display('total_liabilities');?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($liabilities[0]['gtotal'] ,2); ?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($liabilities[0]['sgtotal'] ,2); ?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($liabilities[0]['tgtotal'] ,2); ?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($liabilities[0]['fgtotal'] ,2); ?></strong></td>
                            
                        </tr>



                        <tr bgcolor="#E7E0EE">
                           <td  colspan="5"> &nbsp;</td>
                        </tr>

                        <?php foreach($equitys as $equity) { ?>
                      <tr>
                          <td  align="left"   ><?php echo $equity['head'];?></td>
                          <td  align="right" colspan="4" ></td>
                     </tr>
                     <?php  if(count($equity['nextlevel']) > 0) { foreach ($equity['nextlevel'] as  $value) { ?>
                        <tr>
                            <td  align="left" style="padding-left: 80px;"><?php echo $value['headName'];?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['subtotal'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['ssubtotal'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['tsubtotal'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($value['fsubtotal'],2); ?></td>
                            
                        </tr>
                        <?php if(count($value['innerHead']) > 0) { foreach($value['innerHead'] as $inner) { ?>
                         <tr>
                            <td  align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['amount'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['secondyear'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['thirdyear'],2); ?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '.  number_format($inner['fourthyear'],2); ?></td>
                            
                        </tr>
                      <?php } }  } } } ?>
                     
                        <tr>
                            <td   align="right"><strong><?php echo display('total_equity');?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($equitys[0]['gtotal'] ,2); ?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($equitys[0]['sgtotal'] ,2); ?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($equitys[0]['tgtotal'] ,2); ?></strong></td>
                            <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format($equitys[0]['fgtotal'] ,2); ?></strong></td>
                            
                        </tr>
                         


                </tbody>
                <tfoot>
                       <tr>
                            <td align="right"><strong><?php echo display('total_liabilities_equity');?></strong></td>
                            <td align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format(($liabilities[0]['gtotal'] + $equitys[0]['gtotal'] ),2); ?></strong></td>
                            <td align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format(($liabilities[0]['sgtotal'] + $equitys[0]['sgtotal']) ,2); ?></strong></td>
                            <td align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format(($liabilities[0]['tgtotal'] + $equitys[0]['tgtotal']) ,2); ?></strong></td>
                            <td align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '.  number_format(($liabilities[0]['fgtotal'] + $equitys[0]['fgtotal']) ,2); ?></strong></td>                            
                        </tr>
                   </tfoot>


                  </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="row">
     <div class="col-sm-12 text-center">
         <div class="text-center" id="print">
             <button class="btn btn-warning btn-md" name="btnPrint" id="btnPrint"  onclick="balanceSheetPrintPageArea('printArea');"><i class="fa fa-print"></i> Print </button>
             <a href="<?php echo base_url($pdf)?>" target="_blank" title="download pdf">
                    <button  class="btn btn-success btn-md" name="btnPdf" id="btnPdf" ><i class="fa-file-pdf-o"></i> PDF</button>
             </a>
              <a href="<?php echo base_url('accounts/balance_sheet_excel/'.$dtpFromDate.'/'.$dtpToDate)?>" target="_blank" title="download pdf">
                    <button  class="btn btn-primary btn-md" name="btnPdf" id="btnPdf" ><i class="fa fa-file-excel-o"></i> Excel</button>
             </a>
         </div>
     </div>
    
</div>

<script src="<?php echo MOD_URL.'accounts/assets/js/script.js'; ?>" type="text/javascript"></script>