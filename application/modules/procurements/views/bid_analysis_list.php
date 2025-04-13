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
                <table width="100%" class="datatable table table-striped table-bordered table-hover bid-analys">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('bid_no') ?></th>
                            <th><?php echo display('sba_no') ?></th>
                            <th><?php echo display('location') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bid_analysis)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($bid_analysis as $bid_analys) { 
                                ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo 'BID-'.sprintf('%05s', $bid_analys->bid_analysis_form_id ); ?></td>
                                    <td><?php echo $bid_analys->sba_no; ?></td>  
                                    <td><?php echo $bid_analys->location; ?></td>
                                    <td><?php echo $bid_analys->create_date; ?></td>

                                     <td class="center">
                                  
                                    <?php if($this->permission->check_label('bid_analysis_form')->update()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_bid_analysis/bid_analys_update/$bid_analys->bid_analysis_form_id  ") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->check_label('bid_analysis_form')->delete()->access()): ?>
                                        <a href="<?php echo base_url("procurements/procurement_bid_analysis/delete_bid_analys/$bid_analys->bid_analysis_form_id  ") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
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
 
 