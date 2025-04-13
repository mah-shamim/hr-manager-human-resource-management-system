
<?php  $timezone = $this->db->select('timezone')->from('setting')->get()->row();
       date_default_timezone_set($timezone->timezone); 

       $this->session->set_userdata('attendance_time',date("Y-m-d H:i:s"));


?>
          
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
                <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                        <h4><?php echo display('attendance') ?></h4>
                    </div>
                    <div class="mr-25">

                      <?php if($this->permission->method('attendance','create')->access()): ?>
                      <?php  if($this->session->userdata('isAdmin')==1 || $this->session->userdata('supervisor')==1){?> 
                        <button type="button" class="btn btn-success btn-md" data-target="#add1" data-toggle="modal"  >
                        <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo display('bulk_checkin')?></button> 
                      <?php } ?>
                      <?php endif; ?> 

                      <?php if($this->permission->method('attendance','create')->access()): ?>
                      <?php  if($this->session->userdata('isAdmin')==1 || $this->session->userdata('supervisor')==1){?> 
                        <button type="button" class="btn btn-primary btn-md" data-target="#exportattn" data-toggle="modal"  >
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> <?php echo display('bulk_export')?></button> 
                      <?php } ?>
                      <?php endif; ?>


                    </div>

                </div>
                <div class="panel-body">

                  <?php if(empty($editdata)){ ?>

                    <div class="row attendance">
                        <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#checkin"><?php echo display('check_in') ?></a></li>
                        <li><a data-toggle="tab" href="#checkout"><?php echo display('check_out') ?></a></li>
                      </ul>
                    </div>

                  <?php }else{ ?>

                     <div class="row attendance">
                        <ul class="nav nav-tabs">
                        <li class="<?php if($editdata->status == "in"){echo "active";}?>"><a><?php echo display('check_in') ?></a></li>
                        <li class="<?php if($editdata->status == "out"){echo "active";}?>"><a><?php echo display('check_out') ?></a></li>
                      </ul>
                    </div>


                  <?php } ?>

                    <div class="tab-content">

                        <div id="checkin" class="tab-pane fade in active">

                            <?php echo  form_open('attendance/Home/create_atten') ?>
                                <div class="form-group row">
                                  <input type="hidden" name="attendanc_id" value="<?php echo (!empty($editdata)?$editdata->atten_his_id:'')?>">
                                    <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('emp_id') ?> *</label>
                                    <div class="col-sm-4">
                               <?php  if($this->session->userdata('isAdmin')==1 || $this->session->userdata('supervisor')==1){?> 
                                      <?php echo form_dropdown('employee_id',$dropdownatn,(!empty($editdata)?$editdata->uid:''),'class="form-control codeigniterselect" id="employee_id"') ?>
                                      <?php }else{?> 
                                        <input type="text" name="employee_name" class="form-control" value="<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>" readonly>
                                         <input type="hidden" name="employee_id" id="employee_id" class="form-control" value="<?php echo $this->session->userdata('employee_id');?>">
                                       <?php }?>
                                       
                                    </div>
                                </div> 
                                <div class="form-group row">
                                  <label for="intime" class="col-sm-3 col-form-label"><?php echo display('time')?>*</label>
                                  <div class="col-sm-4">

                                   <?php if($this->session->userdata['employee_id'] && !$this->session->userdata['supervisor']){?>

                                     <input type="text" name="intime" id="" readonly placeholder="<?php echo date("Y-m-d H:i:s")?>" class="form-control" value="<?php if(!empty($editdata)){echo $editdata->time;}else{echo date("Y-m-d H:i:s");}?>">

                                   <?php }else{?>

                                     <input type="text" name="intime" id="" placeholder="<?php echo date("Y-m-d h:ia")?>" class="form-control datetimepicker" value="<?php echo (!empty($editdata)?$editdata->time:'')?>">

                                    <?php } ?>
                                    
                                  </div>

                                </div>

                                 <!--The d-none class is used to hide the out-time, as now only intime field is using for attendance time-->
                                 <div class="form-group row d-none">
                                  <label for="out_time" class="col-sm-3 col-form-label"><?php echo display('out_time')?>*</label>
                                  <div class="col-sm-4">
                                    <input type="text" name="out_time" id="" placeholder="<?php echo date("Y-m-d h:ia")?>" class="form-control datetimepicker" value="<?php echo (!empty($editdata)?$editdata->time:'')?>">
                                  </div>

                                </div>

                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label"></label>
                                  <div class="col-sm-4 text-right">

                                    <?php if(empty($editdata)){ ?>

                                      <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('check_in') ?></button>

                                    <?php }else{ ?>

                                      <button type="submit" class="btn btn-success w-md m-b-5"><?php if($editdata->status == "in"){ echo display('check_in');}else{echo display('check_out');} ?></button>
                                      
                                      <?php } ?>

                                  </div>

                                </div>
                            <?php echo form_close() ?>

                        </div>

                        <div id="checkout" class="tab-pane fade">

                            <?php echo  form_open('attendance/Home/create_atten') ?>
                                <div class="form-group row">
                                  <input type="hidden" name="attendanc_id" value="<?php echo (!empty($editdata)?$editdata->atten_his_id:'')?>">
                                    <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('emp_id') ?> *</label>
                                    <div class="col-sm-4">
                               <?php  if($this->session->userdata('isAdmin')==1 || $this->session->userdata('supervisor')==1){?> 
                                      <?php echo form_dropdown('employee_id',$dropdownatn,(!empty($editdata)?$editdata->uid:''),'class="form-control codeigniterselect" id="employee_id"') ?>
                                      <?php }else{?> 
                                        <input type="text" name="employee_name" class="form-control" value="<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>" readonly>
                                         <input type="hidden" name="employee_id" id="employee_id" class="form-control" value="<?php echo $this->session->userdata('employee_id');?>">
                                       <?php }?>
                                       
                                    </div>
                                </div> 
                                <div class="form-group row">
                                  <label for="intime" class="col-sm-3 col-form-label"><?php echo display('time')?>*</label>
                                  <div class="col-sm-4">

                                    <?php if($this->session->userdata['employee_id'] && !$this->session->userdata['supervisor']){?>

                                     <input type="text" name="intime" id="" readonly placeholder="<?php echo date("Y-m-d H:i:s")?>" class="form-control" value="<?php if(!empty($editdata)){echo $editdata->time;}else{echo date("Y-m-d H:i:s");}?>">

                                   <?php }else{?>

                                    <input type="text" name="intime" id="" placeholder="<?php echo date("Y-m-d h:ia")?>" class="form-control datetimepicker" value="<?php echo (!empty($editdata)?$editdata->time:'')?>">

                                    <?php } ?>

                                  </div>

                                </div>

                                <!--The d-none class is used to hide the out-time, as now only intime field is using for attendance time-->
                                 <div class="form-group row d-none">
                                  <label for="out_time" class="col-sm-3 col-form-label"><?php echo display('out_time')?>*</label>
                                  <div class="col-sm-4">
                                    <input type="text" name="out_time" id="" placeholder="<?php echo date("Y-m-d h:ia")?>" class="form-control datetimepicker" value="<?php echo (!empty($editdata)?$editdata->time:'')?>">
                                  </div>

                                </div>

                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label"></label>
                                  <div class="col-sm-4 text-right">
                                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('check_out') ?></button>
                                  </div>

                                </div>
                            <?php echo form_close() ?>

                        </div>

                      </div>
                          
                    </div>         

                </div>  
            </div>
        </div>
 
 
 <!--  signout modal start --> 
 <div id="signout" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><center> <?php echo display('checkout')?></center></strong>
            </div>
            <div class="modal-body">
           
   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
               
                <div class="panel-body">
                 <?php echo  form_open('attendance/Home/checkout') ?>

                    <input name="att_id" id="att_id" type="hidden" value="">
                 
                        <div class="form-group row">
                            
                            <div class="col-sm-9">
                                <input name="sign_in" class=" form-control" type="hidden"  value=""  id="sign_in" readonly="readonly" >
                            </div>
                        </div>
                     
  
                       <center> <span id="clock"></span></center>
             
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary"><?php echo display('confirm_clock')?></button>
                        </div>

                    <?php echo form_close() ?>


                </div>  
            </div>
        </div>
    </div>
             
    </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>

