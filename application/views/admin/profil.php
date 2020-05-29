<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-8">
			<?php if ($user['role_id'] == 1): ?>
			<div class="card p-4 shadow-sm border-left-dark">
			<?php else: ?>
			<div class="card p-4 shadow-sm border-left-primary">	
			<?php endif ?>
			
				<div class="row text-center text-xl-left">
					<div class="col-12 col-xl-4 p-0 m-auto">
						<img style="max-width: 150px; min-width: 150px; display: block;" src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" class="rounded m-auto">
					</div>
					<div class="col-12 mt-2 mt-xl-0  col-xl-7 offset-xl-1 ">
						<div class="row">
							<div class="col text-dark">
								<h5><b><?= $user['nama']; ?></b></h5>
							</div>
						</div>
						<div class="row">
							<div class="col text-dark">
								<p><?= $user['email']; ?></p>	
							</div>
						</div>
						<div class="row">
							<div class="col">
								<p>Dibuat pada <?= date('d-F-Y',$user['date_created']); ?></p>	
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-xl-6">
								<a style="width: 100%;" class="btn btn-primary " href="<?= base_url() ?>admin/edit_profil">Edit</a>
							</div>
							<div class="mt-2 mt-xl-0 col-12 col-xl-6">
								<a style="width:100% ;" class="btn btn-primary " href="<?= base_url() ?>admin/ganti_password">Ganti Password</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
 
</div>