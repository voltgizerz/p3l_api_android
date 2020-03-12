<?php

class Hewan_model extends CI_Model
{

    public function getHewan($id = null)
    {
        if ($id === null) {

            return $this->db->get('data_hewan')->result_array();
            # code...
        } else {

            return $this->db->get_where('data_hewan', ['id_hewan' => $id])->result_array();
        }
    }

    public function deleteHewan($id)
    {
        $this->db->delete('data_hewan', ['id_hewan' => $id]);
        return $this->db->affected_rows();
    }
    public function createHewan($data)
    {
        $this->db->insert('data_hewan', $data);
        return $this->db->affected_rows();
    }

    public function updateHewan($data, $id)
    {
        $this->db->where('id_hewan', $id);
        $this->db->update('data_hewan', $data);
        return $this->db->affected_rows();
    }
}
