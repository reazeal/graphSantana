<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
        if(!$this->ion_auth->in_group('admin'))
        {
            redirect('admin/user/logout','refresh');
         }

		$this->load->model('paket_model');
		$this->load->model('layanan_model');
        $this->load->library('form_validation');
        $this->load->helper('text');
        $this->load->helper('url');
	}

	public function index()
	{
		  $this->load->view('admin/test/index_view');
	}
}