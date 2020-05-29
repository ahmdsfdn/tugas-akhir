<?php 
if (!function_exists('hapus_min')) {
	
	function rupiah($angka){

		if ($angka < 0) {
			
			$result = preg_replace("/[^0-9]/", "", $angka);
			$rupiah = number_format($result,2,',','.');
			$hasil = "("."Rp ".$rupiah.")";
			

		} else {
			
			$rupiah = number_format($angka,2,',','.');
			$hasil = "Rp ".$rupiah;
		}
		
		return $hasil;
	}
}

?>	