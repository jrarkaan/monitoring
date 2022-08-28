<section class="section"> 
   <div class="section-header">
       <h4 style="bold"> Booking Room Form  </h4>
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
                       value="<?= $data[0]->emp_no ?>" 
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
               <div class="form-group">
                   <label for="varchar"> Name of Room <?php echo form_error('namaruang') ?></label>
                   <select name="namaruang" id="namaruang" class="form-control" disabled>
                       <option value="" hidden="true">Choose A Room</option>
                       <?php foreach ($getRuang as $ruang) : ?>
                           <option value="<?= $ruang['id_ruang']; ?>" <?= $ruang['id_ruang'] == $data[0]->nama_ruang ? "selected" : null ?> ><?= $ruang['namaruang']; ?></option>
                       <?php endforeach; ?>
                   </select>
               </div>
               <div class="form-group">
                   <label for="int"> Number Of Participants <?php echo form_error('jumlah_peserta') ?></label>
                   <input 
                       name="jumlah_peserta" 
                       id="jumlah_peserta" 
                       type="text" 
                       class="form-control" 
                       placeholder="Jumlah Peserta" 
                       value="<?= $data[0]->jumlah_peserta ?>"
                       readonly 
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
                       value="<?= $data[0]->nama_kegiatan; ?>"
                       readonly 
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
                       value="<?= $data[0]->tanggal ?>"
                       readonly
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
                       value="<?= $data[0]->mulai ?>"
                       readonly 
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
                       value="<?= $data[0]->selesai; ?>"
                       readonly 
                   />
               </div>
               <div class="form-group">
                   <label for="varchar"> Massage <?php echo form_error('pesan') ?></label>
                   <input 
                       type="text" 
                       class="form-control" 
                       name="pesan" 
                       id="pesan" 
                       value="<?= $data[0]->pesan_approve ?>"
                       readonly 
                   />
               </div>
               <input type="hidden" name="id_pemesanan" value="<?= $data[0]->id_pemesanan; ?>" /> 
               <a href="<?php echo site_url('reportoffline') ?>" class="btn btn-warning">Kembali</a>
           </form>
       </div> 
   </div>
</section>         