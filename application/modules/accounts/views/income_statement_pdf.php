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
                                    <h3><?php echo display('income_statement')?> for <?php echo $curentYear->yearName ;?></h3>
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
                         <table style="width: 1200px!important;" align="left" class="datatableReport table table-striped table-bordered table-hover general_ledger_report_tble">
                                       
                        <thead>
                           <tr>
                              <th width="16%" bgcolor="#E7E0EE" align="left" ><?php echo display('particulars')?></th>
                                <?php $time = strtotime($curentYear->startDate);
                                 $startmonth = date('n',  strtotime($curentYear->startDate));
                                for($i=0; $i < 12; $i++) {
                                  $monthname = date("M-y", strtotime("+ ".$i." month", $time)); ?>
                                    <th width="7%" bgcolor="#E7E0EE" align="right" class="profitamount"><?php echo $monthname;?></th>
                                 <?php  } ?>                             

                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($incomes) > 0) {  foreach($incomes as $income) { ?>
                                <tr>
                                  <td  align="left"><?php echo $income['head'];?></td>
                                  <td  align="right" colspan="12" ></td>
                                </tr>
                                <?php  if(count($income['nextlevel']) > 0) { foreach ($income['nextlevel'] as  $value) { ?>
                                <tr>
                                   <td align="left" style="padding-left: 80px;"><?php echo $value['headName'];?></td>
                                   <td  align="right" colspan="12" class="profitamount"></td>                            
                                </tr>
                                 <?php if(count($value['innerHead']) > 0) { foreach($value['innerHead'] as $inner) { if($startmonth == 1) {  ?>
                                <tr>
                                    <td align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount1'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount2'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount3'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount4'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount5'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount6'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount7'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount8'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount9'],2); ?></td> 
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount10'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount11'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount12'],2); ?></td> 
                                 </tr>
                                   <?php } else { ?>
                                    <tr>
                                    <td align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount7'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount8'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount9'],2); ?></td> 
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount10'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount11'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount12'],2); ?></td> 
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount1'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount2'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount3'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount4'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount5'],2); ?></td>
                                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount6'],2); ?></td>               
                                 </tr>
                                 <?php } } }  } } } ?>
                            <tr bgcolor="#E7E0EE">
                               <td  colspan="13"> &nbsp;</td>
                            </tr>
                         <?php } ?>


         <?php if(count($costofgoodsolds) > 0) {  foreach($costofgoodsolds as $costofgoodsold) { ?>
                 <tr>
                     <td  align="left"  style="padding-left: 80px;"><?php echo $costofgoodsold['headName'];?></td>
                        <td  align="right" colspan="12" ></td>
                </tr>                    
                   
                <?php if(count($costofgoodsold['innerHead']) > 0) { foreach($costofgoodsold['innerHead'] as $inner) { if($startmonth == 1) {  ?>
                <tr>
                    <td align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount1'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount2'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount3'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount4'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount5'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount6'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount7'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount8'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount9'],2); ?></td> 
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount10'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount11'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount12'],2); ?></td> 
                 </tr>
                   <?php } else { ?>
                    <tr>
                    <td align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount7'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount8'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount9'],2); ?></td> 
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount10'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount11'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount12'],2); ?></td> 
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount1'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount2'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount3'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount4'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount5'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount6'],2); ?></td>               
                 </tr>
                 <?php } } } } 
                 if($startmonth == 1) { ?>
               
                  <tr>
                    <td   align="right"><strong><?php echo display('total_cogs');?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota1'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota2'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota3'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota4'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota5'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota6'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota7'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota8'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota9'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota10'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota11'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota12'] ,2); ?></strong></td> 
                 </tr> 
                 <tr bgcolor="#E7E0EE">
                   <td   align="right"><strong><?php echo display('gross_profit');?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal1']-$costofgoodsolds[0]['subtota1']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal2']-$costofgoodsolds[0]['subtota2']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal3']- $costofgoodsolds[0]['subtota3']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal4']-$costofgoodsolds[0]['subtota4']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal5']-$costofgoodsolds[0]['subtota5']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal6']-$costofgoodsolds[0]['subtota6']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal7']-$costofgoodsolds[0]['subtota7']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal8']-$costofgoodsolds[0]['subtota8']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal9']-$costofgoodsolds[0]['subtota9']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal10']-$costofgoodsolds[0]['subtota10']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal11'] -$costofgoodsolds[0]['subtota11']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal12']-$costofgoodsolds[0]['subtota12']) ,2); ?></strong></td> 
                </tr>
             <?php } else { ?>

                <tr>
                    <td   align="right"><strong><?php echo display('total_cogs');?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota1'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota2'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota3'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota4'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota5'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota6'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota7'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota8'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota9'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota10'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota11'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($costofgoodsolds[0]['subtota12'] ,2); ?></strong></td> 
                 </tr> 
                 <tr bgcolor="#E7E0EE">
                    <td   align="right"><strong><?php echo display('gross_profit');?></strong></td>
                   
                    
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal7']-$costofgoodsolds[0]['subtota7']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal8']-$costofgoodsolds[0]['subtota8']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal9']-$costofgoodsolds[0]['subtota9']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal10']-$costofgoodsolds[0]['subtota10']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal11']-$costofgoodsolds[0]['subtota11']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal12']-$costofgoodsolds[0]['subtota12']) ,2); ?></strong></td> 
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal1']-$costofgoodsolds[0]['subtota1']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal2']-$costofgoodsolds[0]['subtota2']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal3']- $costofgoodsolds[0]['subtota3']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal4']-$costofgoodsolds[0]['subtota4']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal5']-$costofgoodsolds[0]['subtota5']) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal6']-$costofgoodsolds[0]['subtota6']) ,2); ?></strong></td>
                </tr>
                 <?php }  } ?>

                 <tr bgcolor="#E7E0EE">
                   <td  colspan="13"> &nbsp;</td>
                 </tr>


          <?php if(count($expenses) > 0) {  foreach($expenses as $expense) { ?>
                    <tr>
                        <td  align="left"><?php echo $expense['head'];?></td>
                        <td  align="right" colspan="12" ></td>
                    </tr>
                    <?php  if(count($expense['nextlevel']) > 0) { foreach ($expense['nextlevel'] as  $value) { ?>
                    <tr>
                        <td align="left" style="padding-left: 80px;"><?php echo $value['headName'];?></td>
                        <td  align="right" colspan="12" class="profitamount"></td>                            
                    </tr>
                    <?php if(count($value['innerHead']) > 0) { foreach($value['innerHead'] as $inner) { if($startmonth == 1) {  ?>
                <tr>
                    <td align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount1'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount2'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount3'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount4'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount5'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount6'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount7'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount8'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount9'],2); ?></td> 
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount10'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount11'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount12'],2); ?></td> 
                 </tr>
                   <?php } else { ?>
                    <tr>
                    <td align="left" style="padding-left: 160px;"><?php echo $inner['headName'];?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount7'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount8'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount9'],2); ?></td> 
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount10'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount11'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount12'],2); ?></td> 
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount1'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount2'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount3'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount4'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount5'],2); ?></td>
                    <td align="right" class="profitamount"><?php echo $setting->currency_symbol. ' '. number_format($inner['amount6'],2); ?></td>               
                 </tr>
                 <?php } } }  } } } 

                 if($startmonth == 1) { ?>
               
                  <tr>
                    <td   align="right"><strong><?php echo display('total_expense');?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal1'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal2'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal3'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal4'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal5'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal6'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal7'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal8'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal9'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal10'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal11'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal12'] ,2); ?></strong></td> 
                 </tr> 
                  <tr bgcolor="#E7E0EE">
                    <td   align="right"><strong><?php echo display('net_amount');?></strong></td>
                   
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal1']- ($costofgoodsolds[0]['subtota1']+$expenses[0]['gtotal1'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal2']- ($costofgoodsolds[0]['subtota2']+$expenses[0]['gtotal2'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal3']- ($costofgoodsolds[0]['subtota3']+$expenses[0]['gtotal3'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal4']- ($costofgoodsolds[0]['subtota4']+$expenses[0]['gtotal4'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal5']- ($costofgoodsolds[0]['subtota5']+$expenses[0]['gtotal5'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal6']- ($costofgoodsolds[0]['subtota6']+$expenses[0]['gtotal6'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal7']- ($costofgoodsolds[0]['subtota7']+$expenses[0]['gtotal7'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal8']- ($costofgoodsolds[0]['subtota8']+$expenses[0]['gtotal8'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal9']- ($costofgoodsolds[0]['subtota9']+$expenses[0]['gtotal9'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal10']- ($costofgoodsolds[0]['subtota10']+$expenses[0]['gtotal10'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal11']- ($costofgoodsolds[0]['subtota11']+$expenses[0]['gtotal11'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal12']- ($costofgoodsolds[0]['subtota12']+$expenses[0]['gtotal12'])) ,2); ?></strong></td> 
                 </tr>



             <?php } else { ?>

                <tr>
                    <td   align="right"><strong><?php echo display('total_expense');?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal1'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal2'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal3'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal4'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal5'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal6'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal7'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal8'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal9'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal10'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal11'] ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format($expenses[0]['gtotal12'] ,2); ?></strong></td> 
                 </tr> 

                 <tr bgcolor="#E7E0EE">
                    <td   align="right"><strong><?php echo display('net_amount');?></strong></td>  
                   <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal7']- ($costofgoodsolds[0]['subtota7']+$expenses[0]['gtotal7'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal8']- ($costofgoodsolds[0]['subtota8']+$expenses[0]['gtotal8'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal9']- ($costofgoodsolds[0]['subtota9']+$expenses[0]['gtotal9'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal10']- ($costofgoodsolds[0]['subtota10']+$expenses[0]['gtotal10'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal11']- ($costofgoodsolds[0]['subtota11']+$expenses[0]['gtotal11'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal12']- ($costofgoodsolds[0]['subtota12']+$expenses[0]['gtotal12'])) ,2); ?></strong></td> 
                   <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal1']- ($costofgoodsolds[0]['subtota1']+$expenses[0]['gtotal1'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal2']- ($costofgoodsolds[0]['subtota2']+$expenses[0]['gtotal2'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal3']- ($costofgoodsolds[0]['subtota3']+$expenses[0]['gtotal3'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal4']- ($costofgoodsolds[0]['subtota4']+$expenses[0]['gtotal4'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal5']- ($costofgoodsolds[0]['subtota5']+$expenses[0]['gtotal5'])) ,2); ?></strong></td>
                    <td  align="right" class="profitamount" ><strong><?php echo $setting->currency_symbol. ' '. number_format(($incomes[0]['gtotal6']- ($costofgoodsolds[0]['subtota6']+$expenses[0]['gtotal6'])) ,2); ?></strong></td>
                    
                 </tr> 
            <?php }  } ?>

                            

                    </tbody>
                      <tfoot>
                           <tr >
                            <td colspan="13" class="noborder">
                                <table border="0" width="100%">                                                
                                <tr>
                                    <td align="left" class="noborder">
                                        <div class="border-top"><?php echo display('prepared_by')?></div>
                                    </td>
                                    <td align="center"  class="noborder"> <div class="border-top"><?php echo display('checked_by')?></div>
                                    </td>  
                                     <td align="right"  class="noborder">
                                        <div class="border-top"><?php echo display('authorised_by')?></div>
                                    </td>
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