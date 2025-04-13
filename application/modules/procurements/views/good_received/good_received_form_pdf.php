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
                    <center><h3 style="font-size:18px"><?php echo "Good Received"; ?></h3></center>

                    <table width="100%" class="table">
                          <thead>

                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('purchase_order') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo 'PO-'.sprintf('%05s', $good_received->purchase_order_id);;?></th>
                                
                              </tr>

                               <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo "Invoice Number" ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo $invoice_no;?></th>
                                
                              </tr>

                              

                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('vendor') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo $good_received->vendor_name; ?></th>
                                
                              </tr>

                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;border-bottom: solid 1px #000;"><?php echo display('date') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;font-weight: normal;"><?php echo $good_received->created_date; ?></th>
                                
                              </tr>

                          </thead>
                    </table>
                    <br>

                    <table width="100%" class="table">
                        <thead>
                              <tr style="border-top: solid 1px #000;">
                                  <th width="10%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">S/N </th>
                                  <th width="25%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Description </th>
                                  <th width="10%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Unit </th>
                                  <th width="10%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Quantity </th>
                                  <th width="20%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-bottom: solid 1px #000;">Price/Unit</th>
                                  <th width="10%" align="center" style="border-top: solid 1px #000;border-left: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;">Total</th>
                              </tr>
                          </thead>

                          <tbody>

                              <?php if (!empty($good_received_items)) {

                               $sl = 0; $total_bid = count($good_received_items);
                               foreach ($good_received_items as $row) { 

                                  $bg=$sl&1?"#FFFFFF":"#E7E0EE";
                                  $sl++;

                              ?>

                                  <tr>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $sl; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['description_material']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['unit_name']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['quantity']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['price_per_unit']; ?></td>
                                      <td align="center" style="border-left: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;"><?php echo $row['total']; ?></td>
                                  </tr>

                                <?php } ?> 
                              <?php } ?>

                          </tbody>

                          <tfoot>

                              <tr>
                                <td class="text-right" align="right" colspan="5" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><b><?php echo display('total') ?>:</b></td>
                                <td class="text-right" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;"><?php if(!empty($good_received->total)){echo $good_received->total;}?></td>
                              </tr>

                              <tr>
                                <td class="text-right" align="right" colspan="5" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><b><?php echo display('discount') ?>:</b></td>
                                <td class="text-right" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;"><?php if(!empty($good_received->discount)){echo $good_received->discount;}else{echo "0";}?></td>
                              </tr>

                              <tr>
                                <td class="text-right" align="right" colspan="5" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><b><?php echo "Grand ".display('total') ?>:</b></td>
                                <td class="text-right" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;"><?php if(!empty($good_received->grand_total)){echo $good_received->grand_total;}?></td>
                              </tr>

                          </tfoot>

                    </table>

                    <br>

                    <table width="100%" class="table">

                          <tbody>

                              <tr style="border-top: solid 1px #000;">
                                  <th align="left" style="">Received by: </th>
                              </tr>

                              <tr>
                                    
                                    <td align="left" style="">
                                      <p>Signature: <img style="width: 80px;height: 50px;" src="<?php if(!empty($good_received->received_by_signature)){echo $good_received->received_by_signature;}?>" alt="logo"></p>
                                      <p>Name: <?php if(!empty($good_received->received_by_name)){echo $good_received->received_by_name;}?></p>
                                      <p>Title: <?php if(!empty($good_received->received_by_title)){echo $good_received->received_by_title;}?></p>
                                    </td>

                                </tr>

                                <tr style="border-top: solid 1px #000;">
                                    <th align="left" style="">Verified by: </th>
                                </tr>

                                <tr>
                                    
                                    <td align="left" style="">
                                      <p>Signature:__________________________________</p>
                                      <p>Name:_______________________________________</p>
                                      <p>Title:______________________________________</p>
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