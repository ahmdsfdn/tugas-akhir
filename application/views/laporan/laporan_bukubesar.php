
<!DOCTYPE html>
<html><head>
	<title></title>
</head><style>
	h1{
		text-align: center;
  font-family: sans-serif;
  margin-bottom: 0px;
}
div { 
 /*text-align: center;*/
}
table {
 
 
 
 	
  width: 100%;
  border-collapse: collapse;
 /* margin-left:auto;*/  /*Digunakan untuk mengatur jarak header dengan tepian layar secara otomatis*/ 
  /*margin-right:auto;*/  
 /* Sehingga tampilan header website akan berada tepat di tengah-tengah layar monitor*/ 
 
  
}

table th {

  padding: 10px 10px;
  background: #000066;
  color: #fff;
   border: 2px solid #e0e0e0;
  
}

table td {
  padding: 10px 10px;
  border: 2px solid #e0e0e0;
  
}
}

 
table tr {
  text-align: center;
}


#header{
			font-family: Arial, Helvetica, sans-serif;
			width:900px;  Digunakan untuk mengatur lebar header 
			height: 150px;
			margin-left:auto;  /*Digunakan untuk mengatur jarak header dengan tepian layar secara otomatis */
			margin-right:auto; /* Sehingga tampilan header website akan berada tepat di tengah-tengah layar monitor */
			text-align: center;
			position: relative;

		}

div.wadah{

	margin-top: 10px;
	position: relative;
	border-top : 2px solid #e0e0e0 dashed;

	margin-bottom: 10px;

}


#kotak{
	/*border: 2px solid #000;*/


}



</style><body>
	<div id="header">
		<div id="kotak">
				<h2 style="margin-top: 0px;">PT. Bagas Tetuko</h2>
				<h2 style="margin-top: 2px;">Buku Besar</h2>
				
					<?php if (!empty($t_aw)): ?>
						<h4 style="margin: 0px;"><?= $t_aw?> s.d. <?= $t_ak ?></h4>
					<?php else: ?>
						<h4 style="margin: 0px;"><?= $nama_bulan?> <?= $tahun ?></h4>
					<?php endif ?> </h4>
				<hr style="background-color: #000; ">
		</div>
	</div>

	
<?php if ($this->input->post('akun')): ?>
	
	<?php 
	$akun = $this->input->post('akun');
	$key = $this->db->get_where('daftar_akun',['akun' => $akun])->row_array();
	
					$datapo[] = ['akun' => $key['akun'],
								 'saldo_normal' => $key['saldo_normal'],
								 'kode_akun' => $key['kode_akun']
								];
				
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

		$this->db->where('year(tanggal_transaksi)',$tahun_sa+1);
		$data_kd = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
	?>

<?php if (!empty($data_sa) or !empty($data_kd)): ?>

	<div class="wadah">
		<div style="text-align: center;">
			<strong><h3><?= $d['akun']; ?><i style="margin-left: 100px;"><?= $d['kode_akun']; ?></i></h3></strong>
		</div>
		<?php //batas ?>
	
			<div>
				<table cellspacing="0">
				  
					<tr>
							<th>Tanggal</th>
						  		<th>Keterangan</th>
						  		<th>Bukti Transaksi</th>
						  		<th width="10%">Ref</th>
						  		<!-- <th>Kode Akun</th> -->
						  		<th>Debit</th>
						  		<th>Kredit</th>
						  		<th>Saldo</th>
					
					</tr>
					
					<!-- tbody -->
				
					<?php if ($this->input->post('tanggal_awal')): ?>

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
						  				$saldo_sa  = [$d['akun'] => $kredit_sa-$debit_sa];
						  				
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
					  			<td></td>
					  			<!-- <td><?= $ju['akun'] ?></td> -->
					  			<!-- <td><?= $ju['kode_akun'] ?></td> -->
					  			<td><?= rupiah($ju['debit']); ?></td>
					  			<td><?= rupiah($ju['kredit']); ?></td>
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
					  			<td><?= rupiah($ju['debit']) ?></td>
					  			<td><?= rupiah($ju['kredit']) ?></td>
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
			<!-- AKHIR -->
			<?php else: ?>
					  		<?php foreach ($data_sa as $sa): ?>

					  			<tr>
						  			<td><?= $sa['tanggal_transaksi']?></td>						  		
						  			<td><?= $sa['keterangan'] ?></td>
						  			<td><?= $sa['bukti_transaksi'] ?></td>
						  		<!-- 	<td><?= $sa['akun'] ?></td> -->
						  			<!-- <td><?= $sa['kode_akun'] ?></td> -->
						  			<td></td>
						  			<td><?= rupiah($sa['debit']) ?></td>
						  			<td><?= rupiah($sa['kredit']) ?></td>

						  				<?php 
						  			
						  				$debit_sa = $sa['debit'];
						  				$kredit_sa = $sa['kredit'];
						  				$saldo_sa  = [$d['akun'] => $kredit_sa - $debit_sa];
						  				
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
					  			<td><?= rupiah($ju['debit']); ?></td>
					  			<td><?= rupiah($ju['kredit']); ?></td>
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
						  				$saldo_sa  = [$d['akun'] => $kredit_sa - $debit_sa];
						  				
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
					  			<td><?= rupiah($ju['debit']) ?></td>
					  			<td><?= rupiah($ju['kredit']) ?></td>
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
					  			<td><?= rupiah($ju['debit']) ?></td>
					  			<td><?= rupiah($ju['kredit']) ?></td>
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
			<!-- AKHIR -->
			<?php else: ?>
					  		<?php foreach ($data_sa as $sa): ?>
					  	<!-- 		<?= print_r($sa); ?> -->
					  			<tr>
						  			<td><?= $sa['tanggal_transaksi']?></td>						  		
						  			<td><?= $sa['keterangan'] ?></td>
						  			<td></td>
						  		<!-- 	<td><?= $sa['akun'] ?></td> -->
						  			<!-- <td><?= $sa['kode_akun'] ?></td> -->
						  			<td></td>
						  			<td><?= rupiah($sa['debit']) ?></td>
						  			<td><?= rupiah($sa['kredit']) ?></td>

						  				<?php 
						  			
						  				$debit_sa = $sa['debit'];
						  				$kredit_sa = $sa['kredit'];
						  				$saldo_sa  = [$d['akun'] => $kredit_sa - $debit_sa];
						  				
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
					  			<td><?= rupiah($ju['debit']); ?></td>
					  			<td><?= rupiah($ju['kredit']); ?></td>
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
					  			<td><?= rupiah($ju['debit']); ?></td>
					  			<td><?= rupiah($ju['kredit']); ?></td>
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
			<!-- AKHIR JIKA MENCARI BULAN -->
		<?php endif; ?>		  		
					<!-- /tbody -->
				</table>
			</div>
	</div>
 <?php else: ?>
 	<!-- tidak ada saldo awal -->
 <?php endif; ?>	
