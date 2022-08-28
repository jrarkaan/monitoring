<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register &mdash; PT KSS</title>
   <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
   <!-- CSS Libraries -->
   <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap-social/bootstrap-social.css">
   <!-- JS Libraries -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   <!-- sweetalert 2 -->
   <script src="<?= base_url() ?>/template/assets/js/sweetalert2.all.min.js" ></script>
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

                        <div class="card-header">
                           <h4 class="center">Register</h4>
                        </div>

                        <div class="card-body">
                           <div id="body1">
                              <div class="row"> 
                                 <div class="form-group col-6">
                                    <label>Employee Number</label>
                                    <input 
                                       id="emp_no" 
                                       type="text" 
                                       class="form-control form-control-user" 
                                       name="emp_no"
                                    >
                                 </div>
                                 <div class="form-group col-6">
                                    <label >Employee Name </label>
                                    <input 
                                       id="nama_user" 
                                       type="text" 
                                       class="form-control" 
                                       name="nama_user" 
                                    >
                                 </div>
                              </div> <!-- end div row 2 -->
                              <div class="form-group">
                                 <label>Email</label>
                                 <input 
                                    id="email" 
                                    type="email" 
                                    class="form-control" 
                                    name="email"
                                 >
                              </div>
                              <div class="form-group">
                                 <label >Phone Number</label>
                                 <input 
                                    id="phone" 
                                    type="number" 
                                    class="form-control" 
                                    name="phone"
                                 >
                                 <label style="color: red" for="basic-url">Inputkan Nomor Whatsapp, sistem akan mengirimkan OTP</label>
                              </div>
                              <div class="form-group">
                                 <label >Address</label>
                                 <input 
                                    id="alamat" 
                                    type="text" 
                                    class="form-control" 
                                    name="alamat"
                                 >
                              </div>
                              <div class="row">
                                 <div class="form-group col-6">
                                    <label class="d-block">Password</label>
                                    <input 
                                       id="password1" 
                                       type="password" 
                                       class="form-control" 
                                       name="password1" 
                                    >
                                 </div>
                                 <div class="form-group col-6">
                                    <label class="d-block">Password Confirmation</label>
                                    <input id="password2" 
                                       type="password" 
                                       class="form-control" 
                                       name="password2" 
                                    >
                                 </div>
                              </div>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-primary btn-lg btn-block" id="simpan">
                                    Register
                                 </button>
                              </div>
                              <div class="text-center">
                                 <a  href="<?= base_url('auth');?>">
                                 Already have an account? Login!</a>
                              </div>
                           </div>  <!-- end id body 1 -->
                        </div>
                        <div class="simple-footer">
                           Copyright &copy; Vhairin Sevithalia
                        </div>
                     </div><!-- end div card -->

                  </div>

               </div> <!-- end div row 2 -->

            </div>
         </section>
         <div class="modal fade" id="modalotp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Konfirmasi OTP</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div>
                        <div class="form-group">
                           <label for="number-otp" class="col-form-label">Nomor OTP:</label>
                           <input type="number" class="form-control" id="number-otp">
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary" id="konfirmasi-otp">Konfirmasi</button>
                  </div>
               </div>
            </div>
         </div>
      </div> <!-- end div -->

      <!-- General JS Scripts -->
      <script src="<?=base_url()?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="<?=base_url()?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
      <script src="<?=base_url()?>/template/assets/js/stisla.js"></script>
      <script src="<?=base_url()?>/template/assets/js/scripts.js"></script>
      <script src="<?=base_url()?>/template/assets/js/custom.js"></script>

      <script>
         $(document).ready(function(){
            localStorage.clear();
         });

         const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000
         });

         const konfirmasi_otp = (otp)=>{
            const kata = `
               -Jangan Reply Pesan ini-\n Kode OTP anda untuk registrasi akun adalah ${otp}
            `;
            return kata;
         }

         const validateEmail = (email)=>{
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
         } // validate email

         const randomCode = (length)=>{
            let result           = '';
            let characters       = '0123456789';
            let charactersLength = characters.length;
            for ( let i = 0; i < length; i++ ) {
               result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
         } // random code

         const validate = (data) =>{
            const {
               emp_no, nama_user, email, phone,
               alamat, password, password2
            } = data;

            if(validateEmail(email) !== true){
               Toast.fire({
                  icon: "error",
                  html: "Maaf email yang anda masukkan tidak sesuai dengan format!"
               });
            }

            if(emp_no.length >= 0 && emp_no.length <= 7){
               Toast.fire({
                  icon: "error",
                  html: "Maaf Employee Number yang anda masukkan tidak sesuai dengan format!"
               });
            }

            if(emp_no.length > 8){
               Toast.fire({
                  icon: "error",
                  html: "Maaf Employee Number yang anda masukkan tidak sesuai dengan format!"
               });
            }

            if(nama_user.length >= 0 && nama_user.length < 3){
               Toast.fire({
                  icon: "error",
                  html: "Maaf nama_user minimal 3 Karakter!"
               });
            }

            if(phone.length < 11 || phone.length > 13){
               Toast.fire({
                  icon: "error",
                  html: "Maaf Number Phone tidak sesuai!"
               });
            }

            if(password.length < 3 || password2.length < 3){
               Toast.fire({
                  icon: "error",
                  html: "Maaf password terlalu pendek!"
               });
            }

            if(password !== password2){
               Toast.fire({
                  icon: "error",
                  html: "Maaf password tidak sesuai dengan password konfirmasi!"
               });
            }

            if(alamat.length >= 0 && alamat.length <= 6){
               Toast.fire({
                  icon: "error",
                  html: "Maaf Alamat terlalu pendek!"
               });
            }

         } // validate


         $('#simpan').on('click', function(){

            const emp_no = $('#emp_no').val();
            const nama_user = $('#nama_user').val();
            const email = $('#email').val();
            const phone = $('#phone').val();
            const alamat = $('#alamat').val();
            const password = $('#password1').val();
            const password2 = $('#password2').val();
            
            const data = {
               emp_no, nama_user, email, phone,
               alamat, password, password2
            };

            validate(data);

            if(validateEmail(email) === true && emp_no.length === 8 && nama_user.length >= 3 && phone.length >= 11 && phone.length <= 13 && password === password2 && password.length >= 3 && alamat.length > 6){
               

               const otp = randomCode(6);
              
               Swal.fire({
                  title: 'Loading',
                  width: 200
               });

               Swal.showLoading();

               $.ajax({
                  async: true,
                  type: "POST",
                  url: "<?= site_url('auth/api_otp') ?>",
                  data: {
                     phone,
                     message: konfirmasi_otp(otp)
                  },
                  dataType: "JSON",
                  success: (response)=>{

                     const {
                        status
                     } = response;

                     if(status === "0"){
                        Swal.close();
                        Toast.fire({
                           icon: "error",
                           html: "Terjadi error pada API! Hubungi TIM IT!"
                        });
                     }else if(status === "1"){

                        Swal.close();
                        $('#modalotp').modal('show');
                        localStorage.setItem('otp', JSON.stringify(otp));
                        localStorage.setItem('data', JSON.stringify(data));
                        
                     }

                  },
                  error: ()=>{
                     Swal.close();
                     swal.fire("Registrasi", "Error pada AJAX! harap hubungi TIM IT!", "warning");
                  }
               });
               
            }

         });

         $('#konfirmasi-otp').on('click', function(){
            
            const otp = JSON.parse(localStorage.getItem('otp'));
            const otpInput = $('#number-otp').val();
            const dataUser = JSON.parse(localStorage.getItem('data'));

            if(Number(otp) !== Number(otpInput)){
               Toast.fire({
                  icon: "error",
                  html: "OTP Tidak sesuai!"
               });
            }else{
               
               const {
                  emp_no, nama_user, email, phone,
                  alamat, password,
                } = dataUser;
               Swal.fire({
                 title: 'Loading',
                 width: 190
               });

               Swal.showLoading();

               $.ajax({
                  async: true,
                  url: "<?= site_url('auth/store') ?>",
                 dataType: "JSON",
                  type: "POST",
                  data: { 
                     emp_no, nama_user, email, phone,
                     alamat, password, 
                  },
                  success: function(response){
                     
                     const {
                        pesan, status, msg
                     } = response;

                     if(pesan === "Sukses"){
                        Swal.close();
                        $('#modalotp').modal('hide');

                        Toast.fire({
                           icon: "success",
                           html: msg
                        }).then(()=>{
                           window.location.href = "<?= site_url("auth") ?>";
                        })
                     }else if(pesan === "Gagal"){
                        Swal.close();
                        $('#modalotp').modal('hide');
                        Toast.fire({
                           icon: "error",
                           html: msg
                        }).then(()=>{
                           window.location.href = "<?= site_url("auth/registrasi") ?>";
                        })
                     }

                  },
                  error: function(){
                     Toast.fire({ icon: "error", html: "Error pada AJAX Registrasi! Silahkan hubungi TIM IT!" });
                  }
               })

            }
         });

      </script>

   </body>
</html>