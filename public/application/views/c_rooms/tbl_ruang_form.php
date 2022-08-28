
<!doctype html>
<html>
    <head>
    <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('template/assets/bootstrap/css/bootstrap.min.css') ?>"/>
  
    </head>
    <body>
    <section class="section"> 
    <div class="section-header">
            <h4 style="bold"> Create New Room </h4>
    </div>
    <div class="card">
    <div class="card-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar"> Room Name <?php echo form_error('namaruang') ?></label>
            <input type="text" class="form-control" name="namaruang" id="namaruang" placeholder="Namaruang" value="<?php echo $namaruang; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Maximum Number of Participants <?php echo form_error('maxpesertaruang') ?></label>
            <input type="text" class="form-control" name="maxpesertaruang" id="maxpesertaruang" placeholder="Maxpesertaruang" value="<?php echo $maxpesertaruang; ?>" />
        </div>
	    <input type="hidden" name="id_ruang" value="<?php echo $id_ruang; ?>" /> 
	    <button type="submit" class="btn btn-primary"> Save </button> 
	    <a href="<?php echo site_url('c_rooms') ?>" class="btn btn-warning">Cancel</a>
	</form>
    </div>
    </div>
    </section>
    </body>
</html>