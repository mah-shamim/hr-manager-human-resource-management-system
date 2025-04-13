<?php

    $curncy_symbol = '';
    $social_security_tax_percnt = '';
    if(!empty($setting->currency_symbol)){
        $curncy_symbol = '('.$setting->currency_symbol.')';
        $social_security_tax_percnt = $setting->soc_sec_npf_tax;
    }

?>


  <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                
                <div class="panel-body">
<?php
    $total=0;
   ?>

<table  class="table table-striped" width="100%">

 <div class="form-group text-center reportheader">
     <?php echo display('loan_report')?> 
        
    </div>
    <div class="row">
  <span class="form-group text-center col-sm-5 loanimg">
            <?php
        echo img($emp->picture );?>
        </span>
        <div  class="col-sm-7">
    <div class="form-group reportview">
       
        <?php echo display('name');?>:<?php
        echo $emp->first_name." ".$emp->last_name ;?>
    </div>
   
    <div class="form-group reportview">
       
      ID NO: <?php
    
echo $emp->employee_id ;
         
        ?>
    </div>
<div class="form-group reportview">
       
      <?php echo display('designation');?>: <?php
         echo $emp->position_name ;
         
        ?>
        </div>
    </div>
    </div>
    
    </table>
    <table class="table table-striped" width="100%">
    <tr>
        <th><?php echo display('sl');?></th>
        <th><?php echo display('loan_issue_id');?></th>
        <th><?php echo display('date');?></th>
        <th><?php echo display('amount');?></th>
        <th><?php echo display('repayment');?></th>
        <th><?php echo display('installment');?></th>
        <th><?php echo display('action');?></th>
    </tr>
    <?php
    $x=1;
    foreach($ab as $qr){?>
    <tr>
          <td><?php echo $x++;?></td>
           <!-- <td><a href="<?php echo base_url("loan/Loan/details_view/$qr->loan_id");?>" ><?php echo $qr->loan_id?></a></td> -->
           <td><?php echo $qr->loan_id?></td>
          <td><?php echo $qr->date_of_approve?></td>
          <td><?php if(!empty($setting->currency_symbol)){echo $setting->currency_symbol.' ';}?><?php echo $qr->amount?></td>
          <td><?php if(!empty($setting->currency_symbol)){echo $setting->currency_symbol.' ';}?><?php echo $qr->repayment_amount ?></td>
          <td><?php if(!empty($setting->currency_symbol)){echo $setting->currency_symbol.' ';}?><?php echo $qr->installment ?></td>

            <td class="center">

                <a title="Loan To Employee" href='<?php echo base_url("loan/loan/loan_to_employee_report/$qr->loan_id") ?>' class='btn btn-xs btn-success' target="_blank"><i class="fa fa-bars"></i></a>

            </td>

    </tr>
    <?php }?>
    
</table>
</div>
</div>
</div>
</div>
