<div class="container-fluid">
<div class="row">

	<?php if ($this->session->flashdata('flash')) : ?>
			
				<div class="col-6">
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						  Data Transaksi<strong> Berhasil</strong> <?= $this->session->flashdata('flash'); ?>
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
					</div>
				</div>	
	<?php endif; ?>
</div>
<div class="card p-2 mb-2 shadow-sm">
<div class="row">
	<div class="col">
			<div class="row">
				<div class="col text-center">
					<h3 class="font-weight-bold">Buku Besar</h3>
				</div>
			</div>
			<div class="row">
				<div class="col text-center">
					<?php if ($this->input->post('tanggal_awal')): ?>
						<h5><?= $t_aw?> s.d. <?= $t_ak ?></h5>
					<?php else: ?>
						<h5><?= $nama_bulan?> <?= $tahun ?></h5>
					<?php endif ?>
				</div>
				
			</div>
	</div>
</div>
<hr class="m-0 mb-2">

<div class="row mb-2 mb-sm-0 mb-xl-2">
	
	<?php if ($user['role_id'] == 2): ?>
		<div class="col-12 col-sm-8 col-md-8 mb-2 mb-xl-0 col-xl-3">
			<a role="button" href="<?= base_url();?>admin/transaksi_m" class="btn btn-success" style="width: 100%;">Tambah Data</a>
		</div>   		
		<div class="col-12 col-sm-4 col-md-4 col-xl-3 mb-2 mb-xl-0">
	<?php else: ?>
		<div class="col-12 col-sm-6 mb-2 mb-xl-0">
	<?php endif ?>
	
		<form method="post" action="<?= base_url();?>buku_besar/pdf">
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
				<input type="text" name="tanggal_awal" value="<?= $t_aw; ?>" hidden>
				<input type="text" name="tanggal_akhir" value="<?=  $t_ak; ?>" hidden>
			<?php elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) : ?>
				<input type="text" name="bulan_post" value="<?= $this->input->post('bulan_post'); ?>" hidden>
				<input type="text" name="tahun_post" value="<?=  $this->input->post('tahun_post'); ?>" hidden>
			<?php elseif ($this->input->post('tahun_post')) : ?>
			
				<input type="text" name="tahun_post" value="<?=  $this->input->post('tahun_post'); ?>" hidden>
			<?php elseif ($this->input->post('akun')) : ?>
				<input type="text" name="akun" value="<?= $this->input->post('akun');?>" hidden>
			<?php else: ?>
				<input type="text" name="bulan_post" hidden disabled>
				<input type="text" name="tahun_post" hidden disabled>
				<input type="text" name="tanggal_awal" hidden disabled>
				<input type="text" name="tanggal_akhir" hidden disabled>
			<?php endif ?>
		<button type="submit" class="btn btn-warning" style="height: 100%; width: auto;"><i class="fa fa-file-pdf mr-2"></i>Cetak</button>

		</form>
	</div>
	<div class="col-12 col-sm-8 col-md-8 mb-2 mb-xl-0 col-xl-5">
		<form action="" method="post">
				<div class="input-group">
					  <select class="custom-select" id="kode_akun" name="kode_akun">
					    <option value="" selected >-- Pilih Kode Akun --</option>
		      			<?php foreach ($dd_kodeakun as $dd) : ?>
		      				<?php if ($dd->kode_akun == $this->input->post('kode_akun')): ?>
		      				<option value="<?=$dd->kode_akun?>" selected><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
		      			<?php else: ?>
		      				<option value="<?= $dd->kode_akun; ?>"><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
		      				<?php endif ?>
		      			<?php endforeach; ?>
					  </select>
					  <div class="input-group-append">
					    <button class="btn btn-outline-primary" type="submit">Proses</button>
					 </div>
				</div>
				<input type="text" name="akun" id="akun" value="" hidden>
				<?php if ($this->input->post('tanggal_awal')): ?>
					<input type="text" name="tanggal_awal" value="<?= $t_aw; ?>" hidden>
					<input type="text" name="tanggal_akhir" value="<?=  $t_ak; ?>" hidden>
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
				
		</form>
	</div>
	<div class="col-12 col-sm-4 col-md-4 col-xl-1">
        	<a class="btn btn-success" href="<?= base_url();?>buku_besar">Reset</a>
	</div>


	

