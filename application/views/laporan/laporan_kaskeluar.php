
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
				<h2 style="margin-top: 2px; margin-bottom: 0px;">Laporan Kas Keluar</h2>
				<?php if ($this->input->post('tanggal_awal')): ?>
					<h4><?= $this->input->post('tanggal_awal') ?> s.d. <?= $this->input->post('tanggal_akhir') ?> </h4>
				<?php elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) : ?>
					<h4><?= $nama_bulan ?> <?= $this->input->post('tahun_post') ?></h4>
				<?php elseif ($this->input->post('tahun_post')) : ?>
					<h4>Tahun <?= $this->input->post('tahun_post') ?></h4>
				<?php elseif ($this->input->post('katakunci')) : ?>
					<p><?= $this->input->post('katakunci') ?></p>
				<?php else: ?>
					<h4><?= $nama_bulan ?> <?= date('Y') ?></h4>
				<?php endif ?>
				<!-- <h4 style="margin-top: 2px;">Tanggal : <?=$tanggal_awal;?> s.d. <?=$tanggal_akhir; ?> </h5> -->
				<hr style="background-color: #000; margin-bottom: 0px;">
	</div>
	
			<div>
				<table cellspacing="0">
						<tr>
						  	<th>No</th>
						  	<th>Tanggal Transaksi</th>
						  	<th>Bukti Transaksi</th>
						  	<th>Keterangan</th>
						  	<th>Nominal</th>
						</tr>
				
					  		<?php $index = 1; ?>
					  		<?php foreach ($kas_keluar as $kk): ?>
					  			<?php if (empty($kk['kredit'])): ?>
										
					  				
					  			<?php else: ?>
					  				<?php if ($kk['kredit'] > 0): ?>
						  				<tr>
							  				<td><?= $index; ?></td>
							  				<td><?= $kk['tanggal_transaksi'] ?>
								  			<td><?= $kk['bukti_transaksi'] ?></td>
											<td><?= $kk['keterangan'] ?></td>
											<td><?= rupiah($kk['kredit']) ?></td>
											<?php $kredit[] = $kk['kredit']; ?>							
						  				</tr>
						  				<?php $index++ ?>
						  			<?php endif ?>	
					  			<?php endif ?>
						  						  		
					  		<?php endforeach ?>
					  				<tr>
						  				<td style="border: 0px;"></td>
						  				<td style="border: 0px;"></td>
						  				<td style="border: 0px;"></td>
						  				<td>Total</td>
						  				<?php if (!empty($kredit)) : ?>
						  					<td><?= rupiah(array_sum($kredit)); ?></td>
						  				<?php else : ?>
						  					<td><?= rupiah(0); ?></td>
						  				<?php endif; ?>
					  				</tr>
					  
				</table>
			</div>

</body></html>
