<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('requesting_person') ?></th>
                            <th><?php echo display('requesting_dept') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('quote').' '.display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($requests)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($requests as $request) { 
                                ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $request->first_name.' '.$request->last_name; ?></td>  
                                    <td><?php echo $request->department_name; ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($request->created_at)); ?></td>

                                    <td><p class="btn btn-xs <?php if($request->quoted){echo "btn-success";}else{echo "btn-danger";} ?>"><?php if($request->quoted){echo "Converted";}else{echo "Not Converted";} ?></p></td>

                                     <td class="center">
                                  
                                    <?php if($this->permission->check_label('request_form')->update()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_request/request_form/$request->request_form_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>

                                    <?php if($this->permission->check_label('request_approval')->create()->access()): ?>
                                        <?php if(!$request->is_approve): ?>
                                            <a title="Approve Request" href="<?php echo base_url("procurements/procurement_request/request_approval/$request->request_form_id") ?>" class="btn btn-xs btn-info"><i class="fa fa-check-circle"></i></a>
                                             <?php endif; ?>
                                    <?php endif; ?>   

                                    <?php if($this->permission->check_label('quotation')->create()->access()): ?>
                                        <?php if($request->is_approve && !$request->quoted): ?>
                                            <a title="Convert to quote" href="<?php echo base_url("procurements/procurement_quotation/quotation_form/$request->request_form_id"); ?>" class="btn btn-xs btn-primary"><i class="fa fa-book"></i></a>
                                             <?php endif; ?>
                                    <?php endif; ?>  
                                    
                                    <?php if($this->permission->check_label('request_form')->delete()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_request/delete_request/$request->request_form_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
                                         <?php endif; ?> 
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
 
 