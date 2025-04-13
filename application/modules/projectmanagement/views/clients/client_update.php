
<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span class="title"><?php echo $title; ?></span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('projectmanagement/Pm_clients/client_update/'.$id, array('class' => 'form-vertical', 'id' => 'update_client', 'name' => 'update_client')) ?>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group row">
                                    <label for="client_name" class="col-sm-3 col-form-label"><?php echo display('client_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control" name="client_name" id="client_name" required="" placeholder="<?php echo display('client_name') ?>" value="<?php if(!empty($client_data->client_name)){echo $client_data->client_name;}?>">

                                        <input type="hidden" name="old_client_name" value="<?php if(!empty($client_data->client_name)){echo $client_data->client_name;}?>">
                                        <input type="hidden" name="client_id" value="<?php if(!empty($client_data->client_id)){echo $id;}?>">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="country" class="col-sm-3 col-form-label"><?php echo display('state') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <?php echo form_dropdown('country', $country_list, (!empty($client_data->country)?$client_data->country:"York"), ' class="form-control"') ?> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="email"class="form-control" name="email" id="email" required="" placeholder="<?php echo display('email') ?>" value="<?php if(!empty($client_data->email)){echo $client_data->email;}?>">
                                        <input type="hidden" name="old_email" value="<?php if(!empty($client_data->email)){echo $client_data->email;}?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="company" class="col-sm-3 col-form-label"><?php echo display('company') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control" name="company" id="company" required="" placeholder="<?php echo display('company') ?>" value="<?php if(!empty($client_data->company_name)){echo $client_data->company_name;}?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label"><?php echo display('address') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="address" id="address" required="" placeholder="<?php echo display('address') ?>" tabindex="2"><?php if(!empty($client_data->address)){echo $client_data->address;}?></textarea>
                                    </div>
                                </div>

                                 <br>

                                <div class="form-group row">
                                    <div class="form-group form-group-margin form-projectmanagement text-right">

                                        <input type="submit" id="add-product" class="btn btn-success btn-large" name="add-product" value="<?php echo display('save') ?>" tabindex="10"/>
                                    </div>
                                </div>

                            </div>

                        </div>

                        
                    </div>

                    <?php echo form_close() ?>

                </div>
            </div>
        </div>