</div>
<div class="row">
	<div class="col-12 col-xl-6">
		<form action="" method="post" class="form-row align-items-center text-center">
			<div class="col-12 col-sm-5 mb-2 mb-xl-0">
				<div class="form ">
					<?php if ($this->input->post('tanggal_awal')): ?>
						<input type="date" class="form-control" name="tanggal_awal" value="<?=  $t_aw ?>" >
						
					<?php else: ?>
						<input type="date" class="form-control" name="tanggal_awal" >
					<?php endif ?>
				</div>									    			
			</div>
			<div class="d-none d-sm-block" style="width: 27px;">
				s/d
			</div>			  	
			<div class="col-12 col-sm-5 mb-2 mb-xl-0">
				<div class="form ">
					<?php if ($this->input->post('tanggal_awal')): ?>
						<input type="date" class="form-control" name="tanggal_akhir" value="<?= $t_ak?>" >
					<?php else: ?>
						<input type="date" class="form-control" name="tanggal_akhir">
					<?php endif ?>
					 		    	
				</div>
			</div>
					<!-- HIDDEN KODE AKUN -->
					<?php if ($this->input->post('kode_akun')) : ?>
						<input type="text" name="kode_akun" id="kode_akun" value="<?= $this->input->post('kode_akun');?> " hidden>
						<input type="text" name="akun" id="akun" value="<?= $this->input->post('akun');?> " hidden>
					<?php else: ?>
						<input type="text" name="kode_akun" value="<?= $this->input->post('kode_akun'); ?>"  hidden disabled>
							<input type="text" name="akun" value="<?= $this->input->post('akun') ?> " hidden disabled>
					<?php endif; ?>

			<div class="col-1 mb-2 mb-xl-0">
				<div class="form">
					<button type="submit" class="btn btn-success "><i class="fa fa-search"></i></button>
				</div>
			</div>

							  
		</form>
	</div>
	<div class="col-12 col-xl-6">
		<form action="" method="post" class="form-row align-items-center text-center">
							<div class="col-10 col-sm-5 mb-2 mb-md-0">
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
					
	          			
		          				<div class="form-check mb-4" style="width: 27px;">
								  <input class="form-check-input" type="checkbox" value="" id="enable_bulan">
								</div>
							
	         
									  	
							<div class="col-12 col-sm-5 mb-2 mb-md-0">
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
							 
							<div class="col-1 mb-md-0">
								<div class="form">
									<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
								</div>
							</div>				  
						</form>
	</div>
</div>
</div>

<!-- START PROSES QUERY -->

<?php if ($this->input->post('akun')): ?>
	
	<?php 
	$akun = $this->input->post('akun');
	$key = $this->db->get_where('daftar_akun',['akun' => $akun])->row_array();

					$datapo[] = ['akun' => $key['akun'],
								 'saldo_normal' => $key['saldo_normal'],
								 'kode_akun' => $key['kode_akun']];
				
	?>

<?php else: ?>

	<?php 
	foreach ($bukber as $key ) {
					$datapo[] = ['akun' => $key['akun'],
								 'saldo_normal' => $key['saldo_normal'],
								 'kode_akun' => $key['kode_akun']];
								 
	} ?>

<?php endif ?>



<?php foreach ($datapo as $d) : ?>




<?php if ($d['saldo_normal'] == 'Kredit'): ?>
	
	<?php 
	
		$this->db->where('year(tanggal_transaksi)',$tahun_sa);
		$data_sa = $this->db->get_where('saldo_awal',['akun' => $d['akun']])->result_array(); 
		
		$this->db->where('year(tanggal_transaksi)',$tahun_sa + 1);
		$data_kd = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 

	?>

<?php if (!empty($data_sa) or !empty($data_kd)): ?>
 

<!-- AKHIR PROSES QUERY -->
	
