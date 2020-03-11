<?php

class Customer_model extends CI_Model
{

    public function getCustomer($id)
    {
        if ($id === null) {

            return $this->db->get('data_customer')->result_array();
            # code...
        } else {

            $this->db->where('id_customer', $id);
            return $this->db->get('data_customer')->result_array();
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

    public function updateCustomer($request, $id)
    {
        $updateData =
            ['nama_customer' => $request->nama_customer,
            'alamat_customer' => $request->alamat_customer,
            'tanggal_lahir_customer' => $request->tanggal_lahir_customer,
            'nomor_hp_customer' => $request->nomor_hp_customer,
            'updated_date' => $request->updated_date,
            'deleted_date' => $request->deleted_date,
        ];

        if ($this->db->where('id_customer', $id)->update('data_customer', $updateData)) {
            return ['msg' => 'Berhasil', 'error' => false];
        }
        return ['msg' => 'Gagal', 'error' => true];
    }

    public function getCustomerID($id)
    {
        $this->id = $id;
        $query = "SELECT * FROM data_customer WHERE id_customer = ?";
        $result = $this->db->query($query, $this->id);
        if ($result->num_rows() != 0) {
            return ['msg' => $result->result(), 'error' => false];
        } else {
            return ['msg' => 'Data Tidak Ditemukan', 'error' => true];
        }
    }
}