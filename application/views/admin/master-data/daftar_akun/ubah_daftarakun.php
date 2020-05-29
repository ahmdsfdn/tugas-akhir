<div class="container-fluid mb-2 ">

  <div class="row">
    <div class="col-lg-8">

        <div class="card p-2 shadow-sm">
             <h1 class="text-center">Ubah Data</h1>
             <hr>
          <form action="" method="post" name="form_tambahakun">

            <input type="hidden" name="id" value="<?= $daftar_akun['kode_akun']; ?>">

            <div class="form-row">
               <div class="form-group col-lg-6">
                        <h5>Pos Laporan</h5>

                        <select class="form-control" name="pos_laporan" id="pos_laporan" onchange="nonaktifKode()">
                          <?php foreach ($pos_laporan as $ps) : ?>
                            <?php if ($ps == $daftar_akun['pos_laporan']): ?>
                          <option value="<?= $ps ?>" selected><?= $ps; ?></option>
                            <?php else: ?>
                          <option value="<?= $ps ?>"><?= $ps; ?></option>
                            <?php endif ?>
                          <?php endforeach ?>
                        </select>
                  </div>
                      <div class="form-group col-lg-6">
                        <?php if ($daftar_akun['pos_laporan'] == 'Laporan Posisi Keuangan'): ?>
                          <h5 style="display: block;" id="pos_label_neraca">Pos Akun Posisi Keuangan</h5> 
                          <select class="form-control" name="pos_akun" id="pos_akun_neraca" onchange="nonaktifnr()">
                            <option selected>Pilih...</option>
                            <?php foreach ($pos_nr as $key): ?>
                              <?php if ($key == $daftar_akun['pos_akun']): ?>
                                <option value="<?= $key ?>" selected><?= $key ?></option>
                              <?php else: ?>
                                <option value="<?= $key ?>"><?= $key; ?></option>
                              <?php endif ?>
                            <?php endforeach ?>
                          </select>
                          <h5 style="display: none;" id="pos_label_labarugi">Pos Akun Laba Rugi</h5>
                       
                        <select class="form-control" name="pos_akun" id="pos_akun_labarugi" hidden disabled onchange="nonaktifKode()">
                          <option selected>Pilih...</option>
                          <option value="Pendapatan">Pendapatan</option>
                          <option value="Beban">Beban</option>
                          <option value="Pajak">Pajak</option>
                        </select>
                        <?php elseif ($daftar_akun['pos_laporan'] == 'Laba Rugi') : ?>

                          <h5 style="display: none;" id="pos_label_neraca">Pos Akun Posisi Keuangan</h5> 
                          <select class="form-control" name="pos_akun" id="pos_akun_neraca" hidden disabled onchange="nonaktifnr()">
                            <option selected>Pilih...</option>
                            <?php foreach ($pos_nr as $key): ?>

                                <option value="<?= $key ?>"><?= $key; ?></option>

                            <?php endforeach ?>
                          </select>

                        <h5 style="display: block;" id="pos_label_labarugi">Pos Akun Laba Rugi</h5>
                       
                        <select class="form-control" name="pos_akun" id="pos_akun_labarugi" onchange="nonaktifKode()">
                          <option selected>Pilih...</option>
                          <?php foreach ($pos_lr as $key): ?>
                            <?php if ($key == $daftar_akun['pos_akun']): ?>
                              <option value="<?= $key ?>" selected><?= $key ?></option>
                            <?php else: ?>
                              <option value="<?= $key ?>" ><?= $key ?></option>
                            <?php endif ?>
                            
                          <?php endforeach ?>
                          
                        </select>
                        <?php endif ?>
              </div>
            </div>
          
            <div class="form-row">

                 <div class="form-group col-lg-6">

                        <h5>Kode Akun</h5>

                      <input type="text" class="form-control" name="kode_akun" id="kode_al" value="<?= $kode_al; ?>" hidden readonly disabled>
                      <small class="form-text text-danger"><?= form_error('akun'); ?></small>
                      <input type="text" class="form-control" name="kode_akun" id="kode_at" value="<?= $kode_at; ?>" hidden readonly disabled>
                      <small class="form-text text-danger"><?= form_error('akun'); ?></small>
                      <input type="text" class="form-control" name="kode_akun" id="kode_k" value="<?= $kode_k; ?>" hidden readonly disabled>
                      <small class="form-text text-danger"><?= form_error('akun'); ?></small>
                      <input type="text" class="form-control" name="kode_akun" id="kode_ek" value="<?= $kode_ek; ?>" hidden readonly disabled>
                      <small class="form-text text-danger"><?= form_error('akun'); ?></small>
                      <input type="text" class="form-control" name="kode_akun" id="kode_p" value="<?= $kode_p; ?>" hidden readonly disabled>
                      <small class="form-text text-danger"><?= form_error('akun'); ?></small>
                      <input type="text" class="form-control" name="kode_akun" id="kode_b" value="<?= $kode_b; ?>" hidden readonly disabled>
                      <small class="form-text text-danger"><?= form_error('akun'); ?></small>
                      <input type="text" class="form-control" name="kode_akun" id="kode_pjk" value="<?= $kode_pjk; ?>" hidden readonly disabled>
                      <small class="form-text text-danger"><?= form_error('akun'); ?></small>


                      <input type="text" class="form-control" name="kode_akun" id="kode_awal"  value="<?= $daftar_akun['kode_akun']; ?>" readonly>
                      <small class="form-text text-danger"><?= form_error('akun'); ?></small>

                  </div>

                   
                   <div class="form-group col-lg-6">
                    <h5>Saldo Normal</h5>
                       <?php 
                            $data = ['Debit','Kredit'];
                        ?>
                       <select type="text" class="form-control" name="saldo_normal" id="saldo_normal">
                         <option value="" selected>-- Pilih Saldo Normal --</option>
                         <?php foreach ($data as $d): ?>
                          <?php if ($d == $daftar_akun['saldo_normal']): ?>
                              <option value="<?= $d; ?>" selected><?= $d ?></option>
                          <?php else: ?>
                               <option value="<?= $d; ?>"><?= $d ?></option>
                          <?php endif ?>      
                         <?php endforeach ?>
                       </select>
                    </div>

            </div>
            <div class="form-row">
              <div class="form-group col-lg-6">
                  <h5>Akun Perkiraan</h5>
                  <input type="text" class="form-control" name="akun" id="akun"  value="<?= $daftar_akun['akun']; ?>">
              </div>
          
            </div>
              <ul class="text-center">
                <button type="submit" name="ubah" class="btn btn-success" style="width: 200px">Input</button> 
              </ul>
          </form>
        </div>
    </div>
  </div>
