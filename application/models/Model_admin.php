<?php 

/**
 * 
 */
class Model_admin extends CI_Model
{	
	public function tampil_jurnalumum()
	{	
	
		$this->db->where('year(tanggal_transaksi)', date('Y'));
		$this->db->where('month(tanggal_transaksi)', date('m'));
		
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get('transaksi')->result_array();
	}	

	public function getTransaksiById($bukti_transaksi)
	{
		return $this->db->get_where('transaksi',['bukti_transaksi' => $bukti_transaksi])->result_array();
	}

	// Tidak Terpakai 
	public function tambahTransaksi()
	{	


			$data = [
			"kode_akun" =>$this->input->post('kode_akun',true),
			"keterangan" =>$this->input->post('keterangan',true),
			"tanggal_transaksi" =>$this->input->post('tanggal_transaksi'),
			"pos_saldo" =>$this->input->post('pos_saldo',true),
			"pos_laporan" =>$this->input->post('pos_laporan',true),
			"bukti_transaksi" =>$this->input->post('bukti_transaksi',true),
			"akun" =>$this->input->post('akun',true),
			"debit" =>$this->input->post('debit',true),
			"kredit" =>$this->input->post('kredit',true),
			"pos_akun" =>$this->input->post('pos_akun',true)
			];	

			// if (!isset($data['debit'])) {
			// 	$data['debit'] = 0;
			// 	$data['kredit'] = $this->input->post('kredit');
			// } else if (isset($data['debit'])) {
			// 	$data['kredit'] = 0;
			// 	$data['debit'] = $this->input->post('debit');
			// }

			$this->db->insert('transaksi', $data);
	}

	public function hapusJurnalUmum($bukti_transaksi)
	{
		// $this->db->where('id',$id);
		// $this->db->delete('transaksi');

		// shortcut =>
		$this->db->delete('transaksi',['bukti_transaksi' => $bukti_transaksi]);
	}

	// Tidak Terpakai
	public function ubahTransaksi()
	{	

			$data = [
			"kode_akun" =>$this->input->post('kode_akun',true),
			"keterangan" =>$this->input->post('keterangan',true),
			"tanggal_transaksi" =>$this->input->post('tanggal_transaksi'),
			"pos_saldo" =>$this->input->post('pos_saldo',true),
			"pos_laporan" =>$this->input->post('pos_laporan',true),
			"bukti_transaksi" =>$this->input->post('bukti_transaksi',true),
			"akun" =>$this->input->post('akun',true),
			"debit" =>$this->input->post('debit',true),
			"kredit" =>$this->input->post('kredit',true),
			"pos_akun" =>$this->input->post('pos_akun',true)
			];	

			if (!isset($data['debit'])) {
				$data['debit'] = 0;
				$data['kredit'] = $this->input->post('kredit');
			} else if (isset($data['debit'])) {
				$data['kredit'] = 0;
				$data['debit'] = $this->input->post('debit');
			}

			$this->db->where('id',$this->input->post('id'));
			$this->db->update('transaksi', $data);
	
	}

	// Input Transaksi Multiple

	

	// DAFTAR AKUN

	public function ambil_dropdown(){
		return $this->db->get('daftar_akun')->result();
	}

	// DAFTAR AKUN END

	// koding untuk json encode mengisi field otomatis dengan mengecek kode_akun yg ada

