<section class="section"> 
   <div class="section-header">
       <h4 style="bold">List Of Booking Room Online </h4>
   </div>
</section>

<div class="card">
   <div class="card-header">
     <h4>List Of Booking Online</h4>
   </div>
  <div class="card-body">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Table Booking Online</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Print</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div class="row">


          <div class="card-header d-flex justify-content-between">
              
              <h4>List Data Booking Ruangan Online (New Meeting)</h4>

              <div>
                <input id="search" type="text" class="form-control" placeholder="Cari.." aria-label="Username" aria-describedby="basic-addon1">
              </div>

          </div>

          <div class="col-md-4">
            <div class="input-group mb-2 ml-2">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" id="newmeetingcari" type="button">Display</button>
              </div>
              <select class="custom-select" id="newmeetingcariselect">
                <option value="all">All</option>
                <option value="2">Ditolak</option>
                <option value="3">Diterima</option>
              </select>
            </div>
          </div>
        
         <div class="card-body overflow-auto">
            <table class="table overflow-auto" id="table-offline">
              <thead>
                <tr>
                  <th scope="col">Nama User</th>
                  <th scope="col">Nama Ruang</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Kategori Meeting</th>
                  <th scope="col" class="text-center">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody id="body1">
              <?php if(!empty($getDataOnline)){ ?>
                <?php foreach($getDataOnline as $value){ ?>
                  <tr>
                    <td><?= $value->nama_user ?></td>
                    <td><?= $value->namaruang ?></td>
                    <td><?= date('d-m-Y', strtotime($value->tanggal)) ?></td>
                    <td><?= $value->kategorimeeting === "newmeeting" ? "New Meeting" : "Join Meeting" ?></td>
                    <td class="text-center"><?= ($value->status === "2") ? "<a class='badge badge-danger text-white'>Di Tolak</a>" : "<a class='badge badge-success text-white'>Sudah di Appprove</a>" ?></td>
                    <td class="text-center">
                      <a
                        id="setdetail"
                        title="Detail"
                        class="btn btn-primary btn-sm" 
                        href="<?= site_url('reportonline/detail/'.$value->id_pemesanan.'/'.$value->kategorimeeting) ?>"
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

        </div> <!-- row 1 -->

        <div class="row">
          
          
          <div class="card-header d-flex justify-content-between">
            
            <h4>List Data Booking Ruangan Online (Join Meeting)</h4>
            
            <div>
              <input id="search2" type="text" class="form-control" placeholder="Cari.." aria-label="Username" aria-describedby="basic-addon1">
            </div>
            
          </div>

          <div class="col-md-4">
            <div class="input-group mb-2 ml-2">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" id="joinmeetingcari" type="button">Display</button>
              </div>
              <select class="custom-select" id="joinmeetingcariselect">
                <option value="all">All</option>
                <option value="2">Ditolak</option>
                <option value="3">Diterima</option>
              </select>
            </div>
          </div>
          
          <div class="card-body overflow-auto">
            <table class="table overflow-auto" id="table-offline2">
              <thead>
                <tr>
                  <th scope="col">Nama User</th>
                  <th scope="col">Nama Ruang</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Kategori Meeting</th>
                  <th scope="col" class="text-center">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <!-- <?= print_r($getDataOnline1) ?> -->
              <tbody id="body2"> 
              <?php if(!empty($getDataOnline1)){ ?>
                <?php foreach($getDataOnline1 as $value){ ?>
                  <tr>
                    <td><?= $value->nama_user ?></td>
                    <td><?= $value->namaruang ?></td>
                    <td><?= date('d-m-Y', strtotime($value->tanggal)) ?></td>
                    <td><?= $value->kategorimeeting === "newmeeting" ? "New Meeting" : "Join Meeting" ?></td>
                    <td class="text-center"><?= ($value->status === "3") ? "<a class='badge badge-success text-white'>Sudah di approve</a>" : "<a class='badge badge-danger text-white'>Sudah di Tolak</a>" ?></td>
                    <td class="text-center">
                      <a
                        id="setdetail"
                        title="Detail"
                        class="btn btn-primary btn-sm" 
                        href="<?= site_url('reportonline/detail/'.$value->id_pemesanan.'/'.$value->kategorimeeting) ?>"
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

        </div> <!-- row 2 -->


      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                  <select id="bulan" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                    <option hidden value="0">-Pilih Bulan-</option>
                    <option value="1">Januari</option>
                    <option value="2">Febuari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <select id="tahun" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                    <option hidden value="0">-Pilih Tahun-</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <button type="submit" id="cetak" class="btn btn-primary my-1">Submit</button>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<script>

  $(document).on('click', '#cetak', function(){
    const bulan = $('#bulan option:selected').val();
    const tahun = $('#tahun option:selected').val();

    if(bulan === "0" || tahun === "0"){
      Toast.fire({
        icon: "error",
        html: "Harap pilih tahun atau tanggalnya!"
      });
    }else{
      const url = "<?= site_url('reportonline/cetak/a/b') ?>";

      const newURL = url.replace(url.substr(41, 43), `/${bulan}/b`);


      const newURL1 = newURL.length === 45 ?
        newURL.replace(newURL.substr(43, 44), `/${tahun}`)
          : newURL.length === 46 ?
            newURL.replace(newURL.substr(44, 46), `/${tahun}`) : null;

      // console.log(newURL1);
      window.location.href = newURL1;

    }
      
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

  $(document).on('click', '#joinmeetingcari', function(){
    const value = $('#joinmeetingcariselect option:selected').val();

    Swal.fire({
      title: 'Loading',
      width: 200
    });

    Swal.showLoading();
    
    $.ajax({
      async: true,
      dataType: "JSON",
      type: "POST",
      url: "<?= site_url('reportonline/search_status2') ?>",
      data: { status: value },
      success: (response)=>{
        const { data, pesan, status } = response;

        const url = "<?= site_url('reportonline/detail/a/b') ?>";

        if(pesan === "Sukses"){

          if(data.length > 0){

            let string = '';

            for(const value of data){

              const newURL = url.replace(url.substring(42, 44), `/${value.id_pemesanan}`);
              const newURL1 = newURL.length === 51 ? 
                              newURL.replace(newURL.substring(45, 46), `${value.kategorimeeting}`) 
                                : newURL.length === 52 
                                  ?  newURL.replace(newURL.substring(46, 47), `${value.kategorimeeting}`) : null;
              string += `
                <tr>
                  <td>${value.nama_user}</td>
                  <td>${value.namaruang}</td>
                  <td>${moment(value.tanggal).format("DD/MM/YYYY")}</td>
                  <td>${value.kategorimeeting === "joinmeeting" ? "Join Meeting" : "Error"}</td>
                  <td>${value.status === "2" ? "<a class='badge badge-danger text-white'>Di Tolak</a>" : "<a class='badge badge-success text-white'>Sudah di Appprove</a>" }</td>
                  <td class="text-center">\
                    <a
                      id="setdetail"
                      title="Detail"
                      class="btn btn-primary btn-sm" 
                      href="${newURL1}"
                    ><i class="fas fa-fw fa-info text-white"></i></a>
                  </td>
                </tr>
              `;

            }

            $('#table-offline2').find('#body2').html(string);
            console.log(string);
            Swal.close();
          }else{

            string = `
              <tr colspan="6" class="text-center">
                <td>Maaf datanya kosong!</td>
              </tr>
            `;

            $('#table-offline2').find('#body2').html(string);

            Swal.close();
          }

        }else{
          Swal.close();
          
          Toast.fire({
            icon: "error",
            html: "Terjadi error pada Ajax! Hubungi TIM IT!"
          });

        }

      },
      error: ()=>{
        Swal.close();
          
          Toast.fire({
             icon: "error",
             html: "Terjadi error pada Ajax! Hubungi TIM IT!"
          });
      }
    });

  });

  $(document).on('click', '#newmeetingcari', function(){

    const value = $('#newmeetingcariselect option:selected').val();

    Swal.fire({
       title: 'Loading',
       width: 200
    });

    Swal.showLoading();

    $.ajax({
      async: true,
      dataType: "JSON",
      type: "POST",
      url: "<?= site_url('reportonline/search_status') ?>",
      data: { status: value },
      success: (response)=>{
        
        const { data, pesan, status } = response;

        const url = "<?= site_url('reportonline/detail/a/b') ?>";

        if(pesan === "Sukses"){

          if(data.length > 0){

            let string = '';

            for(const value of data){

              const newURL = url.replace(url.substring(42, 44), `/${value.id_pemesanan}`);
              const newURL1 = newURL.length === 51 ? 
                              newURL.replace(newURL.substring(45, 46), `${value.kategorimeeting}`) 
                                : newURL.length === 52 
                                  ?  newURL.replace(newURL.substring(46, 47), `${value.kategorimeeting}`) : null;
              string += `
                <tr>
                  <td>${value.nama_user}</td>
                  <td>${value.namaruang}</td>
                  <td>${moment(value.tanggal).format("DD/MM/YYYY")}</td>
                  <td>${value.kategorimeeting === "newmeeting" ? "New Meeting" : "Error"}</td>
                  <td>${value.status === "2" ? "<a class='badge badge-danger text-white'>Di Tolak</a>" : "<a class='badge badge-success text-white'>Sudah di Appprove</a>" }</td>
                  <td class="text-center">\
                    <a
                      id="setdetail"
                      title="Detail"
                      class="btn btn-primary btn-sm" 
                      href="${newURL1}"
                    ><i class="fas fa-fw fa-info text-white"></i></a>
                  </td>
                </tr>
              `;

            }

            $('#table-offline').find('#body1').html(string);
            Swal.close();
          }else{

            string = `
              <tr colspan="6" class="text-center">
                <td>Maaf datanya kosong!</td>
              </tr>
            `;

            $('#table-offline').find('#body1').html(string);

            Swal.close();
          }

        }else{
          Swal.close();
          
          Toast.fire({
             icon: "error",
             html: "Terjadi error pada Ajax! Hubungi TIM IT!"
          });

        }

      },
      error: ()=>{

        Swal.close();
        Toast.fire({
           icon: "error",
           html: "Terjadi error pada Ajax! Hubungi TIM IT!"
        });

      }
    });
  
  }); /// document search


</script>
