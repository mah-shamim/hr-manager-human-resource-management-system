    
   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="panel-title">
                       <h4><?php echo (!empty($title)?$title:null) ?></h4>
                       
                    </div>
                </div>
                <div class="panel-body">
  
            
                <?php echo form_open_multipart('dashboard/setting/create','class="form-inner"') ?>
                    <?php echo form_hidden('id',$setting->id) ?>

                    <div class="form-group row">
                        <label for="title" class="col-xs-3 col-form-label"><?php echo display('application_title') ?> <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="title" type="text" class="form-control" id="title" placeholder="<?php echo display('application_title') ?>" value="<?php echo $setting->title ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-xs-3 col-form-label"><?php echo display('address') ?></label>
                        <div class="col-xs-9">
                            <input name="address" type="text" class="form-control" id="address" placeholder="<?php echo display('address') ?>"  value="<?php echo $setting->address ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-xs-3 col-form-label"><?php echo display('email')?></label>
                        <div class="col-xs-9">
                            <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo display('email')?>"  value="<?php echo $setting->email ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-xs-3 col-form-label"><?php echo display('phone') ?></label>
                        <div class="col-xs-9">
                            <input name="phone" type="number" class="form-control" id="phone" placeholder="<?php echo display('phone') ?>"  value="<?php echo $setting->phone ?>" >
                        </div>
                    </div>


                    <!-- if setting favicon is already uploaded -->
                    <?php if(!empty($setting->favicon)) {  ?>
                    <div class="form-group row">
                        <label for="faviconPreview" class="col-xs-3 col-form-label"></label>
                        <div class="col-xs-9">
                            <img src="<?php echo base_url($setting->favicon) ?>" alt="Favicon" class="img-thumbnail" />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group row">
                        <label for="favicon" class="col-xs-3 col-form-label"><?php echo display('favicon') ?> </label>
                        <div class="col-xs-9">
                            <input type="file" name="favicon" id="favicon">
                            <input type="hidden" name="old_favicon" value="<?php echo $setting->favicon ?>">
                        </div>
                    </div>


                    <!-- if setting logo is already uploaded -->
                    <?php if(!empty($setting->logo)) {  ?>
                    <div class="form-group row">
                        <label for="logoPreview" class="col-xs-3 col-form-label"></label>
                        <div class="col-xs-9">
                            <img src="<?php echo base_url($setting->logo) ?>" alt="Picture" class="img-thumbnail" />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group row">
                        <label for="logo" class="col-xs-3 col-form-label"><?php echo display('logo') ?></label>
                        <div class="col-xs-9">
                            <input type="file" name="logo" id="logo">
                            <input type="hidden" name="old_logo" value="<?php echo $setting->logo ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="currency_symbol" class="col-xs-3 col-form-label"><?php echo display('currency_symbol') ?></label>
                        <div class="col-xs-9">
                            <input name="currency_symbol" type="text" class="form-control" id="currency_symbol" placeholder="<?php echo display('currency_symbol') ?>" value="<?php echo $setting->currency_symbol ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="currency_in_words" class="col-xs-3 col-form-label"><?php echo display('currency_in_words') ?></label>
                        <div class="col-xs-9">
                            <input name="currency_in_words" type="text" class="form-control" id="currency_in_words" placeholder="<?php echo display('currency_in_words') ?>" value="<?php echo $setting->currency_in_words ?>">
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label for="state_income_tax" class="col-xs-3 col-form-label"><?php echo display('state_income_tax').'(%)';?></label>
                        <div class="col-xs-9">
                            <input name="state_income_tax" type="number" class="form-control" id="currency_symbol" placeholder="<?php echo display('state_income_tax') ?>" value="<?php echo $setting->state_income_tax ?>">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="soc_sec_npf_tax" class="col-xs-3 col-form-label"><?php echo display('soc_sec_npf_tax').'(%)';?></label>
                        <div class="col-xs-9">
                            <input name="soc_sec_npf_tax" type="number" class="form-control" id="currency_symbol" placeholder="<?php echo display('soc_sec_npf_tax') ?>" value="<?php echo $setting->soc_sec_npf_tax ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('language') ?></label>
                        <div class="col-xs-9">
                            <?php echo  form_dropdown('language',$languageList,$setting->language, 'class="form-control"') ?>
                        </div>
                    </div> 
                             <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('time_zone') ?></label>
                        <div class="col-xs-9">
        
                            <?php echo form_dropdown('timezone', $timezonelist, $setting->timezone , array('class'=>'form-control')); ?>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('site_align') ?></label>
                        <div class="col-xs-9">
                            <?php echo  form_dropdown('site_align', array('LTR' => display('left_to_right'), 'RTL' => display('right_to_left')) ,$setting->site_align, 'class="form-control"') ?>
                        </div>
                    </div> 
                    

                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('footer_text') ?></label>
                        <div class="col-xs-9">
                            <textarea name="footer_text" class="form-control"  placeholder="Footer Text" maxlength="140" rows="7"><?php echo $setting->footer_text ?></textarea>
                        </div>
                    </div>   

                    <div class="form-group form-group-margin text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>