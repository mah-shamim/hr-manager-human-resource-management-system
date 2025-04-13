
<style>
   
#scope > .scope-entry {
	text-align: center;
	padding-bottom: 10px;
}

#payslip {
	background: #fff;
	color: #000;
	padding: 30px 40px;
}

#title {
	margin-bottom: 0px;
	font-size: 38px;
	font-weight: 600;
}

#scope {
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	padding: 7px 0 4px 0;
	display: flex;
	
}

#scope > .scope-entry {
	text-align: center;
}
.scope-entry > .title {
	font-size: 15px;
	font-weight: 700;
	text-align: left;
	}

#scope > .scope-entry > .value {
	font-size: 14px;
	font-weight: 700;
}

.content {
	display: flex;
	height: 100%;
}

.content .left-panel {
	border-right: 1px solid #ccc;
	width: 50%;
	padding: 9px 16px 0 0;
}
#payslip #panel-footer {
	width: 100%;
	padding: 9px 16px 0 0;
}
.content .right-panel {
	width: 50%;
	padding: 10px 0  0 16px;
}

.employee {
	text-align: center;
	margin-bottom: 20px;
}
.employee .name {
	font-size: 15px;
	font-weight: 700;
	border-bottom: 1px solid #ccc;
}

#employee #email {
	font-size: 11px;
	font-weight: 300;
}

.details, .contributions, .ytd, .gross {
	margin-bottom: 20px;
}

.details .entry, .contributions .entry, .ytd .entry {
	display: flex;
	justify-content: space-between;
	margin-bottom: 6px;
}

.details .entry .value, .contributions .entry .value, .ytd .entry .value {
	font-weight: 700;
	max-width: 130px;
	text-align: right;
}

.gross .entry .value {
	font-weight: 700;
	text-align: right;
	font-size: 16px;
}

.contributions .title, .ytd .title, .gross .title {
	font-size: 20px;
	font-weight: 700;
	border-bottom: 1px solid #ccc;
	text-align: left;
	padding-bottom: 4px;
	margin-bottom: 6px;
}

.content .right-panel .details {
	width: 100%;
}

.content .right-panel .details .entry {
	display: flex;
	padding: 0 10px;
	margin: 6px 0;
}

.content .right-panel .details .label {
	font-weight: 700;
	width: 120px;
}

.content .right-panel .details .detail {
	font-weight: 600;
	width: 130px;
}

.content .right-panel .details .rate {
	font-weight: 400;
	width: 80px;
	font-style: italic;
	letter-spacing: 1px;
}

.content .right-panel .details .amount {
	text-align: right;
	font-weight: 700;
	width: 90px;
}

.content .right-panel .details .net_pay div, .content .right-panel .details .nti div {
	font-weight: 600;
	font-size: 12px;
}

.content .right-panel .details .net_pay, .content .right-panel .details .nti {
	padding: 3px 0 2px 0;
	margin-bottom: 10px;
	color:#000;
	background: rgba(0, 0, 0, 0.04);
}

.content .left-panel .details .net_pay, .content .left-panel .details .nti {
	padding: 3px 0 2px 0;
	margin-bottom: 10px;
	color:#000;
	background: rgba(0, 0, 0, 0.04);
}

.content .right-panel .details .label {
    font-weight: 600;
    width: 130px;
    color: #000;
    font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
#payslip .footer{
	padding: 3px 0 2px 0;
	margin-bottom: 10px;
	color:#000;
	background: rgba(0, 0, 0, 0.04);
}


.footertext{
	font-weight: 600;
    color: #000;
    font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-size: 20px;
}


.left-panel .details .nti {
    padding: 3px 0 2px 0;
    margin-bottom: 10px;
    font-weight: 800;
    color: #000;
    background: rgba(0, 0, 0, 0.04);
}

.right-panel .details .nti {
    padding: 3px 0 2px 0;
    margin-bottom: 10px;
    font-weight: 800;
    color: #000;
    background: rgba(0, 0, 0, 0.04);
}

