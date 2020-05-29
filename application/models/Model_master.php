<?php 

/**
 * 
 */
class Model_master extends CI_Model
{	



	public function tampil_daftarakun()
	{
		return $this->db->get('daftar_akun')->result_array();

	}

	public function getDaftarAkunById($kode_akun)
	{	
		return $this->db->get_where('daftar_akun',['kode_akun' => $kode_akun])->row_array();
	}

	public function tambahDaftarAkun()
	{	


			$data = [
			"kode_akun" =>$this->input->post('kode_akun',true),
			"akun" =>$this->input->post('akun',true),
			"pos_laporan" =>$this->input->post('pos_laporan',true),
			"pos_akun" => $this->input->post('pos_akun',true),
			"saldo_normal" => $this->input->post('saldo_normal',true)		
			];	

			$this->db->insert('daftar_akun', $data);

			// if (isset($data['pos_laporan'] == "Laporan Posisi Keuangan")) {
			// 	$data['debit'] = 0;
			// 	$data['kredit'] = $this->input->post('kredit');
			// } else if (isset($data['pos_laporan'] == "Laba Rugi")) {
			// 	$data['kredit'] = 0;
			// 	$data['debit'] = $this->input->post('debit');
			// }

			// if ($data['pos_laporan'] == 'Laporan Posisi Keuangan') {
			// 	$nr = $_POST['kode_nr'];
			// 	$data = ["kode_akun" => $this->input->post($nr,true)];
			// } else {
			// 	$lr = $_POST['kode_lr'];
			// 	$data = ["kode_akun" => $this->input->post($lr,true)];
			// }

			
	}

	public function hapusDaftarAkun($kode_akun)
	{
		// $this->db->where('id',$id);
		// $this->db->delete('transaksi');

		// shortcut =>

		$this->db->delete('daftar_akun',['kode_akun' => $kode_akun]);
	}

	public function ubahDaftarAkun()
	{	

			$data = [
			"kode_akun" =>$this->input->post('kode_akun',true),
			"akun" =>$this->input->post('akun',true),
			"pos_laporan" =>$this->input->post('pos_laporan',true),
			"pos_akun" => $this->input->post('pos_akun',true),
			"saldo_normal" => $this->input->post('saldo_normal',true)				
			];

			$this->db->where('kode_akun',$this->input->post('kode_akun'));
			$this->db->update('daftar_akun', $data);
	
	}


	public function cari_daftarakun(){
		$katakunci = $this->input->post('katakunci',true);
		$this->db->like('kode_akun',$katakunci);
		$this->db->or_like('akun',$katakunci);
		$this->db->or_like('pos_laporan',$katakunci);
		$this->db->or_like('pos_akun',$katakunci);
		
		return $this->db->get('daftar_akun')->result_array();
	}


	public function kode_al() {
		$kunci = '1-1';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
		$ambil_data = $query->row_array();
		$angka = $ambil_data['kode'];
		// mengambil angka dari variabel
	
		preg_match_all('!\d+!', $angka, $matches);
		// implode adalah perintah untuk menggabungkan array
		$kode = implode('', $matches[0]);
		// cek apakah data sudah ada di dalam database
		if ($query->num_rows() <> 0) {
			$data = $kode;
			$kode = intval($data)+1;
	
		} else
		{
			$kode=1;
		}

		$kodemax = str_pad($kode, 2,"0",STR_PAD_LEFT);// angka 4 menunjukan jumlah digit angka 0
		$kode_al = "1-1".$kodemax;
		return $kode_al;
	}

	public function kode_at() {
		$kunci = '1-2';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
		$ambil_data = $query->row_array();
		$angka = $ambil_data['kode'];
		preg_match_all('!\d+!', $angka, $matches);
		$kode = implode('', $matches[0]);
		
		if ($query->num_rows() <> 0) {
			$data = $kode;
			$kode = intval($data)+1;
		} else
		{
			$kode=1;
		}

		$kodemax = str_pad($kode, 2,"0", STR_PAD_LEFT);
		$kode_at = "1-2".$kodemax;
		return $kode_at;
	}

	public function kode_k() {
		$kunci = '2-';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
		$ambil_data = $query->row_array();
		$angka = $ambil_data['kode'];
		preg_match_all('!\d+!', $angka, $matches);
		$kode = implode('', $matches[0]);
		
		if ($query->num_rows() <> 0) {
			$data = $kode;
			$kode = intval($data)+1;
		} else
		{
			$kode=1;
		}

		$kodemax = str_pad($kode, 3,"0", STR_PAD_LEFT);
		$kode_k = "2-".$kodemax;
		return $kode_k;
	}

	public function kode_ek() {
		$kunci = '3-';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
		$ambil_data = $query->row_array();
		$angka = $ambil_data['kode'];
		preg_match_all('!\d+!', $angka, $matches);
		$kode = implode('', $matches[0]);
		
		if ($query->num_rows() <> 0) {
			$data = $kode;
			$kode = intval($data)+1;
		} else
		{
			$kode=1;
		}

		$kodemax = str_pad($kode, 3,"0", STR_PAD_LEFT);
		$kode_ek = "3-".$kodemax;
		return $kode_ek;
	}

