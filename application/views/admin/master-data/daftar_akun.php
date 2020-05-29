<div class="container-fluid">
  <div class="row">
    
    <?php if ($this->session->flashdata('pesan_sukses')) : ?>
      
        <div class="col-6">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              Data Akun<strong> Berhasil </strong> <?= $this->session->flashdata('pesan_sukses'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>
        </div>
    
<?php endif; ?>
  </div>
  <div class="row">
    <div class="col">
       <h5 class="text-dark">Daftar Akun</h5>
    </div>
   
  </div>
    <div class="row">
      <div class="col-6">
      <div class="">
            <div class="row mt-2">
              <div class="col-6">
                <a role="button" href="<?= base_url();?>master/tambah_daftarakun" class="btn btn-success" style="height: 100%; width: 225px;">Tambah Data</a>
              
              </div>

             <!--  <div class="col-6 text-center">
                <button href="#" class="btn btn-secondary">Cetak</button>
              </div> -->
         
            </div>
            <div class="row mt-2">
              <div class="col-8">
                  <!-- <form method="post" class="form-inline">
                      <div class="form-group mb-2">
                        <input type="text" class="form-control" style="height: 100%; width: 260px;" id="katakunci" name="katakunci">
                      </div> -->
                      <form action="" method="post">
           <!--  <div class="input-group">
              <input type="text" class="form-control" placeholder="Cari data daftar akun" name="katakunci">
              <div class="input-group-append">
                <button class="btn btn-dark" type="submit">Cari</button>
              </div>
            </div> -->
          </form>
              </div>
             <!--  <div class="col">
                    <button type="submit" class="btn btn-dark mb-2 mx-3">Cari</button>
              </div> -->
              
                  </form>
            
            <!--   <div class="col-2">
                <a class="btn btn-success" href="<?= base_url();?>master">Reset</a>
              </div> -->
           
            </div>
        </div>
</div>
</div> 

        <div class="row mt-2 ">

          <div class="col">
          <div class="card p-2">
            <div class="row">
              <div class="col">
                  <div class="table-responsive">
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th width="">Kode Akun</th>
                          <th width="">Akun Perkiraan</th>
                          <th width="">Pos Akun</th>
                          <th width="">Pos Laporan</th>
                          <th width="">Saldo Normal</th>
                          <th width="10%">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($daftar_akun as $da ) : ?>
                        <tr>
                          <td><?= $da['kode_akun']?></td>
                          <td><?= $da['akun'] ?></td>
                          <td><?= $da['pos_akun'] ?></td>
                          <td><?= $da['pos_laporan'] ?></td>
                          <td><?= $da['saldo_normal'] ?></td>
                          <td class="d-flex align-items-center">
                            <a href="<?= base_url(); ?>master/ubahDaftarakun/<?= $da['kode_akun']; ?>" class="btn-sm btn-success"><i class="fa fa-pen"></i></a>
                            <a href="<?= base_url(); ?>master/hapusDaftarakun/<?= $da['kode_akun'];?>" class="btn-sm btn-danger ml-1"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
  

</div>