<div class="mb-2 row justify-content-center">
	<div class="col">
	<div class="card p-2 mb-2 shadow-sm ">
		<div class="row">
			<div class="col-4 text-center">
			<h5><strong><?= $d['akun']; ?></h5></strong>
			</div>
			<div class="col-4 text-center">	
			
			<h5><strong><?= $d['kode_akun']; ?></h5></strong>

			</div>

			<div class="col-4 text-center">	
			
			<h5><strong>Kredit</h5></strong>

			</div>
			
		</div>
		
		<div class="row">
			<div class="col">				
				<div class="table-responsive text-center bg-white">
					  <table class="table table-bordered align-self-center">
					  	<thead>
						  	<tr>
						  		<th>Tanggal</th>
						  		<th>Keterangan</th>
						  		<th width="10%">Bukti Transaksi</th>
						  		<th>Ref</th>
						  		<!-- <th>Kode Akun</th> -->
						  		<th>Debit</th>
						  		<th>Kredit</th>
						  		<th>Saldo</th>
						  		<?php if ($user['role_id'] == 2): ?>
						  		<th width="10%">Aksi</th>	
						  		<?php endif ?>
						  		
						  	</tr>
					  	</thead>
					  	<tbody>
		<?php if ($this->input->post('tanggal_awal') ): ?>

			<?php
				// $this->db->where('year(tanggal_transaksi)',$tahun); 
				
				$this->db->where('tanggal_transaksi >=',$date_awal);
				$this->db->where('tanggal_transaksi <=',$date_akhir);
				$data12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array();			
				?>

				<?php //print_r($data12); ?>
				<?php 
				$count_data12 = count($data12) ?>
				<?php // echo $count_data12 ?> 

			<!-- MENCARI SESUAI TANGGAL START -->

			<?php if ($t_aw != date($tahun."-"."01"."-"."01")) : ?>
					  
					  <?php //echo 'cek' ?>
							<?php foreach ($data_sa as $sa): ?>
				 			<?php //print_r($sa); ?> 
						  				<?php 
						  			
						  				$debit_sa = $sa['debit'];
						  				$kredit_sa = $sa['kredit'];
						  				$saldo_sa  = [$d['akun'] => $kredit_sa - $debit_sa];
						  				
						  				?>
						  			
						  			<?php $saldo_akhirawal = $saldo_sa[$d['akun']]; ?>
						  	<?php endforeach ?>	


						<?php if (count($data12) == 0): ?>
							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>
					  	<?php else : ?>
					  		<?php 
							
							$this->db->where('tanggal_transaksi >=',$date_awal);
							$this->db->where('tanggal_transaksi <=',$date_akhir);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							
							?>
						
						  	<?php $index=0; ?>

					  		<?php foreach ($data_12 as $ju) : ?>
					  		
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $kredit_bb - $debit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $kredit_bb-$debit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $kredit_bb-$debit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  	
					  <?php endif ?>
					  		<?php $saldo_akhir_semua[$d['akun']] = $saldo_akhir; ?>
					  		<?php //print_r($saldo_akhir_semua); ?>

			<!-- START TABEL TANGGAL BULAN TAHUN -->
			<!-- BATAS HITUNGAN SALDO AKHIR -->

					  	<tr>		
					  				<?php 

					  				$tanggal_tabel = date("Y-m-d", strtotime("$tgl_awal_data last day of -1 month")); ?>
						  			<td><?= $date_akhir; ?></td>						 	
						  			<td>Saldo Awal</td>
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  			<td></td>

						  				<?php 
						  			
						  				$saldo_sa = [$d['akun'] => $saldo_akhir_semua[$d['akun']]];
						  				
						  				 ?>
						  			<td><?= rupiah($saldo_akhir_semua[$d['akun']]); ?></td>
						</tr>

									<?php $saldo_akhirawal = $saldo_sa[$d['akun']]; ?>

						<?php if ($count_data12 == 0): ?>
							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>

							<?php //echo "iya"; ?>

									<?php 
							
							$this->db->where('tanggal_transaksi >=',$tgl_awal_data);
							$this->db->where('tanggal_transaksi <=',$tgl_akhir_data);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>
						
						  	<?php $index=0; ?>
						  	<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
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
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $kredit_bb - $debit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $kredit_bb-$debit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $kredit_bb-$debit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">

						  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>

					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  		
					  		<!-- atas untuk mencari data per tanggal pada bulan januari karena nanti saldo akhirnya ora terdefinisi -->

					  	<?php else : ?>

					  	<?php 
							
							$this->db->where('tanggal_transaksi >=',$tgl_awal_data);
							$this->db->where('tanggal_transaksi <=',$tgl_akhir_data);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>
						
						  	<?php $index=0; ?>
						  	<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
					  				<?php if ($ju['debit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['debit']) ?></td>
								  	<?php endif ?>
							  		
							  		<?php if ($ju['kredit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['kredit']); ?></td>
								  	<?php endif ?>
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $kredit_bb - $debit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $kredit_bb-$debit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $kredit_bb-$debit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  		
					  	<?php endif; ?>

					  	<tr>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td>Saldo Akhir</td>
						  			<td><?= rupiah($saldo_akhir) ?></td>
					  	</tr>


			<!-- ELSE E OJO LALI !! -->
			<!-- AKHIR TANGGAL 1 1 1-->
			<?php else: ?>
					  		<?php foreach ($data_sa as $sa): ?>

					  			<tr>
						  			<td><?= $sa['tanggal_transaksi']?></td>						  		
						  			<td><?= $sa['keterangan'] ?></td>
						  			<!-- <td><?= $sa['bukti_transaksi'] ?></td> -->
						  		<!-- 	<td><?= $sa['akun'] ?></td> -->
						  			<!-- <td><?= $sa['kode_akun'] ?></td> -->
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  		<!-- 	<?php if ($sa['debit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td>Rp. <?= $sa['debit'] ?></td>
								  	<?php endif ?>
							  		
							  		<?php if ($sa['kredit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td>Rp. <?= $sa['kredit'] ?></td>
								  	<?php endif ?> -->

						  				<?php 
						  			
						  				$debit_sa = $sa['debit'];
						  				$kredit_sa = $sa['kredit'];
						  				$saldo_sa  = [$d['akun'] => $kredit_sa-$debit_sa];
						  				
						  				 ?>
						  			<td><?= rupiah($saldo_sa[$d['akun']]); ?></td>
						  		</tr>
						  			<?php $saldo_akhirawal = $saldo_sa[$d['akun']]; ?>
						  	<?php endforeach ?>	

					

						<?php if ($count_data12 == 0): ?>

							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>

					  	<?php else : ?>

					 		
							<?php 
							
							$this->db->where('tanggal_transaksi >=',$t_aw);
							$this->db->where('tanggal_transaksi <=',$t_ak);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>
						
						  	<?php $index=0; ?>

					  		<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
					  			<?php if ($ju['debit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['debit']) ?></td>
								  	<?php endif ?>
							  		
							  		<?php if ($ju['kredit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['kredit']); ?></td>
								  	<?php endif ?>
					  					<?php

					  					
					  						$debit_bb = $ju['debit'];
						  					$kredit_bb = $ju['kredit'];


						  					if (empty($saldo_bb[$index-1])) {
							  					if (!empty($saldo_sa[$ju['akun']])) {

							  						$saldo_bb[$index] = $kredit_bb - $debit_bb+$saldo_sa[$ju['akun']];
							  					
							  					} else
							  					{
							  						$saldo_bb[$index] = $kredit_bb-$debit_bb;
							  							
							  					}
							  				$saldo_akhir = $saldo_bb[$index];	
							  				} else {

							  				$saldo_bb[$index] = $kredit_bb-$debit_bb+$saldo_bb[$index-1];
							  				$saldo_akhir = $saldo_bb[$index];	

							  				}

						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  		
					  	<?php endif ?>

					 
					  			<tr>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td>Saldo Akhir</td>
						  			<td><?= rupiah($saldo_akhir); ?></td>
					  			</tr>
			
			<!-- AKHIR IF OJO LALI ! -->		  		
			<?php endif; ?>

		<!-- AKHIR MENCARI SESUAI TANGGAL -->


		<?php else: ?>	
			<?php
				// $this->db->where('year(tanggal_transaksi)',$tahun); 
				
				$this->db->where('tanggal_transaksi >=',$date_awal);
				$this->db->where('tanggal_transaksi <=',$date_akhir);
				$data12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array();			
				?>

				<?php //print_r($data12); ?>
				<?php 
				$count_data12 = count($data12) ?>
				<?php // echo $count_data12 ?> 


			<!-- START JIKA MENCARI BULAN -->
			<?php if ($bulan != 1 ) : ?>
					  	
							<?php foreach ($data_sa as $sa): ?>
					 <!--  			<?= print_r($sa); ?> -->
						  				<?php 
						  			
						  				$debit_sa = $sa['debit'];
						  				$kredit_sa = $sa['kredit'];
						  				$saldo_sa  = [$d['akun'] => $kredit_sa-$debit_sa];
						  				
						  				 ?>
						  			
						  			<?php $saldo_akhirawal = $saldo_sa[$sa['akun']]; ?>
						  	<?php endforeach ?>	

					

						<?php if ($count_data12 == 0): ?>
							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>


					  	<?php else : ?>
					 		
							<?php 
							
							$this->db->where('tanggal_transaksi >=',$date_awal);
							$this->db->where('tanggal_transaksi <=',$date_akhir);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>


						
						  	<?php $index=0; ?>

					  		<?php foreach ($data_12 as $ju) : ?>
					  		
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $kredit_bb - $debit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $kredit_bb-$debit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $kredit_bb-$debit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  	
					  <?php endif ?>
					  		<?php $saldo_akhir_semua[$d['akun']] = $saldo_akhir; ?>
					  		<?php //print_r($saldo_akhir_semua); ?>

			<!-- START TABEL MENURUT BULAN -->

					  	<tr>		
					  				<?php 

					  				$tanggal_tabel = date("Y-m-d", strtotime("$tgl_awal_data last day of -1 month")); ?>
						  			<td><?= $tanggal_tabel; ?></td>						 	
						  			<td>Saldo Awal</td>
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  			<td></td>

						  				<?php 
						  			
						  				$saldo_sa = [$d['akun'] => $saldo_akhir_semua[$d['akun']]];
						  				
						  				 ?>
						  			<td><?= rupiah($saldo_akhir_semua[$d['akun']]); ?></td>
						</tr>

									<?php $saldo_akhirawal = $saldo_sa[$d['akun']]; ?>

						<?php if ($count_data12 == 0): ?>
							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>

							<!-- Tambah -->

							<?php 
							
							$this->db->where('tanggal_transaksi >=',$tgl_awal_data);
							$this->db->where('tanggal_transaksi <=',$tgl_akhir_data);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>
						
						  	<?php $index=0; ?>
						  	<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
					  		<?php if ($ju['debit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['debit']) ?></td>
								  	<?php endif ?>
							  		
							  		<?php if ($ju['kredit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['kredit']) ?></td>
								  	<?php endif ?>
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $kredit_bb - $debit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $kredit_bb-$debit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $kredit_bb-$debit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  	<?php else : ?>



					  	<?php 
							
							$this->db->where('tanggal_transaksi >=',$tgl_awal_data);
							$this->db->where('tanggal_transaksi <=',$tgl_akhir_data);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>
						
						  	<?php $index=0; ?>
						  	<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
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
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $kredit_bb - $debit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $kredit_bb-$debit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $kredit_bb-$debit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  		
					  	<?php endif; ?>

					  	<tr>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td>Saldo Akhir</td>
						  			<td><?= rupiah($saldo_akhir); ?></td>
					  	</tr>


			<!-- ELSE E OJO LALI !! -->
			<!-- AKHIR -->
			<?php else: ?>
					  		<?php foreach ($data_sa as $sa): ?>
					  	<!-- 		<?= print_r($sa); ?> -->
					  			<tr>
						  			<td><?= $sa['tanggal_transaksi']?></td>						  		
						  			<td><?= $sa['keterangan'] ?></td>
						
								  	<td></td>
								  	<td></td>
								  	<td></td>
								  	<td></td>
						  				<?php 
						  			
						  				$debit_sa = $sa['debit'];
						  				$kredit_sa = $sa['kredit'];
						  				$saldo_sa  = [$d['akun'] => $kredit_sa-$debit_sa];
						  				
						  				 ?>
						  			<td><?= rupiah($saldo_sa[$sa['akun']]); ?></td>
						  		</tr>
						  			<?php $saldo_akhirawal = $saldo_sa[$sa['akun']]; ?>
						  	<?php endforeach ?>	

					

						<?php if ($count_data12 == 0): ?>

							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>

					  	<?php else : ?>

					 		
							<?php 

		
								$this->db->where('tanggal_transaksi >=',$tgl_awal_data);
								$this->db->where('tanggal_transaksi <=',$tgl_akhir_data);
								$this->db->order_by('tanggal_transaksi', 'ASC');
								$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array();

						
							
							 
							?>
						
						  	<?php $index=0; ?>

					  		<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
					  			<?php if ($ju['debit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['debit']) ?></td>
								  	<?php endif ?>
							  		
							  		<?php if ($ju['kredit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['kredit']) ?></td>
								  	<?php endif ?>
					  					<?php

					  					
					  						$debit_bb = $ju['debit'];
						  					$kredit_bb = $ju['kredit'];


						  					if (empty($saldo_bb[$index-1])) {
							  					if (!empty($saldo_sa[$ju['akun']])) {

							  						$saldo_bb[$index] = $kredit_bb - $debit_bb+$saldo_sa[$ju['akun']];
							  					
							  					} else
							  					{
							  						$saldo_bb[$index] = $kredit_bb-$debit_bb;
							  							
							  					}
							  				$saldo_akhir = $saldo_bb[$index];	
							  				} else {

							  				$saldo_bb[$index] = $kredit_bb-$debit_bb+$saldo_bb[$index-1];
							  				$saldo_akhir = $saldo_bb[$index];	

							  				}
					  					
					  		
						  			
						  				
						  				
						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  		
					  	<?php endif ?>

					 
					  			<tr>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td>Saldo Akhir</td>
						  			<td><?= rupiah($saldo_akhir) ?></td>
					  			</tr>
			
			<!-- AKHIR IF OJO LALI ! -->		  		
			<?php endif; ?>
			<!-- AKHIR JIKA MENCARI BULAN -->
		<?php endif; ?>		  		
					  		
					  	</tbody>
					  	
					  </table>
				</div>
			</div>
			
		</div>
	
	</div>

<?php else: ?>
	<!-- kosong kalau ga da saldo -->
<?php endif ?>
<!-- BATAS, JIKA SALDO NORMALNYA DEBIT -->
<?php else: ?>
	
	<?php 
	
		$this->db->where('year(tanggal_transaksi)',$tahun_sa);
		$data_sa = $this->db->get_where('saldo_awal',['akun' => $d['akun']])->result_array(); 
		
		$this->db->where('year(tanggal_transaksi)',$tahun_sa+1);
		$data_kd = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
	?>

<?php if (!empty($data_sa)  or !empty($data_kd)): ?>

<!-- AKHIR PROSES QUERY -->
	
<div class="mb-2 row justify-content-center">
	<div class="col">
	<div class="card p-2 mb-2 shadow-sm ">
		<div class="row">
			<div class="col-4 text-center">
			<h5><strong><?= $d['akun']; ?></h5></strong>
			</div>
			<div class="col-4 text-center">	
			
			<h5><strong><?= $d['kode_akun']; ?></h5></strong>

			</div>

			<div class="col-4 text-center">	
			
			<h5><strong>Debit</h5></strong>

			</div>
			
			
		</div>
		
		<div class="row">
			<div class="col">				
				<div class="table-responsive text-center table-bordered bg-white">
					  <table class="table justify-content-center align-self-center">
					  	<thead>
						  	<tr>
						  		<th>Tanggal</th>
						  		<th>Keterangan</th>
						  		<th width="10%">Bukti Transaksi</th>
						  		<th>Ref</th>
						  		<!-- <th>Kode Akun</th> -->
						  		<th>Debit</th>
						  		<th>Kredit</th>
						  		<th>Saldo</th>
						  		<?php if ($user['role_id'] == 2): ?>
						  		<th width="10%">Aksi</th>	
						  		<?php endif ?>
						  	</tr>
					  	</thead>
					  	<tbody>
		<?php if ($this->input->post('tanggal_awal') ): ?>

			<?php
				// $this->db->where('year(tanggal_transaksi)',$tahun); 
				
				$this->db->where('tanggal_transaksi >=',$date_awal);
				$this->db->where('tanggal_transaksi <=',$date_akhir);
				$data12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array();			
				?>

				<?php //print_r($data12); ?>
				<?php 
				$count_data12 = count($data12) ?>
				<?php // echo $count_data12 ?> 

			<!-- MENCARI SESUAI TANGGAL START -->

			<?php if ($t_aw != date($tahun."-"."01"."-"."01")) : ?>
					  
					  <?php //echo 'cek' ?>
							<?php foreach ($data_sa as $sa): ?>
				 			<?php //print_r($sa); ?> 
						  				<?php 
						  			
						  				$debit_sa = $sa['debit'];
						  				$kredit_sa = $sa['kredit'];
						  				$saldo_sa  = [$d['akun'] => $debit_sa-$kredit_sa];
						  				
						  				 ?>
						  			
						  			<?php $saldo_akhirawal = $saldo_sa[$d['akun']]; ?>
						  	<?php endforeach ?>	


						<?php if (count($data12) == 0): ?>
							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>
					  	<?php else : ?>
					  		<?php 
							
							$this->db->where('tanggal_transaksi >=',$date_awal);
							$this->db->where('tanggal_transaksi <=',$date_akhir);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							
							?>
						
						  	<?php $index=0; ?>

					  		<?php foreach ($data_12 as $ju) : ?>
					  		
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $debit_bb-$kredit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  	
					  <?php endif ?>
					  		<?php $saldo_akhir_semua[$d['akun']] = $saldo_akhir; ?>
					  		<?php //print_r($saldo_akhir_semua); ?>

			<!-- START TABEL TANGGAL BULAN TAHUN -->
			<!-- BATAS HITUNGAN SALDO AKHIR -->

					  	<tr>		
					  				<?php 

					  				$tanggal_tabel = date("Y-m-d", strtotime("$tgl_awal_data last day of -1 month")); ?>
						  			<td><?= $date_akhir; ?></td>						 	
						  			<td>Saldo Awal</td>
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  			<td></td>

						  				<?php 
						  			
						  				$saldo_sa = [$d['akun'] => $saldo_akhir_semua[$d['akun']]];
						  				
						  				 ?>
						  			<td><?= rupiah($saldo_akhir_semua[$d['akun']]); ?></td>
						</tr>

									<?php $saldo_akhirawal = $saldo_sa[$d['akun']]; ?>

						<?php if ($count_data12 == 0): ?>
							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>

							<?php //echo "iya"; ?>

									<?php 
							
							$this->db->where('tanggal_transaksi >=',$tgl_awal_data);
							$this->db->where('tanggal_transaksi <=',$tgl_akhir_data);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>
						
						  	<?php $index=0; ?>
						  	<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
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
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $debit_bb-$kredit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  		
					  		<!-- atas untuk mencari data per tanggal pada bulan januari karena nanti saldo akhirnya ora terdefinisi -->

					  	<?php else : ?>

					  	<?php 
							
							$this->db->where('tanggal_transaksi >=',$tgl_awal_data);
							$this->db->where('tanggal_transaksi <=',$tgl_akhir_data);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>
						
						  	<?php $index=0; ?>
						  	<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
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
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $debit_bb-$kredit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  		
					  	<?php endif; ?>

					  	<tr>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td>Saldo Akhir</td>
						  			<td><?= rupiah($saldo_akhir); ?></td>
					  	</tr>


			<!-- ELSE E OJO LALI !! -->
			<!-- AKHIR TANGGAL 1 1 1-->
			<?php else: ?>
					  		<?php foreach ($data_sa as $sa): ?>

					  			<tr>
						  			<td><?= $sa['tanggal_transaksi']?></td>						  		
						  			<td><?= $sa['keterangan'] ?></td>
						  			<!-- <td><?= $sa['bukti_transaksi'] ?></td> -->
						  		<!-- 	<td><?= $sa['akun'] ?></td> -->
						  			<!-- <td><?= $sa['kode_akun'] ?></td> -->
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  		<!-- 	<?php if ($sa['debit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td>Rp. <?= $sa['debit'] ?></td>
								  	<?php endif ?>
							  		
							  		<?php if ($sa['kredit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td>Rp. <?= $sa['kredit'] ?></td>
								  	<?php endif ?> -->

						  				<?php 
						  			
						  				$debit_sa = $sa['debit'];
						  				$kredit_sa = $sa['kredit'];
						  				$saldo_sa  = [$d['akun'] => $debit_sa-$kredit_sa];
						  				
						  				 ?>
						  			<td><?= rupiah($saldo_sa[$d['akun']]); ?></td>
						  		</tr>
						  			<?php $saldo_akhirawal = $saldo_sa[$d['akun']]; ?>
						  	<?php endforeach ?>	

					

						<?php if ($count_data12 == 0): ?>

							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>

					  	<?php else : ?>

					 		
							<?php 
							
							$this->db->where('tanggal_transaksi >=',$t_aw);
							$this->db->where('tanggal_transaksi <=',$t_ak);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>
						
						  	<?php $index=0; ?>

					  		<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
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
					  					<?php

					  					
					  						$debit_bb = $ju['debit'];
						  					$kredit_bb = $ju['kredit'];


						  					if (empty($saldo_bb[$index-1])) {
							  					if (!empty($saldo_sa[$ju['akun']])) {

							  						$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_sa[$ju['akun']];
							  					
							  					} else
							  					{
							  						$saldo_bb[$index] = $debit_bb-$kredit_bb;
							  							
							  					}
							  					$saldo_akhir = $saldo_bb[$index];	
							  					} else {

								  				$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_bb[$index-1];
								  				$saldo_akhir = $saldo_bb[$index];	

							  					}

						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  		
					  	<?php endif ?>

					 
					  			<tr>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td>Saldo Akhir</td>
						  			<td><?= rupiah($saldo_akhir) ?></td>
					  			</tr>
			
			<!-- AKHIR IF OJO LALI ! -->		  		
			<?php endif; ?>

		<!-- AKHIR MENCARI SESUAI TANGGAL -->


		<?php else: ?>	
			<?php
				// $this->db->where('year(tanggal_transaksi)',$tahun); 
				
				$this->db->where('tanggal_transaksi >=',$date_awal);
				$this->db->where('tanggal_transaksi <=',$date_akhir);
				$data12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array();			
				?>

				<?php //print_r($data12); ?>
				<?php 
				$count_data12 = count($data12) ?>
				<?php // echo $count_data12 ?> 


			<!-- START JIKA MENCARI BULAN -->
			<?php if ($bulan != 1 ) : ?>
					  	
							<?php foreach ($data_sa as $sa): ?>
					 <!--  			<?= print_r($sa); ?> -->
						  				<?php 
						  			
						  				$debit_sa = $sa['debit'];
						  				$kredit_sa = $sa['kredit'];
						  				$saldo_sa  = [$d['akun'] => $debit_sa-$kredit_sa];
						  				
						  				 ?>
						  			
						  			<?php $saldo_akhirawal = $saldo_sa[$sa['akun']]; ?>
						  	<?php endforeach ?>	

					

						<?php if ($count_data12 == 0): ?>
							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>


					  	<?php else : ?>
					 		
							<?php 
							
							$this->db->where('tanggal_transaksi >=',$date_awal);
							$this->db->where('tanggal_transaksi <=',$date_akhir);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>


						
						  	<?php $index=0; ?>

					  		<?php foreach ($data_12 as $ju) : ?>
					  		
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $debit_bb-$kredit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  	
					  <?php endif ?>
					  		<?php $saldo_akhir_semua[$d['akun']] = $saldo_akhir; ?>
					  		<?php //print_r($saldo_akhir_semua); ?>

			<!-- START TABEL MENURUT BULAN -->

					  	<tr>		
					  				<?php 

					  				$tanggal_tabel = date("Y-m-d", strtotime("$tgl_awal_data last day of -1 month")); ?>
						  			<td><?= $tanggal_tabel; ?></td>						 	
						  			<td>Saldo Awal</td>
						  			<td></td>
						  			<td></td>
						  			<td></td>
						  			<td></td>

						  				<?php 
						  			
						  				$saldo_sa = [$d['akun'] => $saldo_akhir_semua[$d['akun']]];
						  				
						  				 ?>
						  			<td><?= rupiah($saldo_akhir_semua[$d['akun']]); ?></td>
						</tr>

									<?php $saldo_akhirawal = $saldo_sa[$d['akun']]; ?>

						<?php if ($count_data12 == 0): ?>
							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>

							<!-- Tambah -->

							<?php 
							
							$this->db->where('tanggal_transaksi >=',$tgl_awal_data);
							$this->db->where('tanggal_transaksi <=',$tgl_akhir_data);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>
						
						  	<?php $index=0; ?>
						  	<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
					  		<?php if ($ju['debit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['debit']); ?></td>
								  	<?php endif ?>
							  		
							  		<?php if ($ju['kredit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['kredit']) ?></td>
								  	<?php endif ?>
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $debit_bb-$kredit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  	<?php else : ?>



					  	<?php 
							
							$this->db->where('tanggal_transaksi >=',$tgl_awal_data);
							$this->db->where('tanggal_transaksi <=',$tgl_akhir_data);
							$this->db->order_by('tanggal_transaksi', 'ASC');
							$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
							?>
						
						  	<?php $index=0; ?>
						  	<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
					  		<?php if ($ju['debit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['debit']) ?></td>
								  	<?php endif ?>
							  		
							  		<?php if ($ju['kredit'] == 0): ?>
								  		<td></td>
								  	<?php else: ?>
								  		<td><?= rupiah($ju['kredit']) ?></td>
								  	<?php endif ?>
					  					<?php 
						  				$debit_bb = $ju['debit'];
						  				$kredit_bb = $ju['kredit'];
						  				
						  				if (empty($saldo_bb[$index-1])) {
						  					if (!empty($saldo_sa[$ju['akun']])) {

						  						$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_sa[$ju['akun']];
						  					
						  					} else
						  					{
						  						$saldo_bb[$index] = $debit_bb-$kredit_bb;
						  							
						  					}
						  				$saldo_akhir = $saldo_bb[$index];	
						  				} else {

						  				$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_bb[$index-1];
						  				$saldo_akhir = $saldo_bb[$index];	

						  				}
						  				
						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  		
					  	<?php endif; ?>

					  	<tr>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td>Saldo Akhir</td>
						  			<td><?= rupiah($saldo_akhir); ?></td>
					  	</tr>


			<!-- ELSE E OJO LALI !! -->
			<!-- AKHIR -->
			<?php else: ?>
					  		<?php foreach ($data_sa as $sa): ?>
					  	<!-- 		<?= print_r($sa); ?> -->
					  			<tr>
						  			<td><?= $sa['tanggal_transaksi']?></td>						  		
						  			<td><?= $sa['keterangan'] ?></td>
						
								  	<td></td>
								  	<td></td>
								  	<td></td>
								  	<td></td>
						  				<?php 
						  			
						  				$debit_sa = $sa['debit'];
						  				$kredit_sa = $sa['kredit'];
						  				$saldo_sa  = [$d['akun'] => $debit_sa-$kredit_sa];
						  				
						  				 ?>
						  			<td><?= rupiah($saldo_sa[$sa['akun']]); ?></td>
						  		</tr>
						  			<?php $saldo_akhirawal = $saldo_sa[$sa['akun']]; ?>
						  	<?php endforeach ?>	

					

						<?php if ($count_data12 == 0): ?>

							<?php if (count($data_sa) == 0): ?>
								<?php $saldo_akhir = 0; ?>
							<?php else: ?>
								<?php $saldo_akhir = $saldo_akhirawal;  ?>
							<?php endif ?>

					  	<?php else : ?>

					 		
							<?php 

		
								$this->db->where('tanggal_transaksi >=',$tgl_awal_data);
								$this->db->where('tanggal_transaksi <=',$tgl_akhir_data);
								$this->db->order_by('tanggal_transaksi', 'ASC');
								$data_12 = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array();

						
							
							 
							?>
						
						  	<?php $index=0; ?>

					  		<?php foreach ($data_12 as $ju) : ?>
					  		<tr>					  			
					  			<td><?= $ju['tanggal_transaksi']?></td>					  			
					  			<td><?= $ju['keterangan'] ?></td>
					  			<td><?= $ju['bukti_transaksi'] ?></td>
					  			<td><?= $ju['ref'] ?></td>	
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
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
					  					<?php

					  					
					  						$debit_bb = $ju['debit'];
						  					$kredit_bb = $ju['kredit'];


						  					if (empty($saldo_bb[$index-1])) {
							  					if (!empty($saldo_sa[$ju['akun']])) {

							  						$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_sa[$ju['akun']];
							  					
							  					} else
							  					{
							  						$saldo_bb[$index] = $debit_bb-$kredit_bb;
							  							
							  					}
							  					$saldo_akhir = $saldo_bb[$index];	
							  					} else {

								  				$saldo_bb[$index] = $debit_bb-$kredit_bb+$saldo_bb[$index-1];
								  				$saldo_akhir = $saldo_bb[$index];	

							  					}
					  					
					  		
						  			
						  				
						  				
						  				?>
						  					
					  			<td><?= rupiah($saldo_bb[$index]); ?></td>
					  			<?php if ($user['role_id'] == 2): ?>
					  			<td class="d-flex align-items-center">
					  				<?php if ($ju['keterangan'] != 'JP'): ?>
						  					<?php if (is_null($ju['id_sewa'])): ?>
							  					<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php else : ?>
						  						<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $ju['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
							  					<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $ju['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						  					<?php endif ?>
						  					
						  				
						  				<?php else: ?>
						  					<a href="<?= base_url(); ?>jp/update_jp/<?= $ju['bukti_transaksi']; ?>" class="mr-1 btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
						  					<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $ju['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>	
						  				<?php endif ?>
					  			</td>	
					  			<?php endif ?>
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>
					  		
					  	<?php endif ?>

					 
					  			<tr>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td style="border: 0;"></td>
						  			<td>Saldo Akhir</td>
						  			<td><?= rupiah($saldo_akhir) ?></td>
					  			</tr>
			
			<!-- AKHIR IF OJO LALI ! -->		  		
			<?php endif; ?>
			<!-- AKHIR JIKA MENCARI BULAN -->
		<?php endif; ?>		  		
					  		
					  	</tbody>
					  	
					  </table>
				</div>
			</div>
			
		</div>
	
	</div>
<?php else: ?>
	<!-- kosong kalau ga da datanya -->
<?php endif ?>
<?php endif ?>	
<?php endforeach; ?>
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

		$('#kode_akun').on('input',function(){
                
                var kode_akun=$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/admin/get_kodeakun')?>",
                    dataType : "JSON",
                    data : {kode_akun: kode_akun},
                    cache:false,
                    success: function(data){
                        $.each(data,function(kode_akun, akun, pos_laporan){
                    
                            $('[id="akun"]').val(data.akun);
                            $('[id="pos_laporan"]').val(data.pos_laporan);
                            
                        });
                        
                    }
                });
                return false;
           });

	});

</script>

