<?php

class Customer_model extends CI_Model
{


	public function getCustomer($id = null)

	{
		if ($id === null) {

			return $this->db->get('data_customer')->result_array();
			# code...
		} else {

			return $this->db->get_where('data_customer', ['id_customer' => $id])->result_array();
		}
	}

	public function deleteCustomer($id)
	{
		$this->db->delete('data_customer', ['id_customer' => $id]);
		return $this->db->affected_rows();
	}
	public function createCustomer($data)
	{
		$this->db->insert('data_customer', $data);
		return $this->db->affected_rows();
	}

	public function updateCustomer($data, $id)
	{
		$this->db->update('data_customer', $data, ['id_customer' => $id]);
		return $this->db->affected_rows();
	}
}
