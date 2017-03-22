<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  ion_auth $ion_auth
 */
class MY_Controller extends CI_Controller
{
    public $website;
	protected $data = array();
	protected $data_content = array();
	protected $langs = array();
    protected $default_lang;
    protected $current_lang;
	function __construct()
	{
		parent::__construct();

	}

	protected function render($the_view = NULL, $template = 'master')
	{
		if($template == 'json' || $this->input->is_ajax_request())
		{
			header('Content-Type: application/json');
			echo json_encode($this->data);
		}
		elseif(is_null($template))
		{
			$this->load->view($the_view,$this->data);
		}
		else
		{
			$this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
			$this->load->view('templates/' . $template . '_view', $this->data);
		}
	}
}

/**
 * @property  ion_auth $ion_auth
 */
class Admin_Controller extends MY_Controller
{
	public $data_content = array();
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('postal');
		$this->load->helper('url');
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('admin/user/login', 'refresh');
		}
        $current_user = $this->ion_auth->user()->row();
        $this->user_id = $current_user->id;
		$this->data['current_user'] = $current_user;
		$this->data['current_user_menu'] = '';
		if($this->ion_auth->in_group('admin'))
		{
			$this->data['current_user_menu'] = $this->load->view('templates/_parts/user_menu_admin_view.php', NULL, TRUE);
		}

		$this->data['page_title'] = $this->config->item("site_title");
	}
	protected function render($the_view = NULL, $template = 'admin_master')
	{
		parent::render($the_view, $template);
	}
}

class Public_Controller extends MY_Controller
{
	public $data_content = array();
	public $data_content_blog = array();
    function __construct()
	{
        parent::__construct();
	}

    protected function render($the_view = NULL, $template = 'public_master')
    {
        //$this->load->library('menus');
        //$this->data['top_menu'] = $this->menus->get_menu('top-menu',$this->current_lang,'bootstrap_menu');
        parent::render($the_view, $template);
    }


}

/**
 * @property  ion_auth $ion_auth
 */
class Mahasiswa_Controller extends MY_Controller
{
	public $data_content = array();
	public $data_content_blog = array();
    function __construct()
	{
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('postal');
        $this->load->helper('url');
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('mahasiswa/user/login', 'refresh');
        }
        $current_user = $this->ion_auth->user()->row();
        $this->user_id = $current_user->id;
        $this->data['current_user'] = $current_user;
        $this->data['current_user_menu'] = '';
        if($this->ion_auth->in_group('mahasiswa'))
        {
            $this->data['current_user_menu'] = $this->load->view('templates/_parts/user_menu_admin_view.php', NULL, TRUE);
        }
        $this->data['page_title'] = $this->config->item("site_title");
	}

    protected function render($the_view = NULL, $template = 'mhs_master')
    {
         parent::render($the_view, $template);
    }


}



/**
 * @property  ion_auth $ion_auth
 */
class Asisten_Controller extends MY_Controller
{
	public $data_content = array();
	public $data_content_blog = array();
    function __construct()
	{
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('postal');
        $this->load->helper('url');
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('asisten/user/login', 'refresh');
        }
        $current_user = $this->ion_auth->user()->row();
        $this->user_id = $current_user->id;
        $this->data['current_user'] = $current_user;
        $this->data['current_user_menu'] = '';
		if($this->ion_auth->in_group('mahasiswa'))
        {
            $this->data['current_user_menu'] = $this->load->view('templates/_parts/user_menu_admin_view.php', NULL, TRUE);
        }
        
        $this->data['page_title'] = $this->config->item("site_title");
	}

    protected function render($the_view = NULL, $template = 'asisten_master')
    {
         parent::render($the_view, $template);
    }


}