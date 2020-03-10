<?php

class Film_model extends CI_Model
{
	

	public function getFilm($id = null)

	{
		if ($id=== null) {
		
		return $this->db->get('film')->result_array();
	# code...
		}
		else
		{

			return $this->db->get_where('film', ['id'=> $id])->result_array();

		}
		
	}

	public function deleteFilm($id)
	{
		$this->db->delete('film', ['id'=>$id] );
		return $this->db->affected_rows();
	}
	public function createFilm($data)
	{
		$this->db->insert('film',$data);
		return $this->db->affected_rows();
	}

	public function updateFilm($data , $id)
	{
		$this->db->update('film', $data,['id'=>$id]);
		return $this->db->affected_rows();
	}
}
