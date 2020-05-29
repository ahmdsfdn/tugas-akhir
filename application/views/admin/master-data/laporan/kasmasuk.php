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

<div class="card p-2 mb-4 shadow-sm">
	<div class="mb-2 row ">
		<div class="col">
			
				<div class="row">
					<div class="col text-center">
						<h3 class="font-weight-bold">Kas Masuk</h3>
					</div>
				</div>
				<div class="row">
					<div class="col text-center">
						<?php if ($this->input->post('tanggal_awal')): ?>
							<h5><?= $t_aw?> s.d. <?= $t_ak ?></h5>
						<?php elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) :?>
						<h5><?= $nama_bulan?> <?= $tahun_post ?></h5>
						<?php elseif ($this->input->post('tahun_post')): ?>
							<h5>Tahun <?= $tahun_post ?></h5>
						<?php else: ?>
							<h5><?= $nama_bulan?> <?= $tahun ?></h5>
						<?php endif ?>
					</div>				
				</div>
			
		</div>
	</div>
	<hr class="m-0 mb-2">
	<div class="row mb-2">
		<div class="col">
	          	<div class="row mb-2">
	          		<?php if ($user['role_id'] == 2): ?>
          			<div class="col-12 col-md-6 col-xl-2 mb-md-0 mb-2">
	          			<a role="button" href="<?= base_url();?>admin/transaksi_m" class="btn btn-success" style="height: 100%; width: 100%;">Tambah Data</a>
	          		
	          		</div>
	          		<?php endif ?>
	          		
	          		<div class="col-6 col-sm-6 col-md-3 col-xl-1">
	          			<form method="post" action="<?= base_url();?>master/cetakkasmasuk">
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
								<?php else: ?>
									<input type="text" name="bulan_post" hidden disabled>
									<input type="text" name="tahun_post" hidden disabled>
									<input type="text" name="tanggal_awal" hidden disabled>
									<input type="text" name="tanggal_akhir" hidden disabled>
								<?php endif ?>
	          			<button type="submit" class="btn btn-secondary" style="height: 100%;">Cetak</button>

	          			</form>
	          		</div>
	          		<div class="col-6 col-sm-6 col-md-3 col-xl-1">
			        	<a class="btn btn-success" href="<?= base_url();?>master/kas_masuk">Reset</a>
					</div>
	          		
	          	</div>
     
			<div class="row align-items-center">

			        	<div class="col mb-2 mb-xl-0">			
			    			<form action="" method="post" class="form-row align-items-center text-center">
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
								
		          			
			          				<div class="form-check mb-4" style="width: 28px;"> 
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

				
						<div class="col-12 col-xl-6">
								
			    			<form action="" method="post" class="form-row align-items-center text-center ">
								<div class="col-12 col-sm-12 col-md-5 mb-2 mb-sm-2 mb-md-0">
									<div class="form ">
										<?php if ($this->input->post('tanggal_awal')): ?>
											<input type="date" class="form-control" name="tanggal_awal" value="<?=  $t_aw ?>" >
											
										<?php else: ?>
											<input type="date" class="form-control" name="tanggal_awal" >
										<?php endif ?>
									</div>									    			
								</div>
								<div class="d-none d-md-block" style="width: 28px;">s/d</div>			  	
								<div class="col-12 col-sm-12 col-md-5 mb-2 mb-sm-2 mb-md-0">
									<div class="form ">
										<?php if ($this->input->post('tanggal_awal')): ?>
											<input type="date" class="form-control" name="tanggal_akhir" value="<?= $t_ak?>" >
										<?php else: ?>
											<input type="date" class="form-control" name="tanggal_akhir">
										<?php endif ?>
										 		    	
									</div>
								</div>
										<?php if ($this->input->post('kode_akun')) : ?>
											<input type="text" name="kode_akun" id="kode_akun" value="<?= $this->input->post('kode_akun');?>" hidden>
											<input type="text" name="akun" id="akun" value="<?= $this->input->post('akun');?>" hidden>
										<?php else: ?>
											<input type="text" name="kode_akun" value="<?= $this->input->post('kode_akun'); ?>"  hidden disabled>
											<input type="text" name="akun" value="<?= $this->input->post('akun') ?> " hidden disabled>
										<?php endif; ?>

								<div class="col-1 mr-1">
									<div class="form">
										<button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
									</div>
								</div>

												  
							</form>
						</div>
	          	</div>
	         	<div class="row">
	          		<div class="col offset-3">
	          			<?= form_error ('tahun_post','<small class="text-danger pl-3">','</small>'); ?> 
	          		</div>
	          	</div>					  			 
		
	    </div>
	</div>
</div>
<!-- START PROSES QUERY -->
<div class="row justify-content-center">
	<div class="col">
	<div class="card p-2 shadow-sm">
		<div class="row">
			<div class="col">
				<div class="table-responsive text-center ">
					  <table id="dataTable" class="table table-bordered justify-content-center align-self-center">
					  	<thead>
						  	<th>No</th>
						  	<th>Tanggal Transaksi</th>
						  	<th>Bukti Transaksi</th>
						  	<th>Keterangan</th>
						  	<th>Nominal</th>
						  	<?php if ($user['role_id'] == 2): ?>
						  		<th>Aksi</th>
						  	<?php endif; ?>
					  	</thead>
					  	<tbody>
					  		<?php $index = 1; ?>
					  		<?php foreach ($kas_masuk as $km): ?>
					  			<?php if (empty($km['debit'])): ?>
										
					  				
					  			<?php else: ?>
					  				<?php if ($km['debit'] > 0): ?>
						  				<tr>
							  				<td><?= $index; ?></td>
							  				<td><?= $km['tanggal_transaksi'] ?>
								  			<td><?= $km['bukti_transaksi'] ?></td>
											<td><?= $km['keterangan'] ?></td>
											<td><?= rupiah($km['debit']) ?></td>
										<?php if ($user['role_id'] == 2): ?>
											<?php if (is_null($km['id_sewa'])): ?>

										  		<td class="align-items-center">
								  				<a href="<?= base_url(); ?>admin/ubahTransaksi/<?= $km['bukti_transaksi']; ?>" class="btn btn-sm mr-1 btn-success mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
								  				<a href="<?= base_url(); ?>admin/hapusTransaksi/<?= $km['bukti_transaksi'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								  				</td>

										  	<?php else: ?>


										  		<td class="align-items-center">
								  				<a href="<?= base_url(); ?>data_sewa/update_ju/<?= $km['id_sewa']; ?>" class="btn btn-sm mr-1 btn-primary mb-1 mb-xl-0"><i class="fa fa-pen"></i></a>
								  				<a href="<?= base_url(); ?>data_sewa/hapusdata_ju/<?= $km['id_sewa'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								  				</td>				  		

										  	<?php endif ?>
									<?php endif ?>
											<?php $debit[] = $km['debit']; ?>							
						  				</tr>
						  				<?php $index++ ?>
						  			<?php endif ?>	
					  			<?php endif ?>
						  						  		
					  		<?php endforeach ?>
					  				
					  	</tbody>
					  	<tr>
			  				<td></td>
			  				<td></td>
			  				<td></td>
			  				<td>Total</td>
			  				<?php if (!empty($debit)) : ?>
			  					<td><?= rupiah(array_sum($debit)); ?></td>
			  				<?php else : ?>
			  					<td><?= rupiah(0); ?></td>
			  				<?php endif; ?>
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

