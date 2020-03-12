<?php

class Ukuran_Hewan_model extends CI_Model
{

    public function getUkuranHewan($id)
    {
        if ($id === null) {

            return $this->db->get('data_ukuran_hewan')->result_array();
            # code...
        } else {

            $this->db->where('id_ukuran_hewan', $id);
            return $this->db->get('data_ukuran_hewan')->result_array();
        }
    }

    public function deleteUkuranHewan($id)
    {
        $this->db->delete('data_ukuran_hewan', ['id_ukuran_hewan' => $id]);
        return $this->db->affected_rows();
    }
    public function createUkuranHewan($data)
    {
        $this->db->insert('data_ukuran_hewan', $data);
        return $this->db->affected_rows();
    }

    public function updateUkuranHewan($request, $id)
    {
        $updateData =
            ['ukuran_hewan' => $request->ukuran_hewan,
            'updated_date' => $request->updated_date,
            'deleted_date' => $request->deleted_date,
        ];

        if ($this->db->where('id_ukuran_hewan', $id)->update('data_ukuran_hewan', $updateData)) {
            return ['msg' => 'Berhasil Update Ukuran Hewan', 'error' => false];
        }
        return ['msg' => 'Gagal Update Ukuran Hewan', 'error' => true];
    }

    public function getUkuranHewanID($id)
    {
        $this->id = $id;
        $query = "SELECT * FROM data_ukuran_hewan WHERE id_ukuran_hewan = ?";
        $result = $this->db->query($query, $this->id);
        if ($result->num_rows() != 0) {
            return ['msg' => $result->result(), 'error' => false];
        } else {
            return ['msg' => 'Data Ukuran Hewan Tidak Ditemukan', 'error' => true];
        }
    }
}
