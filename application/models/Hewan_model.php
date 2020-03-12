<?php

class Hewan_model extends CI_Model
{

    public function getHewan($id)
    {
        if ($id === null) {

            return $this->db->get('data_hewan')->result_array();
            # code...
        } else {

            $this->db->where('id_hewan', $id);
            return $this->db->get('data_hewan')->result_array();
        }
    }

    public function deleteHewan($id)
    {
        $this->db->delete('data_Hewan', ['id_hewan' => $id]);
        return $this->db->affected_rows();
    }
    public function createHewan($data)
    {
        $this->db->insert('data_hewan', $data);
        return $this->db->affected_rows();
    }

    public function updateHewan($request, $id)
    {
        $updateData =
            ['nama_hewan' => $request->nama_hewan,
            'id_jenis_hewan' => $request->id_jenis_hewan,
            'id_ukuran_hewan' => $request->id_ukuran_hewan,
            'id_hewan' => $request->id_hewan,
            'tanggal_lahir_hewan' => $request->tanggal_lahir_hewan,
            'updated_date' => $request->updated_date,
            'deleted_date' => $request->deleted_date,
        ];

        if ($this->db->where('id_hewan', $id)->update('data_hewan', $updateData)) {
            return ['msg' => 'Berhasil Update Hewan', 'error' => false];
        }
        return ['msg' => 'Gagal Update Hewan', 'error' => true];
    }

    public function getHewanID($id)
    {
        $this->id = $id;
        $query = "SELECT * FROM data_hewan WHERE id_hewan = ?";
        $result = $this->db->query($query, $this->id);
        if ($result->num_rows() != 0) {
            return ['msg' => $result->result(), 'error' => false];
        } else {
            return ['msg' => 'Data Hewan Tidak Ditemukan', 'error' => true];
        }
    }
}