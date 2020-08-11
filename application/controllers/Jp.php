<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jp extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Model_jp');
		$this->load->model('Model_admin');
		$this->load->library('form_validation');
	}

	public function index()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}
		$data['judul']='Jurnal Penyesuaian';
		$data['active']='active';
	
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['dd_bulan'] = $this->Model_admin->dd_bulan();
		

		if ($this->input->post('katakunci')) {
			$data['tampil_jp'] =$this->Model_jp->cari_jp();

			$data['katakunci'] = $this->input->post('katakunci');
			$data['total_debit'] = $this->Model_jp->total_debit();
			$data['total_kredit'] = $this->Model_jp->total_kredit();
		} elseif ($this->input->post('tanggal_awal')) {
			$data['tampil_jp'] =$this->Model_jp->cari_tanggal_jp();

			$data['tanggal_awal'] = $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
		

			$data['total_debit'] = $this->Model_jp->total_debit();
			$data['total_kredit'] = $this->Model_jp->total_kredit();

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

			$data['tampil_jp'] = $this->Model_jp->cari_bulantahunjp();

			$bulan = $this->input->post('bulan_post');
			$data['bulan_nama'] = date("F", strtotime(date("Y")."-".$bulan."-01"));

			$data['total_debit'] = $this->Model_jp->total_debit();
			$data['total_kredit'] = $this->Model_jp->total_kredit();

		} elseif ($this->input->post('tahun_post')) {

			$data['tampil_jp'] = $this->Model_jp->cari_tahunjp();
			$data['total_debit'] = $this->Model_jp->total_debit();
			$data['total_kredit'] = $this->Model_jp->total_kredit();

		} else {
			$bulan = date('m');
			$data['bulan_nama']= date("F", strtotime(date("Y")."-".$bulan."-01"));

			$data['tampil_jp'] = $this->Model_jp->tampil_jp();
			$data['total_debit'] = $this->Model_jp->total_debit();
			$data['total_kredit'] = $this->Model_jp->total_kredit();		
		}	

		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/laporan/jurnal_penyesuaian',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');
	}

	public function tambah_jp()
	{
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda tidak bisa mengakses halaman ini</div>');
				redirect('admin');
			}
		}
		$data['judul']='posisi_keuangan';
		$data['active']='active';
	
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['bukti_transaksi'] = $this->Model_admin->bukti_transaksi();
		$data['dd_kodeakun']=$this->Model_admin->ambil_dropdown();
		$data['dd_bulan'] = $this->Model_admin->dd_bulan();


		$this->form_validation->set_rules('kode_akun[]','Kode Akun','required');
		$this->form_validation->set_rules('akun[]','Akun','required');
	
		$this->form_validation->set_rules('pos_saldo[]','Pos Saldo','required');
		$this->form_validation->set_rules('pos_laporan[]','Pos Laporan','required');
	

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dash_header',$data);
			$this->load->view('templates/adm_sidebar',$data);
			$this->load->view('templates/adm_header',$data);
			$this->load->view('admin/master-data/jp/tambah_jp',$data);
			$this->load->view('templates/adm_footer');
			$this->load->view('templates/dash_footer');
		} else {
			$this->Model_jp->tambah_jp();
			redirect('Jp');
		}

	
	}

	public function update_jp($bukti_transaksi)
	{
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda tidak bisa mengakses halaman ini</div>');
				redirect('admin');
			}
		}
		$data['judul']='posisi_keuangan';
		$data['active']='active';
	
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['bukti_transaksi'] = $this->Model_admin->bukti_transaksi();
		$data['dd_kodeakun']=$this->Model_admin->ambil_dropdown();
		$data['dd_bulan'] = $this->Model_admin->dd_bulan();
		$data['data_jp'] = $this->Model_jp->getdatajp($bukti_transaksi);

		$data['pos_saldo']=['Debit','Kredit'];
		$data['pos_laporan']=['Laporan Posisi Keuangan','Laba Rugi'];

		$this->form_validation->set_rules('kode_akun[]','Kode Akun','required');
		$this->form_validation->set_rules('akun[]','Akun','required');
		$this->form_validation->set_rules('pos_saldo[]','Pos Saldo','required');
		$this->form_validation->set_rules('pos_laporan[]','Pos Laporan','required');
		
		$data['data_count'] = count($this->db->get_where('transaksi',['bukti_transaksi' => $bukti_transaksi])->result_array());

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dash_header',$data);
			$this->load->view('templates/adm_sidebar',$data);
			$this->load->view('templates/adm_header',$data);
			$this->load->view('admin/master-data/jp/update_jp',$data);
			$this->load->view('templates/adm_footer');
			$this->load->view('templates/dash_footer');
		} else {
			$this->Model_jp->update_jp();
			redirect('Jp');
		}
	}

	public function hapus_jp($bukti_transaksi)
	{
		$this->Model_jp->hapus_jp($bukti_transaksi);
		redirect('Jp');
	}

	public function cetak_jp()
	{
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}
		
		$this->load->library('dompdf_gen');

	if ($this->input->post('katakunci')) {
			$data['tampil_jp'] =$this->Model_jp->cari_jp();

			$data['katakunci'] = $this->input->post('katakunci');
			$data['total_debit'] = $this->Model_jp->total_debit();
			$data['total_kredit'] = $this->Model_jp->total_kredit();
		} elseif ($this->input->post('tanggal_awal')) {
			$data['tampil_jp'] =$this->Model_jp->cari_tanggal_jp();

			$data['tanggal_awal'] = $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
		

			$data['total_debit'] = $this->Model_jp->total_debit();
			$data['total_kredit'] = $this->Model_jp->total_kredit();

		} elseif ($this->input->post('bulan_post') && $this->input->post('tahun_post')) {

			$data['tampil_jp'] = $this->Model_jp->cari_bulantahunjp();

			$bulan = $this->input->post('bulan_post');
			$data['bulan_nama'] = date("F", strtotime(date("Y")."-".$bulan."-01"));

			$data['total_debit'] = $this->Model_jp->total_debit();
			$data['total_kredit'] = $this->Model_jp->total_kredit();

		} elseif ($this->input->post('tahun_post')) {

			$data['tampil_jp'] = $this->Model_jp->cari_tahunjp();
			$data['total_debit'] = $this->Model_jp->total_debit();
			$data['total_kredit'] = $this->Model_jp->total_kredit();

		} else {
			$bulan = date('m');
			$data['bulan_nama']= date("F", strtotime(date("Y")."-".$bulan."-01"));

			$data['tampil_jp'] = $this->Model_jp->tampil_jp();
			$data['total_debit'] = $this->Model_jp->total_debit();
			$data['total_kredit'] = $this->Model_jp->total_kredit();		
		}

		$this->load->view('laporan/laporan_jp', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_jurnalpenyesuaian.pdf", array('Attachment' => 0));

	}
}