.details .nti {
    padding: 3px 0 2px 0;
    margin-bottom: 10px;
    font-weight: 800;
    color: #000;
    background: rgba(0, 0, 0, 0.04);
}
</style>
<!-- Printable area start -->
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        // document.body.style.marginTop="-45px";
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<!-- Printable area end -->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                	<div class="panel title text-right">
                		 <button  class="btn btn-warning" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>
                	</div>
                    <div id="printableArea">
                        <div class="panel-body" id="payslip">
                            <div class="row" style="border-bottom:1px solid #ccc;">
                                
                                <div class="col-sm-12">
                                	
                                	<table>
                                		<tr>

                                			<td><img src="<?php echo base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png')) ?>" width="250px;" alt=""></td>
                                			<td class="text-center"> <address style="margin-top:10px">
                                        <strong style="font-size: 30px; "><?php echo (!empty($setting->title)?$setting->title:'Bdtask Ltd')?></strong><br>
                                        <?php echo (!empty($setting->address)?$setting->address:'Demo Address')?><br>
                                       <span style="font-weight: bold;"> Salary Slip - <?= $paymentdata[0]['salary_name']?></span>
                                       
                                      
                                    </address></td>
                                    <td></td>
                                		</tr>
                                	</table>
                                	<table>
       <div id="details">
		<div class="scope-entry">
			<div class="title"><?= display('employee_name')?> :<?= $paymentdata[0]['first_name'].' '.$paymentdata[0]['last_name']?></div>
			<div class="title"><?= display('designation')?>   : <?= $paymentdata[0]['position_name']?></div>
			<div class="title"><?= display('salary_date')?>   : <?= $paymentdata[0]['payment_date']?></div>
			
		</div>
		
	</div>
                                	</table>
                                
                                </div>
                                
                      
                            

                        <div class="col-sm-12">
                        	<table class="table">
                        		<tr>
                        			<td class="left-panel" style="border-right: 1px solid #ccc;"> 
                        			 <table class="" width="100%">
                        			 	
                                    <thead>
                                        <tr class="employee">
                                            <th class="name text-center" colspan="2" style="border-bottom: 1px solid #ccc;"><?php echo display('earnings'); ?></th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody class="details">
                                      
                                        <tr class="entry">
                                            <td class="value"><?php if($paymentdata[0]['salarytype'] == 1){ echo display('basic_salary');}else{echo display('basic_salary');}?></td>
                                            <td class="value"><div><?php if($paymentdata[0]['salarytype'] == 1){ echo $basicsal = $paymentdata[0]['basic']*$paymentdata[0]['total_working_minutes'];}else{echo $basicsal = $paymentdata[0]['basic'];}?></div></td>
                                           
                                        </tr>
                                        <?php 
                                        $totalAddition = 0;
                                        foreach($addition as $additions){?>
                                         <tr class="entry">
                                            <td class="value"><?= $additions->sal_name;?></td>
                                            <td class="value"><div><?php echo  $basicsal*($additions->amount)/100;
                                            $totalAddition +=$basicsal*($additions->amount)/100;
                                            ?></div></td>
                                           
                                        </tr>
                                    <?php }?>
                                         
                                        <tr class="entry nti">
                                             <td class="value" style="float:left;font-weight: bold"><?= display('total_addition')?></td>
                                            <td class="value" style="font-weight: bold"><?php echo $totalAddition+$basicsal; ?></td>
                                        </tr>
                              
                                      
                                    </tbody>
<!--                                    <tfoot>
                                    
                                    </tfoot>-->
                                </table></td>
                        			<td  class="right-panel">  <table class="" width="100%">
                        				
                                  
                        			 	
                                    <thead>
                                        <tr class="employee">
                                            <th class="name text-center" colspan="2" style="border-bottom: 1px solid #ccc;"><?php echo display('deduction'); ?></th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody class="details">
                                      <?php 
                                      $totalDeduction = 0;
                                      foreach($deduction as $deductions){?>
                                        <tr class="entry">
                                            <td class="value"><?= $deductions->sal_name; ?></td>
                                            <td class="value"><div><?php echo  $basicsal*($deductions->amount)/100;
                                            $totalDeduction +=$basicsal*($deductions->amount)/100;
                                            ?></div></td>
                                           
                                        </tr>
                                    <?php }?>
                                    <?php $gross = $totalAddition+($basicsal-$totalDeduction);
                                     if($paymentdata[0]['total_salary'] < $gross){
                                    ?>
                                     <tr class="entry">
                                            <td class="value"><?= display('tax')?></td>
                                            <td class="value"><div><?php  $tax = $gross - intval(str_replace(',', '', $paymentdata[0]['total_salary']));
                                            echo $totaltax = number_format($tax,2);
                                            ?></div></td>
                                           
                                        </tr>
                                <?php }?>
                                       
                                         <tr class="entry nti">
                                             <td class="value" style="float:left; font-weight: bold"><?= display('total_deduction')?></td>
                                            <td class="value" style="font-weight: bold"><?php echo $totalDeduction+(!empty($totaltax)?$totaltax:0); ?></td>
                                        </tr>
                                        
                                    </tbody>
                                
                                </table></td>
                        		</tr>

                        	</table>
                        </div>
                    </div>
                              
                           
                            <div class="row">

                               
                                <div class="col-sm-12">

                                    <table class="table">
                                   
                                      
                                            <tr class="details">
                                            	<tbody class="nti">
                                                <th class="value"><?php echo display('net_salary'); ?> : <?php echo display('in_word').':'.$amountinword; ?></th>
                                                <td class="value" style="float: right;font-weight: bold"><?= $paymentdata[0]['total_salary']?> </td>
                                                </tbody>
                                            </tr>
                                           	 
                                      
                                    </table>

                                   

                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-12" style="padding-bottom: 50px;">
                             
                                        <div class="col-sm-6" style="float:left;font-weight: bold;"><?= display('ref_number')?>: .........</div><div class="col-sm-6" style="float:right;font-weight: bold;"><?= display('name_of_bank')?>: <?php echo (!empty($paymentdata[0]['bank_name'])?$paymentdata[0]['bank_name']:'..........')?></div>
                                    
                                </div>
                              
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                 <div  style="float:left;width:40%;text-align:center;border-top:1px solid #e4e5e7;font-weight: bold;">
                                        <?php echo display('employee_signature'); ?>
                                    </div>
                                </div>
                              
                                     <div class="col-sm-6"> <div  style="float:right;width:40%;text-align:center;border-top:1px solid #e4e5e7;font-weight: bold;">
                                        <?php echo display('paid_by'); ?>
                                    </div></div>
                            </div>
                           
                        </div>
                    </div>

                  
                </div>
            </div>
        </div>
    
   
 