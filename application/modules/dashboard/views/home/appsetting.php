  
   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                       <h4><?php echo (!empty($title)?$title:null) ?></h4>
                       <span class="text-right"><input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print QR" onclick="printDiv();"/></span>
                    </div>
                </div>

                   
                <div class="panel-body">
                     <div class="row">

                <div class="col-sm-6" id="printArea">

                    <table  id="" class="table table-responsive">
            <tr><td> <img src="<?php echo base_url('assets/img/qr/'.$qr) ?>" class="img-responsive center-block appsettingqr" alt="">
                <span class="qr-text">Attendance QR code</span>
            </td>
              
            </tr>

    </table>

                </div>
                <div class="col-sm-6 playstorelink">
                     <a href="https://play.google.com/store/apps/details?id=com.bdtaskhrm" target="blank"><h2>Download Mobile Apps From  
                 Playstor</h2></a>
                <h1 class="text-center playstorelinktext"><a href="https://play.google.com/store/apps/details?id=com.bdtaskhrm" target="blank" class="text-center"><i class="fa fa-android"></i></a></h1>
                </div>
            </div>
  <hr>
             <div class="row disablecontent">
              
                            <div class="col-sm-12">
                <?php echo form_open_multipart('dashboard/appsetting/create','class="form-inner"') ?>
                    <?php echo form_hidden('id',$appsetting->id) ?>

 

                    <div class="form-group row">
                        <label for="latitude" class="col-xs-3 col-form-label"><?php echo display('latitude') ?></label>
                        <div class="col-xs-9">
                    <input name="latitude" type="text" class="form-control" id="latitude" placeholder="<?php echo display('latitude')?>"  value="<?php echo $appsetting->latitude ?>">  
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="longitude" class="col-xs-3 col-form-label"><?php echo display('longitude') ?></label>
                        <div class="col-xs-9">
                            <input name="longitude" type="text" class="form-control" id="longitude" placeholder="<?php echo display('longitude')?>"  value="<?php echo $appsetting->longitude ?>">  
                        </div>
                    </div> 
                    
                      <div class="form-group row">
                        <label for="acceptablerange" class="col-xs-3 col-form-label"><?php echo display('acceptablerange') ?></label>
                        <div class="col-xs-9">
                            <input name="acceptablerange" type="text" class="form-control" id="acceptablerange" placeholder="<?php echo display('acceptablerange')?>"  value="<?php echo $appsetting->acceptablerange ?>">  
                        </div>
                    </div> 
                     <div class="form-group row">
                        <label for="googleapi_authkey" class="col-xs-3 col-form-label"><?php echo display('googleapi_authkey') ?></label>
                        <div class="col-xs-9">
                            <textarea name="googleapi_authkey" class="form-control"  placeholder="googleapi_authkey"  rows="3"><?php echo $appsetting->googleapi_authkey ?></textarea>
                        </div>
                    </div>
            

                    <div class="form-group form-group-margin text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>
            </div>
           
        </div>
        <div class="row text-center">
           <h2>To enable Mobile apps addons for your business please contact at : </h2><span class="contact-addons">business@bdtask.com</span> , Skype : <span class="contact-addons">bdtask</span>
        </div>
            </div>
        </div>
    </div>
</div>