<div class="container-fluid">

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

<div class="card p-2 shadow-sm mb-2">
	<div class="row mb-2">
		<div class="col">
			
				<div class="row">
					<div class="col text-center">
						<h2><strong>Jurnal Penyesuaian</strong></h2>
					</div>
				</div>
				<div class="row">
					<div class="col text-center">
						<?php if ($this->input->post('tanggal_awal')): ?>
						<h5><?= $this->input->post('tanggal_awal') ?> s.d. <?= $this->input->post('tanggal_akhir') ?> </h5>
						<?php elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) : ?>
							<h5><?= $bulan_nama ?> <?= $this->input->post('tahun_post') ?></h5>
						<?php elseif ($this->input->post('tahun_post')) : ?>
							<h5>Tahun <?= $this->input->post('tahun_post') ?></h5>
						<?php elseif ($this->input->post('katakunci')) : ?>
							
							<p><i class="fa fa-search"></i> : <?= $this->input->post('katakunci') ?></p>
						<?php else: ?>
							<h5><?= $bulan_nama ?> <?= date('Y') ?></h5>
						<?php endif ?>
						
					</div>
				</div>
			
		</div>
	</div>
	<hr class="m-0 mb-2">
	<div class="row mb-2 mb-sm-0 mb-xl-2">
		<?php if ($user['role_id'] == 2): ?>
			<div class="col-12 col-sm-8 col-md-8 mb-2 mb-xl-0 col-xl-3">
				<a role="button" href="<?= base_url();?>jp/tambah_jp" class="btn btn-success" style="height: 100%; width: 100%;">Tambah Data</a>
			</div>
			<div class="col-12 col-sm-4 col-md-4 col-xl-3 mb-2 mb-xl-0">
		<?php else: ?>
			<div class="col-12 col-sm-6 mb-2 mb-xl-0">
		<?php endif ?>
		
		
			<form method="post" action="<?= base_url();?>jp/cetak_jp">
			  	<?php if ($this->input->post('tanggal_awal')): ?>
				  <input type="text" name="tanggal_awal" value="<?= $this->input->post('tanggal_awal') ?>" hidden >
				  <input type="text" name="tanggal_akhir" value="<?= $this->input->post('tanggal_akhir') ?>" hidden>
			  	<?php elseif($this->input->post('tahun_post') && ($this->input->post('bulan_post'))) : ?>
				  <input type="type" name="bulan_post" hidden value="<?= $this->input->post('bulan_post')  ?>">
				  <input type="text" name="tahun_post" hidden value="<?= $this->input->post('tahun_post') ?>">
			  	<?php elseif($this->input->post('tahun_post')) : ?>
				  <input type="text" name="tahun_post" hidden value="<?= $this->input->post('tahun_post') ?>">
			  	<?php else: ?>
		    	  <input type="text" name="katakunci" hidden value="<?= $this->input->post('katakunci') ?>">
		  		<?php endif ?>

				  <button type="submit" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Cetak</button>	
  			</form>
		</div>
			
		<div class="col-12 col-sm-8 col-md-8 mb-2 mb-xl-0 col-xl-5">
			<form action="" method="post">
				<div class="input-group">
				   <input type="text" class="form-control" placeholder="Cari data jurnal" name="katakunci" value="<?php ?>">
				  
				  <div class="input-group-append">
				    <button class="btn btn-dark" type="submit">Cari
				  </div>
				</div>
			</form>
		</div>
		<div class="col-12 col-sm-4 col-md-4 col-xl-1">
			<a class="btn btn-success" href="<?= base_url();?>admin/jurnal_umum">Reset</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-xl-6">
			<form method="post" class="form-row align-items-center">
				<div class="col-12 col-sm-5 mb-2 mb-xl-0">
						<div class="form">
						    <input type="date" class="form-control" name="tanggal_awal" value="<?= $this->input->post('tanggal_awal') ?>">
						</div>
				</div>
			<div class="d-none d-sm-block" style="width: 27px;">
				s/d
			</div>
				<div class="col-12 col-sm-5 mb-2 mb-xl-0">
					  	<div class="form">
					    	<input type="date" class="form-control" name="tanggal_akhir" value="<?= $this->input->post('tanggal_akhir') ?>">
					  	</div>
				</div>
				<div class="col mb-2 mb-xl-0">
					 	<div class="form ">
					  		<button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
					  	</div>
				</div>
							  
			</form> 
		</div>
		<div class="col-12 col-xl-6">
			<form action="" method="post" class="form-row align-items-center">
						<div class="col-10 col-sm-5 mb-2 mb-xl-0">
							<div class="form">
								<select class="custom-select" id="bulan_post" name="bulan_post" disabled>
								    <option selected>Pilih Bulan</option>
								<?php foreach ($dd_bulan as $dd_bulan): ?>
									<?php if ($dd_bulan['angka'] == $this->input->post('bulan_post')): ?>
										<option value="<?= $dd_bulan['angka'] ?>" selected><?= $dd_bulan['bulan'] ?></option>
									<?php else: ?>
										<option value="<?= $dd_bulan['angka'] ?>"><?= $dd_bulan['bulan'] ?></option>
									<?php endif ?>
								<?php endforeach ?>
								   
						  		</select>
							</div>									    			
						</div>
						          			
          				<div class=""  style="width: 27px;">
	          				<div class="form-check mb-4">
							  <input class="form-check-input" type="checkbox" value="" id="enable_bulan">
							</div>
						</div>							
															  	
						<div class="col-12 col-sm-5 mb-2 mb-xl-0">
							<div class="form ">
					
									<select class="custom-select" id="tahun_post" name="tahun_post">
										<option selected value="">Pilih Tahun</option>

									<?php 
										$i_tahun = 5;
										$tahun_ini = date("Y");
										for ($i=0; $i < $i_tahun ; $i++) : ?>
											<?php if ($tahun_ini-$i == $this->input->post('tahun_post')): ?>
												<option value="<?= $tahun_ini-$i; ?>" selected><?= $tahun_ini-$i; ?></option>
											<?php else: ?>
												<option value="<?= $tahun_ini-$i; ?>" ><?= $tahun_ini-$i; ?></option>
											<?php endif ?>
										
									<?php endfor; ?>
									    
							  		</select>   
						
						  		
							</div>
						</div>
								 
								<div class="col">
									<div class="form">
										<button type="submit" class="btn btn-primary "><i class="fa fa-search"></i></button>
									</div>
								</div>				  
						</form>
		</div>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col">
	<div class="card p-2 shadow-sm">
		<div class="row">
			<div class="col">
				<div class="table-responsive text-center table-bordered">
					  <table class="table justify-content-center align-self-center">
					  	<thead>
						  	<tr>
						  		<th>Tanggal</th>
						  		<th width="10%">Bukti Transaksi</th>
						  		<th>Keterangan</th>
						  		<th>Akun</th>
						  		<th>Kode Akun</th>
						  		<th>Debit</th>
						  		<th>Kredit</th>
						  		<?php if ($user['role_id'] == 2): ?>
						  			<th>Aksi</th>	
						  		<?php endif ?>		
						  	</tr>
					  	</thead>
					  	<tbody>
							
								<!-- untuk membentuk tabel jurnal umum -->
					  		<?php $data_b = 'uXnaw@2Coba'; ?>
					  		<?php $data_c = 'uXnaw@2Coba' ?>
		
			  		<?php foreach ($tampil_jp as $ju ) : ?>

					  
					  		<tr>
					  			
					  			<?php if ($ju['bukti_transaksi'] == $data_b && $ju['tanggal_transaksi'] == $data_c ): ?>
						  			<td style="border-top: 0px; border-bottom: 0px;"></td>
						  			<td style="border-top: 0px; border-bottom: 0px;"></td>
						  			<td style="border-top: 0px; border-bottom: 0px;"></td>
							  		<td><?= $ju['akun'] ?></td> 
							  		<td><?= $ju['kode_akun'] ?></td>
								  	<?php if ($ju['debit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['debit']); ?></td>
								  	<?php endif ?>
							  		
							  		<?php if ($ju['kredit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['kredit']); ?></td>
								  	<?php endif ?>
							  	
							  	<?php else : ?>
							  		<?php $data_b = $ju['bukti_transaksi'];  ?>
							  		<?php $data_c = $ju['tanggal_transaksi']; ?>

							  		<td style="border-bottom: 0px;"><?= $ju['tanggal_transaksi']?></td>
						  			<td style="border-bottom: 0px;"><?= $ju['bukti_transaksi'] ?></td>
						  			<td width="10%" style="border-bottom: 0px;"><?= $ju['keterangan'] ?></td>
							  		<td width="10%"><?= $ju['akun'] ?></td> 
							  		<td><?= $ju['kode_akun'] ?></td>
							  	 	<?php if ($ju['debit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['debit']); ?></td>
								  	<?php endif ?>
							  		
							  		<?php if ($ju['kredit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['kredit']); ?></td>
								  	<?php endif ?>

								  	<?php if ($user['role_id'] == 2): ?>

								  		<td class="align-items-center">
						  				<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="btn btn-sm mr-1 btn-success mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
						  				<a href="<?= base_url(); ?>jp/hapus_jp/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm mr-1 btn-danger"><i class="fa fa-trash"></i></a>
						  				</td>		

						  			<?php endif ?>
					  			<?php endif ?>
					  		</tr>
					
			  		<?php endforeach; ?>
					  			
					  		<tr>
					  			<td style="border-bottom: 0px; border-left: 0px;border-right: 0px;"></td>
					  			<td style="border-bottom: 0px; border-left: 0px;border-right: 0px;"></td>
					  			<td style="border-bottom: 0px; border-left: 0px;border-right: 0px;"></td>
					  			<td style="border-bottom: 0px; border-left: 0px;border-right: 0px;"></td>
					  			<td>Total</td>

					  			<?php if (!empty($totaljp_d)): ?>
						  			<td><?= rupiah($total_debit); ?></td>
						  			<td><?= rupiah($total_kredit); ?></td>
					  			<?php else: ?>
						  			<td><?= rupiah($total_debit) ;?></td>
						  			<td><?= rupiah($total_kredit) ; ?></td>	
					  			<?php endif ?>
					  			<?php if ($user['role_id'] == 2): ?>
					  				<td style="border-bottom: 0px; border-left: 0px;border-right: 0px;"></td>
					  			<?php endif ?>
					  			
					  		</tr>

					
					  	</tbody>
					  </table>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
<script type="text/javascript">

	$(document).ready(function(){

		$("#enable_bulan").click(function(){
					if ($('#bulan_post').attr('disabled')) {
					
						$('#bulan_post').removeAttr('disabled');
					
					} else {
					
						$('#bulan_post').attr('disabled', 'disabled');

					}
			
			});
	});
</script>




