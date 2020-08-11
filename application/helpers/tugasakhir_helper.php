<?php 
if (!function_exists('hapus_min')) {
	
	function rupiah($angka){

		if ($angka < 0) {
			
			$result = preg_replace("/[^0-9]/", "", $angka);
			$rupiah = number_format($result,2,',','.');
			$hasil = "<div style='height: 100%;text-align: right;'>(Rp ".$rupiah.")</div>";
			
		} else {
			
			$rupiah = number_format($angka,2,',','.');
			$hasil = "<div style='height: 100%;text-align:right;'>Rp ".$rupiah."</div>";

		}
		
		return $hasil;
	}

	function rupiah_cetak($angka){

		if ($angka < 0) {
			
			$result = preg_replace("/[^0-9]/", "", $angka);
			$rupiah = number_format($result,2,',','.');
			$hasil = "<div class='rata-kanan'>(Rp ".$rupiah.")</div>";
			
		} else {
			
			$rupiah = number_format($angka,2,',','.');
			$hasil = "<div class='rata-kanan'>Rp ".$rupiah."</div>";

		}
		
		return $hasil;
	}
}

?>	