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

        $this->load->model('Produk_model', 'produk');
    }

    public function index_post()
    {
        $data = [
            'nama_produk' => $this->post('nama_produk'),
            'harga_produk' => $this->post('harga_produk'),
            'stok_produk' => $this->post('stok_produk'),
            'gambar_produk' => $this->post('gambar_produk'),
            'stok_minimal_produk' => $this->post('stok_minimal_produk'),
            'created_date' => date("Y-m-d H:i:s"),
            'updated_date' => date("0000:00:0:00:00"),
            'deleted_date' => date("0000:00:0:00:00"),
        ];
        if ($this->customer->createProduk($data) > 0) {
            # code...
            $this->response([
                'status' => true,
                'message' => 'SUKSES Produk BERHASIL DI TAMBAHKAN !',

            ], REST_Controller::HTTP_CREATED);
        } else {

            $this->response([
                'status' => false,
                'message' => 'GAGAL, MENAMBAHKAN Produk BARU !',

            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}