<div id="add1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_attendance')?></strong>
            </div>
            <div class="modal-body">
           <div class="container" >    
             <br>
             
             <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success') == TRUE): ?>
                <div class="form-control alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <h3><?php echo display('download_sample_file')?> <a href="<?php echo base_url('assets/data/bulkdata/bulkattendancedata.xlsx') ?>" class="btn btn-success"><i class="fa fa-download"></i> <?php echo display('download_sample_file')?></a></h3>
              
                       <?php echo form_open_multipart('attendance/Home/importcsv',array('class' => 'form-vertical', 'id' => 'validate','name' => 'insert_attendance'))?>
                    <input type="file" name="upload_csv_file" id="userfile" ><br><br>
                    <p><b>Note:</b> <span class="text-danger">Attendance file data format must be as given sample file.</span> </p><br>
                    <input type="submit" name="submit" value="UPLOAD" class="btn btn-success">
       <?php echo form_close()?>
           
        
            
        </div>     

    </div>

</div>
</div>
</div>

<div id="exportattn" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong><?php echo display('export_attendance')?></strong>
      </div>
      <div class="modal-body">
        <div class="">

          <?php if (isset($error)): ?>
          <div class="alert alert-error"><?php echo $error; ?></div>
          <?php endif; ?>
          <?php if ($this->session->flashdata('success') == TRUE): ?>
          <div class="form-control alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
          <?php endif; ?>

          <?php echo form_open_multipart('attendance/Home/exportattn',array('class' => '', 'id' => 'validate','name' => 'export_attendance'))?>
          <div class="row m-0">
            <div class="col-lg-6">
              <label for="start_date"><?php echo display('start_date')?> :</label>
                <input type="text" name="start_date"  value="<?php echo (!empty($start)?$start:date('Y-m-01'))  ?>" class="datepicker form-control" />
            </div>
            <div class="col-lg-6">
              <label for="end_date"><?php echo display('end_date')?> :</label>
                <input type="text" class="datepicker form-control" name="end_date" value="<?php echo (!empty($end)?$end:date('Y-m-05')) ?>"  />
            </div>
            <div class="col-lg-12">
              <input type="submit" id="exportmodal" name="submit" value="Download" class="btn btn-primary mt-20">
            </div>
          </div>

            
          <?php echo form_close()?> 
        </div>     

      </div>

    </div>
  </div>
</div>
<!-- Start Modal -->

 