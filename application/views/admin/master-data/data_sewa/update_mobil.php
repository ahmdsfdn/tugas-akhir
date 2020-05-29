<!-- Begin Page Content -->

<div class="container-fluid mb-2">
<?php if ($this->session->flashdata('pesan_sukses')) : ?>
			<div class="row">
				<div class="col-8">
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<div class="col-6">
						  Data Transaksi<strong> Berhasil</strong> <?= $this->session->flashdata('pesan_sukses'); ?>
							 
					</div>
					<div class="col-6">							
								
							  Akun <strong> <?= $this->session->flashdata('pesan_balance'); ?></strong>
								
					</div>
					 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
				</div>
				
				</div>
			</div>
<?php elseif ($this->session->flashdata('pesan_error')) : ?>
			<div class="row">
				<div class="col-8">
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<div class="col-6">
						  Data Transaksi<strong> Gagal</strong> <?= $this->session->flashdata('pesan_error'); ?>
							 
					</div>
					<div class="col-6">							
								
							  Akun <strong> <?= $this->session->flashdata('pesan_tidakbalance'); ?></strong>
								
					</div>
					 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
				</div>
				
				</div>
			</div>

<?php endif; ?>
          <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800 text-center">Daftar Mobil</h1>

	<div class="row">
		<!-- awal form transaksi -->
		<div class="col-12 col-xl-4 mb-2 mb-xl-0">
			<div class="card">
				<form action="" method="post" name="formmobil">

					<div class="card-body mx-5 text-center">

						<input hidden type="text" name="id" value="<?= $d_mobil['id']; ?>">

						<label class="row">	<div class="col">Nama Kendaraan</div></label>
						<div class="form-row">
							<div class="col-12">
								<div class="form-group">
									<input class="form-control" type="text" name="nama" value="<?= $d_mobil['nama']; ?>"></input>
								</div>
							</div>
						</div>
						<label class="row">	<div class="col">Plat Nomor</div></label>
						<div class="form-row">
							<div class="col-12">
								<div class="form-group">
									<input class="form-control" type="text" name="plat" value="<?= $d_mobil['plat']; ?>"></input>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<button type="submit" class="btn btn-success" style="width: 100%; border-radius: 0px 0px 4px 4px;">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-12 col-xl-8">
			<div class="card">
				<div class="card-header text-center">
					<h5 class="m-0">Data Mobil</h5>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td>No</td>
								<td>Mobil</td>
								<td>Plat</td>
								<td width="20%">Aksi</td>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1 ?>
							<?php foreach ($data_kendaraan as $dk): ?>	
								<tr>
									<td><?= $no ?></td>
									<td><?= $dk['nama'] ?></td>
									<td><?= $dk['plat'] ?></td>
									<td><a href="<?= base_url(); ?>data_sewa/update_mobil/<?= $dk['id']; ?>" class="badge badge-success">Update</a><a href="<?= base_url(); ?>data_sewa/hapus_mobil/<?= $dk['id']; ?>" class="badge badge-danger ml-1">Hapus</a></td>
								</tr>
							<?php $no++ ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
