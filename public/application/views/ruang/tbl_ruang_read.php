<!doctype html>
<html>
    <head>
        <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        
    </head>
    <body>
    <section class="section"> 
    <div class="section-header">
            <h2 style="bold">Tabel Ruang PT KSS</h2>
    </div>
    <div class="card">
    <div class="card-body">
        <table class="table table-bordered">
	    <tr><td>Kode Ruang</td><td><?php echo $kode_ruang; ?></td></tr>
	    <tr><td>Nama Ruang</td><td><?php echo $namaruang; ?></td></tr>
	    <tr><td>Maximal Kapasitas</td><td><?php echo $maxpesertaruang; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('ruang') ?>" class="btn btn-primary">Back</a></td></tr>
	</table>
    </div>
    </div>
    </section>
        </body>
</html>