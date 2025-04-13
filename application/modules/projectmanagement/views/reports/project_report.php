<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
	<div class="col-sm-12 col-md-6 donut-chart">

        <div class="panel panel-bd lobidisable">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Donut chart for <?php echo $project_info->project_name;?></h4>
                </div>
            </div>
            <div class="panel-body">
                <canvas id="doughnutChart" height="200"></canvas>
            </div>
        </div>

	</div>

	<div class="col-sm-12 col-md-6 bar-chart">

		<div class="panel panel-bd lobidisable">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Bar chart</h4>
                </div>
            </div>
            <div class="panel-body">
                <canvas id="barChart" height="200"></canvas>
            </div>
        </div>

	</div>
</div>


<div class="row">
	<div class="col-sm-12 col-md-4 pie-chart">

		<div class="panel panel-bd lobidisable">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Pie chart for <?php echo $project_info->project_name;?></h4>
                </div>
            </div>
            <div class="panel-body">
                <canvas id="pieChart" height="310"></canvas>
            </div>
        </div>

	</div>

	<div class="col-sm-12 col-md-8 two-dimentional">

        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Two Dimentional</h4>
                </div>
            </div>
            <div class="panel-body">
                
                <div class="table-responsive">

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo display("team_member");?></th>
                                <th class="text-center"><?php echo display("to_do");?></th>
                                <th class="text-center"><?php echo display("in_progress");?></th>
                                <th class="text-center"><?php echo display("done");?></th>
                                <th class="text-center"><?php echo display("total");?></th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 

                            $total_to_do = 0;
                            $total_in_progress = 0;
                            $total_done = 0;

                            $total = 0;
                            $grand_total = 0;

                            foreach ($project_all_employees_id as $employee_id) {

                                $employee_info = $this->db->select('first_name,last_name')
                                    ->from('employee_history')
                                    ->where('employee_id', $employee_id)
                                    ->get()
                                    ->row();

                                 $num_of_todo_tasks = $this->db->select('*')
                                    ->from('pm_tasks_list')
                                    ->where('project_id', $project_id)
                                    ->where('employee_id', $employee_id)
                                    ->where('task_status', 1)
                                    ->get()
                                    ->num_rows();

                                $num_of_inprogress_tasks = $this->db->select('*')
                                    ->from('pm_tasks_list')
                                    ->where('project_id', $project_id)
                                    ->where('employee_id', $employee_id)
                                    ->where('task_status', 2)
                                    ->get()
                                    ->num_rows();

                                $num_of_done_tasks = $this->db->select('*')
                                    ->from('pm_tasks_list')
                                    ->where('project_id', $project_id)
                                    ->where('employee_id', $employee_id)
                                    ->where('task_status', 3)
                                    ->get()
                                    ->num_rows();

                                $total_to_do = $total_to_do + $num_of_todo_tasks;
                                $total_in_progress = $total_in_progress + $num_of_inprogress_tasks;
                                $total_done = $total_done + $num_of_done_tasks;

                                $total = (int)$num_of_todo_tasks + (int)$num_of_inprogress_tasks + (int)$num_of_done_tasks;
                                $grand_total = $grand_total + $total;

                            ?>

                            <tr>
                                <td class="text-center"><?php echo $employee_info->first_name.' '.$employee_info->last_name;?></td>
                                <td class="text-center"><?php echo $num_of_todo_tasks;?></td>
                                <td class="text-center"><?php echo $num_of_inprogress_tasks;?></td>
                                <td class="text-center"><?php echo $num_of_done_tasks;?></td>
                                <td class="text-center"><?php echo $total;?></td>
                            </tr>

                            <?php } ?>

                        </tbody>

                        <tfoot>
                            <tr>
                                <td class="text-center"><b><?php echo "Grand ".display('total') ?></b></td>
                                <td class="text-center"><?php echo $total_to_do;?></td>
                                <td class="text-center"><?php echo $total_in_progress;?></td>
                                <td class="text-center"><?php echo $total_done;?></td>
                                <td class="text-center"><?php echo $grand_total;?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

	</div>
</div>

<!-- =============================================== -->

<script src="<?php echo MOD_URL.'projectmanagement/assets/js/project_report.js'; ?>" type="text/javascript"></script>