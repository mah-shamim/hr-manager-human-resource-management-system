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
                        <?php echo "Quotation Form";?>

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
                    <center><h3 style="font-size:18px"><?php echo strtoupper("Quotation Form"); ?></h3></center>

                    <table width="100%" class="table">
                          <thead>
                              <tr>
                                 <th align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('name_of_company') ?>:</th>
                                  <th align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo $quotation->name_of_company; ?></th>
                                
                              </tr>
                              <tr>
                                 <th align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('address') ?>:</th>
                                  <th align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo $quotation->address; ?></th>
                                
                              </tr>
                              <tr>
                                 <th align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;border-bottom: solid 1px #000;"><?php echo display('pin_or_equivalent') ?>:</th>
                                  <th align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;font-weight: normal;"><?php echo $quotation->pin_or_equivalent; ?></th>
                                
                              </tr>

                          </thead>
                    </table>

                    <p>Kindly provide a quotation for the following goods:</p>

                    <table width="100%" class="table">
                        <thead>
                              <tr>
                                  <th width="65%" colspan="5" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-bottom: solid 1px #000;"><?php echo "Completed by HOR"; ?></th>
                                  <th width="35%" colspan="3" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;background-color: #DCDCDC;"><?php echo "To be Completed by supplier"; ?></th>
                                
                              </tr>
                              <tr style="border-top: solid 1px #000;">
                                  <th width="30%" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;">Description</th>
                                  <th width="10%" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;">Unit</th>
                                  <th width="10%" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;">Quantity</th>
                                  <th width="8%" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;">Price/Unit</th>
                                  <th width="7%" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;">Total</th>
                                  <th width="12%" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;background-color: #DCDCDC;">Unit Price</th>
                                  <th width="12%" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;background-color: #DCDCDC;">Discount</th>
                                  <th width="11%" align="center" style="border-left: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;background-color: #DCDCDC;">Net</th>
                              </tr>
                          </thead>

                          <tbody>

                              <?php if (!empty($quotation_items)) {

                               $sl = 0; $total_quote = count($quotation_items);
                               foreach ($quotation_items as $row) { 

                                  $bg=$sl&1?"#FFFFFF":"#E7E0EE";
                                  $sl++;

                              ?>

                                  <tr>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['description_material']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['unit_name']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['quantity']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['price_per_unit']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['total']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;background-color: #DCDCDC;"></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;background-color: #DCDCDC;"></td>
                                      <td align="center" style="border-left: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;background-color: #DCDCDC;"></td>
                                  </tr>

                                <?php } ?> 
                              <?php } ?>

                          </tbody>
                    </table>

                    <br>
                    <br>

                    <table width="100%" class="table">
                          <thead>
                              <tr style="background-color: #DCDCDC;">
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;">For HOR:</th>
                                  <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;padding-left: 10px;">For Supplier: </th>
                                
                              </tr>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;">Expected date of delivery: <?php echo $quotation->expected_date_delivery;?></th>
                                  <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;padding-left: 10px;">Expected date of delivery: </th>
                                
                              </tr>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;">Place of delivery: <?php echo $quotation->place_of_delivery;?></th>
                                  <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;padding-left: 10px;">Quotation guaranteed for (No days/mths): </th>
                                
                              </tr>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;vertical-align:bottom;"><img style="width: 250px;height: 100px;" src="<?php echo $quotation->signature_and_stamp;?>" alt="logo"><br>Signature and stamp:</th>
                                  <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;padding-left: 10px;vertical-align:bottom;">Signature and stamp: </th>
                                
                              </tr>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;border-bottom: solid 1px #000;">Date: <?php echo $quotation->create_date;?></th>
                                  <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;padding-left: 10px;border-bottom: solid 1px #000;">Date: </th>
                                
                              </tr>

                          </thead>
                    </table>

                  </div>


                </div>
            </div>
        </div>
    </div>
</div>