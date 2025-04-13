<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4></h4>
                </div>
            </div>
            <div id="printArea">
                <div class="panel-body">

                  <div class="row">

                      <div class="col-sm-4 col-xs-12">

                      <?php if(!empty($setting->logo)){?>

                      <img src="<?php echo "./".$setting->logo;?>" alt="logo">

                      <?php }else{ ?>

                      <img src="./assets/img/icons/mini-logo.png" alt="logo">

                      <?php }?>

                      </div>


                      <div class="col-sm-4 col-xs-12">
                        <span class="" >
                        <?php echo "Request Form";?>

                        </span><br>
                        <?php echo $setting->address;?>
                      </div>


                     <div class="col-sm-4 col-xs-12">
                        <date>
                           <?php echo display('date')?>: <?php
                          echo date('d-M-Y');
                          ?> 
                        </date>
                      </div>
                      <div class="col-sm-4 col-xs-12">
                        <date>
                           <?php echo display('cid')?>: <?php
                          echo $sl_no;
                          ?> 
                        </date>
                      </div>


                  </div>

                <div class="table-responsive">
                    <center><h3 style="font-size:18px"><?php echo strtoupper("Request Form"); ?></h3></center>

                    <table width="100%" class="table">
                          <thead>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('requesting_dept') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;"><?php echo $request->department_name; ?></th>
                                
                              </tr>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('requesting_person') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;"><?php echo $request->first_name.' '.$request->last_name; ?></th>
                                
                              </tr>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('reason_for_requesting') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;"><?php echo $request->requesting_reason; ?></th>
                                
                              </tr>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;border-bottom: solid 1px #000;"><?php echo "Expected time to have the goods"; ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;"><?php echo "From ".$request->expected_start_time." to ".$request->expected_end_time; ?></th>
                                
                              </tr>
                          </thead>
                    </table>
                    <br>
                    <table width="100%" class="table">
                          <thead>
                              <tr>
                                  <th width="100%" colspan="3" align="center" style="height:18px;border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;"></th>
                                
                              </tr>
                              <tr>
                                  <th width="60%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo "Description of materials/Goods/Service"; ?></th>
                                  <th width="20%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo "Unit"; ?></th>
                                  <th width="20%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;"><?php echo "Quantity"; ?></th>
                                
                              </tr>
                          </thead>
                          <tbody>

                               <?php if (!empty($request_items)) { ?>
                                  <?php $sl = 0; $total_request = count($request_items);?>
                                  <?php foreach ($request_items as $row) { 

                                    $bg=$sl&1?"#FFFFFF":"#E7E0EE";
                                    $sl++;
                                    ?>

                                    <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                       <td align="left" style="padding-left: 10px;border-left: solid 1px #000; border-top: solid 1px #000;<?php if($sl == $total_request){echo "border-bottom: solid 1px #000;";}?>"><?php echo $row['description_material']; ?></td>
                                       <td align="center" style="padding-left: 10px;border-left: solid 1px #000; border-top: solid 1px #000;<?php if($sl == $total_request){echo "border-bottom: solid 1px #000;";}?>"><?php echo $row['unit_name']; ?></td>
                                       <td align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;<?php if($sl == $total_request){echo "border-bottom: solid 1px #000;";}?>"><?php echo $row['quantity']; ?></td>
                                    </tr>

                                  <?php } ?> 
                              <?php } ?> 

                          </tbody>
                      </table>
                  </div>


                </div>
            </div>
        </div>
    </div>
</div>