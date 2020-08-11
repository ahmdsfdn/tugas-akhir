<div class="container-fluid">
	<div class="shadow-sm card mb-2 p-2">
			<div class="row">
				<div class="col  text-center">
					<h3 class="font-weight-bold">Laporan Posisi Keuangan</h3>
				</div>
			</div>
			<div class="row">
				<div class="col text-center">
					<?php if ($this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
						<h5><?= $nama_bulan?> <?= $tahun?></h5>
					<?php elseif ($this->input->post('tahun_post')) : ?>
						<h5><?=  "Tahun ".$tahun; ?></h5>
					<?php elseif ($this->input->post('tanggal_awal')) : ?>
						<h5><?= $this->input->post('tanggal_awal')." s.d ".$this->input->post('tanggal_akhir') ?></h5>
					<?php else: ?>
						<h5><?= $nama_bulan?> <?= $tahun ?></h5>
					<?php endif ?>
				</div>
				
			</div>
			<hr class="m-0 mb-2">
          	<div class="row">
          		<?php if ($user['role_id'] == 2): ?>
          			<div class="col-12 col-md-4 col-xl-3">
          				<a role="button" href="<?= base_url();?>admin/transaksi_m" class="btn btn-success" style="height: 100%; width: 100%;">Tambah Data</a>
          			</div>
          			<div class="mt-2 mt-md-0 col-6 col-md-3 col-xl-2" style="height: 100%;">
          		<?php else: ?>
          			<div class="mt-2 mt-md-0 col-6 col-sm-3 col-md-2 col-xl-2" style="height: 100%;">
          		<?php endif ?>         		
          			<form method="post" action="<?= base_url();?>Poskeu/cetak_poskeu">
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
								<input type="text" name="tanggal_awal" value="<?= $t_aw; ?>" hidden>
								<input type="text" name="tanggal_akhir" value="<?=  $t_ak; ?>" hidden>

							<?php elseif ($this->input->post('tanggal_awal')): ?>
								<input type="text" name="tanggal_awal" value="<?= $this->input->post('tanggal_awal'); ?>" hidden>
								<input type="text" name="tanggal_akhir" value="<?=  $this->input->post('tanggal_akhir'); ?>" hidden>
							<?php elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) : ?>
								<input type="text" name="bulan_post" value="<?= $this->input->post('bulan_post'); ?>" hidden>
								<input type="text" name="tahun_post" value="<?=  $this->input->post('tahun_post'); ?>" hidden>
							<?php elseif ($this->input->post('tahun_post')) : ?>
							
								<input type="text" name="tahun_post" value="<?=  $this->input->post('tahun_post'); ?>" hidden>
							<?php else: ?>
								<input type="text" name="bulan_post" hidden disabled>
								<input type="text" name="tahun_post" hidden disabled>
								<input type="text" name="tanggal_awal" hidden disabled>
								<input type="text" name="tanggal_akhir" hidden disabled>
							<?php endif ?>
          			<button type="submit" class="btn btn-warning" style=""><i class="d-none d-sm-inline fa fa-file-pdf mr-1"></i>Cetak</button>

          			</form>
          		</div>
          		<div class="mt-2 mt-md-0 col-6 col-md-2 col-xl-1">
				     <a class="btn btn-success" href="<?= base_url();?>per_modal">Reset</a>
				</div>
          		
          	<?php if ($user['role_id'] == 1): ?>
          	   	<div class="col-xl-3"></div>
      	   	<?php endif ?>   
          	
          
          	<div class="row">
          		<div class="col offset-3">
          			<?= form_error ('tahun_post','<small class="text-danger pl-3">','</small>'); ?> 
          		</div>
          	</div>

		</div>
		<div class="row mt-2">	
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
										  	
						<div class="col-12 mb-2 mb-sm-0 col-sm-5">
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

	          
	          	<div class="row">
	          		<div class="col offset-3">
	          			<?= form_error ('tahun_post','<small class="text-danger pl-3">','</small>'); ?> 
	          		</div>
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
						  	<thead >
							  	<tr class="font-weight-bold">
							  		<td>Kode Akun</td>
							  		<td>Nama Akun</td>
							  		<td>Nominal</td>
							  	
							  	</tr>
						  	</thead>

			<!-- START PERULANGAN UNTUK PER POS AKUN -->

				<!-- ASET LANCAR DAN ASET TETAP-->
				<?php $jumlah_a1 = array(); ?>
			
					<?php foreach ($pos_nr1 as $a_pos) : ?>
					<?php  
						$klasifikasi_posakun = $this->db->get_where('daftar_akun',['pos_akun' => $a_pos])->result_array();
					 ?>
						  	<thead>
							  	<tr>
							  		<td style="border: 0px;"><strong><?= $a_pos; ?></strong></td>
							  	</tr>
						  	</thead>
						  	<tbody>
							<!-- Data Saldo awal -->
								<?php $total_sa = array() ?>
							
									<?php foreach ($klasifikasi_posakun as $ap ): ?>

										<?php 

										// Bulan INI
										// SALDO AWAL
										// MENJUMLAH NOMINAL DARI SETIAP AKUN MENURUT POS AKUN
											$date = $tahun;
											// $month = date('m');
											$this->db->where('year(tanggal_transaksi)',$date);
											// $this->db->where('month(tanggal_transaksi)',$month);
											$this->db->select('SUM(debit) as total');
											$debit = $this->db->get_where('saldo_awal',['akun' => $ap['akun']])->row()->total;

											$this->db->where('year(tanggal_transaksi)',$date);
											// $this->db->where('month(tanggal_transaksi)',$month);
											$this->db->select('SUM(kredit) as total');
											$kredit = $this->db->get_where('saldo_awal',['akun' => $ap['akun']])->row()->total;
											
											$total_sa[$ap['akun']] = $debit - $kredit ;
																			
										?>

									<?php endforeach;?>

							<!-- PENJUMLAHAN PER POS AKUN -->
								<?php $total = array() ?>
								
									<?php foreach ($klasifikasi_posakun as $ap ): ?>

										<?php 
	  
										// Bulan INI
										// MENJUMLAH NOMINAL DARI SETIAP AKUN MENURUT POS AKUN
												if ($this->input->post('tanggal_awal')) {
						  		
						  		if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {


					  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

										$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

									$debit =  $deb;
									$kredit =  $kre;

						  		} else {

						  				// total saldo awal
						  		

						  				// data sebelum bulan post
						  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
							  		$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

										// data bulan post
									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

									$debit = $deb + $deb_b ;
									$kredit = $kre + $kre_b ;

						  		}

						  	} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

												if ($this->input->post('bulan_post') != 1) {

													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(debit) as total');
													$debit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;


													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(kredit) as total');
													$kredit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$debit = $debit1 + $debit2;
													$kredit = $kredit1 + $kredit2;

												} else {

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												}
												
											} else {

												if ($bulan != 1 ) {
													 
													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(debit) as total');
													$debit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;


													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(kredit) as total');
													$kredit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$debit = $debit1 + $debit2;
													$kredit = $kredit1 + $kredit2;


												} else {

													if ($this->input->post('tahun_post')) {
														$this->db->where('year(tanggal_transaksi)',$tahun);
														
														$this->db->select('SUM(debit) as total');
														$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

														$this->db->where('year(tanggal_transaksi)',$tahun);
														
														$this->db->select('SUM(kredit) as total');
														$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;
													} else {
														$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
														$this->db->select('SUM(debit) as total');
														$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

														$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
														$this->db->select('SUM(kredit) as total');
														$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;
													}
													
												}
												

											}
											$total[$ap['akun']] = $debit - $kredit ;

																			
										?>

									<?php endforeach;?>	
									
							<!-- MENAMPILKAN  -->

					  			<?php foreach ($klasifikasi_posakun as $al): ?>
							  		<tr>	
						  				<td><?= $al['kode_akun'];?></td>
						  				<td><?= $al['akun'];?></td>
						  				<td><?= rupiah($total[$al['akun']] + $total_sa[$al['akun']]); ?></td>
						  			
									</tr>
							  	<?php endforeach ?>
								  	<tr>
										<td></td>
										<td>Jumlah <?= $a_pos; ?></td>
										<td><?= rupiah(array_sum($total) + array_sum($total_sa)); ?></td>
										
									</tr>
								<?php 
									$jumlah_a1[] = array_sum($total) + array_sum($total_sa);
							
								 ?>
					<?php endforeach; ?>
								<tr style="background-color: #D7ECD9";>
									<td></td>
									<td>Jumlah Total Aset</td>
									<td><?= rupiah(array_sum($jumlah_a1)); ?></td>
								
								</tr>

					<!-- KEWAJIBAN DAN EKUITAS -->
									
					<!-- Batas Coba -->
					<?php $jumlah_ek1 = array(); ?>
		
					<?php foreach ($pos_nr2 as $a_pos) : ?>
					<?php 
						$klasifikasi_posakun = $this->db->get_where('daftar_akun',['pos_akun' => $a_pos])->result_array();		
					 ?>
						  	<thead>
							  	<tr>
							  		<td style="border: 0px;"><strong><?= $a_pos; ?></strong></td>
							  	</tr>
						  	</thead>
						  	<tbody>

						  		

						  		<!-- SALDO AWAL -->
							
								<?php $total_saek = array() ?>
							
									<?php foreach ($klasifikasi_posakun as $ap ): ?>
										<?php 

										// Bulan INI
										// MENJUMLAH NOMINAL DARI SETIAP AKUN MENURUT POS AKUN

												$date = $tahun;
												$this->db->where('year(tanggal_transaksi)',$date);
												// $this->db->where('month(tanggal_transaksi)',$month);
												$this->db->select('SUM(debit) as total');
												$debit = $this->db->get_where('saldo_awal',['akun' => $ap['akun']])->row()->total;

												$this->db->where('year(tanggal_transaksi)',$date);
												// $this->db->where('month(tanggal_transaksi)',$month);
												$this->db->select('SUM(kredit) as total');
												$kredit = $this->db->get_where('saldo_awal',['akun' => $ap['akun']])->row()->total;

										
											
											
												if ($ap['saldo_normal'] == 'Kredit') {
													$total_saek[$ap['akun']] = $kredit - $debit ;
												} else {
													$total_saek[$ap['akun']] = $kredit - $debit ;
												}
											
								
										?>

									<?php endforeach; ?>

							<!-- PENJUMLAHAN PER POS AKUN -->
								<?php $total = array() ?>
							
									<?php foreach ($klasifikasi_posakun as $ap ): ?>
										<?php 

								if ($this->input->post('tanggal_awal')) {
						  		
									  		if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

									  		

								  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(debit) as total');
												$deb = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$debit =  $deb;
												$kredit =  $kre;

									  		} else {

									  				// total saldo awal
									  			
									  				// data sebelum bulan post
									  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
										  		$this->db->select('SUM(debit) as total');
												$deb = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													// data bulan post
												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
										  		$this->db->select('SUM(debit) as total');
												$deb_b = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
												$this->db->select('SUM(kredit) as total');
												$kre_b = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												$debit = $deb + $deb_b ;
												$kredit = $kre + $kre_b ;

									  		}

						  	} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

												if ($this->input->post('bulan_post') != 1) {

													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(debit) as total');
													$debit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;


													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(kredit) as total');
													$kredit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$debit = $debit1 + $debit2;
													$kredit = $kredit1 + $kredit2;

												} else {

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);  
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

												}
												
											} else {

												if ($bulan != 1 ) {
													 
													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(debit) as total');
													$debit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;


													$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
													$this->db->select('SUM(kredit) as total');
													$kredit1 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(debit) as total');
													$debit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
													$this->db->select('SUM(kredit) as total');
													$kredit2 = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

													$debit = $debit1 + $debit2;
													$kredit = $kredit1 + $kredit2;


												} else {

													if ($this->input->post('tahun_post')) {
														$this->db->where('year(tanggal_transaksi)',$tahun);
													
														$this->db->select('SUM(debit) as total');
														$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

														$this->db->where('year(tanggal_transaksi)',$tahun);
														
														$this->db->select('SUM(kredit) as total');
														$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;
													} else {
														$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
														$this->db->select('SUM(debit) as total');
														$debit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;

														$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
														$this->db->select('SUM(kredit) as total');
														$kredit = $this->db->get_where('transaksi',['akun' => $ap['akun']])->row()->total;
													}								

												}
												

											}

										// Bulan Ini

												if ($ap['saldo_normal'] == 'Kredit') {
													$total[$ap['akun']] = $kredit - $debit ;
												} else {
													$total[$ap['akun']] = $kredit - $debit ;
												}
				
										?>			
									<?php endforeach;?>									
							<!-- MENAMPILKAN  -->
					  			<?php foreach ($klasifikasi_posakun as $al): ?>
					  				<?php if ($a_pos == 'Kewajiban'): ?>


							  		<tr>	
						  				<td><?= $al['kode_akun'];?></td>
						  				<td><?= $al['akun'];?></td>
						  				
						  				<!-- SEBENARNYA TIDAK USAH PAKAI IF TIDAK PAPA -->
						  				<!-- <?php if ($total[$al['akun']] + $total_saek[$al['akun']] < 0): ?>
						  					<td><?= rupiah($total[$al['akun']] + $total_saek[$al['akun']]); ?></td>
						  				<?php else: ?>	
						  					<td><?= rupiah($total[$al['akun']] + $total_saek[$al['akun']]); ?></td>
						  				<?php endif ?> -->
					  					<td><?= rupiah($total[$al['akun']] + $total_saek[$al['akun']]); ?></td>
						  				
						  		
									</tr>

									<?php endif; ?>
									
							  	<?php endforeach ?>
							  		
								<?php if ($a_pos == 'Ekuitas'): ?>
									<?php foreach ($klasifikasi_posakun as $al): ?>

							  		<tr>	
						  				<td><?= $al['kode_akun'];?></td>
						  				<td><?= $al['akun'];?></td>
					  					<td><?= rupiah($total[$al['akun']] + $total_saek[$al['akun']]); ?></td>
						  		
									</tr>

									
							  	<?php endforeach ?>
									<tr>
											<td></td>
											<td>Laba Rugi</td>
											<td><?= rupiah($lr); ?></td>
									</tr>

									<!-- <tr>
					  					<td></td>
					  					<td>Perubahan Modal</td>
					  					<td><?= rupiah(array_sum($total) + array_sum($total_saek) + $lr); ?></td>
					  				</tr> -->

									<tr>
											<td></td>
											<td>Jumlah <?= $a_pos; ?></td>
											<td><?= rupiah(array_sum($total) + array_sum($total_saek) + $lr); ?></td>
							
									</tr>
									<?php 
										$jumlah_ek1[] =  array_sum($total) + array_sum($total_saek) + $lr ;
								 
									 ?>
								<?php else: ?>
									<tr>
											<td></td>
											<td>Jumlah <?= $a_pos; ?></td>
											<td><?= rupiah(array_sum($total) + array_sum($total_saek)); ?></td>
							
									</tr>
									<?php 
										$jumlah_ek1 []= array_sum($total) + array_sum($total_saek) ;
								 
									 ?>
								<?php endif ?>
							  
								
					<?php endforeach; ?>
								<!-- <?php print_r($jumlah_ek1); ?> -->
								<tr style="background-color: #D7ECD9";>
									<td></td>
									<td>Jumlah Total Kewajiban + Ekuitas</td>
									<td><?= rupiah(array_sum($jumlah_ek1)); ?></td>
						
								</tr>
			<!-- END PERULANGAN PER POS AKUN -->

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

