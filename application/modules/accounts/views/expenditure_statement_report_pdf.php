<style type="text/css">
     table.datatableReport {       
        border-collapse: collapse;
        border: 0;
    }
    table.datatableReport td, table.datatableReport th {
        padding: 6px 15px;
    }
    table.datatableReport td, table.datatableReport th {
        border: 1px solid #ededed;
        border-collapse: collapse;
    }
table.datatableReport td.noborder {
    border: none;
    padding-top: 40px;
}
</style>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">            
            <div id="printArea">
                <div class="panel-body">
                    <div class="table-responsive">
                     <table border="0" style="width: 1200px!important;">
                        <tr>
                            <td width="30%" align="left">
                                <?php
                                $path = base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png'));
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                ?>
                                <img src="<?php echo  $base64; ?>" alt="logo">
                            </td>
                            <td width="40%" align="center"> <h2> <?php echo $setting->title;?>  </h2><h4> <?php echo $setting->address;?> </h4>
                                <h3><?php echo display('expenditure_statement')?><br/><?php echo display('from')?> <?php echo $dtpFromDate ?> <?php echo display('to')?> <?php echo $dtpToDate;?></h3>
                            </td>  
                             <td width="30%" align="right">
                                <date>
                                <?php echo display('date')?>: <?php
                                echo date('d-M-Y');
                                ?> 
                            </date>
                            </td>
                        </tr>  
                     </table>     
                    <table width="99%" align="left" class="datatableReport table table-striped table-bordered table-hover general_ledger_report_tble">
                                   
                    <thead>                   
                      <tr>
                        <th width="60%" bgcolor="#E7E0EE" align="center" ><?php echo display('particulars')?></th>
                         <th width="20%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('amount')?></th>
                       <th width="20%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo display('amount')?></th>
                      </tr>
                    </thead>
                    <tbody>                    
                   
                    <?php foreach($expenses as $expense) { ?>
                      <tr>
                          <td  align="left"   ><?php echo $expense['head'];?></td>
                          <td  align="right" colspan="2" ></td>
                     </tr>
                     <?php  if(count($expense['nextlevel']) > 0) { foreach ($expense['nextlevel'] as  $value) { ?>
                        <tr>
                            <td  align="left" style="padding-left: 80px;"><?php echo $value['headName'];?></td>
                            <td   align="right" class="profitamount"> &nbsp;</td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($value['subtotal'],2); ?></td>
                        </tr>
                        <?php if(count($value['innerHead']) > 0) { foreach($value['innerHead'] as $inner) { ?>
                         <tr>
                            <td align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                            <td   align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount'],2); ?></td>
                            <td> &nbsp; </td>
                        </tr>
                      <?php } }  } } } ?>
                      
                      <tr>
                            <td   align="right"><strong><?php echo display('total');?></strong></td>
                            <td   align="right" class="profitamount" colspan="2"><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal']  ,2); ?></strong></td>
                            
                        </tr>


                 
                </tbody>
                <tfoot>
                    <tr bgcolor="#FFF" style="margin-top: 200px;">
                      <td colspan="3" align="center" height="120" valign="bottom">
                          <table width="100%" cellpadding="1" cellspacing="20">
                            <tr>
                              <td width="20%" class="noborder" align="center"><?php echo display('prepared_by')?></td>
                                <td width="20%" class="noborder" align="center"><?php echo display('accounts')?></td>
                                <td width="20%" class="noborder" align="center"><?php echo display('authorized_signature')?></td>
                                <td  width="20%" class="noborder" align='center'><?php echo display('chairman')?></td>
                            </tr>
                          </table>
                      </td>
                    </tr>

                     </tfoot>


                  </table>
              </div>
             </div>
            </div>
            
        </div>
    </div>
</div>