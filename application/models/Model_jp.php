<?php  

/**
 * 
 */
class Model_jp extends CI_Model
{	

	public function tampil_jp()
	{
		$month = date('m');
		$tahun = date('Y');
		$this->db->where('month(tanggal_transaksi)',$month);
		$this->db->where('year(tanggal_transaksi)',$tahun);
		return $this->db->get_where('transaksi',['ref' => 'JP'])->result_array();
	}

	public function cari_tanggal_jp()
	{
		
		$this->db->where('tanggal_transaksi >=',$this->input->post('tanggal_awal'));
		$this->db->where('tanggal_transaksi <=',$this->input->post('tanggal_akhir'));
	
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get_where('transaksi',['ref' => 'JP'])->result_array();
	}

	public function cari_bulantahunjp(){
		
		$tahun_post = $this->input->post('tahun_post');
		$bulan_post = $this->input->post('bulan_post');
		$this->db->where('year(tanggal_transaksi)', $tahun_post);
		$this->db->where('month(tanggal_transaksi)', $bulan_post);	
	
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get_where('transaksi',['ref' => 'JP'])->result_array();
	}

	public function cari_tahunjp(){
	
		$tahun_post = $this->input->post('tahun_post');
	
		$this->db->where('year(tanggal_transaksi)', $tahun_post);
		$this->db->order_by('tanggal_transaksi', 'ASC');
		return $this->db->get_where('transaksi',['ref' => 'JP'])->result_array();
	}

