<!-- Begin Page Content -->
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
          <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Input Penyesuaian</h1>

<form action="<?= base_url('jp/tambah_jp') ?>" method="post" name="formtransaksi">

<div class="content" id="form-debit">
  	
    <div class="row">
    	<div class="col">
     
			  <div class="card mb-2">
			  	<div class="form-row p-2">
				    <div class="col-12 col-sm-12 col-md-3">
				    		<label>Bukti Transaksi</label>
				      <input type="text" class="form-control" id="bukti_copy" name="bukti_copy"  value="<?= $bukti_transaksi; ?>"  readonly>
				      		<small class="form-text text-danger"><?= form_error('bukti_transaksi[]'); ?></small>
				    </div>
				    <div class="col-12 col-sm-12 col-md-3">
				    		<label>Bulan</label>
				      <select class="form-control" name="bulan">
				      	<option selected="">-- Pilih Bulan --</option>
					      	<?php foreach ($dd_bulan as $ddb): ?>
					      		<?php if ($ddb['angka'] == date('m')): ?>
					      			<option selected value="<?= $ddb['angka']; ?>"><?= $ddb['bulan']; ?></option>
					      		<?php else: ?>
					      			<option value="<?= $ddb['angka']; ?>"><?= $ddb['bulan']; ?></option>
					      		<?php endif ?>
					      		
					      	<?php endforeach ?>
				      	
				      </select>
				    </div>
				     <div class="col-12 col-sm-12 col-md-3">
				    		<label>Tahun</label>
				      <select class="form-control" name="tahun">
				      	<option selected value="<?= date('Y') ?>"><?= date('Y') ?></option>
				      		<?php 	$tahundd = date('Y')-1;
				      				$index = 6;
				      		 ?>
				      		<?php for ($i=0; $i < $index ; $i++) : ?>
				      			
				      			<option value="<?= $tahundd - $i?>"><?= $tahundd - $i?></option>

				      		<?php endfor; ?>
					      	
				      	
				      </select>
				    </div>
				     <div class="col-12 col-sm-12 col-md-3">
				     		<label>Keterangan</label>
				      <input type="text" class="form-control" id="keterangan_copy" 
				     name="keterangan_copy" value="">
				      		<small class="form-text text-danger"><?= form_error('keterangan[]'); ?></small>
				    </div>

				</div>
			  </div>
		
		</div>

	</div>
	<!-- awal form transaksi -->

	
	
	<div class="row"> 

		<div class="col-12 col-md-6">
          	<div class="card">

          		<div class="card-header text-center bg-primary">
          			<h5 class="m-0 text-white">Form 1</h5>
          		</div>
              	<div class="card-body">              			          			
		          	<div class="form-row justify-content-around">

		          		<div class="form-group col">
		          			
		          			<h5>Kode Akun</h5>
		          			<select name="kode_akun[]" id="kode_akun" class="form-control" >
			          			<option value="" selected >-- Pilih Kode Akun --</option>
			          			<?php foreach ($dd_kodeakun as $dd) : ?>
			          				<option value="<?= $dd->kode_akun; ?>"><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
			          			<?php endforeach; ?>
		          			</select> 
		
		          		</div>
		          		
		          			
		          			
		          			
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Akun</h5>
		          			<input type="text" class="form-control" name="akun[]" id="akun"  value="" readonly>
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		</div>
		          		
		          		
		          			
		          		
		          	</div>
		          		
		          		

		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Pos Laporan</h3>
						      <input type="text" class="form-control" name="pos_laporan[]" id="pos_laporan" value="" readonly>
		          		</div>
		          		<div class="form-group col">
		          			<h5>Pos Akun</h3>
						      <input type="text" class="form-control" name="pos_akun[]" id="pos_akun" value="" readonly>
		          		</div>		        	          		
		          	</div>

		          	<div class="form-row mt-2">
		         		<div class="form-group col">
		          			<h5>Pos Saldo</h5>
						      <select class="form-control" name="pos_saldo[]" id="pos_saldo" onchange="nonaktifDebitKredit()">
						        <option selected>Pilih...</option>
						        <option value="Debit">Debit</option>
						        <option value="Kredit">Kredit</option>
						      </select>
		          		</div>
		          	</div>	
		          	
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Debit</h5>
		          			<input  type="text" class="form-control" name="debit[]" id="debit" value="<?= set_value('debit[]'); ?>">
		          			<small class="form-text text-danger"><?= form_error('debit[]'); ?></small>
		          		</div>

		          		<div class="form-group col">
		          			<h5>Kredit</h5>
		          			<input  type="text" class="form-control" name="kredit[]" id="kredit" value="">
		          			<small class="form-text text-danger"><?= form_error('kredit[]'); ?></small>
		          		</div>
		          		
		          	</div>

		          	
		          	
		        </div>  		
		       
		    </div>
		</div>

		<div class="col-12 col-md-6 mt-2 mt-md-0">
          	<div class="card">

          		<div class="card-header text-center bg-primary">
          			<h5 class="m-0 text-white">Form 2</h5>
          		</div>
              	<div class="card-body">              			          			
		          	<div class="form-row justify-content-around">

		          		<div class="form-group col">
		    
		          			
		          			<h5>Kode Akun</h5>
		          			<select name="kode_akun[]" id="kode_akun1" class="form-control" >
			          			<option value="" selected >-- Pilih Kode Akun --</option>
			          			<?php foreach ($dd_kodeakun as $dd) : ?>
			          				<option value="<?= $dd->kode_akun; ?>"><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
			          			<?php endforeach; ?>
		          			</select> 
		
		          		</div>
		          		
		          		
		          			
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Akun</h5>
		          			<input type="text" class="form-control" name="akun[]" id="akun1"  value="<?= set_value('akun[]'); ?>" readonly>
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		</div>
		          		
		          	
		          			
		          		
		          	</div>
		          	
		          		
		          		
		          		
		          			 <!-- <input type="text" class="form-control" hidden name="pos_saldo[]" id="pos_saldo" value="2" > -->

		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Pos Laporan</h3>
						      <input type="text" class="form-control" name="pos_laporan[]" id="pos_laporan1" value="" readonly>
		          		</div>
		          		<div class="form-group col">
		          			<h5>Pos Akun</h3>
						      <input type="text" class="form-control" name="pos_akun[]" id="pos_akun1" value="" readonly>
		          		</div>		        	          		
		          	</div>

		          	<div class="form-row mt-2">
		         		<div class="form-group col">
		          			<h5>Pos Saldo</h5>
						      <select class="form-control" name="pos_saldo[]" id="pos_saldo1" onchange="nonaktifDebitKredit1()">
						        <option selected>Pilih...</option>
						        <option value="Debit">Debit</option>
						        <option value="Kredit">Kredit</option>
						      </select>
		          		</div>
		          	</div>	
		          	
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Debit</h5>
		          			<input  type="text" class="form-control" name="debit[]" id="debit1" value="<?= set_value('debit'); ?>">
		          			<small class="form-text text-danger"><?= form_error('debit[]'); ?></small>
		          		</div>

		          		<div class="form-group col">
		          			<h5>Kredit</h5>
		          			<input  type="text" class="form-control" name="kredit[]" id="kredit1" value="">
		          			<small class="form-text text-danger"><?= form_error('kredit[]'); ?></small>
		          		</div>
		          		
		          	</div>

		          	
		          	
		        </div>  		
		       
		    </div>
		</div>

		<div class="col-12 col-md-6 mt-2">
          	<div class="card">

          		<div class="card-header text-center p-0">
          			<button id="enable_form3" class="btn btn-primary text-white" type="button" data-toggle="collapse" data-target="#form3" aria-expanded="false" aria-controls="form3" style="width: 100%; height: 50px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">Form 3</button>
          		</div>
              	<div > 

              	<div class="collapse multi-collapse" id="form3"> 

              	 <div class="card-body">              			          			
		     	 	<div class="form-row justify-content-around">

		          		<div class="form-group col">
		    		          			
		          			<h5>Kode Akun</h5>
		          			<select name="kode_akun[]" id="kode_akun2" class="form-control" disabled>
			          			<option value="" selected >-- Pilih Kode Akun --</option>
			          			<?php foreach ($dd_kodeakun as $dd) : ?>
			          				<option value="<?= $dd->kode_akun; ?>"><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
			          			<?php endforeach; ?>
		          			</select> 
		
		          		</div>
		          		
		          		
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Akun</h5>
		          			<input type="text" class="form-control" name="akun[]" id="akun2"  value="" readonly disabled>
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		</div>
		          		
		          		
		          			
		          		
		          	</div>
		          	
		          		
		          		
		        	          		
		          		
		          			 <!-- <input type="text" class="form-control" hidden name="pos_saldo[]" id="pos_saldo" value="2" > -->

		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Pos Laporan</h3>
						      <input type="text" class="form-control" name="pos_laporan[]" id="pos_laporan2" value="" readonly disabled>
		          		</div>
		          		<div class="form-group col">
		          			<h5>Pos Akun</h3>
						      <input type="text" class="form-control" name="pos_akun[]" id="pos_akun2" value="" readonly disabled>
		          		</div>		        	          		
		          	</div>

		          	<div class="form-row mt-2">
		         		<div class="form-group col">
		          			<h5>Pos Saldo</h5>
						      <select disabled class="form-control" name="pos_saldo[]" id="pos_saldo2" onchange="nonaktifDebitKredit2()">
						        <option selected>Pilih...</option>
						        <option value="Debit">Debit</option>
						        <option value="Kredit">Kredit</option>
						      </select>
		          		</div>
		          	</div>	
		          	
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Debit</h5>
		          			<input disabled type="text" class="form-control" name="debit[]" id="debit2" value="<?= set_value('debit'); ?>">
		          			<small class="form-text text-danger"><?= form_error('debit[]'); ?></small>
		          		</div>

		          		<div class="form-group col">
		          			<h5>Kredit</h5>
		          			<input disabled type="text" class="form-control" name="kredit[]" id="kredit2" value="">
		          			<small class="form-text text-danger"><?= form_error('kredit[]'); ?></small>
		          		</div>
		          		
		          	</div>

		          	
		          </div>	
		        </div>  		
		    </div>   
		    </div>
		</div>

		<div class="col-12 col-md-6 mt-2">
          	<div class="card">

          		<div class="card-header text-center p-0">
          			<button id="enable_form4" class="btn btn-primary text-white" type="button" data-toggle="collapse" data-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1" style="width: 100%; height: 50px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">Form 4</button>
          		</div>
              	<div class="collapse multi-collapse" id="multiCollapseExample1"> 
              	<div class="card-body">              			          			
		          	<div class="form-row justify-content-around">

		          		<div class="form-group col">
		    
		          			
		          			<h5>Kode Akun</h5>
		          			<select name="kode_akun[]" id="kode_akun3" class="form-control" disabled>
			          			<option value="" selected >-- Pilih Kode Akun --</option>
			          			<?php foreach ($dd_kodeakun as $dd) : ?>
			          				<option value="<?= $dd->kode_akun; ?>"><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
			          			<?php endforeach; ?>
		          			</select> 
		
		          		</div>
		          		
		          		
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Akun</h5>
		          			<input type="text" class="form-control" name="akun[]" id="akun3"  value="" readonly disabled>
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		</div>
		          		
		          		
		          			
		          		
		          	</div>
		          	
		          		
		          		
		          		
		          			 <!-- <input type="text" class="form-control" hidden name="pos_saldo[]" id="pos_saldo" value="2" > -->

		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Pos Laporan</h3>
						      <input type="text" class="form-control" name="pos_laporan[]" id="pos_laporan3" value="" readonly disabled>
		          		</div>
		          		<div class="form-group col">
		          			<h5>Pos Akun</h3>
						      <input type="text" class="form-control" name="pos_akun[]" id="pos_akun3" value="" readonly disabled>
		          		</div>			        	          		
		          	</div>

		          	<div class="form-row mt-2">
		         		<div class="form-group col">
		          			<h5>Pos Saldo</h5>
						      <select class="form-control" disabled name="pos_saldo[]" id="pos_saldo3" onchange="nonaktifDebitKredit3()">
						        <option selected>Pilih...</option>
						        <option value="Debit">Debit</option>
						        <option value="Kredit">Kredit</option>
						      </select>
		          		</div>
		          	</div>	
		          	
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Debit</h5>
		          			<input disabled  type="text" class="form-control" name="debit[]" id="debit3" value="<?= set_value('debit'); ?>">
		          			<small class="form-text text-danger"><?= form_error('debit[]'); ?></small>
		          		</div>

		          		<div class="form-group col">
		          			<h5>Kredit</h5>
		          			<input disabled type="text" class="form-control" name="kredit[]" id="kredit3" value="">
		          			<small class="form-text text-danger"><?= form_error('kredit[]'); ?></small>
		          		</div>
		          		
		          	</div>

		          	
		          	
		        </div>  		
		       
		    </div>
		</div>
	
	
