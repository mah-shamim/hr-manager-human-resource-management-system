 <style type="text/css">
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0.5em;
    display: inline-block;
    width: 100px;
}
</style>
 <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag">
                
                <div class="panel-body">
                  <div class="col-sm-6 col-md-5">
                      <center><h1><?php echo display('assign_asset') ?></h1></center>
                 <?= form_open_multipart('asset/equipment_maping/maping_form','id="asset_form"') ?>
                    <div class="row">
                           <label for="type" class="col-sm-3 col-form-label"><?php echo display('employee') ?>*</label>
                        <div class="col-sm-6">
                             <?php echo form_dropdown('employee_id',$employee,$employee->id,'class="form-control" required') ?>
                        </div>
                               
                              </div>
                              <br>
                              

                          <div class="row">
                                 <div class="col-sm-12">
                            
                                    <table class="table table-bordered table-hover"  id="equipment_table">
                              <thead>
                                  <tr>
                                     <th><?php echo display('equipment')?></th> 
                                     <th><?php echo display('date')?></th> 
                                     <th><?php echo display('action')?></th> 
                                  </tr>
                              </thead>
                                <tbody id="equipmnet_info">
                                    <tr>
                                       
                                        <td>
                                         <input type="text" name="equipment[]" class="form-control equipment" required="" onkeypress="asset_autocomplete(1);" id="equipment_id_1"/><input type="hidden" class="autocomplete_hidden_value" name="equipment_id[]" id="Hiddenid"/>
                                          <input type="hidden" class="sl" value="1">
                                        </td>
                                        <td>  
                                         
                                          <input type="text" name="dates[]" class="form-control datepicker" value="<?php echo date('d-m-Y')?>">
                                      
                                        </td>
                                        <td>  
                                          <button type="button"name="sdfsd"  class="btn btn-info"  onclick="addasset('equipmnet_info');" ><i class="fa fa-plus"></i></button>
                                     
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                                
                            </div>
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                   
    <?php echo form_close() ?>
                </div>
                <div class="col-sm-6 col-md-7">
                  <center><h1><?php echo display('assign_list'); ?></h1></center>
                    <table width="100%" id="datatable1" class="table table-striped table-bordered table-hover">

                    <thead>
                        <tr>
                           <th><?php echo display('cid') ?></th>
                           <th><?php echo display('employee_name') ?></th>
                            <th><?php echo display('equipment_name') ?></th>
                           <th><?php echo display('action') ?></th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($mappinglist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($mappinglist as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php 
                                      $employee =$this->db->select('first_name,last_name')->from('employee_history')->where('employee_id',$row->employee_id)->get()->row();
                                      echo $employee->first_name.' '.$employee->last_name;
                                     ?></td> 
                                   <td><?php
                             $eqments =$this->db->select('a.*,b.equipment_name')->from('employee_equipment a')->join('equipment b','b.equipment_id=a.equipment_id','left')->where('a.employee_id',$row->employee_id)->where('a.return_date','0000-00-00')->get()->result_array();
                              $eqnamess= '';
                              foreach ($eqments as $eq) {
                               $eqnamess .= $eq['equipment_name'].',';
                              }
                                     if($eqnamess !=''){
                                    echo $eqnamess;}else{
                                      echo 'Returned All Equipments';
                                    } ?></td>              
                                   <td class="center">
                                    <?php if($eqnamess !=''){?>
                                    <?php if($this->permission->method('asset_assignment','update')->access()): ?>
                                        <a href="<?php echo base_url("asset/Equipment_maping/maping_update/$row->employee_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->method('asset_assignment','delete')->access()): ?>  
                                        <a href="<?php echo base_url("asset/Equipment_maping/delete_maping/$row->employee_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
                                         <?php endif; ?> 
                                       <?php }?>
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                </div>  
            </div>
          </div>
        </div>
    </div>

<script type="text/javascript">
   
///###############
  var count = $('#equipment_table tr').length;
    var limits = 500;

    function addasset(divName){
  
        if (count == limits)  {
            alert("<?php echo display('you_have_reached_the_limit_of_adding')?> " + count + "<?php echo display('inputs')?> ");
        }
        else{
            var newdiv = document.createElement('tr');
            var tabin="equipment_id_"+count;
             newdiv = document.createElement("tr");
             newdiv.innerHTML ='<td><input type="text" name="equipment[]" class="form-control equipment" required="" onkeypress="asset_autocomplete('+ count +');" id="equipment_id_'+count+'"/><input type="hidden" class="autocomplete_hidden_value" name="equipment_id[]" id="Hiddenid"/><input type="hidden" class="sl" value="'+ count +'"></td><td><input type="text" name="dates[]" class="form-control datepicker" value=""></div></td><td><button style="text-align: right;" class="btn btn-danger red" type="button" value="<?php echo display("delete")?>" onclick="deleteRow(this)"><i class="fa fa-close"></i></button></td>';
             document.getElementById(divName).appendChild(newdiv);
             document.getElementById(tabin).focus();
            count++;
            $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });
        }
    }


//##########
      function deleteRow(e) {
        var t = $("#equipment_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
    }

</script>
<script type="text/javascript">
  function asset_autocomplete(sl) {

    // Auto complete
    var options = {
        minLength: 0,
          type: "POST",
        source: function( request, response ) {
            var equipment = $('#equipment_id_'+sl).val();
            var csrf_test_name = $('[name="csrf_test_name"]').val();
        $.ajax( {
          url: "<?php echo site_url('asset/Equipment_maping/asset_search')?>",
          method: 'post',
          dataType: "json",
          data: {
            term: request.term,
            equipment:equipment,
            csrf_test_name: csrf_test_name
          },
          success: function( data ) {
            response(data);
          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);
           return false;
       },
            select: function( event, ui ) {
            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value); 
            
            var sl = $(this).parent().parent().find(".sl").val(); 

            $(this).unbind("change");
            return false;
       }
   }
    
   $('body').on('keydown.autocomplete', '.equipment', function() {
       $(this).autocomplete(options);
   });

}

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable1').DataTable({ 
        responsive: true, 
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[ 10, 20,30, 100, 150, 200, 500, -1], [ 10, 20,30, 100, 150, 200, 500, "All"]], 
        buttons: [  {extend: 'csv', title: 'Equipment LIst', className: 'btn-sm'}, 
            {extend: 'excel', title: 'Equipment LIst', className: 'btn-sm', title: 'exportTitle'}, 
            {extend: 'pdf', title: 'Mapping List', className: 'btn-sm'}
        ] 
    });
          });
</script>