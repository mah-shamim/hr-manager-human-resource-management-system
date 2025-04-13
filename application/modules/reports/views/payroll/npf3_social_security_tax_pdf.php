<style type="text/css">

     table .logo-head{text-align: center !important;}

     table.payrollDatatableReport {       
        border-collapse: collapse;
        border: 0;
        text-align: left !important;
    }
    table.payrollDatatableReport td, table.payrollDatatableReport th {
        padding: 6px 15px;
        text-align: left;
    }
    table.payrollDatatableReport td, table.payrollDatatableReport th {
        border: 1px solid #ededed;
        border-collapse: collapse;
        text-align: left;
    }
    table.payrollDatatableReport td.noborder {
        border: none;
        padding-top: 40px;
    }
    table.payrollDatatableReport tbody tr td {
        font-size: 13px;
        padding-left: 5px;
        text-align: left;
    }

    table.payrollDatatableReport thead tr th {
        font-size: 10px;
        padding-left: 5px;
        text-align: left;
    }
</style>

<?php if(isset($tax_data) && !empty($tax_data)){?>

<div class="panel panel-bd"> 
    
    <div class="panel-body">

    <div id="">

        <div style="padding:20px;">

            <div class="row mb-10">
                <table class="table" style="width: 100%;text-align: center;">
                    <thead class="logo-head">
                        <tr>
                            <td class="text-center" style="border:none;text-align: center;">

                                <?php
                                    $path = base_url((!empty($setting->logo)?$setting->logo:'assets/img/icons/mini-logo.png'));
                                    $type = pathinfo($path, PATHINFO_EXTENSION);
                                    $data = file_get_contents($path);
                                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                ?>

                                <img src="<?php echo  $base64; ?>" alt="logo">
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center fs-20" style="border:none;text-align: center;">Social security and housing finance corporation remittance adivce form</th>
                        </tr>
                    </thead>
                </table>
            </div> 

            <br>

            <div class="row mb-10">
                <table class="info-section" cellspacing="0" cellpadding="1" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td width="33%" style="border-top:none;">EMPLOYER REGISTRATION NUMBER:</td>
                            <td width="33%" style="border-top:none;text-align: center;">5968</td>
                            <td width="33%" style="border-top:none;padding-left: 20px;">NPF 3 <br>YEAR:<?php echo $year;?></td>
                        </tr>
                        <tr>
                            <td width="33%" style="border-top:none;">EMPLOYER NAME:</td>
                            <td width="33%" style="border-top:none;text-align: center;"><?php echo $setting->title;?></td>
                            <td width="33%" style="border-top:none;"></td>
                        </tr>
                        <tr>
                            <td width="33%" style="border-top:none;">ADDRESS:</td>
                            <td width="33%" style="border-top:none;text-align: center;"><?php echo $setting->address;?></td>
                            <td width="33%" style="border-top:none;"></td>
                        </tr>
                        <tr>
                            <td width="33%" style="border-top:none;">CONTRIBUTION FOR MONTH OF: </td>
                            <td width="33%" style="border-top:none;text-align: center;"><?php echo $month.'-'.$year;?></td>
                            <td width="33%" style="border-top:none;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br>

            <div class="row">
                <table width="99%" class="payrollDatatableReport table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                            <td>Employee</td>
                            <td>Employee</td>
                            <td>Basic</td>
                            <td>5%</td>
                            <td>10%</td>
                            <td>15%</td>
                            <td>NEW EMPLOYEES INDICATE</td>
                        </tr>

                        <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                            <td>Soc.Sec.#</td>
                            <td>Full Name</td>
                            <td>Pay<?php if(!empty($setting->currency_symbol)){echo '('.$setting->currency_symbol.')';}?></td>
                            <td>Contr.<?php if(!empty($setting->currency_symbol)){echo '('.$setting->currency_symbol.')';}?></td>
                            <td>Contr.<?php if(!empty($setting->currency_symbol)){echo '('.$setting->currency_symbol.')';}?></td>
                            <td>Contr.<?php if(!empty($setting->currency_symbol)){echo '('.$setting->currency_symbol.')';}?></td>
                            <td>LAST EMPLOYER &S.S NO.</td>
                        </tr>

                    </thead>
                    <tbody>

                        <?php 

                        $total_basic             = 0.0;
                        $total_soc_sec           = 0.0;
                        $total_empr_contr        = 0.0;
                        $total_soc_sec_and_contr = 0.0;

                        foreach ($tax_data as $key => $row) { 

                            $total_contribution = 0.0;
                            $total_contribution = floatval($row->soc_sec_npf_tax) + floatval($row->employer_contribution);

                            $total_basic              = $total_basic + floatval($row->basic_salary_pro_rated);
                            $total_soc_sec            = $total_soc_sec + floatval($row->soc_sec_npf_tax);
                            $total_empr_contr         = $total_empr_contr + floatval($row->employer_contribution);
                            $total_soc_sec_and_contr  = $total_soc_sec_and_contr + floatval($total_contribution);

                        ?>

                        <tr style="text-align: center;">
                            <th style="text-align: center;"><?php echo $row->social_security_no;?></th>
                            <td><?php echo $row->first_name.' '.$row->last_name;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$row->basic_salary_pro_rated;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$row->soc_sec_npf_tax;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$row->employer_contribution;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_contribution;?></td>
                            <td></td>
                        </tr>

                         <?php }?>

                        <tr style="background-color: #c3bfbf;color: #000;text-align: center;font-weight: bold;font-size: 14px;">
                            <th></th>
                            <td></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_basic;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_soc_sec;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_empr_contr;?></td>
                            <td><?php echo $setting->currency_symbol.' '.$total_soc_sec_and_contr;?></td>
                            <td></td>
                        </tr>
                    </tbody>

                    <tfoot>
                       <tr>
                            <td colspan="7" class="noborder">
                                <table border="0" width="100%" style="padding-top: 30px;border: none !important;">                                                
                                <tr style="height:50px;padding-top: 30px;border-left: none !important;">
                                    <td align="left" class="noborder" width="30%">
                                        <div class="border-top"><?php echo display('prepared_by')?>: <b><?php echo $user_info['fullname'];?></b></div>
                                    </td>
                                    <td align="left"  class="noborder" width="30%"> <div class="border-top"><?php echo display('checked_by')?></div>
                                    </td>  
                                     <td align="left"  class="noborder" width="20%">
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

<?php }else{?>

    <?php if(!isset($tax_data)){?>

        <div class="panel panel-bd"> 
            
            <div class="panel-body">

                <div class="row mb-10 text-center">
                    <h3 style="color:green;">Please select a date to get the report !</h3>
                </div>

            </div>

        </div>

    <?php }else{?>

    <div class="panel panel-bd"> 
        
        <div class="panel-body">

            <div class="row mb-10 text-center">
                <h3 style="color:red;">No data available, please check for other date !</h3>
            </div>

        </div>

    </div>

<?php }

}?>

<style type="text/css">
    
    .underline {
        border-bottom: 2px solid #000;
    }

    .justify-content-center {
        justify-content: center;
    }

    .d-flex {
        display: flex;
    }

</style>