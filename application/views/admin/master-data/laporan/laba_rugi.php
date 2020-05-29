<div class="container-fluid">
	
	<div class="row my-2">
	<div class="col">
		<div class="card p-2 shadow-sm">
			<div class="m-2 row justify-content-center">
				<div class="col">
					<div class="row">
						<div class="col  text-center">
							<h3 class="font-weight-bold">Laba Rugi</h3>
						</div>
					</div>
					<div class="row">
						<div class="col text-center">
							<?php if ($this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
								<h5><?= $nama_bulan?> <?= $tahun?></h5>
							<?php elseif ($this->input->post('tanggal_awal')) :?>
								<h5><?= $this->input->post('tanggal_awal') ?> s.d <?= $this->input->post('tanggal_akhir') ?></h5>
							<?php elseif ($this->input->post('tahun_post')) : ?>
								<h5><?=  "Tahun ".$tahun; ?></h5>
							<?php else: ?>
								<h5><?= $nama_bulan?> <?= $tahun ?></h5>
							<?php endif ?>
						</div>
						
					</div>
				</div>
			</div>
		<hr class="m-0 mb-2">
			<div class="row mb-2">
				<?php if ($user['role_id'] == 2): ?>
				<div class="col-12 col-md-4 col-xl-3">
					<a role="button" href="<?= base_url();?>admin/transaksi_m" class="btn btn-success" style="height: 100%; width: 100%;">Tambah Data</a>
				</div>
				<div class="mt-2 mt-md-0 col-6 col-md-3 col-xl-2">
				<?php else: ?>
				<div class="mt-2 mt-md-0 col-6 col-md-6 col-xl-2">	
				<?php endif ?>
				
				
					<form method="post" action="<?= base_url();?>labarugi/cetak_lr">
				  					<!-- <input type="text" name="akun" id="akun" value="" hidden> -->
				  					<?php if ($this->input->post('tanggal_awal') && $this->input->post('akun')) : ?>
				  						<input type="text" name="tanggal_awal" value="<?= $t_aw; ?>" hidden>
										<input type="text" name="tanggal_akhir" value="<?=  $t_ak; ?>" hidden>
										<input type="text" name="akun" value="<?= $this->input->post('akun'); ?>" hidden>
										<input type="text" name="kode_akun" value="<?= $this->input->post('kode_akun'); ?>" hidden>
									<?php elseif ($this->input->post('tahun_post') && $this->input->post('akun')) : ?>
										<input type="text" name="tahun_post" value="<?=  $this->input->post('tahun_post'); ?>" hidden>
										<input type="text" name="akun" value="<?= $this->input->post('akun'); ?>" hidden>
										<input type="text" name="kode_akun" value="<?= $this->input->post('kode_akun'); ?>" hidden>
									<?php elseif ( $this->input->post('akun') && $this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
										<input type="text" name="akun" value="<?= $this->input->post('akun'); ?>" hidden>
										<input type="text" name="kode_akun" value="<?= $this->input->post('kode_akun'); ?>" hidden>
										<input type="text" name="tanggal_awal" value="<?= $this->input->post('tanggal_awal'); ?>" hidden>
										<input type="text" name="tanggal_akhir" value="<?=  $this->input->post('tanggal_akhir'); ?>" hidden>

									<?php elseif ($this->input->post('tanggal_awal')): ?>
										<input type="text" name="tanggal_awal" value="<?= $this->input->post('tanggal_awal'); ?>" hidden>
										<input type="text" name="tanggal_akhir" value="<?=  $this->input->post('tanggal_akhir'); ?>" hidden>
									<?php elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) : ?>
										<input type="text" name="bulan_post" value="<?= $this->input->post('bulan_post'); ?>" hidden>
										<input type="text" name="tahun_post" value="<?=  $this->input->post('tahun_post'); ?>" hidden>
									<?php elseif ($this->input->post('tahun_post')) : ?>
									
										<input type="text" name="tahun_post" value="<?= $this->input->post('tahun_post'); ?>" hidden>
									<?php else: ?>
										<input type="text" name="bulan_post" hidden disabled>
										<input type="text" name="tahun_post" hidden disabled>
										<input type="text" name="tanggal_awal" hidden disabled>
										<input type="text" name="tanggal_akhir" hidden disabled>
									<?php endif ?>
		  			<button type="submit" class="btn btn-warning" style=""><i class="fa fa-file-pdf mr-1 d-none d-sm-inline"></i>Cetak</button>
		  			</form>
				</div>
				
				<div class="mt-2 mt-md-0 col-6 col-md-2 col-xl-1 ">
					 <a class="btn btn-success" href="<?= base_url();?>labarugi">Reset</a>
				</div>
				<?php if ($user['role_id'] == 1 ): ?>
				<div class="col-xl-3"></div>	
				<?php endif ?>
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
						<div class="col-10 mb-2 mb-sm-0 col-sm-5">
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
										  	
						<div class="col-12 col-sm-5">
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
				<div class="row">
					<div class="col offset-6">
						<?= form_error ('tahun_post','<small class="text-danger pl-3">','</small>'); ?> 
					</div>
				</div>
			</div>
	</div>
	</div>

	<div class="row mb-2">
	<div class="col">
	<div class="card shadow-sm p-2">
		<div class="row">
			<div class="col">
				<div class="table-responsive text-center table-bordered">
					  <table class="table justify-content-center align-self-center">
					  	<thead >
						  	<tr class="font-weight-bold">
						  		<td>Kode Akun</td>
						  		<td>Nama Akun</td>
						  		<td>Jumlah</td>
						  		<td>Total</td>
						  	</tr>
					  	</thead>
					<!-- AWAL SEMUA INI -->
			<!-- Jika Selain Januari -->

			<?php if ($bulan != 1): ?>
					
					<?php $total_akhir = array(); ?>
					<?php foreach ($pos_akun as $pa): ?>
						
					
					  	<thead>
					  		<tr>
					  			<td style="border: 0px;"><strong><?php echo $pa; ?></strong></td>
					  		</tr>
					  	</thead>

					  	<?php 

					  	$p_akun2 = $this->db->get_where('daftar_akun',['pos_akun' => $pa])->result_array(); ?>
					  	<!-- MENGHITUNG JUMLAH PER AKUN -->
					  	<?php $tot_pos = array(); ?>
						<?php foreach ($p_akun2 as $pa_n): ?>
						
						  	<?php

						  			// total saldo awal
						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

						  			// data sebelum bulan post
						  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
							  		$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

											// data bulan post
								if ($this->input->post('tanggal_awal')) {
										// data bulan post
									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;	
								} else {

										// data bulan post
									$this->db->where('year(tanggal_transaksi)',$tahun);
									$this->db->where('month(tanggal_transaksi)',$bulan);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun);
									$this->db->where('month(tanggal_transaksi)',$bulan);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								}
									$debit = $deb + $deb_b + $sa_d;
									$kredit = $kre + $kre_b + $sa_k;
						  	
									if ($pa_n['saldo_normal'] == 'Kredit') {
										$tot_pos[$pa_n['akun']] = $kredit - $debit  ;
									} else {
										$tot_pos[$pa_n['akun']] =  $debit - $kredit  ;
									}
									

						  	 ?>
						<?php endforeach; ?>

						<!-- MENGHITUNG JUMLAH PER POS AKUN -->
						<?php $tot_perpos = array(); ?>
						<?php foreach ($p_akun2 as $pa_n): ?>
						
						  	<?php
						  	 			// total saldo awal
						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

						  				// data sebelum bulan post
						  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
							  		$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

										// data bulan post
								if ($this->input->post('tanggal_awal')) {
										// data bulan post
									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;	
								} else {
									$this->db->where('year(tanggal_transaksi)',$tahun);
									$this->db->where('month(tanggal_transaksi)',$bulan);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun);
									$this->db->where('month(tanggal_transaksi)',$bulan);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;
								}
									
									$debit = $deb + $deb_b + $sa_d;
									$kredit = $kre + $kre_b + $sa_k;
						  	
						  		if ($pa_n['saldo_normal'] == 'Kredit') {
										$tot_perpos[$pa_n['pos_akun']] = $kredit - $debit;
									} else {
										$tot_perpos[$pa_n['pos_akun']] = $debit - $kredit;
									}

								

						  	 ?>
						<?php endforeach; ?>
		
					  	<?php

					  		$tampil = $this->db->get_where('daftar_akun',['pos_akun' => $pa])->result_array();
					  	?>
					  	<tbody>
					  		<!-- MENAMPILKAN DATA TOTAL PER AKUN -->
					  		<?php foreach ($tampil as $tp): ?>
							<tr>
									<td><?= $tp['kode_akun']; ?></td>
									<td><?= $tp['akun']; ?></td>
									<td><?= rupiah($tot_pos[$tp['akun']]); ?></td>
									<td></td>
							</tr>
							<?php endforeach ?>
							<tr style="background-color: #D7ECD9";>
									<td></td>
									<td></td>
									<td>Jumlah Total</td>
									<!-- MENGINISIASI BAHWA TOT PERPOS HARUS 0 JIKA TIDAK ADA DATA -->
									<?php if (!empty($tot_perpos[$pa])): ?>
										<td><?= rupiah($tot_perpos[$pa]); ?></td>
									<?php else: ?>
										<td><?= rupiah($tot_perpos[$pa] = 0); ?></td>
									<?php endif ?>
									
							</tr>
					  	</tbody>
					  	<?php $total_akhir[$pa] =  $tot_perpos[$pa] ;?>

					<?php endforeach ?>

			<?php else: ?>

			<!-- Jika Bulan Januari dan Tahun -->
					<?php $total_akhir = array(); ?>
					<?php foreach ($pos_akun as $pa): ?>
						
					
					  	<thead>
					  		<tr>
					  			<td style="border: 0px;"><strong><?php echo $pa; ?></strong></td>
					  		</tr>
					  	</thead>

					  	<?php 

					  	$p_akun2 = $this->db->get_where('daftar_akun',['pos_akun' => $pa])->result_array(); ?>
					  	<!-- MENGHITUNG JUMLAH PER AKUN -->
					  	<?php $tot_pos = array(); ?>
						<?php foreach ($p_akun2 as $pa_n): ?>
							
						  	<?php
						  		// total saldo awal
						  	if ($this->input->post('tanggal_awal')) {
						  		
						  		if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

					  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

										$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$debit = $sa_d + $deb;
									$kredit = $sa_k + $kre;

						  		} else {

						  				// total saldo awal
						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

						  				// data sebelum bulan post
						  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
							  		$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

										// data bulan post
									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$debit = $deb + $deb_b + $sa_d;
									$kredit = $kre + $kre_b + $sa_k;

						  		}

						  	} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {

						  		$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								// $date = date('Y');
								$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;
						  	
						  	} elseif ($this->input->post('tahun_post')) {
						  		$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  		$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  		$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;
				
								$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;

						  	} else {

						  		$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								// $date = date('Y');
								$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;
						  	}
						  		
								if ($pa_n['saldo_normal'] == 'Kredit') {
										$tot_pos[$pa_n['akun']] = $kredit - $debit   ;
									} else {
										$tot_pos[$pa_n['akun']] =  $debit - $kredit  ;
									}	

						  	 ?>
						<?php endforeach; ?>

						<!-- MENGHITUNG JUMLAH PER POS AKUN -->
						<?php $tot_perpos = array(); ?>
						<?php foreach ($p_akun2 as $pa_n): ?>
						
						  	<?php
					  	 	if ($this->input->post('tanggal_awal')) {
						  		
						  		if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

					  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

										$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$debit = $sa_d + $deb;
									$kredit = $sa_k + $kre;

						  		} else {
						  			
						  				// total saldo awal
						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

						  				// data sebelum bulan post
						  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
							  		$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

										// data bulan post
									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$debit = $deb + $deb_b + $sa_d;
									$kredit = $kre + $kre_b + $sa_k;

						  		}

						  	} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {
						  		
						  		$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								// $date = date('Y');
								$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;
						  	
						  		} elseif ($this->input->post('tahun_post')) {

						  	 	$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;
				
								$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;

						  	} else {
						  		
						  		$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								// $date = date('Y');
								$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;
						  	}

								if ($pa_n['saldo_normal'] == 'Kredit') {
										$tot_perpos[$pa_n['pos_akun']] = $kredit - $debit;
									} else {
										$tot_perpos[$pa_n['pos_akun']] = $debit - $kredit;
									}

						  	 ?>
						<?php endforeach; ?>
		
					  	<?php

					  		$tampil = $this->db->get_where('daftar_akun',['pos_akun' => $pa])->result_array();
					  	?>
					  	<tbody>
					  		<?php foreach ($tampil as $tp): ?>
							<tr>
									<td><?= $tp['kode_akun']; ?></td>
									<td><?= $tp['akun']; ?></td>
									<td><?= rupiah($tot_pos[$tp['akun']]); ?></td>
									<td></td>
							</tr>
							<?php endforeach ?>
							<tr style="background-color: #D7ECD9";>
									<td></td>
									<td></td>
									<td>Jumlah Total</td>
									<?php if (!empty($tot_perpos[$pa])): ?>
										<td><?= rupiah($tot_perpos[$pa]); ?></td>
									<?php else: ?>
										<td><?= rupiah($tot_perpos[$pa] = 0); ?></td>
									<?php endif ?>
									
							</tr>
					  	</tbody>
					  	<?php $total_akhir[$pa] =  $tot_perpos[$pa] ;?>

					<?php endforeach ?>
			<?php endif ?>
						<tbody>
							<?php  
							$saldo_laba = $total_akhir['Pendapatan'] - $total_akhir['Beban'] - $total_akhir['Pajak']; ?>
							<tr class="bg-dark text-white" >
									<td style="border: 0px;"></td>
									<td style="border: 0px;">Laba Bersih Setelah Pajak</td>
									<td style="border: 0px;"></td>
									<td><?= rupiah($saldo_laba); ?></td>
									
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
