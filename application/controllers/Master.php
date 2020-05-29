<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Model_master');
		$this->load->model('Model_admin');
		$this->load->model('Model_labarugi');
		$this->load->library('form_validation');
	}

	// DAFTAR AKUN

	public function index()
	{
		if (!$this->session->userdata('email')) {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} 
		$data['judul']='Daftar Akun';
		$data['active']='active';

		$data['daftar_akun']=$this->Model_master->tampil_daftarakun();
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();


		if ($this->input->post('katakunci')) {
			$data['daftar_akun']=$this->Model_master->cari_daftarakun();
		}

		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/daftar_akun',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

	}

	public function tambah_daftarakun()
	{
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}

		$data['judul']='Tambah Akun';
		$data['active']='active';
		$data['kode_al']=$this->Model_master->kode_al();
		$data['kode_at']=$this->Model_master->kode_at();
		$data['kode_k']=$this->Model_master->kode_k();
		$data['kode_p']=$this->Model_master->kode_p();
		$data['kode_ek']=$this->Model_master->kode_ek();
		$data['kode_b']=$this->Model_master->kode_b();
		$data['kode_pjk']=$this->Model_master->kode_pjk();


		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		
		$this->form_validation->set_rules('kode_akun','Kode Akun','required');
		$this->form_validation->set_rules('akun','Akun Perkiraan','required');

	
		if ($this->form_validation->run() ==  FALSE) {
		

		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/daftar_akun/tambah_daftarakun',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

		} else 
		{

		$this->session->set_flashdata('pesan_sukses','Ditambahkan');
		$this->Model_master->tambahDaftarAkun();
		redirect('master');
		}		

	}

	public function hapusDaftarAkun($kode_akun)
	{
		$this->Model_master->hapusDaftarAkun($kode_akun);
		$this->session->set_flashdata('pesan_sukses','Dihapus');
		redirect('master');
	}

	public function ubahDaftarAkun($kode_akun)
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}
		$data['judul']='Tambah Akun';
		$data['active']='active';
		$data['daftar_akun']=$this->Model_master->getDaftarAkunById($kode_akun);
		$data['pos_nr']=['Aset Lancar','Aset Tetap','Kewajiban','Ekuitas'];
		$data['pos_lr']=['Pendapatan','Beban','Pajak'];
		$data['kode_al']=$this->Model_master->kode_al();
		$data['kode_at']=$this->Model_master->kode_at();
		$data['kode_k']=$this->Model_master->kode_k();
		$data['kode_p']=$this->Model_master->kode_p();
		$data['kode_ek']=$this->Model_master->kode_ek();
		$data['kode_b']=$this->Model_master->kode_b();
		$data['kode_pjk']=$this->Model_master->kode_pjk();
	
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$data['pos_laporan']=['Laporan Posisi Keuangan','Laba Rugi'];
		
		$this->form_validation->set_rules('kode_akun','Kode Akun','required');
		$this->form_validation->set_rules('akun','Akun Perkiraan','required');

	
		if ($this->form_validation->run() ==  FALSE) {
		

		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/daftar_akun/ubah_daftarakun',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

		} else 
		{

		$this->session->set_flashdata('pesan_sukses','Diubah');
		$this->Model_master->ubahDaftarAkun();
		redirect('master');

		}
	}

	public function cetak_daftarakun()
	{	
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}
		$data['daftar_akun']=$this->Model_master->tampil_daftarakun();
		$this->load->view('laporan/laporan_daftarakun', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_daftarakun.pdf", array('Attachment' => 0));
	}
	// END DAFTAR AKUN

	// SALDO AWAL

		public function saldo_awal()
	{
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}
		$data['judul']='Master Data';
		$data['active']='active';

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		// echo "$tahun";
		// if ($tahun == date('Y')) {
		// 	$tahun2 = date('Y') - 1;	
		// }
		$data['bukber'] = $this->db->get_where('daftar_akun',['akun'])->result_array();
		//$data_coba = $this->Model_master->tampil_saldo_bb();
		
		// print_r($data_coba);
		
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);

		$this->load->view('admin/master-data/saldo_awal/saldoawal',$data);
		
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');
	}


	public function tambah_saldoawal()
	{	if (!$this->session->userdata('email')) {

		$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
		redirect('auth');
	} else {
		if($this->session->userdata('role_id') == '1'){
			redirect('admin');
		}
	}
		$data['judul']='Saldo Awal';
		$data['active']='active';
		$data['dd_kodeakun']=$this->Model_admin->ambil_dropdown();
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$data['bukber'] = $this->db->get_where('daftar_akun',['akun'])->result_array();

		//form validation, validasi data sebelum masuk ke database

		$this->form_validation->set_rules('kode_akun','Kode Akun','required');
		$this->form_validation->set_rules('akun','Akun','required');
		$this->form_validation->set_rules('keterangan','keterangan','required');
		
		$this->form_validation->set_rules('pos_laporan','Pos Laporan','required');
		


		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/dash_header',$data);
			$this->load->view('templates/adm_sidebar',$data);
			$this->load->view('templates/adm_header',$data);
			$this->load->view('admin/master-data/saldo_awal/tambah_saldoawal',$data);
			$this->load->view('templates/adm_footer');
			$this->load->view('templates/dash_footer');
		} else {

			$this->session->set_flashdata('pesan_sukses','Ditambahkan');
			$data['saldo_awal'] = $this->Model_master->tambah_saldoawal();		
			redirect('master/saldo_awal');


		}
	}

		public function hapusSaldoAwal($id)
	{
		$this->Model_master->hapusSaldoAwal($id);
		$this->session->set_flashdata('pesan_sukses','Dihapus');
		redirect('master/saldo_awal');
	}

	public function ubahSaldoAwal($id)
	{
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}
		$data['judul']='Ubah Saldo Awal';
		$data['active']='active';
		$data['saldo_awal']=$this->Model_master->getSaldoAwalById($id);
		$data['dd_kodeakun']=$this->Model_admin->ambil_dropdown();
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$data['pos_laporan']=['Laporan Posisi Keuangan','Laba Rugi'];
		
		$this->form_validation->set_rules('kode_akun','Kode Akun','required');
		$this->form_validation->set_rules('akun','Akun Perkiraan','required');

	
		if ($this->form_validation->run() ==  FALSE) {
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/saldo_awal/ubah_saldoawal',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

		} else 
		{
		$this->session->set_flashdata('pesan_sukses','Diubah');
		$this->Model_master->ubahSaldoAwal();
		redirect('master/saldo_awal');
		}
	}

	public function ubah_saldoawal(){
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '1'){
				redirect('admin');
			}
		}

		$this->session->set_flashdata('pesan_sukses','Diubah');
		$this->Model_master->ubahSaldoAwal();
		redirect('master/saldo_awal');
	}
	// END SALDO AWAL

	// START KAS MASUK DAN KELUAR

	public function kas_masuk()
	{
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} 
		$data['judul']='Kas Masuk';
		$data['active']='active';
		
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['nama_bulan'] = date('m');
		$data['tahun'] = date('y');
		$data['dd_bulan']=$this->Model_labarugi->dd_bulan();
	
		if ($this->input->post('tanggal_awal')) {
			$data['t_aw'] = $this->input->post('tanggal_awal');
			$data['t_ak'] = $this->input->post('tanggal_akhir');
		} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {
			$data['tahun_post'] = $this->input->post('tahun_post');
			$bulan = $this->input->post('bulan_post');
			$data['nama_bulan'] = date("F", strtotime(date("Y-".$bulan."-d")));
		} elseif ($this->input->post('tahun_post')) {
			$data['tahun'] = $this->input->post('tahun_post');
		} else {

			$data['tahun'] = date("Y");
			$data['nama_bulan']= date("F", strtotime(date("Y-m-d")));
		}

		$data['kas_masuk'] = $this->Model_master->kas();
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/laporan/kasmasuk',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');
	}

	public function cetakkasmasuk()
	{
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}
		$data['nama_bulan'] = date('m');
		$data['tahun'] = date('y');
	
		$this->load->library('dompdf_gen');

		if ($this->input->post('tanggal_awal')) {
			$data['t_aw'] = $this->input->post('tanggal_awal');
			$data['t_ak'] = $this->input->post('tanggal_akhir');
		} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {
			$data['tahun_post'] = $this->input->post('tahun_post');
			$bulan = $this->input->post('bulan_post');
			$data['nama_bulan'] = date("F", strtotime(date("Y-".$bulan."-d")));
		} elseif ($this->input->post('tahun_post')) {
			$data['tahun'] = $this->input->post('tahun_post');
		} else {

			$data['tahun'] = date("Y");
			$data['nama_bulan']= date("F", strtotime(date("Y-m-d")));
		}
		$data['kas_masuk'] = $this->Model_master->kas();
		$this->load->view('laporan/laporan_kasmasuk', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_kasmasuk.pdf", array('Attachment' => 0));
	}

	public function kas_keluar()
	{
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}
		$data['judul']='Kas Keluar';
		$data['active']='active';
		
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['nama_bulan'] = date('m');
		$data['tahun'] = date('y');
		$data['dd_bulan']=$this->Model_labarugi->dd_bulan();
	
		if ($this->input->post('tanggal_awal')) {
			$data['t_aw'] = $this->input->post('tanggal_awal');
			$data['t_ak'] = $this->input->post('tanggal_akhir');
		} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {
			$data['tahun_post'] = $this->input->post('tahun_post');
			$bulan = $this->input->post('bulan_post');
			$data['nama_bulan'] = date("F", strtotime(date("Y-".$bulan."-d")));
		} elseif ($this->input->post('tahun_post')) {
			$data['tahun'] = $this->input->post('tahun_post');
		} else {

			$data['tahun'] = date("Y");
			$data['nama_bulan']= date("F", strtotime(date("Y-m-d")));
		}

		$data['kas_keluar'] = $this->Model_master->kas();
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/laporan/kaskeluar',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');
	}

	public function cetakkaskeluar()
	{
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} 
		$data['nama_bulan'] = date('m');
		$data['tahun'] = date('y');
	
		$this->load->library('dompdf_gen');

		if ($this->input->post('tanggal_awal')) {
			$data['t_aw'] = $this->input->post('tanggal_awal');
			$data['t_ak'] = $this->input->post('tanggal_akhir');
		} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {
			$data['tahun_post'] = $this->input->post('tahun_post');
			$bulan = $this->input->post('bulan_post');
			$data['nama_bulan'] = date("F", strtotime(date("Y-".$bulan."-d")));
		} elseif ($this->input->post('tahun_post')) {
			$data['tahun'] = $this->input->post('tahun_post');
		} else {

			$data['tahun'] = date("Y");
			$data['nama_bulan']= date("F", strtotime(date("Y-m-d")));
		}
		$data['kas_keluar'] = $this->Model_master->kas();
		$this->load->view('laporan/laporan_kaskeluar', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_kaskeluar.pdf", array('Attachment' => 0));
	}
	
	

}