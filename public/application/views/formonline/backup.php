<!doctype html>
<html>
<head>
    <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
    </head>
    <body>
        
        <section class="section"> 
          <div class="section-header">
            <h4 style="bold"> Formulir Permintaan Persiapan Meeting Online </h4>
         </div>  
            <div class="card">
              <div class="card-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php echo anchor(site_url('formonline/create'),'Create', 'class="btn btn-primary"'); ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                    </div>
                    <div class="col-md-3 text-right">
                        
                    </div>
                </div>

        <!-- table responsive -->     
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="30px">No</th>
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
                        <th width="350px">Action</th>
                    </tr><?php
                    foreach ($formonline_data as $formonline)
                    {
                        ?>
                        <tr>
                            <td width="80px"><?php echo ++$start ?></td>
                            <td><?php echo $formonline->emp_no ?></td>
                            <td><?php echo $formonline->nama_user ?></td>
                            <td><?php echo $formonline->phone ?></td>
                            <td><?php echo $formonline->namaruang ?></td>
                            <td><?php echo $formonline->jumlah_peserta ?></td>
                            <td><?php echo $formonline->nama_kegiatan ?></td>
                            <td><?php echo $formonline->nama_aplikasi ?></td>
                            <td><?php echo $formonline->email ?></td>
                            <td><?php echo $formonline->password ?></td>
                            <td><?php echo $formonline->tanggal ?></td>
                            <td><?php echo $formonline->mulai ?></td>
                            <td><?php echo $formonline->selesai ?></td>
                            <td><?php echo $formonline->daftar_peserta ?></td>
                            <td style="text-align:center" width="200px">
                            <?php 
                                echo anchor(site_url('formonline/read/'.$formonline->id_pemesanan),'<i class="fas fa-fw fa-eye"> </i>'); 
                                echo ' | '; 
                                echo anchor(site_url('formonline/update/'.$formonline->id_pemesanan),'<i class="fas fa-fw fa-wrench"></i>'); 
                                echo ' | '; 
                                echo anchor(site_url('formonline/delete/'.$formonline->id_pemesanan),'<i class="fas fa-fw fa-trash-alt"></i>',
                                'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                            ?>
                    </td>
                </tr>
                        <?php
                    }
                    ?>
                </table>
                </div>
               
                </div>
            </div>
        </div>
    </body>
</html>