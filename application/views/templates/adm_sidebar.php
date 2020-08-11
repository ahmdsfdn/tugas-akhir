<!-- Page Wrapper -->
  <div id="wrapper" >

    <!-- Sidebar -->
       <?php if ($user['role_id'] == 2): ?>
               <ul class=" navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <?php else: ?>
               <ul class=" navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <?php endif ?>
   
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php base_url() ?>">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <?php if ($user['role_id'] == 2): ?>
              <div class="sidebar-brand-text mx-3">Admin</div>
        <?php else: ?>
              <div class="sidebar-brand-text mx-3">Owner</div>
        <?php endif ?>
        
      </a>



      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <?php if ($judul == 'Menu Utama') : ?>
      <li class="nav-item active">
      <?php else : ?>
      <li class="nav-item">
      <?php endif; ?>
        <a class="nav-link" href="<?= base_url(); ?>admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Menu Utama</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Heading -->
       <?php if ($user['role_id'] == 1): ?>

      <!-- PEMILIK PERUSAHAAN -->

      <!-- Nav Item - Dashboard -->
       <?php if ($judul == 'Laporan') : ?>
      <li class="nav-item <?= $active ?>">
        <?php else : ?>
      <li class="nav-item">
        <?php endif; ?>
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-folder"></i>
          <span>Laporan</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Laporan :</h6>
            <a class="collapse-item " href="<?= base_url(); ?>data_sewa">Data Sewa</a>
            <a class="collapse-item " href="<?= base_url(); ?>master/kas_masuk">Kas Masuk</a>
            <a class="collapse-item " href="<?= base_url(); ?>master/kas_keluar">Kas Keluar</a>
            <hr class="my-0">
            <a class="collapse-item " href="<?= base_url(); ?>admin/jurnal_umum">Jurnal Umum</a>    
            <a class="collapse-item " href="<?= base_url(); ?>jp">Jurnal Penyesuaian</a>
            <a class="collapse-item " href="<?= base_url(); ?>buku_besar">Buku Besar</a>
            <a class="collapse-item " href="<?= base_url(); ?>labarugi">Laba Rugi</a>
            <a class="collapse-item " href="<?= base_url(); ?>per_modal">Perubahan Modal</a>
            <a class="collapse-item " href="<?= base_url(); ?>poskeu">Posisi Keuangan</a>
            <a class="collapse-item " href="<?= base_url(); ?>labarugi/jurnal_penutup">Jurnal Penutup</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-folder"></i>
          <span>User Managemen</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">User Managemen</h6>
            <a class="collapse-item " href="<?= base_url(); ?>pemilik">User Aktivasi</a>
          </div>
        </div>
      </li>
      <?php else: ?>
              <!-- Nav Item - Pages Collapse Menu -->
      <?php if ($judul == 'Master Data') : ?>
      <li class="nav-item <?= $active ?>">
        <?php else : ?>
      <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-folder"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Master Data :</h6>
            <a class="collapse-item " href="<?= base_url(); ?>master/">Daftar Akun</a>
            <a class="collapse-item " href="<?= base_url(); ?>master/saldo_awal">Saldo Awal</a>   <a class="collapse-item " href="<?= base_url(); ?>data_sewa">Data Sewa</a>
            <a class="collapse-item " href="<?= base_url(); ?>master/kas_masuk">Kas Masuk</a>
            <a class="collapse-item " href="<?= base_url(); ?>master/kas_keluar">Kas Keluar</a>
          </div>
        </div>
      </li>

       <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
       <?php if ($judul == 'Transaksi') : ?>
      <li class="nav-item <?= $active ?>">
        <?php else : ?>
      <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTrans" aria-expanded="true" aria-controls="collapseThree">
           <i class="fas fa-fw fa-coins"></i>
          <span>Input Transaksi</span>
        </a>
        <div id="collapseTrans" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Input Transaksi :</h6>
            <a class="collapse-item " href="<?= base_url(); ?>admin/transaksi_m">Transaksi</a>
            <a class="collapse-item " href="<?= base_url(); ?>jp/tambah_jp">Transaksi Penyesuaian</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
       <?php if ($judul == 'Laporan') : ?>
      <li class="nav-item <?= $active ?>">
        <?php else : ?>
      <li class="nav-item">
        <?php endif; ?>
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-folder"></i>
          <span>Laporan</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Laporan :</h6>
            <a class="collapse-item " href="<?= base_url(); ?>admin/jurnal_umum">Jurnal Umum</a>
            <a class="collapse-item " href="<?= base_url(); ?>jp">Jurnal Penyesuaian</a>
            <a class="collapse-item " href="<?= base_url(); ?>buku_besar">Buku Besar</a>
            <a class="collapse-item " href="<?= base_url(); ?>labarugi">Laba Rugi</a>
            <a class="collapse-item " href="<?= base_url(); ?>per_modal">Perubahan Modal</a>
            <a class="collapse-item " href="<?= base_url(); ?>poskeu">Posisi Keuangan</a>
            <a class="collapse-item " href="<?= base_url(); ?>labarugi/jurnal_penutup">Jurnal Penutup</a>
       
          </div>
        </div>
      </li>


      <?php endif ?>



      <!-- Divider -->
     <!--  <hr class="sidebar-divider my-0"> -->

      <!-- Divider -->
    
    
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar