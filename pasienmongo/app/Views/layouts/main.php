
<!DOCTYPE html>
<html>
<head>
  <title>CI4 KLINIK</title>
</head>
<!-- Custom fonts for this template-->
  <link href="<?=base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
 
  <!-- Custom styles for this template-->
  <link href="<?=base_url('assets/css/sb-admin-2.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/css/select2.min.css')?>" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="<?=base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css')?>" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url('assets/css/animated.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/dataTables.bootstrap4.css')?>">
  <meta name="csrf_token" content="<?= csrf_hash() ?>">


  <style type="text/css">
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            /* background-color: #fff; */
        }

        .pre {
            border: 1px solid grey;
            min-height: 10em;
        }

        .preloader .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font: 14px arial;
        }
  </style>

<body>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center bg-white" href="" style="">
        <div class="sidebar-brand-icon">
          <h5 class="text-success"><i class="fa fa-thermometer"></i> <i style="font-weight: bold">Klinik</i></h5>
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      

      <!-- Nav Item - Dashboard -->

<hr class="sidebar-divider">

       <li class="nav-item" id="sidebar_user">
        <a class="nav-link" href="/">
          <i class="fa fa-users"></i>
          <span>Pasien </span>
        </a>
      </li>
   
    
  

      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-success topbar mb-4 static-top shadow" style="">


          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
      

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
          
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fa fa-power-off"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               
                <a class="dropdown-item" onclick="logout()">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
     

<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<!-- <div class="preloader" style="width: 100%;height: 600px; background-color: rgba(255,255,255,0.5);">
      <div class="loading">
        <img src="assets/img/logo.png" width="80">
        <p class="text-white">Harap Tunggu</p>
      </div>
    </div>   -->



</body>
</html>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/js/sb-admin-2.min.js')?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js')?>"></script>

<script src="<?= base_url('assets/js/jquery.dataTables.js')?>"></script>
<script src="<?= base_url('assets/js/dataTables.bootstrap4.js')?>"></script>
<script src="<?= base_url('assets/js/select2.min.js')?>"></script>
<script src="<?= base_url('assets/vendor/chart.js/chart.js')?>"></script>

<script src="<?= base_url('assets/js/demo/datatables-demo.js')?>"></script>
<script src="<?= base_url('assets/js/sweetalert/sweetalert.min.js')?>"></script>

<script type="text/javascript">


</script>
<!-- Modal -->


 <?= $this->renderSection('content') ?>

</div>
<!-- End of Content Wrapper -->
</div>