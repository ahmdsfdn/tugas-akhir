<?php  

/**
 * 
 */
class Model_pmodal extends CI_Model
{

	public function pos_ekuitas()
	{
		return $this->db->get_where('daftar_akun',['pos_akun' => 'Ekuitas'])->result_array();
	}

	public function total_labarugi($data)
	{	

		$pos_labarugi = [ [ 'pos_akun' => 'Pendapatan', 'saldo_normal' => 'Kredit'],[ 'pos_akun' => 'Beban', 'saldo_normal' => 'Debit'],[ 'pos_akun' => 'Pajak', 'saldo_normal' => 'Debit']];
 		
		foreach ($pos_labarugi as $pl) {

			if ($this->input->post('bulan_post') && $this->input->post('tahun_post')) 
			{	

				$date_akhir = date($data['tahun']."-".$data['bulan']."-d");

				$bulan = $data['bulan'];

				$dt_akhir = date("Y-m-d", strtotime("last day of $date_akhir"));

				$date_sa = $data['tahun'];
				$this->db->where('year(tanggal_transaksi)',$date_sa);
				$this->db->select('SUM(debit) as total');
				$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;
		
				$this->db->where('year(tanggal_transaksi)',$date_sa);
				$this->db->select('SUM(kredit) as total');
				$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$data['dk_awal_k']);
				$this->db->where('tanggal_transaksi <=',$dt_akhir);
				$this->db->select('SUM(debit) as total');
				$deb = $this->db->get_where('transaksi',['pos_akun' =>$pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$data['dk_awal_k']);
				$this->db->where('tanggal_transaksi <=',$dt_akhir);

				$this->db->select('SUM(kredit) as total');
				$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$debit = $sa_d + $deb;
				$kredit = $sa_k + $kre;
				
			
			} elseif ($this->input->post('tanggal_awal')) {

				$tgl_awal = $this->input->post('tanggal_awal');
				$tgl_akhir = $this->input->post('tanggal_akhir');

				$tahun_jika = date("Y",strtotime($tgl_awal));
				$bulan = date("m",strtotime($tgl_awal));

				if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

				$bulan = $data['bulan']=date('m',strtotime($tgl_awal));
				$tahun = $data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$dk_awal_k = $data['dk_awal_k'] = $this->input->post('tanggal_awal');
				// debit kredit awal kumulatif
				$dk_akhir_k = $data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

				$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(debit) as total');
				$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(kredit) as total');
				$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

  				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
				$this->db->select('SUM(debit) as total');
				$deb = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
				$this->db->select('SUM(kredit) as total');
				$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$debit = $sa_d + $deb;
				$kredit = $sa_k + $kre;

				}  elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
				
				$bulan = $data['bulan']=date('m',strtotime($tgl_awal));
				$data_bulan = $tgl_awal;
				$tahun = $data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$dk_awal_k = $data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
				// debit kredit awal kumulatif
				$dk_akhir_k = $data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
				
				$dk_awal_k1 = $data['dk_awal_k1'] = $this->input->post('tanggal_awal');
				
				$dk_akhir_k1 = $data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

					// total saldo awal
	  			$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(debit) as total');
				$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(kredit) as total');
				$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

	  				// data sebelum bulan post
	  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
		  		$this->db->select('SUM(debit) as total');
				$deb = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
				$this->db->select('SUM(kredit) as total');
				$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					// data bulan post
				$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
		  		$this->db->select('SUM(debit) as total');
				$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
				$this->db->select('SUM(kredit) as total');
				$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$debit = $deb + $deb_b + $sa_d;
				$kredit = $kre + $kre_b + $sa_k;
			
				} else {

				$bulan = $data['bulan']=date('m',strtotime($tgl_awal));
				$data_bulan = $data['bulan'];
				$data_kurang = $data['bulan'] - 1;
				$tahun = $data['tahun']= date('Y',strtotime($tgl_awal));

				// debit kredit awal kumulatif
				$dk_awal_k = $data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
				
				// debit kredit awal kumulatif
				$dk_akhir_k = $data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
				
				$dk_awal_k1 = $data['dk_awal_k1'] = $this->input->post('tanggal_awal');
				
				$dk_akhir_k1 = $data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

					// total saldo awal
	  			$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(debit) as total');
				$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('year(tanggal_transaksi)',$tahun);
	  			$this->db->select('SUM(kredit) as total');
				$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

	  				// data sebelum bulan post
	  			$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
		  		$this->db->select('SUM(debit) as total');
				$deb = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$dk_awal_k);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k);
				$this->db->select('SUM(kredit) as total');
				$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					// data bulan post
			if ($this->input->post('tanggal_awal')) {
					// data bulan post
				$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
		  		$this->db->select('SUM(debit) as total');
				$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('tanggal_transaksi >=',$dk_awal_k1);
				$this->db->where('tanggal_transaksi <=',$dk_akhir_k1);
				$this->db->select('SUM(kredit) as total');
				$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;	
			} else {
				$this->db->where('year(tanggal_transaksi)',$tahun);
				$this->db->where('month(tanggal_transaksi)',$bulan);
		  		$this->db->select('SUM(debit) as total');
				$deb_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

				$this->db->where('year(tanggal_transaksi)',$tahun);
				$this->db->where('month(tanggal_transaksi)',$bulan);
				$this->db->select('SUM(kredit) as total');
				$kre_b = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;
			}
				
