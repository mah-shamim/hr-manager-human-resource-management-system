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
                        <?php echo $setting->title;?>

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
                  </div>

                <div class="table-responsive">
                    <center><h3 style="font-size:18px"><?php echo display('equipment_list'); ?></h3></center>
                    <table width="100%" id="datatable1" class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                 <th width="10%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo display('cid') ?></th>
                                  <th width="30%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo display('equipment_name') ?></th>
                                  <th width="20%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo display('type') ?></th>
                                  <th width="20%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo display('model') ?></th>
                                  <th width="10%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo display('serial_no') ?></th>
                                  <th width="10%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;"><?php echo display('price') ?></th>
                                
                              </tr>
                          </thead>
                          <tbody>
                              <?php if (!empty($equipment)) { ?>
                                  <?php $sl = 1; ?>
                                  <?php foreach ($equipment as $row) { 

                                    $bg=$sl&1?"#FFFFFF":"#E7E0EE";
                                    
                                    ?>
                                      <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                         <td align="center" bgcolor="<?php echo $bg;?>" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo $sl; ?></td>
                                         <td align="left" bgcolor="<?php echo $bg;?>" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo $row->equipment_name; ?></td>
                                         <td align="left" bgcolor="<?php echo $bg;?>" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo $row->type_name; ?></td> 
                                         <td align="left" bgcolor="<?php echo $bg;?>" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo $row->model; ?></td>
                                         <td align="center" bgcolor="<?php echo $bg;?>" style="border-left: solid 1px #000; border-top: solid 1px #000;"><?php echo $row->serial_no; ?></td>
                                         <td align="center" bgcolor="<?php echo $bg;?>" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;"><?php echo $row->price; ?></td>
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
</div>