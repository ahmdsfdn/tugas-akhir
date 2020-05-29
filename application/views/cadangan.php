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
<?php elseif ($this->session->flashdata('pesan_error')) : ?>
			<div class="row">
				<div class="col-6">
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						 	  <?= $this->session->flashdata('pesan_error'); ?>
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
					</div>
				</div>
			</div>

<?php endif; ?>
          <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Input Transaksi</h1>

  	
    <div class="row">
    	<div class="col">
          	<form>
			  <div class="card mb-2">
			  	<div class="form-row p-2">
				    <div class="col">
				    		<label>Bukti Transaksi</label>
				      <input type="text" class="form-control" id="bukti_copy" name="bukti_copy" onkeyup="auto_copy();">
				      		<small class="form-text text-danger"><?= form_error('bukti_transaksi[]'); ?></small>
				    </div>
				    <div class="col">
				    		<label>Tanggal Transaksi</label>
				      <input type="date" class="form-control" id="tanggal_copy" name="tanggal_copy" onkeyup="auto_copy();">
				     		<small class="form-text text-danger"><?= form_error('tanggal_transaksi[]'); ?></small>
				    </div>
				     <div class="col">
				     		<label>Keterangan</label>
				      <input type="text" class="form-control" id="keterangan_copy" 
				     name="keterangan_copy" onkeyup="auto_copy();">
				      		<small class="form-text text-danger"><?= form_error('keterangan[]'); ?></small>
				    </div>
				</div>
			  </div>
			</form>
		</div>

	</div>
	<!-- awal form transaksi -->

<form action="<?= base_url('admin/insert_transaksi_m') ?>" method="post" name="formtransaksi">

