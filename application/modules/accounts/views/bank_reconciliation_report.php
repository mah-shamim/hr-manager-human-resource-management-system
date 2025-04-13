<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">             
            <div class="panel-heading" >
                <div class="panel-title">
                    <h4><?php echo display('bank_reconciliation_report') ?></h4>
                </div>                
            </div>
            <div class="panel-body">
                      
              <?php echo  form_open_multipart('accounts/bank_reconciliation_report',array('class' => 'form-inline','method'=>'post')) ?>
                <div class="row" >
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label for="dtpFromDate" class="col-sm-4 col-form-label"><?php echo display('from_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text" name="dtpFromDate" value="<?php echo   isset($dtpFromDate)? $dtpFromDate : date('Y-m-d',strtotime('first day of this month')); ?>" placeholder="<?php echo display('date') ?>" class="datepicker form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label for="dtpToDate" class="col-sm-4 col-form-label"><?php echo display('to_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text"  name="dtpToDate" value="<?php echo  isset($dtpToDate)? $dtpToDate : date('Y-m-d'); ?>" placeholder="<?php echo display('date') ?>" class="datepicker form-control">
                            </div>
                        </div>
                    </div><div class="col-sm-3">
                        <div class="form-group row">
                            <label for="dtpToDate" class="col-sm-5 col-form-label"><?php echo display('bank_name') ?></label>
                            <div class="col-sm-7">
                                <select class="form-control" name="bankCode" id="bankCode">
                                    <option value=""> Select Bank</option>
                                    <?php foreach($banks as $bank){  ?>
                                        <option value="<?php echo $bank->HeadCode;?>" <?php  if(isset($bankCode)) { echo  $bank->HeadCode == $bankCode  ? 'selected' : '' ; } ?> ><?php echo $bank->HeadName;?></option>
                                        <?php  }  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                                         
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <div class="col-sm-8">
                            <button type="submit" name="btnSave" class="btn btn-success w-md m-b-5"><?php echo display('find') ?></button>
                           </div>
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
            
            <div class="panel-body" id="printArea"> 
                <div class="table-responsive">
                     <table border="0" width="100%" >                                                
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
                                <table width="100%" class="table table-bordered table-hover">     
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
                                            <td><?php echo $setting->currency_symbol. ' '. $appr->Debit; ?></td>
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
                                            <td><?php echo $setting->currency_symbol. ' '. $appr->Debit; ?></td> 
                                           <?php } ?>
                                         </tr>
                                       <?php $sl++;}?>
                                       <tr>
                                            <td style="border-bottom: 1px solid #ddd;"></td>
                                            <td  style="border-bottom: 1px solid #ddd;"colspan="4" align="right"> <strong><?php echo display('total');?> </strong></td>
                                            <td style="border-bottom: 1px solid #ddd;"><strong><?php echo $setting->currency_symbol. ' '. $hsum; ?></strong></td>
                                            <td  style="border-bottom: 1px solid #ddd;"colspan="4" align="right"> <strong><?php echo display('total');?> </strong></td>
                                            <td style="border-bottom: 1px solid #ddd;"><strong><?php echo $setting->currency_symbol. ' '. $nsum; ?></strong></td>
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
                             <?php } else { ?>
                               <h3> <?php echo display('no_data_found');?> </h3>
                             <?php } ?>

                    
                </div>
            </div> 
        </div>
       
    </div>
     <?php echo form_close()?>
</div>
<div class="row">
    <div class="col-sm-12">
         <div class="text-center" id="print">                

                <button class="btn btn-warning btn-md" name="btnPrint" id="btnPrint"  onclick="bnkRconReportPrintPageArea('printArea');"><i class="fa fa-print"></i> Print </button>
             <a href="<?php echo base_url($pdf)?>" target="_blank" title="download pdf">
                    <button  class="btn btn-success btn-md" name="btnPdf" id="btnPdf" ><i class="fa-file-pdf-o"></i> PDF</button>
             </a>
              <a href="<?php echo base_url('accounts/bank_reconciliation_report_excel/'.$dtpFromDate.'/'.$dtpToDate.'/'.$bankCode)?>" target="_blank" title="download Excel">
                    <button  class="btn btn-primary btn-md" name="btnexcel" id="btnexcel" ><i class="fa fa-file-excel-o"></i> Excel</button>
             </a>




            </div>

     </div>
</div>

<script src="<?php echo MOD_URL.'accounts/assets/js/script.js'; ?>" type="text/javascript"></script>