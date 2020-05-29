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
          <h1 class="h3 mb-4 text-gray-800">Input Transaksi</h1>
          	<div class="card p-3">
          		<form action="<?= base_url('admin/transaksi') ?>" method="post" name="formtransaksi">
          			          			
		          	<div class="form-row justify-content-around">

		          		<div class="form-group col-5">
		          			
		          			<h5>Kode Akun</h3>
		          			<select name="kode_akun" id="kode_akun" class="form-control" >
			          			<option value="" selected >-- Pilih Kode Akun --</option>
			          			<?php foreach ($dd_kodeakun as $dd) : ?>
			          				<option value="<?= $dd->kode_akun; ?>"><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
			          			<?php endforeach; ?>
		          			</select> 
		
		          		</div>
		          		<div class="form-group col-5">
		          			<h5>Tanggal</h3>
		          			<input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" value="<?= set_value('tanggal_transaksi'); ?>" >
		          			<small class="form-text text-danger"><?= form_error('tanggal_transaksi'); ?></small>
		          		</div>		
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col-5">
		          			<h5>Akun</h3>
		          			<input type="text" class="form-control" name="akun" id="akun"  value="" readonly>
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		
		          		</div>
		          		<div class="form-group col-5">
		          			<h5>Bukti Transaksi</h3>
		          			<input type="text" class="form-control" name="bukti_transaksi" id="bukti_transaksi"  value="<?= set_value('bukti_transaksi'); ?>" >
		          			<small class="form-text text-danger"><?= form_error('bukti_transaksi'); ?></small>
		          		</div>
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col-5">
		          			<h5>Keterangan</h3>
		          			<input type="text" class="form-control" name="keterangan" id="keterangan" value="<?= set_value('keterangan'); ?>">
		          			<small class="form-text text-danger"><?= form_error('keterangan'); ?></small>
		          			
		          		</div>
		          		<div class="form-group col-5">
		          			<h5>Pos Saldo</h3>
						      <select class="form-control" name="pos_saldo" id="pos_saldo" onchange="nonaktifDebitKredit()">
						        <option selected>Pilih...</option>
						        <option value="1">Debit</option>
						        <option value="2">Kredit</option>
						      </select>
		          		</div>
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col-2">
		          			<h5>Debit</h3>
		          			<input type="text" class="form-control" name="debit" id="debit" value="<?= set_value('debit'); ?>">
		          			<small class="form-text text-danger"><?= form_error('debit'); ?></small>
		       
		          		</div>

		          		<div class="form-group col-2">
		          			<h5>Kredit</h3>
		          			<input type="text" class="form-control" name="kredit" id="kredit" value="<?= set_value('kredit'); ?>">
		          			<small class="form-text text-danger"><?= form_error('kredit'); ?></small>
		          			
		          		</div>
		          		<div class="form-group col-5">
		          			<h5>Pos Laporan</h3>
						      <input type="text" class="form-control" name="pos_laporan" id="pos_laporan" value="" readonly>
		          		</div>
		          	</div>
		          		<ul class="text-center">
				   			<button type="submit" name="tambah" class="btn btn-success" style="width: 200px">Input</button> 
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

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
<script type="text/javascript">
		
	function nonaktifDebitKredit()
		{
			if (document.formtransaksi.pos_saldo.value=='1') {
				document.formtransaksi.debit.disabled=false;
				document.formtransaksi.kredit.disabled=true;
				document.formtransaksi.debit.value='';
				document.formtransaksi.kredit.value='0';
			}
			if (document.formtransaksi.pos_saldo.value=='2') {
				document.formtransaksi.debit.disabled=true;
				document.formtransaksi.kredit.disabled=false;
				document.formtransaksi.debit.value='0';
				document.formtransaksi.kredit.value='';
			}
		}

	$(document).ready(function(){
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
                    
                            $('[name="akun"]').val(data.akun);
                            $('[name="pos_laporan"]').val(data.pos_laporan);
                            
                        });
                        
                    }
                });
                return false;
           });

		});

</script>
