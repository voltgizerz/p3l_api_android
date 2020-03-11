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

        $this->load->model('Customer_model', 'customer');
    }

    public function index_get()
    {
        $id = $this->get('id_customer');
        if ($id === null) {

            $customer = $this->customer->getCustomer($id);
            # code...

        } else {

            $customer = $this->customer->getCustomer($id);
        }

        if ($customer) {

            $this->response([
                'status' => true,
                'data' => $customer,

            ], REST_Controller::HTTP_OK);
            # code...
        } else {

            $this->response([
                'status' => false,
                'message' => 'GAGAL, ID CUSTOMER TIDAK DITEMUKAN / SALAH FORMAT !',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {

        $id = $this->delete('id_customer');
        var_dump($id);
        if ($id === null) {
            # code...
            $this->response([
                'status' => false,

                'message' => 'GAGAL, ID CUSTOMER TIDAK BOLEH KOSONG!',

            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->customer->deleteCustomer($id) > 0) {
                //ok

                $this->response([
                    'status' => true,
                    'id_customer' => $id,
                    'message' => 'SUKSES DELETE CUSTOMER !',
                ], REST_Controller::HTTP_OK);
                # code...
            } else {
                ////id not found
                $this->response([
                    'status' => false,
                    'message' => 'GAGAL, ID CUSTOMER TIDAK DITEMUKAN !',

                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {

        $data = [
            'nama_customer' => $this->post('nama_customer'),
            'alamat_customer' => $this->post('alamat_customer'),
            'tanggal_lahir_customer' => $this->post('tanggal_lahir_customer'),
            'nomor_hp_customer' => $this->post('nomor_hp_customer'),
            'created_date' => date("Y-m-d H:i:s"),
            'updated_date' => date("0000:00:0:00:00"),
            'deleted_date' => date("0000:00:0:00:00"),
        ];
        if ($this->customer->createCustomer($data) > 0) {
            # code...
            $this->response([
                'status' => true,
                'message' => 'SUKSES CUSTOMER BERHASIL DI TAMBAHKAN !',

            ], REST_Controller::HTTP_CREATED);
        } else {

            $this->response([
                'status' => false,
                'message' => 'GAGAL, MENAMBAHKAN CUSTOMER BARU !',

            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id_customer');
        $data = [
            'nama_customer' => $this->put('nama_customer'),
            'alamat_customer' => $this->put('alamat_customer'),
            'tanggal_lahir_customer' => $this->put('tanggal_lahir_customer'),
            'nomor_hp_customer' => $this->put('nomor_hp_customer'),
            'updated_date' => date("Y-m-d H:i:s"),
            'deleted_date' => date("0000:00:0:00:00"),

        ];

        if ($this->customer->updateCustomer($data, $id) > 0) {
            # code...
            $this->response([
                'status' => true,
                'id_customer' => $id,
                'message' => 'SUKSES UPDATED CUSTOMER !',

            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'GAGAL UPDATED CUSTOMER ID TIDAK DI TEMUKAN! !',

            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}