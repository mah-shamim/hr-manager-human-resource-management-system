<link href="<?php echo MOD_URL.'projectmanagement/assets/css/pm_kanban_board.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd">

            <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                    	<?php

                    	$project_sprint = $this->db->select('pm_sprints.*,p.project_name') 
						             ->from('pm_sprints')
						             ->join('pm_projects p', 'pm_sprints.project_id = p.project_id', 'left')
						             ->where('pm_sprints.sprint_id',$sprint_id)
						             ->get()
						             ->row();

                    	?>
                        <h4><?php echo $title; ?> <?php if($project_sprint->sprint_name){ echo "(".$project_sprint->sprint_name.")";} ?></h4>
                    </div>

             </div>

            <div class="panel-body">
            	
				<div class="task-board">

					<div class="task-board-cards">
				    <?php
				    foreach ($statusResult as $statusRow) {

				        $taskResult = $this->db->select('pm_tasks_list.*,e.first_name,e.last_name,epid.first_name as ep_firstname,epid.last_name as ep_lastname,p.project_name,pms.sprint_name') 
						             ->from('pm_tasks_list')
						             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
						             ->join('pm_sprints pms', 'pm_tasks_list.sprint_id = pms.sprint_id', 'left')
						             ->join('employee_history e', 'pm_tasks_list.project_lead = e.employee_id', 'left')
						             ->join('employee_history epid', 'pm_tasks_list.employee_id = epid.employee_id', 'left')
						             ->where('pm_tasks_list.project_id',$project_id)
						             ->where('pm_tasks_list.employee_id',$employee_id)
						             ->where('pm_tasks_list.sprint_id',$sprint_id)
						             ->where('pm_tasks_list.task_status',$statusRow["id"])
						             ->order_by('pm_tasks_list.task_id','desc')
						             ->get()
						             ->result();
				        ?>
				        <div class="status-card">
				            <div class="kanban-card-header">
				                <span class="card-header-text"><?php echo $statusRow["status_name"]; ?></span>
				            </div>
				                <ul class="sortable ui-sortable"

				                    id="sort<?php echo $statusRow["id"]; ?>"
				                    data-status-id="<?php echo $statusRow["id"]; ?>">

				                    <?php
				                    if (! empty($taskResult)) {
				                        foreach ($taskResult as $taskRow) {
				                        ?>

				                            <li class="text-row ui-sortable-handle" data-task-id="<?php echo $taskRow->task_id; ?>"><?php echo $taskRow->summary; ?></li>

				                        <?php
				                        }
				                    }
				                    ?>
				                </ul>
				        </div>
				        <?php
				    }
				    ?>

					</div>    
				</div>

            </div>
        </div>
    </div>
</div>






<script src="<?php echo MOD_URL.'projectmanagement/assets/js/project_common.js'; ?>" type="text/javascript"></script>