</div>


<script language="javascript">

function nonaktifKode()
{

  if (document.form_tambahakun.pos_laporan.value=='Laporan Posisi Keuangan') {
 
    document.form_tambahakun.pos_akun_neraca.disabled=false;
    document.form_tambahakun.pos_akun_neraca.hidden=false;
    document.form_tambahakun.pos_akun_labarugi.hidden=true;
    document.form_tambahakun.pos_akun_labarugi.disabled=true;
    document.getElementById('pos_label_neraca').style.display="block";
    document.getElementById('pos_label_labarugi').style.display="none";
  }
  if (document.form_tambahakun.pos_laporan.value=='Laba Rugi') {

    document.form_tambahakun.pos_akun_neraca.disabled=true;
    document.form_tambahakun.pos_akun_neraca.hidden=true;
    document.form_tambahakun.pos_akun_labarugi.hidden=false;
    document.form_tambahakun.pos_akun_labarugi.disabled=false;
    document.getElementById('pos_label_labarugi').style.display="block";
    document.getElementById('pos_label_neraca').style.display="none";
  }
 if (document.form_tambahakun.pos_akun_labarugi.value=='Pendapatan') {
    document.form_tambahakun.kode_at.disabled=true;
    document.form_tambahakun.kode_at.hidden=true;
    document.form_tambahakun.kode_al.hidden=true;
    document.form_tambahakun.kode_al.disabled=true;
    document.form_tambahakun.kode_k.hidden=true;
    document.form_tambahakun.kode_k.disabled=true;
    document.form_tambahakun.kode_ek.hidden=true;
    document.form_tambahakun.kode_ek.disabled=true;
    document.form_tambahakun.kode_p.hidden=false;
    document.form_tambahakun.kode_p.disabled=false;
    document.form_tambahakun.kode_b.hidden=true;
    document.form_tambahakun.kode_b.disabled=true;
    document.form_tambahakun.kode_awal.hidden=true;
    document.form_tambahakun.kode_awal.disabled=true;
    document.form_tambahakun.kode_pjk.hidden=true;
    document.form_tambahakun.kode_pjk.disabled=true;
  }
    if (document.form_tambahakun.pos_akun_labarugi.value=='Beban') {
    document.form_tambahakun.kode_at.disabled=true;
    document.form_tambahakun.kode_at.hidden=true;
    document.form_tambahakun.kode_al.hidden=true;
    document.form_tambahakun.kode_al.disabled=true;
    document.form_tambahakun.kode_k.hidden=true;
    document.form_tambahakun.kode_k.disabled=true;
    document.form_tambahakun.kode_ek.hidden=true;
    document.form_tambahakun.kode_ek.disabled=true;
    document.form_tambahakun.kode_p.hidden=true;
    document.form_tambahakun.kode_p.disabled=true;
    document.form_tambahakun.kode_b.hidden=false;
    document.form_tambahakun.kode_b.disabled=false;
    document.form_tambahakun.kode_awal.hidden=true;
    document.form_tambahakun.kode_awal.disabled=true;
    document.form_tambahakun.kode_pjk.hidden=true;
    document.form_tambahakun.kode_pjk.disabled=true;
  }

  if (document.form_tambahakun.pos_akun_labarugi.value=='Pajak') {
    document.form_tambahakun.kode_at.disabled=true;
    document.form_tambahakun.kode_at.hidden=true;
    document.form_tambahakun.kode_al.hidden=true;
    document.form_tambahakun.kode_al.disabled=true;
    document.form_tambahakun.kode_k.hidden=true;
    document.form_tambahakun.kode_k.disabled=true;
    document.form_tambahakun.kode_ek.hidden=true;
    document.form_tambahakun.kode_ek.disabled=true;
    document.form_tambahakun.kode_p.hidden=true;
    document.form_tambahakun.kode_p.disabled=true;
    document.form_tambahakun.kode_b.hidden=true;
    document.form_tambahakun.kode_b.disabled=true;
    document.form_tambahakun.kode_awal.hidden=true;
    document.form_tambahakun.kode_awal.disabled=true;
    document.form_tambahakun.kode_pjk.hidden=false;
    document.form_tambahakun.kode_pjk.disabled=false;
  }

}

