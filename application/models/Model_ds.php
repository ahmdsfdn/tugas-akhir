<?php  

/**
 * 
 */
class Model_ds extends CI_Model
{	

	public function tampil_datasewa()
	{
		return $this->db->get_where('data_sewa')->result_array();
	}

	public function tambah_datasewa()
	{	

		if ($this->input->post('status') == 'L') {
			
			$tgl_lunas_post = $this->input->post('tgl_kembali');
			$bayar_post = $this->input->post('biaya_sewa');
			$uang_muka_post = '0.00';
		
		} else {
			$uang_muka_post = $this->input->post('uang_muka');
			$tgl_lunas_post = '0000-00-00';
			$bayar_post = '0.00';

		}

		$data = [
		"nama_penyewa" => $this->input->post('nama_penyewa'),
		"tgl_sewa" => $this->input->post('tgl_sewa'),
		"tgl_kembali" => $this->input->post('tgl_kembali'),
		"biaya_sewa" => $this->input->post('biaya_sewa'),
		"uang_muka" => $uang_muka_post,
		"bayar" => $bayar_post,
		"kendaraan" => $this->input->post('kendaraan'),
		"tgl_lunas" => $tgl_lunas_post,
		"status" => $this->input->post('status'),
		"id_sewa" => $this->input->post('id_sewa')
		];

		return $this->db->insert('data_sewa',$data);
		
	}

	public function tambah_transaksi_ds(){

			$kode_akun = $_POST['kode_akun'];
			$keterangan = $_POST['keterangan'];
			$tanggal_transaksi = $_POST['tanggal_transaksi'];
			$pos_saldo = $_POST['pos_saldo'];
			$pos_laporan = $_POST['pos_laporan'];
			$bukti_transaksi = $_POST['bukti_transaksi'];
			$akun = $_POST['akun'];
			$debit = $_POST['debit'];
			$kredit = $_POST['kredit'];
			$pos_akun = $_POST['pos_akun'];
			$id_sewa = $_POST['id_sewa'];

			$data_t = array();

			$index = 0;
			foreach ($akun as $datakd) { //membuat perulangan berdasarkan kodeakun
				if ($datakd == 'Piutang Usaha') {
					array_push($data_t, array(
					'kode_akun' => $kode_akun[$index],
					'keterangan' => "Sewa ".$keterangan[$index],
					'tanggal_transaksi' => $tanggal_transaksi[$index],
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi[$index],
					'akun' => $datakd,
					'debit' => $kredit[2] - $debit[0],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'id_sewa' => $id_sewa,
					'ref' => 'JU'
				));
				} else {
					array_push($data_t, array(
					'kode_akun' => $kode_akun[$index],
					'keterangan' => "Sewa ".$keterangan[$index],
					'tanggal_transaksi' => $tanggal_transaksi[$index],
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi[$index],
					'akun' => $datakd,
					'debit' => $debit[$index],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'id_sewa' => $id_sewa,
					'ref' => 'JU'
					));
				}
				
			$index++;
			}

			// print_r($data_t);
		return $this->db->insert_batch('transaksi', $data_t);
	}

	// update lunas dan ketika lunas di jurnal umum tambah transaksi kas pada piutang

