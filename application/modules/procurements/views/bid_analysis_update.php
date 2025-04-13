<link href="<?php echo MOD_URL.'procurements/assets/css/style.css'; ?>" rel="stylesheet" type="text/css"/>  
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo $title; ?></span>
                            <span class="pdf-button">
                                <?php if (!empty($bid_analysis)) { ?>
                                <a href="<?php echo base_url($pdf)?>"download>
                                    <input type="button" class="btn btn-success" name="btnPdf" id="btnPdf" value="PDF"/>
                                </a>
                                <?php } ?> 
                            </span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('procurements/procurement_bid_analysis/bid_analys_update/'.$id, array('class' => 'form-vertical', 'id' => 'insert_bid', 'name' => 'insert_bid')) ?>
                    <div class="panel-body">

                        <input type="hidden" name="bid_analysis_form_id" id="bid_analysis_form_id" value="<?php echo $bid_analysis->bid_analysis_form_id?$bid_analysis->bid_analysis_form_id:null;?>">
                        <input type="hidden" name="old_attatchment" id="old_attatchment" value="<?php echo $bid_analysis->attachment?$bid_analysis->attachment:null;?>">

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('sba_no') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                         <input type="text" name="sba_no" id="sba_no" readonly="" required class="form-control" placeholder="<?php echo display('sba_no') ?>" value="<?php echo $bid_analysis->sba_no?$bid_analysis->sba_no:null;?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('location') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                         <input type="text" name="location" id="location" required class="form-control" placeholder="<?php echo display('location') ?>" value="<?php echo $bid_analysis->location?$bid_analysis->location:null;?>">
                                    </div>
                                </div>
                            </div>

                        </div> 

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('date') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                         <input type="text" name="create_date" id="date" required class="form-control datepicker" placeholder="Select Date" autocomplete="off" value="<?php echo $bid_analysis->create_date?$bid_analysis->create_date:null;?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('quotation') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                         <select name="quotation_id" class="form-control" disabled="true">
                                            <option value=""> Select Quotation</option>
                                            <?php if ($quotations) { ?>
                                              <?php foreach($quotations as $quotation){?>
                                                <option value="<?php echo $quotation['quotation_form_id']?>" <?php if($bid_analysis->quotation_form_id==$quotation['quotation_form_id']){echo 'selected';}?>><?php echo 'QT-'.sprintf('%05s', $quotation['quotation_form_id'])?></option>
                                                
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="attachment" class="col-sm-4 col-form-label"><?php echo display('attachment') ?>*</label>
                                    <div class="col-sm-8">

                                        <input type="file" name="attachment">
                                        <p>N.B: Only pdf|docx|jpg|png|jpeg are allowed</p>

                                        <a class="btn btn-primary" target="_blank" href="<?php if($bid_analysis->attachment){echo base_url().$bid_analysis->attachment;}else{echo "#";}?>" role="button">Click to open uploaded file</a>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <br>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover"  id="bid_analysis_table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('company') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('description') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('reason_of_choosing') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('remarks') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('unit') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('price_per_unit') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?> <i class="text-danger">*</i></th>


                                        <th class="text-center"><?php echo display('action') ?> <i class="text-danger"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="bid_analysis_item">

                                    <?php if(!empty($bid_analysis_items)){

                                            $total_qteitems = count($bid_analysis_items);
                                            $sl = 0;

                                        ?>

                                        <input type="hidden" id="total_bid_item" value="<?php echo $total_qteitems;?>">

                                        <?php

                                        foreach ($bid_analysis_items as $bid_analysis_item) {

                                            $sl = $sl + 1;

                                        ?>

                                        <tr>
                                            <td width="12%" class="">
                                                <input type="text" tabindex="3" class="form-control" name="company[]" placeholder="<?php echo display('company') ?>" readonly value="<?php echo $bid_analysis_item['company'];?>"/>
                                            </td>
                                            <td width="15%">
                                                <textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="<?php echo display('description') ?>" tabindex="10" required=""><?php echo $bid_analysis_item['description_material'];?></textarea>
                                            </td>
                                            <td width="13%" class="">
                                                <input type="text" tabindex="3" class="form-control" name="reason_of_choosing[]" placeholder="<?php echo display('reason_of_choosing') ?>" required value="<?php echo $bid_analysis_item['reason_of_choosing'];?>"/>
                                            </td>
                                            <td width="13%" class="">
                                                <input type="text" tabindex="3" class="form-control" name="remarks[]" placeholder="<?php echo display('remarks') ?>" required value="<?php echo $bid_analysis_item['remarks'];?>"/>
                                            </td>
                                            <td width="10%">
                                                <select name="unit_id[]" class="form-control"  required="">
                                                    <option value=""> Select Unit</option>
                                                    <?php if ($units) { ?>
                                                      <?php foreach($units as $unit){?>
                                                        <option value="<?php echo $unit['id']?>" <?php if($bid_analysis_item['unit']==$unit['id']){echo 'selected';}?>><?php echo $unit['unit']?></option>
                                                        
                                                    <?php }} ?>
                                                </select>
                                            </td>

                                            <td width="8%" class="">
                                                <input type="number" tabindex="3" onkeyup="calculate_bid(<?php echo $sl;?>);" onchange="calculate_bid(<?php echo $sl;?>);" id="quantity_<?php echo $sl;?>" class="form-control text-right" name="quantity[]" placeholder="0.00"  required value="<?php echo $bid_analysis_item['quantity']?>"  min="0"/>
                                            </td>

                                            <td width="10%" width="17%" class="">
                                                <input type="number" tabindex="3" onkeyup="calculate_bid(<?php echo $sl;?>);" onchange="calculate_bid(<?php echo $sl;?>);" id="price_per_unit_<?php echo $sl;?>" class="form-control text-right" name="price_per_unit[]" placeholder="0.00" value="<?php echo $bid_analysis_item['price_per_unit']?>"  required/>

                                            </td>

                                            <td width="12%" class="">
                                                <input type="text" tabindex="3" class="form-control text-right total_item_price" readonly="" name="total[]" placeholder="0.00" value="<?php echo $bid_analysis_item['total']?>"  id="total_price_<?php echo $sl;?>"  required/>
                                            </td>

                                            <td width="100"> <a  id="add_bid_item" class="btn btn-info btn-sm" name="add-bid-item" onclick="addBidItem('bid_analysis_item')" tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                                             <a class="btn btn-danger btn-sm"  value="<?php echo display('delete') ?>" onclick="deleteBidItemRow(this)" tabindex="3"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>

                                        <?php

                                            }
                                        }

                                        ?>

                                    
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td class="text-right" colspan="7"><b><?php echo "Grand ".display('total') ?>:</b></td>
                                        <td class="text-right">

                                            <input type="number" id="Total" class="text-right form-control" name="total_amount" placeholder="0.00" value="<?php echo $bid_analysis->total;?>" readonly="readonly" />

                                        </td>
                                        <td>
                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                            <input type="hidden" id="vendor_company_name" value="<?php echo $quote_data->name_of_company;?>"/>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                        <br>

                        <br>

                        <div class="row">
                            <div class="col-sm-10">
                                <div class="table-responsive product-supplier">
                                    <h2><?php echo display('committee_list');?></h2>
                                    <table class="table table-bordered table-hover" id="committee_table">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><?php echo display('name') ?> <i class="text-danger">*</i></th>
                                                <th class="text-center"><?php echo display('signature') ?> <i class="text-danger">*</i></th>
                                                <th class="text-center"><?php echo display('date') ?> <i class="text-danger">*</i></th>

                                                <th class="text-center"><?php echo display('action') ?> <i class="text-danger"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody id="committee_item">

                                            <?php if(!empty($bid_committee_lists)){

                                                $total_committee_lists = count($bid_committee_lists);
                                                $sl_no = 0;

                                            ?>

                                            <input type="hidden" id="total_committee_list" value="<?php echo $total_committee_lists;?>"/>

                                            <?php

                                            foreach ($bid_committee_lists as $bid_committee_list) {

                                                $sl_no = $sl_no + 1;

                                            ?>

                                            <tr>
                                                <td width="30%">
                                                    <select name="committee_id[]" class="form-control" required="" onchange="loadCommitteImage(this,<?php echo $sl_no;?>)">
                                                        <option value=""> Select Committee</option>
                                                        <?php if ($committee_lists) { ?>
                                                          <?php foreach($committee_lists as $committee_list){?>
                                                            <option value="<?php echo $committee_list->id;?>" <?php if($bid_committee_list->bid_committee_id == $committee_list->id){echo 'selected';}?>><?php echo $committee_list->name;?></option>
                                                            
                                                        <?php }} ?>
                                                    </select>
                                                </td>

                                                <td width="30%">
                                                    <input type="hidden" name="sign_image[]" id="sign_image_<?php echo $sl_no;?>" value="<?php echo $bid_committee_list->sign_image; ?>">
                                                    <img src="<?php echo base_url().$bid_committee_list->sign_image; ?>" alt="logo" id="output_<?php echo $sl_no;?>">
                                                </td>

                                                <td width="30%" class="">
                                                    <input type="text" id="date" tabindex="3" class="form-control datepicker" name="dates[]" placeholder="Date"  required value="<?php echo $bid_committee_list->date;?>" autocomplete="off"/>
                                                </td>

                                                <td width="100"> <a  id="add_committee_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="addcommittee('committee_item')"  tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                                                 <a class="btn btn-danger btn-sm"  value="<?php echo display('delete') ?>" onclick="deleteCommitteeRow(this)" tabindex="3"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>

                                            <?php
                                               }

                                             }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="comte_csrftoken" value="<?php echo $this->security->get_csrf_hash() ?>" id="comte_csrftoken">
                        
                        <br>

                        <div class="form-group row">
                            <div class="form-group form-group-margin form-procurement text-right">

                                <input type="submit" id="add-bid" class="btn btn-success btn-large" name="add-bid" value="<?php echo display('save') ?>" tabindex="10"/>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                    <input type="hidden" id="description_material" value="<?php echo display('description') ?>"/>
                    <input type="hidden" id="unit_list" value='<?php if ($units) { ?><?php foreach($units as $unit){?><option value="<?php echo $unit['id']?>"><?php echo $unit['unit']?></option><?php }}?>' name="">
                    <input type="hidden" id="company" value="<?php echo display('company') ?>"/>
                    <input type="hidden" id="reason_of_choosing" value="<?php echo display('reason_of_choosing') ?>"/>
                    <input type="hidden" id="remarks" value="<?php echo display('remarks') ?>"/>

                     <input type="hidden" id="date_lang" value="<?php echo display('date') ?>"/>
                    <input type="hidden" id="committee_list" value='<?php if ($committee_lists) { ?><?php foreach($committee_lists as $committee_list){?><option value="<?php echo $committee_list->id;?>"><?php echo$committee_list->name;?></option><?php }}?>' name="">
                </div>
            </div>
        </div>

        <script src="<?php echo MOD_URL.'procurements/assets/js/procurement.js'; ?>" type="text/javascript"></script>