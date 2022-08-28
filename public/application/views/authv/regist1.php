
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; PT KSS</title>

  <!-- General CSS Files -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">-->
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap-social/bootstrap-social.css">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="<?=base_url()?>/template/assets/img/PTKSS.jpg" alt="logo" width="80" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4 class="center">Register</h4></div>
              
              <div class="card-body">
                <form  class="user" method="POST"  action="<?= base_url('auth/registrasi');?>">
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Employee Number</label>
                      <input id="emp_no" type="text" class="form-control form-control-user" name="emp_no"
                      value="<?= set_value ('emp_no'); ?>">
                      <?= form_error('emp_no', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                    <div class="form-group col-6">
                      <label >User Name</label>
                      <input id="nama_user" type="text" class="form-control" name="nama_user" 
                       value="<?= set_value ('nama_user'); ?> ">
                      <?= form_error('nama_user', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input id="email" type="email" class="form-control" name="email"
                    value="<?= set_value ('email'); ?>" >
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>')?>
                  </div>
                  <div class="form-group">
                    <label >Phone Number</label>
                    <input id="phone" type="text" class="form-control" name="phone"
                    value="<?= set_value ('phone');?>">
                    <?= form_error('phone', '<small class="text-danger pl-3">', '</small>')?>
                  </div>
                  <div class="form-group">
                    <label >Address</label>
                    <input id="alamat" type="text" class="form-control" name="alamat"
                    value="<?= set_value ('alamat');?>">
                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>')?>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label class="d-block">Password</label>
                      <input id="password1" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password1" >
                      <?= form_error('password1', '<small class="text-danger pl-3">', '</small>')?>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label  class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password2" >
                      <?= form_error('password2', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                  <div class="text-center">
                      <a  href="<?= base_url('auth');?>">
                      Already have an account? Login!</a>
                  </div>
                </form>
              </div>
            </div>

            <div class="simple-footer">
              Copyright &copy; Vhairin Sevithalia
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

 <!-- General JS Scripts -->
  <script src="<?=base_url()?>/template/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url()?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->
  <script src="<?=base_url()?>/template/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?=base_url()?>/template/assets/js/scripts.js"></script>
  <script src="<?=base_url()?>/template/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>
