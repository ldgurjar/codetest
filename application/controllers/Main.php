<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    private $data = array();
	/**
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/main/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('main_model');
        $this->load->model('Ajax_model');
       
    }

	public function index()
	{
		//echo "data";
		$this->load->view('header');
		$this->load->view('screen1');
		$this->load->view('footer');
	}

	public function screen1()
	{
		//echo "data";
		$this->load->view('header');
		$this->load->view('screen1');
		$this->load->view('footer');
	}
	public function savedata()
	{
		
	   $data = $_REQUEST;
	   $insertQuestion  = $this->Ajax_model->insertQuestion($data);
	   echo  'data saved';
       //$this->load->view('footer');
	}
}
