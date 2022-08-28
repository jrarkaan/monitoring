<!doctype html>
<html>
    <head>
        <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>

    </head>

    <body>
    <section class="section"> 
    <div class="section-header">
            <h4 style="bold"> Update Sub Menu </h4>
    </div>
    <div class="card">
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <form action="<?php echo base_url('submenu1/editsm/') . $getsubmenu['id']; ?>" method="post">
        <div class="form-group">
            <label for="varchar"> MENU </label>
            <select name="menu_id" id="menu_id" class="form-control">
                <option value="">Select Menu</option>
                <?php foreach ($menu as $m) : ?>
                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('menu_id', '<small class="text-danger pl-3">', '</small>')?>
        </div>
        <div class="form-group">
            <label for="varchar"> TITLE </label>
            <input type="text" class="form-control" name="title" id="title" placeholder="title" 
            value="<?php echo $getsubmenu['title']; ?>" value="<?= set_value ('title');?>" />
            <?= form_error('title', '<small class="text-danger pl-3">', '</small>')?>
        </div>
        <div class="form-group">
            <label for="varchar"> URL </label>
            <input type="text" class="form-control" name="url" id="url" placeholder="url" 
            value="<?php echo $getsubmenu['url']; ?>"  value="<?= set_value ('url');?>"/>
            <?= form_error('url', '<small class="text-danger pl-3">', '</small>')?>
        </div>
        <div class="form-group">
            <label for="varchar"> ICON </label>
            <input type="text" class="form-control" name="icon" id="icon" placeholder="icon" 
            value="<?php echo $getsubmenu['icon']; ?>" value="<?= set_value ('icon');?>" />
            <?= form_error('icon', '<small class="text-danger pl-3">', '</small>')?>
        </div>
        <input type="hidden" name="id" value="<?php echo $getsubmenu['id']; ?>" /> 
        <button type="submit" class="btn btn-primary">Edit</button> 
	    <a href="<?php echo site_url('menu/submenu') ?>" class="btn btn-warning">Cancel</a>
	</form>
    </div> 
    </div>

    </body>
</html>