	public function cari_jp()
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
		return $this->db->get_where('transaksi',['ref' => 'JP'])->result_array();
	}

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
			return $this->db->get_where('transaksi',['ref' => 'JP'])->row()->total;

			
		} elseif ($this->input->post('tanggal_awal')) {
			
			$this->db->where('tanggal_transaksi >=',$this->input->post('tanggal_awal'));
			$this->db->where('tanggal_transaksi <=',$this->input->post('tanggal_akhir'));
			$this->db->select('SUM(debit) as total');
		return $this->db->get_where('transaksi',['ref' => 'JP'])->row()->total;

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

		$month = $this->input->post('bulan_post');
		$tahun = $this->input->post('tahun_post');
		
		$this->db->where('month(tanggal_transaksi)',$month);
		$this->db->where('year(tanggal_transaksi)',$tahun);
		$this->db->select('SUM(debit) as total');
		return $this->db->get_where('transaksi',['ref' => 'JP'])->row()->total;

		} elseif ($this->input->post('tahun_post')) {

		$tahun = $this->input->post('tahun_post');
		
		$this->db->where('year(tanggal_transaksi)',$tahun);
		$this->db->select('SUM(debit) as total');
		return $this->db->get_where('transaksi',['ref' => 'JP'])->row()->total;

		} else {
			$month = date('m');
			$tahun = date('Y');
				$this->db->where('month(tanggal_transaksi)',$month);
			$this->db->where('year(tanggal_transaksi)',$tahun);
			$this->db->select('SUM(debit) as total');
			return $this->db->get_where('transaksi',['ref' => 'JP'])->row()->total;
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
			return $this->db->get_where('transaksi',['ref' => 'JP'])->row()->total;

		} elseif ($this->input->post('tanggal_awal')) {
		
		
		$this->db->where('tanggal_transaksi >=',$this->input->post('tanggal_awal'));
		$this->db->where('tanggal_transaksi <=',$this->input->post('tanggal_akhir'));
		$this->db->select('SUM(kredit) as total');
		return $this->db->get_where('transaksi',['ref' => 'JP'])->row()->total;

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

		$month = $this->input->post('bulan_post');
		$tahun = $this->input->post('tahun_post');
		
		
		$this->db->where('month(tanggal_transaksi)',$month);
		$this->db->where('year(tanggal_transaksi)',$tahun);
		$this->db->select('SUM(debit) as total');
		return $this->db->get_where('transaksi',['ref' => 'JP'])->row()->total;

		} elseif ($this->input->post('tahun_post')) {
			
		$tahun = $this->input->post('tahun_post');
		
		$this->db->where('year(tanggal_transaksi)',$tahun);
		$this->db->select('SUM(kredit) as total');
		return $this->db->get_where('transaksi',['ref' => 'JP'])->row()->total;

		} else {

		$month = date('m');
		$tahun = date('Y');
		$this->db->where('month(tanggal_transaksi)',$month);
		$this->db->where('year(tanggal_transaksi)',$tahun);
		$this->db->select('SUM(kredit) as total');
		return $this->db->get_where('transaksi',['ref' => 'JP'])->row()->total;

		}
	
	}

	public function tambah_jp()
	{
			$date_now = date($this->input->post('tahun').'-'.$this->input->post('bulan').'-d');

			$tgl_post = date("Y-m-d", strtotime("last day of $date_now "));

			$kode_akun = $_POST['kode_akun'];
			$keterangan = $_POST['keterangan_copy'];
			//$tanggal_transaksi = $_POST['tanggal_transaksi'];
			$pos_saldo = $_POST['pos_saldo'];
			$pos_laporan = $_POST['pos_laporan'];
			$bukti_transaksi = $_POST['bukti_copy'];
			$akun = $_POST['akun'];
			$debit = $_POST['debit'];
			$kredit = $_POST['kredit'];
			$pos_akun = $_POST['pos_akun'];

			$data = array();

			$index = 0;
			foreach ($kode_akun as $datakd) { //membuat perulangan berdasarkan kodeakun
				array_push($data, array(
					'kode_akun' => $datakd,
					'keterangan' => $keterangan,
					'tanggal_transaksi' => $tgl_post,
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi,
					'akun' => $akun[$index],
					'debit' => $debit[$index],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'ref' => 'JP'
				));
			$index++;
			}

		return $this->db->insert_batch('transaksi',$data);

	}

	public function update_jp()
	{		
			$date_now = date($this->input->post('tahun').'-'.$this->input->post('bulan').'-d');

			$tgl_post = date("Y-m-d", strtotime("last day of $date_now "));

			$id = $_POST['id'];			
			$kode_akun = $_POST['kode_akun'];
			$keterangan = $_POST['keterangan_copy'];
			//$tanggal_transaksi = $_POST['tanggal_transaksi'];
			$pos_saldo = $_POST['pos_saldo'];
			$pos_laporan = $_POST['pos_laporan'];
			$bukti_transaksi = $_POST['bukti_copy'];
			$akun = $_POST['akun'];
			$debit = $_POST['debit'];
			$kredit = $_POST['kredit'];
			$pos_akun = $_POST['pos_akun'];

			$data1 = array();

			$index = 0;
			
			foreach ($kode_akun as $datakd) { //membuat perulangan berdasarkan kodeakun
				array_push($data1, array(
					'id' => $id[$index],
					'kode_akun' => $datakd,
					'keterangan' => $keterangan,
					'tanggal_transaksi' => $tgl_post,
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi,
					'akun' => $akun[$index],
					'debit' => $debit[$index],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index]
				));
			$index++;
			
			}

		return $this->db->update_batch('transaksi',$data1,'id');
	}

	public function getdatajp($bukti_transaksi)
	{
		$data12 =  $this->db->get_where('transaksi',['bukti_transaksi' => $bukti_transaksi])->result_array();

		$data_form = array();
			
			foreach ($data12 as $key) {
				array_push($data_form, array(
					'id' => $key['id'], 
					'kode_akun' => $key['kode_akun'],
					'akun' => $key['akun'],
					'tanggal_transaksi' => $key['tanggal_transaksi'],
					'bukti_transaksi' => $key['bukti_transaksi'],
					'pos_saldo' => $key['pos_saldo'],
					'pos_laporan' => $key['pos_laporan'],
					'debit' => $key['debit'],
					'kredit' => $key['kredit'],
					'keterangan' => $key['keterangan'],
					'pos_akun' => $key['pos_akun']
				));
			
			}

			
			$new = count($data_form);
			// echo "$new";
			$data['data_count'] = $new;
			if ($new == 2) {
				$dataform = [
				'id' => [$data_form[0]['id'], $data_form[1]['id'],null,null],
				'kode_akun' => [$data_form[0]['kode_akun'], $data_form[1]['kode_akun'],null,null],
				'akun' => [$data_form[0]['akun'],$data_form[1]['akun'],null,null],
				'tanggal_transaksi' => [$data_form[0]['tanggal_transaksi'],$data_form[1]['tanggal_transaksi'],null,null],
				'bukti_transaksi' => [$data_form[0]['bukti_transaksi'],$data_form[1]['bukti_transaksi'],null,null],
				'pos_saldo' => [$data_form[0]['pos_saldo'],$data_form[1]['pos_saldo'],null,null],
				'pos_laporan' => [$data_form[0]['pos_laporan'],$data_form[1]['pos_laporan'],null,null],
				'debit' => [$data_form[0]['debit'],$data_form[1]['debit'],null,null],
				'keterangan' => [$data_form[0]['keterangan'],$data_form[1]['keterangan'],null,null],
				'kredit' => [$data_form[0]['kredit'],$data_form[1]['kredit'],null,null],
				'pos_akun' => [$data_form[0]['pos_akun'],$data_form[1]['pos_akun'],null,null]
				];
			} else if ($new == 3) {
				$dataform = [
				'id' => [$data_form[0]['id'], $data_form[1]['id'],$data_form[2]['id'],null],

				'kode_akun' => [$data_form[0]['kode_akun'], $data_form[1]['kode_akun'],$data_form[2]['kode_akun'],null],

				'akun' => [$data_form[0]['akun'],$data_form[1]['akun'],$data_form[2]['akun'],null],

				'tanggal_transaksi' => [$data_form[0]['tanggal_transaksi'],$data_form[1]['tanggal_transaksi'],$data_form[2]['tanggal_transaksi'],null],

				'bukti_transaksi' => [$data_form[0]['bukti_transaksi'],$data_form[1]['bukti_transaksi'],$data_form[2]['bukti_transaksi'],null],
				'pos_saldo' => [$data_form[0]['pos_saldo'],$data_form[1]['pos_saldo'],$data_form[2]['pos_saldo'],null],
				'pos_laporan' => [$data_form[0]['pos_laporan'],$data_form[1]['pos_laporan'],$data_form[2]['pos_laporan'],null],
				'debit' => [$data_form[0]['debit'],$data_form[1]['debit'],$data_form[2]['debit'],null],
				'keterangan' => [$data_form[0]['keterangan'],$data_form[1]['keterangan'],$data_form[2]['keterangan'],null],
				'kredit' => [$data_form[0]['kredit'],$data_form[1]['kredit'],$data_form[2]['kredit'],null],
				'pos_akun' => [$data_form[0]['pos_akun'],$data_form[1]['pos_akun'],$data_form[2]['pos_akun'],null]
				];

			} else if ($new == 4) {
				$dataform = [
				'id' => [$data_form[0]['id'], $data_form[1]['id'],$data_form[2]['id'],$data_form[3]['id']],

				'kode_akun' => [$data_form[0]['kode_akun'], $data_form[1]['kode_akun'],$data_form[2]['kode_akun'],$data_form[3]['kode_akun']],
				'akun' => [$data_form[0]['akun'],$data_form[1]['akun'],$data_form[2]['akun'],$data_form[3]['akun']],
				'tanggal_transaksi' => [$data_form[0]['tanggal_transaksi'],$data_form[1]['tanggal_transaksi'],$data_form[2]['tanggal_transaksi'],$data_form[3]['tanggal_transaksi']],
				'bukti_transaksi' => [$data_form[0]['bukti_transaksi'],$data_form[1]['bukti_transaksi'],$data_form[2]['bukti_transaksi'],$data_form[3]['bukti_transaksi']],
				'pos_saldo' => [$data_form[0]['pos_saldo'],$data_form[1]['pos_saldo'],$data_form[2]['pos_saldo'],$data_form[3]['pos_saldo']],
				'pos_laporan' => [$data_form[0]['pos_laporan'],$data_form[1]['pos_laporan'],$data_form[2]['pos_laporan'],$data_form[3]['pos_laporan']],
				'debit' => [$data_form[0]['debit'],$data_form[1]['debit'],$data_form[2]['debit'],$data_form[3]['debit']],
				'keterangan' => [$data_form[0]['keterangan'],$data_form[1]['keterangan'],$data_form[2]['keterangan'],$data_form[3]['keterangan']],
				'kredit' => [$data_form[0]['kredit'],$data_form[1]['kredit'],$data_form[2]['kredit'],$data_form[3]['kredit']],
				'pos_akun' => [$data_form[0]['pos_akun'],$data_form[1]['pos_akun'],$data_form[2]['pos_akun'],$data_form[3]['pos_akun']]
				];
			}

			return $dataform;
	}

	public function hapus_jp($bukti_transaksi)
	{
		$this->db->delete('transaksi',['bukti_transaksi' => $bukti_transaksi]);
	}
}