	public function kode_p() {
		$kunci = '4-';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
		$ambil_data = $query->row_array();
		$angka = $ambil_data['kode'];
		preg_match_all('!\d+!', $angka, $matches);
		$kode = implode('', $matches[0]);
		
		if ($query->num_rows() <> 0) {
			$data = $kode;
			$kode = intval($data)+1;
		} else
		{
			$kode=1;
		}

		$kodemax = str_pad($kode, 3,"0", STR_PAD_LEFT);
		$kode_p = "4-".$kodemax;
		return $kode_p;
	}

	public function kode_b() {
		$kunci = '5-';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
		$ambil_data = $query->row_array();
		$angka = $ambil_data['kode'];
		preg_match_all('!\d+!', $angka, $matches);
		$kode = implode('', $matches[0]);
		
		if ($query->num_rows() <> 0) {
			$data = $kode;
			$kode = intval($data)+1;
		} else
		{
			$kode=1;
		}

		$kodemax = str_pad($kode, 3,"0", STR_PAD_LEFT);
		$kode_b = "5-".$kodemax;
		return $kode_b;
	}

	public function kode_pjk() {
		$kunci = '6-';
		$this->db->like('kode_akun',$kunci);
		$this->db->select('RIGHT(daftar_akun.kode_akun,2) as kode', FALSE);
		$this->db->order_by('kode_akun','DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_akun');
		$ambil_data = $query->row_array();
		$angka = $ambil_data['kode'];
		preg_match_all('!\d+!', $angka, $matches);
		$kode = implode('', $matches[0]);
		
		if ($query->num_rows() <> 0) {
			$data = $kode;
			$kode = intval($data)+1;
		} else
		{
			$kode=1;
		}

		$kodemax = str_pad($kode, 3,"0", STR_PAD_LEFT);
		$kode_pjk = "6-".$kodemax;
		return $kode_pjk;
	}

	// Saldo Awal

	public function tampil_saldo_bb()
	{	
		// tidak terpakai
		$data_tanggal = $this->db->get('transaksi')->result_array();
		
		//$tgl =  strtotime($data_tanggal[0]['tanggal_transaksi']);

		$year = date('Y');
		// echo "$year";
		if ($year == date('Y')) {
			$tahun2 = $year - 1;
		
			}
		$data_tgl = $this->db->get_where('transaksi',["year(tanggal_transaksi)" => $tahun2])->result_array();

		return $data_tgl;
		
	}

	public function tambah_saldoawal()
	{		
			$date_now = date($this->input->post('tahun').'-12-d');

			$tgl_post = date("Y-m-d", strtotime("last day of $date_now "));

			$data = [
			"kode_akun" =>$this->input->post('kode_akun',true),
			"keterangan" =>$this->input->post('keterangan',true),
			"tanggal_transaksi" =>$tgl_post,
			"pos_akun" =>$this->input->post('pos_akun',true),
			"pos_laporan" =>$this->input->post('pos_laporan',true),
			
			"akun" =>$this->input->post('akun',true),
			"debit" =>$this->input->post('debit',true),
			"kredit" =>$this->input->post('kredit',true)
			];	

			$this->db->insert('saldo_awal', $data);
	}

	public function hapusSaldoAwal($id)
	{
		// $this->db->where('id',$id);
		// $this->db->delete('transaksi');

		// shortcut =>

		$this->db->delete('saldo_awal',['id' => $id]);
	}

	public function ubahSaldoAwal()
	{		
			$date_now = date($this->input->post('tahun').'-12-d');
			
			$tgl_post = date("Y-m-d", strtotime("last day of $date_now "));

			$data = [
			"id" => $this->input->post('id', true),
			"kode_akun" =>$this->input->post('kode_akun',true),
			"keterangan" =>$this->input->post('keterangan',true),
			"tanggal_transaksi" =>$tgl_post,
			"pos_akun" =>$this->input->post('pos_akun',true),
			"pos_laporan" =>$this->input->post('pos_laporan',true),
			
			"akun" =>$this->input->post('akun',true),
			"debit" =>$this->input->post('debit',true),
			"kredit" =>$this->input->post('kredit',true)	
			];

			$this->db->where('id',$this->input->post('id'));
			$this->db->update('saldo_awal', $data);
	
	}

	public function getSaldoAwalById($id)
	{
		return $this->db->get_where('saldo_awal',['id' => $id])->row_array();
	}

	public function kas(){
		if ($this->input->post('tanggal_awal')) {
			$this->db->where('tanggal_transaksi >=',$this->input->post('tanggal_awal'));
			$this->db->where('tanggal_transaksi <=',$this->input->post('tanggal_akhir'));

		} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {
			$this->db->where('year(tanggal_transaksi)',$this->input->post('tahun_post'));
			$this->db->where('month(tanggal_transaksi)',$this->input->post('bulan_post'));
		} elseif ($this->input->post('tahun_post')) {
			$this->db->where('year(tanggal_transaksi)',$this->input->post('tahun_post'));
		} else {
			$this->db->where('year(tanggal_transaksi)',date("Y"));
			$this->db->where('month(tanggal_transaksi)',date("m"));
		}
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get_where('transaksi',['akun' => 'Kas'])->result_array();
	}


}

