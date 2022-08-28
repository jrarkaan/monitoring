<!doctype html>
<html>
    <head>
        <title>PT Karimun Sembawang Shipyard</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
    </head>

    <body>
    <section class="section"> 
        <div class="section-header">
            <h4 style="bold">List Permintaan Persiapan Meeting Offline </h4>
        </div>
    <div class="card">
    
    <div class="card-body">
        <div class="row " style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('formonffline/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">

                <form action="<?php echo site_url('formonffline/index'); ?>" class="form-inline" method="get">
                    <div class="input-group"  >
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('formonffline'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    <div class="col-lg">
        <table class="table table-bordered">
            <tr>
                <th width="30px">No</th>
                <th width="100px">Emp No</th>
                <th width="100px" >Nama User</th>
                <th>Phone</th>
                <th width="300px">Nama Ruang</th>
                <th width="30px">Jumlah Peserta</th>
                <th width="300px">Nama Kegiatan</th>
                <th width="100px">Tanggal</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th width="300px">Pesan</th>
                <th width="100px">Action</th>
            </tr><?php
            foreach ($formonffline_data as $formonffline)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $formonffline->emp_no ?></td>
			<td><?php echo $formonffline->nama_user ?></td>
			<td><?php echo $formonffline->phone ?></td>
			<td><?php echo $formonffline->nama_ruang ?></td>
			<td><?php echo $formonffline->jumlah_peserta ?></td>
			<td><?php echo $formonffline->nama_kegiatan ?></td>
			<td><?php echo $formonffline->tanggal ?></td>
			<td><?php echo $formonffline->mulai ?></td>
			<td><?php echo $formonffline->selesai ?></td>
			<td><?php echo $formonffline->pesan ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('formonffline/read/'.$formonffline->id_pemesanan),'<i class="fas fa-fw fa-eye"> </i>'); 
				echo ' | '; 
				echo anchor(site_url('formonffline/update/'.$formonffline->id_pemesanan),'<i class="fas fa-fw fa-wrench"></i>'); 
				echo ' | '; 
				echo anchor(site_url('formonffline/delete/'.$formonffline->id_pemesanan),'<i class="fas fa-fw fa-trash-alt"></i>',
                'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
       </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
       
    </body>






    <?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
    }

    public function index()
    {
        
        $data['user'] = $this->db->get_where('user',['emp_no' => $this->session->userdata('emp_no')])->row_array();
    //this->load fungsi di library template-> load view(folder/template.php,isi yang diinginkan)
        $this->template->load('template/template','admin/dashboardadm', $data);
     
    }
    
        public function role()
        {
            $data['title'] = 'Role';
            $data['user'] = $this->db->get_where('user',['emp_no' => $this->session->userdata('emp_no')])->row_array();
            $data['role'] = $this->db->get('userole')->result_array();
    
            $this->template->load('template/template','admin/role', $data);
        }


        public function roleAccess($id_userlevel)
        {
            $data['title'] = 'Management Role Access';
            $data['user'] = $this->db->get_where('user',['emp_no' => $this->session->userdata('emp_no')])->row_array();
            $data['role'] = $this->db->get_where('userole', ['id_userlevel' => $id_userlevel])->row_array();
    
            $this->db->where('id!=', 1);
            $data['menu'] = $this->db->get('user_menu')->result_array();
    
            $this->template->load('template/template','admin/role-access', $data);
        }
    
    
        public function changeAccess()
        {
            $menu_id = $this->input->post('menuId');
            $id_userlevel = $this->input->post('roleId');
    
            $data = [
                'id_userlevel' => $id_userlevel,
                'menu_id' => $menu_id
            ];
    
            $result = $this->db->get_where('user_access_menu', $data);
    
            if ($result->num_rows() < 1) {
                $this->db->insert('user_access_menu', $data);
            } else {
                $this->db->delete('user_access_menu', $data);
            }
    
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
        }

        public function update($id) 
        {
            $row = $this->Role_model->get_by_id($id);
    
            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('admin/update_action'),
            'role' => set_value('role', $row->id_userlevel),
            );
            $this->template->load('template/template','admin/role', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('role'));
            }
        }
        
        public function update_action() 
        {
            $this->_rules();
    
            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_userlevel', TRUE));
            } else {
                $data = array(
            'role' => $this->input->post('role',TRUE),
            );
    
                $this->Role_model->update($this->input->post('id_userlevel', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('template/template','admin/role'));
            }
        }

}
    






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
                            <a href="" class="badge badge-success" data-toggle="modal" data-target="#newRoleModal1">Edit</a>
                            <a href="" class="badge badge-danger">delete</a>
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
            <form action="<?= base_url('admin/role'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
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

<div class="modal fade" id="newRoleModal1" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Update Role Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/update'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div> 

</html>

