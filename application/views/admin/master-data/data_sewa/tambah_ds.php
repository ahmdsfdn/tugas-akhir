<!-- Begin Page Content -->

<div class="container-fluid">
<?php if ($this->session->flashdata('pesan_sukses')) : ?>
			<div class="row">
				<div class="col-8">
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<div class="col-6">
						  Data Sewa<strong> Berhasil</strong> <?= $this->session->flashdata('pesan_sukses'); ?>
							 
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
  <h1 class="h3 mb-4 text-gray-800 text-center">Input Data Sewa</h1>

	<!-- awal form transaksi -->

<form action="<?= base_url('data_sewa/tambah_ds') ?>" method="post" name="formtransaksi">

<div class="content" id="form-debit">	
	
	<div class="row"> 
		<div class="col-0 col-xl-3">
			
		</div>
		<div class="col-12 col-xl-6">
          	<div class="card">

          		<div class="card-header text-center bg-primary">
          			<h5 class="m-0 text-white">Form 1</h5>
          		</div>
              	<div class="card-body ">              			          			
		          	<div class="form-row justify-content-around" >
		          		<div class="form-group col-12 col-md-6">
		          			
		          			<h5>Kendaraan</h5>
		          			<select name="kendaraan" id="kendaraan" class="form-control" >
			          			<option value="" selected >-- Pilih Kendaraan --</option>
			          			<?php foreach ($dd_kendaraan as $dd) : ?>
			          				<option value="<?= $dd->nama."-".$dd->plat; ?>"><?= $dd->nama."-".$dd->plat ?></option>
			          			<?php endforeach; ?>
		          			</select> 
		
		          		</div>	
		          		<div class="col-12 col-md-6" >
		          			<div class="row">
		          				<div class="col">
		          					<h5>Status Bayar</h5>
		          				</div>
		          			</div>
		          				<div class="card p-1 bg-secondary text-white">
				          			<div class="row text-center">
				          			
					          				<div class="col">
							          			<div class="form-check form-check-inline">
													<input class="form-check-input"  type="radio" value="BL" id="enable_DP" name="status" > 
													<label class="form-check-label">DP</label>
												</div>
											</div>
											<div class="col">
												<div class="form-check form-check-inline">
													<input class="form-check-input" name="status"  type="radio" value="L" id="enable_tunai" > 
													<label class="form-check-label">Tunai</label>
												</div>
											</div>
									</div>
								</div>
						</div>   

		          			
		          	</div>
		          	<div class="form-row justify-content-around">
		          			
		          		<div class="form-group col-12 col-md-6">
		          			<h5>Bukti Transaksi</h5>
		          			<input type="text" class="form-control" name="bukti_ds" id="bukti_ds" value="<?= $bukti_transaksi ?>" onkeyup="auto_copy()" readonly >
		          			<small class="form-text text-danger"><?= form_error('bukti_transaksi'); ?></small>
		          		</div>
			
		          		<div class="form-group col-12 col-md-6">
		          			<h5>Nama Penyewa</h5>
		          			<input type="text" class="form-control" name="nama_penyewa" id="nama_penyewa" value="" onkeyup="auto_copy()" >
		          			<small class="form-text text-danger"><?= form_error('nama_penyewa'); ?></small>
		          		</div>	
		          		     		
		          	</div>

		          	<div class="form-row justify-content-around ">
		          		<div class="form-group col-12 col-md-6">
		          			<h5>Tanggal Sewa</h3>
						      <input type="date" class="form-control" name="tgl_sewa" id="tgl_sewa" value="" >
		          		</div>
		          		<div class="form-group col-12 col-md-6">
		          			<h5>Tanggal Kembali</h3>
						      <input type="date" class="form-control" name="tgl_kembali" id="tgl_kembali" value="" >
		          		</div>		        	          		
		          	</div>

		          	
		          	<div class="form-row justify-content-around ">
		          		<div class="form-group col-12 col-md-6">
		          			<h5>Biaya Sewa</h5>
		          			<input  type="text" class="form-control" name="biaya_sewa" id="biaya_sewa" value="" onkeyup="auto_copy()" >
		          			<small class="form-text text-danger"><?= form_error('debit[]'); ?></small>
		          		</div>
		        
		          		<div class="form-group col-12 col-md-6">
		          			<h5>Uang Muka</h5> 
		          			<input  type="text" class="form-control" name="uang_muka" id="uang_muka" value="" onkeyup="auto_copy()" disabled>
		          			<small class="form-text text-danger"><?= form_error('uang_muka'); ?></small>
		          		</div>
		 

		          			<!-- HIDDEN BAYAR -->
		          			<input hidden type="text" class="form-control" name="bayar" id="bayar" value="" disabled readonly="">
		          			<!-- HIDDEN ID SEWA -->
		          			<input hidden type="text" name="id_sewa" value="<?= $id_sewa; ?>">

		          		
		          	</div>
		        </div>  		
		       
		</div>
		<div class="col">
		
	
			<!-- Form Jika DP -->
		<fieldset id="form_kas" disabled hidden>
			
			<!-- Kas -->
			<input type="text" name="akun[]" id="akun_kas" value="Kas">
			<button type="button" hidden id="ubah_kas">ubah</button>
			<input type="text" name="keterangan[]" id="keterangan_kas" value="">
			<input type="text" name="tanggal_transaksi[]" id="tanggal_transaksi_kas" value="">
			<input type="text" name="pos_saldo[]" id="pos_saldo_kas" value="Debit">
			<input type="text" name="pos_laporan[]" id="pos_laporan_kas" value="">
			<input type="text" name="bukti_transaksi[]" id="bukti_transaksi_kas" value="">
			<input type="text" name="kode_akun[]" id="kode_akun_kas" value="">		
			<input type="text" name="debit[]" id="debit_kas_t" value="" disabled>
			<input type="text" name="debit[]" id="debit_kas_dp" value="" disabled>
			<input type="text" name="kredit[]" id="kredit_kas" value="0">
			<input type="text" name="pos_akun[]" id="pos_akun_kas" value=""> 

		</fieldset>	
		
		<fieldset id="form_piutang" disabled hidden>
			
			<!-- piutang jasa -->
			<input type="text" name="akun[]" id="akun_piutang" value="Piutang Jasa">
			<button type="button" hidden id="ubah_piutang">ubah</button>
			<input type="text" name="keterangan[]" id="keterangan_piutang" value="">
			<input type="text" name="tanggal_transaksi[]" id="tanggal_transaksi_piutang" value="">
			<input type="text" name="pos_saldo[]" id="pos_saldo_piutang" value="Debit">
			<input type="text" name="pos_laporan[]" id="pos_laporan_piutang" value="">
			<input type="text" name="bukti_transaksi[]" id="bukti_transaksi_piutang" value="">
			<input type="text" name="kode_akun[]" id="kode_akun_piutang" value="">		
			<input type="text" name="debit[]" id="debit_piutang" value="">
			<input type="text" name="kredit[]" id="kredit_piutang" value="0">
			<input type="text" name="pos_akun[]" id="pos_akun_piutang" value=""> 

		</fieldset>

		<fieldset id="form_pj" disabled hidden>
			
			<!-- Pendapatan Jasa -->
			<input type="text" name="akun[]" id="akun_pj" value="Pendapatan Jasa">
			<button type="button" hidden id="ubah_pj">ubah</button>
			<input type="text" name="keterangan[]" id="keterangan_pj" value="">
			<input type="text" name="tanggal_transaksi[]" id="tanggal_transaksi_pj" value="">
			<input type="text" name="pos_saldo[]" id="pos_saldo_pj" value="Kredit">
			<input type="text" name="pos_laporan[]" id="pos_laporan_pj" value="">
			<input type="text" name="bukti_transaksi[]" id="bukti_transaksi_pj" value="">
			<input type="text" name="kode_akun[]" id="kode_akun_pj" value="">		
			<input type="text" name="debit[]" id="debit_pj" value="0">
			<input type="text" name="kredit[]" id="kredit_pj" value="">
			<input type="text" name="pos_akun[]" id="pos_akun_pj" value="">

		</fieldset>
			
			
	

		</div>
	</div>
	
