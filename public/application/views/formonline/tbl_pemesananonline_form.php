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

                    <div class="body1">
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
                            <label for="varchar">Kategori Meeting</label>
                            <select name="kategorimeeting" id="kategorimeeting" class="form-control">
                                <option value="null" hidden="true">Kategori Meeting</option>
                                <option value="newmeeting">New Meeting</option>
                                <option value="joinmeeting">Join Meeting</option>
                            </select>
                        </div>
                    </div>

                    <div class="body2" id="body2">
                        <div class="form-group">
                            <label for="nama_aplikasi"> Nama Aplikasi</label>
                            <input 
                                name="nama_aplikasi" 
                                id="nama_aplikasi" 
                                type="text" 
                                class="form-control" 
                                placeholder="Nama Aplikasi" 
                            />
                        </div>
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input 
                                name="nama_kegiatan" 
                                id="nama_kegiatan" 
                                type="text" 
                                class="form-control" 
                                placeholder="Nama Kegiatan" 
                            />
                        </div>
                        <div class="form-group">
                            <label for="jumlah_peserta"> Nama Ruang</label>
                            <select class="form-control custom-select" name="namaruang" id="namaruang">
                                <option disabled selected="true" hidden="true">Pilih Nama Ruang</option>
                                <?php foreach($getRuang as $value){ ?>
                                    <option value="<?= $value["id_ruang"] ?>"><?= $value["namaruang"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group datepicker">
                            <label for="date">Tanggal</label>
                            <input 
                                name="tanggal" 
                                id="date" 
                                type="text" 
                                class="form-control" 
                                placeholder="Tanggal"  
                            />
                        </div>
                        <div class="form-group">
                            <label for="time">Waktu Mulai</label>
                            <input 
                                name="mulai" 
                                id="mulai" 
                                type="time" 
                                min="07:00" max="17:30" 
                                class="form-control" 
                                placeholder="Mulai" 
                            />
                        </div>
                        <div class="form-group">
                            <label for="time">Waktu Selesai</label>
                            <input 
                                name="selesai" 
                                id="selesai" 
                                type="time" 
                                min="07:30"max="17:30" 
                                class="form-control" 
                                placeholder="Berakhir pada" 
                            />
                        </div>
                    </div>

                    <div class="body3" id="body3">
                        <div class="form-group">
                            <label for="nama_aplikasi"> Nama Aplikasi</label>
                            <input 
                                name="nama_aplikasi1" 
                                id="nama_aplikasi1" 
                                type="text" 
                                class="form-control" 
                                placeholder="Nama Aplikasi" 
                            />
                        </div>
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input 
                                name="nama_kegiatan2" 
                                id="nama_kegiatan2" 
                                type="text" 
                                class="form-control" 
                                placeholder="Nama Kegiatan" 
                            />
                        </div>
                        <div class="form-group">
                            <label for="jumlah_peserta"> Nama Ruang</label>
                            <select class="form-control custom-select" name="namaruang1" id="namaruang1">
                                <option disabled selected="true" hidden="true">Pilih Nama Ruang</option>
                                <?php foreach($getRuang as $value){ ?>
                                    <option value="<?= $value["id_ruang"] ?>"><?= $value["namaruang"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="linkatauid"> Link atau ID</label>
                            <input 
                                name="linkatauid" 
                                id="linkatauid" 
                                type="text" 
                                class="form-control" 
                                placeholder="Link Atau ID" 
                            />
                        </div>
                        <div class="form-group">
                            <label for="jumlah_peserta">Password</label>
                            <input 
                                name="password" 
                                id="password" 
                                type="text" 
                                class="form-control" 
                                placeholder="Password" 
                            />
                        </div>
                        <div class="form-group datepicker">
                            <label for="date">Tanggal</label>
                            <input 
                                name="tanggal1" 
                                id="date1" 
                                type="text" 
                                class="form-control" 
                                placeholder="Tanggal"  
                            />
                        </div>
                        <div class="form-group">
                            <label for="time">Waktu Mulai</label>
                            <input 
                                name="mulai1" 
                                id="mulai1" 
                                type="time" 
                                min="07:00" max="17:30" 
                                class="form-control" 
                                placeholder="Mulai" 
                            />
                        </div>
                        <div class="form-group">
                            <label for="time">Waktu Selesai</label>
                            <input 
                                name="selesai1" 
                                id="selesai1" 
                                type="time" 
                                min="07:30"max="17:30" 
                                class="form-control" 
                                placeholder="Berakhir pada" 
                            />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="simpan"> Simpan! </button> 
                    <a href="<?php echo site_url('formonline') ?>" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </section>       
    </body>
</html>

<script>
   
    $(document).ready(function(){
        $('#body2').hide();
        $('#body3').hide();
        $("#date").datepicker({ 
            minDate: 0
        });
        $("#date1").datepicker({ 
            minDate: 0
        });
    });

    function clear_input(){
        $('#nama_aplikasi').val('').text('');
        $('#nama_kegiatan').val('').text('');
        // $('#jumlah_peserta').val('').text('');
        $('#linkatauid').val('').text('');
        $('#password').val('').text('');
        $('#nama_kegiatan2').val('').text('');
    }

    $(document).on('change','#kategorimeeting', function(){

        if($('#kategorimeeting option:selected').val() === "newmeeting"){
            $('#body2').show();
            $('#body3').hide();
            clear_input();
        }

        if($('#kategorimeeting option:selected').val() === "joinmeeting"){
            $('#body2').hide();
            $('#body3').show();
            clear_input();
        }  

    });

    $(document).on('click', '#simpan', function(){
        const url = "<?= site_url('formonline/post_ajax') ?>";
        const emp_no = $('#emp_no').val();
        const nama_user = $('#nama_user').val();
        const phone = $('#phone').val();
        const nama_aplikasi = $('#nama_aplikasi').val();
        const nama_kegiatan = $('#nama_kegiatan').val();
        const namaruang = $('#namaruang option:selected').val();
        // const jumlah_peserta = $('#jumlah_peserta').val(); -> ngga jadi dipakai
        const tanggal = moment($('#date').val()).format('YYYY/MM/DD');
        const mulai = $('#mulai').val();
        const selesai = $('#selesai').val();
        const tanggalMulai = moment(`${tanggal} ${mulai}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');
        const tanggalSelesai = moment(`${tanggal} ${selesai}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');
        // pembatas
        const linkatauid = $('#linkatauid').val();
        const password = $('#password').val();
        const kategorimeeting = $('#kategorimeeting option:selected').val();
        const namaruang1 = $('#namaruang1 option:selected').val();
        const tanggal1 = moment($('#date1').val()).format('YYYY/MM/DD');
        const mulai1 = $('#mulai1').val();
        const selesai1 = $('#selesai1').val();
        const tanggalMulai1= moment(`${tanggal1} ${mulai1}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');
        const tanggalSelesai1 = moment(`${tanggal1} ${selesai1}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');
        const nama_kegiatan2 = $('#nama_kegiatan2').val();
        const nama_aplikasi1 = $('#nama_aplikasi1').val();

        console.log(kategorimeeting);
        if(kategorimeeting === "null"){

            swal.fire('Meeting Online', 'Silahkan pilih kategori meeting anda!', 'error');

        }else{

            if(kategorimeeting === "newmeeting"){

                if(nama_aplikasi.length === 0 || nama_kegiatan.length === 0 || tanggal === "Invalid date" || mulai.length === 0 || selesai.length === 0 ){
                    swal.fire("Meeting Online", "Jangan ada inputan yang kosong!", "warning");
                }else{

                    if(tanggalMulai > tanggalSelesai){

                        swal.fire('Meeting Online', 'Silahkan perhatikan inputan waktu acara anda!', 'error');

                    }

                    if(tanggalMulai < tanggalSelesai){
                    
                        // logic backend ajax disini
                        swal.fire({
                            title: "Meeting Online",
                            text: "Apakah Anda yakin ingin melakukan pengajuan meeting?",
                            icon: "info",
                            showDenyButton: true,
                            showCancelButton: false,
                            confirmButtonText: `Ya`,
                            denyButtonText: `Batal`,
                        }).then(function(result){
                            
                            if(result.isConfirmed){

                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    dataType: "JSON",
                                    data: {
                                        nama_aplikasi, nama_kegiatan, namaruang,
                                        tanggal, mulai, selesai, kategorimeeting, nama_user, emp_no,
                                        phone
                                    },
                                    success:(response)=>{
                                        const { pesan, msg, status } = response;
                                        console.log(response)
                                        if(pesan === "Sukses"){

                                            swal.fire("Meeting Online", msg, "info");
                                            window.location.href = "<?= site_url("formonline") ?>";

                                        }else if(pesan === "Gagal" && status === false){

                                            swal.fire("Meeting Online", msg, "error");

                                        }else{
                                            
                                            swal.fire("Meeting Online", msg, "warning");
                                        
                                        }

                                    },
                                    error: (response)=>{
                                        console.log(response)
                                        swal.fire("Meeting Online", "Error! harap hubungi TIM IT!", "warning");
                                    }
                                });

                            }else if(result.isDenied){
                                swal.fire("Meeting Online", "Pengajuan meeting telah dibatalkan!", "info");
                            }


                        });

                    }

                }

            }else if(kategorimeeting === "joinmeeting"){


                if(nama_aplikasi1.length === 0 ||  password.length === 0 || linkatauid.length === 0 || tanggal1 === "Invalid date" || mulai1.length === 0 || selesai1.length === 0 || nama_kegiatan2.length === 0){

                    swal.fire('Meeting Online', 'Jangan ada inputan yang kosong!!', 'error');

                }else{

                    if(tanggalMulai1 > tanggalSelesai1){

                        swal.fire('Meeting Online', 'Silahkan perhatikan inputan waktu acara anda!', 'error');

                    }

                    if(tanggalMulai1 < tanggalSelesai1){

                        // logic backend ajax disini
                        swal.fire({
                            title: "Meeting Online",
                            text: "Apakah Anda yakin ingin melakukan pengajuan meeting?",
                            icon: "info",
                            showDenyButton: true,
                            showCancelButton: false,
                            confirmButtonText: `Ya`,
                            denyButtonText: `Batal`,
                        }).then(function(result){
                                
                            if(result.isConfirmed){

                                $.ajax({
                                    type: "POST",
                                    dataType: "JSON",
                                    url: url,
                                    data: {
                                        kategorimeeting, linkatauid, password, nama_user, emp_no,
                                        phone, namaruang1, tanggal: tanggal1, mulai: mulai1, selesai: selesai1,
                                        nama_kegiatan: nama_kegiatan2, nama_aplikasi: nama_aplikasi1,
                                    },
                                    success:(response)=>{
                                        const { pesan, msg, status } = response;
                                
                                        if(pesan === "Sukses"){

                                            swal.fire("Meeting Online", msg, "info");
                                            window.location.href = "<?= site_url("formonline") ?>";

                                        }else if(pesan === "Gagal" && status === false){

                                            swal.fire("Meeting Online", msg, "warning");

                                        }else{
                                            
                                            swal.fire("Meeting Online", "Error! harap hubungi TIM IT!", "warning");
                                        
                                        }

                                    },
                                    error: ()=>{
                                        swal.fire("Meeting Online", "Error! harap hubungi TIM IT!", "warning");
                                    }
                                });

                            }else if(result.isDenied){
                                swal.fire("Meeting Online", "Pengajuan meeting telah dibatalkan!", "info");
                            }


                        });

                    }


                }

            }

        }
        

    });

</script>
