<section class="section">
  <div class="section-header" >
    <h4 style="bold" > Welcome To PT Karimun Sembawang Shipyard Website </h4>
  </div>
  
  <div class="section-body">

    <div class="row">
          
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card cardinformation ">

          <div class="card-header d-flex justify-content-between">
            
            <h4>List data booking offline ruangan pada bulan ini</h4>
          
          </div>
          <div class="card-body overflow-auto">
            <table class="table table-striped table-bordered dt-responsive nowrap table-hover" id="table1" style="width:100%">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama User</th>
                  <th style="width: 25%" scope="col">Nama Ruang</th>
                  <th style="width: 25%" scope="col">Nama Kegiatan</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Mulai</th>
                  <th scope="col">Selesai</th>
                </tr>
              </thead>
              <tbody>
              <?php if(isset($listDataOfBooking)){ ?>
                <?php foreach($listDataOfBooking as $data){ ?>
                  <tr>
                    <td><?= $counter++ ?></td>
                    <td><?= $data->nama_user ?></td>
                    <td><?= $data->namaruang ?></td>
                    <td><?= $data->nama_kegiatan ?></td>
                    <td><?= $data->tanggal ?></td>
                    <td><?= $data->mulai ?></td>
                    <td><?= $data->selesai ?></td>
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

    </div><!-- end div row two -->

    <div class="row">
          
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card cardinformation ">

          <div class="card-header d-flex justify-content-between">
            
            <h4>List data booking online ruangan pada bulan ini</h4>
          
          </div>
          <div class="card-body overflow-auto">
            <table class="table table-striped table-bordered dt-responsive nowrap table-hover" id="table2" style="width:100%">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama User</th>
                  <th scope="col">Nama Ruangan</th>
                  <th style="width: 25%" scope="col">Nama Kegiatan</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Mulai</th>
                  <th scope="col">Selesai</th>
                </tr>
              </thead>
              <tbody>
              <?php if(isset($listDataOfBookingOnline)){ ?>
                <?php foreach($listDataOfBookingOnline as $data){ ?>
                  <tr>
                    <td><?= $counter_online++ ?></td>
                    <td><?= $data->nama_user ?></td>
                    <td><?= $data->namaruang ?></td>
                    <td><?= $data->nama_kegiatan ?></td>
                    <td><?= $data->tanggal ?></td>
                    <td><?= $data->mulai ?></td>
                    <td><?= $data->selesai ?></td>
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

    </div><!-- end div row two -->

</section>

<script>
  $(document).ready(function(){
    $('#table1').DataTable({
      // "dom": 'Bfrtip',
      // "buttons": [
      //   'print'
      // ],
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?= site_url('user/get_ajax') ?>",
        "type" : "POST"
      },
      "columnDefs" : [
        {
          "targets" : [2,3], // bisa [ 7, -1 ], tpi gua enakan kaya gini si, haha
          "className" : "text-center"
        },
        {
          "targets" : [3,4], // bisa [ 7, -1 ], tpi gua enakan kaya gini si, haha
          "className" : "text-center"
        }
      ]
		});

    $('#table2').DataTable({
      // "dom": 'Bfrtip',
      // "buttons": [
      //   'print'
      // ],
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?= site_url('user/get_ajax_online') ?>",
        "type" : "POST"
      },
      "columnDefs" : [
        {
          "targets" : [2,3], // bisa [ 7, -1 ], tpi gua enakan kaya gini si, haha
          "className" : "text-center"
        },
        {
          "targets" : [3,4], // bisa [ 7, -1 ], tpi gua enakan kaya gini si, haha
          "className" : "text-center"
        }
      ]
		});
  });
</script>
