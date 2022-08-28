<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <section class="section">
        <div class="section-header" >
        <h4 style="bold" > <?= $title; ?> </h4>
        </div>
  
    <div class="card">
    <div class="card-body">
    <div class="row">
        <div class="col-lg-6">

            <?= $this->session->flashdata('message'); ?>

            <h5>Role : <?= $role['role']; ?></h5>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $m['menu']; ?></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                 <?= check_access($role['id_userlevel'], $m['id']); ?>
                                  data-role="<?= $role['id_userlevel']; ?>" data-menu="<?= $m['id']; ?>">
                            </div>
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
<!-- End of Main Content -- >     