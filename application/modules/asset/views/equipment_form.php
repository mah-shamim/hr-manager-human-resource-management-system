<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
 <center><h1><?php echo display('add_equipment') ?></h1></center>
                <?= form_open('asset/equipment_controller/equipment_form') ?>
                    <?php echo form_hidden('equipment_id', (!empty($equipmentinfo->equipment_id)?$equipmentinfo->equipment_id:null)) ?>
                    <div class="form-group row">
                        <label for="equipment_name" class="col-sm-3 col-form-label"><?php echo display('equipment_name') ?> *</label>
                        <div class="col-sm-9">
                                    <input name="equipment_name" class="form-control" type="text" placeholder="<?php echo display('equipment_name') ?>" id="equipment_name" value="<?php echo (!empty($equipmentinfo->equipment_name)?$equipmentinfo->equipment_name:null) ?>" required >
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="type" class="col-sm-3 col-form-label"><?php echo display('type_name') ?>*</label>
                        <div class="col-sm-9">
                             <?php echo form_dropdown('type_id',$type,(!empty($equipmentinfo->type_id)?$equipmentinfo->type_id:null),'class="form-control" required') ?>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="model" class="col-sm-3 col-form-label"><?php echo display('model') ?> *</label>
                        <div class="col-sm-9">
                                    <input name="model" class="form-control" type="text" placeholder="<?php echo display('model') ?>" id="model" value="<?php echo (!empty($equipmentinfo->model)?$equipmentinfo->model:null) ?>" required >
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="serial_no" class="col-sm-3 col-form-label"><?php echo display('serial_no') ?> *</label>
                        <div class="col-sm-9">
                                    <input name="serial_no" class="form-control" type="text" placeholder="<?php echo display('serial_no') ?>" id="serial_no" value="<?php echo (!empty($equipmentinfo->serial_no)?$equipmentinfo->serial_no:null) ?>" required >
                        </div>
                    </div> 
                     
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>

            </div>  
       
        <div class="col-md-8">
            <center><h1><?php echo display('equipment_list'); ?></h1></center>
              <table width="100%" id="datatable1" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                           <th><?php echo display('cid') ?></th>
                            <th><?php echo display('equipment_name') ?></th>
                            <th><?php echo display('type') ?></th>
                            <th><?php echo display('model') ?></th>
                            <th><?php echo display('serial_no') ?></th>
                           <th><?php echo display('action') ?></th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($equipment)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($equipment as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                   <td><?php echo $row->equipment_name; ?></td>
                                   <td><?php echo $row->type_name; ?></td> 
                                    <td><?php echo $row->model; ?></td>
                                   <td><?php echo $row->serial_no; ?></td>                   
                                   <td class="center">
                                    <?php if($this->permission->method('equipment','update')->access()): ?>
                                        <a href="<?php echo base_url("asset/Equipment_controller/equipment_form/$row->equipment_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->method('equipment','delete')->access()): ?>  
                                        <a href="<?php echo base_url("asset/Equipment_controller/delete_equipment/$row->equipment_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
                                         <?php endif; ?> 
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>
        </div>
        </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable1').DataTable({ 
        responsive: true, 
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[ 10, 20,30, 100, 150, 200, 500, -1], [ 10, 20,30, 100, 150, 200, 500, "All"]], 
        buttons: [   
            {extend: 'csv', title: 'Equipment LIst', className: 'btn-sm'}, 
            {extend: 'excel', title: 'Equipment LIst', className: 'btn-sm', title: 'exportTitle'}, 
            {extend: 'pdf', title: 'Equipment LIst', className: 'btn-sm'}, 
            {extend: 'print', className: 'btn-sm'} 
        ] 
    });
          });
</script>