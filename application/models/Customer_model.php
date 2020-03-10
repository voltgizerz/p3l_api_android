<?php

class Customer_model extends CI_Model
{


	public function getCustomer($id = null)

	{
		if ($id === null) {

			return $this->db->get('customer')->result_array();
			# code...
		} else {

			return $this->db->get_where('customer', ['id' => $id])->result_array();
		}
	}

	public function deleteCustomer($id)
	{
		$this->db->delete('customer', ['id' => $id]);
		return $this->db->affected_rows();
	}
	public function createCustomer($data)
	{
		$this->db->insert('customer', $data);
		return $this->db->affected_rows();
	}

	public function updateCustomer($data, $id)
	{
		$this->db->update('customer', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}
}