<!-- AKHIR DARI SALDO NORMALLL KREDIT DAN DEBIT DIMULAI -->
<?php else: ?>

	<?php 	
		$this->db->where('year(tanggal_transaksi)',$tahun_sa);
		$data_sa = $this->db->get_where('saldo_awal',['akun' => $d['akun']])->result_array(); 

		$this->db->where('year(tanggal_transaksi)',$tahun_sa+1);
		$data_kd = $this->db->get_where('transaksi',['akun' => $d['akun']])->result_array(); 
	?>

<?php if (!empty($data_sa) or !empty($data_kd)): ?>

	<div class="wadah">
		<div style="text-align: center;">
			<strong><h3><?= $d['akun']; ?><i style="margin-left: 100px;"><?= $d['kode_akun']; ?></i></h3></strong>
		</div>
		<?php //batas ?>
	
			<div>
				<table cellspacing="0">
				  
					<tr>
							<th>Tanggal</th>
						  		<th>Keterangan</th>
						  		<th>Bukti Transaksi</th>
						  		<th width="10%">Ref</th>
						  		<!-- <th>Kode Akun</th> -->
						  		<th>Debit</th>
						  		<th>Kredit</th>
						  		<th>Saldo</th>
					
					</tr>
					
					<!-- tbody -->
				
					<?php if ($this->input->post('tanggal_awal')): ?>

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
					  			<td><?= rupiah($ju['debit']) ?></td>
					  			<td><?= rupiah($ju['kredit']) ?></td>
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
					  			<td><?= rupiah($ju['debit']); ?></td>
					  			<td><?= rupiah($ju['kredit']); ?></td>
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

					  			<tr>
						  			<td><?= $sa['tanggal_transaksi']?></td>						  		
						  			<td><?= $sa['keterangan'] ?></td>
						  			<td></td>
						  		<!-- 	<td><?= $sa['akun'] ?></td> -->
						  			<!-- <td><?= $sa['kode_akun'] ?></td> -->
						  			<td></td>
						  			<td><?= rupiah($sa['debit']) ?></td>
						  			<td><?= rupiah($sa['kredit']) ?></td>

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
					  			<td><?= rupiah($ju['debit']) ?></td>
					  			<td><?= rupiah($ju['kredit']) ?></td>
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
					  			
					  		</tr>
					  		
					  		<?php $index++; ?>
					  		<?php endforeach; ?>

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
					  			<td><?= rupiah($ju['debit']) ?></td>
					  			<td><?= rupiah($ju['kredit']) ?></td>
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
					  			<td><?= rupiah($ju['debit']); ?></td>
					  			<td><?= rupiah($ju['kredit']); ?></td>
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
					  			<td><?= rupiah($ju['debit']); ?></td>
					  			<td><?= rupiah($ju['kredit']); ?></td>
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
						  		<!-- 	<td><?= $sa['akun'] ?></td> -->
						  			<!-- <td><?= $sa['kode_akun'] ?></td> -->
						  			<td></td>
						  			<td><?= rupiah($sa['debit']) ?></td>
						  			<td><?= rupiah($sa['kredit']) ?></td>

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
					  			<td><?= rupiah($ju['debit']); ?></td>
					  			<td><?= rupiah($ju['kredit']); ?></td>
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
					  			<td><?= rupiah($ju['debit']); ?></td>
					  			<td><?= rupiah($ju['kredit']); ?></td>
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
					<!-- /tbody -->
				</table>
			</div>
	</div>
<?php else: ?>
<!-- tidak ada transaksi pada saldo awal saldo normal debit -->
<?php endif ?>
<?php endif ?>
<?php endforeach; ?>

</body></html>
