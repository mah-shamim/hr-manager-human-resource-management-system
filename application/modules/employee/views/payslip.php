
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
                                			<td><img src="http://newhrm.bdtask.com/hrm_demo/assets/img/icons/2017-07-22/HRM.png" width="250px;" alt=""></td>
                                			<td class="text-center"> <address style="margin-top:10px">
                                        <strong style="font-size: 30px; ">Bdtask Ltd</strong><br>
                                        4th Floor Mannan Plaza,Khilkhet dhaka-1229<br>
                                       <span style="font-weight: bold;"> Salary Slip - November 2019</span>
                                       
                                      
                                    </address></td>
                                    <td></td>
                                		</tr>
                                	</table>
                                	<table>
       <div id="details">
		<div class="scope-entry">
			<div class="title">Employee Name : Mohammad Abul Kalam</div>
			<div class="title">Designation   : Web Developer</div>
			<div class="title">Salary Date   : 6 November 2019</div>
			
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
                                            <th class="name text-center" colspan="2" style="border-bottom: 1px solid #ccc;"><?php echo 'Earnings'; ?></th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody class="details">
                                      
                                        <tr class="entry">
                                            <td class="value">Basic</td>
                                            <td class="value"><div>40000</div></td>
                                           
                                        </tr>
                                         <tr class="entry">
                                            <td class="value">House Rent</td>
                                            <td class="value"><div>10000</div></td>
                                           
                                        </tr>
                                         <tr class="entry">
                                            <td class="value">Health</td>
                                            <td class="value"><div>5000</div></td>
                                           
                                        </tr>
                                        <tr class="entry nti">
                                             <td class="value" style="float:left;font-weight: bold">Total Addition</td>
                                            <td class="value" style="font-weight: bold"><?php echo 55000; ?></td>
                                        </tr>
                              
                                      
                                    </tbody>
<!--                                    <tfoot>
                                    
                                    </tfoot>-->
                                </table></td>
                        			<td  class="right-panel">  <table class="" width="100%">
                        				
                                  
                        			 	
                                    <thead>
                                        <tr class="employee">
                                            <th class="name text-center" colspan="2" style="border-bottom: 1px solid #ccc;"><?php echo 'Deduction'; ?></th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody class="details">
                                      
                                        <tr class="entry">
                                            <td class="value">Provident Fund</td>
                                            <td class="value"><div>5000</div></td>
                                           
                                        </tr>
                                         <tr class="entry">
                                            <td class="value">Tax</td>
                                            <td class="value"><div>2000</div></td>
                                           
                                        </tr>
                                         <tr class="entry nti">
                                             <td class="value" style="float:left; font-weight: bold">Total Deduction</td>
                                            <td class="value" style="font-weight: bold"><?php echo 7000; ?></td>
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
                                                <th class="value"><?php echo 'Net Salary'; ?> : <?php echo 'In Word: Forty Eight Thousands Only'; ?></th>
                                                <td class="value" style="float: right;font-weight: bold"><?php echo 48000; ?> </td>
                                                </tbody>
                                            </tr>
                                           	 
                                      
                                    </table>

                                   

                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-12" style="padding-bottom: 50px;">
                             
                                        <div class="col-sm-6" style="float:left;font-weight: bold;">Check No: 234252342</div><div class="col-sm-6" style="float:right;font-weight: bold;">Name of Bank: Bangladesh Bank</div>
                                    
                                </div>
                              
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                 <div  style="float:left;width:40%;text-align:center;border-top:1px solid #e4e5e7;font-weight: bold;">
                                        <?php echo 'Employee Signature' ?>
                                    </div>
                                </div>
                              
                                     <div class="col-sm-6"> <div  style="float:right;width:40%;text-align:center;border-top:1px solid #e4e5e7;font-weight: bold;">
                                        <?php echo 'Paid By' ?>
                                    </div></div>
                            </div>
                           
                        </div>
                    </div>

                  
                </div>
            </div>
        </div>
        <script type="text/javascript">

        </script>
   
 