<style>
  .cardinformation{
    box-shadow: 0 8px 10px -10px;
  }
</style>


<section class="section">

  <div class="section-header" >
    <h4 style="bold" > Welcome To PT Karimun Sembawang Shipyard Website </h4>
  </div>
   
  <div class="section-content">

    <div class="row">

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1 cardinformation">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Booking Online</h4>
              </div>
              <div class="card-body">
                <?= $this->fungsi->count_bookingOnline(); ?>
              </div>
            </div>
          </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1 cardinformation">
            <div class="card-icon bg-danger">
              <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Booking Offline</h4>
              </div>
              <div class="card-body">
              <?= $this->fungsi->count_bookingOffline(); ?>
              </div>
            </div>
          </div>
      </div>
    
    </div> <!-- end div row one -->

    <div class="row">
          
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card cardinformation ">

          <div class="card-header d-flex justify-content-between">
            
            <h4>List Data Booking Ruangan Offline</h4>

            <div>
              <input id="search" type="text" class="form-control" placeholder="Cari.." aria-label="Username" aria-describedby="basic-addon1">
            </div>

          </div>

          <div class="card-body overflow-auto">
            <table class="table" id="table-offline">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Emp No</th>
                  <th scope="col">Nama User</th>
                  <th style="width: 25%" scope="col">Nama Ruang</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php if(!empty($booking_list)){ ?>
                <?php foreach($booking_list as $book => $value){ ?>
                  <tr>
                    <td><?= ++$book ?></td>
                    <td><?= $value["emp_no"] ?></td>
                    <td><?= $value["nama_user"]?></td>
                    <td><?= $value["namaruang"] ?></td>
                    <td><?= date('d-m-Y', strtotime($value["tanggal"])) ?></td>
                    <td><?= ($value["status"] === "1") ? "<a class='badge badge-info text-white'>Belum di ACC</a>" : "Error" ?></td>
                    <td class="text-center">
                      <a
                        id="set_detail"
                        title="Detail"
                        class="btn btn-primary btn-sm" 
                        data-toggle="modal" 
                        data-target="#modal-detail"
                        data-idpemesanan="<?= $value['id_pemesanan'] ?>"
                        data-empno="<?= $value["emp_no"] ?>"
                        data-namauser="<?= $value["nama_user"] ?>"
                        data-tanggal="<?= $value["tanggal"] ?>"
                        data-namaruang="<?= $value["namaruang"] ?>"
                        data-status="<?= $value["status"] ?>"
                        data-jumlahpeserta="<?= $value["jumlah_peserta"] ?>"
                        data-namakegiatan="<?= $value["nama_kegiatan"] ?>"
                        data-mulai="<?= $value["mulai"] ?>"
                        data-selesai="<?= $value["selesai"] ?>"
                        data-pesan="<?= $value["pesan"] ?>"
                      ><i class="fas fa-fw fa-info text-white"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              <?php }else{ ?>
                  <tr>
                    <td class="text-center" colspan="5">Belum Ada Data!</td>
                  </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>  <!-- end div row two -->

    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card cardinformation ">

          <div class="card-header d-flex justify-content-between">
            
            <h4>List Data Booking Ruangan Online (New Meeting)</h4>

            <div>
              <input id="search2" type="text" class="form-control" placeholder="Cari.." aria-label="Username" aria-describedby="basic-addon1">
            </div>

          </div>
          <div class="card-body overflow-auto">
            <table class="table" id="table-offline2">
              <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Emp No</th>
                    <th scope="col">Nama User</th>
                    <th style="width: 25%" scope="col">Nama Ruang</th>
                    <th >Kategori Meeting</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
              </thead>
              <tbody>
              <?php if(!empty($listOfBooking)){ ?>
                <?php foreach($listOfBooking as $value){ ?>
                  <tr>
                    <td><?= ++$i ?></td>
                    <td><?= $value->emp_no ?></td>
                    <td><?= $value->nama_user?></td>
                    <td><?= $value->namaruang ?></td>
                    <td><?= $value->kategorimeeting === "joinmeeting" ? "Join Meeting" : "New Meeting" ?></td>
                    <td><?= date('d-m-Y', strtotime($value->tanggal)) ?></td>
                    <td><?= ($value->status === "1") ? "<a class='badge badge-info text-white'>Belum di ACC</a>" : "Error" ?></td>
                    <td class="text-center">
                      <a
                        id="set_detail"
                        title="Detail"
                        class="btn btn-primary btn-sm" 
                        href="<?= site_url('admin/detail/'.$value->id_pemesanan.'/'.$value->kategorimeeting) ?>"
                      ><i class="fas fa-fw fa-info text-white"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              <?php }else{ ?>
                  <tr>
                    <td class="text-center" colspan="8">Belum Ada Data!</td>
                  </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> <!-- end div row three -->

    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card cardinformation ">

          <div class="card-header d-flex justify-content-between">
            
            <h4>List Data Booking Ruangan Online (Join Meeting)</h4>

            <div>
              <input id="search3" type="text" class="form-control" placeholder="Cari.." aria-label="Username" aria-describedby="basic-addon1">
            </div>

          </div>
          <div class="card-body overflow-auto">
            <table class="table" id="table-offline3">
              <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Emp No</th>
                    <th scope="col">Nama User</th>
                    <th style="width: 25%" scope="col">Nama Ruang</th>
                    <th >Kategori Meeting</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
              </thead>
              <tbody>
              <?php if(!empty($listOfBooking1)){ ?>
                <?php foreach($listOfBooking1 as $value){ ?>
                  <tr>
                    <td><?= ++$i ?></td>
                    <td><?= $value->emp_no ?></td>
                    <td><?= $value->nama_user?></td>
                    <td><?= $value->namaruang ?></td>
                    <td><?= $value->kategorimeeting === "joinmeeting" ? "Join Meeting" : "New Meeting" ?></td>
                    <td><?= date('d-m-Y', strtotime($value->tanggal)) ?></td>
                    <td><?= ($value->status === "1") ? "<a class='badge badge-info text-white'>Belum Di Acc</a>" : "Error" ?></td>
                    <td class="text-center">
                      <a
                        id="set_detail"
                        title="Detail"
                        class="btn btn-primary btn-sm" 
                        href="<?= site_url('admin/detail/'.$value->id_pemesanan.'/'.$value->kategorimeeting) ?>"
                      ><i class="fas fa-fw fa-info text-white"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              <?php }else{ ?>
                  <tr>
                    <td class="text-center" colspan="8">Belum Ada Data!</td>
                  </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> <!-- end div row four -->
  
  </div> <!-- end div section-content -->

</section>

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
				<table class="table table-bordered no-margin" id="tableid">
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
            <tr id="trlast">
							<!-- <th>Pesan Approve</th>
							<td></td> -->
						</tr>
					</tbody>
				</table>
			</div>
      <div class="modal-footer bg-whitesmoke br" id="buttongroup">
        
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){

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
      

      $('#buttongroup').html(`
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button 
          id='id-${id_pemesanan}' 
          type="button" class="btn btn-danger"
          onclick="rejectbook(this)"><i class="fas fa-fw fa-trash"></i>
        </button>
        <button 
          id='id-${id_pemesanan}' 
          type="button" class="btn btn-primary"
          onclick="accbook(this)"><i class="fas fa-fw fa-save"></i>
        </button>`);
      
      $('#tableid tbody').find('#trlast').html(`
        <th>Pesan Approve</th>
        <td>
          <textarea id="id-${id_pemesanan}"></textarea>
        </td>
      `);
      
    });
    
    
  });

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

   // live search
  $('#search2').keyup(function(){

    const value = this.value.toLowerCase().trim();

    $('#table-offline2 tr').each(function(index){
        if(!index) return;
        $(this).find("td").each(function () {
            let id = $(this).text().toLowerCase().trim();
            let not_found = (id.indexOf(value) == -1);
            $(this).closest('tr').toggle(!not_found);
            return not_found;
        });
    });

  });

   // live search
  $('#search3').keyup(function(){

    const value = this.value.toLowerCase().trim();

    $('#table-offline3 tr').each(function(index){
        if(!index) return;
        $(this).find("td").each(function () {
            let id = $(this).text().toLowerCase().trim();
            let not_found = (id.indexOf(value) == -1);
            $(this).closest('tr').toggle(!not_found);
            return not_found;
        });
    });

  });
  
  function accbook(element){

    const id_pemesanan = $(element).attr("id").substr(3);
    const url = "<?= site_url('admin/updatestatusbook') ?>";
    const status = 3;
    const pesan_approve = $(`#id-${id_pemesanan}`).val().length === 0 ? "Tidak Ada Pesan" : $(`#id-${id_pemesanan}`).val();

    swal.fire({
        title: "Booking Room",
        text: "Apakah Anda yakin untuk mensetujuinya?",
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
            data: { id_pemesanan, status, pesan_approve },
            success:(response)=>{
              const { msg, pesan, status } = response;

              if(pesan === "Sukses"){

                swal.fire({
                  icon: "success",
                  title: msg,
                  showConfirmButton: true,
                }).then(()=>{
                  window.location.href = "<?= site_url("admin") ?>";

                });
                
              }else if(pesan === "Gagal" && status === false){
                
                swal.fire("Booking Room", msg, "warning");
                
              }else{
                
                swal.fire("Booking Room", msg, "warning");
                
              }

            },
            error: ()=>{
              swal.fire("Booking Room", "Error! harap hubungi TIM IT!", "warning");
            }
          });

        }else if(result.isDenied){
          swal.fire("Booking Room", "Booking data telah dibatalkan!", "info");
        }

      });
    

  }

  function rejectbook(element){
    const id_pemesanan = $(element).attr("id").substr(3);
    const url = "<?= site_url('admin/updatestatusbook') ?>";
    const status = 2;
    const pesan_approve = $(`#id-${id_pemesanan}`).val();

    if(pesan_approve.length === 0){
      swal.fire({
        title: "Booking Room",
        text: "Harap isi pesan approve!",
        icon: "error",
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: `Ya`,
      });
    }else{

      swal.fire({
        title: "Booking Room",
        text: "Apakah Anda yakin untuk menolaknya?",
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
                data: { id_pemesanan, status, pesan_approve },
                success:(response)=>{
                  const { msg, pesan, status } = response;

                  if(pesan === "Sukses"){

                    swal.fire({
                      icon: "success",
                      title: msg,
                      showConfirmButton: true,
                    }).then(()=>{
                      window.location.href = "<?= site_url("admin") ?>";

                    });
                  
                  }else if(pesan === "Gagal" && status === false){
                  
                    swal.fire("Booking Room", msg, "warning");
                  
                  }else{
                  
                    swal.fire("Booking Room", msg, "warning");
                  
                  }

                },
                error: ()=>{
                  swal.fire("Booking Room", "Error! harap hubungi TIM IT!", "warning");
                }
            });

        }else if(result.isDenied){
            swal.fire("Booking Room", "Booking data telah dibatalkan!", "info");
        }

      });


    }

  }

</script>



