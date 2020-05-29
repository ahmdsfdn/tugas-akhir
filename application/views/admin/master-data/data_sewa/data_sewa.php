<?php $ket_status = ['L' => 'Lunas', 'BL' => 'Belum Lunas']; ?>

<div class="container-fluid">
	<div class="row card mb-4 shadow">
		<div class="col">
				<div class="row">
					<div class="col my-2 text-center">
						<h2 class="font-weight-bold">Data Sewa</h2>
						<?php if ($this->input->post('tanggal_awal')): ?>
							<h5><?= $this->input->post('tanggal_awal') ?> s.d. <?= $this->input->post('tanggal_akhir') ?> </h5>
							<?php elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) : ?>
								<h5><?= date("F", strtotime(date("Y-".$this->input->post('bulan_post')."-01"))) ?> <?= $this->input->post('tahun_post') ?></h5>
							<?php elseif ($this->input->post('tahun_post')) : ?>
								<h5>Tahun <?= $this->input->post('tahun_post') ?></h5>
							<?php elseif ($this->input->post('katakunci')) : ?>
							
								<p><i class="fa fa-search"></i> : <?= $this->input->post('katakunci') ?></p>
							<?php else: ?>
								<h5><?= date("F", strtotime(date("Y-m-01"))) ?> <?= date('Y') ?></h5>
							<?php endif ?>
					</div>
				</div>
				<hr class="m-0">
				
						<div class="row py-2">
							<?php if ($user['role_id'] == 2): ?>

							
							<div class="col-12 col-sm-12 col-md-6 col-xl-4 mb-2 mb-md-2 mb-xl-0">
								<a class="btn btn-success" style="width: 100%;" href="<?= base_url('data_sewa/tambah_ds') ?>">Tambah Data Sewa</a>
							</div>
							<?php endif ?>
							
							<div class="col-6 col-sm-6 col-md-3 col-xl-1 mb-2 mb-md-2 mb-xl-0">
								<a class="btn btn-dark" href="<?= base_url('data_sewa/cetak_ds') ?>">Cetak</a>
							</div>
							<div class="col col-sm-6 col-md-3 col-xl-1 mb-2 mb-md-2 mb-xl-0">
								<a class="btn btn-success" href="<?= base_url('data_sewa')?>">Reset</a>
							</div>
							<?php if ($user['role_id'] == 2): ?>
								<div class="col-12 col-md-12 col-xl-4 offset-xl-2">
							<?php else: ?>
								<div class="col-12 col-md-12 col-xl-4 offset-xl-4">
							<?php endif; ?>
							
								<form action="" method="post">
									<div class="input-group">
									   <input type="text" class="form-control" placeholder="Cari data jurnal" name="katakunci" value="">
									  
									  <div class="input-group-append">
									    <button class="btn btn-dark" type="submit">Cari
									  </div>
									</div>
								</form>
							</div>
						</div>
					
				
		    			<div class="row mb-2">
			    			<div class="col-12 col-xl-6">
			    				<form method="post" class="form-row align-items-center">
									<div class="col-12 col-sm-12 mb-2 mb-sm-2 col-md-5">
											<div class="form">
											    <input type="date" class="form-control" name="tanggal_awal" value="<?= $this->input->post('tanggal_awal') ?>">
											</div>
									</div>
									<div class="d-none d-md-block mb-2" style="width: 28px;">s/d</div>	
									<div class="col-12 col-sm-12 mb-2 mb-sm-2 col-md-5">
										  	<div class="form">
										    	<input type="date" class="form-control" name="tanggal_akhir" value="<?= $this->input->post('tanggal_akhir') ?>">
										  	</div>
									</div>
									<div class="col col-md-1 mb-2 mb-sm-2 mr-xl-2">
										 	<div class="form ">
										  		<button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
										  	</div>
									</div>
									  
								</form> 
			    			</div>
						
							<div class="col-12 col-xl-6">
								<form action="" method="post" class="form-row align-items-center">
										<div class="col-10 col-sm-11 mb-2 mb-sm-2 mb-md-0 col-md-5">
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
										
			          				
					          				<div class="form-check mb-4 text-center" style="width: 28px;">
											  <input class="form-check-input" type="checkbox" value="" id="enable_bulan">
											</div>
									
										
				          			
												  	
										<div class="col-12 col-sm-12 col-md-5 mb-2 mb-sm-2 mb-md-0">
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
										 
										<div class="col-1">
											<div class="form ">
												<button type="submit" class="btn btn-primary "><i class="fa fa-search"></i></button>
											</div>
										</div>				  
								</form>
							</div>
						
						</div>	
				
			
		</div>
	</div>
		
 <!-- Data Inputan Range Tanggal Bulan Tahun -->
 	<?php 
 		$bulan_post = $this->input->post('bulan_post');
 		$tahun_post = $this->input->post('tahun_post');
 		$bulan = date('m');
 		$tahun = date('Y');

 		$tanggal_awal = $this->input->post('tanggal_awal');
 		$tanggal_akhir = $this->input->post('tanggal_akhir');

 	 ?>
 <!-- end Data Inputan Range Tanggal Bulan Tahun -->
