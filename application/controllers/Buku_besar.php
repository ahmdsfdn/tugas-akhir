<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_besar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_bb');
		$this->load->model('Model_admin');
		$this->load->library('form_validation');

		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		}
	}

	
	
	public function index()
	{
		$data['judul']='Buku Besar';
		$data['active']='active';
		$data['dd_kodeakun']=$this->Model_admin->ambil_dropdown();

		$data['dd_bulan']=$this->Model_bb->dd_bulan();
		$data['jurnal_umum'] = $this->Model_bb->tampil_bukubesar();

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$data['bukber'] = $this->db->get_where('daftar_akun',['akun'])->result_array();

		// AWAL DARI SEMUA INI

		if ($this->input->post('tanggal_awal')) {
			
		$t_aw = $this->input->post('tanggal_awal');
		$t_ak = $this->input->post('tanggal_akhir');

		$data['t_aw']=$this->input->post('tanggal_awal');
		$data['t_ak'] = $this->input->post('tanggal_akhir');

		$month_awal = date("n",strtotime($t_aw));
		$month_akhir = date("n",strtotime($t_ak));
		
		$tahun= date("Y",strtotime($t_aw));

		$bulan = $month_awal;

		$data['tahun']= $tahun;
		$data['bulan']= $bulan;

		// echo date($tahun."-"."1"."-"."1");

		// echo $month_akhir;
		$data['nama_bulan']= date("F", strtotime(date("Y")."-".$bulan."-01"));

			if ($t_aw != date($tahun."-"."01"."-"."01")) {
					// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
					// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
				$bulan2 = $bulan - 1;
				$data['tahun_sa1'] = $tahun;
				$data['tahun_sa'] = $tahun;
				$data['tahun_sa2'] = $tahun-1;

					// $date_now = date($tahun."-".$bulan."-d");
					// echo "$tgl";
					$data['date_awal'] = date($tahun."-"."01"."-"."01");
					$data['date_akhir_data12'] = date("Y-m-d", strtotime("$t_ak"));
					$data['date_akhir'] = date("Y-m-d", strtotime("$t_aw -1 day"));

					$data['tgl_awal_data'] = $t_aw;
					$data['tgl_akhir_data'] = $t_ak;


				
					// echo $data['tgl_awal_data'];
					// echo $data['tgl_akhir_data'];
					// echo "cek";
			}  else

			{		
					$date_now = date($tahun."-".$bulan."-d");

					$data['tahun_sa1'] = $tahun;
					$data['tahun_sa'] = $data['tahun'];

					$data['date_awal'] = date($tahun."-".$bulan."-01");
					$data['date_akhir'] = date($tahun."-01-31");

					$data['tgl_awal_data'] = $t_aw;

					$data['tgl_akhir_data'] = $t_ak;
			}

		} elseif ($this->input->post('bulan_post')) {

		$data['tahun']= $this->input->post('tahun_post');
		$data['bulan']= $this->input->post('bulan_post');

		$tahun = $data['tahun'];
		$bulan = $data['bulan'];

		$data['nama_bulan']= date("F", strtotime(date("Y")."-".$bulan."-01"));

			if ($bulan != 1) {
					// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
					// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
				$bulan2 = $bulan - 1;

				$data['tahun_sa'] = $tahun;

					$date_now = date($tahun."-".$bulan."-d");
					// echo "$tgl";
					$data['date_awal'] = date("Y-m-d", strtotime("$date_now first day of -$bulan2 month"));
					$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of -1 month"));

					$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

					$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));

			} else
			{
					$date_now = date($tahun."-".$bulan."-d");
					$data['tahun_sa'] = $tahun;

					$data['date_awal'] = date($tahun."-".$bulan."-01");
					$data['date_akhir'] = date($tahun."-01-31");

					$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

					$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
			}
			
		} else {

			if ($this->input->post('tahun_post')) {
					$data['tahun']= $this->input->post('tahun_post');
					$data['bulan']= 1;
					
					$bulan = 1;
					$tahun = $this->input->post('tahun_post');

					$data['tahun_sa'] = $tahun;

					$date_now = date($tahun."-".$bulan."-d");
					$data['nama_bulan']= 'Tahun';
							// echo "$tgl";
					$data['date_awal'] = date("Y-m-d", strtotime("first day of $date_now"));
					$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of +11 month"));

					$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

					$data['tgl_akhir_data'] = date("Y-m-d", strtotime("$date_now last day of +11 month"));



			} else {
					$data['tahun']= date('Y');
					$data['bulan']= date('m');
					
					$bulan = date('m');
					$tahun = date('Y');

					$data['nama_bulan']= date("F", strtotime(date("Y")."-".$bulan."-01"));

						if ($bulan != 1) {
								// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
								// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
							$bulan2 = $bulan - 1;

							$data['tahun_sa'] = $tahun;

								$date_now = date("Y-".$bulan."-d");
								// echo "$tgl";
								$data['date_awal'] = date("Y-m-d", strtotime("$date_now first day of -$bulan2 month"));
								$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of -1 month"));

								$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

								$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));

						} else
						{		
								$date_now = date("Y-".$bulan."-d");
								$data['tahun_sa'] = $data['tahun'];

								$data['date_awal'] = date("Y-".$bulan."-01");
								$data['date_akhir'] = date("Y-01-31");

								$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

								$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
						}
					}

	
		}

		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('admin/master-data/laporan/buku_besar',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');

	}

	public function pdf()
	{	
		$this->load->library('dompdf_gen');

		$data['bukber'] = $this->db->get_where('daftar_akun',['akun'])->result_array();
		// AWAL DARI SEMUA INI

		if ($this->input->post('tanggal_awal')) {
			
		$t_aw = $this->input->post('tanggal_awal');
		$t_ak = $this->input->post('tanggal_akhir');

		$data['t_aw']=$this->input->post('tanggal_awal');
		$data['t_ak'] = $this->input->post('tanggal_akhir');

		$month_awal = date("n",strtotime($t_aw));
		$month_akhir = date("n",strtotime($t_ak));
		
		$tahun= date("Y",strtotime($t_aw));

		$bulan = $month_awal;

		$data['tahun']= $tahun;
		$data['bulan']= $bulan;

		// echo date($tahun."-"."1"."-"."1");

		// echo $month_akhir;
		$data['nama_bulan']= date("F", strtotime(date("Y")."-".$bulan."-01"));

			if ($t_aw != date($tahun."-"."01"."-"."01")) {
					// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
					// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
				$bulan2 = $bulan - 1;
				$data['tahun_sa1'] = $tahun;
				$data['tahun_sa'] = $tahun;
				$data['tahun_sa2'] = $tahun-1;

					// $date_now = date($tahun."-".$bulan."-d");
					// echo "$tgl";
					$data['date_awal'] = date($tahun."-"."01"."-"."01");
					$data['date_akhir_data12'] = date("Y-m-d", strtotime("$t_ak"));
					$data['date_akhir'] = date("Y-m-d", strtotime("$t_aw -1 day"));

					$data['tgl_awal_data'] = $t_aw;
					$data['tgl_akhir_data'] = $t_ak;


				
					// echo $data['tgl_awal_data'];
					// echo $data['tgl_akhir_data'];
					// echo "cek";
			}  else

			{		
					$date_now = date($tahun."-".$bulan."-d");

					$data['tahun_sa1'] = $tahun;
					$data['tahun_sa'] = $data['tahun'];

					$data['date_awal'] = date($tahun."-".$bulan."-01");
					$data['date_akhir'] = date($tahun."-01-31");

					$data['tgl_awal_data'] = $t_aw;

					$data['tgl_akhir_data'] = $t_ak;
			}

		} elseif ($this->input->post('bulan_post')) {

		$data['tahun']= $this->input->post('tahun_post');
		$data['bulan']= $this->input->post('bulan_post');

		$tahun = $data['tahun'];
		$bulan = $data['bulan'];

		$data['nama_bulan']= date("F", strtotime(date("Y")."-".$bulan."-01"));

			if ($bulan != 1) {
					// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
					// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
				$bulan2 = $bulan - 1;

				$data['tahun_sa'] = $tahun;

					$date_now = date($tahun."-".$bulan."-d");
					// echo "$tgl";
					$data['date_awal'] = date("Y-m-d", strtotime("$date_now first day of -$bulan2 month"));
					$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of -1 month"));

					$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

					$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));

			} else
			{
					$date_now = date($tahun."-".$bulan."-d");
					$data['tahun_sa'] = $tahun;

					$data['date_awal'] = date($tahun."-".$bulan."-01");
					$data['date_akhir'] = date($tahun."-01-31");

					$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

					$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
			}
			
		} else {

			if ($this->input->post('tahun_post')) {
					$data['tahun']= $this->input->post('tahun_post');
					$data['bulan']= 1;
					
					$bulan = 1;
					$tahun = $this->input->post('tahun_post');

					$data['tahun_sa'] = $tahun;

					$date_now = date($tahun."-".$bulan."-d");
					$data['nama_bulan']= 'Tahun';
							// echo "$tgl";
					$data['date_awal'] = date("Y-m-d", strtotime("first day of $date_now"));
					$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of +11 month"));

					$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

					$data['tgl_akhir_data'] = date("Y-m-d", strtotime("$date_now last day of +11 month"));



			} else {
					$data['tahun']= date('Y');
					$data['bulan']= date('m');
					
					$bulan = date('m');
					$tahun = date('Y');

					$data['nama_bulan']= date("F", strtotime(date("Y")."-".$bulan."-01"));

						if ($bulan != 1) {
								// $this->db->where('tanggal_transaksi >=','DATE_FORMAT(CURDATE(), "%Y-%m-01") - INTERVAL 1 MONTH');
								// $tgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
							$bulan2 = $bulan - 1;

							$data['tahun_sa'] = $tahun;

								$date_now = date("Y-".$bulan."-d");
								// echo "$tgl";
								$data['date_awal'] = date("Y-m-d", strtotime("$date_now first day of -$bulan2 month"));
								$data['date_akhir'] = date("Y-m-d", strtotime("$date_now last day of -1 month"));

								$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

								$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));

						} else
						{		
								$date_now = date("Y-".$bulan."-d");
								$data['tahun_sa'] = $data['tahun'];

								$data['date_awal'] = date("Y-".$bulan."-01");
								$data['date_akhir'] = date("Y-01-31");

								$data['tgl_awal_data'] = date("Y-m-d", strtotime("first day of $date_now"));

								$data['tgl_akhir_data'] = date("Y-m-d", strtotime("last day of $date_now "));
						}
					}

	
		}

		$this->load->view('laporan/laporan_bukubesar', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_bukubesar.pdf", array('Attachment' => 0));

	}



}
