<!-- date between search -->
<div class="row">
     <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body"> 
                <div class="col-sm-10">
                <?php echo form_open('', array('class' => 'form-inline', 'method' => 'get')) ?>
                <?php

                $today = date('Y-m-d');
                ?>

                <input type ="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id;?>">

                <div class="form-group form-group-new">
                    <label class="" for="from_date"><?php echo "Start Date"; ?></label>
                    <input type="text" name="from_date" class="form-control monthYear" id="from_date" value="" placeholder="<?php echo "Start Date"; ?>" autocomplete="off">
                </div> 

                <div class="form-group form-group-new">
                    <label class="" for="to_date"><?php echo "End Date"; ?></label>
                    <input type="text" name="to_date" class="form-control monthYear" id="to_date" placeholder="<?php echo "End Date"; ?>" value="" autocomplete="off">
                </div>  

                <input type="hidden" id="base_url" value="<?php echo base_url();?>" name="">
                <input type="hidden" id="currency" value="BDT" name="">
                <input type ="hidden" name="csrf_test_name" id="CSRF_TOKEN" value="<?php echo $this->security->get_csrf_hash();?>">

                <button type="button" id="btn-filter" class="btn btn-success" name="search"><?php echo "Find"; ?></button>

                <?php echo form_close() ?>
            </div>
          
  
        </div>
    </div>
    </div>
</div>

<!-- End date between search -->

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

             <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>

            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="IndvEmpPointList">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('attendence_point') ?></th>
                            <th><?php echo display('collaborative_point') ?></th>
                            <th><?php echo display('management_point') ?></th>
                            <th><?php echo display('total')." ".display('point') ?></th>
                            <th><?php echo display('date') ?></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                     <tfoot>

                         <tr>
                            <th colspan="5" class="text-right">Total Points:</th>

                           <th class="text-center" id="total_points"></th>
                        </tr>
                    </tfoot>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>

        <input type="hidden" id="total_emp_points" value="<?php echo $total_emp_points;?>" name="">

    </div>
</div>
 
 <!-- custom js for EmpPointList dataTable -->
<script src="<?php echo MOD_URL.'rewardpoint/assets/js/emp-pointcustom.js'; ?>" type="text/javascript"></script>  
 