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
        <h2 style="margin-top:0px">Log_attendance Read</h2>
        <table class="table">
	    <tr><td>Id Class</td><td><?php echo $id_class; ?></td></tr>
	    <tr><td>Id Course</td><td><?php echo $id_course; ?></td></tr>
	    <tr><td>Id User</td><td><?php echo $id_user; ?></td></tr>
	    <tr><td>Date</td><td><?php echo $date; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('log_attendance') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>