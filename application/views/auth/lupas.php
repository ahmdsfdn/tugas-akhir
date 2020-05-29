 <div class="container">
          <div class="card o-hidden border-0 my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-primary font-weight-bold mb-4">Lupa Password ?</h1>
                    </div>

                    <?= $this->session->flashdata('message'); ?>

                    <form class="user" method="post" action="<?= base_url('auth/lupas') ?>">
                     
                      <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" value="<?= set_value('email'); ?>">
                        <?= form_error ('email','<small class="text-danger pl-3">','</small>'); ?>
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