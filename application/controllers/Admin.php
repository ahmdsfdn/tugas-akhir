<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_admin');
		$this->load->library('form_validation');

		
	}

	public function index()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}
		$data['judul']='Menu Utama';
		$data['active']='active';

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();//data pengguna yang login

		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('templates/adm_footer');
		// $this->load->view('templates/dash_footer');

	}

	//TRANSAKSI

	//tidak kepakek

	public function transaksi()
	{
		$data['judul']='Transaksi';
		$data['active']='active';
		$data['dd_kodeakun']=$this->Model_admin->ambil_dropdown();
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		//form validation, validasi data sebelum masuk ke database

		$this->form_validation->set_rules('kode_akun','Kode Akun','required');
		$this->form_validation->set_rules('akun','Akun','required');
		$this->form_validation->set_rules('keterangan','keterangan','required');
		$this->form_validation->set_rules('pos_saldo','Pos Saldo','required');
		$this->form_validation->set_rules('pos_laporan','Pos Laporan','required');
		$this->form_validation->set_rules('tanggal_transaksi','Tanggal Transaksi','required');
		$this->form_validation->set_rules('bukti_transaksi','Bukti Transaksi','required');

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/dash_header',$data);
			$this->load->view('templates/adm_sidebar',$data);
			$this->load->view('templates/adm_header',$data);
			$this->load->view('admin/master-data/transaksi',$data);
			$this->load->view('templates/adm_footer');
			$this->load->view('templates/dash_footer');
		} else {

			$this->Model_admin->tambahTransaksi();
			$this->session->set_flashdata('pesan_sukses','Ditambahkan');


			$this->load->view('templates/dash_header',$data);
			$this->load->view('templates/adm_sidebar',$data);
			$this->load->view('templates/adm_header',$data);
			$this->load->view('admin/master-data/transaksi',$data);
			$this->load->view('templates/adm_footer');
			$this->load->view('templates/dash_footer');
		}
	}

// finish transaksi bukan multi

