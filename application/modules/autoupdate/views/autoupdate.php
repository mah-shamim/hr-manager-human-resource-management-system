<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Autpupdate css part-->
<link rel="stylesheet" type="text/css" href="<?php echo MOD_URL.'autoupdate/assets/css/auto_update.css'; ?>">
<!-- Autpupdate js part-->
<script src="<?php echo MOD_URL.'autoupdate/assets/js/script.js'; ?>"></script>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">

            <!-- Currently this 4.5 version will be used as fixed version ... for this checking the condition below as false-->
                <div class="row noupdate-section">
                    <div class="form-group col-lg-4 col-sm-offset-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success text-center cur-ver"><?php echo 'Current Version'?> <br>V-<?php echo $current_version ?></div>
                                <h2 class="text-center"><?php echo display('noupdates')?></h2>
                            </div>
                        </div>
                    </div>
                </div>  

            </div>
        </div>
    </div>
</div>
 