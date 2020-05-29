<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Labarugi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Model_labarugi');
		$this->load->model('Model_admin');
		$this->load->library('form_validation');

		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}
	}

	public function index()
	{	
		
		$data['judul']='Laba Rugi';
		$data['active']='active';
		$data['p_akun']=$this->Model_labarugi->tampil_posakun();
		$data['pos_akun']=['Pendapatan','Beban','Pajak'];
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$data['dd_bulan']=$this->Model_labarugi->dd_bulan();
		
		if ($this->input->post('tanggal_awal')) {

			$tgl_awal = $this->input->post('tanggal_awal');
			$tgl_akhir = $this->input->post('tanggal_akhir');
			
			$tahun_jika = date("Y",strtotime($tgl_awal));
			$bulan = date("m",strtotime($tgl_awal));
	
			$data['tahun_jika'] = $tahun_jika;

			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = $this->input->post('tanggal_awal');
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

			} elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
			
			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $tgl_awal;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');
		
			} else {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $data['bulan'];
			$data_kurang = $data['bulan'] - 1;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
			
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			}
			
		} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {		
			$data['tahun']=$this->input->post('tahun_post');
			$data['bulan']=$this->input->post('bulan_post');

			$tahun_post = $this->input->post('tahun_post');
			$bulan_post = $this->input->post('bulan_post');
			
			$bulan2 = $bulan_post - 1;
			$tanggal_inti = date($tahun_post."-".$bulan_post."-"."d");

			$data['nama_bulan']= date("F", strtotime(date("Y")."-".$bulan_post."-01"));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

		} elseif ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');

		} else {

			$data['bulan'] = date('m');
			$data['tahun'] = date('Y');

			$bulan = date('m');
			$tahun = date('Y');

			$data['nama_bulan']= date("F", strtotime(date("Y")."-".$bulan."-01"));

			if ($data['bulan'] != 1) {
				$bulan2 = $bulan - 1;
				$tanggal_inti = date($tahun."-".$bulan."-"."d");
				$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));
			}
			

		}

		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/laporan/laba_rugi',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');
	}

	public function cetak_lr()
	{	

		$data['p_akun']=$this->Model_labarugi->tampil_posakun();
		$data['pos_akun']=['Pendapatan','Beban','Pajak'];
	
		$this->load->library('dompdf_gen');
		
		if ($this->input->post('tanggal_awal')) {

			$tgl_awal = $this->input->post('tanggal_awal');
			$tgl_akhir = $this->input->post('tanggal_akhir');
			
			$tahun_jika = date("Y",strtotime($tgl_awal));
			$bulan = date("m",strtotime($tgl_awal));
	
			$data['tahun_jika'] = $tahun_jika;

			if ($this->input->post('tanggal_awal') == date($tahun_jika.'-01-01')) {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = $this->input->post('tanggal_awal');
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = $this->input->post('tanggal_akhir');

			} elseif (date("m",strtotime($this->input->post('tanggal_awal'))) == '1') {
			
			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $tgl_awal;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');
		
			} else {

			$data['bulan']=date('m',strtotime($tgl_awal));
			$data_bulan = $data['bulan'];
			$data_kurang = $data['bulan'] - 1;
			$data['tahun']= date('Y',strtotime($tgl_awal));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("first day of $data_bulan-$data_kurang"));
			
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tgl_awal -1 day"));
			
			$data['dk_awal_k1'] = $this->input->post('tanggal_awal');
			
			$data['dk_akhir_k1'] = $this->input->post('tanggal_akhir');

			}
			
		} elseif ($this->input->post('tahun_post') && $this->input->post('bulan_post')) {		
			$data['tahun']=$this->input->post('tahun_post');
			$data['bulan']=$this->input->post('bulan_post');

			$tahun_post = $this->input->post('tahun_post');
			$bulan_post = $this->input->post('bulan_post');
			
			$bulan2 = $bulan_post - 1;
			$tanggal_inti = date($tahun_post."-".$bulan_post."-"."d");

			$data['nama_bulan']= date("F", strtotime(date("Y")."-".$bulan_post."-01"));

			// debit kredit awal kumulatif
			$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
			// debit kredit awal kumulatif
			$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));

		} elseif ($this->input->post('tahun_post')) {

			$data['bulan'] = 1;
			$data['tahun'] = $this->input->post('tahun_post');

		} else {

			$data['bulan'] = date('m');
			$data['tahun'] = date('Y');

			$bulan = date('m');
			$tahun = date('Y');

			$data['nama_bulan']= date("F", strtotime(date("Y")."-".$bulan."-01"));

			if ($data['bulan'] != 1) {
				$bulan2 = $bulan - 1;
				$tanggal_inti = date($tahun."-".$bulan."-"."d");
				$data['dk_awal_k'] = date("Y-m-d", strtotime("$tanggal_inti first day of -$bulan2 month"));
				// debit kredit awal kumulatif
				$data['dk_akhir_k'] = date("Y-m-d", strtotime("$tanggal_inti last day of -1 month"));
			}
			

		}

		$this->load->view('laporan/laporan_labarugi', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_labarugi.pdf", array('Attachment' => 0));
	}

}