// start transaksi multi input

	public function transaksi_m()
	{	

		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}
		$data['judul']='Transaksi';
		$data['active']='active';
		$data['dd_kodeakun']=$this->Model_admin->ambil_dropdown();

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$data['bukti_transaksi'] = $this->Model_admin->bukti_transaksi();
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/transaksi_multi',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

	}

	public function insert_transaksi_m()
	{
	
		//form validation, validasi data sebelum masuk ke database

		$this->form_validation->set_rules('kode_akun[]','Kode Akun','required');
		$this->form_validation->set_rules('debit[]','Debit','required');
		$this->form_validation->set_rules('kredit[]','Kredit','required');
		$this->form_validation->set_rules('keterangan[]','Keterangan','required');		
		$this->form_validation->set_rules('tanggal_transaksi[]','Tanggal Transaksi','required');
		$this->form_validation->set_rules('bukti_transaksi[]','Bukti Transaksi','required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan_error', validation_errors());

			redirect('admin/transaksi_m');
		} else {

			// mengambil data
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

			$data = array();

			$index = 0;
			foreach ($kode_akun as $datakd) { //membuat perulangan berdasarkan kodeakun
				array_push($data, array(
					'kode_akun' => $datakd,
					'keterangan' => $keterangan[$index],
					'tanggal_transaksi' => $tanggal_transaksi[$index],
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi[$index],
					'akun' => $akun[$index],
					'debit' => $debit[$index],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index],
					'ref' => 'JU'
				));
			$index++;
			}

					foreach ($data as $d ) {
						$jumlah[]=$d['debit'];
						$jumlahk[]=$d['kredit'];
					}

					$jumlahnya = array_sum($jumlah);
					$jumlahknya= array_sum($jumlahk);
					
					// end coba-coba 

					if ($jumlahnya == $jumlahknya) {

						// echo "Akun Balance";			
						// mengambil data
						
						$this->db->insert_batch('transaksi', $data); //fungsi untuk menimpan data multiple
						// print_r($data);
						$this->session->set_flashdata('pesan_sukses','Ditambahkan');
						$this->session->set_flashdata('pesan_balance','Sudah Balance');

						redirect('admin/transaksi_m');
					} else 
					{	
						$this->session->set_flashdata('pesan_error','Ditambahkan');
						$this->session->set_flashdata('pesan_tidakbalance','Tidak Balance');

						redirect('admin/transaksi_m');
					}			
		}	
	}

	// cari


	// end cari

	public function get_kodeakun()
	{
		$kode_akun=$this->input->post('kode_akun');
		$data=$this->Model_admin->isi_field_byKode($kode_akun);
		echo json_encode($data);
	}

	//End TRANSAKSI

	// UBAH TRANSAKSI

	public function ubahTransaksi($bukti_transaksi)
	// id didapat dari url kemudian dikirim ke model untuk dapat menampilkan data ke dalam field yang berada di view melalui controller
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}
		$data['dd_kodeakun']=$this->Model_admin->ambil_dropdown();
		$data['judul']='Ubah Transaksi';
		$data['active']='active';

		$data12 = $this->Model_admin->getTransaksiById($bukti_transaksi);
		
		$data['pos_saldo']=['Debit','Kredit'];
		$data['pos_laporan']=['Laporan Posisi Keuangan','Laba Rugi'];

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		
		//form validation, validasi data sebelum masuk ke database

		$this->form_validation->set_rules('kode_akun[]','Kode Akun','required');
		$this->form_validation->set_rules('akun[]','Akun','required');
		$this->form_validation->set_rules('keterangan[]','keterangan','required');
		$this->form_validation->set_rules('pos_saldo[]','Pos Saldo','required');
		$this->form_validation->set_rules('pos_laporan[]','Pos Laporan','required');
		$this->form_validation->set_rules('tanggal_transaksi[]','Tanggal Transaksi','required');
		$this->form_validation->set_rules('bukti_transaksi[]','Bukti Transaksi','required');

		if ($this->form_validation->run() == FALSE) {
			
			// foreach ($data12 as $d) {
			// 	$cob = $d['kode_akun'];
			// }

			// echo '<br>';
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

			// print_r($data1234[0][0]);
			// print_r($data1234);
			// echo $data_form[2]['akun'];
			
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

			$data['transaksi']= $dataform;

			$this->load->view('templates/dash_header',$data);
			$this->load->view('templates/adm_sidebar',$data);
			$this->load->view('templates/adm_header',$data);
			$this->load->view('admin/master-data/ubahtransaksi',$data);
			$this->load->view('templates/adm_footer');
			$this->load->view('templates/dash_footer');

		} else {

				// mengambil data
			
			// mengambil data

			$id = $_POST['id'];
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

			$data1 = array();

			$index = 0;
			
			foreach ($kode_akun as $datakd) { //membuat perulangan berdasarkan kodeakun
				array_push($data1, array(
					'id' => $id[$index],
					'kode_akun' => $datakd,
					'keterangan' => $keterangan[$index],
					'tanggal_transaksi' => $tanggal_transaksi[$index],
					'pos_saldo' => $pos_saldo[$index],
					'pos_laporan' => $pos_laporan[$index],
					'bukti_transaksi' => $bukti_transaksi[$index],
					'akun' => $akun[$index],
					'debit' => $debit[$index],
					'kredit' => $kredit[$index],
					'pos_akun' => $pos_akun[$index]
				));
			$index++;
			
			}
			foreach ($data1 as $d ) {
						$jumlah[]=$d['debit'];
						$jumlahk[]=$d['kredit'];
					}

					$jumlahnya = array_sum($jumlah);
					$jumlahknya= array_sum($jumlahk);
					
					// end coba-coba 

					if ($jumlahnya == $jumlahknya) {


						// echo "Akun Balance";			
						// mengambil data
						

						$this->db->update_batch('transaksi', $data1,'id'); //fungsi untuk menimpan data multiple
						// print_r($data);
						$this->session->set_flashdata('pesan_sukses','Diperbaharui');
						$this->session->set_flashdata('pesan_balance','Sudah Balance');

						redirect('admin/jurnal_umum');
					} else 
					{	
						$this->session->set_flashdata('pesan_error','Ditambahkan');
						$this->session->set_flashdata('pesan_tidakbalance','Tidak Balance');

						redirect('admin/jurnal_umum');
					}
		}	

	}


	public function hapusTransaksi($bukti_transaksi){
		$this->Model_admin->hapusJurnalUmum($bukti_transaksi);
		$this->session->set_flashdata('flash','Dihapus');
		redirect('admin/jurnal_umum');
	}

	// LAPORAN

	public function jurnal_umum()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} 
		$data['judul']='Jurnal Umum';
		$data['active']='active';
 
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['dd_bulan']=$this->Model_admin->dd_bulan();
	
		// cari jurnal umum tanggal dan tipe data

		if ($this->input->post('katakunci')) {
			$data['jurnal_umum'] =$this->Model_admin->cari_jurnalumum();

			$data['katakunci'] = $this->input->post('katakunci');
		

			$data['total_debit'] = $this->Model_admin->total_debit();
			$data['total_kredit'] = $this->Model_admin->total_kredit();
		} elseif ($this->input->post('tanggal_awal')) {
			$data['jurnal_umum'] =$this->Model_admin->cari_tanggal_jurnalumum();

			$data['tanggal_awal'] = $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
		

			$data['total_debit'] = $this->Model_admin->total_debit();
			$data['total_kredit'] = $this->Model_admin->total_kredit();

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

			$data['jurnal_umum'] = $this->Model_admin->cari_bulantahunjurnalumum();

			

			$bulan = $this->input->post('bulan_post');
			$data['bulan_nama'] = date("F", strtotime(date("Y")."-".$bulan."-01"));

			$data['total_debit'] = $this->Model_admin->total_debit();
			$data['total_kredit'] = $this->Model_admin->total_kredit();

		} elseif ($this->input->post('tahun_post')) {

			$data['jurnal_umum'] = $this->Model_admin->cari_tahunjurnalumum();

	

			$data['total_debit'] = $this->Model_admin->total_debit();
			$data['total_kredit'] = $this->Model_admin->total_kredit();

		} else {
			$bulan = date('m');
			$data['bulan_nama']= date("F", strtotime(date("Y")."-".$bulan."-01"));

			$data['jurnal_umum'] = $this->Model_admin->tampil_jurnalumum();
			$data['total_debit'] = $this->Model_admin->total_debit();
			$data['total_kredit'] = $this->Model_admin->total_kredit();
	
				
		}	

		    $this->load->view('templates/dash_header',$data);
			$this->load->view('templates/adm_sidebar',$data);
			$this->load->view('templates/adm_header',$data);
			$this->load->view('admin/master-data/laporan/jurnal_umum',$data);
			$this->load->view('templates/adm_footer');
			//$this->load->view('templates/dash_footer');
	}

	public function pdf(){
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}
		$this->load->library('dompdf_gen');

	if ($this->input->post('katakunci')) {
			$data['jurnal_umum'] =$this->Model_admin->cari_jurnalumum();

			$data['katakunci'] = $this->input->post('katakunci');
			

			$data['total_debit'] = $this->Model_admin->total_debit();
			$data['total_kredit'] = $this->Model_admin->total_kredit();
		} elseif ($this->input->post('tanggal_awal')) {
			$data['jurnal_umum'] =$this->Model_admin->cari_tanggal_jurnalumum();

			$data['tanggal_awal'] = $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');


			$data['total_debit'] = $this->Model_admin->total_debit();
			$data['total_kredit'] = $this->Model_admin->total_kredit();

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

			$data['jurnal_umum'] = $this->Model_admin->cari_bulantahunjurnalumum();

	
			$bulan = $this->input->post('bulan_post');
			$data['bulan_nama'] = date("F", strtotime(date("Y")."-".$bulan."-01"));

			$data['total_debit'] = $this->Model_admin->total_debit();
			$data['total_kredit'] = $this->Model_admin->total_kredit();

		} elseif ($this->input->post('tahun_post')) {

			$data['jurnal_umum'] = $this->Model_admin->cari_tahunjurnalumum();

	

			$data['total_debit'] = $this->Model_admin->total_debit();
			$data['total_kredit'] = $this->Model_admin->total_kredit();

		} else {
			$bulan = date('m');
			$data['bulan_nama']= date("F", strtotime(date("Y")."-".$bulan."-01"));

			$data['jurnal_umum'] = $this->Model_admin->tampil_jurnalumum();
			$data['total_debit'] = $this->Model_admin->total_debit();
			$data['total_kredit'] = $this->Model_admin->total_kredit();
		
				
		}

		$this->load->view('laporan/laporan_ju', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_jurnalumum.pdf", array('Attachment' => 0));
	}

	

	public function laba_rugi()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}
		
		$data['judul']='Laba Rugi';
		$data['active']='active';

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/laporan/laba_rugi',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');
	}

	// akhir laporan

	// DATA PROFIL

	public function profil()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} 
		$data['judul']='Profil';
		$data['active']='active';

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/profil',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');
	}

		public function edit_profil()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} 
		$data['judul']='Edit Profil';
		$data['active']='active';

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama', 'Nama','required|trim');

		if ($this->form_validation->run()==false) {
			$this->load->view('templates/dash_header',$data);
			$this->load->view('templates/adm_sidebar',$data);
			$this->load->view('templates/adm_header',$data);
			$this->load->view('admin/edit_profil',$data);
			$this->load->view('templates/adm_footer');
			$this->load->view('templates/dash_footer');
		} else {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');

			// cek jika ada gambar yang akan di upload
			$upload_image = $_FILES['gambar']['name'];

			if ($upload_image) {

				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('gambar')) {

					$old_image = $data['user']['gambar'];
					
					if ($old_image != 'default.jpg') {

						unlink(FCPATH . 'assets/img/profile/'. $old_image);
					
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('gambar', $new_image);
		
				} else {

					echo $this->upload->display_errors();

				}
			}



			$this->db->set('nama', $nama);
			$this->db->where('email',$email);
			$this->db->update('user');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Profil berhasil diubah ! </div>');
			redirect('admin/profil');
		}
		
	}

	public function ganti_password()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} 
		$data['judul']='Ganti Password';
		$data['active']='active';

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();//data pengguna yang login

		$this->form_validation->set_rules('passwordsekarang', 'Password Sekarang', 'required|trim');

		$this->form_validation->set_rules('passwordbaru', 'Password Baru', 'required|trim|min_length[6]|matches[ulangipassword]');

		$this->form_validation->set_rules('ulangipassword', 'Konfirmasi Password', 'required|trim|min_length[6]|matches[passwordbaru]');

		if ($this->form_validation->run() == false) {
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/ganti_password',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');	
		} else {
			$passwordsekarang = $this->input->post('passwordsekarang');
			$passwordbaru = $this->input->post('passwordbaru');
			if (!password_verify($passwordsekarang, $data['user']['password'])) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password Lama Salah</div>');
				redirect('admin/ganti_password');
			} else {
				if ($passwordsekarang == $passwordbaru) {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan yang baru</div>');
					redirect('admin/ganti_password');
				}else{

					// password mpun leres
					$password_hash = password_hash($passwordbaru, PASSWORD_DEFAULT);
					
					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');

					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password berhasil diganti</div>');
					redirect('admin/ganti_password');

				}

			}
		}
		
	}
}