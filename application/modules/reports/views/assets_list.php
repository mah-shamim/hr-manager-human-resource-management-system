<script type="text/javascript">
function printDiv() {
    var divName = "printArea";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    // document.body.style.marginTop="-45px";
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8"> <?php echo form_open('reports/Employee_controller/employee_assets',array('class' => 'form-inline', 'id' => 'validate'));?>
                            <label class="select"><?php echo display('search') ?>:</label>
                             <?php echo form_dropdown('employee_id', $dropdownemp, (!empty($id)?$id:" "), ' class="form-control"') ?> 
                            <button type="submit" class="btn btn-primary"><?php echo display('search') ?></button>
                        <?php echo form_close()?></div>
                            <div class="col-sm-2"><input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/></div>
                        </div>
                       

                    </div>
                </div>

            </div>
        </div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-body table-responsive" id="printArea">
                <table width="100%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                          <th><?php echo display('cid') ?></th>
                          <th><?php echo display('name')?></th>
                          <th><?php echo display('equipment_name') ?></th>
                          <th><?php echo display('type') ?></th>
                          <th><?php echo display('model') ?></th>
                          <th><?php echo display('serial_no') ?></th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($assets)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($assets as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                <td><?php echo $sl; ?></td>
                                <td><a href="<?php echo base_url("employee/Employees/cv/$row->employee_id");?>" ><?php echo $row->first_name.' '.$row->last_name; ?></a></td>
                                <td><?php echo $row->equipment_name; ?></td>
                                <td><?php echo $row->type_name; ?></td> 
                                <td><?php echo $row->model; ?></td>
                                <td><?php echo $row->serial_no; ?></td> 
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                 <?= $links ?>
            </div>
        </div>
    </div>
</div>
