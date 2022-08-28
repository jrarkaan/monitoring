<!doctype html>
<html>
<head>
    <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
    </head>
    <body>
        
        <section class="section"> 
            <div class="section-header">
                <h4 style="bold"> List History Of Your Online Meeting Scheduling </h4>
            </div>  
            <div class="card">

                <div class="card-body">

                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-md-4">
                            <?php echo anchor(site_url('formonline/create'),'Create New Booking Room', 'class="btn btn-primary"'); ?>
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
                    </div>
                    <!-- <?= print_r($formonline_data) ?> -->
                    <!-- table responsive -->     
                    <div class="table-responsive overflow-auto">
                        <table class="table table-bordered" id="table-offline">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Nama User</th>
                                    <th>Nama Ruang</th>
                                    <th>Kategori Meeting</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($formonline_data)){ ?>
                                    <?php foreach($formonline_data as $value){ ?>
                                    <tr>
                                        <td width="30px"><?= ++$start ?></td>
                                        <td><?= $value->nama_user ?></td>
                                        <td><?= $value->namaruang ?></td>
                                        <td><?= $value->kategorimeeting === "newmeeting" ? "New Meeting" : ($value->kategorimeeting === "joinmeeting" ? "Join Meeting" : "null") ?></td>
                                        <td><?= date('d-m-Y', strtotime($value->tanggal)) ?></td>
                                        <td><?= ($value->status === "1") ? "<a class='badge badge-info text-white'>Belum di ACC</a>" : ($value->status === "3" ? "<a class='badge badge-success text-white'>Sudah di ACC</a>" : "<a class='badge badge-danger text-white'>Ditolak!</a>") ?></td>
                                        <td style="text-align:center" width="200px">
                                            <?php if($value->status == 3 || $value->status == 2){ ?>
                                                <a
                                                    id="<?=$value->id_pemesanan?>_<?=$value->kategorimeeting?>"
                                                    title="Detail"
                                                    class="btn btn-info btn-sm" 
                                                    data-toggle="modal" 
                                                    data-target="#modal-detail"
                                                    onclick="detailget((this.id))"
                                                ><i class="fas fa-fw fa-info text-white"></i>
                                                </a>
                                            <?php }else{  ?>
                                                <a
                                                    id="<?=$value->id_pemesanan?>_<?=$value->kategorimeeting?>"
                                                    title="Detail"
                                                    class="btn btn-info btn-sm" 
                                                    data-toggle="modal" 
                                                    data-target="#modal-detail"
                                                    onclick="detailget((this.id))"
                                                ><i class="fas fa-fw fa-info text-white"></i>
                                                </a>
                                                <a
                                                    id="set_detail_hapus-<?= $value->id_pemesanan ?>"
                                                    onclick="deleteData((this.id))"
                                                    title="Detail"
                                                    class="btn btn-danger btn-sm" 
                                                ><i class="fas fa-fw fa-trash text-white"></i>
                                                </a>
                                                <a
                                                    id="set_update"
                                                    title="Update"
                                                    class="btn btn-primary btn-sm" 
                                                    href="<?= site_url('formonline/updateDataBooking/'.$value->id_pemesanan.'/'.$value->kategorimeeting) ?>"
                                                >
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php }else {?>
                                <tr>
                                    <td class="text-center" colspan="7"><b>Maaf datanya belum ada yang diinputkan</b></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    
                    </div> <!-- div table responsive -->
                </div>  <!-- div card body -->
            </div>  <!-- div card -->

        </section>
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
                            <table class="table table-bordered no-margin" id="tableid">
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer bg-whitesmoke br" id="buttongroup">
                            
                        </div>
                    </div>
                </div>
            </div> <!-- end div modal -->
    </body>
</html>

<script>

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

    function detailget(idParams){
        const url = "<?= site_url('formonline/getDetailKategoriMeeting') ?>"
        const id = idParams.substr(0, 2);
        const kategorimeeting = idParams.substr(3);

        console.log(id);
        console.log(kategorimeeting)

        $.ajax({
            async:true,
            type: "POST",
            url: url,
            dataType: "JSON",
            data: {
                id, kategorimeeting
            },
            success:(response)=>{

                const { pesan, status, data, msg } = response;

                if(pesan === "Sukses" && status === true){
                    console.log(data[0]);

                    if(data[0].kategorimeeting === "newmeeting"){

                        $('#tableid tbody').html(`
                            <tr>
                                <th style="">Employee Number</th>
                                <td><span id="empno1">${data[0].emp_no}</span></td>
                            </tr>
                            <tr>
                                <th>Nama User</th>
                                <td><span id="namauser1">${data[0].nama_user}</span></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><span id="phone1">${data[0].phone}</span></td>
                            </tr>
                            <tr>
                                <th>Kategori Meeting</th>
                                <td><span id="kategorimeeting1">${data[0].kategorimeeting}</span></td>
                            </tr>
                            <tr>
                                <th>Nama Ruang</th>
                                <th><span id="namaruang1">${data[0].namaruang}</span></th>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td><span id="tanggal1">${data[0].tanggal}</span></td>
                            </tr>
                            <tr>
                                <th>Mulai</th>
                                <td><span id="mulai1">${data[0].mulai ? data[0].mulai : "Tidak ada inputan waktu"}</span></td>
                            </tr>
                            <tr>
                                <th>Selesai</th>
                                <td><span id="selesai1">${data[0].selesai ? data[0].selesai : "Tidak ada inputan waktu" }</span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span id="status1">${data[0].status === "1" ? "Belum di Approve" : data[0].status === "2" ? "Ditolak" : "Disetujui"}</span></td>
                            </tr>
                            <tr>
                                <th>Pesan Approve</th>
                                <td><span id="pesanapprove1">${data[0].pesan_approve === null ? "Belum ada Pesan" : data[0].pesan_approve}</span></td>
                            </tr>
                        `);

                    }else if(data[0].kategorimeeting === "joinmeeting"){

                        $('#tableid tbody').html(`
                            <tr>
                                <th style="">Employee Number</th>
                                <td><span id="empno1">${data[0].emp_no}</span></td>
                            </tr>
                            <tr>
                                <th>Nama User</th>
                                <td><span id="namauser1">${data[0].nama_user}</span></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><span id="phone1">${data[0].phone}</span></td>
                            </tr>
                            <tr>
                                <th>Kategori Meeting</th>
                                <td><span id="kategorimeeting1">${data[0].kategorimeeting}</span></td>
                            </tr>
                            <tr>
                                <th>Nama Ruang</th>
                                <th><span id="namaruang1">${data[0].namaruang}</span></th>
                            </tr>
                            <tr>
                                <th>Link atau ID</th>
                                <td><span id="tanggal1">${data[0].linkatauid}</span></td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td><span id="mulai1">${data[0].password}</span></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td><span id="mulai1">${data[0].tanggal}</span></td>
                            </tr>
                            <tr>
                                <th>Mulai</th>
                                <td><span id="mulai1">${data[0].mulai ? data[0].mulai : "Tidak ada inputan waktu"}</span></td>
                            </tr>
                            <tr>
                                <th>Selesai</th>
                                <td><span id="mulai1">${data[0].selesai ? data[0].selesai : "Tidak ada inputan waktu"}</span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span id="status1">${data[0].status === "1" ? "Belum di Approve" : data[0].status === "2" ? "Ditolak" : "Disetujui"}</span></td>
                            </tr>
                            <tr>
                                <th>Pesan Approve</th>
                                <td><span id="pesanapprove1">${data[0].pesan_approve === null ? "Belum ada Pesan" : data[0].pesan_approve}</span></td>
                            </tr>
                        `);

                    }

                }else{
                    swal.fire("Meeting Online", msg, "error");
                }  

            },
            error: ()=>{
                swal.fire("Meeting Online", "Error AJAX! harap hubungi TIM IT!", "error");
           }
        });
    }

    function deleteData(idParams){

        const id_pemesanan = idParams.substr(17);

        const url = "<?= site_url('formonline/delete_ajax') ?>"
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
                    data: { id_pemesanan },
                    success:(response)=>{
                        const { msg, status, pesan } = response;

                        if(pesan === "Sukses" && status === true){
                            Swal.fire({
                              title: 'Sukses dihapus!',
                              text: msg,
                              icon: 'success',
                              timer: 2000,
                            }).then(() => {
                                window.location.href = "<?= site_url("formonline") ?>";
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