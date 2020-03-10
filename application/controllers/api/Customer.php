<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';



class Film extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Film_model', 'film');
    }
    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {

            $film = $this->film->getFilm();
            # code...
        } else {
            $film = $this->film->getFilm($id);
        }

        if ($film) {

            $this->response([
                'status' => true,
                'data' => $film

            ], REST_Controller::HTTP_OK);
            # code...
        } else {
            $this->response([
                'status' => false,

                'message' => 'id not found'

            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_delete()
    {
        $id = $this->delete('id');
        if ($id === null) {
            # code...
            $this->response([
                'status' => false,
                'message' => 'provide an id not found'

            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->film->deleteFilm($id) > 0) {
                //ok

                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'delete Sukses'
                ], REST_Controller::HTTP_NO_CONTENT);
                # code...
            } else {
                ////id not found 
                $this->response([
                    'status' => false,
                    'message' => 'provide an id not found'

                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [

            'judul'    => $this->post('judul'),
            'rating'    => $this->post('rating'),
            'sinopsis'    => $this->post('sinopsis'),
            'runtime'    => $this->post('runtime'),
            'studio'    => $this->post('studio')
        ];
        if ($this->film->createFilm($data) > 0) {
            # code...
            $this->response([
                'status' => true,
                'message' => 'Mahasiswa Has been created'

            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failded to Createed'

            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [

            'judul'    => $this->put('judul'),
            'rating'    => $this->put('rating'),
            'sinopsis'    => $this->put('sinopsis'),
            'runtime'    => $this->put('runtime'),
            'studio'    => $this->put('studio')
        ];

        if ($this->film->updateFilm($data, $id) > 0) {
            # code...
            $this->response([
                'status' => true,
                'message' => 'UPDATED MAHASISWA'

            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failded to UPDATED'

            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
