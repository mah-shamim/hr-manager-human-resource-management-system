   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">

                <div class="panel-heading">
                  <div class="panel-title">
                      <h4>
                        <?php echo display('update')?>
                      </h4>
                  </div>
                </div>
                
                <div class="panel-body">
                 <?php echo  form_open('loan/Loan/update_install_form/'. $data->loan_inst_id) ?>


                    <input name="loan_inst_id" type="hidden" value="<?php echo $data->loan_inst_id ?>">
                 
                       <div class="form-group row">
                            <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> *</label>

                            
                            <div class="col-sm-9">
                            <?php
        echo form_dropdown('employee_id', $gndloan,(!empty($data->employee_id)?$data->employee_id:null), 'class="form-control" onchange="SelectToLoadLoanReceiver(this.value)"');
        ?>
                         
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="loan_id" class="col-sm-3 col-form-label"><?php echo display('loan_id') ?> *</label>
                            <div class="col-sm-9">
                                  <select name="loan_id" class="form-control" onchange="SelectReceiverinfo(this.value),SelectReceiverInstallment(this.value)" id="loan_id" >
                                      <option value="<?php echo $data->loan_id; ?>" selected><?php echo $data->loan_id; ?></option>
                                  </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="installment_amount" class="col-sm-3 col-form-label"><?php echo display('installment_amount') ?> *</label>
                            <div class="col-sm-9">
                                <input type="number" name="installment_amount" class="form-control" placeholder="<?php 
                                 echo display('installment_amount') ?>" id="installment_amount" value="<?php echo $data->installment_amount; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment" class="col-sm-3 col-form-label"><?php echo display('payment') ?> *</label>
                            <div class="col-sm-9">
                                <input name="payment" class="form-control" type="number" placeholder="<?php echo display('payment') ?>" id="payment" value="<?php echo $data->payment; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label"><?php echo display('date') ?> *</label>
                            <div class="col-sm-9">
                                <input type="text" name="date" class="datepicker form-control"  placeholder="<?php echo display('date') ?>" id="date" value="<?php echo $data->date; ?>" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="received_by" class="col-sm-3 col-form-label"><?php echo display('received_by') ?> *</label>
                            <div class="col-sm-9">
                              
                                  <?php
        echo form_dropdown('received_by', $receiver,(!empty($data->received_by)?$data->received_by:null), 'class="form-control"');
        ?>
                            </div>
                        </div>   
                         <div class="form-group row">
                            <label for="installment_no" class="col-sm-3 col-form-label"><?php echo display('installment_no') ?> *</label>
                            <div class="col-sm-9">
                                <input type="text" name="installment_no" class="form-control"  placeholder="<?php echo display('installment_no') ?>" id="installment_no" value="<?php echo $data->installment_no; ?>" >
                            </div>
                        </div>

                        
                          <div class="form-group row">
                            <label for="notes" class="col-sm-3 col-form-label"><?php echo display('notes') ?> *</label>
                            <div class="col-sm-9">
                                <textarea  name="notes" class="form-control"  placeholder="<?php echo display('notes') ?>" id="notes" ><?php echo $data->notes; ?></textarea>
                            </div>
                        </div> 
                          
             
                        <div class="form-group form-group-margin text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('paid') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>


  
   
 <script src="<?php echo base_url('assets/js/loan.js') ?>" type="text/javascript"></script>