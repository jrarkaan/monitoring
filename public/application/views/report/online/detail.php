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
                                name="id_pemesanan" 
                                id="id_pemesanan" 
                                type="text" 
                                class="form-control" 
                                placeholder="Emp No" 
                                value="<?= $data[0]->id_pemesanan ?>" 
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
                                value="<?= $data[0]->nama_user ?>"
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
                                value="<?= $data[0]->phone ?>"
                                readonly 
                            />
                        </div>
                    </div>
                  <?php if($data[0]->kategorimeeting === "newmeeting"){ ?>
                        <div class="form-group">
                            <input 
                                name="newmeeting" 
                                id="newmeeting" 
                                type="hidden"
                                value="<?= $data[0]->kategorimeeting ?>" 
                                readonly 
                            />
                        </div>
                        <div class="form-group">
                            <label for="nama_aplikasi"> Nama Aplikasi</label>
                            <input 
                                name="nama_aplikasi" 
                                id="nama_aplikasi" 
                                type="text" 
                                class="form-control" 
                                placeholder="Nama Aplikasi"
                                value="<?= $data[0]->nama_aplikasi ?>" 
                                readonly 
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
                                value="<?= $data[0]->nama_kegiatan ?>" 
                                readonly 
                            />
                        </div>
                        <div class="form-group">
                            <label for="jumlah_peserta"> Nama Ruang</label>
                            <select class="form-control custom-select" name="namaruang" id="namaruang" disabled>
                                <option disabled selected="true" hidden="true">Pilih Nama Ruang</option>
                                <?php foreach($getRuang as $value){ ?>
                                    <option value="<?= $value['id_ruang'] ?>" <?= $value['id_ruang'] == $data[0]->nama_ruang ? "selected" : null ?>><?= $value['namaruang'] ?></option>
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
                                value="<?= $data[0]->tanggal ?>" 
                                readonly 
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
                                value="<?= $data[0]->mulai ?>"
                                readonly 
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
                                value="<?= $data[0]->selesai ?>"
                                readonly 
                            />
                        </div>
                        
                        <div class="form-group">
                              <label for="jumlah_peserta">Status Pengajuan</label>
                              <select class="form-control custom-select" name="statuspengajuan" id="statuspengajuan">
                                    <option value="" disabled selected="true" hidden="true">Pilih Status Pengajuan</option>
                                    <option value="2" <?= $data[0]->status == 2 ? "selected" : null ?> >Tolak</option>
                                    <option value="3" <?= $data[0]->status == 3 ? "selected" : null ?> >Setujui</option>
                              </select>
                        </div>
                        <div id="body5">
                           <div class="form-group">
                              <label for="date">Link atau ID</label>
                              <input 
                                 name="linkatauid2" 
                                 id="linkatauid2" 
                                 type="text" 
                                 class="form-control" 
                                 placeholder="Link Atau ID"
                                 value=" <?= $data[0]->linkatauid ? $data[0]->linkatauid : null ?>" 
                              />
                           </div>
                           <div class="form-group">
                              <label for="password2">Password</label>
                              <input 
                                 name="password2" 
                                 id="password2" 
                                 type="text" 
                                 class="form-control" 
                                 placeholder="Password"
                                 value=" <?= $data[0]->password ? $data[0]->password : null ?>"  
                              />
                              <label style="color:red" for="password2">Apabila tidak ada password, maka ketikan "(none)"</label>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="date">Pesan Approve</label>
                           <input 
                              name="pesanapprove" 
                              id="pesanapprove" 
                              type="text" 
                              class="form-control" 
                              placeholder="Pesan Approve" 
                              value=" <?= $data[0]->pesan_approve ? $data[0]->pesan_approve : null ?>" 
                           />
                        </div>
                  <?php }else if($data[0]->kategorimeeting === "joinmeeting"){ ?>
                        <div class="form-group">
                            <input 
                                name="joinmeeting" 
                                id="joinmeeting" 
                                type="hidden"
                                value="<?= $data[0]->kategorimeeting ?>" 
                            />
                        </div>
                        <div class="form-group">
                           <label for="jumlah_peserta"> Nama Ruang</label>
                           <select class="form-control custom-select" name="namaruang1" id="namaruang1" disabled>
                              <option disabled selected="true" hidden="true">Pilih Nama Ruang</option>
                              <?php foreach($getRuang as $value){ ?>
                                    <option value="<?= $value['id_ruang'] ?>" <?= $value['id_ruang'] == $data[0]->nama_ruang ? "selected" : null ?>><?= $value['namaruang'] ?></option>
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
                                value="<?= $data[0]->linkatauid ?>" 
                                readonly
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
                                value="<?= $data[0]->password ?>" 
                                readonly
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
                                value="<?= $data[0]->tanggal ?>"
                                readonly 
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
                                value="<?= $data[0]->mulai ?>"
                                readonly
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
                                value="<?= $data[0]->selesai ?>"
                                readonly
                            />
                        </div>
                        <div class="form-group">
                           <label for="date">Pesan Approve</label>
                           <input 
                              name="pesanapprove" 
                              id="pesanapprove" 
                              type="text" 
                              class="form-control" 
                              placeholder="Pesan Approve" 
                              value=" <?= $data[0]->pesan_approve ? $data[0]->pesan_approve : null ?>" 
                              readonly
                           />
                        </div>
                  <?php } ?>
                    
                        </div>
                    </div>
                    <?php if($data[0]->kategorimeeting === "joinmeeting"){ ?>
                        <a href="<?php echo site_url('reportonline') ?>" class="btn btn-warning">Kembali</a>
                    <?php }else{ ?>
                        <?php if($data[0]->status == 2){ ?>
                            <button type="submit" class="btn btn-primary" id="simpan"> Perbarui! </button> 
                            <a href="<?php echo site_url('reportonline') ?>" class="btn btn-warning">Kembali</a>
                        <?php }else{ ?>
                            <button type="submit" class="btn btn-primary" id="simpan"> Perbarui! </button> 
                            <a href="<?php echo site_url('reportonline') ?>" class="btn btn-warning">Kembali</a>
                            <a
                                id="kirimnotif"
                                title="Kirim"
                                class="btn btn-info" 
                            ><i class="far fa-bell text-white"></i></a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </section>       
    </body>
</html>

<script>
    $(document).ready(function(){
        const status = $('#statuspengajuan option:selected').val();

        if(status === "3"){
            $('#body5').show();
        }else{
            $('#body5').hide();
        }
    });

    $(document).on('click', '#kirimnotif', function(){
        const linkatauid = $('#linkatauid2').val();
        const password = $('#password2').val();
        const pesan_approve = $('#pesanapprove').val();
        const id_pemesanan = $('#id_pemesanan').val();
        const kategorimeeting = $('#newmeeting').val();

        if(linkatauid.length === 1 || linkatauid.length === 0 || password.length === 1 || password.length === 0 || pesan_approve.length === 1 ||  pesan_approve.length === 0){
            Toast.fire({
                icon: "error",
                html: "Pastikan Link, password, atau pesan approve tidak kosong!"
            });
        }else{

            console.log("id_pemesanan", id_pemesanan);
            console.log("linkatauid", linkatauid.length);
            console.log("password", password);
            console.log("pesan_approve", pesan_approve);
            // cek apakah data dari link atau password serta pesaan approve sudah ada di db?
            $.ajax({
                async: true,
                type: "POST",
                dataType: "JSON",
                url: "<?= site_url('reportonline/check_data') ?>",
                data: { id_pemesanan, kategorimeeting },
                success: (response)=>{
                    const { status, msg, pesan, data } = response;

                    if(pesan === "Gagal"){
                        swal.fire("Meeting Online", msg, "error");
                    }else if(pesan === "Sukses"){
                       
                        swal.fire({
                            title: "Meeting Online",
                            text: "Apakah Anda yakin ingin melakukan pengiriman notifikasi by Whatsapp?",
                            icon: "info",
                            showDenyButton: true,
                            showCancelButton: false,
                            confirmButtonText: `Ya`,
                            denyButtonText: `Batal`,
                        }).then(function(result){

                            Swal.fire({
                                title: 'Loading',
                                width: 200
                            });

                            Swal.showLoading();

                            if(result.isConfirmed){
                                
                                $.ajax({
                                    async:true,
                                    type: "POST",
                                    url: "<?= site_url('reportonline/sendwhatsapp') ?>",
                                    dataType: "JSON",
                                    data: {
                                       id_pemesanan, kategorimeeting, 
                                    },
                                    success:(response)=>{


                                        const { status, text } = response;

                                        if(status === "0"){
                                            Swal.close();
                                            Toast.fire({
                                                icon: "error",
                                                html: "Terjadi error pada API! Hubungi TIM IT! "+text,
                                            });
                                        }else if(status === "1"){

                                            Swal.close();
                                            Toast.fire({
                                                icon: "success",
                                                html: "Berhasil mengirimkan notifikasi by Whatsapp!"
                                            });
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
                },
                error: ()=>{
                    swal.fire("Meeting Online", "terjadi error pada ajax! hubungi tim it", "error");
                }
            });


        }

    });

    $(document).on('change', '#statuspengajuan', function(){
        const status = $('#statuspengajuan option:selected').val();
        if(status === "2"){
            $('#body5').hide();
            $('#linkatauid2').val('');
            $('#password2').val('');
            $('#pesanapprove').val('');
        }else if(status === "3"){
            $('#body5').show();
            $('#linkatauid2').val('');
            $('#password2').val('');
            $('#pesanapprove').val('');
        }

    });

    $(document).on('click', '#simpan', function(){
        const url = "<?= site_url('admin/update_status') ?>";
        const id_pemesanan = $('#id_pemesanan').val();
        const newmeeting = $('#newmeeting').val();
        const joinmeeting = $('#joinmeeting').val();

        if(joinmeeting === undefined){
            const id_pemesanan = $('#id_pemesanan').val();
            const status = $('#statuspengajuan option:selected').val();
            const pesan_approve = $('#pesanapprove').val();
            const passwordkedua = $('#password2').val();
            const password = passwordkedua.replace(/^\s+|\s+$|\s+(?=\s)/g, "");
            const linkatauid = $('#linkatauid2').val();

            if(status.length === 0 || pesan_approve.length === 0){
                swal.fire("Meeting Online", "Jangan ada inputan yang kosong!", "warning");
            }else{

                if(status === "2"){
                
                swal.fire({
                    title: "Approve Meeting Online",
                    text: "Apakah Anda yakin ingin melakukan penolakan pengajuan meeting online?",
                    icon: "warning",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Ya`,
                    denyButtonText: `Batal`,
                }).then(function(result){

                    if(result.isConfirmed){

                        // butuh data
                        // pesan_approve, status, id_pemesanan, kategori_meeting
                        $.ajax({
                            async:true,
                            type: "POST",
                            url: url,
                            dataType: "JSON",
                            data: {
                            id_pemesanan, kategorimeeting: newmeeting, 
                            pesan_approve, status
                            },
                            success:(response)=>{
                                const { pesan, msg, status } = response;
                            console.log(msg)
                                if(pesan === "Sukses"){

                                    swal.fire("Approve Meeting Online", msg, "success");
                                    window.location.href = "<?= site_url("reportonline") ?>";

                                }else if(pesan === "Gagal" && status === false){

                                    swal.fire("Approve Meeting Online", "Error! harap hubungi TIM IT!", "warning");

                                }else{
                                    
                                    swal.fire("Approve Meeting Online", "Error! harap hubungi TIM IT!", "warning");
                                
                                }

                            },
                            error: ()=>{
                                swal.fire("Approve Meeting Online", "Error! harap hubungi TIM IT!", "warning");
                            }
                        });
                        
                        console.log(pesan_approve);

                    }else if(result.isDenied){
                        swal.fire("Approve Meeting Online", "Penolakan meeting telah dibatalkan!", "info");
                    }

                });

                }else if(status === "3"){

                if(password.length === 0 || linkatauid.length === 0 || pesan_approve.length === 0){
                    swal.fire("Meeting Online", "Jangan ada inputan yang kosong!", "warning");
                }else{

                    swal.fire({
                        title: "Approve Meeting Online",
                        text: "Apakah Anda yakin ingin melakukan persetujuan pengajuan meeting online?",
                        icon: "info",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: `Ya`,
                        denyButtonText: `Batal`,
                    }).then(function(result){

                        if(result.isConfirmed){
                            // butuh data  
                            // pesan_approve, status, id_pemesanan, password, linkatauid
                            $.ajax({
                            async:true,
                            type: "POST",
                            url: url,
                            dataType: "JSON",
                            data: {
                                id_pemesanan, kategorimeeting: newmeeting, 
                                pesan_approve, status, password, linkatauid
                            },
                            success:(response)=>{
                                const { pesan, msg, status } = response;
                                
                                if(pesan === "Sukses"){

                                    swal.fire("Approve Meeting Online", msg, "success");
                                    window.location.href = "<?= site_url("reportonline") ?>";

                                }else if(pesan === "Gagal" && status === false){

                                    swal.fire("Approve Meeting Online", "Error! harap hubungi TIM IT!", "warning");

                                }else{
                                    
                                    swal.fire("Approve Meeting Online", "Error! harap hubungi TIM IT!", "warning");
                                
                                }

                            },
                            error: ()=>{
                                swal.fire("Approve Meeting Online", "Error! harap hubungi TIM IT!", "warning");
                            }
                            });

                            console.log(password)
                            console.log(linkatauid)
                            console.log(pesan_approve)

                        }else if(result.isDenied){
                            swal.fire("Approve Meeting Online", "Persetujuan meeting telah dibatalkan!", "info");
                        }

                    });

                }


                }

            }


        }

        if(newmeeting === undefined){
            console.log(pesan_approve);
            

        }

    });

</script>