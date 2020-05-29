<!-- Begin Page Content -->
<div class="container-fluid">
<?php if ($this->session->flashdata('pesan_sukses')) : ?>
			<div class="row">
				<div class="col-6">
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						  Data Transaksi<strong> Berhasil</strong> <?= $this->session->flashdata('pesan_sukses'); ?>
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
					</div>
				</div>
			</div>
<?php endif; ?>
          <!-- Page Heading -->
          <h1 class="col-md-12 h3 mb-4 text-gray-800">Saldo Awal</h1>
          <div class="row">
          	<div class="col-xl-4 col-md-12 mb-2">
	          	<div class="card p-2">
	          		<div class="row">	
		          		<div class="col">
		          			<a role="button" class="btn btn-success" href="<?= base_url();?>master/tambah_saldoawal">Tambah Data</a>
		          		</div>
		          	<!-- 	<div class="col">
		          			<a role="button" class="btn btn-warning" href="#">Cetak</a>
		          		</div>	 -->
	          		</div>
	          		<div class="row">
	          			<div class="col mt-2">
		          			<form action="" method="post">
								<div class="input-group">
									  <input type="text" class="form-control" placeholder="Cari data jurnal" name="katakunci">
									  <div class="input-group-append">
									    <button class="btn btn-dark" type="submit">Cari</button>
									  </div>
								</div>
							</form>
						</div>
	          		</div>
	          	</div>
          	</div>
          	<div class="col">
          	

	          		<?php 
	          		$this->db->select('SUM(kredit) as total');
	          		$sa_kredit = $this->db->get('saldo_awal')->row()->total;

	          		$this->db->select('SUM(debit) as total');
	          		$sa_debit = $this->db->get('saldo_awal')->row()->total;
	          		?>

	          		<?php if ($sa_kredit == $sa_debit): ?>
	          			<h5 class="card col-lg-3 py-2 bg-success text-white font-weight-bold text-center">Balance</h5>
	          		<?php else: ?>
	          			<h5 class="card col-lg-4 py-2 bg-danger text-white font-weight-bold text-center">Tidak Balance</h5>	
	          		<?php endif ?>
       		
          		
          	</div>
          </div>
<?php foreach ($bukber as $key) {
	 $data_da[] = $key['akun'];
} ?>

<?php if (!empty($data_da)): ?>

<?php foreach ($data_da as $d) : ?>

	
		<?php 	$data_tb = $this->db->get_where('saldo_awal',['akun' => $d])->result_array(); ?>
<?php if (!empty($data_tb)): ?>

    <div class="row mb-2 justify-content-center">
		<div class="col">
			<div class="card p-2">
				<?php echo $d; ?>
			
			<?php $data_count = count($data_tb); ?>
				
				<div class="row">
					<div class="col">
						<div class="table-responsive text-center table-bordered">
							  <table class="table justify-content-center align-self-center">
							  	<thead>
								  	<tr>
								  		<th>Tanggal</th>
								  		<th>Keterangan</th>
								  		<th>Debit</th>
								  		<th>Kredit</th>
								  		<th>Aksi</th>
								  	</tr>
							  	</thead>
							  	<tbody>
							  	<?php if ($data_count == 0): ?>
							  				<?php $hide = ""; ?>
								<?php else : ?>
									<?php foreach($data_tb as $dt) : ?>
										<?php $hide = "hidden"; ?>
									 	<tr>
									 		
									  		<td><?= $dt['tanggal_transaksi']; ?></td>
									  		<td><?= $dt['keterangan'] ?></td>
									  		<td><?= rupiah($dt['debit']) ?></td>
									  		<td><?= rupiah($dt['kredit']) ?></td>
									  		<td>
									  		<a href="<?= base_url(); ?>master/ubahSaldoAwal/<?= $dt['id']; ?>" class="badge badge-success">Update</a>
						  					<a href="<?= base_url(); ?>master/hapusSaldoAwal/<?= $dt['id'];?>" class="badge badge-danger ml-1">Hapus</a>
						  					</td>
									  	</tr>
	
								 	<?php endforeach; ?>
								 <?php endif ?>

							  	</tbody>

							  </table>
							  <h5 <?= $hide; ?> >Data Belum Ada</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
	<!-- KOSONG JIKA TIDAK ADA DATA MASUK -->
<?php endif; ?>

<?php endforeach; ?>




<?php else: ?>
	<div class="row mt-5">
		<div class="col text-center"><h5>Silahkan Input Saldo Awal</h5></div>
	</div>
<?php endif ?>

</div>