	public function isi_field_byKode($kode_akun){
		$hsl=$this->db->query("SELECT * FROM daftar_akun WHERE kode_akun='$kode_akun'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kode_akun' => $data->kode_akun,
					'akun' => $data->akun,
					'pos_laporan' => $data->pos_laporan,
					'pos_akun' => $data->pos_akun
					);
			}
		} 
		return $hasil;
	}

	

	// ambil pencarian 
	public function cari_bulantahunjurnalumum(){
		
		$tahun_post = $this->input->post('tahun_post');
		$bulan_post = $this->input->post('bulan_post');
		$this->db->where('year(tanggal_transaksi)', $tahun_post);
		$this->db->where('month(tanggal_transaksi)', $bulan_post);	
	
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get('transaksi')->result_array();
	}

	public function cari_tahunjurnalumum(){
	
		$tahun_post = $this->input->post('tahun_post');
	
		$this->db->where('year(tanggal_transaksi)', $tahun_post);
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get('transaksi')->result_array();
	}

	public function cari_jurnalumum()
	{	
	
		$katakunci = $this->input->post('katakunci',true);
		$this->db->like('kode_akun',$katakunci);
		$this->db->or_like('bukti_transaksi',$katakunci);
		$this->db->or_like('pos_laporan',$katakunci);
		$this->db->or_like('debit',$katakunci);
		$this->db->or_like('kredit',$katakunci);
		$this->db->or_like('akun',$katakunci);
		$this->db->or_like('keterangan',$katakunci);
		
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get('transaksi')->result_array();
	}

	public function cari_tanggal_jurnalumum()
	{	
	
		$this->db->where('tanggal_transaksi >=',$this->input->post('tanggal_awal'));
		$this->db->where('tanggal_transaksi <=',$this->input->post('tanggal_akhir'));
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get('transaksi')->result_array();
	}

	// total sum debit dan kredit

	public function total_debit()
	{
		if ($this->input->post('katakunci')) {
		
			$katakunci = $this->input->post('katakunci',true);	
			$this->db->like('kode_akun',$katakunci);
			$this->db->or_like('bukti_transaksi',$katakunci);
			$this->db->or_like('pos_laporan',$katakunci);
			$this->db->or_like('debit',$katakunci);
			$this->db->or_like('kredit',$katakunci);
			$this->db->or_like('akun',$katakunci);
			$this->db->or_like('keterangan',$katakunci);
		
			$this->db->select('SUM(debit) as total');
			return $this->db->get('transaksi')->row()->total;

			
		} elseif ($this->input->post('tanggal_awal')) {
			
			$this->db->where('tanggal_transaksi >=',$this->input->post('tanggal_awal'));
			$this->db->where('tanggal_transaksi <=',$this->input->post('tanggal_akhir'));
			$this->db->select('SUM(debit) as total');
		return $this->db->get('transaksi')->row()->total;

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

		$month = $this->input->post('bulan_post');
		$tahun = $this->input->post('tahun_post');
		
		$this->db->where('month(tanggal_transaksi)',$month);
		$this->db->where('year(tanggal_transaksi)',$tahun);
		$this->db->select('SUM(debit) as total');
		return $this->db->get('transaksi')->row()->total;

		} elseif ($this->input->post('tahun_post')) {

		$tahun = $this->input->post('tahun_post');
		
		$this->db->where('year(tanggal_transaksi)',$tahun);
		$this->db->select('SUM(debit) as total');
		return $this->db->get('transaksi')->row()->total;

		} else {
			$month = date('m');
			$tahun = date('Y');
			$this->db->where('year(tanggal_transaksi)',$tahun);
			$this->db->where('month(tanggal_transaksi)',$month);
			$this->db->select('SUM(debit) as total');
			return $this->db->get('transaksi')->row()->total;
		}
		
	}

	public function total_kredit()
	{	
		if ($this->input->post('katakunci')) {
		
		
			$katakunci = $this->input->post('katakunci',true);
			
			$this->db->like('kode_akun',$katakunci);
			$this->db->or_like('bukti_transaksi',$katakunci);
			$this->db->or_like('pos_laporan',$katakunci);
			$this->db->or_like('debit',$katakunci);
			$this->db->or_like('kredit',$katakunci);
			$this->db->or_like('akun',$katakunci);
			$this->db->or_like('keterangan',$katakunci);
			
			$this->db->select('SUM(kredit) as total');
			return $this->db->get('transaksi')->row()->total;

		} elseif ($this->input->post('tanggal_awal')) {
		
		
		$this->db->where('tanggal_transaksi >=',$this->input->post('tanggal_awal'));
		$this->db->where('tanggal_transaksi <=',$this->input->post('tanggal_akhir'));
		$this->db->select('SUM(kredit) as total');
		return $this->db->get('transaksi')->row()->total;

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

		$month = $this->input->post('bulan_post');
		$tahun = $this->input->post('tahun_post');
		
		
		$this->db->where('month(tanggal_transaksi)',$month);
		$this->db->where('year(tanggal_transaksi)',$tahun);
		$this->db->select('SUM(debit) as total');
		return $this->db->get('transaksi')->row()->total;

		} elseif ($this->input->post('tahun_post')) {
			
		$tahun = $this->input->post('tahun_post');
		
		$this->db->where('year(tanggal_transaksi)',$tahun);
		$this->db->select('SUM(kredit) as total');
		return $this->db->get('transaksi')->row()->total;

		} else {

		$month = date('m');
		$tahun = date('Y');
		$this->db->where('year(tanggal_transaksi)',$tahun);
		$this->db->where('month(tanggal_transaksi)',$month);
		$this->db->select('SUM(kredit) as total');
		return $this->db->get('transaksi')->row()->total;

		}
	
	}

	

	public function dd_bulan()
	{
		$dd_bulan = [
			 '1' => ['angka' => '01',
			 		'bulan' => 'Januari'],
			 '2' => ['angka' => '02',
			 		'bulan' => 'Februari'],
			 '3' => ['angka' => '03',
			 		'bulan' => 'Maret'],
			 '4' => ['angka' => '04',
			 		'bulan' => 'April'],
			 '5' => ['angka' => '05',
			 		'bulan' => 'Mei'],
			 '6' => ['angka' => '06',
			 		'bulan' => 'Juni'],
			 '7' => ['angka' => '07',
			 		'bulan' => 'Juli'],
			 '8' => ['angka' => '08',
			 		'bulan' => 'Agustus'],
			 '9' => ['angka' => '09',
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

	public function bukti_transaksi() {
		
		$this->db->order_by('id','DESC');
		$this->db->limit(1);
		$query = $this->db->get('transaksi');
		$kode = $query->row_array();

		//print_r($kode);
		if ($query->num_rows() <> 0) {
			$data = $kode['bukti_transaksi'];
			$kode = intval($data)+1;
	
		} else
		{
			$kode=1;
		}

		$kodemax = str_pad($kode, 6,"0",STR_PAD_LEFT);// angka 4 menunjukan jumlah digit angka 0
		
		return $kodemax;
	}
} 

