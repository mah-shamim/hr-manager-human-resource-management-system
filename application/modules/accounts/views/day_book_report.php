<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">             
            <div class="panel-heading panel-aligner" >
                <div class="panel-title">
                    <h4><?php echo display('day_book') ?></h4>
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
<div class="row">    
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 
            <div class="panel-heading panel-aligner" >
                <div class="panel-title">
                    <h4><?php echo display('day_book') ?></h4>
                </div>
                <div class="mr-25">                                       
                </div>
            </div>    
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('VNo') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('account_name') ?></th>
                            <th><?php echo display('ledgerComment') ?></th>
                            <th><?php echo display('subtype') ?></th>
                            <th><?php echo display('debit') ?></th> 
                            <th><?php echo display('credit') ?></th>
                            <th><?php echo display('reverseHead') ?></th>
                            <th><?php echo display('action') ?></th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($voucherInfo)) { $sl = 1; ?>                           
                            <?php foreach ($voucherInfo as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC"; ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->VNo ;?> </td> 
                                    <td><?php echo date('d-m-Y', strtotime($row->VDate)); ?></td>
                                    <td><?php echo $row->HeadName; ?></td> 
                                    <td><?php echo $row->ledgerComment; ?></td> 
                                    <td><?php echo $row->name; ?></td>              
                                    <td><?php echo $row->Debit !=0? $setting->currency_symbol. ' '.$row->Debit:''; ?></td> 
                                    <td><?php echo $row->Credit!=0? $setting->currency_symbol. ' '.$row->Credit:''; ?></td> 
                                    <td><?php echo $row->reverseHead != ''? $row->reverseHead:''; ?></td>                                                 
                                                  
                                    <td class="center">
                                        <a href="javascript:" onClick=" return showVaucherDetail('<?php echo $row->VNo;?>','<?php echo $row->Vtype; ?>');" title="View Vaucher"><i class="fa fa-eye"></i></a> 
                                       
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div> 
<!-- view all transation modal -->
<div class="modal fade " id="allvaucherModal" tabindex="-1" role="dialog" aria-labelledby="moduleModalLabel" aria-hidden="true" >
    <div class="modal-dialog custom-modal-dialog">
        <div class="modal-content " >
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" id="allAppointModalLabel">Vaucher Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body" id="all_vaucher_view"> 
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" name="btnPrint" id="btnPrint" onclick="printVaucher('all_vaucher_view');"><i class='fa fa-print'></i>  Print </button>
                <a id="pdfDownload"  href="" target="_blank" title="download pdf">
                    <button  class="btn btn-success btn-md" name="btnPdf" id="btnPdf" ><i class="fa-file-pdf-o"></i> PDF</button>
             </a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-cross'></i> close</button>
                <input type="hidden" id="base_url" value="<?php echo base_url();?>"/>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo MOD_URL.'accounts/assets/js/day_book_report.js'; ?>" type="text/javascript"></script>