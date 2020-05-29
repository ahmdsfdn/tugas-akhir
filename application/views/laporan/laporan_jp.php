
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
 text-align: center;
}
table {
 

  width: 1000px;
  border-collapse: collapse;
  margin-left:auto; /* Digunakan untuk mengatur jarak header dengan tepian layar secara otomatis */
  margin-right:auto; /* Sehingga tampilan header website akan berada tepat di tengah-tengah layar monitor */
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

 
table tr {

}

h4 {
	margin-top: 5px;
	margin-bottom: 5px;
}

#header{
			font-family: Arial, Helvetica, sans-serif;
			width:900px; /* Digunakan untuk mengatur lebar header */
			height: 150px;
			margin-left:auto; /* Digunakan untuk mengatur jarak header dengan tepian layar secara otomatis */
			margin-right:auto; /* Sehingga tampilan header website akan berada tepat di tengah-tengah layar monitor */
		}
	
</style><body>
	<div id="header">
				<h2 style="margin-top: 0px;">PT. Bagas Tetuko</h2>
				<h2 style="margin-top: 2px; margin-bottom: 0px;">Jurnal Penyesuaian</h2>
				<?php if ($this->input->post('tanggal_awal')): ?>
					<h4><?= $this->input->post('tanggal_awal') ?> s.d. <?= $this->input->post('tanggal_akhir') ?> </h4>
				<?php elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) : ?>
					<h4><?= $bulan_nama ?> <?= $this->input->post('tahun_post') ?></h4>
				<?php elseif ($this->input->post('tahun_post')) : ?>
					<h4>Tahun <?= $this->input->post('tahun_post') ?></h4>
				<?php elseif ($this->input->post('katakunci')) : ?>
					<p><?= $this->input->post('katakunci') ?></p>
				<?php else: ?>
					<h4><?= $bulan_nama ?> <?= date('Y') ?></h4>
				<?php endif ?>
				<!-- <h4 style="margin-top: 2px;">Tanggal : <?=$tanggal_awal;?> s.d. <?=$tanggal_akhir; ?> </h5> -->
				<hr style="background-color: #000; margin-bottom: 0px;">
	</div>
	
			<div>
				<table cellspacing="0">
				  
					<tr>
							<th width="10%">Tanggal</th>
							<th width="10%">Bukti Transaksi</th>
							<th width="20%">Keterangan</th>
							<th  width="20%">Akun</th>
							<th  width="10%">Kode Akun</th>
							<th  width="15%">Debit</th>
							<th  width="15%">Kredit</th>
					</tr>
					
				 
						<?php $data_b = 'AWDJ@asjdAWI'; ?>
							<?php foreach ($tampil_jp as $ju ) : ?>
						
								<tr class="text-center">		
									<?php if ($ju['bukti_transaksi'] == $data_b): ?>
							  			<td width="20%" style="border-top: 0px; border-bottom: 0px;"></td>
							  			<td width="10%" style="border-top: 0px; border-bottom: 0px;"></td>
							  			<td width="20%" style="border-top: 0px; border-bottom: 0px;"></td>
								  		<td width="20%"><?= $ju['akun'] ?></td> 
								  		<td width="10%"><?= $ju['kode_akun'] ?></td>
								  		<?php if ($ju['debit'] == 0): ?>
									  		<td width="15%"></td>
									  	<?php else: ?>
									  		<td width="15%"><?= rupiah($ju['debit']) ?></td>
									  	<?php endif ?>
								  		
								  		<?php if ($ju['kredit'] == 0): ?>
									  		<td width="15%"></td>
									  	<?php else: ?>
									  		<td width="15%"><?= rupiah($ju['kredit']) ?></td>
									  	<?php endif ?>
								  	<?php else : ?>
								  		<?php $data_b = $ju['bukti_transaksi'];  ?>

								  		<td width="20%" style="border-bottom: 0px;"><?= $ju['tanggal_transaksi']?></td>
							  			<td width="10%" style="border-bottom: 0px;"><?= $ju['bukti_transaksi'] ?></td>
							  			<td width="20%" style="border-bottom: 0px;"><?= $ju['keterangan'] ?></td>
								  		<td width="20%"><?= $ju['akun'] ?></td> 
								  		<td width="10%"><?= $ju['kode_akun'] ?></td>
								  		<?php if ($ju['debit'] == 0): ?>
									  		<td  width="15%"></td>
									  	<?php else: ?>
									  		<td  width="15%"><?= rupiah($ju['debit']); ?></td>
									  	<?php endif ?>
								  		
								  		<?php if ($ju['kredit'] == 0): ?>
									  		<td  width="15%"></td>
									  	<?php else: ?>
									  		<td  width="15%"><?= rupiah($ju['kredit']); ?></td>
									  	<?php endif ?>
									
											  		
									<?php endif ?>  			
								</tr>
						
							<?php endforeach; ?>
							<tr>
					  			<td style="border-bottom: 0px; border-left: 0px;border-right: 0px;"></td>
					  			<td style="border-bottom: 0px; border-left: 0px;border-right: 0px;"></td>
					  			<td style="border-bottom: 0px; border-left: 0px;border-right: 0px;"></td>
					  			<td style="border-bottom: 0px; border-left: 0px;border-right: 0px;"></td>
					  			<td>Total</td>
					  				<?php if (!empty($totaljp_d)): ?>
						  			<td><?= rupiah($total_debit); ?></td>
						  			<td><?= rupiah($total_kredit); ?></td>
					  			<?php else: ?>
						  			<td><?= rupiah($total_debit) ;?></td>
						  			<td><?= rupiah($total_kredit) ; ?></td>	
					  			<?php endif ?>
					  			
					  		</tr>
			
				</table>
			</div>

</body></html>
