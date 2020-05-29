 <div class="container">
          <div class="card o-hidden border-0 my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-primary font-weight-bold mb-4">Ganti password untuk</h1>
                      <h5 class="mb-4"><?= $this->session->userdata('reset_email') ?></h5>
                    </div>

                    <?= $this->session->flashdata('message'); ?>

                    <form class="user" method="post" action="<?= base_url('auth/gantipassword') ?>">
                     
                      <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-md-0">
                          <input type="password" class="form-control form-control-user" id="password1" placeholder="Password" name="password1">
                           <?= form_error ('password1','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        <div class="col-md-6">
                          <input type="password" class="form-control form-control-user" id="password2" placeholder="Repeat Password" name="password2">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                  
                 
                    </form>
                    <hr>
                  
                    <div class="text-center">
                      <a class="small" href="<?= base_url(); ?>">Kembali ke Login</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  </div>