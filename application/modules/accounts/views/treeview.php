<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/dist/themes/default/style.min.css" />

<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
             
            </div>
        </div>

        <div class="panel-body">                       
            <div class="row">
                <div class="col-md-6">
                    <div id="jstree1">
                        <ul>
                          <?php $visit=array();
                            for ($i = 0; $i < count($userList); $i++)
                            {
                                $visit[$i] = false;
                            }
                            $this->accounts_model->dfs("COA","0",$userList,$visit,0);?>
                        </ul>
                    </div>
                </div> 
<?php if($this->permission->method('accounts','update')->access() || $this->permission->method('accounts','create')->access()): ?>
                <div class="col-md-6" id="newform"></div>
                 <?php endif; ?>
            </div>
        </div> 
     </div>
    </div> 
 <input type="hidden" id="base_url" value="<?php echo base_url();?>" name="base_url">
</div>
 <script src="<?php echo base_url() ?>assets/js/dist/jstree.min.js" ></script>
<script src="<?php echo base_url('assets/js/account.js') ?>" type="text/javascript"></script>
