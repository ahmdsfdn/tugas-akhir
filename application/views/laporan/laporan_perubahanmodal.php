
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
 

  width: 800px;
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

h3 {
	text-align: center;
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
				<h2 style="margin-top: 2px; margin-bottom: 0px;">Laporan Perubahan Modal</h2>
					<?php if ($this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"><?= $nama_bulan?> <?= $tahun?></h3>
					<?php elseif ($this->input->post('tahun_post')) : ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"><?=  "Tahun ".$tahun; ?></h3>
					<?php elseif($this->input->post('tanggal_awal')) : ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"><?=  $this->input->post('tanggal_awal')." s.d ".$this->input->post('tanggal_akhir'); ?></h3>
					<?php else: ?>
						<h3 style="margin-top: 10px; margin-bottom: 0px;"><?= $nama_bulan?> <?= $tahun ?></h3>
					<?php endif ?>
				<hr style="background-color: #000; margin-bottom: 0px;">
	</div>
	
			<div>
				<table cellspacing="0">
				 			<?php $jumlah = array(); ?>
					  		<?php foreach ($pos_ekuitas as $pe ): ?>
					  			
					  			<?php 
						  			$tampil_data = $this->db->get_where('daftar_akun',['akun' => $pe['akun']])->result_array();
						  		
						  		// DATA SALDO AWAL
						 		$total_sa = array();

							  		foreach ($tampil_data as $td ) {
								  		if ($this->input->post('bulan_post') or $this->input->post('tahun_post') or $this->input->post('tanggal_awal')) {
								  			
											
												$date_sa = $tahun-1;
												$this->db->where('year(tanggal_transaksi)',$date_sa);
												$this->db->select('SUM(debit) as total');
												$debit = $this->db->get_where('saldo_awal',['akun' => $td['akun']])->row()->total;
										
												$this->db->where('year(tanggal_transaksi)',$date_sa);
												$this->db->select('SUM(kredit) as total');
												$kredit = $this->db->get_where('saldo_awal',['akun' => $td['akun']])->row()->total;
									

								  		} else {

								  			$date = date('Y')-1;
											$this->db->where('year(tanggal_transaksi)',$date);
								  			$this->db->select('SUM(debit) as total');
								  			$debit = $this->db->get_where('saldo_awal',['akun' => $td['akun']])->row()->total;

								  			$this->db->where('year(tanggal_transaksi)',$date);
								  			$this->db->select('SUM(kredit) as total');
								  			$kredit = $this->db->get_where('saldo_awal',['akun' => $td['akun']])->row()->total;

								  		}
							  			
								  			if ($td['saldo_normal'] == 'Kredit') {
								  				$total_sa = [ $td['akun'] => $kredit - $debit ];
								  			} else {
								  				// untuk menegatifkan prive
								  				$total_sa = [ $td['akun'] =>  $kredit - $debit];
								  			}
						  			
							  		}
							  			
					  		
						  		// PENJUMLAHAN AKUN TANPA SALDO AWAL
						  		$total_pa = array();

							  		foreach ($tampil_data as $td ) {

							  			if ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {
								  			
								  			if ($this->input->post('bulan_post') == 1) {

											$this->db->where('year(tanggal_transaksi)',$tahun);
											$this->db->where('month(tanggal_transaksi)',$bulan);
											$this->db->select('SUM(debit) as total');
											$debit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
									
											$this->db->where('year(tanggal_transaksi)',$tahun);
											$this->db->where('month(tanggal_transaksi)',$bulan);
											$this->db->select('SUM(kredit) as total');
											$kredit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

											} else {

											// HITUNGAN BULAN SEBELUM

											$this->db->where('tanggal_transaksi >=',$dk_awal_k);
											$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
											$this->db->select('SUM(debit) as total');
											$deb_kmrn = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
									
											$this->db->where('tanggal_transaksi >=',$dk_awal_k);
											$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
											$this->db->select('SUM(kredit) as total');
											$kre_kmrn = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

											// HITUNGAN BULAN INI

											$this->db->where('year(tanggal_transaksi)',$tahun);
											$this->db->where('month(tanggal_transaksi)',$bulan);
											$this->db->select('SUM(debit) as total');
											$deb_bln_ini = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
									
											$this->db->where('year(tanggal_transaksi)',$tahun);
											$this->db->where('month(tanggal_transaksi)',$bulan);
											$this->db->select('SUM(kredit) as total');
											$kre_bln_ini = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

											$debit = $deb_kmrn + $deb_bln_ini;
											$kredit = $kre_kmrn + $kre_bln_ini;

											}

								  		} elseif ($this->input->post('tanggal_awal')) {

									  			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {
									  			
												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(debit) as total');
												$debit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
										
												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kredit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;


									  			} else {

									  			// HITUNGAN RANGE SEBELUM

												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(debit) as total');
												$deb_kmrn = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
										
												$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
												$this->db->select('SUM(kredit) as total');
												$kre_kmrn = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

												// HITUNGAN RANGE INI INI

												
												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
												$this->db->select('SUM(debit) as total');
												$deb_bln_ini = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
										
												$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
												$this->db->select('SUM(kredit) as total');
												$kre_bln_ini = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

												$debit = $deb_kmrn + $deb_bln_ini;
												$kredit = $kre_kmrn + $kre_bln_ini;

									  			}
									  		} else {
								  		
								  		// JIKA TIDAK INPUT APAPUN MASIH ORIGINAL NIH

								  			if ($bulan == 1) {

								  				if ($this->input->post('tahun_post')) {
								  					// pencarian pertahun
								  					$this->db->where('year(tanggal_transaksi)',$tahun);
												
										  			$this->db->select('SUM(debit) as total');
										  			$debit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

										  			$this->db->where('year(tanggal_transaksi)',$tahun);
												
										  			$this->db->select('SUM(kredit) as total');
										  			$kredit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

								  				} else {
									  				$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
										  			$this->db->select('SUM(debit) as total');
										  			$debit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

										  			$this->db->where('year(tanggal_transaksi)',$tahun);
													$this->db->where('month(tanggal_transaksi)',$bulan);
										  			$this->db->select('SUM(kredit) as total');
										  			$kredit = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;
										  		}
								  			} else {

								  				// data yang dijumlah sebelum bulan ini
							  					$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									  			$this->db->select('SUM(debit) as total');
									  			$deb = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

								  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
												$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
									  			$this->db->select('SUM(kredit) as total');
									  			$kre = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

								  				// sesudah bulan ini
									  			$this->db->where('year(tanggal_transaksi)',$tahun);
												$this->db->where('month(tanggal_transaksi)',$bulan);
									  			$this->db->select('SUM(debit) as total');
									  			$deb_ssdh = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

									  			$this->db->where('year(tanggal_transaksi)',$tahun);
												$this->db->where('month(tanggal_transaksi)',$bulan);
									  			$this->db->select('SUM(kredit) as total');
									  			$kre_ssdh = $this->db->get_where('transaksi',['akun' => $td['akun']])->row()->total;

									  			$debit = $deb + $deb_ssdh;
									  			$kredit = $kre + $kre_ssdh;


								  			}
											
								  		}

							  			if ($td['saldo_normal'] == 'Kredit') {
							  				$total_pa = [ $td['akun'] => $kredit - $debit ];
							  			} else {
							  				// untuk menegatifkan prive
							  				$total_pa = [ $td['akun'] =>  $kredit - $debit];
							  			}
							  		}

						  			
					  				?>
					  			
					  			<tr>
					  				
					  				<td>
					  					<h3><?= $pe['akun']; ?></h3>
					  				</td>
					  				<td>
					  					<?php if ($pe['akun'] == 'Prive'): ?>
					  					<h3><?= rupiah($total_pa[$pe['akun']]); ?></h3>
					  					<?php else: ?>
					  					<h3><?= rupiah($total_pa[$pe['akun']] + $total_sa[$pe['akun']]) ; ?></h3>
					  					<?php endif ?>
					  					
					  				</td>
					  			</tr>

					  		<?php $jumlah[$pe['akun']] = $total_pa[$td['akun']] + $total_sa[$td['akun']];
					  			endforeach;  ?>
					  		<?php 
						  			//print_r($jumlah); ?>

					  			<tr>
					  				
					  				<td style="background-color: #000; color: #fff;font-weight: bold";>
					  					<h3 class="text-left">Jumlah</h3>
					  				</td>
					  				<td style="background-color: #000; color: #fff;font-weight: bold";>
			  				
					  						<?php $jumlah_ = array_sum($jumlah); ?>
				  					
					  					<h3 class="text-right"><?= rupiah($jumlah_); ?></h3>
					  				</td>
					  			</tr>
					  			<tr>
					  				
					  				<td>
					  					<h3 class="text-left">Laba Rugi</h3>
					  				</td>
					  				<td>
					  					<h3 class="text-right"><?= rupiah($total_labarugi); ?></h3>
					  				</td>
					  			</tr>
					  			<tr>
					  				
					  				<td style="background-color: #000; color: #fff;font-weight: bold;">
					  					<h3 class="text-left">Total Perubahan Modal</h3>
					  				</td>
					  				<td style="background-color: #000; color: #fff;font-weight: bold;">
					  					<h3 class="text-right"><?= rupiah($total_labarugi + $jumlah_); ?></h3>
					  				</td>
					  			</tr>
				
				</table>
			</div>

</body></html>
