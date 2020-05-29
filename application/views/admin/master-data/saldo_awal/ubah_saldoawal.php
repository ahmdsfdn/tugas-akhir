<!-- Begin Page Content -->
<div class="container-fluid mb-2">
<!--  -->
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Ubah Saldo Awal</h1>
          	<div class="card p-3">
          		<form action="" method="post" name="formtransaksi">
          			          			
		          	<div class="form-row justify-content-around">

		          		<div class="form-group col-12 col-md-5">
		          			<!-- <h5>Kode Akun</h3> -->
		          			<!--  <input name="kode_akun" id="kode_akun" class="form-control" type="text" placeholder="Kode Akun..." > -->
		          			<h5>Kode Akun</h3>
		          			<select name="kode_akun" id="kode_akun" class="form-control" >
			          			<option value="">-- Pilih Kode Akun --</option>
			          			<?php foreach ($dd_kodeakun as $dd) : ?>
			          				<?php if ($dd->kode_akun == $saldo_awal['kode_akun']) : ?>
			          				<option value="<?= $dd->kode_akun; ?>" selected><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
			          				<?php else : ?>
			          				<option value="<?= $dd->kode_akun; ?>"><?= $dd->kode_akun ?> -- <?= $dd->akun ?></option>
			          				<?php endif; ?>
			          			<?php endforeach; ?>
		          			</select> 
		          			<!-- <h5>Kode Akun</h3>
		          			<select name="kode_akun" id="kode_akun" class="form-control" >
			          			<option value="" selected >-- Pilih Kode Akun --</option>
			          			<option value="NR-0002">NR-0002</option>
		          			</select> -->
		
		          		</div>

		          		<input type="text" class="form-control" name="id" id="id" value="<?= $saldo_awal['id'];?>" hidden>

		          		<div class="form-group col-12 col-md-5">
		          			<h5>Tahun</h5>
		          			<select name="tahun" id="tahun" class="form-control">
		          				<?php $tahun = date('Y')-1; 
		          					  $index = 6;
		          					  $tahun22 = date("Y",strtotime($saldo_awal['tanggal_transaksi']));
		          				?>
		          				
		          				<?php for ($i=0; $i < $index ; $i++) : ?>
		          					<?php if ($tahun - $i == $tahun22): ?>
		          						<option selected value="<?=$tahun - $i?>"><?= $tahun - $i; ?></option>
		          					<?php else: ?>
		          						<option value="<?=$tahun - $i?>"><?= $tahun - $i; ?></option>
		          					<?php endif ?>
		          					
		          				<?php endfor; ?>
		          			</select>
		          		</div>		
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col-12 col-md-5">
		          			<h5>Akun</h5>
		          			<input type="text" class="form-control" name="akun" id="akun"  value="<?= $saldo_awal['akun'];set_value('akun'); ?>" readonly>
		          			<small class="form-text text-danger"><?= form_error('akun'); ?></small>
		          		
		          		</div>

		          		<div class="form-group col-12 col-md-5">
		          			<h5>Pos Akun</h5>
		          			<input type="text" class="form-control" name="pos_akun" id="pos_akun"  value="<?= $saldo_awal['pos_akun'];set_value('pos_akun'); ?>" readonly>
		          			<small class="form-text text-danger"><?= form_error('pos_akun'); ?></small>
		          		
		          		</div>
		          		
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col-12 col-md-5">
		          			<h5>Pos Saldo</h5>
						      <select class="form-control" name="pos_saldo" id="pos_saldo" onchange="nonaktifDebitKredit()">
						        <option selected>Pilih...</option>
						        <?php if ($saldo_awal['kode_akun'] = 'Debit'): ?>
						        	<option value="Debit" selected>Debit</option>
						        	<option value="Kredit">Kredit</option>
						        <?php else: ?>
						        	<option value="Debit">Debit</option>
						        	<option value="Kredit" selected>Kredit</option>
						        <?php endif ?>
						        
						      
						      </select>
		          		</div>
		          		<div class="form-group col-12 col-md-5">
		          			<h5>Keterangan</h5>
		          			<input type="text" class="form-control" name="keterangan" id="keterangan" value="<?= $saldo_awal['keterangan'];set_value('keterangan'); ?>">
		          			<small class="form-text text-danger"><?= form_error('keterangan'); ?></small>
		          			
		          		</div>
		          		
		          	</div>
		          	<div class="form-row justify-content-around mt-2">
		          		<div class="form-group col-12 col-md-2">
		          			<h5>Debit</h5>
		          			<input type="text" class="form-control" name="debit" id="debit" value="<?= $saldo_awal['debit'];set_value('debit'); ?>">
		          			<small class="form-text text-danger"><?= form_error('debit'); ?></small>
		       
		          		</div>

		          		<div class="form-group col-12 col-md-2">
		          			<h5>Kredit</h5>
		          			<input type="text" class="form-control" name="kredit" id="kredit" value="<?=$saldo_awal['kredit']; set_value('kredit'); ?>">
		          			<small class="form-text text-danger"><?= form_error('kredit'); ?></small>
		          			
		          		</div>
		          		<div class="form-group col-12 col-md-5">
		          			<h5>Pos Laporan</h5>
						      <input type="text" class="form-control" name="pos_laporan" id="pos_laporan" value="<?= $saldo_awal['pos_laporan']; ?>" readonly>
		          		</div>
		          	</div>
		          		<ul class="text-center">
				   			<button type="submit" name="tambah" class="btn btn-success" style="width: 200px">Input</button> 
				   		</ul>
		       </form>
		    </div>


		<!--     <div class="card mt-4 mb-4">
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
 -->
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
<script type="text/javascript">
		
	function nonaktifDebitKredit()
		{
			if (document.formtransaksi.pos_saldo.value=='Debit') {
				document.formtransaksi.debit.readOnly=false;
				document.formtransaksi.kredit.readOnly=true;
				document.formtransaksi.debit.value='';
				document.formtransaksi.kredit.value='0';
			}
			if (document.formtransaksi.pos_saldo.value=='Kredit') {
				document.formtransaksi.debit.readOnly=true;
				document.formtransaksi.kredit.readOnly=false;
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
