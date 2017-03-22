<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  ion_auth $ion_auth
 * @property  postal $postal
 * @property  nilai_praktikum_model $nilai_praktikum_model
 * @property  tawar_praktikum_model $tawar_praktikum_model
 */
class Dashboard extends Admin_Controller
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
    }

    public function index()
    {
		$this->data['menu_data'] = array('master'=>false,'transaksi'=>false,'dashboard'=>true,'cetakan'=>false,'class_master'=>'collapse','class_transaksi'=>'collapse');
       $this->render('admin/dashboard_view');
    }

    public function clear_cache()
    {
        $leave_files = array('.htaccess', 'index.html');
        $i = 0;
        foreach( glob(APPPATH.'cache/*') as $file ) {
            if(!in_array(basename($file), $leave_files))
            {
                unlink($file);
                $i++;
            }
        }
        $this->session->set_flashdata('message', $i.' files were deleted from the cache directory.');
        redirect('admin','refresh');
    }
}