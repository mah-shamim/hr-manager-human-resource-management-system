<?php 
$this->load->library('Numberconverter');
$numberToword = new Numberconverter();
?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">             
            <div class="panel-heading panel-aligner" >
                <div class="panel-title">
                    <h4><?php echo display('day_book') ?></h4>
                </div>
                <div class="mr-25">
                     <button class="btn btn-warning" name="btnPrint" id="btnPrint" onclick="printAllVaucher();"><i class='fa fa-print'></i>  Print All</button>                   
                </div>

            </div>
            <div class="panel-body">
                      
              <?php echo  form_open_multipart('accounts/day_book_report',array('class' => 'form-inline','method'=>'post')) ?>
                <div class="row" >
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label for="dtpFromDate" class="col-sm-4 col-form-label"><?php echo display('from_date') ?></label>
                            <div class="col-sm-8">
                                <input type="text" name="dtpFromDate" value="<?php echo   isset($dtpFromDate)? $dtpFromDate : date('Y-m-d'); ?>" placeholder="<?php echo display('date') ?>" class="datepicker form-control">
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
<?php if($allvouchers) {?>
<div class="row mt-100-50" id="vaucherPrintArea">
 <?php $ix=1; foreach($allvouchers as $singlevoucher) { ?>      
        <div class="col-md-12" id="PrintArea_<?php echo $ix;?>">  
            <table class="table table-sm mt-2">
                <thead>
                    <tr>
                        <th class="head text-left pb-50" valign="top">
                             <img src="<?php echo base_url() . $setting->logo; ?>" alt="Logo" height="40px">
                        </th>
                        <th class="head text-center pb-50" valign="top">
                            <h2><?php echo $setting->title; ?></h2>
                            <?php if($singlevoucher->Vtype =='DV') { ?>
                               <strong><u class="pt-4"><?php echo display('debit_voucher')?></u></strong>
                            <?php } else if($singlevoucher->Vtype =='CV') { ?>
                               <strong><u class="pt-4"><?php echo display('credit_voucher')?></u></strong>
                            <?php } else if($singlevoucher->Vtype =='JV') { ?>
                               <strong><u class="pt-4"><?php echo display('journal_voucher')?></u></strong>
                            <?php } else if($singlevoucher->Vtype =='CT') { ?>
                               <strong><u class="pt-4"><?php echo display('contra_voucher')?></u></strong>
                            <?php } ?>
                            

                        </th>
                        <th class="head text-right pb-20" valign="bottom">
                            <div class="pull-right">
                                <label class="font-weight-600 mb-0"><?php echo display('voucher_no')?></label> : <?php echo $singlevoucher->VNo;?><br>
                                <label class="font-weight-600 mb-0"><?php echo display('voucher_date')?></label> : <?php echo date('d/m/Y', strtotime($singlevoucher->VDate));?>
                            </div>
                        </th>                       
                    </tr>
                </thead>
            </table>
            <table class="table table-bordered table-sm mt-2">
                <thead>
                    <tr>
                        <th class="text-center"><?php echo display('particulars');?></th>
                        <th class="text-right"><?php echo display('debit')?></th>
                        <th class="text-right"><?php echo display('credit')?></th>                       
                    </tr>
                </thead>
               <tbody>
                   <?php
                    $Debit = 0;
                    $Credit = 0;
                    if(!empty($singlevoucher)){
                        foreach($singlevoucher->details as $row){ 
                            $Debit += $row->Debit;
                            $Credit += $row->Credit; ?>
                            <tr>
                                <td>
                                    <strong style="font-size: 15px;;">
                                        <?php echo $row->HeadName.($row->subType != 1?'('.$row->subname.')':'');?>
                                            
                                    </strong><br>
                                    <span> <?php echo $row->ledgerComment?></span>
                                </td>
                                <td class="text-right"><?php echo $row->Debit;?></td>
                                <td class="text-right"><?php echo $row->Credit;?></td>
                            </tr>
                        <?php } }else{ ?>
                            <tr>
                                <td colspan="3" class="text-center text-danger"><?php echo display('data_is_not_available');?></td>
                            </tr>
                        <?php }?>
                            <tr>
                                <td class="text-left"><strong style="font-size: 15px;"><?php echo $singlevoucher->dbtcrdHead;?></strong></td>
                                <td class="text-right">0.00</td>
                                <td class="text-right"><?php echo number_format($Debit, 2); ?></td>

                            </tr>
                    </tbody>
                    <tfoot>
                    <?php if($singlevoucher->Vtype =='DV') { ?>
                            <tr>
                                <th class="text-right"><?php echo display('total');?></th>
                                <th class="text-right"><?php echo number_format($Debit, 2); ?></th>
                                <th class="text-right"><?php echo number_format($Debit, 2); ?></th>
                            </tr>
                            <tr>                                
                                <th class="" colspan="3"><?php echo display('in_words');?> : <?php echo $numberToword->AmountInWords($Debit); ?></th>                                
                            </tr>
                    <?php } else if($singlevoucher->Vtype =='CV') { ?>
                            <tr>
                                <th class="text-right"><?php echo display('total');?></th>
                                <th class="text-right"><?php echo number_format($Credit, 2); ?></th>
                                <th class="text-right"><?php echo number_format($Credit, 2); ?></th>
                            </tr>
                            <tr>                
                                <th class="" colspan="3"><?php echo display('in_words');?> : <?php echo $numberToword->AmountInWords($Credit); ?></th>               
                            </tr>
                    <?php } else if($singlevoucher->Vtype =='JV') { ?>
                           <tr>   
                                 <th class="text-right"><?php echo display('total');?></th>
                                <th class="text-right"><?php echo number_format($Credit, 2); ?></th>
                                <th class="text-right"><?php echo number_format($Credit, 2); ?></th>
                            </tr>
                            <tr>                
                                <th class="" colspan="3"><?php echo display('in_words');?> : <?php echo $numberToword->AmountInWords($Credit); ?></th>              
                            </tr>
                    <?php } else if($singlevoucher->Vtype =='CT') { ?>
                           <tr>
                                <th class="text-right"><?php echo display('total');?></th>
                                <th class="text-right"><?php echo number_format($Debit, 2); ?></th>
                                <th class="text-right"><?php echo number_format($Credit, 2); ?></th>
                            </tr>
                            <tr>                
                                <th class="" colspan="3"><?php echo display('in_words');?> : <?php
                                   $wordsamount = $Debit;
                                     echo $numberToword->AmountInWords($wordsamount); ?></th>               
                            </tr>
                    <?php } ?>
                        <tr>                            
                            <th class="" colspan="3"><?php echo display('remarks')?> : <?php echo $singlevoucher->Narration; ?></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="form-group row mt-100-50" >
                <label for="name" class="col-lg-3 col-md-3 col-sm-3  col-form-label text-center"> <div class="border-top"><?php echo display('prepared_by')?></div></label>
                <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-form-label text-center"> <div class="border-top"><?php echo display('checked_by')?></div></label>
                <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-form-label text-center"> <div class="border-top"><?php echo display('authorised_by')?></div></label>
                <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-form-label text-center"> <div class="border-top"><?php echo display('pay_by')?></div></label>
                           
                </div>
            </div>
            <div class="printbtn col-md-12 mt-2" > 
                <div class="mr-25">
                     <button  class="btn btn-warning" name="sbtnPrint" id="sbtnPrint" onclick="printVaucher('PrintArea_<?php echo $ix;?>');"><i class='fa fa-print'></i>  Print this voucher</button>                   
                </div>
            </div>
            <hr/>
   <?php $ix++; } } ?>
</div>