	public function updatelunas($id_sewa)
	{

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

		$kodemax = str_pad($kode, 6,"0",STR_PAD_LEFT);


		$data = $this->db->get_where('data_sewa',['id_sewa' => $id_sewa])->row_array();
		//print_r($data);
		$tanggal_lunas_post = $this->input->post('tanggal_lunas');

		$data = [
		"nama_penyewa" => $data['nama_penyewa'],
		"tgl_sewa" => $data['tgl_sewa'],
		"tgl_kembali" => $data['tgl_kembali'],
		"biaya_sewa" => $data['biaya_sewa'],
		"uang_muka" =>$data['uang_muka'],
		"bayar" => $data['biaya_sewa'] - $data['uang_muka'],
		"kendaraan" => $data['kendaraan'],
		"tgl_lunas" => $tanggal_lunas_post,
		"status" => 'L'
		];

		$this->db->where('id_sewa',$id_sewa);
		$this->db->update('data_sewa',$data);

		// masuk ke ju

		$data_trans = $this->db->get_where('transaksi',['id_sewa' => $id_sewa])->result_array();

			$kode_akun = [$data_trans[0]['kode_akun'],$data_trans[1]['kode_akun']];
			$keterangan = [$data_trans[0]['keterangan'],$data_trans[1]['keterangan']];
			// $tanggal_transaksi = [$data_trans[0]['tanggal_transaksi'] = date('Y-m-d'),$data_trans[1]['tanggal_transaksi'] = date('Y-m-d')];
			$pos_saldo = [$data_trans[0]['pos_saldo'],$data_trans[1]['pos_saldo']];
			$pos_laporan = [$data_trans[0]['pos_laporan'],$data_trans[1]['pos_laporan']];
			$bukti_transaksi = $kodemax;
			$akun = [$data_trans[0]['akun'],$data_trans[1]['akun']];
			$debit = [$data_trans[1]['debit'],0];
			$kredit = [0,$data_trans[1]['debit']];
			$pos_akun = [$data_trans[0]['pos_akun'],$data_trans[1]['pos_akun']];
			$id_sewa = $data_trans[0]['id_sewa'];

			$data_t = array();

			$index = 0;
			foreach ($akun as $datakd) { //membuat perulangan berdasarkan kodeakun
					array_push($data_t, array(
					'kode_akun' => $kode_akun[$index],
					'keterangan' => $keterangan[$index],
					'tanggal_transaksi' =>  $tanggal_lunas_post,
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi,
					'akun' => $datakd,
					'debit' => $debit[$index],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'id_sewa' => $id_sewa,
					'ref' => 'JU'
				));
				
			$index++;
			}

		$this->db->insert_batch('transaksi', $data_t);
	}



	// DATA SEWA DAN JURNAL UMUM

	public function hapusdata($id_sewa){
		$this->db->delete('transaksi',['id_sewa' => $id_sewa]);
		$this->db->delete('data_sewa',['id_sewa' => $id_sewa]);
	}

	public function get_datasewa($id_sewa){
		$data = $this->db->get_where('data_sewa',['id_sewa' => $id_sewa])->row_array();
		return $data;

	}

	public function get_datatrans($id_sewa){
		$data = $this->db->get_where('transaksi',['id_sewa' => $id_sewa])->result_array();
		return $data;

	}

	public function update_ds($id_sewa)
	{	
		
		$data = [
		"nama_penyewa" => $this->input->post('nama_penyewa'),
		"tgl_sewa" => $this->input->post('tgl_sewa'),
		"tgl_kembali" => $this->input->post('tgl_kembali'),
		"biaya_sewa" => $this->input->post('biaya_sewa'),
		"uang_muka" => $this->input->post('uang_muka'),
		"bayar" => $this->input->post('bayar'),
		"kendaraan" => $this->input->post('kendaraan'),
		"tgl_lunas" => $this->input->post('tgl_lunas'),
		"status" => $this->input->post('status')
		];

		$this->db->where('id_sewa',$id_sewa);
		$this->db->update('data_sewa',$data);

	}

