<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card p-2 shadow-sm">	
				<div class="row">
					<div class="col  text-center">
						<h3 class="font-weight-bold">Perubahan Modal</h3>
					</div>
				</div>
				<div class="row">
					<div class="col text-center">
						<?php if ($this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
							<h5><?= $nama_bulan?> <?= $tahun?></h5>
						<?php elseif ($this->input->post('tahun_post')) : ?>
							<h5><?=  "Tahun ".$tahun; ?></h5>
						<?php elseif ($this->input->post('tanggal_awal')) : ?>
							<h5><?= $this->input->post('tanggal_awal') ." s.d ".$this->input->post('tanggal_akhir'); ?></h5>
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
		          		<div class="mt-2 mt-md-0 col-6 col-md-3 col-xl-2">
		          	<?php else: ?>
		          		<div class="mt-2 mt-md-0 col-6 col-sm-3 col-md-3 col-xl-2" style="height: 100%;">
	          		<?php endif ?>
	          		
	          		
	          			<form method="post" action="<?= base_url();?>Per_modal/cetak_permodal">
	          					<!-- <input type="text" name="akun" id="akun" value="" hidden> -->
	          					<?php if ($this->input->post('tanggal_awal') && $this->input->post('akun')) : ?>
	          						<input type="text" name="tanggal_awal" value="<?= $this->input->post('tanggal_awal'); ?>" hidden>
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
	          			<button type="submit" class="btn btn-warning" style=""><i class="fa fa-file-pdf mr-1 d-none d-sm-inline"></i>Cetak</button>

	          			</form>
	          		</div>
	          		<div class="mt-2 mt-md-0 col-6 col-sm-3 col-md-2 col-xl-1" style="height: 100%;  ">
					     <a class="btn btn-success" href="<?= base_url();?>per_modal">Reset</a>
					</div>
	          		
	          	<?php if ($user['role_id'] == 1 ): ?>
					<div class="col-xl-3"></div>	
				<?php endif ?>  
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
	</div>
	</div>
	<div class="row justify-content-center mt-2">
		<div class="col">
		<div class="card p-2 shadow-sm">
			<div class="row">
				<div class="col">
					<div class="table-responsive table-bordered">
						  <table class="table justify-content-center align-self-center">
						  		<tr>
						  			<td>
								<?php $jumlah = array(); ?>
						  		<?php foreach ($pos_ekuitas as $pe ): ?>
						  			
						  			<?php 
							  			$tampil_data = $this->db->get_where('daftar_akun',['akun' => $pe['akun']])->result_array();
							  		
							  		// DATA SALDO AWAL
							 		$total_sa = array();

								  		foreach ($tampil_data as $td ) {
									  		if ($this->input->post('bulan_post') or $this->input->post('tahun_post') or $this->input->post('tanggal_awal')) {
									  			
												
													$date_sa = $tahun;
													$this->db->where('year(tanggal_transaksi)',$date_sa);
													$this->db->select('SUM(debit) as total');
													$debit = $this->db->get_where('saldo_awal',['akun' => $td['akun']])->row()->total;
											
													$this->db->where('year(tanggal_transaksi)',$date_sa);
													$this->db->select('SUM(kredit) as total');
													$kredit = $this->db->get_where('saldo_awal',['akun' => $td['akun']])->row()->total;
										

									  		} else {

									  			$date = date('Y');
												$this->db->where('year(tanggal_transaksi)',$date);
									  			$this->db->select('SUM(debit) as total');
									  			$debit = $this->db->get_where('saldo_awal',['akun' => $td['akun']])->row()->total;

									  			$this->db->where('year(tanggal_transaksi)',$date);
									  			$this->db->select('SUM(kredit) as total');
									  			$kredit = $this->db->get_where('saldo_awal',['akun' => $td['akun']])->row()->total;

									  		}
								  			
									  			if ($td['saldo_normal'] == 'Kredit') {
									  				$total_sa = [ $td['akun'] => $kredit - $debit ];
									  			} else {
									  				// untuk menegatifkan prive
									  				$total_sa = [ $td['akun'] =>  $kredit - $debit];
									  			}
							  			
								  		}
								  			
						  		
							  		// PENJUMLAHAN AKUN TANPA SALDO AWAL
							  		$total_pa = array();

								  		foreach ($tampil_data as $td ) {

								  			if ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {
									  			
									  			if ($this->input->post('bulan_post') == 1) {

												$this->db->where('year(tanggal_transaksi)',$tahun);
												$this->db->where('month(tanggal_transaksi)',$bulan);
												$this->db->select('SUM(debit) as total');
												$debit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
										
												$this->db->where('year(tanggal_transaksi)',$tahun);
												$this->db->where('month(tanggal_transaksi)',$bulan);
												$this->db->select('SUM(kredit) as total');
												$kredit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

												} else {

												// HITUNGAN BULAN SEBELUM

												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(debit) as total');
												$deb_kmrn = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
										
												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre_kmrn = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

												// HITUNGAN BULAN INI

												$this->db->where('year(tanggal_transaksi)',$tahun);
												$this->db->where('month(tanggal_transaksi)',$bulan);
												$this->db->select('SUM(debit) as total');
												$deb_bln_ini = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
										
												$this->db->where('year(tanggal_transaksi)',$tahun);
												$this->db->where('month(tanggal_transaksi)',$bulan);
												$this->db->select('SUM(kredit) as total');
												$kre_bln_ini = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

												$debit = $deb_kmrn + $deb_bln_ini;
												$kredit = $kre_kmrn + $kre_bln_ini;

												}

									  		} elseif ($this->input->post('tanggal_awal')) {

									  			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {
									  			
												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(debit) as total');
												$debit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
										
												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kredit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;


									  			} else {

									  			// HITUNGAN RANGE SEBELUM

												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(debit) as total');
												$deb_kmrn = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
										
												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre_kmrn = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

												// HITUNGAN RANGE INI INI

												
												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
												$this->db->select('SUM(debit) as total');
												$deb_bln_ini = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
										
												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
												$this->db->select('SUM(kredit) as total');
												$kre_bln_ini = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

												$debit = $deb_kmrn + $deb_bln_ini;
												$kredit = $kre_kmrn + $kre_bln_ini;

									  			}
									  		} else {
									  		
									  		// JIKA TIDAK INPUT APAPUN MASIH ORIGINAL NIH

									  			if ($bulan == 1) {

									  				if ($this->input->post('tahun_post')) {
									  					// pencarian pertahun
									  					$this->db->where('year(tanggal_transaksi)',$tahun);
													
											  			$this->db->select('SUM(debit) as total');
											  			$debit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

											  			$this->db->where('year(tanggal_transaksi)',$tahun);
													
											  			$this->db->select('SUM(kredit) as total');
											  			$kredit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

									  				} else {
										  				$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
											  			$this->db->select('SUM(debit) as total');
											  			$debit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

											  			$this->db->where('year(tanggal_transaksi)',$tahun);
														$this->db->where('month(tanggal_transaksi)',$bulan);
											  			$this->db->select('SUM(kredit) as total');
											  			$kredit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
											  		}
									  			} else {

									  				// data yang dijumlah sebelum bulan ini
								  					$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
										  			$this->db->select('SUM(debit) as total');
										  			$deb = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

									  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
													$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
										  			$this->db->select('SUM(kredit) as total');
										  			$kre = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

									  				// sesudah bulan ini
										  			$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
										  			$this->db->select('SUM(debit) as total');
										  			$deb_ssdh = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

										  			$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
										  			$this->db->select('SUM(kredit) as total');
										  			$kre_ssdh = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

										  			$debit = $deb + $deb_ssdh;
										  			$kredit = $kre + $kre_ssdh;


									  			}
												
									  		}

								  			if ($td['saldo_normal'] == 'Kredit') {
								  				$total_pa = [ $td['akun'] => $kredit - $debit ];
								  			} else {
								  				// untuk menegatifkan prive
								  				$total_pa = [ $td['akun'] =>  $kredit - $debit];
								  			}
								  		}

							  			
						  				?>
						  			
						  			<div class="row mt-4 mx-4">
						  				
						  				<div class="col">
						  					<h5 class="text-left "><?= $pe['akun']; ?></h5>
						  				</div>
						  				<div class="col">
						  					<?php if ($pe['akun'] == 'Prive'): ?>
						  					<h5 class="text-right "><?= rupiah($total_pa[$pe['akun']]); ?></h5>
						  					<?php else: ?>
						  					<h5 class="text-right "><?= rupiah($total_pa[$pe['akun']] + $total_sa[$pe['akun']]) ; ?></h5>
						  					<?php endif ?>
						  					
						  				</div>
						  			</div>

						  		<?php $jumlah[$pe['akun']] = $total_pa[$td['akun']] + $total_sa[$td['akun']];
						  			endforeach;  ?>
						  		<?php 
							  			//print_r($jumlah); ?>

						  			<div class="row mx-4 my-4 bg-dark text-white py-2 ">
						  				
						  				<div class="col">
						  					<h5 class="text-left">Jumlah</h5>
						  				</div>
						  				<div class="col">
				  				
						  						<?php $jumlah_ = array_sum($jumlah); ?>
					  					
						  					<h5 class="text-right"><?= rupiah($jumlah_); ?></h5>
						  				</div>
						  			</div>
						  			<div class="row mx-4 my-4 py-2 ">
						  				
						  				<div class="col">
						  					<h5 class="text-left">Laba Rugi</h5>
						  				</div>
						  				<div class="col">
						  					<h5 class="text-right"><?= rupiah($total_labarugi); ?></h5>
						  				</div>
						  			</div>
						  			<div class="row mx-4 my-4 bg-dark text-white py-2 ">
						  				
						  				<div class="col">
						  					<h5 class="text-left">Total Perubahan Modal</h5>
						  				</div>
						  				<div class="col">
						  					<h5 class="text-right"><?= rupiah($total_labarugi + $jumlah_); ?></h5>
						  				</div>
						  			</div>
					  			</td>
							</tr>
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
