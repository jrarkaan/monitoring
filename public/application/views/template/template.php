
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title> PT KSS &mdash; vhairin </title>
  <!-- Datatable CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
  <link href='https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css' rel='stylesheet' type='text/css'>
  <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel='stylesheet' type='text/css' >

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
  <!-- Moment.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
  <!-- datetimepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <!-- sweetalert 2 -->
  <script src="<?= base_url() ?>/template/assets/js/sweetalert2.all.min.js" ></script>
  
  <!-- Datatable JS -->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
  <link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/fontawesome-free-5.15.3-desktop/css/all.css">
  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
              <i class="fas fa-bars"></i></a></li>
          </ul>
          <div >
            <div class="search-backdrop"></div>
            <div class="search-result">
            </div>
          </div>
        </form>

      
      
      <!-- header kanan  -->  
      <ul class="navbar-nav navbar-right">  
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?=base_url()?>/template/assets/img/avatar/avatar-1.png" style="border-radius: 50% !important" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"> <?=$this->fungsi->user_login()->nama_user?> </div></a>
            <div class="dropdown-menu dropdown-menu-right">

              <div class="dropdown-title">Short Profile</div>
              <a class="dropdown-item has-icon">
                <i class="fas fa-id-badge"></i> <?=$this->fungsi->user_login()->emp_no?>
              </a>
              <a class="dropdown-item has-icon">
                <i class="fas fa-envelope"></i> <?=$this->fungsi->user_login()->email?>
              </a>
              <a  class="dropdown-item has-icon">
                <i class="fas fa-map-marked-alt" ></i> <?=$this->fungsi->user_login()->alamat?>
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?=base_url('auth/logout')?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <!-- main-sidebar -->
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">PT KSS</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">PT KSS</a>
          </div>
          <ul class="sidebar-menu ">
          <!-- QUERY MENU -->
            <?php 
              $id_userlevel = $this->session->userdata('id_userlevel');
              $queryMenu = "SELECT `user_menu`.`id`, `menu`
                              FROM `user_menu` JOIN `user_access_menu`
                                ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                            WHERE `user_access_menu`.`id_userlevel` = $id_userlevel
                          ORDER BY `user_access_menu`.`menu_id` ASC ";
              $menu = $this->db->query($queryMenu)->result_array();
              ?>


            <!-- LOOPING MENU -->
            <?php foreach ($menu as $m) : ?>
             <ul class="sidebar-menu">
            <li class="menu-header" >
               <span> <?= $m['menu']; ?> </span>
            </li>
            </ul>

            <!-- SIAPKAN SUB-MENU SESUAI MENU -->
            <?php 
            $menuId = $m['id'];
            $querySubMenu = "SELECT *
                               FROM `user_sub_menu` JOIN `user_menu` 
                                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                              WHERE `user_sub_menu`.`menu_id` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                        ";
            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>

            <?php foreach ($subMenu as $sm) : ?>
              <li>
                    <a class="nav-link" href="<?= base_url($sm['url']); ?>">       
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
              </li>
            <?php endforeach; ?>

           
            <?php endforeach; ?>
            <ul class="sidebar-menu">
            <li class="menu-header" >
            <span> LOGOUT </span>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>
          
            </li>
            </ul>


            
            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="https://Google.com/" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Need Something?
              </a>
            </div>

            </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <?php echo $contents ?>
      </div>

       <!-- Main Footer -->
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?= date('Y');?> <div class="bullet"></div> Developed By <a href="">Vhairin Sevithalia</a>
        </div>
        <div class="footer-right">
          PT KSS
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?=base_url()?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="<?=base_url()?>/template/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?=base_url()?>/template/assets/js/scripts.js"></script>
  <script src="<?=base_url()?>/template/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->

  <script>
  
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 2000
    });

    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeAccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        });

    });
  </script>
</body>
</html>