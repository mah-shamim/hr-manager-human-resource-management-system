<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/payroll.css" />

<!-- Printable area end -->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                	<div class="panel title text-right">
                		 <button  class="btn btn-warning" onclick="printDiv()"><span class="fa fa-print"></span></button>
                	</div>
                    <div id="printArea">
                        <div class="panel-body" id="payslip">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                	
                                	<table>
                                		<tr>

                                			<td><img src="<?php echo base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png')) ?>" width="250px;" alt=""></td>
                                			<td class="text-center"> <address >
                                        <strong><?php echo (!empty($setting->title)?$setting->title:'Bdtask Ltd')?></strong><br>
                                        <?php echo (!empty($setting->address)?$setting->address:'Demo Address')?><br>
                                       <span> Salary Slip - <?php echo $paymentdata[0]['salary_name']?></span>
                                       
                                      
                                    </address></td>
                                    <td></td>
                                		</tr>
                                	</table>
                                	<table>
       <div id="details">
		<div class="scope-entry">
			<div class="title"><?php echo  display('employee_name')?> :<?php echo  $paymentdata[0]['first_name'].' '.$paymentdata[0]['last_name']?></div>
			<div class="title"><?php echo  display('designation')?>   : <?php echo  $paymentdata[0]['position_name']?></div>
			<div class="title"><?php echo  display('salary_date')?>   : <?php echo  $paymentdata[0]['payment_date']?></div>
			
		</div>
		
	</div>
                                	</table>
                                
                                </div>
                                
                      
                            

                        <div class="col-sm-12">
                        	<table class="table">
                        		<tr>
                        			<td class="left-panel"> 
                        			 <table class="" width="100%">
                        			 	
                                    <thead>
                                        <tr class="employee">
                                            <th class="name text-center" colspan="2"><?php echo display('earnings'); ?></th>
                                            
                                           
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
                                            <td class="value"><?php echo  $additions->sal_name;?></td>
                                            <td class="value"><div><?php echo  $basicsal*($additions->amount)/100;
                                            $totalAddition +=$basicsal*($additions->amount)/100;
                                            ?></div></td>
                                           
                                        </tr>
                                    <?php }?>
                                         
                                        <tr class="entry nti">
                                             <td class="value valtitle"><?php echo display('total_addition')?></td>
                                            <td class="value"><b><?php echo $totalAddition+$basicsal; ?></b></td>
                                        </tr>
                              
                                      
                                    </tbody>
                                </table></td>
                        			<td  class="right-panel">  <table class="" width="100%">
                        				
                                  
                        			 	
                                    <thead>
                                        <tr class="employee">
                                            <th class="name text-center" colspan="2"><?php echo display('deduction'); ?></th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody class="details">
                                      <?php 
                                      $totalDeduction = 0;
                                      foreach($deduction as $deductions){?>
                                        <tr class="entry">
                                            <td class="value"><?php echo  $deductions->sal_name; ?></td>
                                            <td class="value"><div><?php echo  $basicsal*($deductions->amount)/100;
                                            $totalDeduction +=$basicsal*($deductions->amount)/100;
                                            ?></div></td>
                                           
                                        </tr>
                                    <?php }?>
                                    <?php $gross = $totalAddition+($basicsal-$totalDeduction);
                                     if($paymentdata[0]['total_salary'] < $gross){
                                    ?>
                                     <tr class="entry">
                                            <td class="value"><?php echo display('tax')?></td>
                                            <td class="value"><div><?php  $tax = $gross - intval(str_replace(',', '', $paymentdata[0]['total_salary']));
                                            echo $totaltax = number_format($tax,2);
                                            ?></div></td>
                                           
                                        </tr>
                                <?php }?>
                                       
                                         <tr class="entry nti">
                                             <td class="value valtitle"><?php echo display('total_deduction')?></td>
                                            <td class="value"><b><?php echo $totalDeduction+(!empty($totaltax)?$totaltax:0); ?></b></td>
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
                                                <td class="value total_salary"><?php echo  $paymentdata[0]['total_salary']?> </td>
                                                </tbody>
                                            </tr>
                                           	 
                                      
                                    </table>

                                   

                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-12">
                             
                                        <div class="col-sm-6 valtitle"><?php echo  display('ref_number')?>: .........</div><div class="col-sm-6 payslipfooterbandk"><?php echo  display('name_of_bank')?>: <?php echo (!empty($paymentdata[0]['bank_name'])?$paymentdata[0]['bank_name']:'..........')?></div>
                                    
                                </div>
                              
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                 <div class="employee_sign">
                                        <?php echo display('employee_signature'); ?>
                                    </div>
                                </div>
                              
                                     <div class="col-sm-6"> <div  class="authority_sign">
                                        <?php echo display('paid_by'); ?>
                                    </div></div>
                            </div>
                           
                        </div>
                    </div>

                  
                </div>
            </div>
        </div>
    
   
 