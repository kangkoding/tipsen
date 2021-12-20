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
        <h2 style="margin-top:0px">Detail_log_attendance <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Log Attendance <?php echo form_error('id_log_attendance') ?></label>
            <input type="text" class="form-control" name="id_log_attendance" id="id_log_attendance" placeholder="Id Log Attendance" value="<?php echo $id_log_attendance; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Student <?php echo form_error('id_student') ?></label>
            <input type="text" class="form-control" name="id_student" id="id_student" placeholder="Id Student" value="<?php echo $id_student; ?>" />
        </div>
	    <div class="form-group">
            <label for="description">Description <?php echo form_error('description') ?></label>
            <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"><?php echo $description; ?></textarea>
        </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('detail_log_attendance') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>