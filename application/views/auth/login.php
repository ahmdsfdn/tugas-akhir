

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-7">

        <div class="card o-hidden border-0 my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center mb-2">
                    <h1 class="font-weight-bold text-primary">PT. Bagas Tetuko</h1></h1>
                  </div>
                  <div class="text-center mb-2">
                  <p class="text-gray-400">Silahkan login terlebih dahulu</p>
                  </div>

                  <?= $this->session->flashdata('message'); ?>

                  <form class="user " method="post" action="<?= base_url('auth') ?>">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email" name="email" value="<?= set_value('email'); ?>">
                       <?= form_error ('email','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                       <?= form_error ('password','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div> -->
                     <button type="submit" class="font-weight-bold btn btn-outline-primary col-sm-4 offset-sm-4 mt-3">Login</button>                  
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?= base_url(); ?>auth/lupas">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?= base_url(); ?>auth/register">Buat akun</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

 