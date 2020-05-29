<?php  

/**
 * 
 */
class Model_poskeu extends CI_Model
{

	public function tampil_posakun()
	{
		return $this->db->get_where('daftar_akun',['pos_laporan' => 'Laporan Posisi Keuangan'])->result_array();
	}

}