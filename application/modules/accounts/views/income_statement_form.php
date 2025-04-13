    <!-- New income -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('income_statement') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
             <?php echo form_open('accounts/income_statement',array('class' => 'form-inline','method'=>'post'))?>
                   <div class="form-group form-group-margin">
                      <label for="employeelist"><?php echo display('year')?>:</label>
                              
                    </div> 
                    <div class="form-group form-group-new empdropdown">
                         <select class="form-control" name="fyear">
                          <?php foreach($fyears as $fyear){?>
                            <option value="<?php echo $fyear->id;?>"><?php echo $fyear->yearName;?></option>
                          <?php }?>
                        </select> 
                     </div> 

                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>                        
                        <?php echo form_close() ?>  
                    </div>
                    
                </div>
            </div>
        </div>

    </section>
</div>
<!-- Add new income statement end -->