<div class="content" id="form-debit">	
	
	<div class="row"> 

		<div class="col-6">
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
			          				<?php if ($dd == $isiform['kode_akun'][0]) : ?>
						        		<option value="<?= $dd ?>" selected><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
						        	<?php else : ?>
						       			<option value="<?= $dd ?>"><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>	
						        	<?php endif; ?>
			          				<option value="<?= $dd->kode_akun; ?>"><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
			          			<?php endforeach; ?>
		          			</select> 
		
		          		</div>
		          		
		          			<!-- <h5>Tanggal HIDDEN</h3> -->
		          			<input type="text" class="form-control" name="tanggal_transaksi[]" id="tanggal_transaksi" value="<?= set_value('tanggal_transaksi'); ?>" hidden>
		          			
		          			
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Akun</h5>
		          			<input type="text" class="form-control" name="akun[]" id="akun"  value="" readonly>
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		</div>
		          		
		          			<!-- <h5>Bukti Transaksi HIDDEN</h3> -->
		          			<input type="text" class="form-control" hidden name="bukti_transaksi[]" id="bukti_transaksi" value="<?= set_value('bukti_transaksi'); ?>" >
		          			
		          		
		          	</div>
		          	
		          		
		          			<!-- Keterangan HIDDEN -->
		          			<input type="text" class="form-control" name="keterangan[]" id="keterangan" value="<?= set_value('keterangan'); ?>" hidden >
		        	          		
		          		
		          			 <!-- <input type="text" class="form-control" hidden name="pos_saldo[]" id="pos_saldo" value="2" > -->

		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Pos Laporan</h3>
						      <input type="text" class="form-control" name="pos_laporan[]" id="pos_laporan" value="" readonly>
		          		</div>		        	          		
		          	</div>

		          	<div class="form-row mt-2">
		         		<div class="form-group col">
		          			<h5>Pos Saldo</h5>
						      <select class="form-control" name="pos_saldo" id="pos_saldo" onchange="nonaktifDebitKredit()">
						        <option selected>Pilih...</option>
						        <option value="1">Debit</option>
						        <option value="2">Kredit</option>
						      </select>
		          		</div>
		          	</div>	
		          	
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Debit</h5>
		          			<input  type="text" class="form-control" name="debit[]" id="debit" value="<?= set_value('debit'); ?>">
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

		<div class="col-6">
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
		          		
		          			<!-- <h5>Tanggal HIDDEN</h3> -->
		          			<input type="text" class="form-control" name="tanggal_transaksi[]" id="tanggal_transaksi1" value="<?= set_value('tanggal_transaksi'); ?>" hidden>
		          			
		          			
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Akun</h5>
		          			<input type="text" class="form-control" name="akun[]" id="akun1"  value="" readonly>
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		</div>
		          		
		          			<!-- <h5>Bukti Transaksi HIDDEN</h3> -->
		          			<input type="text" class="form-control" hidden name="bukti_transaksi[]" id="bukti_transaksi1" value="<?= set_value('bukti_transaksi'); ?>" >
		          			
		          		
		          	</div>
		          	
		          		
		          			<!-- Keterangan HIDDEN -->
		          			<input type="text" class="form-control" name="keterangan[]" id="keterangan1" value="<?= set_value('keterangan'); ?>" hidden >
		        	          		
		          		
		          			 <!-- <input type="text" class="form-control" hidden name="pos_saldo[]" id="pos_saldo" value="2" > -->

		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Pos Laporan</h3>
						      <input type="text" class="form-control" name="pos_laporan[]" id="pos_laporan1" value="" readonly>
		          		</div>		        	          		
		          	</div>

		          	<div class="form-row mt-2">
		         		<div class="form-group col">
		          			<h5>Pos Saldo</h5>
						      <select class="form-control" name="pos_saldo[]" id="pos_saldo1" onchange="nonaktifDebitKredit1()">
						        <option selected>Pilih...</option>
						        <option value="1">Debit</option>
						        <option value="2">Kredit</option>
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

		<div class="col-6 mt-2">
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
		          		
		          			<!-- <h5>Tanggal HIDDEN</h3> -->
		          			<input type="text" class="form-control tanggal_transaksi3" name="tanggal_transaksi[]" id="tanggal_transaksi2" value="<?= set_value('tanggal_transaksi'); ?>" hidden disabled>
		          			
		          			
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Akun</h5>
		          			<input type="text" class="form-control" name="akun[]" id="akun2"  value="" readonly disabled>
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		</div>
		          		
		          			<!-- <h5>Bukti Transaksi HIDDEN</h3> -->
		          			<input type="text" class="form-control bukti_transaksi3" hidden name="bukti_transaksi[]" id="bukti_transaksi2" value="<?= set_value('bukti_transaksi'); ?>" disabled>
		          			
		          		
		          	</div>
		          	
		          		
		          			<!-- Keterangan HIDDEN -->
		          			<input type="text" class="form-control keterangan3" name="keterangan[]" id="keterangan2" value="<?= set_value('keterangan'); ?>" hidden disabled >
		        	          		
		          		
		          			 <!-- <input type="text" class="form-control" hidden name="pos_saldo[]" id="pos_saldo" value="2" > -->

		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Pos Laporan</h3>
						      <input type="text" class="form-control" name="pos_laporan[]" id="pos_laporan2" value="" readonly disabled>
		          		</div>		        	          		
		          	</div>

		          	<div class="form-row mt-2">
		         		<div class="form-group col">
		          			<h5>Pos Saldo</h5>
						      <select disabled class="form-control" name="pos_saldo[]" id="pos_saldo2" onchange="nonaktifDebitKredit2()">
						        <option selected>Pilih...</option>
						        <option value="1">Debit</option>
						        <option value="2">Kredit</option>
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

		<div class="col-6 mt-2">
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
		          		
		          			<!-- <h5>Tanggal HIDDEN</h3> -->
		          			<input type="text" class="form-control tanggal_transaksi4" name="tanggal_transaksi[]" id="tanggal_transaksi3" value="<?= set_value('tanggal_transaksi'); ?>" hidden disabled>
		          			
		          			
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Akun</h5>
		          			<input type="text" class="form-control" name="akun[]" id="akun3"  value="" readonly disabled>
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		</div>
		          		
		          			<!-- <h5>Bukti Transaksi HIDDEN</h3> -->
		          			<input type="text" class="form-control bukti_transaksi4" hidden disabled name="bukti_transaksi[]" id="bukti_transaksi3" value="<?= set_value('bukti_transaksi'); ?>" >
		          			
		          		
		          	</div>
		          	
		          		
		          			<!-- Keterangan HIDDEN -->
		          			<input type="text" class="form-control keterangan4" name="keterangan[]" id="keterangan3" value="<?= set_value('keterangan'); ?>" hidden disabled>
		        	          		
		          		
		          			 <!-- <input type="text" class="form-control" hidden name="pos_saldo[]" id="pos_saldo" value="2" > -->

		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col">
		          			<h5>Pos Laporan</h3>
						      <input type="text" class="form-control" name="pos_laporan[]" id="pos_laporan3" value="" readonly disabled>
		          		</div>		        	          		
		          	</div>

		          	<div class="form-row mt-2">
		         		<div class="form-group col">
		          			<h5>Pos Saldo</h5>
						      <select class="form-control" disabled name="pos_saldo[]" id="pos_saldo3" onchange="nonaktifDebitKredit3()">
						        <option selected>Pilih...</option>
						        <option value="1">Debit</option>
						        <option value="2">Kredit</option>
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
			
				<button type="submit" name="tambah" class="btn btn-success" style="width: 250px; height: 50px;"><h5 class="m-0"><strong>INPUT</strong></h5></button> 
			
		</div>
	</div>


