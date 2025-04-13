<!-- New income -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">

                    <div class="panel-heading">
                      <div class="panel-title">
                          <h4>
                            <?php echo display('fixed_assets_report')?>
                          </h4>
                      </div>
                    </div>
                   <div class="panel-body">
                  <?php echo form_open('accounts/fixed_assets_report',array('class' => 'form-inline','method'=>'post'))?>
                   <div class="form-group form-group-margin">
                      <label for="employeelist"><?php echo display('year')?>:</label>
                              
                    </div> 
                    <div class="form-group form-group-new empdropdown">
                         <select class="form-control" name="fyear">                                
                                <?php foreach($fyears as $fy){?>
                                  <option value="<?php echo $fy->id;?>" <?php echo $fy->id== $fyear? 'selected':'' ; ?> ><?php echo $fy->yearName;?></option>
                              <?php }?>
                              </select>  
                     </div> 

                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>                        
                        <?php echo form_close() ?>  
                    </div>
                    
                </div>
            </div>
        </div>
<div class="row" id="printArea">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
               <div class="panel-title">
                    <h4><?php echo display('fixed_assets_report')?> for <?php echo $curentYear->yearName ;?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                     <table border="0"  width="99%">                                                
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
                            <td width="40%" align="center"> <h2> <?php echo $setting->title;?>  </h2>

                                <h3><?php echo display('fixed_assets_report')?> <?php echo $curentYear->yearName ;?></h3>
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

                
                <table width="99%" align="left" class="table table-striped table-bordered table-hover general_ledger_report_tble">
                    <thead>
                       <th width="20%" bgcolor="#E7E0EE" align="left" class="profitamount"><?php echo display('particulars')?></th>                        
                           
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('opening_balance_fixed_assets')?></th>
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('additions');?></th>
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('adjustment');?></th>
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('closing_balance_fixed_assets');?></th>
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('depreciation_rate');?></th>
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('depreciation_value');?></th>
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('opening_balance_accumulated_depreciation');?></th>
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('additions');?></th>
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('adjustment');?></th>
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('closing_balance_accumulated_depreciation');?></th>
                        <th width="8%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('written_down_value');?></th> 
                                
                    </thead>
                    <tbody>
                     <?php if(count($fixedAssets) > 0) {  foreach($fixedAssets as $fixedAsset) { ?>
                    <tr>
                        <td  align="left"><?php echo $fixedAsset['headName'];?></td>
                        <td  align="right" colspan="11" ></td>
                    </tr>
                    <?php  if(count($fixedAsset['nextlevel']) > 0) { foreach ($fixedAsset['nextlevel'] as  $value) { ?>
                    <tr>
                        <td align="left" style="padding-left: 80px;"><?php echo $value['headName'];?></td>
                        <td  align="right" colspan="11" class="profitamount"></td>                            
                    </tr>
                   
                    <?php if(count($value['innerHead']) > 0) { foreach($value['innerHead'] as $inner) { ?>
                <tr>
                    <td align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>                    
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['openig'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['curentDebit'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['curentCredit'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['curentValue'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $inner['depRate'].' %' ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['depAmount'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['revOpening'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['revCredit'],2); ?></td> 
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['revDebit'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['revBalance'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['famount'],2); ?></td> 
                 </tr>
                  
                 <?php } } }}} ?>
               
                    <tr bgcolor="#E7E0EE">
                    <td   align="right"><strong><?php echo display('total');?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($fixedAssets[0]['subtotal1'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($fixedAssets[0]['subtotal2'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($fixedAssets[0]['subtotal3'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($fixedAssets[0]['subtotal4'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($fixedAssets[0]['subtotal5'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($fixedAssets[0]['subtotal6'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($fixedAssets[0]['subtotal7'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($fixedAssets[0]['subtotal8'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($fixedAssets[0]['subtotal9'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($fixedAssets[0]['subtotal10'] ,2); ?></strong></td>
                    
                 </tr> 
             
           
         <?php } ?>

                            
              </tbody>
               <tfoot>
                   <tr >
                    <td colspan="12" class="noborder" style="padding-top:100px;">
                        <table border="0" width="100%">                                                
                        <tr>
                            <td align="left" class="noborder">
                                <div class="border-top"><?php echo display('prepared_by')?></div>
                            </td>
                            <td align="center"  class="noborder"> <div class="border-top"><?php echo display('checked_by')?></div>
                            </td>  
                             <td align="right"  class="noborder">
                                <div class="border-top"><?php echo display('authorised_by')?></div>
                            </td>
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
<div class="row">
     <div class="col-sm-12 text-center">
         <div class="text-center" id="print">
             <button class="btn btn-warning btn-md" name="btnPrint" id="btnPrint"  onclick="fixedAssetPrintPageArea('printArea');"><i class="fa fa-print"></i> Print </button>
             <a href="<?php echo base_url($pdf)?>" target="_blank" title="download pdf">
                    <button  class="btn btn-success btn-md" name="btnPdf" id="btnPdf" ><i class="fa-file-pdf-o"></i> PDF</button>
             </a>
              <a href="<?php echo base_url('accounts/fixed_assets_report_excel/'.$fyear)?>" target="_blank" title="download pdf">
                    <button  class="btn btn-primary btn-md" name="btnPdf" id="btnPdf" ><i class="fa fa-file-excel-o"></i> Excel</button>
             </a>
         </div>
     </div>
    
</div>

<script src="<?php echo MOD_URL.'accounts/assets/js/script.js'; ?>" type="text/javascript"></script>