
 <ul class="nav nav-tabs candidate nav-tabs-new">
    <li class="active"><a href="#tab1" data-toggle="tab"><?php echo display('basic_information')?></a></li>
    <li><a href="#tab2" data-toggle="tab"><?php echo display('educational_information')?></a></li>
    <li><a href="#tab3" data-toggle="tab"><?php echo display('past_experience')?></a></li>
</ul>
 <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                
                <div class="panel-body">
 <?php echo  form_open_multipart('recruitment/Candidate/caninfo_create') ?>
<div class="tab-content">

        

                    
                        <div class="tab-pane active" id="tab1">
 <div class="form-group row">
                            <label for="first_name" class="col-sm-3 col-form-label"><?php echo display('first_name') ?> *</label>
                            <div class="col-sm-9">
                                <input name="first_name" class="form-control" type="text" placeholder="<?php echo display('first_name') ?>" id="first_name"  required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="last_name" class="col-sm-3 col-form-label"><?php echo display('last_name') ?> </label>
                            <div class="col-sm-9">
                                <input name="last_name" class="form-control" type="text" placeholder="<?php echo display('last_name') ?>" id="last_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?> *</label>
                            <div class="col-sm-9">
                                <input name="email" class="form-control" type="email" placeholder="<?php echo display('email') ?>" id="email"  required>
                                 <span id="email_v_message"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label"><?php echo display('phone') ?> *</label>
                            <div class="col-sm-9">
                                <input name="phone" class="form-control" type="number" placeholder="<?php echo display('phone') ?>" id="phone"  required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="alter_phone" class="col-sm-3 col-form-label"><?php echo display('alter_phone') ?> </label>
                            <div class="col-sm-9">
                                <input name="alter_phone" class="form-control" type="number" placeholder="<?php echo display('alter_phone') ?>" id="alter_phone">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="ssn" class="col-sm-3 col-form-label"><?php echo display('ssn') ?> </label>
                            <div class="col-sm-9">
                                <input name="ssn" class="form-control" type="text" placeholder="<?php echo display('ssn') ?>" id="ssn">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="present_address" class="col-sm-3 col-form-label"><?php echo display('present_address') ?> </label>
                            <div class="col-sm-9">
                                <textarea name="present_address" class="form-control"  placeholder="<?php echo display('present_address') ?>" id="present_address" ></textarea>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="parmanent_address" class="col-sm-3 col-form-label"><?php echo display('parmanent_address') ?> </label>
                            <div class="col-sm-9">
                                <textarea name="parmanent_address" class="form-control"  placeholder="<?php echo display('parmanent_address') ?>" id="parmanent_address" ></textarea>
                            </div>
                        </div> 
                         <div class="form-group row">
                            <label for="state" class="col-sm-3 col-form-label"><?php echo display('state') ?> </label>
                            <div class="col-sm-9">
                                <?php echo form_dropdown('state',$country_list,"York", ' class="form-control"') ?> 
                            </div>
                        </div> 

                  <div class="form-group row">
                            <label for="city" class="col-sm-3 col-form-label"><?php echo display('city') ?> </label>
                            <div class="col-sm-9">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City">
                            </div>
                        </div> 
                         <div class="form-group row">
                            <label for="zip_code" class="col-sm-3 col-form-label"><?php echo display('zip_code') ?> </label>
                            <div class="col-sm-9">
                    <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="<?php echo display('zip_code') ?>">
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="picture" class="col-sm-3 col-form-label">Picture</label>
                            <div class="col-sm-9">
                                <input type="file" name="picture" class="form-control"  placeholder="<?php echo display('picture') ?>" id="picture" >
                            </div>
                        </div> 
                        <div class="form-group form-group-margin text-right">
                    <a class="btn btn-primary btnNext" onclick="validation1()">Next</a></div>
                </div>
                <div class="tab-pane" id="tab2">
               

                        <div class="form-group row">
                            <label for="degree_name" class="col-sm-3 col-form-label"><?php echo display('degree_name') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="degree_name[]" class="form-control"  placeholder="<?php echo display('degree_name') ?>" id="degree_name"  >
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="university_name" class="col-sm-3 col-form-label"><?php echo display('university_name') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="university_name[]" class="form-control"  placeholder="<?php echo display('university_name') ?>" id="university_name">
                            </div>
                        </div> 
                          <div class="form-group row">
                            <label for="cgp" class="col-sm-3 col-form-label"><?php echo display('cgp') ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="cgp[]" class="form-control"  placeholder="<?php echo display('cgp') ?>" id="cgp" >
                            </div>
                        </div> 

                          <div class="form-group row">
                            <label for="comments" class="col-sm-3 col-form-label"><?php echo display('comments') ?></label>
                            <div class="col-sm-9">
                                <textarea  name="comments" class="form-control"  placeholder="<?php echo display('comments') ?>" id="comments" ></textarea>
                            </div>
                        </div> 
                        
 <!--Education information add more form part start  -->

      <div id="add" class="toggle">
                        <div class="form-group row">
                            <label for="degree_name" class="col-sm-3 col-form-label"><?php echo display('degree_name') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="degree_name[]" class="form-control"  placeholder="<?php echo display('degree_name') ?>" id="degree_name"  >
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="university_name" class="col-sm-3 col-form-label"><?php echo display('university_name') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="university_name[]" class="form-control"  placeholder="<?php echo display('university_name') ?>" id="university_name">
                            </div>
                        </div> 
                          <div class="form-group row">
                            <label for="cgp" class="col-sm-3 col-form-label"><?php echo display('cgp') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="cgp[]" class="form-control"  placeholder="<?php echo display('cgp') ?>" id="cgp" >
                            </div>
                        </div> 
                         <div id="add" class="toggle">
                        <div class="form-group row">
                            <label for="degree_name" class="col-sm-3 col-form-label"><?php echo display('degree_name') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="degree_name[]" class="form-control"  placeholder="<?php echo display('degree_name') ?>" id="degree_name"  >
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="university_name" class="col-sm-3 col-form-label"><?php echo display('university_name') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="university_name[]" class="form-control"  placeholder="<?php echo display('university_name') ?>" id="university_name">
                            </div>
                        </div> 
                          <div class="form-group row">
                            <label for="cgp" class="col-sm-3 col-form-label"><?php echo display('cgp') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="cgp[]" class="form-control"  placeholder="<?php echo display('cgp') ?>" id="cgp" >
                            </div>
                        </div> 

                  </div>

                  </div>
                  <div class="form-group form-group-margin text-right">
                  <a class="btn btn-primary btnPrevious">Previous</a>
        <a class="btn btn-primary btnNext" onclick="validation2()">Next</a>
        </div>
    </div>
     <div class="tab-pane" id="tab3">
    
                        <div class="form-group row">
                            <label for="company_name" class="col-sm-3 col-form-label"><?php echo display('company_name') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="company_name[]" class="form-control"  placeholder="<?php echo display('company_name') ?>" id="company_name"  >
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="working_period" class="col-sm-3 col-form-label"><?php echo display('working_period') ?> </label>
                            <div class="col-sm-9">

                                <input type="text" name="working_period[]" class="  daterange form-control"  placeholder="<?php echo display('working_period') ?>" id="working_period">
                            </div>
                        </div> 
                          <div class="form-group row">
                            <label for="duties" class="col-sm-3 col-form-label"><?php echo display('duties') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="duties[]" class="form-control"  placeholder="<?php echo display('duties') ?>" id="duties" >
                            </div>
                        </div> 

                          <div class="form-group row">
                            <label for="supervisor" class="col-sm-3 col-form-label"><?php echo display('supervisor') ?> </label>
                            <div class="col-sm-9">
                                <input type="text"  name="supervisor[]" class="form-control"  placeholder="<?php echo display('supervisor') ?>" id="supervisor" >
                            </div>
                        </div> 
                      
                      <div id="add" class="toggle">
                        <div class="form-group row">
                            <label for="company_name" class="col-sm-3 col-form-label"><?php echo display('company_name') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="company_name[]" class="form-control"  placeholder="<?php echo display('company_name') ?>" id="company_name"  >
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="working_period" class="col-sm-3 col-form-label"><?php echo display('working_period') ?> </label>
                            <div class="col-sm-9">

                                <input type="text" name="working_period[]" class="  daterange form-control"  placeholder="<?php echo display('working_period') ?>" id="working_period">
                            </div>
                        </div> 
                          <div class="form-group row">
                            <label for="duties" class="col-sm-3 col-form-label"><?php echo display('duties') ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="duties[]" class="form-control"  placeholder="<?php echo display('duties') ?>" id="duties" >
                            </div>
                        </div> 

                          <div class="form-group row">
                            <label for="supervisor" class="col-sm-3 col-form-label"><?php echo display('supervisor') ?> </label>
                            <div class="col-sm-9">
                                <input type="text"  name="supervisor[]" class="form-control"  placeholder="<?php echo display('supervisor') ?>" id="supervisor" >
                            </div>
                        </div> 
                        <div id="add" class="toggle">
                          <div class="form-group row">
                            <label for="company_name" class="col-sm-3 col-form-label"><?php echo display('company_name') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="company_name[]" class="form-control"  placeholder="<?php echo display('company_name') ?>" id="company_name"  >
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="working_period" class="col-sm-3 col-form-label"><?php echo display('working_period') ?> </label>
                            <div class="col-sm-9">

                                <input type="text" name="working_period[]" class="form-control"  placeholder="<?php echo display('working_period') ?>" id="working_period">
                            </div>
                        </div> 
                          <div class="form-group row">
                            <label for="duties" class="col-sm-3 col-form-label"><?php echo display('duties') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" name="duties[]" class="form-control"  placeholder="<?php echo display('duties') ?>" id="duties" >
                            </div>
                        </div> 

                          <div class="form-group row">
                            <label for="supervisor" class="col-sm-3 col-form-label"><?php echo display('supervisor') ?> </label>
                            <div class="col-sm-9">
                                <input type="text"  name="supervisor[]" class="form-control"  placeholder="<?php echo display('supervisor') ?>" id="supervisor" >
                            </div>
                        </div> 
                  </div>

                  </div>

         <div class="form-group text-right">
                            <a class="btn btn-primary btnPrevious">Previous</a>
                            <button type="submit" class="btn btn-success"><?php echo display('submit') ?></button>
                        </div>
    </div>
      
    
   
</div>
<?php echo form_close() ?>
</div>
</div>
</div>
</div>

 <script src="<?php echo base_url('assets/js/recruitment.js') ?>" type="text/javascript"></script>




