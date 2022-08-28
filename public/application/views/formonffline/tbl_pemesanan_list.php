<!doctype html>
<html>
    <head>
        <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
    </head>

    <body>
    <section class="section"> 
        <div class="section-header">
            <h4 style="bold">List History Of Your Offline Meeting Scheduling </h4>
        </div>
    </section>

    <div class="card">

        <div class="card-body">

            <div class="row " style="margin-bottom: 10px">
                <div class="col-md-4">
                    <?php echo anchor(site_url('formonffline/create'),'Create New Booking Room', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                    <div>
                        <input id="search" type="text" class="form-control" placeholder="Cari.." aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            <!-- table responsive -->     
            <div class="table-responsive overflow-auto">
                <!-- <?php print_r($formonffline_data_new) ?> -->
                <table class="table table-bordered" id="table-offline">
                    <tr>
                        <th>No</th>
                        <th width="30px">Nama User</th>
                        <th>Nama Ruang</th>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php  foreach ($formonffline_data_new as $formonffline){ ?>
                    <tr>
                        <td width="80px"><?= ++$start ?></td>
                        <td><?= $formonffline->nama_user ?></td>
                        <td width="150px"><?= $formonffline->namaruang ?></td>
                        <td><?= $formonffline->nama_kegiatan ?></td>
                        <td><?= date('d-m-Y', strtotime($formonffline->tanggal)) ?></td>
                        <td><?= ($formonffline->status === "1") ? "<a class='badge badge-info text-white'>Belum di ACC</a>" : ($formonffline->status === "3" ? "<a class='badge badge-success text-white'>Sudah di ACC</a>" : "<a class='badge badge-danger text-white'>Ditolak!</a>") ?></td>
                        <?php if($formonffline->status === "1"){ ?>
                            <td style="text-align:center" width="200px">
                                <a
                                    id="set_detail"
                                    title="Detail"
                                    class="btn btn-info btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#modal-detail"
                                    data-idpemesanan="<?=  $formonffline->id_pemesanan ?>"
                                    data-empno="<?=  $formonffline->emp_no ?>"
                                    data-namauser="<?= $formonffline->nama_user ?>"
                                    data-tanggal="<?= $formonffline->tanggal ?>"
                                    data-namaruang="<?= $formonffline->namaruang ?>"
                                    data-status="<?= $formonffline->status ?>"
                                    data-jumlahpeserta="<?= $formonffline->jumlah_peserta ?>"
                                    data-namakegiatan="<?= $formonffline->nama_kegiatan ?>"
                                    data-mulai="<?= $formonffline->mulai ?>"
                                    data-selesai="<?= $formonffline->selesai ?>"
                                    data-pesan="<?= $formonffline->pesan ?>"
                                ><i class="fas fa-fw fa-info text-white"></i>
                                </a>
                                <a
                                    id="set_detail_hapus-<?= $formonffline->id_pemesanan ?>"
                                    onclick="deleteData((this.id))"
                                    title="Detail"
                                    class="btn btn-danger btn-sm" 
                                ><i class="fas fa-fw fa-trash text-white"></i>
                                </a>
                                <a
                                    id="set_update"
                                    title="Update"
                                    class="btn btn-primary btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#modal-update"
                                    data-idpemesanan="<?=  $formonffline->id_pemesanan ?>"
                                    data-idruang="<?= $formonffline->id_ruang ?>"
                                    data-empno="<?=  $formonffline->emp_no ?>"
                                    data-namauser="<?= $formonffline->nama_user ?>"
                                    data-tanggal="<?= $formonffline->tanggal ?>"
                                    data-namaruang="<?= $formonffline->namaruang ?>"
                                    data-status="<?= $formonffline->status ?>"
                                    data-jumlahpeserta="<?= $formonffline->jumlah_peserta ?>"
                                    data-namakegiatan="<?= $formonffline->nama_kegiatan ?>"
                                    data-mulai="<?= $formonffline->mulai ?>"
                                    data-selesai="<?= $formonffline->selesai ?>"
                                    data-pesan="<?= $formonffline->pesan ?>"
                                    data-pesanapprove="<?= $formonffline->pesan_approve ?>"
                                >
                                    <i class="fas fa-pencil-alt text-white"></i>
                                </a>
                            </td>
                        <?php }else { ?>
                            <td style="text-align:center" width="50px">
                                <?php 
                                    echo anchor(site_url('formonffline/read/'.$formonffline->id_pemesanan),'<i class="fas fa-fw fa-eye"> </i>'); 
                                ?>
                            </td>
                        <?php } ?>
		            </tr>
                    <?php
                         }
                    ?>
                </table>
            </div>
        </div>
        
    </div> <!-- end div card -->
    <!-- modal show -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-detail">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">List Data Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
				    <table class="table table-bordered no-margin">
					    <tbody>
                            <tr>
                                <th style="">Employee Number</th>
                                <td><span id="empno1"></span></td>
                            </tr>
                            <tr>
                                <th>Nama User</th>
                                <td><span id="namauser1"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td><span id="tanggal1"></span></td>
                            </tr>
                            <tr>
                                <th >Nama Ruang</th>
                                <td><span id="namaruang1"></span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><strong style="color: red"><span id="status1"></span></strong></td>
                            </tr>
                            <tr>
                                <th>Jumlah Peserta</th>
                                <td><span id="jumlahpeserta1"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <td><span id="namakegiatan1"></span></td>
                            </tr>
                            <tr>
                                <th>Mulai</th>
                                <td><span id="mulai1"></span></td>
                            </tr>
                            <tr>
                                <th>Selesai</th>
                                <td><span id="selesai1"></span></td>
                            </tr>
                            <tr>
                                <th>Pesan</th>
                                <td><span id="pesan1"></span></td>
                            </tr>
                            <tr>
                                <th>Pesan Admin</th>
                                <td><span id="pesanadmin1"></span></td>
                            </tr>
					    </tbody>
				    </table>
			    </div>
                <div class="modal-footer bg-whitesmoke br" id="buttongroup">
                    
                </div>
            </div>
        </div>
    </div> <!-- end div modal -->

    <!-- modal edit -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-update">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
				    <div>
                        <div class="form-group">
                            <input hidden type="text" class="form-control" name="id_pemesanan" id="id_pemesanan">
                        </div>
                        <div class="form-group">
                            <label for="emp_no" class="col-form-label">Employe Number:</label>
                            <input type="text" class="form-control" name="emp_no" id="emp_no" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_user" class="col-form-label">Nama User:</label>
                            <input type="text" class="form-control" name="nama_user" id="nama_user" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label">Tanggal:</label>
                            <input type="text" class="form-control" name="tanggal" id="tanggal" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status:</label>
                            <input type="text" class="form-control" name="status" id="status" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-form-label">Nama Ruang:</label>
                            <select name="nama_ruang" id="nama_ruang" class="form-control">
                                <!-- <option value="" hidden="true">Choose A Room</option> -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="maxpeserta" class="col-form-label">Max Peserta:</label>
                            <input type="text" class="form-control" name="maxpeserta" id="maxpeserta" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_peserta" class="col-form-label">Jumlah Peserta:</label>
                            <input type="text" class="form-control" name="jumlah_peserta" id="jumlah_peserta">
                        </div>
                        <div class="form-group">
                            <label for="nama_kegiatan" class="col-form-label">Nama Kegiatan:</label>
                            <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan">
                        </div>
                        <div class="form-group">
                            <label for="mulai" class="col-form-label">Mulai:</label>
                            <input type="time" min="07:30"max="17:30"  class="form-control" name="mulai" id="mulai">
                        </div>
                        <div class="form-group">
                            <label for="selesai" class="col-form-label">Selesai:</label>
                            <input type="time" min="07:30"max="17:30" class="form-control" name="selesai" id="selesai">
                        </div>
                        <div class="form-group">
                            <label for="pesan" class="col-form-label">Pesan:</label>
                            <input type="text" class="form-control" name="pesan" id="pesan">
                        </div>
                    </div>
			    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateBooking"><i class="fas fa-pencil-alt text-white"></i></button>
                </div>
            </div>
        </div>
    </div> <!-- modal edit -->
    </body>
</html>

<script>
    $(document).ready(function(){
        
        // live search
        $('#search').keyup(function(){

            const value = this.value.toLowerCase().trim();

            $('#table-offline tr').each(function(index){
                 if(!index) return;
                 $(this).find("td").each(function () {
                    let id = $(this).text().toLowerCase().trim();
                    let not_found = (id.indexOf(value) == -1);
                    $(this).closest('tr').toggle(!not_found);
                    return not_found;
                });
            });

        });

        // detail button
        $(document).on('click', '#set_detail', function(){
            const empno = $(this).data('empno');
            const namauser = $(this).data('namauser');
            const namaruang = $(this).data('namaruang');
            const status = $(this).data('status') === 1 ? "Belum Dikonfirmasi" : "Error";
            const jumlahpeserta = $(this).data('jumlahpeserta');
            const namakegiatan = $(this).data('namakegiatan');
            const mulai = $(this).data('mulai');
            const selesai = $(this).data('selesai');
            const pesan = $(this).data('pesan');
            const id_pemesanan = $(this).data('idpemesanan');
            const tanggal = $(this).data('tanggal');
            const pesanadmin = $(this).data('pesanapprove');

            $('#empno1').text(empno);
            $('#namauser1').text(namauser);
            $('#namaruang1').text(namaruang);
            $('#status1').text(status);
            $('#jumlahpeserta1').text(jumlahpeserta);
            $('#namakegiatan1').text(namakegiatan);
            $('#mulai1').text(mulai);
            $('#selesai1').text(selesai);
            $('#pesan1').text(pesan);
            $('#tanggal1').text(tanggal);
            $('#pesanadmin1').text(pesanadmin);
        });

        // detail button
        $(document).on('click', '#set_update', function(){
            let counterOption = 0;
            const idruang = $(this).data('idruang');
            const empno = $(this).data('empno');
            const namauser = $(this).data('namauser');
            const namaruang = $(this).data('namaruang');
            const status = $(this).data('status') === 1 ? "Belum Dikonfirmasi" : "Error";
            const jumlahpeserta = $(this).data('jumlahpeserta');
            const namakegiatan = $(this).data('namakegiatan');
            const mulai = $(this).data('mulai');
            const selesai = $(this).data('selesai');
            const pesan = $(this).data('pesan');
            const id_pemesanan = $(this).data('idpemesanan');
            const tanggal = $(this).data('tanggal');
                 
            $('#nama_ruang option').each(function(){
                counterOption += 1;
            });
          
            if(counterOption === 0){
                $.ajax({
                    async: true,
                    type: "GET",
                    url: "<?= site_url('formonffline/getRuang') ?>",
                    dataType: "JSON",
                    success: (response)=>{
                        const { ruang } = response;
            
                        for(const value of ruang){
                            $('#nama_ruang').append(`<option value=${value.id_ruang}>${value.namaruang}</option>`);
                            if(Number(idruang) === Number(value.id_ruang)){
                                $('#maxpeserta').val(value.maxpesertaruang).text(value.maxpesertaruang);
                            }
                        }

                    },
                    error: ()=>{
                        alert('Error di Ajax silahkan hubungi Admin!');
                    }
                });
            }

            $.ajax({
                async: true,
                type: "GET",
                url: "<?= site_url('formonffline/getRuang') ?>",
                dataType: "JSON",
                success: (response)=>{
                    const { ruang } = response;
        
                    for(const value of ruang){
                        if(Number(idruang) === Number(value.id_ruang)){
                            $('#maxpeserta').val(value.maxpesertaruang).text(value.maxpesertaruang);
                        }
                    }

                },
                error: ()=>{
                    alert('Error di Ajax silahkan hubungi Admin!');
                }
            });
     
            $('#emp_no').text(empno).val(empno);
            $('#nama_user').text(namauser).val(namauser);
            $(`#nama_ruang`).val(idruang).change();
            $('#status').text(status).val(status);
            $('#jumlah_peserta').text(jumlahpeserta).val(jumlahpeserta);
            $('#nama_kegiatan').text(namakegiatan).val(namakegiatan);
            $('#mulai').text(mulai).val(mulai);
            $('#selesai').text(selesai).val(selesai);
            $('#pesan').text(pesan).val(pesan);
            $('#tanggal').text(tanggal).val(tanggal);
            $('#id_pemesanan').val(id_pemesanan);
        });

    }); // end document ready

    $(document).on('change', '#nama_ruang', function(){
        const nama_ruang = $('#nama_ruang option:selected').val();
        // console.log("nama_ruang", nama_ruang)
        $.ajax({
            async: true,
            type: "GET",
            url: "<?= site_url('formonffline/getRuang') ?>",
            dataType: "JSON",
            success: (response)=>{
                const { ruang } = response;
    
                for(const value of ruang){
                    if(Number(nama_ruang) === Number(value.id_ruang)){
                        // console.log(value.maxpesertaruan)
                        $('#maxpeserta').val(value.maxpesertaruang).text(value.maxpesertaruang);
                    }
                }

            },
            error: ()=>{
                alert('Error di Ajax silahkan hubungi Admin!');
            }
        });
        
    });

    $(document).on('click', '#updateBooking', function(){
        let id_pemesanan = $('#id_pemesanan').val();
        let nama_ruang = $('#nama_ruang option:selected').val();
        let maxpeserta =$('#maxpeserta').val();
        let jumlah_peserta = $('#jumlah_peserta').val();
        let nama_kegiatan = $('#nama_kegiatan').val();
        let mulai = $('#mulai').val();
        let selesai = $('#selesai').val();
        let pesan = $('#pesan').val();
        let tanggal = moment($('#tanggal').val()).format('YYYY/MM/DD');
        const url = "<?= site_url('formonffline/update_ajax') ?>"
        const tanggalMulai = moment(`${tanggal} ${mulai}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');
        const tanggalSelesai = moment(`${tanggal} ${selesai}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');

        if(maxpeserta.length === 0 || jumlah_peserta.length === 0 || nama_kegiatan.length === 0 || mulai.length === 0 || selesai.length === 0 || pesan.length === 0){
            swal.fire("Booking Room", "Jangan ada inputan yang kosong!", "warning");
        }else{

        
            if(tanggalMulai > tanggalSelesai){

                swal.fire('Booking Room', 'Silahkan perhatikan inputan waktu acara anda!', 'info');

            }

            if(Number(jumlah_peserta) > Number(maxpeserta)){
                swal.fire('Booking Room', 'Jangan melebihi kapasitas!', 'info');
            }

            if(tanggalMulai < tanggalSelesai && Number(jumlah_peserta) < Number(maxpeserta)){

                $.ajax({
                    async:true,
                    type: "POST",
                    url: url,
                    dataType: "JSON",
                    data: { 
                        id_pemesanan, nama_ruang, jumlah_peserta,
                        nama_kegiatan, mulai, selesai, pesan 
                    },
                    success:(response)=>{
                        const { pesan, msg, status } = response;
                  
                        if(pesan === "Sukses"){

                            swal.fire({
                                icon: "success",
                                title: "Booking Room", 
                                text: msg,
                                timer: 1000
                            }).then(()=>{

                                window.location.href = "<?= site_url("formonffline") ?>";
                            
                            });

                        }else if(pesan === "Gagal" && status === false){

                            swal.fire("Booking Room", "Error! harap hubungi TIM IT!", "warning");

                        }else{
                            
                            swal.fire("Booking Room", "Error! harap hubungi TIM IT!", "warning");
                        
                        }

                    },
                    error: ()=>{
                        swal.fire("Booking Room", "Error! harap hubungi TIM IT!", "warning");
                    }
                });

            }

        }
    });
    

    function deleteData(idParameter){
        const id = idParameter.substr(17);
        const url = "<?= site_url('formonffline/delete_ajax') ?>"
        swal.fire({
            title: "Booking Room",
            text: "Apakah Anda yakin ingin mengapus Booking ruangan?",
            icon: "info",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Ya`,
            denyButtonText: `Batal`,
        }).then(function(result){
            if(result.isConfirmed){

                $.ajax({
                    async: true,
                    type: "POST",
                    url: url,
                    dataType: "JSON",
                    data: { id },
                    success:(response)=>{
                        const { msg, status, pesan } = response;

                        if(pesan === "Sukses" && status === true){
                            Swal.fire({
                              title: 'Sukses dihapus!',
                              text: msg,
                              icon: 'success',
                              timer: 2000,
                            }).then(() => {
                                window.location.href = "<?= site_url("formonffline") ?>";
                            });
                        }else{
                            swal.fire("Booking Room", msg, "error");
                        }
                    }, 
                    error: ()=>{
                        swal.fire("Booking Room", "Terjadi kesalahan silahkan hubungi admin!", "error");
                    }
                });

            }else if(result.isDenied){
                swal.fire("Booking Room", "Booking hapus telah dibatalkan!", "info");
            }
        });
    }

</script>