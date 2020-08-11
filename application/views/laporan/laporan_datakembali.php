
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
			height: 100px;
			margin-left:auto; /* Digunakan untuk mengatur jarak header dengan tepian layar secara otomatis */
			margin-right:auto; /* Sehingga tampilan header website akan berada tepat di tengah-tengah layar monitor */
		}
	
</style><body>
	<div id="header">
				<h2 style="margin-top: 0px;">PT. Bagas Tetuko</h2>
				<h2 style="margin-top: 2px; margin-bottom: 0px;">Data Kendaraan Kembali</h2>
				<?php if ($this->input->post('tanggal_awal')): ?>
					<h4><?= $this->input->post('tanggal_awal') ?> s.d. <?= $this->input->post('tanggal_akhir') ?> </h4>
				<?php elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) : ?>
					<h4><?= date("F", strtotime(date("Y-".$this->input->post('bulan_post')."-01"))) ?> <?= $this->input->post('tahun_post') ?></h4>
				<?php elseif ($this->input->post('tahun_post')) : ?>
					<h4>Tahun <?= $this->input->post('tahun_post') ?></h4>
				<?php elseif ($this->input->post('katakunci')) : ?>
					<p><?= $this->input->post('katakunci') ?></p>
				<?php else: ?>
					<h4><?= date("F", strtotime(date("Y-m-01"))) ?> <?= date('Y') ?></h4>
				<?php endif ?>
				<!-- <h4 style="margin-top: 2px;">Tanggal : <?=$tanggal_awal;?> s.d. <?=$tanggal_akhir; ?> </h5> -->
				<hr style="background-color: #000; margin-bottom: 0px;">
	</div>	
	<?php 
 		$bulan_post = $this->input->post('bulan_post');
 		$tahun_post = $this->input->post('tahun_post');
 		$bulan = date('m');
 		$tahun = date('Y');

 		$tanggal_awal = $this->input->post('tanggal_awal');
 		$tanggal_akhir = $this->input->post('tanggal_akhir');

 	 ?>
 	<?php $ket_status = ['L' => 'Lunas', 'BL' => 'Belum Lunas']; ?>		
	<?php foreach ($status as $st) : ?>
 	
			<!-- Data Inputan -->
		
				<?php if ($this->input->post('bulan_post') && $this->input->post('tahun_post')): ?>
					<?php 
					$this->db->where('month(tgl_kembali)',$bulan_post);
					$this->db->where('year(tgl_kembali)',$tahun_post);
					$status_sewa = $this->db->get_where('data_sewa', ['status' => $st])->result_array(); ?>
				<?php elseif ($this->input->post('tahun_post')) : ?>
					<?php 
					$this->db->where('year(tgl_kembali)',$tahun_post);
					$status_sewa = $this->db->get_where('data_sewa', ['status' => $st])->result_array(); 
					?>
				<?php elseif ($this->input->post('tanggal_awal')) : ?>
					<?php 
					$this->db->where('tgl_kembali >=',$tanggal_awal);
					$this->db->where('tgl_kembali <=',$tanggal_akhir);
					$status_sewa = $this->db->get_where('data_sewa', ['status' => $st])->result_array();
				 	?>
				<?php elseif($this->input->post('katakunci')) : ?>
					<?php 
					$this->db->like('nama_penyewa',$this->input->post('katakunci'));
					$this->db->or_like('kendaraan',$this->input->post('katakunci'));
					$status_sewa = $this->db->get_where('data_sewa', ['status' => $st])->result_array(); ?>
				<?php else: ?>
					<?php 
					$this->db->where('month(tgl_kembali)', $bulan);
					$this->db->where('year(tgl_kembali)', $tahun);
					$status_sewa = $this->db->get_where('data_sewa', ['status' => $st])->result_array(); ?>
				<?php endif ?>
			<!-- End Data Inputan -->

			<div>
			<h2><?= $ket_status[$st]; ?></h2>
			
				<table style="margin-top: 10px;" cellspacing="0">
				  	<tr>
			   			<th>Kendaraan</th>
			   			<th>Nama Penyewa</th>
			   			<th>Tanggal Sewa</th>
			   			<th>Tanggal Kembali</th>
			   			<th >Biaya Sewa</th>
			   			<th>Uang Muka</th>

			   			<?php if ($st == 'BL'): ?>
			   				<!-- TABEL KOSONG -->
			   				
			   			<?php else : ?>
				   			<th >Bayar</th>
				   			<th>Tanggal Lunas</th>
			   			<?php endif; ?>
			   		</tr>
			   		<?php foreach ($status_sewa as $ss) : ?>
			   			<tr>
			   				<td><?= $ss['kendaraan']; ?></td>
			   				<td><?= $ss['nama_penyewa']; ?></td>
			   				<td><?= $ss['tgl_sewa']; ?></td>
			   				<td><?= $ss['tgl_kembali']; ?></td>
			   				<td><?= rupiah_cetak($ss['biaya_sewa']); ?></td>
			   				<td><?= rupiah_cetak($ss['uang_muka']); ?></td>
			   				<?php if ($st == 'BL') : ?>
				   			<!-- TABEL KOSONG -->
				   			<?php else : ?>
						   		<td><?= rupiah_cetak($ss['bayar']); ?></td>
				   				<td><?= $ss['tgl_lunas']; ?></td>
				   			<?php endif; ?>

			   				
			   			</tr>
					<?php endforeach ?>

				</table>
			</div>
	<?php endforeach ?>

</body></html>