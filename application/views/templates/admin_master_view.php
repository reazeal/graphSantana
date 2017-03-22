<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/_parts/admin_master_header_view_lte'); ?>
<?php echo $the_view_content;?>
<?php $this->load->view('templates/_parts/admin_master_footer_view_lte');?>