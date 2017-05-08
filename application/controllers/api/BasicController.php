<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'helpers/Response.php';
require APPPATH . 'helpers/JWT.php';

// use namespace
use Restserver\Libraries\REST_Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class BasicController extends REST_Controller {
    

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('BasicModel');
    }

    public function test_get(){
        echo(json_encode(array(
            'test'=>'true'
        )));
    }

    public function signup_post(){

        $user = json_decode($this->post('user'));
        if($user == null){
            return $this->response(array(
                'success' => false,
                'error' => 'Missing data'
            ), REST_Controller::HTTP_BAD_REQUEST);  
        }

        if(!$this->BasicModel->signUp($user)){
            return $this->response(array(
                'success' => false,
                'error' => 'User not created, internal error'
            ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);  
        }

        $user = $this->BasicModel->login($user->mail, $user->password);
        if($user == null){
            return $this->response(array(
                'success' => false,
                'error' => 'User not found, incorrect credentials'
            ), REST_Controller::HTTP_OK);  
        }

        $time = time();
        $expiration = $time + 5184000;
            
        $user->iat = $time;
        $user->exp = $expiration;
        $jwt = JWT::encode($user,'key');
            
        $data = new stdClass();
        $data->expiration = $expiration;
        $data->token = $jwt;

        return $this->response(array(
            'success'=>true,
            'data' => $data
        ), REST_Controller::HTTP_OK);
    }

    public function login_post(){

        $data = $this->post('data');

        if($data->mail == null || $data->password == null){
            return $this->response(array(
                'success' => false,
                'error' => 'Missing credentials'
            ), REST_Controller::HTTP_BAD_REQUEST);  
        } 

        $user = $this->BasicModel->login($data->mail, $data->password);
        if($user == null){
            return $this->response(array(
                'success' => false,
                'error' => 'User not found, incorrect credentials'
            ), REST_Controller::HTTP_OK);  
        }

        $time = time();
        $expiration = $time + 5184000;
            
        $user->iat = $time;
        $user->exp = $expiration;
        $jwt = JWT::encode($user,'key');
            
        $data = new stdClass();
        $data->expiration = $expiration;
        $data->token = $jwt;

        return $this->response(array(
            'success'=>true,
            'data' => $data
        ), REST_Controller::HTTP_OK);
    }

}