</form>

		    <div class="card mb-4">
		    	<div class="row justify-content-around p-4">
		    		<div class="col-4 text-center">
		    			<button href="#" class="btn btn-primary" style="height: 50px; width: 200px;">
		    				Kas Masuk
		    			</button>
		    		</div>
		    		<div class="col-4 text-center" >
		    			<button href="#" class="btn btn-primary" style="height: 50px; width: 200px;">
		    				Kas Keluar
		    			</button>
		    		</div>
		    		<div class="col-4 text-center">
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
			if (document.getElementById('pos_saldo3').value=='1') {
				document.getElementById('debit3').readOnly = false;
				document.getElementById('kredit3').readOnly = true;
				document.getElementById('debit3').value='';
				document.getElementById('kredit3').value='0';
			}
			if (document.getElementById('pos_saldo3').value=='2') {
				document.getElementById('debit3').readOnly = true;
				document.getElementById('kredit3').readOnly = false;
				document.getElementById('debit3').value='0';
				document.getElementById('kredit3').value='';
			}
		}

	function nonaktifDebitKredit2()
		{
			if (document.getElementById('pos_saldo2').value=='1') {
				document.getElementById('debit2').readOnly = false;
				document.getElementById('kredit2').readOnly = true;
				document.getElementById('debit2').value='';
				document.getElementById('kredit2').value='0';
			}
			if (document.getElementById('pos_saldo2').value=='2') {
				document.getElementById('debit2').readOnly = true;
				document.getElementById('kredit2').readOnly = false;
				document.getElementById('debit2').value='0';
				document.getElementById('kredit2').value='';
			}
		}

	function nonaktifDebitKredit1()
		{
			if (document.getElementById('pos_saldo1').value=='1') {
				document.getElementById('debit1').readOnly = false;
				document.getElementById('kredit1').readOnly = true;
				document.getElementById('debit1').value='';
				document.getElementById('kredit1').value='0';
			}
			if (document.getElementById('pos_saldo1').value=='2') {
				document.getElementById('debit1').readOnly = true;
				document.getElementById('kredit1').readOnly = false;
				document.getElementById('debit1').value='0';
				document.getElementById('kredit1').value='';
			}
		}

	function nonaktifDebitKredit()
		{
			if (document.getElementById('pos_saldo').value=='1') {
				// document.formtransaksi.debit.readonly=false;
				document.getElementById('debit').readOnly = false;
				document.getElementById('kredit').readOnly = true;
				document.getElementById('debit').value='';
				document.getElementById('kredit').value='0';
			}
			if (document.getElementById('pos_saldo').value=='2') {
				document.getElementById('debit').readOnly = true;
				document.getElementById('kredit').readOnly = false;
				document.getElementById('debit').value='0';
				document.getElementById('kredit').value='';
			}
		}

	function auto_copy()
		{
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
                        $.each(data,function(kode_akun, akun, pos_laporan){
                    
                            $('[id="akun"]').val(data.akun);
                            $('[id="pos_laporan"]').val(data.pos_laporan);
                            
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
                        $.each(data,function(kode_akun, akun, pos_laporan){
                    
                            $('[id="akun1"]').val(data.akun);
                            $('[id="pos_laporan1"]').val(data.pos_laporan);
                            
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
                        $.each(data,function(kode_akun, akun, pos_laporan){
                    
                            $('[id="akun2"]').val(data.akun);
                            $('[id="pos_laporan2"]').val(data.pos_laporan);
                            
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
                        $.each(data,function(kode_akun, akun, pos_laporan){
                    
                            $('[id="akun3"]').val(data.akun);
                            $('[id="pos_laporan3"]').val(data.pos_laporan);
                            
                        });
                        
                    }
                });
                return false;
           });


	


	});

	