function nonaktifnr()
{
    if (document.form_tambahakun.pos_akun_neraca.value=='Aset Lancar') {
    document.form_tambahakun.kode_al.disabled=false;
    document.form_tambahakun.kode_al.hidden=false;
    document.form_tambahakun.kode_at.hidden=true;
    document.form_tambahakun.kode_at.disabled=true;
    document.form_tambahakun.kode_k.hidden=true;
    document.form_tambahakun.kode_k.disabled=true;
    document.form_tambahakun.kode_ek.hidden=true;
    document.form_tambahakun.kode_ek.disabled=true;
    document.form_tambahakun.kode_p.hidden=true;
    document.form_tambahakun.kode_p.disabled=true;
    document.form_tambahakun.kode_b.hidden=true;
    document.form_tambahakun.kode_b.disabled=true;
    document.form_tambahakun.kode_awal.hidden=true;
    document.form_tambahakun.kode_awal.disabled=true;
    document.form_tambahakun.kode_pjk.hidden=true;
    document.form_tambahakun.kode_pjk.disabled=true;
  }
    if (document.form_tambahakun.pos_akun_neraca.value=='Aset Tetap') {
    document.form_tambahakun.kode_at.disabled=false;
    document.form_tambahakun.kode_at.hidden=false;
    document.form_tambahakun.kode_al.hidden=true;
    document.form_tambahakun.kode_al.disabled=true;
    document.form_tambahakun.kode_k.hidden=true;
    document.form_tambahakun.kode_k.disabled=true;
    document.form_tambahakun.kode_ek.hidden=true;
    document.form_tambahakun.kode_ek.disabled=true;
    document.form_tambahakun.kode_p.hidden=true;
    document.form_tambahakun.kode_p.disabled=true;
    document.form_tambahakun.kode_b.hidden=true;
    document.form_tambahakun.kode_b.disabled=true;
    document.form_tambahakun.kode_awal.hidden=true;
    document.form_tambahakun.kode_awal.disabled=true;
    document.form_tambahakun.kode_pjk.hidden=true;
    document.form_tambahakun.kode_pjk.disabled=true;
  }
    if (document.form_tambahakun.pos_akun_neraca.value=='Kewajiban') {
    document.form_tambahakun.kode_at.disabled=true;
    document.form_tambahakun.kode_at.hidden=true;
    document.form_tambahakun.kode_al.hidden=true;
    document.form_tambahakun.kode_al.disabled=true;
    document.form_tambahakun.kode_k.hidden=false;
    document.form_tambahakun.kode_k.disabled=false;
    document.form_tambahakun.kode_ek.hidden=true;
    document.form_tambahakun.kode_ek.disabled=true;
    document.form_tambahakun.kode_p.hidden=true;
    document.form_tambahakun.kode_p.disabled=true;
    document.form_tambahakun.kode_b.hidden=true;
    document.form_tambahakun.kode_b.disabled=true;
    document.form_tambahakun.kode_awal.hidden=true;
    document.form_tambahakun.kode_awal.disabled=true;
    document.form_tambahakun.kode_pjk.hidden=true;
    document.form_tambahakun.kode_pjk.disabled=true;
  }
    if (document.form_tambahakun.pos_akun_neraca.value=='Ekuitas') {
    document.form_tambahakun.kode_at.disabled=true;
    document.form_tambahakun.kode_at.hidden=true;
    document.form_tambahakun.kode_al.hidden=true;
    document.form_tambahakun.kode_al.disabled=true;
    document.form_tambahakun.kode_k.hidden=true;
    document.form_tambahakun.kode_k.disabled=true;
    document.form_tambahakun.kode_ek.hidden=false;
    document.form_tambahakun.kode_ek.disabled=false;
    document.form_tambahakun.kode_p.hidden=true;
    document.form_tambahakun.kode_p.disabled=true;
    document.form_tambahakun.kode_b.hidden=true;
    document.form_tambahakun.kode_b.disabled=true;
    document.form_tambahakun.kode_awal.hidden=true;
    document.form_tambahakun.kode_awal.disabled=true;
    document.form_tambahakun.kode_pjk.hidden=true;
    document.form_tambahakun.kode_pjk.disabled=true;
  }
}

</script>