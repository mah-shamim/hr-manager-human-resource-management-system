
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">

            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">

                <div class="col-sm-12">
                    <table width="100%" id="datatable1" class="datatable table table-striped table-bordered table-hover committee-list">
                        <thead>
                            <tr>
                               <th><?php echo display('cid') ?></th>
                               <th><?php echo display('committee') ?></th>
                               <th><?php echo display('signature') ?></th>
                               <th><?php echo display('action') ?></th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($committee_lists)) { ?>
                                <?php $sl = 1; ?>
                                <?php foreach ($committee_lists as $row) { ?>
                                   <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    
                                       <td><?php echo $sl; ?></td>

                                       <td><?php echo $row->name; ?></td>

                                       <td class="signimage"><img src="<?php echo base_url().$row->sign_image; ?>" alt="logo"></td>
                                                                   
                                       <td class="center">
                                      
                                        <?php if($this->permission->check_label('committee_list')->update()->access()): ?>
                                            <a href="<?php echo base_url("procurements/procurement_committee/update_committee/$row->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                            <?php endif; ?>
                                        
                                        <?php if($this->permission->check_label('committee_list')->delete()->access()): ?>  
                                            <a href="<?php echo base_url("procurements/procurement_committee/delete_committee_list/$row->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
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
    </div>
</div>

