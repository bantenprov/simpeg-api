<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

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
class Pegawai extends REST_Controller {
    function __construct(){
		// Construct the parent class
		parent::__construct();
		$this->load->database();
		// Configure limits on our controller methods
		// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		//$this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
		//$this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
		//$this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
    }
    public function user_get(){
        // Users from a data store e.g. database
		$nip = $this->get('nip');
		//echo $nip;
		if ($nip === NULL){
            $this->response([
                'status' => FALSE,
                'error' => 'NIP tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
		$query = $this->db->get_where('peg_identpeg', array('nip' => $nip));
		$result = $query->row();
        if (!empty($result)){
            $this->set_response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'error' => 'NIP tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
}
