<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  ion_auth $ion_auth
 * @property  postal $postal
 * @property  graph1_model $graph1_model
 * @property  graph2_model $graph2_model
 */
class Graph2 extends Admin_Controller
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
        $this->load->model('graph2_model');
	}

	public function index()
	{
		$this->data['menu_data'] = array('master'=>true,'transaksi'=>false,'dashboard'=>false,'graphic'=>true,'cetakan'=>false,'class_master'=>'in','class_transaksi'=>'in','class_graphic'=>'collapse');
		$this->data['datasets'] = $this->graph2_model->getdata();
		$this->data['getdataSeries'] = $this->graph2_model->getdatax();
        $this->render('admin/graph2/index');
	}

    public function get_data_all(){

        $search = $this->input->get('search');
        $sort = $this->input->get('sort');
        $order = $this->input->get('order');
        $limit = $this->input->get('limit');
        $offset = $this->input->get('offset');

        $datanya = $this->graph2_model->get_data_all($search, $sort, $order, $limit, $offset);
        echo json_encode($datanya,JSON_PRETTY_PRINT);
    }

}