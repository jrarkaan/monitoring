<!doctype html>
<html>
    <head>
        <title>PT Karimun Sembawang Shipyard</title>
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
        <h2>List permintaan persiapan rapat</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Emp No</th>
		<th>Nama User</th>
		<th>Phone</th>
		<th>Nama Ruang</th>
		<th>Jumlah Peserta</th>
		<th>Nama Kegiatan</th>
		<th>Aplikasi</th>
		<th>Email</th>
		<th>Password</th>
		<th>Tanggal</th>
		<th>Mulai</th>
		<th>Selesai</th>
		<th>Daftar Peserta</th>
		
            </tr><?php
            foreach ($formonline_data as $formonline)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $formonline->emp_no ?></td>
		      <td><?php echo $formonline->nama_user ?></td>
		      <td><?php echo $formonline->phone ?></td>
		      <td><?php echo $formonline->namaruang ?></td>
		      <td><?php echo $formonline->jumlah_peserta ?></td>
		      <td><?php echo $formonline->nama_kegiatan ?></td>
		      <td><?php echo $formonline->aplikasi ?></td>
		      <td><?php echo $formonline->email ?></td>
		      <td><?php echo $formonline->password ?></td>
		      <td><?php echo $formonline->tanggal ?></td>
		      <td><?php echo $formonline->mulai ?></td>
		      <td><?php echo $formonline->selesai ?></td>
		      <td><?php echo $formonline->daftar_peserta ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>