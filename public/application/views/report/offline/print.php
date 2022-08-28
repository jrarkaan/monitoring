<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Form Offline Report</title>
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
      <input type="hidden" id="tahun" value="<?= $tahun ?>" />
      <input type="hidden" id="bulan" value="<?= $bulan ?>"/>
      <div class="container">
         <div style="margin-top: 50px; margin-bottom: 25px">
            <h3 class="text-center suket" >Laporan Form Offline</h3>
         </div>

         <table class="table table-striped table-bordered dt-responsive nowrap table-hover" id="table2" style="width:100%">
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama User</th>
                  <th scope="col">Nama Ruangan</th>
                  <th style="width: 25%" scope="col">Nama Kegiatan</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Mulai</th>
                  <th scope="col">Selesai</th>
                  <th scope="col">Lama Rapat</th>
               </tr>
            </thead>
         </table>
      </div>
   </body>
   <script>
      $(document).ready(function(){
         const tahun = $('#tahun').val();
         const bulan = $('#bulan').val();

         let url1 = "<?= site_url('reportoffline/get_ajax/a/b') ?>"

         const newURL = url1.replace(url1.substr(45, 46), `/${bulan}/b`);

         const newURL1 = newURL.length === 49 ?
            newURL.replace(newURL.substr(47, 48), `/${tahun}`)
               : newURL.replace(newURL.substr(48, 49), `/${tahun}`);

         console.log(newURL1);

         $('#table2').DataTable({
            "dom": 'Bfrtip',
            "buttons": [
              'print'
            ],
            "processing": true,
            "serverSide": true,
            "aLengthMenu": [
               [25, 50, 100, 200, -1],
               [25, 50, 100, 200, "All"]
            ],
            "iDisplayLength": -1,
            "ajax": {
               "url": newURL1,
               "type" : "POST",
            },
            "columnDefs" : [
               {
                  "targets" : [2,3], // bisa [ 7, -1 ], tpi gua enakan kaya gini si, haha
                  "className" : "text-center"
               },
               {
                  "targets" : [3,4], // bisa [ 7, -1 ], tpi gua enakan kaya gini si, haha
                  "className" : "text-center"
               }
            ]
         });
      });
   </script>
</html>