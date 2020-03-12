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

        $this->load->model('Hewan_model', 'hewan');
    }

    public function index_get()
    {
        $id = $this->get('id_hewan');
        if ($id === null) {

            $Hewan = $this->hewan->getHewan($id);
            # code...

        } else {

            $Hewan = $this->hewan->getHewan($id);
        }

        if ($Hewan) {

            $this->response([
                'status' => true,
                'data' => $Hewan,

            ], REST_Controller::HTTP_OK);
            # code...
        } else {

            $this->response([
                'status' => false,
                'message' => 'GAGAL, ID HEWAN TIDAK DITEMUKAN / SALAH FORMAT !',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}