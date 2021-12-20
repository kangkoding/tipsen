<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Detail_log_attendance Read</h2>
        <table class="table">
	    <tr><td>Id Log Attendance</td><td><?php echo $id_log_attendance; ?></td></tr>
	    <tr><td>Id Student</td><td><?php echo $id_student; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $description; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('detail_log_attendance') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>