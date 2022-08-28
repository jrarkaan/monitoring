<!doctype html>
<html>
    <head>
        <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
    </head>
    <body>
    <section class="section"> 
    <div class="section-header">
            <h3 style="bold">Create New Room </h3>
    </div>
    <div class="card" >
    <div class="card-body">
        <form  action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Kode Ruang <?php echo form_error('kode_ruang') ?></label>
            <input type="text" class="form-control" name="kode_ruang" id="kode_ruang" placeholder="Kode Ruang" value="<?php echo $kode_ruang; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Ruang <?php echo form_error('namaruang') ?></label>
            <input type="text" class="form-control" name="namaruang" id="namaruang" placeholder="Namaruang" value="<?php echo $namaruang; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Maximal Kapasitas <?php echo form_error('maxpesertaruang') ?></label>
            <input type="text" class="form-control" name="maxpesertaruang" id="maxpesertaruang" placeholder="Maxpesertaruang" value="<?php echo $maxpesertaruang; ?>" />
        </div>
	    <input type="hidden" name="id_ruang" value="<?php echo $id_ruang; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ruang') ?>" class="btn btn-default">Cancel</a>
	</form>
    </section>
</div>
</div>
    </body>
</html>