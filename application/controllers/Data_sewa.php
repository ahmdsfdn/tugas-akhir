<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_sewa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_ds');
		$this->load->model('Model_labarugi');
		$this->load->library('form_validation');
	}

	public function index()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}

		$data['judul']='Data Sewa';
		$data['active']='active';
		$data['status']=['L','BL'];
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		//$data['data_sewa']=$this->Model_ds->tampil_datasewa();
		$data['dd_bulan'] = $this->Model_labarugi->dd_bulan();
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/data_sewa/data_sewa.php',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');
	}

	public function data_kembali()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}
		$data['judul']='Data Sewa';
		$data['active']='active';
		$data['status']=['L','BL'];
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		//$data['data_sewa']=$this->Model_ds->tampil_datasewa();
		$data['dd_bulan'] = $this->Model_labarugi->dd_bulan();
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/data_sewa/data_kembali.php',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');
	}

	public function tambah_ds()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}

		$data['judul'] = 'Tambah Data Sewa';
		$data['active'] = 'active';
		$data['dd_kendaraan'] = $this->db->get('data_kendaraan')->result();
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$data['bukti_transaksi'] = $this->Model_ds->bukti_transaksi();
		$data['id_sewa'] = $this->Model_ds->id_sewa();

		$this->form_validation->set_rules('nama_penyewa','Nama Penyewa','required');
		$this->form_validation->set_rules('tgl_sewa','Tanggal Sewa','required');
		$this->form_validation->set_rules('tgl_kembali','Tanggal Kembali','required');
		//$this->form_validation->set_rules('biaya_sewa','Biaya Sewa','required');
		//$this->form_validation->set_rules('uang_muka','Uang Muka','required');
		//$this->form_validation->set_rules('bayar','Bayar','required');
		//$this->form_validation->set_rules('kendaraan','Kendaraan','required');

		if ($this->form_validation->run() == FALSE) {
		
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/data_sewa/tambah_ds',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

		} else {

		$data['tambah_datasewa']=$this->Model_ds->tambah_datasewa();
		$data['tambah_transaksi']=$this->Model_ds->tambah_transaksi_ds();
		redirect('data_sewa');

		}

	}

	public function get_kodeakun()
	{
		$akun=$this->input->post('akun');
		$data=$this->Model_ds->isi_field_byKode($akun);
		echo json_encode($data);
	}

	public function updatelunas($id_sewa)
	{
		$this->Model_ds->updatelunas($id_sewa);
			redirect('data_sewa');
	}



	public function hapusdata($id_sewa)
	{

		$this->Model_ds->hapusdata($id_sewa);

		redirect('data_sewa');
	}

	public function hapusdata_ju($id_sewa)
	{

		$this->Model_ds->hapusdata($id_sewa);

		redirect('admin/jurnal_umum');
	}

	public function update_ds($id_sewa)
	{	

		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}

		$data['judul'] = 'Ubah Data Sewa';
		$data['active'] = 'active';
		$data['dd_kendaraan'] = $this->db->get('data_kendaraan')->result();
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$data['bukti_transaksi'] = $this->Model_ds->bukti_transaksi();

		$data['d_sewa'] = $this->Model_ds->get_datasewa($id_sewa);
		$data['d_trans'] = $this->Model_ds->get_datatrans($id_sewa);


		$this->form_validation->set_rules('nama_penyewa','Nama Penyewa','required');
		$this->form_validation->set_rules('tgl_sewa','Tanggal Sewa','required');
		$this->form_validation->set_rules('tgl_kembali','Tanggal Kembali','required');
		//$this->form_validation->set_rules('biaya_sewa','Biaya Sewa','required');
		//$this->form_validation->set_rules('uang_muka','Uang Muka','required');
		//$this->form_validation->set_rules('bayar','Bayar','required');
		//$this->form_validation->set_rules('kendaraan','Kendaraan','required');

		

		if ($this->form_validation->run() == FALSE) {
		
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/data_sewa/update_ds',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

		} else {

			if (count($this->input->post('id')) == 5) {
				$this->Model_ds->update_5data($id_sewa);
			}
			elseif ($this->input->post('data2')) {
				$this->Model_ds->update_2data($id_sewa);
			}

			  else {
				$this->Model_ds->update_ds($id_sewa);
				$this->Model_ds->update_trans($id_sewa);
			}
		
		redirect('data_sewa');

		}
	}


	public function update_ju($id_sewa)
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}

		$data['judul'] = 'Ubah Data Sewa';
		$data['active'] = 'active';
		$data['dd_kendaraan'] = $this->db->get('data_kendaraan')->result();
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$data['bukti_transaksi'] = $this->Model_ds->bukti_transaksi();

		$data['d_sewa'] = $this->Model_ds->get_datasewa($id_sewa);
		$data['d_trans'] = $this->Model_ds->get_datatrans($id_sewa);


		$this->form_validation->set_rules('nama_penyewa','Nama Penyewa','required');
		$this->form_validation->set_rules('tgl_sewa','Tanggal Sewa','required');
		$this->form_validation->set_rules('tgl_kembali','Tanggal Kembali','required');
		//$this->form_validation->set_rules('biaya_sewa','Biaya Sewa','required');
		//$this->form_validation->set_rules('uang_muka','Uang Muka','required');
		//$this->form_validation->set_rules('bayar','Bayar','required');
		//$this->form_validation->set_rules('kendaraan','Kendaraan','required');

		

		if ($this->form_validation->run() == FALSE) {
		
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/data_sewa/update_ds',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

		} else {

			if (count($this->input->post('id')) == 5) {
				$this->Model_ds->update_5data($id_sewa);
			}
			elseif ($this->input->post('data2')) {
				$this->Model_ds->update_2data($id_sewa);
			}

			  else {
				$this->Model_ds->update_ds($id_sewa);
				$this->Model_ds->update_trans($id_sewa);
			}
		
		redirect('admin/jurnal_umum');

		}
	}

		public function cetak_ds()
	{
		$this->load->library('dompdf_gen');
		$data['status']=['L','BL'];
		$this->load->view('laporan/laporan_datasewa', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_datasewa.pdf", array('Attachment' => 0));
	}

		public function cetak_dk()
	{
		$this->load->library('dompdf_gen');
		$data['status']=['L','BL'];
		$this->load->view('laporan/laporan_datakembali', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_datakembali.pdf", array('Attachment' => 0));
	}

	
	// TAMBAH KENDARAAN

	function tambah_mobil()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}

		$data['judul'] = 'Tambah Mobil';
		$data['active'] = 'active';

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama','Nama Kendaraan','required');
		$this->form_validation->set_rules('plat','Plat Nomor','required');
		$data['data_kendaraan'] = $this->Model_ds->tampil_mobil();
		if ($this->form_validation->run() == FALSE) {
		
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/data_sewa/tambah_mobil',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

		} else {

		$this->Model_ds->tambah_mobil();

		redirect('data_sewa/tambah_mobil');

		}

	}
	

	function update_mobil($id)
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}
		$data['judul'] = 'Tambah Mobil';
		$data['active'] = 'active';

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama','Nama Kendaraan','required');
		$this->form_validation->set_rules('plat','Plat Nomor','required');

		$data['data_kendaraan'] = $this->Model_ds->tampil_mobil();

		if ($this->form_validation->run() == FALSE) {

		$data['d_mobil'] = $this->db->get_where('data_kendaraan',['id' => $id])->row_array();	
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/data_sewa/update_mobil',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

		} else {

		$this->Model_ds->update_mobil();
		redirect('data_sewa/tambah_mobil');

		}

	}

	function hapus_mobil ($id){
		$this->Model_ds->hapus_mobil($id);
		redirect('Data_sewa/tambah_mobil');
	}

}
