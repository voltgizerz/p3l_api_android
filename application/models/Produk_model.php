<?php

class Produk_model extends CI_Model
{

    public function getProduk($id)
    {
        if ($id === null) {

            return $this->db->get('data_produk')->result_array();
            # code...
        } else {

            $this->db->where('id_produk', $id);
            return $this->db->get('data_produk')->result_array();
        }
    }

    public function deleteProduk($id)
    {
        $this->db->delete('data_produk', ['id_produk' => $id]);
        return $this->db->affected_rows();
    }
    public function createProduk($data)
    {
        $this->db->insert('data_produk', $data);
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