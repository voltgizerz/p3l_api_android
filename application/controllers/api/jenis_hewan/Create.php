<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Create extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Jenis_Hewan_model', 'jenis_hewan');
    }

    public function index_post()
    {
        $data = [
            'nama_jenis_hewan' => $this->post('nama_jenis_hewan'),
            'created_date' => date("Y-m-d H:i:s"),
            'updated_date' => date("0000:00:0:00:00"),
            'deleted_date' => date("0000:00:0:00:00"),
        ];
        if ($this->jenis_hewan->createJenisHewan($data) > 0) {
            # code...
            $this->response([
                'status' => true,
                'message' => 'SUKSES JENIS HEWAN BERHASIL DI TAMBAHKAN !',

            ], REST_Controller::HTTP_CREATED);
        } else {

            $this->response([
                'status' => false,
                'message' => 'GAGAL, MENAMBAHKAN JENIS HEWAN BARU !',

            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
