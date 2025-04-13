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


                      <div class="col-sm-4 col-xs-12" style="border-bottom: 1px solid black;padding-bottom: 5px;">
                        <p style="text-align: center;font-weight: bold;font-size: 18px;" class="" >
                        <?php echo  $setting->title;?><br><?php echo $setting->address;?>
                        </p>
                      </div>


                  </div>

                <div class="table-responsive">
                    <center><h3 style="font-size:18px"><?php echo strtoupper("Summary of Bid Analysis"); ?></h3></center>

                    <table width="100%" class="table">
                          <thead>
                              <tr>
                                 <th align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('date') ?>:</th>
                                  <th align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo $bid_analysis->create_date;?></th>
                                
                              </tr>
                              <tr>
                                 <th align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('sba_no') ?>:</th>
                                  <th align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo $bid_analysis->sba_no; ?></th>
                                
                              </tr>
                              <tr>
                                 <th align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;border-bottom: solid 1px #000;"><?php echo display('location') ?>:</th>
                                  <th align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;font-weight: normal;"><?php echo $bid_analysis->location; ?></th>
                                
                              </tr>

                          </thead>
                    </table>
                    <br>

                    <table width="100%" class="table">
                        <thead>
                              <tr style="border-top: solid 1px #000;">
                                  <th width="10%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">S/N </th>
                                  <th width="15%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Company </th>
                                  <th width="25%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Description </th>
                                  <th width="10%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Unit </th>
                                  <th width="10%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Quantity </th>
                                  <th width="20%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Price/Unit</th>
                                  <th width="10%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;">Total</th>
                              </tr>
                          </thead>

                          <tbody>

                              <?php if (!empty($bid_analysis_items)) {

                               $sl = 0; $total_bid = count($bid_analysis_items);
                               foreach ($bid_analysis_items as $row) { 

                                  $bg=$sl&1?"#FFFFFF":"#E7E0EE";
                                  $sl++;

                              ?>

                                  <tr>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $sl; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['company']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['description_material']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['unit_name']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['quantity']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['price_per_unit']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['total']; ?></td>
                                  </tr>

                                <?php } ?> 
                              <?php } ?>

                          </tbody>
                    </table>

                    <br>

                    <h3 style="font-size:18px"><?php echo "Procurement Committee Lists"; ?></h3>

                    <table width="100%" class="table">
                        <thead>
                            <tr style="border-top: solid 1px #000;">
                                <th width="10%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">S/N </th>
                                <th width="25%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Namae </th>
                                <th width="25%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Date </th>
                                <th width="45%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;">Signature </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($pdf_commitee_lists)) {

                              $sl_commmitee = 0; $total_committee = count($pdf_commitee_lists);

                               foreach ($pdf_commitee_lists as $row_commitee) { 

                                  $bg=$sl_commmitee&1?"#FFFFFF":"#E7E0EE";
                                  $sl_commmitee++;
                              ?>
                                <tr>
                                  
                                    <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $sl_commmitee; ?></td>
                                    <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row_commitee['name']; ?></td>
                                    <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row_commitee['date']; ?></td>
                                    <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;"><img style="height: 50px;" src="<?php echo $row_commitee['signature'];?>" alt="logo"></td>

                                </tr>

                              <?php } ?>
                            <?php } ?>

                        </tbody>

                    </table>

                    <br>

                    <table width="100%" class="table">
                          <thead>
                              <tr style="border-top: solid 1px #000;">
                                  <th width="33%" align="left" style="">Prepare: </th>
                                  <th width="33%" align="left" style="">Approved By: </th>
                                  <th width="34%" align="left" style="">Authorized by: </th>
                              </tr>
                          </thead>

                          <tbody>
                              <tr>
                                    
                                    <td align="left" style="">
                                      <p>Name:__________________</p>
                                      <p>Signature:_________________</p>
                                      <p>Date:__________________</p>
                                    </td>
                                    <td align="left" style="">
                                      <p>Name:__________________</p>
                                      <p>Signature:_________________</p>
                                      <p>Date:__________________</p>
                                    </td>
                                    <td align="left" style="">
                                      <p>Name:__________________</p>
                                      <p>Signature:_________________</p>
                                      <p>Date:__________________</p>
                                    </td>

                                </tr>
                          </tbody>
                    </table>

                  </div>


                </div>
            </div>
        </div>
    </div>
</div>