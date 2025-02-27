  <?php require_once "fungsi/back_controller.php" ?>
  <?php 
  session_start();
  if (!isset($_SESSION['id_user_admin'])) {
    # code...
    header('Location:index.php');
  }
   ?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center bg-white" href="" style="box-shadow: 0px 0px 4px 0px silver">
        <div class="sidebar-brand-icon">
          <img src="assets/img/logo.png" style="width: 80px;height:60px;">
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      

      <!-- Nav Item - Dashboard -->

<hr class="sidebar-divider">
<div class="sidebar-heading">Home</div>
      <li class="nav-item" id="sidebar_dashboard">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard </span>
        </a>
      </li>
<?php if ($_SESSION['role'] == "OWNER"): ?>
<hr class="sidebar-divider">
<div class="sidebar-heading">Setup</div>
       <li class="nav-item" id="sidebar_user">
        <a class="nav-link" href="user.php">
          <i class="fa fa-users"></i>
          <span>Daftar User </span>
        </a>
      </li>
      <li class="nav-item" id="sidebar_terms">
        <a class="nav-link" href="terms.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Terms & Condition </span>
        </a>
      </li>
    

    <?php endif ?>
      
<hr class="sidebar-divider">
<div class="sidebar-heading">Buat Fitting</div>
      <li class="nav-item " id="sidebar_fitting">
        <a class="nav-link" href="fitting.php" >
          <i class="fas fa-clipboard-check  "></i>
          <span>Fitting </span>
        </a>
      </li>
      <li class="nav-item " id="sidebar_akad">
        <a class="nav-link" href="akad.php" >
          <i class="fa fa fa-handshake"></i>
          <span>Akad </span>
        </a>
      </li>
      <li class="nav-item " id="sidebar_resepsi">
        <a class="nav-link" href="resepsi.php" >
          <i class="fa fa-heart "></i>
          <span>Resepsi </span>
        </a>
      </li>
      <li class="nav-item " id="sidebar_ngunduh">
        <a class="nav-link" href="ngunduh.php" >
          <i class="fa fa-download"></i>
          <span>Ngunduh </span>
        </a>
      </li>
      <li class="nav-item " id="sidebar_ibu_pengantin">
        <a class="nav-link" href="ibu_pengantin.php" >
          <i class="fa fa-female "></i>
          <span> &nbsp&nbspIbu Pengantin </span>
        </a>
      </li>
      <li class="nav-item " id="sidebar_bapak_pengantin">
        <a class="nav-link" href="bapak_pengantin.php" >
          <i class="fa fa-male"></i>
          <span>&nbsp&nbsp&nbspBapak Pengantin </span>
        </a>
      </li>
      <li class="nav-item " id="sidebar_jaga_kado">
        <a class="nav-link" href="jaga_kado.php" >
          <i class="fa fa-inbox"></i>
          <span>Jaga Kado </span>
        </a>
      </li>

      <?php if ($_SESSION['role'] == "OWNER"): ?>

<hr class="sidebar-divider">
<div class="sidebar-heading">Finance</div>

      <li class="nav-item " id="sidebar_items">
        <a class="nav-link" href="items.php" >
          <i class="fa fa-box "></i>
          <span>Master Items </span>
        </a>
      </li>

      <li class="nav-item " id="sidebar_invoice">
        <a class="nav-link" href="invoice.php" >
          <i class="fas fa-file-invoice "></i>
          <span>Invoice </span>
        </a>
      </li>
  
      <li class="nav-item " id="sidebar_report">
        <a class="nav-link" href="report.php" >
          <i class="fa fa-money-check"></i>
          <span>Report </span>
        </a>
      </li>

<?php endif ?>
<hr class="sidebar-divider">

      <li class="nav-item " id="sidebar_logout">
        <a class="nav-link" onclick="logout()" style="cursor: pointer;">
          <i class="fa fa-sign-out-alt"></i>
          <span>Logout </span>
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="">

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
