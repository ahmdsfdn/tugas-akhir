<?php  

/**
 * 
 */
class Model_bb extends CI_Model
{
	
	public function tampil_bukubesar()
	{
		$date = date('Y');
		$this->db->where('year(tanggal_transaksi)',$date);
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get_where('transaksi',['akun'])->result_array();

	}

	public function buku_besar()
	{
		$bulan = date('m');
		$tahun = date('Y');

		$data1 = $this->db->get_where('daftar_akun',['akun'])->result_array();


		if ($bulan != 1) {

			$bulan = $bulan-1;

			foreach ($data1 as $key ) {
				$data12[] = ['akun' => $key['akun']];
				
			}

	
			
			foreach ($data12 as $d12 ) {
				
				$this->db->where('month(tanggal_transaksi)',$bulan);
				$this->db->where('year(tanggal_transaksi)',$tahun);
				$sql =  $this->db->get_where('transaksi',['akun' => $d12['akun']])->result_array();

				$sql_sa = $this->db->get_where('saldo_awal',['akun' => $d12['akun']])->result_array();

				$count_data12 = count($sql);

				// echo $count_data12;
				if ($count_data12 != 0) {
					foreach ($sql as $key ) {
					// echo $key['akun'];
					$total[] = $key['debit'] - $key['kredit'] ;

					}
				} else {
					$total=0;
				}
				
				return $total;
			
			}

		}
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