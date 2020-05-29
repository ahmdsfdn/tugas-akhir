<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{	
		if ($this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda tidak bisa mengakses halaman ini</div>');
			redirect('admin');
		}
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|required');

		if ($this->form_validation->run() == false) {

		$data['judul'] = "Halaman Login";
		$this->load->view('templates/auth_header', $data);
		$this->load->view('auth/login');
		$this->load->view('templates/auth_footer');

		} else {
			// validasinya success
			$this->_login();
			//metod private yang hanya bisa di akses kelas ini
		}
	}

	private function _login()
	{	
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// query dari codeigniter
		$user = $this->db->get_where('user', ['email' => $email]) -> row_array();
		// select * where user, email = email
		
		if ($user) {
			# usernya ada
			if ($user['is_active'] == 1) {

				// cek password 

				if (password_verify($password, $user['password'])) {
					
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					
					if ($user['role_id'] == 1) {
						
						$this->session->set_userdata($data);
						// $this->db->where('role_id', $data['role_id']);
						// $query = $this->db->from('user')
						// 	->join('user_role','user_role.id = user.role_id')
						// 	->get()
						// 	->result_array();

						// print_r($query);
						// echo $query[0]['role'];

						redirect('admin');

					} else {
						$this->session->set_userdata($data);
						redirect('admin');
					}

				} else {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password anda salah</div>');
					redirect('auth');
				}

			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email belum teraktivasi</div>');
				redirect('auth');
			}
		} else {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email belum terdaftar</div>');
			redirect('auth');
		}

	}

	public function register()
	{	
		if ($this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda tidak bisa mengakses halaman ini</div>');
			redirect('admin');
		}

		#rules untuk membatasi perilaku form
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',
				[
					'is_unique' => 'Email telah terdaftar'
				]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',
			[
				'matches' => 'password tidak cocok!',
				'min_length' => 'password terlalu pendek'
			]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


		if ($this->form_validation->run() == false) {
				$data['judul'] = 'Registrasi';
				$this->load->view('templates/auth_header',$data);
				$this->load->view('auth/register');
				$this->load->view('templates/auth_footer');
		} else {

		
			// cek jika ada gambar yang akan di upload
			$upload_image = $_FILES['gambar']['name'];

			if ($upload_image) {

				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('gambar')) {

					$new_image = $this->upload->data('file_name');
					// $this->db->set('gambar', $new_image);
		
				} else {

					echo $this->upload->display_errors();
				}
			} else {
				$new_image = 'default.jpg';
			}

			$data = [
				'nama' => htmlspecialchars($this->input->post('nama')),
				'email' => htmlspecialchars($this->input->post('email')),
				'gambar' => $new_image,
				'password' => password_hash($this->input->post('password2'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 2,
				'date_created' => time()
			];

		
		
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Selamat, anda sudah terdaftar ! </div>');
			$this->db->insert('user',$data);
			redirect('auth');
		}
		
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'asaifudin567@gmail.com',
			'smtp_pass' => 'untuktugasakhir',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('asaifudin567@gmail.com', 'PT. Bagas Tetuko');
		$this->email->to($this->input->post('email'));

		if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Klik link ini untuk reset password anda : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Reset Password </a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}

		$this->email->send();
	}

	public function logout ()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Anda berhasil Logout ! </div>');
		redirect('auth');
	}

	public function lupas()
	{	
		if ($this->session->userdata('email')) {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda tidak bisa mengakses halaman ini</div>');
			redirect('admin');
		}

		$data['judul'] = "Halaman Lupa Password";
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/lupas');
			$this->load->view('templates/auth_footer');	
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user',['email' => $email, 'is_active' => 1])->row_array();

			if ($user) {
				
				$token = base64_encode(random_bytes(32));

				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Cek email untuk memulihkan password anda</div>');
				redirect('auth/lupas');


			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email belum terdaftar atau belum aktif</div>');
				redirect('auth/lupas');
			}

		}

		
	}

	public function resetpassword()
	{	
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user',['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->gantipassword();
			} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Token Salah</div>');
			redirect('auth');		
			}
		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password gagal</div>');
			redirect('auth');
		}
	}

	public function gantipassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',
			[
				'matches' => 'password tidak cocok!',
				'min_length' => 'password terlalu pendek'
			]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['judul'] = "Ganti Password";
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/gantipassword');
			$this->load->view('templates/auth_footer');	
		} else {

			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email',$email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password berhasil diganti</div>');
			redirect('auth');
		}
		
	}

}