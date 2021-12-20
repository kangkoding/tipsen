<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Detail_log_attendance List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Log Attendance</th>
		<th>Id Student</th>
		<th>Description</th>
		
            </tr><?php
            foreach ($detail_log_attendance_data as $detail_log_attendance)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $detail_log_attendance->id_log_attendance ?></td>
		      <td><?php echo $detail_log_attendance->id_student ?></td>
		      <td><?php echo $detail_log_attendance->description ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>