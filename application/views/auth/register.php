 <div class="container">
          <div class="card o-hidden border-0 my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-primary font-weight-bold mb-4">Silahkan Membuat Akun</h1>
                    </div>

                
                    <form enctype="multipart/form-data" class="user" method="post" action="<?= base_url('auth/register'); ?>" >
                      <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="exampleInputNama" placeholder="Nama Pengguna" name="nama" value="<?= set_value('nama'); ?>">

                        <?= form_error ('nama','<small class="text-danger pl-3">','</small>'); ?>

                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" value="<?= set_value('email'); ?>">
                        <?= form_error ('email','<small class="text-danger pl-3">','</small>'); ?>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-md-0">
                          <input type="password" class="form-control form-control-user" id="password1" placeholder="Password" name="password1">
                           <?= form_error ('password1','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        <div class="col-md-6">
                          <input type="password" class="form-control form-control-user" id="password2" placeholder="Repeat Password" name="password2">
                        </div>
                      </div>
                      <div class="form-group row">
                       <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                      
                          <div class="row">
                            <div class="col mb-2 mb-md-0">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                <label class="custom-file-label" for="gambar">Pilih</label>
                              </div>
                            </div>
                          </div>
                          
                        </div>

                      </div>

                      <button type="submit" class="btn btn-primary btn-user btn-block">Daftar Akun</button>
                  
                 
                    </form>
                    <hr>
                    <div class="text-center">
                      <a class="small" href="<?= base_url(); ?>auth/lupas">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                      <a class="small" href="<?= base_url(); ?>">Sudah punya akun? Login!</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  </div>