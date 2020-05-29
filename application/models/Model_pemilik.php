<?php  

/**
 * 
 */
class Model_pemilik extends CI_Model
{
	public function update_aktif($id)
	{

		$this->db->set('is_active', '1');
		$this->db->where('id',$id);
		$this->db->update('user');
	}

	public function update_nonaktif($id)
	{
		$this->db->set('is_active', '2');
		$this->db->where('id',$id);
		$this->db->update('user');
	}

	public function up_level($id)
	{
		$this->db->set('role_id', '1');
		$this->db->where('id',$id);
		$this->db->update('user');
	}

	public function down_level($id)
	{
		$this->db->set('role_id', '2');
		$this->db->where('id',$id);
		$this->db->update('user');
	}

	public function hapus($id)
	{
		$this->db->delete('user',['id' => $id]);
	}
}