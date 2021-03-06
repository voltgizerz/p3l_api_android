<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Get extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Jasa_Layanan_model', 'jasa_layanan');
    }

    public function index_get()
    {
        $id = $this->get('id_jasa_layanan');
        if ($id === null) {

            $jasa_layanan = $this->jasa_layanan->getJasa_Layanan($id);
            # code...

        } else {

            $jasa_layanan = $this->jasa_layanan->getJasa_Layanan($id);
        }

        if ($jasa_layanan) {

            $this->response([
                'status' => true,
                'data' => $jasa_layanan,

            ], REST_Controller::HTTP_OK);
            # code...
        } else {

            $this->response([
                'status' => false,
                'message' => 'GAGAL, ID JASA LAYANAN TIDAK DITEMUKAN / SALAH FORMAT !',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}