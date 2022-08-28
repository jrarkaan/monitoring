<!doctype html>
<html>
    <head>
        <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('template/assets/bootstrap/css/bootstrap.min.css') ?>"/>
        
    </head>
    <body>
    <section class="section"> 
    <div class="section-header">
            <h4 style="bold"> Detail Offline Meeting Scheduling </h4>
    </div>
    <div class="card">
    <div class="card-body">
        <table class="table table-bordered" class="table">
	    <tr><td>Emp No</td><td><?php echo $emp_no; ?></td></tr>
	    <tr><td>Nama User</td><td><?php echo $nama_user; ?></td></tr>
	    <tr><td>Phone</td><td><?php echo $phone; ?></td></tr>
	    <tr><td>Nama Ruang</td><td><?php echo $namaruang; ?></td></tr>
	    <tr><td>Jumlah Peserta</td><td><?php echo $jumlah_peserta; ?></td></tr>
	    <tr><td>Nama Kegiatan</td><td><?php echo $nama_kegiatan; ?></td></tr>
	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td>Mulai</td><td><?php echo $mulai; ?></td></tr>
	    <tr><td>Selesai</td><td><?php echo $selesai; ?></td></tr>
	    <tr><td>Pesan</td><td><?php echo $pesan; ?></td></tr>
        <tr><td>Pesan Approve</td><td><?php echo $pesan_approve; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('formonffline') ?>" class="btn btn-warning">Cancel</a></td></tr>
	</table>
    </div>
    </div>
        </body>
</html>