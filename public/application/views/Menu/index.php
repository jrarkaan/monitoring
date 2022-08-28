<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <section class="section">
        <div class="section-header" >
        <h4 style="bold" > Menu Management </h4>
        </div>
    
    <div class="card">
    <div class="card-body">
        <div class="col-lg-6">
        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

<?= $this->session->flashdata('message'); ?>

<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>
<form action="<?php echo base_url('Menu'); ?>">
<table  class="table table-bordered"  class="table table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Menu</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
            // $id_userlevel = $this->session->userdata('id_userlevel');
            // $queryMenu = "SELECT * from user_menu where `id_userlevel` = $id_userlevel";
            // $menu = $this->db->query($queryMenu)->result_array();
            ?>
    <?php $i = 1; ?>
        <?php foreach ($menu as $m) : ?>
        <tr>
            <th scope="row"><?= $i; ?></th>
            <td><?= $m['menu']; ?></td>
            <td>
            <a href="<?php echo base_url(); ?>menu/update/<?php echo $m['id']; ?>" class="badge badge-success" > Edit </a>
            <a href="<?php echo base_url(); ?>menu/hapus/<?php echo $m['id']; ?>"
             class="badge badge-danger" onclick=" return confirm('Are You Sure ?');" >Delete</a>
            </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
        </form>

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
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 

