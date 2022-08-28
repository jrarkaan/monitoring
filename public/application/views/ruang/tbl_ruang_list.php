<!doctype html>
<html>
    <head>
        <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        
    </head>

    <body>
    <section class="section"> 
    <div class="section-header">
            <h4 style="bold">List Ruang  </h4>
    </div>
    <div class="card">
    <div class="card-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('ruang/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
        </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('ruang/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('ruang'); ?>" class="btn btn-default">Reset</a>
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
		<th>Kode Ruang</th>
		<th>Nama Ruang</th>
		<th>Maximal Kapasitas</th>
		<th class="center">Action</th>
            </tr><?php
            foreach ($ruang_data as $ruang)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $ruang->kode_ruang ?></td>
			<td><?php echo $ruang->namaruang ?></td>
			<td><?php echo $ruang->maxpesertaruang ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('ruang/read/'.$ruang->id_ruang),'<i class="fas fa-fw fa-eye"> </i>'); 
				echo ' | '; 
				echo anchor(site_url('ruang/update/'.$ruang->id_ruang),'<i class="fas fa-fw fa-wrench"></i>'); 
				echo ' | '; 
				echo anchor(site_url('ruang/delete/'.$ruang->id_ruang),'<i class="fas fa-fw fa-trash-alt"></i>',
                'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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