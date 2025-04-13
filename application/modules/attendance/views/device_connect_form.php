 <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo (!empty($title)?$title:null) ?></h4>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo  form_open('attendance/home/device_connection') ?>
                    <?php echo form_hidden('id',$deviceinfo->id); ?>
                        <div class="form-group row">
                            <label for="store_name" class="col-sm-3 col-form-label"><?php echo display('device_ip') ?> *</label>
                            <div class="col-sm-9">
                                <input name="device_ip" class="form-control" type="text" placeholder="<?php echo display('device_ip') ?>" id="device_ip" value="<?php echo $deviceinfo->device_ip?>">
                            </div>
                        </div>   
                         <div class="form-group row">
                            <div class="col-sm-12">
                               <h1><center><?php echo display('device_information')?></center></h1>
                               <div class="col-sm-4"> <img src="<?php echo base_url('assets/img/icons/fingerprint-f18.jpg');?>" alt="" height="200px"></div>
                               <div class="col-sm-8"><h4><?php echo display('device_name')?> : Zkteco(<?php echo display('access_control_device')?>)<br>
                              <?php echo display('device_model')?> : F18</h4><br>
                               <?php echo display('note')?>: <?php echo display('plz_generate_an_ip')?>.
                               <h1>N.B: It Can be Used Only Local Server</h1>
                               </div>
                            </div>
                        </div>            
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>
    
  </body>
</html>


