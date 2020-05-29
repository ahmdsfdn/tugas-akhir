<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilik extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_pemilik');
		if (!$this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu</div>');
			redirect('auth');
		} else {
			if($this->session->userdata('role_id') == '2'){
				redirect('admin');
			}
		}
	}

	public function index()
	{	
		$data['judul']='Aktivasi';
		$data['active']='active';

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();//data pengguna yang login

		$data['data_user'] = $this->db->get('user')->result_array();
		$this->load->view('templates/dash_header',$data);
		$this->load->view('templates/adm_sidebar',$data);
		$this->load->view('templates/adm_header',$data);
		$this->load->view('pemilik/data_user',$data);
		$this->load->view('templates/adm_footer');
		$this->load->view('templates/dash_footer');
	}

	public function update_aktif($id)
	{

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();//data pengguna yang login

		$data['data_user'] = $this->db->get('user')->result_array();

		$this->Model_pemilik->update_aktif($id);

		redirect('pemilik');

	}

	public function update_nonaktif($id)
	{

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();//data pengguna yang login

		$data['data_user'] = $this->db->get('user')->result_array();

		$this->Model_pemilik->update_nonaktif($id);
		
		redirect('pemilik');

	}
	public function hapus($id)
	{

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();//data pengguna yang login

		$data['data_user'] = $this->db->get('user')->result_array();

		$this->Model_pemilik->hapus($id);
		
		redirect('pemilik');

	}

	public function update_uplevel($id)
	{

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();//data pengguna yang login

		$data['data_user'] = $this->db->get('user')->result_array();

		$this->Model_pemilik->up_level($id);
		
		redirect('pemilik');

	}

	public function update_downlevel($id)
	{

		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();//data pengguna yang login

		$data['data_user'] = $this->db->get('user')->result_array();

		$this->Model_pemilik->down_level($id);
		
		redirect('pemilik');

	}


	
}
