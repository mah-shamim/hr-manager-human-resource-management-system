<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
               <table width="100%" class="table table-striped table-bordered table-hover">
            <tr>
                <th colspan="6">Data Attendance</th>
            </tr>
            <tr>
                <th>sl</th>
                <th>Employee</th>
                <th>Attendance No</th>
                <th>Status</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php
            $idx=1;
           foreach ($attendance as $attendancedata) {
              
            ?>
            <tr>
                <td><?php echo $idx ?></td>
                <td><?php echo $attendancedata->uid ?></td>
                <td><?php echo $attendancedata->id ?></td>
                <td><?php echo $attendancedata->state ?></td>
                <td><?php echo date( "d-m-Y", strtotime( $attendancedata->time ) ) ?></td>
                <td><?php echo date( "H:i:s", strtotime( $attendancedata->time ) ) ?></td>
            </tr>
            <?php
         $idx++; }
            ?>
        </table>
          <?php echo  $links ?>
            </div>
        </div>
    </div>
</div>
 
