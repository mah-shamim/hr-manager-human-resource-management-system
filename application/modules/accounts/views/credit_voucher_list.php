<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-heading panel-aligner" >
                <div class="panel-title">
                    <h4><?php echo display('credit_voucher') ?></h4>
                </div>
                <div class="mr-25">

                    <?php if($this->permission->check_label('credit_voucher')->create()->access()): ?>
                    <a href="<?php echo base_url("accounts/accounts/create_credit_voucher") ?>" class="btn btn-primary btn-md" ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <?php echo display('create_credit_voucher');?></a> 
                    
                    <?php endif; ?> 
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
                        <?php if (!empty($voucherInfo)) { ?>
                            <?php $sl = 1; ?>
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
                                       <?php if($this->permission->check_label('credit_voucher')->update()->access()):   if($row->isApproved == 0 ) {?>
                                        <a href="<?php echo base_url("accounts/accounts/edit_voucher/$row->id") ?>" class="btn btn-xs btn-success" title="Edit Vaucher" ><i class="fa fa-pencil"></i></a> 
                                       <?php } else { if($row->isyearClosed == 0) {?>                                         
                                          <button class="btn btn-xs btn-success" onclick="return reverseVoucher('<?php echo $row->VNo;?>');" title="Reverse Vaucher"><i class="fa fa-undo"></i></button>
                                        <?php }} endif; ?>
                                        <?php if($this->permission->check_label('credit_voucher')->delete()->access()):    
                                        if($row->isApproved == 0 ) { ?>  
                                           <button class="btn btn-xs btn-danger" onclick="return deleteVoucher('<?php echo $row->VNo;?>');" title="Delete Vaucher"><i class="fa fa-trash"></i></button> 
                                       <?php } endif;  ?> 
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
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
               <a id="pdfDownload" href="" target="_blank" title="download pdf">
                    <button  class="btn btn-success btn-md" name="btnPdf" id="btnPdf" ><i class="fa-file-pdf-o"></i> PDF</button>
             </a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
                <input type="hidden" id="base_url" value="<?php echo base_url();?>"/>
                
            </div>
        </div>
    </div>
</div>

<script src="<?php echo MOD_URL.'accounts/assets/js/credit_voucher_list.js'; ?>" type="text/javascript"></script>
