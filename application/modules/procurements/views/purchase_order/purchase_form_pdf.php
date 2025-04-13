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
                    <center><h3 style="font-size:18px"><?php echo "Purchase Order"; ?></h3></center>

                    <table width="100%" class="table">
                          <thead>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('purchase_order') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo $po_no;?></th>
                                
                              </tr>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('date') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo $purchase_order->created_date;?></th>
                                
                              </tr>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('vendor') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo $purchase_order->vendor_name; ?></th>
                                
                              </tr>
                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;"><?php echo display('location') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;font-weight: normal;"><?php echo $purchase_order->location; ?></th>
                                
                              </tr>

                              <tr>
                                 <th width="50%" align="left" style="border-left: solid 1px #000; border-top: solid 1px #000;padding-left: 10px;border-bottom: solid 1px #000;"><?php echo display('address') ?>:</th>
                                  <th width="50%" align="center" style="border-left: solid 1px #000; border-top: solid 1px #000;border-right: solid 1px #000;border-bottom: solid 1px #000;font-weight: normal;"><?php echo $purchase_order->address; ?></th>
                                
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

                              <?php if (!empty($purchase_order_items)) {

                               $sl = 0; $total_bid = count($purchase_order_items);
                               foreach ($purchase_order_items as $row) { 

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
                                <td class="text-right" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;"><?php if(!empty($purchase_order->total)){echo $purchase_order->total;}?></td>
                              </tr>

                              <tr>
                                <td class="text-right" align="right" colspan="5" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><b><?php echo display('discount') ?>:</b></td>
                                <td class="text-right" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;"><?php if(!empty($purchase_order->discount)){echo $purchase_order->discount;}else{echo "0";}?></td>
                              </tr>

                              <tr>
                                <td class="text-right" align="right" colspan="5" style="border-left: solid 1px #000;border-bottom: solid 1px #000;"><b><?php echo "Grand ".display('total') ?>:</b></td>
                                <td class="text-right" align="center" style="border-left: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;"><?php if(!empty($purchase_order->grand_total)){echo $purchase_order->grand_total;}?></td>
                              </tr>

                          </tfoot>

                    </table>

                    <br>

                    <table width="100%" class="table">
                          <thead>
                              <tr style="border-top: solid 1px #000;">
                                  <th width="50%" align="left" style="">Authorized by: </th>
                                  <th width="50%" align="left" style="">Supplier Acceptence: </th>
                              </tr>
                          </thead>

                          <tbody>
                              <tr>
                                    
                                    <td align="left" style="">
                                      <p>Name: <?php if(!empty($purchase_order->authorizer_name)){echo $purchase_order->authorizer_name;}?></p>
                                      <p>Title: <?php if(!empty($purchase_order->authorizer_title)){echo $purchase_order->authorizer_title;}?></p>
                                      <p>Signature: <img style="width: 80px;height: 50px;" src="<?php if(!empty($purchase_order->authorizer_signature)){echo $purchase_order->authorizer_signature;}?>" alt="logo"></p>
                                      <p>Date: <?php if(!empty($purchase_order->authorizer_date)){echo $purchase_order->authorizer_date;}?></p>
                                    </td>
                                    <td align="left" style="">
                                      <p>Name:__________________________</p>
                                      <p>Title:_________________________</p>
                                      <p>Signature:_____________________</p>
                                      <p>Date:__________________________</p>
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