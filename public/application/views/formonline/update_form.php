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
                            />
                        </div>
                        <div class="form-group">
                            <label for="jumlah_peserta"> Nama Ruang</label>
                            <select class="form-control custom-select" name="namaruang" id="namaruang">
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
                           <select class="form-control custom-select" name="namaruang1" id="namaruang1">
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
                                value="<?= $data[0]->nama_kegiatan ?>" 
                            />
                        </div>
                  <?php } ?>
                    
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
      $("#date").datepicker({ 
         minDate: 0
      });
   });

   $(document).on('click', '#simpan', function(){
      
      const newmeeting = $('#newmeeting').val();
      const joinmeeting = $('#joinmeeting').val();
      const id_pemesanan = $('#id_pemesanan').val();
      const url = "<?= site_url('formonline/update_ajax') ?>";
      console.log("newmeeting", newmeeting);
      console.log("joinmeeting", joinmeeting);

      // perbarui data newmeeting
      if(joinmeeting === undefined){
         const nama_aplikasi = $('#nama_aplikasi').val();
         const nama_kegiatan = $('#nama_kegiatan').val();
         const namaruang = $('#namaruang option:selected').val();
         const tanggal = moment($('#date').val()).format('YYYY/MM/DD');
         const mulai = $('#mulai').val();
         const selesai = $('#selesai').val();
         const tanggalMulai = moment(`${tanggal} ${mulai}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');
         const tanggalSelesai = moment(`${tanggal} ${selesai}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');

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
                  text: "Apakah Anda yakin ingin melakukan pembaruan pengajuan meeting online?",
                  icon: "info",
                  showDenyButton: true,
                  showCancelButton: false,
                  confirmButtonText: `Ya`,
                  denyButtonText: `Batal`,
               }).then(function(result){
                            
                  if(result.isConfirmed){

                     $.ajax({
                        async:true,
                        type: "POST",
                        url: url,
                        dataType: "JSON",
                        data: {
                              nama_aplikasi, nama_kegiatan, namaruang,
                              tanggal, mulai, selesai, kategorimeeting: newmeeting, id_pemesanan
                        },
                        success:(response)=>{
                            const { pesan, msg, status } = response;
                    
                            if(pesan === "Sukses"){

                                swal.fire("Meeting Online", msg, "info");
                                window.location.href = "<?= site_url("formonline") ?>";

                            }else if(pesan === "Gagal" && status === false){

                                swal.fire("Meeting Online", "Error! harap hubungi TIM IT!", "warning");

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

                })

            }
            
         }

      }

      if(newmeeting === undefined){
         const nama_kegiatan2 = $('#nama_kegiatan2').val();
         const linkatauid = $('#linkatauid').val();
         const password = $('#password').val();
         const namaruang1 = $('#namaruang1 option:selected').val();
         const tanggal1 = moment($('#date1').val()).format('YYYY/MM/DD');
         const mulai1 = $('#mulai1').val();
         const selesai1 = $('#selesai1').val();
         const tanggalMulai1 = moment(`${tanggal1} ${mulai1}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');
         const tanggalSelesai1 = moment(`${tanggal1} ${selesai1}`, 'DD/MM/YYYY HH:mm').format('DD-MM-YYYY HH:mm');

         if(linkatauid.length === 0 || password.length === 0 || tanggal1 === "Invalid date" || mulai1.length === 0 || selesai1.length === 0){
         
            swal.fire("Meeting Online", "Jangan ada inputan yang kosong!", "warning");
      
         }else{

            if(tanggalMulai1 > tanggalSelesai1){

                swal.fire('Meeting Online', 'Silahkan perhatikan inputan waktu acara anda!', 'error');

            }

            if(tanggalMulai1 < tanggalSelesai1){

                swal.fire({
                    title: "Meeting Online",
                    text: "Apakah Anda yakin ingin melakukan pembaruan pengajuan meeting online?",
                    icon: "info",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Ya`,
                    denyButtonText: `Batal`,
                }).then(function(result){

                    if(result.isConfirmed){

                        $.ajax({
                            async:true,
                            type: "POST",
                            url: url,
                            dataType: "JSON",
                            data: {
                                linkatauid, password, namaruang: namaruang1,
                                kategorimeeting: joinmeeting, id_pemesanan, tanggal: tanggal1,
                                mulai: mulai1, selesai: selesai1, nama_kegiatan: nama_kegiatan2,
                            },
                            success:(response)=>{
                                const { pesan, msg, status } = response;

                                if(pesan === "Sukses"){

                                    swal.fire("Meeting Online", msg, "info");
                                    window.location.href = "<?= site_url("formonline") ?>";

                                }else if(pesan === "Gagal" && status === false){

                                    swal.fire("Meeting Online", "Error! harap hubungi TIM IT!", "warning");

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

   });

</script>