				$debit = $deb + $deb_b + $sa_d;
				$kredit = $kre + $kre_b + $sa_k;

				}
				
			} else {

				if ($this->input->post('tahun_post')) {
					$date_sa = $this->input->post('tahun_post');
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(debit) as total');
					$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;
			
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(kredit) as total');
					$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

					$date = $this->input->post('tahun_post');
					$bulan = $data['bulan'];
					$this->db->where('year(tanggal_transaksi)',$date);
					
					$this->db->select('SUM(debit) as total');
					$deb = $this->db->get_where('transaksi',['pos_akun' =>$pl['pos_akun']])->row()->total;

					$this->db->where('year(tanggal_transaksi)',$date);
					
						$this->db->select('SUM(kredit) as total');
					$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					$debit = $sa_d + $deb;
					$kredit = $sa_k + $kre;
					
				} else {

					if ($data['bulan'] != 1) {

					$date_sa = date('Y');
				
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(debit) as total');
					$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;
			
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(kredit) as total');
					$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

					$date = date('Y');
					$bulan = $data['bulan'];
					$date_akhir = date($data['tahun']."-".$data['bulan']."-d");
					$dt_akhir = date("Y-m-d", strtotime("last day of $date_akhir"));

					$this->db->where('tanggal_transaksi >=',$data['dk_awal_k']);
					$this->db->where('tanggal_transaksi <=',$dt_akhir);
					$this->db->select('SUM(debit) as total');
					$deb = $this->db->get_where('transaksi',['pos_akun' =>$pl['pos_akun']])->row()->total;

					$this->db->where('tanggal_transaksi >=',$data['dk_awal_k']);
					$this->db->where('tanggal_transaksi <=',$dt_akhir);
					$this->db->select('SUM(kredit) as total');
					$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					$debit = $sa_d + $deb;
					$kredit = $sa_k + $kre;

					} else {

					$date_sa = date('Y');
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(debit) as total');
					$sa_d = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;
			
					$this->db->where('year(tanggal_transaksi)',$date_sa);
					$this->db->select('SUM(kredit) as total');
					$sa_k = $this->db->get_where('saldo_awal',['pos_akun' => $pl['pos_akun']])->row()->total;

					$date = date('Y');
					$bulan = $data['bulan'];
					$this->db->where('year(tanggal_transaksi)',$date);
					$this->db->where('month(tanggal_transaksi)',$bulan);
					$this->db->select('SUM(debit) as total');
					$deb = $this->db->get_where('transaksi',['pos_akun' =>$pl['pos_akun']])->row()->total;

					$this->db->where('year(tanggal_transaksi)',$date);
					$this->db->where('month(tanggal_transaksi)',$bulan);
						$this->db->select('SUM(kredit) as total');
					$kre = $this->db->get_where('transaksi',['pos_akun' => $pl['pos_akun']])->row()->total;

					$debit = $sa_d + $deb;
					$kredit = $sa_k + $kre;
					}
				}
				

				

			}
			
				if ($pl['saldo_normal'] == 'Kredit') {
					$jumlah[$pl['pos_akun']] =  $kredit - $debit;
				} else {
					$jumlah[$pl['pos_akun']] =  $debit + $kredit;
				}

			
		}
			
		$total_labarugi = $jumlah['Pendapatan'] - $jumlah['Beban'] - $jumlah['Pajak'];
		
		return $total_labarugi;
	}
}