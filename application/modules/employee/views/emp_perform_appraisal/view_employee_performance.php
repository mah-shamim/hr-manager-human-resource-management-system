<link href="<?php echo base_url('application/modules/employee/assets/css/appraisal_print.css'); ?>" rel="stylesheet" type="text/css"/>

<div class="container" id="print-table">

    <div class="panel panel-default thumbnail"> 
        
        <div class="panel-body">

            <div class="text-right" id="print">
               <button type="button" class="btn btn-warning" id="btnPrint" onclick="printDiv();"><i class="fa fa-print"></i></button>
                
            </div>

            <br>

            <div id="printArea">

                <div style="padding: 20px;">

                     <div class="row">
                        <div class="col-xs-3">
                            <img class="" style="margin-top: -10px;" src="<?php echo base_url('/').$setting->logo;?>" alt="">
                        </div>
                        <div class="col-xs-5">
                            <h3 style="text-align:center;"><?php echo $performance_year?$performance_year:'';?> PERFOMANCE APPRAISAL</h3>
                        </div>
                        <div class="col-xs-4" style="text-align:right;">
                            <span>Serial No: <?php echo $perform_sl?$perform_sl:'';?></span>
                        </div>
                    </div>

                    <div class="row mt-20">
                        <div class="col-xs-6 mb-20">
                            <div class="row">
                                <div class="col-xs-5">
                                    <span class="fs-16 fw-700">Name of Employee:</span>
                                </div>
                                <div class="col-xs-7 d-flex justify-content-center" style="border-bottom: 1px solid #000;">
                                    <span class="fs-16"><?php echo $empplyee_name?$empplyee_name:'';?></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-6 mb-20">
                            <div class="row">
                                <div class="col-xs-4">
                                    <span class="fs-16 fw-700">Department:</span>
                                </div>
                                <div class="col-xs-8 d-flex justify-content-center" style="border-bottom: 1px solid #000;">
                                    <span class="fs-16"><?php echo $department_name?$department_name:'';?></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-6 mb-20">
                            <div class="row">
                                <div class="col-xs-4">
                                    <span class="fs-16 fw-700">Job Title:</span>
                                </div>
                                <div class="col-xs-8 d-flex justify-content-center" style="border-bottom: 1px solid #000;">
                                    <span class="fs-16"><?php echo $job_title?$job_title:'';?></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-6 mb-20">
                            <div class="row">
                                <div class="col-xs-4">
                                    <span class="fs-16 fw-700">Review Period:</span>
                                </div>
                                <div class="col-xs-8 d-flex justify-content-center" style="border-bottom: 1px solid #000;">
                                    <span class="fs-16"><?php echo $review_period?$review_period:'';?></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 mb-20">
                            <div class="row">
                                <div class="col-xs-5">
                                    <span class="fs-16 fw-700">Name and Position of Supervisor/Head of Department :</span>
                                </div>
                                <div class="col-xs-7 d-flex justify-content-center" style="border-bottom: 1px solid #000;">
                                    <span class="fs-16"><?php echo $position_of_supervisor?$position_of_supervisor:'';?></span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col-xs-12">
                            <p class="fs-17 mb-20 fs-i">Please provide a critical assessment of the performance of the employee within the review period using the following rating scale. Provide examples where applicable. Please use a separate sheet if required.
                            </p>
                        </div>
                    </div>

                    <table class="table table-bordered w-65">
                        <thead>
                            <tr>
                                <th>P</th>
                                <th>NI</th>
                                <th>G</th>
                                <th>VG</th>
                                <th>E</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Poor</td>
                                <td>Needs Improvement</td>
                                <td>Good</td>
                                <td>Very Good</td>
                                <td>Excellent</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <h3 class="mb-20">A. ASSESSMENT OF GOALS/OBJECTIVES SET DURING THE REVIEW PERIOD</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Criteria</th>
                                    <th>P <br> (0)</th>
                                    <th>NI <br> (3)</th>
                                    <th>G <br> (6)</th>
                                    <th>VG <br> (9)</th>
                                    <th>E <br> (12)</th>
                                    <th>Score</th>
                                    <th>Comments and Examples</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Demonstrated Knowledge of duties & Quality of Work</td>
                                    <td><?php if($demonstrated == 0){echo '0';}?></td>
                                    <td><?php if($demonstrated == 3){echo '3';}?></td>
                                    <td><?php if($demonstrated == 6){echo '6';}?></td>
                                    <td><?php if($demonstrated == 9){echo '9';}?></td>
                                    <td><?php if($demonstrated == 12){echo '12';}?></td>
                                    <td><?php echo $demonstrated_score;?></td>
                                    <td><?php echo $demonstrated_comments;?></td>
                                </tr>
                                <tr>
                                    <td>Timeliness of Delivery</td>
                                    <td><?php if($timeliness == 0){echo '0';}?></td>
                                    <td><?php if($timeliness == 3){echo '3';}?></td>
                                    <td><?php if($timeliness == 6){echo '6';}?></td>
                                    <td><?php if($timeliness == 9){echo '9';}?></td>
                                    <td><?php if($timeliness == 12){echo '12';}?></td>
                                    <td><?php echo $timeliness_score;?></td>
                                    <td><?php echo $timeliness_score_commnets;?></td>
                                </tr>
                                <tr>
                                    <td>Impact of Achievement</td>
                                    <td><?php if($impact == 0){echo '0';}?></td>
                                    <td><?php if($impact == 3){echo '3';}?></td>
                                    <td><?php if($impact == 6){echo '6';}?></td>
                                    <td><?php if($impact == 9){echo '9';}?></td>
                                    <td><?php if($impact == 12){echo '12';}?></td>
                                    <td><?php echo $impact_score;?></td>
                                    <td><?php echo $impact_score_commnets;?></td>
                                </tr>
                                <tr>
                                    <td>Overall Achievement of Goals/Objectives</td>
                                    <td><?php if($overall == 0){echo '0';}?></td>
                                    <td><?php if($overall == 3){echo '3';}?></td>
                                    <td><?php if($overall == 6){echo '6';}?></td>
                                    <td><?php if($overall == 9){echo '9';}?></td>
                                    <td><?php if($overall == 12){echo '12';}?></td>
                                    <td><?php echo $overall_score;?></td>
                                    <td><?php echo $overall_score_commnets;?></td>
                                </tr>
                                <tr>
                                    <td>Overall Achievement of Goals/Objectives</td>
                                    <td colspan="5">Extra (6, 9, or 12) bonus points to be <br> earned for going beyond the call of duty</td>
                                    <td><?php echo $beyond_duty;?></td>
                                    <td><?php echo $beyond_duty_commnets;?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="5">Total Score (Maximum = 60)</td>
                                    <td><?php echo $assesment_a_total_score;?></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="row">
                        <h3 class="mb-20">B. ASSESSMENT OF OTHER PERFORMANCE STANDARDS AND INDICATORS</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Criteria</th>
                                    <th>P <br> (2)</th>
                                    <th>NI <br> (4)</th>
                                    <th>G <br> (6)</th>
                                    <th>VG <br> (9)</th>
                                    <th>E <br> (10)</th>
                                    <th>Score</th>
                                    <th>Comments and Examples</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Interpersonal skills & ability to work in a team environment</td>
                                    <td><?php if($interpersonal == 2){echo '2';}?></td>
                                    <td><?php if($interpersonal == 4){echo '4';}?></td>
                                    <td><?php if($interpersonal == 6){echo '6';}?></td>
                                    <td><?php if($interpersonal == 9){echo '9';}?></td>
                                    <td><?php if($interpersonal == 10){echo '10';}?></td>
                                    <td><?php echo $interpersonal_score;?></td>
                                    <td><?php echo $interpersonal_commnets;?></td>
                                </tr>
                                <tr>
                                    <td>Attendance and Punctuality</td>
                                    <td><?php if($attendance == 2){echo '2';}?></td>
                                    <td><?php if($attendance == 4){echo '4';}?></td>
                                    <td><?php if($attendance == 6){echo '6';}?></td>
                                    <td><?php if($attendance == 9){echo '9';}?></td>
                                    <td><?php if($attendance == 10){echo '10';}?></td>
                                    <td><?php echo $attendance_score;?></td>
                                    <td><?php echo $attendance_commnets;?></td>
                                </tr>
                                <tr>
                                    <td>Communication Skills</td>
                                    <td><?php if($communication == 2){echo '2';}?></td>
                                    <td><?php if($communication == 4){echo '4';}?></td>
                                    <td><?php if($communication == 6){echo '6';}?></td>
                                    <td><?php if($communication == 9){echo '9';}?></td>
                                    <td><?php if($communication == 10){echo '10';}?></td>
                                    <td><?php echo $communication_score;?></td>
                                    <td><?php echo $communication_commnets;?></td>
                                </tr>
                                <tr>
                                    <td>Contributing to company mission)</td>
                                    <td><?php if($contributing == 2){echo '2';}?></td>
                                    <td><?php if($contributing == 4){echo '4';}?></td>
                                    <td><?php if($contributing == 6){echo '6';}?></td>
                                    <td><?php if($contributing == 9){echo '9';}?></td>
                                    <td><?php if($contributing == 10){echo '10';}?></td>
                                    <td><?php echo $contributing_score;?></td>
                                    <td><?php echo $contributing_commnets;?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="5">Total Score (Maximum = 60)</td>
                                    <td><?php echo $assesment_b_total_score;?></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <h3 class="mb-20">C. TOTAL SCORE</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Total Score (Score A + Score B)</th>
                                    <th>Overall Comments / Recommendations by Reviewer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="border: solid white !important;">
                                            <tr style="border: 0px;">
                                                <th style="padding: 10px; border: solid white !important;"><?php echo $assesment_a_total_score;?></th>
                                                <th style="padding: 10px; border: solid white !important;">+</th>
                                                <th style="padding: 10px; border: solid white !important;"><?php echo $assesment_b_total_score;?></th>
                                                <th style="padding: 10px; border: solid white !important;">=</th>
                                                <th style="padding: 10px; border: solid white !important;"><?php echo $score_final;?></th>
                                            </tr>
                                        </table>
                                        <div>
                                            <p class="fw-700">Classification of Employee:</p>
                                        </div>
                                        <table style="border: solid white !important;">
                                            <tr>
                                                <th style="padding: 5px; text-align: center; border: solid white !important;">EE</th>
                                                <th style="padding: 5px; text-align: center; border: solid white !important;">AE</th>
                                                <th style="padding: 5px; text-align: center; border: solid white !important;">UE</th>
                                            </tr>
                                            <tr>
                                                <th style="padding: 10px; border: solid white !important;">(80-100)</th>
                                                <th style="padding: 10px; border: solid white !important;">(75-85)</th>
                                                <th style="padding: 10px; border: solid white !important;">(0-70)</th>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="fw-700">Name:</p>
                                        </div>
                                        <div>
                                            <p class="fw-700">Signature:</p>
                                        </div>
                                        <div>
                                            <p class="fw-700">Date:</p>
                                        </div>
                                        <div>
                                            <p class="fw-700">Next Review Period:</p>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>


                    <div class="row">
                        <div class="col-xs-12">
                            <p class="fs-17 mb-20 fs-i">* If employee is an Unacceptably Performing Employee, please attach a Performance Improvement Plan (PIP)</p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <h3 class="mb-20">COMMENTS BY EMPLOYEE</h3>
                        <div class="form-group">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $employee_comments;?></textarea>
                        </div>
                    </div>
                    <div class="row mt-20">
                        <div class="col-xs-4">
                            <p>Name:</p>
                        </div>
                        <div class="col-xs-4">
                            <p>Signature:</p>
                        </div>
                        <div class="col-xs-4">
                            <p>Date:</p>
                        </div>
                    </div>

                    <br>
                    
                    <div class="row">
                        <h3 class="mb-20">E. DEVELOPMENT PLAN</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="20%">Recommended Areas for Improvement / Development</th>
                                    <th width="30%">Expected Outcome(s)</th>
                                    <th width="20%"> Responsible Person(s) to assist in the achievement of the Plan</th>
                                    <th width="15%">Start Date</th>
                                    <th width="15%">End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($development_plans as $key => $row) { ?>
                                
                                <tr>
                                    <td><?php echo $row->recommand_areas;?></td>
                                    <td>
                                        <?php echo $row->expected_outcomes;?>
                                    </td>
                                    <td><?php echo $row->responsible_person;?></td>
                                    <td><?php echo $row->start_date;?></td>
                                    <td><?php echo $row->end_date;?></td>
                                </tr>

                                <?php }?>

                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <h3 class="mb-20">F. KEY GOALS FOR NEXT REVIEW PERIOD</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Goal (s) Set and Agreed on with Employee</th>
                                    <th>Proposed Completion Period</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($data_key_goals as $key => $row) { ?>

                                <tr>
                                    <td><?php echo $row->key_goals;?></td>
                                    <td><?php echo $row->completion_period;?></td>
                                </tr>

                                <?php }?>

                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-20">
                        <h3 class="mb-20">G. REVIEW / COMMENTS</h3>
                        <div class="col-xs-4">
                            <p>Name:</p>
                        </div>
                        <div class="col-xs-4">
                            <p>Signature:</p>
                        </div>
                        <div class="col-xs-4">
                            <p>Date:</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>