</script>


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
          <h1 class="h3 mb-4 text-gray-800">Silahkan Ubah Transaksi !</h1>
          	<div class="card p-3">
          		<form action="" method="post" name="formtransaksi">

          			<input type="hidden" name="id" value="<?= $transaksi['id']; ?>">
          			<!-- pesan validasi error yang diambil dari controller -->
          			<!-- <?php if (validation_errors() ) : ?>
          				<div class="alert alert-danger" role="alert">
          					<?= validation_errors(); ?>
          				</div>
          			<?php endif; ?> -->
          			
          			
		          	<div class="form-row justify-content-around">

		          		<div class="form-group col-5">
		          			<h5>Kode Akun</h3>
		          			<input type="text" class="form-control" name="kode_akun" id="kode_akun" value="<?= $transaksi['kode_akun'];?>">
		          			<!-- memunculkan single pesan error -->
		          			<small class="form-text text-danger"><?= form_error('kode_akun'); ?></small>
		          			
		          		</div>
		          		<div class="form-group col-5">
		          			<h5>Tanggal</h3>
		          			<input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" value="<?= $transaksi['tanggal_transaksi'];?>" >
		          			<small class="form-text text-danger"><?= form_error('tanggal_transaksi'); ?></small>
		          		</div>		
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col-5">
		          			<h5>Akun</h3>
		          			<input type="text" class="form-control" name="akun" id="akun"  value="<?=$transaksi['akun']; ?>">
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		
		          		</div>
		          		<div class="form-group col-5">
		          			<h5>Bukti Transaksi</h3>
		          			<input type="text" class="form-control" name="bukti_transaksi" id="bukti_transaksi"  value="<?=$transaksi['bukti_transaksi']; ?>" >
		          			<small class="form-text text-danger"><?= form_error('bukti_transaksi'); ?></small>
		          		</div>
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col-5">
		          			<h5>Keterangan</h3>
		          			<input type="text" class="form-control" name="keterangan" id="keterangan" value="<?=   $transaksi['keterangan'];?>">
		          			<small class="form-text text-danger"><?= form_error('keterangan'); ?></small>
		          			
		          		</div>
		          		<div class="form-group col-5">
		          			<h5>Pos Saldo</h3>
						      <select class="form-control" name="pos_saldo" id="pos_saldo" onchange="nonaktifDebitKredit()">
						      	<?php foreach ($pos_saldo as $ps) : ?>
						        	<?php if ($ps == $transaksi['pos_saldo']) : ?>
						        		<option value="<?= $ps ?>" selected><?= $ps; ?></option>
						        	<?php else : ?>
						       			<option value="<?= $ps ?>"><?= $ps; ?></option>	
						        	<?php endif; ?>
						        <?php endforeach; ?>
						      </select>
		          		</div>
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col-2">
		          			<h5>Debit</h3>
		          			<input type="text" class="form-control" name="debit" id="debit" value="<?=  $transaksi['debit']; ?>">
		          			<small class="form-text text-danger"><?= form_error('debit'); ?></small>
		       
		          		</div>

		          		<div class="form-group col-2">
		          			<h5>Kredit</h3>
		          			<input type="text" class="form-control" name="kredit" id="kredit" value="<?=   $transaksi['kredit'];?>">
		          			<small class="form-text text-danger"><?= form_error('kredit'); ?></small>
		          			
		          		</div>
		          		<div class="form-group col-5">
		          			<h5>Pos Laporan</h3>
						      <select class="form-control" name="pos_laporan" id="pos_laporan">
						 	<?php foreach ( $pos_laporan as $pl) : ?>
						 		<?php if ($pl == $transaksi['pos_laporan']) :
						 		 ?>
						        <option value="<?= $pl ?>" selected><?= $pl; ?></option>
						        <?php else : ?>
						        <option value="<?= $pl ?>"><?= $pl; ?></option>
						      
						      <?php endif; ?>
						    <?php endforeach; ?>
						    	</select>
		          		</div>
		          	</div>
		          		<ul class="text-center">
				   			<button type="submit" name="ubah" class="btn btn-success" style="width: 200px">Update</button> 
				   		</ul>
		       </form>
		    </div>
		    <div class="card mt-4 mb-4">
		    	<div class="row justify-content-around p-4">
		    		<div class="col-4 text-center">
		    			<button href="#" class="btn btn-primary" style="height: 50px; width: 200px;">
		    				Kas Masuk
		    			</button>
		    		</div>
		    		<div class="col-4 text-center" >
		    			<button href="#" class="btn btn-primary" style="height: 50px; width: 200px;">
		    				Kas Keluar
		    			</button>
		    		</div>
		    		<div class="col-4 text-center">
		    			<button href="#" class="btn btn-warning" style="height: 50px; width: 200px;">
		    				Jurnal Umum
		    			</button>
		    		</div>
		    	</div>
		    </div>

</div>



<script language="javascript">

function nonaktifDebitKredit()
{

	

	if (document.formtransaksi.pos_saldo.value=='Debit') {
		document.formtransaksi.debit.disabled=false;
		document.formtransaksi.kredit.disabled=true;
		document.formtransaksi.debit.value='';
		document.formtransaksi.kredit.value='0';
	}
	if (document.formtransaksi.pos_saldo.value=='Kredit') {
		document.formtransaksi.debit.disabled=true;
		document.formtransaksi.kredit.disabled=false;
		document.formtransaksi.debit.value='0';
		document.formtransaksi.kredit.value='';
	}
}

</script>
