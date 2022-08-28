<!doctype html>
<html>
    <head>
        <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>

    </head>

    <body>
    <section class="section"> 
    <div class="section-header">
            <h4 style="bold"> Update Data Menu </h4>
    </div>
    <div class="card">
    <div class="card-body">
    
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Menu <?php echo form_error('menu') ?></label>
            <input type="text" class="form-control" name="menu" id="menu" placeholder="menu" 
            value="<?php echo $menu; ?>" />
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('menu') ?>" class="btn btn-warning">Cancel</a>
	</form>
    </div> 
    </div>

    </body>
</html>