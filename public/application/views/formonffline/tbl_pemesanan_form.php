<!doctype html>
<html>
    <head>
        <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('/template/assets/bootstrap/css/bootstrap.min.css') ?>"/>
        
    </head>

    <body>
    <section class="section"> 
        <div class="section-header">
            <h4 style="bold"> Offline Meeting Scheduling Form </h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="post" id="formaaction">
                    <div class="form-group" class="col-lg">
                        <label for="int">Emp No <?php echo form_error('emp_no') ?></label>
                        <input 
                            name="emp_no" 
                            id="emp_no" 
                            type="text" 
                            class="form-control" 
                            placeholder="Emp No" 
                            value="<?= $informationUser[0]['emp_no'] ?>" 
                            readonly
                        />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Name <?php echo form_error('nama_user') ?></label>
                        <input 
                            name="nama_user" 
                            id="nama_user" 
                            type="text" 
                            class="form-control" 
                            placeholder="Nama User" 
                            value="<?= $informationUser[0]['nama_user'] ?>"
                            readonly 
                        />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Phone <?php echo form_error('phone') ?></label>
                        <input 
                            name="phone" 
                            id="phone" 
                            type="text" 
                            class="form-control" 
                            placeholder="Phone"
                            value="<?= $informationUser[0]['phone'] ?>"
                            readonly 
                        />
                    </div>
                    <div class="form-group">
                        <label for="varchar"> Name of Room <?php echo form_error('namaruang') ?></label>
                        <select name="namaruang" id="namaruang" class="form-control">
                            <option value="" hidden="true">Choose A Room</option>
                            <?php foreach ($room as $ruang) : ?>
                                <option value="<?= $ruang['id_ruang']; ?>"><?= $ruang['namaruang']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="maxpeserta" class="col-form-label">Max Peserta:</label>
                        <input type="text" class="form-control" name="maxpeserta" id="maxpeserta" readonly>
                    </div>
                    <div class="form-group">
                        <label for="int"> Number Of Participants <?php echo form_error('jumlah_peserta') ?></label>
                        <input 
                            name="jumlah_peserta" 
                            id="jumlah_peserta" 
                            type="text" 
                            class="form-control" 
                            placeholder="Jumlah Peserta" 
                            value="<?php echo $jumlah_peserta; ?>" 
                        />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Name of Activity <?php echo form_error('nama_kegiatan') ?></label>
                        <input 
                            name="nama_kegiatan" 
                            id="nama_kegiatan" 
                            type="text" 
                            class="form-control" 
                            placeholder="Nama Kegiatan" 
                            value="<?php echo $nama_kegiatan; ?>" 
                        />
                    </div>
                    <div class="form-group datepicker">
                        <label for="date"> Date <?php echo form_error('tanggal') ?></label>
                        <input 
                            name="tanggal" 
                            id="date" 
                            type="text" 
                            class="form-control" 
                            placeholder="Tanggal"  
                        />
                    </div>
                    <div class="form-group">
                        <label for="time"> Start Form <?php echo form_error('mulai') ?></label>
                        <input 
                            name="mulai" 
                            id="mulai" 
                            type="time" 
                            min="07:00" max="17:30" 
                            class="form-control" 
                            placeholder="Mulai" 
                            value="<?php echo $mulai; ?>" 
                        />
                    </div>
                    <div class="form-group">
                        <label for="time"> End at<?php echo form_error('selesai') ?></label>
                        <input 
                            name="selesai" 
                            id="selesai" 
                            type="time" 
                            min="07:30"max="17:30" 
                            class="form-control" 
                            placeholder="Berakhir pada" 
                            value="<?php echo $selesai; ?>" 
                        />
                    </div>
                    <div class="form-group">
                        <label for="varchar"> Massage <?php echo form_error('pesan') ?></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            name="pesan" 
                            id="pesan" 
                            placeholder="If Empty Please Input '-'"
                            value="<?php echo $pesan; ?>" 
                        />
                    </div>
                    <input type="hidden" name="id_pemesanan" value="<?php echo $id_pemesanan; ?>" /> 
                    <button type="submit" class="btn btn-primary"> Save </button> 
                    <a href="<?php echo site_url('formonffline') ?>" class="btn btn-warning">Cancel</a>
                </form>
            </div> 
        </div>
    </section>                         
    </body>
</html>

<script>

    $(document).ready(function() {

        $("#date").datepicker({ 
            minDate: 0
        });
    
    });

    $(document).on('change', '#namaruang', function(){
        const nama_ruang = $('#namaruang option:selected').val();
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

    $("#formaaction").submit((e)=>{

        e.preventDefault();

        const maxpeserta = $('#maxpeserta').val();
        const emp_no = $('#emp_no').val();
        const nama_user = $('#nama_user').val();
        const phone = $('#phone').val();
        const idRuang = $('#namaruang').val();
        const jumlahPeserta = $('#jumlah_peserta').val();
        const namaKegiatan = $('#nama_kegiatan').val();
        const tanggal = moment($('#date').val()).format('YYYY/MM/DD');
        const mulai = $('#mulai').val();
        const selesai = $('#selesai').val();
        const pesan = $('#pesan').val();
        const tanggalMulai = moment(`${tanggal} ${mulai}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');
        const tanggalSelesai = moment(`${tanggal} ${selesai}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');
        const url = "<?= site_url('formonffline/create_action') ?>";

        swal.fire({
            title: "Booking Room",
            text: "Apakah Anda yakin ingin melakukan Booking ruangan?",
            icon: "info",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Ya`,
            denyButtonText: `Batal`,
        }).then(function(result){

            if(result.isConfirmed){
                
                if(idRuang.length === 0 || jumlahPeserta.length === 0 || namaKegiatan.length === 0 || tanggal === "Invalid date" || mulai.length === 0 || selesai.length === 0 || pesan.length === 0){
                    
                    swal.fire("Booking Room", "Jangan ada inputan yang kosong!", "warning");
                
                }else{

                    if(Number(jumlahPeserta) > Number(maxpeserta)){
                        swal.fire('Booking Room', 'Kapasitas ruangan tidak mencukupi! Perhatikan kembali kapasitas', 'error')
                    }
                    
                    if(tanggalMulai > tanggalSelesai){

                        swal.fire('Booking Room', 'Silahkan perhatikan inputan waktu acara anda!', 'error');

                    }

                    if(Number(jumlahPeserta) < Number(maxpeserta) && tanggalMulai < tanggalSelesai){
                        
                        $.ajax({
                            async:true,
                            type: "POST",
                            url: url,
                            dataType: "JSON",
                            data: {
                                id_ruang: idRuang, jumlah_peserta: jumlahPeserta, nama_kegiatan: namaKegiatan,
                                tanggal, mulai, selesai, pesan, emp_no, nama_user, phone
                            },
                            success:(response)=>{
                                const { pesan, msg, status } = response;
                          
                                if(pesan === "Sukses"){

                                    swal.fire("Booking Room", msg, "info");
                                    window.location.href = "<?= site_url("formonffline") ?>";

                                }else if(pesan === "Gagal" && status === false){

                                    swal.fire("Booking Room", msg, "error");

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

            }else if(result.isDenied){
                swal.fire("Booking Room", "Booking data telah dibatalkan!", "info");
            }

        });


    });


</script>