<div class="row mb-4">
	<div class="col-12 mb-2 mb-md-0 col-md-6 col-xl-3">
		<a style="width: 100%;" href="<?= base_url() ?>data_sewa/data_kembali" class="btn btn-secondary shadow">Kendaraan Kembali</a>
	</div>
	<?php if ($user['role_id'] == 2): ?>
	<div class="col-12 col-md-6 col-xl-3">
		<a style="width: 100%;" href="<?= base_url() ?>data_sewa/tambah_mobil" class="btn btn-secondary shadow">Data Kendaraan</a>
	</div>
	<?php endif ?>
	
</div>
<div class="row justify-content-center">
	<div class="col">
		
		<?php foreach ($status as $st) : ?>
		
		<?php if ($this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
			<?php 
			$this->db->where('month(tgl_sewa)',$bulan_post);
			$this->db->where('year(tgl_sewa)',$tahun_post);
			$status_sewa = $this->db->get_where('data_sewa', ['status' => $st])->result_array(); ?>
		<?php elseif ($this->input->post('tahun_post')) : ?>
			<?php 
			$this->db->where('year(tgl_sewa)',$tahun_post);
			$status_sewa = $this->db->get_where('data_sewa', ['status' => $st])->result_array(); 
			?>
		<?php elseif ($this->input->post('tanggal_awal')) : ?>
			<?php 
			$this->db->where('tgl_sewa >=',$tanggal_awal);
			$this->db->where('tgl_sewa <=',$tanggal_akhir);
			$status_sewa = $this->db->get_where('data_sewa', ['status' => $st])->result_array();
		 	?>
		<?php elseif($this->input->post('katakunci')) : ?>
			<?php 
			$this->db->like('nama_penyewa',$this->input->post('katakunci'));
			$this->db->or_like('kendaraan',$this->input->post('katakunci'));
			$status_sewa = $this->db->get_where('data_sewa', ['status' => $st])->result_array(); ?>
		<?php else: ?>
			<?php 
			$this->db->where('month(tgl_sewa)', $bulan);
			$this->db->where('year(tgl_sewa)', $tahun);
			$status_sewa = $this->db->get_where('data_sewa', ['status' => $st])->result_array(); ?>
		<?php endif ?>
		
			<div class="card row mb-4 shadow pb-2">
				<div class="card-header text-center mb-2 text-dark">
						<h5 class="font-weight-bold"><?= $ket_status[$st]; ?></h5>
					</div>
				<div class="col">
					
					<div class="table-responsive text-center">
						  <table class="table table-bordered align-self-center">
						  		
						   	<thead>					   		
						   		<tr>
						   			<th>Kendaraan</th>
						   			<th>Nama Penyewa</th>
						   			<th>Tanggal Sewa</th>
						   			<th>Tanggal Kembali</th>
						   			<th >Biaya Sewa</th>
						   			<th>Uang Muka</th>

						   			<?php if ($st == 'BL'): ?>
						   				<!-- TABEL KOSONG -->
						   				
						   			<?php else : ?>
						   				<th >Bayar</th>
							   			<th>Tanggal Lunas</th>
						   			<?php endif; ?>

						   			<?php if ($user['role_id'] == 2): ?>
						   				<th width="10%">Aksi</th>
						   			<?php endif ?>
						   				

						   		
						   		</tr>
						   	</thead>

						   	<tbody>
						   		<?php foreach ($status_sewa as $ss) : ?>
						   			<tr>
						   				<td><?= $ss['kendaraan']; ?></td>
						   				<td><?= $ss['nama_penyewa']; ?></td>
						   				<td><?= $ss['tgl_sewa']; ?></td>
						   				<td><?= $ss['tgl_kembali']; ?></td>
						   				<td><?= rupiah($ss['biaya_sewa']); ?></td>
						   				<td><?= rupiah($ss['uang_muka']); ?></td>

						   			<?php if ($user['role_id'] == 2): ?>
						   				
						   			
						   				<?php if ($st == 'BL'): ?>
							   			<!-- TABEL KOSONG -->

							   			<td class="d-flex justify-content-around"><a href="<?= base_url(); ?>data_sewa/updatelunas/<?= $ss['id_sewa']; ?>" class="btn btn-sm btn-primary mb-1 mb-xl-0 mr-1"><i class="fa fa-check"></i></a><a  href="<?= base_url(); ?>data_sewa/update_ds/<?= $ss['id_sewa']; ?>" class="btn btn-sm btn-success  mr-1"><i class="fa fa-pen"></i></a><a href="<?= base_url(); ?>data_sewa/hapusdata/<?= $ss['id_sewa']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
							   			<?php else : ?>
									   		<td><?= rupiah($ss['bayar']); ?></td>
							   				<td><?= $ss['tgl_lunas']; ?></td>
							   				<td><a href="<?= base_url(); ?>data_sewa/update_ds/<?= $ss['id_sewa']; ?>" class="btn btn-sm btn-success mr-1 mb-1 mb-xl-0"><i class="fa fa-pen"></i></a><a href="<?= base_url(); ?>data_sewa/hapusdata/<?= $ss['id_sewa']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
							   			<?php endif; ?>
							   		<?php else: ?>
							   			<td><?= rupiah($ss['bayar']); ?></td>
						   				<td><?= $ss['tgl_lunas']; ?></td>
							   		<?php endif ?>
						   				
						   			</tr>
						   		<?php endforeach; ?>
						   	</tbody>
						  </table>
					</div>
				</div>

			</div>
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
	});
</script>