	public function update_trans($id_sewa){
			
			$id = $this->input->post('id');
			$kode_akun = $_POST['kode_akun'];
			$keterangan = $_POST['keterangan'];
			$tanggal_transaksi = $_POST['tanggal_transaksi'];
			$pos_saldo = $_POST['pos_saldo'];
			$pos_laporan = $_POST['pos_laporan'];
			$bukti_transaksi = $_POST['bukti_transaksi'];
			$akun = $_POST['akun'];
			$debit = $_POST['debit'];
			$kredit = $_POST['kredit'];
			$pos_akun = $_POST['pos_akun'];
			$id_sewa = $_POST['id_sewa'];

			$data_t = array();

			$index = 0;
			foreach ($akun as $datakd) { //membuat perulangan berdasarkan kodeakun
				if ($datakd == 'Piutang Usaha') {
					array_push($data_t, array(
					'id' => $id[$index],
					'kode_akun' => $kode_akun[$index],
					'keterangan' => "Sewa ".$keterangan[$index],
					'tanggal_transaksi' => $tanggal_transaksi[$index],
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi[$index],
					'akun' => $datakd,
					'debit' => $kredit[2] - $debit[0],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'id_sewa' => $id_sewa,
					'ref' => 'JU'
					
				));
				} else {
					array_push($data_t, array(
					'id' => $id[$index],
					'kode_akun' => $kode_akun[$index],
					'keterangan' => "Sewa ".$keterangan[$index],
					'tanggal_transaksi' => $tanggal_transaksi[$index],
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi[$index],
					'akun' => $datakd,
					'debit' => $debit[$index],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'id_sewa' => $id_sewa,
					'ref' => 'JU'
					));
				}
				
			$index++;
			}

		return $this->db->update_batch('transaksi', $data_t, 'id');
	}

	function update_2data($id_sewa)
	{	
			$this->db->delete('transaksi',['id_sewa' => $id_sewa]);
			$this->db->delete('data_sewa',['id_sewa' => $id_sewa]);

		if ($this->input->post('status') == 'L') {
			
			$tgl_lunas_post = $this->input->post('tgl_kembali');
			$bayar_post = $this->input->post('biaya_sewa');
			$uang_muka_post = '-';
		
		} else {
			$uang_muka_post = $this->input->post('uang_muka');
			$tgl_lunas_post = '-';
			$bayar_post = '-';

		}

		$data = [
		"nama_penyewa" => $this->input->post('nama_penyewa'),
		"tgl_sewa" => $this->input->post('tgl_sewa'),
		"tgl_kembali" => $this->input->post('tgl_kembali'),
		"biaya_sewa" => $this->input->post('biaya_sewa'),
		"uang_muka" => $uang_muka_post,
		"bayar" => $bayar_post,
		"kendaraan" => 'Avanza',
		"tgl_lunas" => $tgl_lunas_post,
		"status" => $this->input->post('status'),
		"id_sewa" => $this->input->post('id_sewa')
		];

		$this->db->insert('data_sewa',$data);
	
			$kode_akun = $_POST['kode_akun'];
			$keterangan = $_POST['keterangan'];
			$tanggal_transaksi = $_POST['tanggal_transaksi'];
			$pos_saldo = $_POST['pos_saldo'];
			$pos_laporan = $_POST['pos_laporan'];
			$bukti_transaksi = $_POST['bukti_transaksi'];
			$akun = $_POST['akun'];
			$debit = $_POST['debit'];
			$kredit = $_POST['kredit'];
			$pos_akun = $_POST['pos_akun'];
			$id_sewa = $_POST['id_sewa'];

			print_r($kode_akun);

			$data_t = array();

			$index = 0;
			foreach ($akun as $datakd) { //membuat perulangan berdasarkan kodeakun
				if ($datakd == 'Piutang Usaha') {
					array_push($data_t, array(
				
					'kode_akun' => $kode_akun[$index],
					'keterangan' => "Sewa ".$keterangan[$index],
					'tanggal_transaksi' => $tanggal_transaksi[$index],
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi[$index],
					'akun' => $datakd,
					'debit' => $kredit[2] - $debit[0],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'id_sewa' => $id_sewa,
					'ref' => 'JU'
				));
				} else {
					array_push($data_t, array(
	
					'kode_akun' => $kode_akun[$index],
					'keterangan' => "Sewa ".$keterangan[$index],
					'tanggal_transaksi' => $tanggal_transaksi[$index],
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi[$index],
					'akun' => $datakd,
					'debit' => $debit[$index],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'id_sewa' => $id_sewa,
					'ref' => 'JU'
					));
				}
				
			$index++;
			}

		return $this->db->insert_batch('transaksi', $data_t);
	}

