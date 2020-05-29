<div class="container-fluid">
	<h3 class="text-dark">Edit Profil</h3>
	<div class="row">
		<div class="col-lg-8">
			
			<?= form_open_multipart('admin/edit_profil'); ?>
				
				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"  readonly name="email" id="email" value="<?= $user['email']; ?>" >
					</div>
				</div>
				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Nama</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nama" id="nama" value="<?= $user['nama'];?>">
						<?= form_error('nama','<small class="text-danger pl-3">','</small>'); ?>
					</div>
				</div>
				<div class="row">
					<label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
					<div class="col-sm-10">
				
						<div class="row">
							<div class="col-sm-3 mb-2">
								<img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" class="img-thumbnail">
							</div>
							
							<div class="col-sm-9 mb-2 mb-md-0">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="gambar" name="gambar">
									<label class="custom-file-label" for="gambar">Pilih</label>
								</div>
							</div>
						</div>
						
					</div>
				</div>

				<div class="form-group row justify-content-end">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-success">Update</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>