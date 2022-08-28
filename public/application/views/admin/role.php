<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <section class="section">
        <div class="section-header" >
        <h4 style="bold" > Role Management </h4>
        </div>
  
    <div class="card">
    <div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>

            <table class="table table-bordered" style="margin-bottom: 10px">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $r) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $r['role']; ?></td>
                        <td>
                            <a href="<?= base_url('admin/roleaccess/') . $r['id_userlevel']; ?>" 
                            class="badge badge-warning">access</a>
                            <a href="#" class="badge badge-success" id="<?= $r['role'] ?>" onclick="editrole(this.id, '<?= $r["id_userlevel"] ?>')" >edit</a>
                            <a href="#" id="delete-data" onclick=deletedata(<?= $r["id_userlevel"] ?>) class="badge badge-danger">delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>
</section>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="tambah-user" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
<div id="body-1"></div>
</div> 

<script>

    $(document).on('click', '#edit-user', function(){
        const nama = $('#edit-nama').val();
        const id = $('#id-nama').val();

        console.log(id);
        swal.fire({
            title: "Role Management",
            text: "Apakah Anda yakin ingin memperbarui Data?",
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
                    dataType: "JSON",
                    url: "<?= site_url('C_role/update_ajax') ?>",
                    data: { nama, id },
                    success:(response)=>{
                        const { indctr, msg } = response;

                        if(indctr === 1){
                            swal.fire("Booking Room", msg, "info");
                            window.location.href = "<?= site_url("C_role/index") ?>";
                        }else if(indctr === 0){
                            swal.fire("Booking Room", msg, "warning");
                        }
                    },
                    error:()=>{
                        swal.fire("Delete Role", "Error! harap hubungi TIM IT!", "warning");
                    }
                });

            }else if(result.isDenied){
                swal.fire("Delete Role", "Delete Role dibatalkan!", "info");
            }
            
        });

    });

    function editrole(role_user, id){
        const nama = role_user;
        const id_user  = id;
        // console.log(nama);
        $('#body-1').html(`
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="edit-nama" name="role" value="${nama}" placeholder="Role name">
                            <input class="form-control" type="hidden" id="id-nama" name="role" value="${id_user}" placeholder="Role name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="edit-user" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        `);

        $('#editModal').modal('show');
    }

    function deletedata(id_role){
        const id_user = id_role;

        console.log(id_user);

        swal.fire({
            title: "Role Management",
            text: "Apakah Anda yakin ingin menghapus Data?",
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
                    dataType: "JSON",
                    url: "<?= site_url('C_role/delete_ajax') ?>",
                    data: { id_role: id_user },
                    success:(response)=>{
                        const { indctr, msg } = response;

                        if(indctr === 1){
                            swal.fire("Booking Room", msg, "info");
                            window.location.href = "<?= site_url("C_role/index") ?>";
                        }else if(indctr === 0){
                            swal.fire("Booking Room", msg, "warning");
                        }
                    },
                    error:()=>{
                        swal.fire("Delete Role", "Error! harap hubungi TIM IT!", "warning");
                    }
                });

            }else if(result.isDenied){
                swal.fire("Delete Role", "Delete Role dibatalkan!", "info");
            }
            
        });
    }

    $(document).on('click', '#tambah-user', function(){
        const nama = $('#role').val();

        $.ajax({
            async: true,
            type: "POST",
            dataType: "JSON",
            url: "<?= site_url('C_role/add_ajax') ?>",
            data: { role: nama },
            success:(response)=>{
                const { indctr, msg } = response;

                if(indctr === 1){
                    swal.fire("Booking Room", msg, "info");
                    window.location.href = "<?= site_url("C_role/index") ?>";
                }else if(indctr === 0){
                    swal.fire("Booking Room", msg, "warning");
                }

            },
            error:()=>{
                swal.fire("Add Role", "Error! harap hubungi TIM IT!", "warning");
            }
        });

    });

</script>