<div class="row">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-header py-2">
            <div class="d-flex justify-content-between align-items-center">
               <div>
                  <nav aria-label="breadcrumb" class="order-sm-last p-0">
                     <ol class="breadcrumb d-inline-flex font-weight-600 fs-17 bg-white mb-0 float-sm-left p-0">
                        <li class="breadcrumb-item"><a href="#"><?php echo $moduleTitle;?></a></li>
                        <li class="breadcrumb-item active"><?php echo $title;?></li>
                     </ol>
                  </nav>
               </div>
               <div class="text-right">
                 
               </div>
            </div>
         </div>
         <div class="card-body">
            <?php echo form_open('accounts/accounts/predefined_accounts')?>
               <?php if($fieldNames){
                     foreach($fieldNames as $fields){?>
                     <?php if($fields != 'id'){?>
            <div class="row form-group"> 
            <label for="head_code" class="font-weight-600 col-sm-2"> <?php echo $fields ;?><i class="text-danger">*</i></label>
           
            <div class="col-sm-3">
            <?php echo  form_dropdown($fields, $allheads, ($filedvalues?$filedvalues->$fields:''), 'class="form-control select2" id="'.$fields.'"') ?>
            </div>
            </div>
            <?php }}}?>
            <div class="row form-group"> 
           
            <div class="col-sm-5 text-right">
               <?php if($this->permission->check_label('predefined_accounts')->update()->access()) { ?>
                 <button type="submit" class="btn btn-success"><?php echo display('submit');?></button>
               <?php } ?>
               
            </div>
             <div class="col-sm-7">
            </div>
            </div>
            <?php echo form_close()?>
         </div>

           
      </div>
   </div>
</div>