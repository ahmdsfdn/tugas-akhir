<div class="container-fluid">
	<h3 class="text-dark mb-4">Data Admin</h3>
	<div class="row justify-content-center">
		<div class="col-lg-8 col-xl-6 card p-2 shadow-sm">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Level</th>
							<th>Status</th>
							<th width="15%">Aksi</th>		
						</tr>
					</thead>
					<tbody>

						<?php foreach ($data_user as $du): ?>
							<?php if ($du['id'] != $user['id']): ?>
								
								<tr>
									<td><?= $du['nama'] ?></td>
									<td>
										<?php if ($du['role_id'] == 1): ?>
										Pemilik
										<?php else: ?>
										Admin
										<?php endif ?>
										
									</td>
								<?php if ($du['is_active'] == 2): ?>
									<td>Belum di Aktivasi</td>
								<?php else: ?>
									<td>Sudah Teraktivasi</td>
								<?php endif ?>
									
									<td>
										<?php if ($du['is_active'] == 2): ?>
											<a href="<?= base_url(); ?>pemilik/update_aktif/<?= $du['id']; ?>" class="badge badge-success" >Aktifkan</a>
										<?php else: ?>
											<?php if ($du['role_id'] == 2): ?>
												<a href="<?= base_url(); ?>pemilik/update_uplevel/<?= $du['id']; ?>" class="badge badge-primary" ><i class="fa fa-arrow-up mr-2"></i>Level</a>
											<?php else: ?>
												<a href="<?= base_url(); ?>pemilik/update_downlevel/<?= $du['id']; ?>" class="badge badge-secondary" ><i class="fa fa-arrow-down mr-2"></i>Level</a>
											<?php endif; ?>
										
											<a class="badge badge-warning" href="<?= base_url(); ?>pemilik/update_nonaktif/<?= $du['id']; ?>">Non Aktifkan</a>
											
											
										<?php endif; ?>
											<a class="badge badge-danger" href="<?= base_url(); ?>pemilik/hapus/<?= $du['id']; ?>">Hapus</a>
									</td>
								</tr>

							<?php endif ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>