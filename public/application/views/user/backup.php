<section class="section">
  <div class="section-header" >
    <h4 style="bold" > Welcome To PT Karimun Sembawang Shipyard Website </h4>
  </div>
  
  <div class="section-body">

    <div class="row">
          
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card cardinformation ">
  
            <div class="card-header d-flex justify-content-between">
              
              <h4>List data booking ruangan pada bulan ini</h4>
              <div>
                <input type="text" class="form-control" placeholder="Cari.." aria-label="Username" aria-describedby="basic-addon1">
              </div>
  
            </div>
            <div class="card-body overflow-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama User</th>
                    <th style="width: 25%" scope="col">Nama Ruang</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php if(isset($listDataOfBooking)){ ?>
                  <?php foreach($listDataOfBooking as $data){ ?>
                    <tr>
                      <td><?= $counter++ ?></td>
                      <td><?= $data->emp_no ?></td>
                      <td><?= $data->nama_user ?></td>
                      <td><?= $data->namaruang ?></td>
                      <td><?= $data->tanggal ?></td>
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

    </div>

</section>
