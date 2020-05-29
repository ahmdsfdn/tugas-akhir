<?php  

/**
 * 
 */
class Model_labarugi extends CI_Model
{

	public function tampil_posakun()
	{
		return $this->db->get_where('daftar_akun',['pos_laporan' => 'Laba Rugi'])->result_array();
	}


	public function dd_bulan()
	{
		$dd_bulan = [
			 '1' => ['angka' => '1',
			 		'bulan' => 'Januari'],
			 '2' => ['angka' => '2',
			 		'bulan' => 'Februari'],
			 '3' => ['angka' => '3',
			 		'bulan' => 'Maret'],
			 '4' => ['angka' => '4',
			 		'bulan' => 'April'],
			 '5' => ['angka' => '5',
			 		'bulan' => 'Mei'],
			 '6' => ['angka' => '6',
			 		'bulan' => 'Juni'],
			 '7' => ['angka' => '7',
			 		'bulan' => 'Juli'],
			 '8' => ['angka' => '8',
			 		'bulan' => 'Agustus'],
			 '9' => ['angka' => '9',
			 		'bulan' => 'September'],
			 '10' => ['angka' => '10',
			 		'bulan' => 'Oktober'],
			 '11' => ['angka' => '11',
			 		'bulan' => 'November'],
			 '12' => ['angka' => '12',
			 		'bulan' => 'Desember']			
		];

		return $dd_bulan;
	}

	
}