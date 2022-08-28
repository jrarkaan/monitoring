<!doctype html>
<html>
    <head>
    <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('template/assets/bootstrap/css/bootstrap.min.css') ?>"/>
  
    </head>
    <body>
    <section class="section"> 
    <div class="section-header">
            <h4 style="bold"> Detail Rooms </h4>
    </div>
    <div class="card">
    <div class="card-body">
        <table class="table table-bordered" >
	    <tr><td>Namaruang</td><td><?php echo $namaruang; ?></td></tr>
	    <tr><td>Maxpesertaruang</td><td><?php echo $maxpesertaruang; ?></td></tr>
	    <tr><td></td><td>
        <a href="<?php echo site_url('c_rooms') ?>" class="btn btn-warning">Cancel</a></td></tr>
	</table>
    </div>
        </div>
        </section>
        </body>
</html>