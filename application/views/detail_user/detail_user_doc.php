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
        <h2>Detail_user List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id User</th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Address</th>
		
            </tr><?php
            foreach ($detail_user_data as $detail_user)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $detail_user->id_user ?></td>
		      <td><?php echo $detail_user->name ?></td>
		      <td><?php echo $detail_user->email ?></td>
		      <td><?php echo $detail_user->phone ?></td>
		      <td><?php echo $detail_user->address ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>