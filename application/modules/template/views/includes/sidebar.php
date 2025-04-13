
<div class="sidebar">
    <!-- Sidebar user panel -->
    <?php if($this->uri->segment(2) !=='User'){?>
    <div class="user-panel text-center">
        <div class="image">
            <?php $image = $this->session->userdata('image') ?>
            <img src="<?php echo base_url((!empty($image)?$image:'assets/img/icons/default.jpg')) ?>" class="img-circle" alt="User Image">
        </div>
        <div class="info">
            <p><?php echo $this->session->userdata('fullname') ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->userdata('user_level') ?></a>
        </div>
    </div> 
<?php } ?>



    <!-- sidebar menu -->
    <ul class="sidebar-menu">

         <li class="treeview <?php echo (($this->uri->segment(2)=="home")?"active":null) ?>">
            <a href="<?php echo base_url('dashboard/home') ?>"> <i class="ti-dashboard"></i>  <span><?php echo display('dashboard')?></span> 
            </a>
        </li>

<?php if($this->uri->segment(2) !=='User'){?>
  


        <!-- *************************************
        **********STATS OF CUSTOM MODULES*********
        ************************************* -->
        <?php  
        $path = 'application/modules/';
        $map  = directory_map($path);
       
        $HmvcMenu   = array();
        if (is_array($map) && sizeof($map) > 0)

        foreach ($map as $key => $value) {
            $menu = str_replace("\\", '/', $path.$key.'config/menu.php');

            if (file_exists($menu)) {
                @include($menu);
            }  
        }   

 
        if(isset($HmvcMenu) && $HmvcMenu!=null && sizeof($HmvcMenu) > 0)
     ksort($HmvcMenu);
        foreach ($HmvcMenu as $moduleName => $moduleData) {

            // check module permission 
            if (file_exists(APPPATH.'modules/'.$moduleName.'/assets/data/env'))
            if ($this->permission->module($moduleName)->access()) {

            $this->permission->module($moduleName)->access();
        ?>

                <li class="treeview <?php echo (($this->uri->segment(1)==$moduleName)?"active":null) ?>">
                    
                    <a href="javascript:void(0)">
                        <?php echo (($moduleData['icon']!=null)?$moduleData['icon']:null) ?> <span><?php echo display($moduleName) ?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a> 

                    <ul class="treeview-menu">  
                        <?php foreach ($moduleData as $groupLabel => $label) {?>
                            <?php   

                            if ($groupLabel!='icon') 

                            if ((isset($label['controller']) && $label['controller']!=null) && ($label['method']!=null)) {

                               if($this->permission->check_label($groupLabel)->access()){
                                
                
                            ?> 
                                <!-- single level menu/link -->
                                <li class="<?php echo (($this->uri->segment(1)==$moduleName && $this->uri->segment(2)==$label['controller'])?"active":null) ?>">
                                    <a href="<?php echo base_url($moduleName."/".$label['controller']."/".$label['method']) ?>"><?php echo display($groupLabel) ?></a>
                                </li>

                            <?php 
                                } 

                            } else { 
                         
                            ?>

                            <!-- multilevel menu/link -->
                            <!-- extract $label to compare with segment -->
                            <?php 
                            if($this->permission->check_label($groupLabel)->access()){
                            
                            foreach ($label as $url) 
                               
                            ?>
                                <li class="<?php echo (($this->uri->segment(2)==$url['controller'])?"active":null) ?>">
                                    <a href="#"><?php echo display($groupLabel) ?>
                                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                                    </a>
                                    <ul class="treeview-menu <?php echo (($this->uri->segment(2)==$url['controller'])?"menu-open":null) ?>"> 
                                        <?php 
                                        foreach ($label as $name => $value) {

                                            if($this->permission->check_label($name)->access()){
                                           
                                            ?>
                                            <li class="<?php echo (($this->uri->segment(3)==$value['method'])?"active":null) ?>"><a href="<?php echo base_url($moduleName."/".$value['controller']."/".$value['method']) ?>"><?php echo display($name) ?></a></li>
                                            <?php 
                                            } //endif
                                        } //endforeach
                                        ?> 
                                    </ul>
                                </li> 
                            <?php } ?>    

                            <!-- endif -->
                            <?php } ?>
                        <!-- endforeach -->
                        <?php } ?>
                    </ul>
                </li> 
            <!-- end if -->
            <?php } ?>
        <!-- end foreach -->
        <?php } ?> 
        <!-- *************************************
        **********ENDS OF CUSTOM MODULES*********
        ************************************* -->



        <?php if($this->session->userdata('isAdmin')) { ?>
  
        <?php if($this->session->userdata('isLogIn')): ?>
        <li class="treeview <?php echo (($this->uri->segment(2)=="rules")?"active":null) ?>">
            <a href="#"><i class="pe-7s-mail"></i>
               <span><?php echo display('setup_rules')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('dashboard/rules/index') ?>"><?php echo display('rules')?></a></li>
            </ul>
        </li>       
        <?php endif; ?>

         <li class="treeview <?php echo (($this->uri->segment(1)=="tax" || $this->uri->segment(2)=="user" ||  $this->uri->segment(2)=="language" || $this->uri->segment(2)=="backup_restore" || $this->uri->segment(2)=="role" || $this->uri->segment(2)=="setting" || $this->uri->segment(2)=="message" || $this->uri->segment(2)=="permission_setup")?"active":null) ?>">
            <a href="#">

                <i class="ti-settings"></i><span><?php echo display('setting')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="treeview <?php echo (($this->uri->segment(2)=="user")?"active":null) ?>">
                    <a href="#">
                        <span><?php echo display('user')?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('dashboard/user/form') ?>"><?php echo display('add_user')?></a></li>
                        <li><a href="<?php echo base_url('dashboard/user/index') ?>"><?php echo display('user_list')?></a></li> 
                    </ul>
                </li>
        
                <li class="treeview <?php echo (($this->uri->segment(2)=="role" ||$this->uri->segment(2)=="module_permission")?"active":null) ?>">
                    <a href="#">

                        <span><?php echo display('role_permission')?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php  if($this->session->userdata['isAdmin'] && $this->session->userdata['id'] == 1){ ?>
                            <li><a href="<?php echo base_url('dashboard/permission_setup') ?>"><?php echo display('permission_setup')?></a></li>
                        <?php  } ?>
                        <li><a href="<?php echo base_url('dashboard/role/create_system_role') ?>"><?php echo display('add_role')?></a></li>
                          <li><a href="<?php echo base_url('dashboard/role/role_list') ?>"><?php echo display('role_list')?></a></li>
                          <li><a href="<?php echo base_url('dashboard/role/user_access_role') ?>"><?php echo display('user_access_role')?></a></li>
                       
                    </ul>
                </li>

                 

                <li class="treeview <?php echo (($this->uri->segment(2)=="setting")?"active":null) ?>">
                    <a href="<?php echo base_url('dashboard/setting') ?>"> <span><?php echo display('application_setting')?></span> 
                    </a>
                </li>

                <li class="treeview <?php echo (($this->uri->segment(2)=="appsetting")?"active":null) ?>">
                    <a href="<?php echo base_url('dashboard/appsetting') ?>"> <span><?php echo display('mobile_app_setting')?></span> 
                    </a>
                </li>

                <li class="treeview <?php echo (($this->uri->segment(2)=="language")?"active":null) ?>">
                    <a href="<?php echo base_url('dashboard/language') ?>"> <span><?php echo display('language')?></span> 
                    </a>
                </li>

                <li class="treeview <?php echo (($this->uri->segment(2)=="Tax")?"active":null) ?>">
                    <a href="<?php echo base_url('tax/Tax/tax_setup') ?>"> <span><?php echo display('tax')?></span> 
                    </a>
                </li>

                <li class="treeview <?php echo (($this->uri->segment(2)=="backup_restore")?"active":null) ?>">
                    <a href="<?php echo base_url('dashboard/backup_restore/index') ?>"> <span><?php echo display('backup_and_restore') ?></span> 
                    </a>
                </li>
    
            </ul>



        <?php } ?>
        <!-- ends of admin area -->

       <?php if($this->session->userdata('isLogIn')): ?>
        <li class="treeview <?php echo (($this->uri->segment(2)=="message")?"active":null) ?>">
            <a href="#"><i class="pe-7s-mail"></i>
               <span><?php echo display('message')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('dashboard/message/new_message') ?>"><?php echo display('new')?></a></li>
                <li><a href="<?php echo base_url('dashboard/message/index') ?>"><?php echo display('inbox')?></a></li>
                <li><a href="<?php echo base_url('dashboard/message/sent') ?>"><?php echo display('sent')?></a></li> 
            </ul>
        </li>       
        <?php endif; ?>

        <?php if($this->session->userdata('isAdmin')): ?>
        <li class="treeview <?php if ($this->uri->segment(2) == ("module")){
                echo "active";
            } else {
                echo " ";
            }?>"><a href="<?php echo base_url('addon/module') ?>"><i class="fa fa-adn" aria-hidden="true"></i> <span><?php echo display('addon') ?></span> 
            </a>
        </li>
        <li class="treeview <?php if ($this->uri->segment('1') == ("autoupdate")){
                echo "active";
            } else {
                echo " ";
            }?>"><a href="<?php echo base_url('autoupdate/Autoupdate')?>"><i class="fa fa-cloud-download" aria-hidden="true"></i> <span><?php echo display('update_now'); ?></span>
            </a>
        </li>
        <?php endif; ?>

        </li>

      
       <?php } ?>
  
    </ul> 
</div> <!-- /.sidebar -->