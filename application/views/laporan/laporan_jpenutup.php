
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
.rata-kanan {
	text-align: right;
}
table {
 

  width: 600px;
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
  padding: 5px 10px;
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
			width:600px; /* Digunakan untuk mengatur lebar header */
			height: 150px;
			margin-left:auto; /* Digunakan untuk mengatur jarak header dengan tepian layar secara otomatis */
			margin-right:auto; /* Sehingga tampilan header website akan berada tepat di tengah-tengah layar monitor */
		}


</style><body>
	<div id="header">
				<h2 style="margin-top: 0px;">PT. Bagas Tetuko</h2>
				<h2 style="margin-top: 2px; margin-bottom: 0px;">Jurnal Penutup</h2>
					<?php if ($this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"><?= $nama_bulan?> <?= $tahun?></h3>
					<?php elseif ($this->input->post('tahun_post')) : ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"><?=  "Tahun ".$tahun; ?></h3>
					<?php elseif ($this->input->post('tanggal_awal')) : ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"><?= $this->input->post('tanggal_awal'); ?> s.d <?= $this->input->post('tanggal_akhir'); ?></h3>
					<?php else: ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"> <?= $tahun ?></h3>
					<?php endif ?>
				<hr style="background-color: #000; margin-bottom: 0px;">
	</div>
	
			<div>
				<table cellspacing="0">
				 
					
						  	<tr class="font-weight-bold">
						  		<th>Kode Akun</th>
						  		<th>Nama Akun</th>
						  		<th>Jumlah</th>
						  		<th>Total</th>
						  	</tr>
				
					<!-- AWAL SEMUA INI -->
			<!-- Jika Selain Januari -->
			<?php // $pos_akun = ['Pendapatan','Beban','Pajak']; ?>
			<?php if ($bulan != 1): ?>
					
					<?php $total_akhir = array(); ?>
					<?php foreach ($pos_akun as $pa): ?>
						
					
					
					  		<tr>
					  			<td style=""><strong><?php echo $pa; ?></strong></td>
					  			<td></td>
					  			<td></td>
					  			<td></td>
					  		</tr>
					

					  	<?php 

					  	$p_akun2 = $this->db->get_where('daftar_akun',['pos_akun' => $pa])->result_array(); ?>
					  	<!-- MENGHITUNG JUMLAH PER AKUN -->
					  	<?php $tot_pos = array(); ?>
						<?php foreach ($p_akun2 as $pa_n): ?>
						
						  	<?php

						  			// total saldo awal
						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

						  			// data sebelum bulan post
						  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
							  		$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

										// data bulan post
								if ($this->input->post('tanggal_awal')) {
										// data bulan post
									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;	
								} else {

										// data bulan post
									$this->db->where('year(tanggal_transaksi)',$tahun);
									$this->db->where('month(tanggal_transaksi)',$bulan);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun);
									$this->db->where('month(tanggal_transaksi)',$bulan);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								}

									$debit = $deb + $deb_b + $sa_d;
									$kredit = $kre + $kre_b + $sa_k;
						  	
									if ($pa_n['saldo_normal'] == 'Kredit') {
										$tot_pos[$pa_n['akun']] = $kredit - $debit  ;
									} else {
										$tot_pos[$pa_n['akun']] =  $debit - $kredit  ;
									}
									

						  	 ?>
						<?php endforeach; ?>

						<!-- MENGHITUNG JUMLAH PER POS AKUN -->
						<?php $tot_perpos = array(); ?>
						<?php foreach ($p_akun2 as $pa_n): ?>
						
						  	<?php
						  	 			// total saldo awal
						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

						  				// data sebelum bulan post
						  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
							  		$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

										// data bulan post
								if ($this->input->post('tanggal_awal')) {
										// data bulan post
									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;	
								} else {
									$this->db->where('year(tanggal_transaksi)',$tahun);
									$this->db->where('month(tanggal_transaksi)',$bulan);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun);
									$this->db->where('month(tanggal_transaksi)',$bulan);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;
								}

									$debit = $deb + $deb_b + $sa_d;
									$kredit = $kre + $kre_b + $sa_k;
						  	
						  		if ($pa_n['saldo_normal'] == 'Kredit') {
										$tot_perpos[$pa_n['pos_akun']] = $kredit - $debit;
									} else {
										$tot_perpos[$pa_n['pos_akun']] = $debit - $kredit;
									}

								

						  	 ?>
						<?php endforeach; ?>
		
					  	<?php

					  		$tampil = $this->db->get_where('daftar_akun',['pos_akun' => $pa])->result_array();
					  	?>
					
					  		<!-- MENAMPILKAN DATA TOTAL PER AKUN -->
					  		<?php foreach ($tampil as $tp): ?>
							<tr>
									<td><?= $tp['kode_akun']; ?></td>
									<td><?= $tp['akun']; ?></td>
									<td><?= rupiah_cetak($tot_pos[$tp['akun']]); ?></td>
									<td></td>
							</tr>
							<?php endforeach ?>
							<tr>
									<td></td>
									<td></td>
									<td style="background-color: #D7ECD9";>Jumlah Total</td>
									<!-- MENGINISIASI BAHWA TOT PERPOS HARUS 0 JIKA TIDAK ADA DATA -->
									<?php if (!empty($tot_perpos[$pa])): ?>
										<td style="background-color: #D7ECD9";><?= rupiah_cetak($tot_perpos[$pa]); ?></td>
									<?php else: ?>
										<td style="background-color: #D7ECD9";><?= rupiah_cetak($tot_perpos[$pa] = 0); ?></td>
									<?php endif ?>
									
							</tr>
				
					  	<?php $total_akhir[$pa] =  $tot_perpos[$pa] ;?>

					<?php endforeach ?>
			<?php else: ?>
			<!-- Jika Bulan Januari dan Tahun -->
					<?php $total_akhir = array(); ?>
					<?php foreach ($pos_akun as $pa): ?>
						
					
					  	
					  		<tr>
					  			<td style=""><strong><?php echo $pa; ?></strong></td>
					  			<td></td>
					  			<td></td>
					  			<td></td>
					  		</tr>
					  	

					  	<?php 

					  	$p_akun2 = $this->db->get_where('daftar_akun',['pos_akun' => $pa])->result_array(); ?>
					  	<!-- MENGHITUNG JUMLAH PER AKUN -->
					  	<?php $tot_pos = array(); ?>
						<?php foreach ($p_akun2 as $pa_n): ?>
							
						  	<?php
						  		// total saldo awal
						  	if ($this->input->post('tanggal_awal')) {
						  		
						  		if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

					  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

										$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$debit = $sa_d + $deb;
									$kredit = $sa_k + $kre;

						  		} else {

						  				// total saldo awal
						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

						  				// data sebelum bulan post
						  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
							  		$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

										// data bulan post
									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

									$debit = $deb + $deb_b + $sa_d;
									$kredit = $kre + $kre_b + $sa_k;

						  		}

						  	} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {
						  		
						  		$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								// $date = date('Y');
								$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;
						  	
						  	} elseif ($this->input->post('tahun_post')) {
						  		$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  		$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  		$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;
				
								$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;

						  	} else {

						  		$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['akun' => $pa_n['akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
								// $this->db->where('month(tanggal_transaksi)',$bulan);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								// $date = date('Y');
								$this->db->where('year(tanggal_transaksi)',$tahun);
								// $this->db->where('month(tanggal_transaksi)',$bulan);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['akun' => $pa_n['akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;
						  	}
						  		
								if ($pa_n['saldo_normal'] == 'Kredit') {
										$tot_pos[$pa_n['akun']] = $kredit - $debit   ;
									} else {
										$tot_pos[$pa_n['akun']] =  $debit - $kredit  ;
									}	

						  	 ?>
						<?php endforeach; ?>

						<!-- MENGHITUNG JUMLAH PER POS AKUN -->
						<?php $tot_perpos = array(); ?>
						<?php foreach ($p_akun2 as $pa_n): ?>
						
						  	<?php

						  	if ($this->input->post('tanggal_awal')) {
						  		
						  		if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

					  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

										$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$debit = $sa_d + $deb;
									$kredit = $sa_k + $kre;

						  		} else {

						  				// total saldo awal
						  			$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(debit) as total');
									$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('year(tanggal_transaksi)',$tahun-1);
						  			$this->db->select('SUM(kredit) as total');
									$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

						  				// data sebelum bulan post
						  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
							  		$this->db->select('SUM(debit) as total');
									$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									$this->db->select('SUM(kredit) as total');
									$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

										// data bulan post
									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
							  		$this->db->select('SUM(debit) as total');
									$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
									$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
									$this->db->select('SUM(kredit) as total');
									$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

									$debit = $deb + $deb_b + $sa_d;
									$kredit = $kre + $kre_b + $sa_k;

						  		}

						  	} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {
						  		
						  		$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								// $date = date('Y');
								$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->where('month(tanggal_transaksi)',$bulan);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;
						  	
						  	} elseif ($this->input->post('tahun_post')) {

						  	 	$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;
				
								$this->db->where('year(tanggal_transaksi)',$tahun);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;

						  	} else {
						  		
						  		$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(debit) as total');
								$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$this->db->where('year(tanggal_transaksi)',$tahun-1);
					  			$this->db->select('SUM(kredit) as total');
								$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pa_n['pos_akun']])->row()->total;

						  		$this->db->where('year(tanggal_transaksi)',$tahun);
								// $this->db->where('month(tanggal_transaksi)',$bulan);
						  		$this->db->select('SUM(debit) as total');
								$deb = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								// $date = date('Y');
								$this->db->where('year(tanggal_transaksi)',$tahun);
								// $this->db->where('month(tanggal_transaksi)',$bulan);
								$this->db->select('SUM(kredit) as total');
								$kre = $this->db->get_where('transaksi',['pos_akun' => $pa_n['pos_akun']])->row()->total;

								$debit = $sa_d + $deb;
								$kredit = $sa_k + $kre;
						  	}

								if ($pa_n['saldo_normal'] == 'Kredit') {
										$tot_perpos[$pa_n['pos_akun']] = $kredit - $debit;
									} else {
										$tot_perpos[$pa_n['pos_akun']] = $debit - $kredit;
									}

						  	 ?>
						<?php endforeach; ?>
		
					  	<?php

					  		$tampil = $this->db->get_where('daftar_akun',['pos_akun' => $pa])->result_array();
					  	?>
					
					  		<?php if ($pa == 'Beban'): ?>
					  			<tr>
									<td></td>
									<td>Ikhtisar Laba Rugi</td>
									
									<?php if (!empty($tot_perpos[$pa])): ?>
									
										<td><?= rupiah_cetak($tot_perpos[$pa]); ?></td>
										<td></td>	
										
										
									<?php else: ?>
										<td><?= rupiah_cetak($tot_perpos[$pa] = 0); ?></td>
										<td></td>
									<?php endif ?>
									
								</tr>
					  			<?php foreach ($tampil as $tp): ?>
								<tr>
										<td><?= $tp['kode_akun']; ?></td>
										<td><?= $tp['akun']; ?></td>
										<?php if ($pa == 'Beban'): ?>	
											<td></td>
											<td><?= rupiah_cetak($tot_pos[$tp['akun']]); ?></td>
										<?php else: ?>
											<td><?= rupiah_cetak($tot_pos[$tp['akun']]); ?></td>
											<td></td>
										<?php endif ?>
										
								</tr>
								<?php endforeach ?>
								
					  		<?php else: ?>
					  			<?php foreach ($tampil as $tp): ?>
								<tr>
										<td><?= $tp['kode_akun']; ?></td>
										<td><?= $tp['akun']; ?></td>
										<?php if ($pa == 'Beban'): ?>	
											<td></td>
											<td><?= rupiah_cetak($tot_pos[$tp['akun']]); ?></td>
										<?php else: ?>
											<td><?= rupiah_cetak($tot_pos[$tp['akun']]); ?></td>
											<td></td>
										<?php endif ?>
										
								</tr>
								<?php endforeach ?>
					  			<?php if ($pa == 'Saldo Laba'): ?>
									<?php $tot_perpos[$pa] = 0 ?>
								<?php else: ?>
									<tr>
									<td></td>
									
										<td>Ikhtisar Laba Rugi</td>
								
									
									<?php if (!empty($tot_perpos[$pa])): ?>
									
										
										<td></td>	
										<td><?= rupiah_cetak($tot_perpos[$pa]); ?></td>
										
									<?php else: ?>
										
										

										
											<td></td>	
											<td><?= rupiah_cetak($tot_perpos[$pa] = 0); ?></td>
										
										
									<?php endif ?>
									
								</tr>
								<?php endif ?>
					  		<?php endif ?>
					  		
					 
					  	<?php $total_akhir[$pa] =  $tot_perpos[$pa] ;?>

					<?php endforeach; ?>
			<?php endif; ?>
			
							
							
							<?php  
							$saldo_laba = $total_akhir['Pendapatan'] - $total_akhir['Beban']; ?>
							<?php if ($saldo_laba > 0): ?>
								
								<tr>
										<td></td>
										<td>Ikhtisar Laba Rugi</td>
										<td style="text-align: right; "><?= rupiah_cetak($saldo_laba); ?></td>
										<td></td>
								</tr>
								<tr>
										<td></td>
										<td>Saldo Laba</td>
										<td></td>
										<td><?= rupiah_cetak($saldo_laba); ?></td>
										
								</tr>
							<?php else: ?>
								<tr>
										<td></td>
										<td>Saldo Laba</td>
										<td><?= rupiah_cetak($saldo_laba * -1); ?></td>
										<td></td>
										
								</tr>
								<tr>
										<td></td>
										<td>Ikhtisar Laba Rugi</td>
										<td></td>
										<td><?= rupiah_cetak($saldo_laba * -1); ?></td>
								</tr>
							<?php endif ?>
								
								
						
				
				</table>
			</div>

</body></html>
