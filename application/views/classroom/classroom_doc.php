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
        <h2>Classroom List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Name</th>
		<th>Id User</th>
		<th>Total Student</th>
		
            </tr><?php
            foreach ($classroom_data as $classroom)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $classroom->name ?></td>
		      <td><?php echo $classroom->id_user ?></td>
		      <td><?php echo $classroom->total_student ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>