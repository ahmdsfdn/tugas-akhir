<?php 
  
 

  $tahun = date('Y');
  $bulan = date('m');

  $tgl_now = date('Y-m-d');
  $this->db->where('tanggal_transaksi', $tgl_now);
  $this->db->select('SUM(debit) as total');
  $total_debit = $this->db->get_where('transaksi',['akun' => 'Kas'])->row()->total;

  $this->db->where('tanggal_transaksi', $tgl_now);
  $this->db->select('SUM(kredit) as total');
  $total_kredit = $this->db->get_where('transaksi',['akun' => 'Kas'])->row()->total;

  $this->db->where('tanggal_transaksi', $tgl_now);
  $kas= $this->db->get_where('transaksi',['akun' => 'Kas'])->result_array();

  $this->db->where('tanggal_transaksi', $tgl_now);
  $tran = $this->db->get('transaksi')->result_array();

$sama = 'awdkjalsfia';
  $data = array();
  foreach ($tran as $key) {
    
    if ($key['bukti_transaksi'] == $sama) {
     

    } else {
      $data[] = $key['bukti_transaksi'];
      $sama = $key['bukti_transaksi']; 
    }
    
  }

?>      
    <?php if ($user['role_id'] == 1): ?>
       <!-- PEMILIK -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Home</h1>
          </div>

          <div class="row">
            <div class="mb-2 mb-md-0 col-12 col-md-4">
              <div class="card shadow-sm">
                <div class="card-body">
                    <a style="width: 100%;" class="font-weight-bold btn btn-warning text-white" href="<?= base_url();?>data_sewa">Data Sewa</a>
                </div>
              </div>
            </div>
            <div class="mb-2 mb-md-0 col-12 col-md-4">
              <div class="card shadow-sm">
              
                <div class="card-body">
                    <a style="width: 100%;" class="font-weight-bold btn btn-warning text-white" href="<?= base_url();?>master/kas_masuk">Kas Masuk</a>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4 ">
              <div class="card shadow-sm">
                
                <div class="card-body">
                    <a style="width: 100%;" class="font-weight-bold btn btn-warning text-white" href="<?= base_url();?>master/kas_keluar">Kas Keluar</a>
                </div>
              </div>
            </div>
          </div>

          <!-- pembatas -->
          <hr class="my-4 ">

          <div class="row mb-2 mb-md-4">
            <div class="mb-2 mb-md-0 col-12 col-md-4">
              <div class="card shadow-sm">
                <div class="card-body">
                    <a style="width: 100%;" class="font-weight-bold btn btn-primary text-white" href="<?= base_url(); ?>admin/jurnal_umum">Jurnal Umum</a>
                </div>
              </div>
            </div>
            <div class="mb-2 mb-md-0 col-12 col-md-4">
              <div class="card shadow-sm">
              
                <div class="card-body">
                    <a style="width: 100%;" class="font-weight-bold btn btn-primary text-white" href="<?= base_url(); ?>jp">Jurnal Penyesuaian</a>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="card shadow-sm">
                
                <div class="card-body">
                    <a style="width: 100%;" class="font-weight-bold btn btn-primary text-white" href="<?= base_url(); ?>buku_besar">Buku Besar</a>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-4">
            <div class="mb-2 mb-md-0 col-12 col-md-4">
              <div class="card shadow-sm">
                <div class="card-body">
                    <a style="width: 100%;" class="font-weight-bold btn btn-primary text-white" href="<?= base_url();?>labarugi">Laba Rugi</a>
                </div>
              </div>
            </div>
            <div class="mb-2 mb-md-0 col-12 col-md-4">
              <div class="card shadow-sm">
              
                <div class="card-body">
                    <a style="width: 100%;" class="font-weight-bold btn btn-primary text-white" href="<?= base_url();?>per_modal">Perubahan Modal</a>
                </div>
              </div>
            </div>
            <div class="mb-2 mb-md-0 col-12 col-md-4">
              <div class="card shadow-sm">
                
                <div class="card-body">
                    <a style="width: 100%;" class="font-weight-bold btn btn-primary text-white" href="<?= base_url();?>poskeu">Posisi Keuangan</a>
                </div>
              </div>
            </div>
          </div>

        </div>
    <?php else: ?>
         <!-- Begin Page Content Untuk Admin -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Home</h1>
           
          </div>

          <!-- Content Row -->
          <div class="row">
 
            <!-- Card Transaksi -->
              <div class="col-xl-3 col-md-6 mb-2">
              <div class="card border-left-primary shadow-sm h-100">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      
                    
                  <div class="row">
                    <div class="col">
            
                        <div class="color-secondary font-weight-bold text-gray-600"><?php
                           if (empty(count($data))) {
                              echo "Belum Ada";
                            } else {
                              echo "Ada";
                            }
                       ?></div>
                
                    </div>
                  </div>
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-4">
                      <!-- <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Laporan</div> -->
                      <div class="font-weight-bold text-gray-800"><a class="h5 font-weight-bold">
                      <?php
                           if (empty(count($data))) {
                              // echo "0";
                            } else {
                              echo count($data)." ";
                            }
                       ?></a>Transaksi</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                       <div class="font-weight-bold text-gray-600 mb-2">Hari Ini</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <a href="<?= base_url(); ?>admin/transaksi_m" class="btn btn-success">Tambah Transaksi</a>
                     
                      
                    </div>
                  </div>
                  </div>
                </div>
                  <!-- <div class="col-auto">
                      <i class="fas fa-file-alt mt-4 fa-3x text-gray-300"></i>
                    </div> -->
                </div>

              </div>
            </div>

            <!-- Card Penerimaan Kas-->
            <div class="col-xl-3 col-md-6 mb-2">
              <div class="card border-left-success shadow-sm h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col-9 mr-2">
                      <div class="row">
                        <div class="col">
                           <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Kas Masuk</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                           <div class="text-sm font-weight-bold text-warning text-uppercase mb-1"><?= $tgl_now ?></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                           <div class=" font-weight-bold text-gray-800"><?= rupiah($total_debit); ?></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mt-2">
                          <button type="button" class="btn btn-primary" href="<?= base_url(); ?>master/kasmasuk" id="kasmasuk">Lihat Data</button>
                         </div>
                      </div>
                    
                    </div>
                    <div class="col">
                      <i class="fas fa-dollar-sign fa-3x text-gray-300"></i>
                    </div>
                  </div>
                  
                 
                </div>
              </div>
            </div>

             <!-- Card Pengeluaran Kas-->
            <div class="col-xl-3 col-md-6 mb-2">
              <div class="card border-left-success shadow-sm h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col-9 mr-2">
                      <div class="row">
                        <div class="col">
                          <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Kas Keluar</div>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="col">
                           <div class="text-sm font-weight-bold text-warning text-uppercase mb-1"><?= $tgl_now ?></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                           <div class="font-weight-bold text-gray-800"><?= rupiah($total_kredit); ?></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mt-2">
                            <button type="button" class="btn btn-primary" id="kaskeluar" href="<?= base_url(); ?>master/kaskeluar">Lihat Data</button>
                        </div>
                      </div>
                      
                    </div>
                    <div class="col">
                          <i class="fas fa-dollar-sign fa-3x text-gray-300"></i>
                    </div>
                   
                    
                  </div>
                </div>
              </div>
            </div>

            <!-- Laporan -->
            <div class="col-xl-3 col-md-6  mb-2">
              <div class="card border-left-warning shadow-sm py-2 h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col-9">
                      <div class="row mt-2">
                        <div class="col">
                         <div class="h4 font-weight-bold text-gray-800">Laporan</div>
                        </div>
                      </div>
                      <div class="row mt-4">
                        <div class="col">
                          <button type="button" class="btn btn-primary" id="laporan1" href="#">Lihat Data</button>
                        </div>
                      </div>
                     <!--  <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Laporan</div> -->
                    </div>
                    <div class="col text-center">
                      <i class="fas fa-file-alt fa-3x text-gray-300"></i>
                    </div>
                     
                  </div>
                </div>
              </div>
            </div>
          </div>

           <section class="text-dark text-center laporan" >
            <div class=" row font-weight-bold tumbnail ">
              <div class="col-sm-12 col-lg mb-2">
                <div class="card border-biru">
                  <div class="card-body ">
                    <a href="<?= base_url(); ?>admin/jurnal_umum" class="btn btn-primary font-weight-bold" style="width: 100%;">Jurnal Umum</a>
                  </div> 
                </div>
              </div>
              <div class="col-sm-12 col-lg mb-2">
                <div class="card border-biru">
                  
                  <div class="card-body ">
                    <a href="<?= base_url(); ?>jp" class="btn btn-primary font-weight-bold" style="width: 100%;">Jurnal Penyesuaian</a>
                  </div>
                  
                </div>
              </div>
              <div class="col-sm-12 col-lg mb-2">
                <div class="card border-biru">
                  
                  <div class="card-body ">
                    <a href="<?= base_url(); ?>buku_besar" class="btn btn-primary font-weight-bold" style="width: 100%;">Buku Besar</a>
                  </div>
                  
                </div>
              </div>
             
            </div>
            <div class="row font-weight-bold tumbnail">
              <div class="col-sm-12 col-lg mb-2">
                <div class="card border-biru">
                  <div class="card-body ">
                    <a href="<?= base_url(); ?>labarugi" class="btn btn-primary font-weight-bold" style="width: 100%;">Laba Rugi</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-lg mb-2">
                <div class="card border-biru">
                  
                  <div class="card-body ">
                    <a href="<?= base_url(); ?>per_modal" class="btn btn-primary font-weight-bold" style="width: 100%;">Perubahan Modal</a>
                  </div>
                  
                </div>
              </div>
              <div class="col-sm-12 col-lg">
                <div class="card border-biru">
                  
                  <div class="card-body ">
                    <a href="<?= base_url(); ?>poskeu" class="btn btn-primary font-weight-bold" style="width: 100%;">Posisi Keuangan</a>
                  </div>
                  
                </div>
              </div>
   
            </div>
           </section>

           <!-- kas keluar -->
            <section class="kaskeluar">
              <div class="row">
                <div class="col-1"></div>
                <div class="col">
                  <div class="card border-ijo">
                    <div class="card-header">
                      <div class="row">
                          <div class="col"> <h5 class="font-weight-bold text-dark text-center" >Kas Keluar</h5></div>
                          <div class="col"><h5 class="font-weight-bold text-dark text-center" >Total = <?= rupiah($total_kredit); ?></h5></div>
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table text-dark">
                          
                          <thead>
                              <th>No</th>
                              <th>Bukti Transaksi</th>
                              <th>Keterangan</th>
                              <th>Nominal</th>
                          </thead>
                          <tbody>
                            <?php $index = 1; ?>
                            <?php foreach ($kas as $kk): ?>
                            <?php if ($kk['kredit'] > 0): ?>
                              <tr>
                                <td><?= $index ?></td>
                                <td><?= $kk['bukti_transaksi'] ?></td>
                                <td><?= $kk['keterangan'] ?></td>
                                <td><?= rupiah($kk['kredit']) ?></td>
                              </tr>
                                <?php $index++; ?>
                            <?php endif ?>
                          
                            <?php endforeach ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-1"></div>
              </div>
            </section>

           <!-- kas masuk -->
            <section class="kasmasuk">
              <div class="row">
                  <div class="col-1"></div>
                <div class="col">
                  <div class="card border-ijo">
                    <div class="card-header">
                      <div class="row">
                        <div class="col"> <h5 class="font-weight-bold text-dark text-center" >Kas Masuk</h5></div>
                        <div class="col"><h5 class="font-weight-bold text-dark text-center" >Total = <?= rupiah($total_debit); ?></h5></div>
                      </div>
                     
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                      <table class="table text-dark">
                        <thead>
                          <th>No</th>
                          <th>Bukti Transaksi</th>
                          <th>Keterangan</th>
                          <th>Nominal</th>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                            <?php foreach ($kas as $kk): ?>
                              <?php if ($kk['debit'] > 0): ?>
                                <tr>
                                  <td><?= $index ?></td>
                                  <td><?= $kk['bukti_transaksi'] ?></td>
                                  <td><?= $kk['keterangan'] ?></td>
                                  <td><?= rupiah($kk['debit']) ?></td>
                                </tr>
                                    <?php $index++; ?>
                              <?php endif ?>
                        
                            <?php endforeach ?>
                        </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="col-1"></div>
              </div>
            </section>

          </div>
    <?php endif ?>
       
       

        <!-- /.container-fluid -->


  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/'); ?>js/jquery.js"></script>
  <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
  <script src="<?= base_url('assets/'); ?>js/style.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.js"></script>
   
  <!-- Page level custom scripts -->
 

</body>

</html>
