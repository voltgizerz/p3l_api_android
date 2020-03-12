<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Delete extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hewan_model');
    }
    public function index_post($id)
    {

        if ($id === null) {
            # code...
            $this->response([
                'status' => false,
                'message' => 'ID HEWAN TIDAK DITEMUKAN',

            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->Hewan_model->deleteHewan($id) > 0) {
                //ok

                $this->response([
                    'status' => true,
                    'id_hewan' => $id,
                    'message' => 'delete hewan Sukses',
                ], REST_Controller::HTTP_CREATED);
                # code...
            } else {
                ////id not found
                $this->response([
                    'status' => false,
                    'message' => 'id tidak ada',

                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}