	function update_5data($id_sewa)
	{
		
		$data = [
		"nama_penyewa" => $this->input->post('nama_penyewa'),
		"tgl_sewa" => $this->input->post('tgl_sewa'),
		"tgl_kembali" => $this->input->post('tgl_kembali'),
		"biaya_sewa" => $this->input->post('biaya_sewa'),
		"uang_muka" => $this->input->post('uang_muka'),
		"bayar" => $this->input->post('biaya_sewa') - $this->input->post('uang_muka'),
		"kendaraan" => $this->input->post('kendaraan'),
		"tgl_lunas" => $this->input->post('tgl_lunas'),
		"status" => 'L'
		];

		$this->db->where('id_sewa',$id_sewa);
		$this->db->update('data_sewa',$data);

		// masuk ke ju

			$tgl_012 = $this->input->post('tgl_sewa');
			$tgl_34 = $this->input->post('tgl_lunas');

			$bukti_012 = $this->input->post('bukti_ds');
			$bukti_34 = $this->input->post('bukti_lunas');

			$uang_muka = $this->input->post('uang_muka');
			$pj = $this->input->post('biaya_sewa');
			$piutang = $pj - $uang_muka;


			$kode_akun = $this->input->post('kode_akun');
			$keterangan = $this->input->post('keterangan')[0];
			$tanggal_transaksi = [$tgl_012,$tgl_012,$tgl_012,$tgl_34,$tgl_34];
			$pos_saldo = $this->input->post('pos_saldo');
			$pos_akun = $this->input->post('pos_akun');
			$pos_laporan = $this->input->post('pos_laporan');
			$akun = $this->input->post('akun');
			$bukti_transaksi = [$bukti_012,$bukti_012,$bukti_012,$bukti_34,$bukti_34];
			$debit = [$uang_muka,$piutang,0,$piutang,0];
			$kredit = [0,0,$pj,0,$piutang];
			$id = $this->input->post('id');

			$data_t = array();

			$index = 0;
			foreach ($akun as $datakd) { //membuat perulangan berdasarkan kodeakun
					array_push($data_t, array(
					'id' => $id[$index],
					'kode_akun' => $kode_akun[$index],
					'keterangan' => "Sewa  ".$keterangan,
					'tanggal_transaksi' => $tanggal_transaksi[$index],
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi[$index],
					'akun' => $datakd,
					'debit' => $debit[$index],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'id_sewa' => $id_sewa,
					'ref' => 'JU'
				));
			$index++;
			}

		$this->db->update_batch('transaksi', $data_t, 'id');
	}

	// END DATA SEWA DAN JURNAL UMMUM

	// UNTUK MENGISI DATA FORM DENGAN OTOMATIS

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

	public function id_sewa(){
		$this->db->order_by('id_sewa','DESC');
		$this->db->limit(1);
		$query = $this->db->get('data_sewa');
		$kode = $query->row_array();
		
		$kode_ids = $kode['id_sewa'];

		if ($query->num_rows() <> 0) {
			$data = $kode_ids;
			$kode = intval($data)+1;
		} else {
			$kode =1;
		}

		$kodemax = $kode;
		
		return $kodemax;
	}


	public function isi_field_byKode($akun){
		$hsl=$this->db->query("SELECT * FROM daftar_akun WHERE akun='$akun'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'akun' => $data->akun,
					'kode_akun' => $data->kode_akun,
					'pos_laporan' => $data->pos_laporan,
					'pos_akun' => $data->pos_akun
					);
			}
		} 
		return $hasil;
	}


	public function tambah_mobil()
	{
		$data = [
			'nama' => $this->input->post('nama'),
			'plat' => $this->input->post('plat')
		];

		return $this->db->insert('data_kendaraan',$data);
	}

	public function tampil_mobil(){
		return $this->db->get('data_kendaraan')->result_array();
	}

	public function update_mobil()
	{
		$data = [
			'nama' => $this->input->post('nama'),
			'plat' => $this->input->post('plat')
		];

		$this->db->where('id',$this->input->post('id'));
		$this->db->update('data_kendaraan',$data);
	}

	public function hapus_mobil($id)
	{
		return $this->db->delete('data_kendaraan',['id' => $id]);
	}
}