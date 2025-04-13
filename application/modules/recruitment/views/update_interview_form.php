   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
                <div class="panel-heading panel-aligner">
                    <div class="panel-title">
                        <h4><?php echo (!empty($title)?$title:null) ?></h4>
                    </div>
                     <div class="mr-25">

                        <?php if($this->permission->method('recruitment','read')->access()): ?> 
                        <a href="<?php echo base_url();?>recruitment/Candidate_select/candidate_interview_view" class="btn btn-primary"><?php echo display('manage_interview') ?></a>
                        <?php endif; ?>


                    </div>
                </div>
                <div class="panel-body">
  <?php echo  form_open_multipart('recruitment/Candidate_select/interview_update_form/'. $data->can_int_id) ?>
                    <input name="can_int_id" type="hidden" value="<?php echo $data->can_int_id ?>">

                          <div class="form-group row">
                            <label for="can_id" class="col-sm-2 col-form-label"><?php echo display('candidate_name') ?> *</label>
                            <div class="col-sm-4">
                              
                                <?php echo form_dropdown('can_id', $dropdowninterview, (!empty($data->can_id )?$data->can_id :null), ' class="form-control" onchange="SelectToLoadInterview(this.value)" id="c_id"') ?>
                            </div>
                             <label for="job_adv_id" class="col-sm-2 col-form-label"><?php echo display('job_adv_id') ?> *</label>
                            <div class="col-sm-4">
                                <input type="text" name="position_name" class="form-control" placeholder="<?php echo display('position')?>" value="<?php echo $data->position_name;?>" readonly>
               <input type="hidden" name="job_adv_id" class="form-control" value="<?php echo $data->job_adv_id?>">
                            </div>
                        </div>
                       
                          <div class="form-group row">
                            <label for="interview_date" class="col-sm-2 col-form-label"><?php echo display('interview_date') ?> *</label>
                            <div class="col-sm-4">
                                <input type="text" name="interview_date" class="datepicker form-control"  placeholder="<?php echo display('interview_date') ?>" id="interview_date" value="<?php echo $data->interview_date?>">
                            </div>
                            <label for="interviewer_id" class="col-sm-2 col-form-label"><?php echo display('interviewer_id') ?> *</label>
                            <div class="col-sm-4">
                                <input type="text" name="interviewer_id" class="form-control"  placeholder="<?php echo display('interviewer_id') ?>" id="interviewer_id" value="<?php echo $data->interviewer_id ; ?>" >
                            </div>
                        </div> 

                      
                        <div class="form-group row">
                            <label for="interview_marks" class="col-sm-2 col-form-label"><?php echo display('interview_marks') ?> *</label>
                            <div class="col-sm-4">
                                <input type="text" name="interview_marks" class="txt form-control"  placeholder="<?php echo display('interview_marks') ?>" id="interview_marks" value="<?php echo $data->interview_marks?>" >
                            </div>
                            <label for="written_total_marks" class="col-sm-2 col-form-label"><?php echo display('written_total_marks') ?> *</label>
                            <div class="col-sm-4">
                                <input type="text" name="written_total_marks" class="txt form-control"  placeholder="<?php echo display('written_total_marks') ?>" id="written_total_marks" value="<?php echo $data->written_total_marks?>">
                            </div>
                        </div> 
        
                        

                      <div class="form-group row">
                            <label for="mcq_total_marks" class="col-sm-2 col-form-label"><?php echo display('mcq_total_marks') ?> *</label>
                            <div class="col-sm-4">
                                <input type="text" name="mcq_total_marks" class="txt form-control"  placeholder="<?php echo display('mcq_total_marks') ?>" id="mcq_total_marks"  value="<?php echo $data->mcq_total_marks ; ?>">
                            </div>
                            <label for="total_marks" class="col-sm-2 col-form-label"><?php echo display('total_marks') ?> *</label>
                            <div class="col-sm-4">
                                <input type="text" name="total_marks" class=" form-control"  placeholder="<?php echo display('total_marks') ?>" id="total_marks"  value="<?php echo $data->total_marks ; ?>">
                            </div>
                        </div>
                         
                        <div class="form-group row">
                            <label for="recommandation" class="col-sm-2 col-form-label"><?php echo display('recommandation') ?></label>
                            <div class="col-sm-4">
                                <input type="text" name="recommandation" class="form-control"  placeholder="<?php echo display('recommandation') ?>" id="recommandation" value="<?php echo $data->recommandation?>" >
                            </div>
                            <label for="selection" class="col-sm-2 col-form-label"><?php echo display('selection') ?> *</label>
                            <div class="col-sm-4">
                                
                                <select name="selection" class="form-control"  placeholder="<?php echo display('selection') ?>" id="selection">
                                    <option value="">Selection type</option>
                                    <option value="ok" <?php  if($data->selection=='ok'){
                                        echo 'selected';
                                    } ?>>Selected</option>
                                    <option value="No" <?php  if($data->selection=='No'){
                                        echo 'selected';
                                    } ?>>Deselected</option>

                                </select>
                            </div>
                        </div> 
        
                        
                        <div class="form-group row">
                            <label for="details" class="col-sm-2 col-form-label"><?php echo display('details') ?></label>
                            <div class="col-sm-10">
                                <textarea name="details" class="form-control"  placeholder="<?php echo display('details') ?>" id="details" ><?php echo $data->details?></textarea>
                            </div>
                        </div> 
          
                        <div class="form-group form-group-margin text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>
             
   <script src="<?php echo base_url('assets/js/recruitment.js') ?>" type="text/javascript"></script>  
  
