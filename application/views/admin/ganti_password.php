<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>
	<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

	<div class="row">
		
			<div class="col-lg-6">
				<form action="<?= base_url('admin/ganti_password'); ?>" method="post">
				<div class="form-group">
					<label for="passwordsekarang">Password Sekarang</label>
						<input type="text" class="form-control" name="passwordsekarang" id="passwordsekarang" value="">
						<?= form_error('passwordsekarang','<small class="text-danger pl-3">','</small>'); ?>
				</div>
				<div class="form-group">
					<label for="passwordsekarang">Password Baru</label>		
						<input type="text" class="form-control" name="passwordbaru" id="passwordbaru" value="">
						<?= form_error('passwordbaru','<small class="text-danger pl-3">','</small>'); ?>
				</div>
				<div class="form-group">
					<label for="passwordsekarang">Ulangi Password</label>		
						<input type="text" class="form-control" name="ulangipassword" id="ulangipassword" value="">
						<?= form_error('ulangipassword','<small class="text-danger pl-3">','</small>'); ?>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Ganti Password</button>
				</div>
				</form>
			</div>
		
	</div>
</div>