</div>					
	</div>

	<div class="row mt-2 ">
		<!-- BUTTON INPUT -->
		<div class="col-12 text-center mb-2">
			
				<button type="submit" name="tambah" class="btn btn-success" id="ubah" style="width: 250px; height: 50px;"><h5 class="m-0" onclick="auto_copy(); "><strong>INPUT</strong></h5></button> 
				
		</div>
	</div>


</form>
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>

<script type="text/javascript">
	
	function auto_copy()
		{

			if (document.getElementById('ubah').clicked) {
					document.getElementById('tanggal_transaksi_piutang').value = document.getElementById('tgl_sewa').value;
					document.getElementById('tanggal_transaksi_kas').value = document.getElementById('tgl_sewa').value;
					document.getElementById('tanggal_transaksi_pj').value = document.getElementById('tgl_sewa').value;
			}


			
			document.getElementById('tanggal_transaksi_piutang').value = document.getElementById('tgl_sewa').value;
			document.getElementById('tanggal_transaksi_kas').value = document.getElementById('tgl_sewa').value;
			document.getElementById('tanggal_transaksi_pj').value = document.getElementById('tgl_sewa').value;
			document.getElementById('bukti_transaksi_piutang').value = document.getElementById('bukti_ds').value;
			document.getElementById('bukti_transaksi_kas').value = document.getElementById('bukti_ds').value;
			document.getElementById('bukti_transaksi_pj').value = document.getElementById('bukti_ds').value;
			document.getElementById('keterangan_pj').value = document.getElementById('nama_penyewa').value;
			document.getElementById('keterangan_kas').value = document.getElementById('nama_penyewa').value;
			document.getElementById('keterangan_piutang').value = document.getElementById('nama_penyewa').value;

			document.getElementById('kredit_pj').value = document.getElementById('biaya_sewa').value;
			document.getElementById('debit_kas_t').value = document.getElementById('biaya_sewa').value;
			document.getElementById('debit_kas_dp').value = document.getElementById('uang_muka').value;
			document.getElementById('bayar').value = document.getElementById('biaya_sewa').value;

		
			
		}

	$(document).ready(function(){

			setTimeout(function(){$('#ubah_piutang').click()},100);
			

			$("#ubah_piutang").click(function(){
                
                var akun=$("#akun_piutang").val();
             
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/data_sewa/get_kodeakun')?>",
                    dataType : "JSON",
                    data : {akun: akun},
                    cache:false,
                    success: function(data){
                        $.each(data,function(akun, kode_akun, pos_laporan, pos_akun){
                    
                            $('[id="kode_akun_piutang"]').val(data.kode_akun);
                            $('[id="pos_laporan_piutang"]').val(data.pos_laporan);
                            $('[id="pos_akun_piutang"]').val(data.pos_akun);
                            
                        });
                        
                    }
                });
                return false;
           });


			setTimeout(function(){$('#ubah_kas').click()},100);

			$("#ubah_kas").click(function(){
                
                var akun=$("#akun_kas").val();
             
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/data_sewa/get_kodeakun')?>",
                    dataType : "JSON",
                    data : {akun: akun},
                    cache:false,
                    success: function(data){
                        $.each(data,function(akun, kode_akun, pos_laporan, pos_akun){
                    
                            $('[id="kode_akun_kas"]').val(data.kode_akun);
                            $('[id="pos_laporan_kas"]').val(data.pos_laporan);
                            $('[id="pos_akun_kas"]').val(data.pos_akun);
                            
                        });
                        
                    }
                });
                return false;
           });

			setTimeout(function(){$('#ubah_pj').click()},100);

			$("#ubah_pj").click(function(){
                
                var akun=$("#akun_pj").val();
             
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/data_sewa/get_kodeakun')?>",
                    dataType : "JSON",
                    data : {akun: akun},
                    cache:false,
                    success: function(data){
                        $.each(data,function(akun, kode_akun, pos_laporan, pos_akun){
                    
                            $('[id="kode_akun_pj"]').val(data.kode_akun);
                            $('[id="pos_laporan_pj"]').val(data.pos_laporan);
                            $('[id="pos_akun_pj"]').val(data.pos_akun);
                            
                        });
                        
                    }
                });
                return false;
           });
	
		// enable disable dp dan tunai


			$("#enable_DP").click(function(){
						$('#uang_muka').removeAttr('disabled');
						$('#debit_kas_dp').removeAttr('disabled');

						$('#form_piutang').removeAttr('disabled');
						$('#form_pj').removeAttr('disabled');
						$('#form_kas').removeAttr('disabled');

						$('#bayar').attr('disabled', 'disabled');
						$('#debit_kas_t').attr('disabled', 'disabled');
						
						
						
			});

			$("#enable_tunai").click(function(){
						$('#bayar').removeAttr('disabled');
						$('#debit_kas_t').removeAttr('disabled');

						$('#form_pj').removeAttr('disabled');
						$('#form_kas').removeAttr('disabled');	

						$('#uang_muka').attr('disabled', 'disabled');
						$('#form_piutang ').attr('disabled', 'disabled');
						$('#debit_kas_dp').attr('disabled', 'disabled');
						

			});

		// memberikan value kepada transaksi dengan mengambil data akun

			$("#myBtn").click(function(){
				var elmId = $(".test").val();
				alert(elmId);
			});

	
	});
</script>