</div>					
	</div>

	<div class="row mt-2 ">
		<!-- BUTTON INPUT -->
		<div class="col-12 text-center mb-2">
			
				<button type="submit" name="tambah" id="ubah" class="btn btn-success" style="width: 250px; height: 50px;"><h5 class="m-0" onclick="auto_copy();"><strong>INPUT</strong></h5></button> 
			
		</div>
	</div>


</form>

		    <div class="card mb-4">
		    	<div class="row p-4">
		    		<div class="col-12 col-md-4 mb-2 mb-md-0 text-center">
		    			<button href="#" class="btn btn-primary" style="height: 50px; width: 200px;">
		    				Kas Masuk
		    			</button>
		    		</div>
		    		<div class="col-12 col-md-4 mb-2 mb-md-0 text-center" >
		    			<button href="#" class="btn btn-primary" style="height: 50px; width: 200px;">
		    				Kas Keluar
		    			</button>
		    		</div>
		    		<div class="col-12 col-md-4 mb-2 mb-md-0 text-center">
		    			<button href="<?= base_url(); ?>admin/jurnal_umum" class="btn btn-warning" style="height: 50px; width: 200px;">
		    				Jurnal Umum
		    			</button>
		    		</div>
		    	</div>
		    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>

<script type="text/javascript">
	
	function nonaktifDebitKredit3()
		{
			if (document.getElementById('pos_saldo3').value=='Debit') {
				document.getElementById('debit3').readOnly = false;
				document.getElementById('kredit3').readOnly = true;
				document.getElementById('debit3').value='';
				document.getElementById('kredit3').value='0';
			}
			if (document.getElementById('pos_saldo3').value=='Kredit') {
				document.getElementById('debit3').readOnly = true;
				document.getElementById('kredit3').readOnly = false;
				document.getElementById('debit3').value='0';
				document.getElementById('kredit3').value='';
			}
		}

	function nonaktifDebitKredit2()
		{
			if (document.getElementById('pos_saldo2').value=='Debit') {
				document.getElementById('debit2').readOnly = false;
				document.getElementById('kredit2').readOnly = true;
				document.getElementById('debit2').value='';
				document.getElementById('kredit2').value='0';
			}
			if (document.getElementById('pos_saldo2').value=='Kredit') {
				document.getElementById('debit2').readOnly = true;
				document.getElementById('kredit2').readOnly = false;
				document.getElementById('debit2').value='0';
				document.getElementById('kredit2').value='';
			}
		}

	function nonaktifDebitKredit1()
		{
			if (document.getElementById('pos_saldo1').value=='Debit') {
				document.getElementById('debit1').readOnly = false;
				document.getElementById('kredit1').readOnly = true;
				document.getElementById('debit1').value='';
				document.getElementById('kredit1').value='0';
			}
			if (document.getElementById('pos_saldo1').value=='Kredit') {
				document.getElementById('debit1').readOnly = true;
				document.getElementById('kredit1').readOnly = false;
				document.getElementById('debit1').value='0';
				document.getElementById('kredit1').value='';
			}
		}

	function nonaktifDebitKredit()
		{
			if (document.getElementById('pos_saldo').value=='Debit') {
				// document.formtransaksi.debit.readonly=false;
				document.getElementById('debit').readOnly = false;
				document.getElementById('kredit').readOnly = true;
				document.getElementById('debit').value='';
				document.getElementById('kredit').value='0';
			}
			if (document.getElementById('pos_saldo').value=='Kredit') {
				document.getElementById('debit').readOnly = true;
				document.getElementById('kredit').readOnly = false;
				document.getElementById('debit').value='0';
				document.getElementById('kredit').value='';
			}
		}

	function auto_copy()
		{
			if (document.getElementById('ubah').clicked) {
				document.getElementById('tanggal_transaksi').value = document.getElementById('tanggal_copy').value;
				document.getElementById('tanggal_transaksi1').value = document.getElementById('tanggal_copy').value;
				document.getElementById('tanggal_transaksi2').value = document.getElementById('tanggal_copy').value;
				document.getElementById('tanggal_transaksi3').value = document.getElementById('tanggal_copy').value;
				document.getElementById('bukti_transaksi').value = document.getElementById('bukti_copy').value;
				document.getElementById('bukti_transaksi1').value = document.getElementById('bukti_copy').value;
				document.getElementById('bukti_transaksi2').value = document.getElementById('bukti_copy').value;
				document.getElementById('bukti_transaksi3').value = document.getElementById('bukti_copy').value;
				document.getElementById('keterangan').value = document.getElementById('keterangan_copy').value;
				document.getElementById('keterangan1').value = document.getElementById('keterangan_copy').value;
				document.getElementById('keterangan2').value = document.getElementById('keterangan_copy').value;
				document.getElementById('keterangan3').value = document.getElementById('keterangan_copy').value;
			}

			document.getElementById('bukti_transaksi').value = document.getElementById('bukti_copy').value;
			document.getElementById('tanggal_transaksi').value = document.getElementById('tanggal_copy').value;
			document.getElementById('keterangan').value = document.getElementById('keterangan_copy').value;
			document.getElementById('bukti_transaksi1').value = document.getElementById('bukti_copy').value;
			document.getElementById('tanggal_transaksi1').value = document.getElementById('tanggal_copy').value;
			document.getElementById('keterangan1').value = document.getElementById('keterangan_copy').value;
			document.getElementById('bukti_transaksi2').value = document.getElementById('bukti_copy').value;
			document.getElementById('tanggal_transaksi2').value = document.getElementById('tanggal_copy').value;
			document.getElementById('keterangan2').value = document.getElementById('keterangan_copy').value;
			document.getElementById('bukti_transaksi3').value = document.getElementById('bukti_copy').value;
			document.getElementById('tanggal_transaksi3').value = document.getElementById('tanggal_copy').value;
			document.getElementById('keterangan3').value = document.getElementById('keterangan_copy').value;

		}




	$(document).ready(function(){

			// $('#tanggal_copy').datepicker({
			// 	onSelect: function(){
			// 		$('#tanggal_transaksi').val(this.value);
			// 	}
			// })

			//add atribute pada form debit kredit
			//form 3

			$("#enable_form3").click(function(){
					if ($('#debit2').attr('disabled')) {
						$('#debit2').removeAttr('disabled');
						$('#kode_akun2').removeAttr('disabled');
						$('#pos_saldo2').removeAttr('disabled');
						$('#kredit2').removeAttr('disabled');
						$('#akun2').removeAttr('disabled');
						$('#pos_laporan2').removeAttr('disabled');
						$('#pos_akun2').removeAttr('disabled');
						$('.tanggal_transaksi3').removeAttr('disabled');
						$('.bukti_transaksi3').removeAttr('disabled');
						$('.keterangan3').removeAttr('disabled');
					} else {						
						$('#kode_akun2').attr('disabled', 'disabled');
						$('#pos_saldo2').attr('disabled', 'disabled');
						$('#debit2').attr('disabled', 'disabled');
						$('#kredit2').attr('disabled', 'disabled');
						$('#akun2').attr('disabled', 'disabled');
						$('#pos_laporan2').attr('disabled', 'disabled');
						$('#pos_akun2').attr('disabled', 'disabled');
						$('.tanggal_transaksi3').attr('disabled', 'disabled');
						$('.bukti_transaksi3').attr('disabled', 'disabled');
						$('.keterangan3').attr('disabled', 'disabled');

					}
			
			});

		//form 4 disable enable


			$("#enable_form4").click(function(){
					if ($('#debit3').attr('disabled')) {
						$('#debit3').removeAttr('disabled');
						$('#kode_akun3').removeAttr('disabled');
						$('#pos_saldo3').removeAttr('disabled');
						$('#kredit3').removeAttr('disabled');
						$('#akun3').removeAttr('disabled');
						$('#pos_laporan3').removeAttr('disabled');
						$('#pos_akun3').removeAttr('disabled');
						$('.tanggal_transaksi4').removeAttr('disabled');
						$('.bukti_transaksi4').removeAttr('disabled');
						$('.keterangan4').removeAttr('disabled');
					} else {						
						$('#kode_akun3').attr('disabled', 'disabled');
						$('#pos_saldo3').attr('disabled', 'disabled');
						$('#debit3').attr('disabled', 'disabled');
						$('#kredit3').attr('disabled', 'disabled');
						$('#akun3').attr('disabled', 'disabled');
						$('#pos_laporan3').attr('disabled', 'disabled');
						$('#pos_akun3').attr('disabled', 'disabled');
						$('.tanggal_transaksi4').attr('disabled', 'disabled');
						$('.bukti_transaksi4').attr('disabled', 'disabled');
						$('.keterangan4').attr('disabled', 'disabled');

					}
			
			});

			//Form1

			$('#kode_akun').on('input',function(){
                
                var kode_akun=$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/admin/get_kodeakun')?>",
                    dataType : "JSON",
                    data : {kode_akun: kode_akun},
                    cache:false,
                    success: function(data){
                        $.each(data,function(kode_akun, akun, pos_laporan, pos_akun){
                    
                            $('[id="akun"]').val(data.akun);
                            $('[id="pos_laporan"]').val(data.pos_laporan);
                            $('[id="pos_akun"]').val(data.pos_akun);
                            
                        });
                        
                    }
                });
                return false;
           });

			//Form2

			$('#kode_akun1').on('input',function(){
                
                var kode_akun=$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/admin/get_kodeakun')?>",
                    dataType : "JSON",
                    data : {kode_akun: kode_akun},
                    cache:false,
                    success: function(data){
                        $.each(data,function(kode_akun, akun, pos_laporan, pos_akun){
                    
                            $('[id="akun1"]').val(data.akun);
                            $('[id="pos_laporan1"]').val(data.pos_laporan);
                            $('[id="pos_akun1"]').val(data.pos_akun);
                            
                        });
                        
                    }
                });
                return false;
           });

			//Form3

			$('#kode_akun2').on('input',function(){
                
                var kode_akun=$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/admin/get_kodeakun')?>",
                    dataType : "JSON",
                    data : {kode_akun: kode_akun},
                    cache:false,
                    success: function(data){
                        $.each(data,function(kode_akun, akun, pos_laporan, pos_akun){
                    
                            $('[id="akun2"]').val(data.akun);
                            $('[id="pos_laporan2"]').val(data.pos_laporan);
                            $('[id="pos_akun2"]').val(data.pos_akun);
                            
                        });
                        
                    }
                });
                return false;
           });


			// form4
			$('#kode_akun3').on('input',function(){
                
                var kode_akun=$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/admin/get_kodeakun')?>",
                    dataType : "JSON",
                    data : {kode_akun: kode_akun},
                    cache:false,
                    success: function(data){
                        $.each(data,function(kode_akun, akun, pos_laporan, pos_akun){
                    
                            $('[id="akun3"]').val(data.akun);
                            $('[id="pos_laporan3"]').val(data.pos_laporan);
                            $('[id="pos_akun3"]').val(data.pos_akun);
                            
                        });
                        
                    }
                });
                return false;
           });
	});
</script>
