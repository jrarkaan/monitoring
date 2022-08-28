<!doctype html>
<html>
    <head>
    <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('template/assets/bootstrap/css/bootstrap.min.css') ?>"/>
  
    </head>
    <body>
    <section class="section"> 
    <div class="section-header">
            <h4 style="bold"> List of Rooms </h4>
    </div>
    <div class="card">
    <div class="card-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('c_rooms/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('c_rooms/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('c_rooms'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Namaruang</th>
		<th>Maxpesertaruang</th>
		<th>Action</th>
            </tr><?php
            foreach ($c_rooms_data as $c_rooms)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $c_rooms->namaruang ?></td>
			<td><?php echo $c_rooms->maxpesertaruang ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('c_rooms/read/'.$c_rooms->id_ruang),'Read'); 
				echo ' | '; 
				echo anchor(site_url('c_rooms/update/'.$c_rooms->id_ruang),'Update'); 
				echo ' | '; 
				echo anchor(site_url('c_rooms/delete/'.$c_rooms->id_ruang),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
        </div>
        </section>
    </body>
</html>