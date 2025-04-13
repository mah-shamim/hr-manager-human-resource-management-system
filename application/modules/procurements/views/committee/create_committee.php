
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php if(!empty($committeeinfo->id)){echo  display('update_committee');}else{ echo  display('add_committee');} ?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                        <div class="col-sm-6">
                            <?php echo  form_open_multipart('procurements/procurement_committee/create_committee/', array('class' => 'form-vertical', 'id' => 'insert_committee', 'name' => 'insert_committee')) ?>
                                <?php echo form_hidden('id', (!empty($committeeinfo->id)?$committeeinfo->id:null)) ?>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input name="name" class="form-control" type="text" placeholder="<?php echo display('name') ?>" id="name" value="<?php echo (!empty($committeeinfo->name)?$committeeinfo->name:null) ?>" autocomplete="off" required >
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="sign_image" class="col-sm-3 col-form-label"><?php echo display('signature') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="file" name="sign_image" accept="image/*" <?php if(empty($committeeinfo->id)){echo "required";}?> onchange="loadFile(event)">
                                        <p>N.B: image width should be 300px and height 120px</p>

                                        <small id="fileHelp" class="text-muted"><img src="<?php if(!empty($committeeinfo->sign_image)){echo base_url().$committeeinfo->sign_image;}else{echo base_url().'application/modules/procurements/assets/images/small.jpg';} ?>" id="output"   class="img-thumbnail procurement-signature"/>
                                        </small>
                                    </div>
                                </div>
                             
                                <div class="form-group form-group-margin text-right">
                                    <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                    <button type="submit" class="btn btn-success w-md m-b-5"><?php
                                    echo (!empty($committeeinfo->id)?display('update'):display('save'))  ?></button>
                                </div>
                            <?php echo form_close() ?>
                        </div>
                </div>

            </div>  
        </div>
    </div>
</div>

<script src="<?php echo MOD_URL.'procurements/assets/js/procurement.js'; ?>" type="text/javascript"></script>

