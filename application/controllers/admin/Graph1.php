<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  ion_auth $ion_auth
 * @property  postal $postal
 * @property  graph1_model $graph1_model
 */
class Graph1 extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
        if(!$this->ion_auth->in_group('admin'))
        {
            redirect('admin/user/logout','refresh');
        }
        $this->load->library('form_validation');
        $this->load->helper('text');
        $this->load->helper('url');
        $this->load->model('graph1_model');
	}

	public function index()
	{
		$this->data['menu_data'] = array('master'=>true,'transaksi'=>false,'dashboard'=>false,'graphic'=>true,'cetakan'=>false,'class_master'=>'in','class_transaksi'=>'in','class_graphic'=>'collapse');
		$this->data['datasets'] = $this->graph1_model->getdata();
		$this->data['datasetsPie'] = $this->graph1_model->getdataPie();
        $this->render('admin/graph1/index');
	}

    public function get_data()
    {
        $data = $this->graph1_model->getdata();

        echo json_encode($data,JSON_PRETTY_PRINT);

    }

}