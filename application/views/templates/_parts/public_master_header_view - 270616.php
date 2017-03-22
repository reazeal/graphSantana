<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
    <!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="Content-Encoding" content="gzip" />
		<meta http-equiv="Accept-Encoding" content="gzip, deflate" />  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Praktikum</title>
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/bootstrap/css/bootstrap.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/bootstrap-table/src/bootstrap-table.css');?>">
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/bootstrap-table/bootstrap-editable.css');?>">
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/dataTables/dataTables.bootstrap.css');?>">
		<link rel="stylesheet" href="<?php echo site_url('assets/css/main.css');?> "  />
		<link rel="stylesheet" href="<?php echo site_url('assets/css/theme.css');?> " />
		<link rel="stylesheet" href="<?php echo site_url('assets/css/Moneadmin.css');?> " />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/validationengine/css/validationEngine.jquery.css');?> " />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/Font-Awesome/css/font-awesome.css');?> " />
		<link rel="stylesheet" href="<?php echo site_url('assets/css/jquery-ui.css');?>"  />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/uniform/themes/default/css/uniform.default.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/chosen/chosen.min.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/tagsinput/jquery.tagsinput.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/daterangepicker/daterangepicker-bs3.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/datepicker/css/datepicker.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/timepicker/css/bootstrap-timepicker.min.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/switch/static/stylesheets/bootstrap-switch.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/css/uploadfile.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap-select-min.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/timeline/timeline.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/css/jquery.printarea.css');?>" />
		<link rel="stylesheet" href="<?php echo site_url('assets/plugins/datetimepicker/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css');?>" /> 
		
		<script src="<?php echo site_url('assets/plugins/jquery-2.0.3.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/bootstrap/js/bootstrap.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/validationengine/js/jquery.validationEngine.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js');?>"></script>
		<script src="<?php echo site_url('assets/js/jquery-ui.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/uniform/jquery.uniform.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/chosen/chosen.jquery.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/validVal/js/jquery.validVal.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/daterangepicker/daterangepicker.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/daterangepicker/moment.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/datepicker/js/bootstrap-datepicker.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/timepicker/js/bootstrap-timepicker.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/switch/static/js/bootstrap-switch.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/autosize/jquery.autosize.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/tagsinput/jquery.tagsinput.min.js');?>"></script>
		<script src="<?php echo site_url('assets/js/formsInit.js');?>"></script>
		<script src="<?php echo site_url('assets/js/jquery.uploadfile.min.js');?>"></script>
		<script src="<?php echo site_url('assets/js/jquery.form.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/jasny/js/bootstrap-inputmask.js');?>"></script>
		<script src="<?php echo site_url('assets/js/bootstrap-select.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/bootstrap-table/src/bootstrap-table.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/bootstrap-table/bootstrap-editable.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/bootstrap-table/src/extensions/editable/bootstrap-table-editable.js');?>"></script>
		<script src="<?php echo site_url('assets/js/jquery.printarea.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/datetimepicker/moment/min/moment-with-locales.min.js');?>"></script>
		<script src="<?php echo site_url('assets/plugins/datetimepicker/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');?>"></script>
		<script>

				var MsgBox = (function() {
					"use strict";

					var elem,
						hideHandler,
						that = {};

					that.init = function(options) {
						elem = $(options.selector);
					};

					that.show = function(text) {
						clearTimeout(hideHandler);

						elem.find("span").html(text);
						elem.delay(200).fadeIn().delay(4000).fadeOut();
					};

					return that;
				}());

				 $(function () {
					MsgBox.init({
						"selector": ".bb-alert"
					});
				});
		</script>

		</head>
	
<body class="padTop53" >
		
<!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="<?php echo site_url('mahasiswa');?>" class="navbar-brand">
                    <!-- <img src="<?php echo site_url('assets/img/logo.jpg');?>" alt="" /> -->
                        
                        </a>
                </header>
                <!-- END LOGO SECTION -->
               

            </nav>

        </div>
        <!-- END HEADER SECTION -->

                
 <!-- MAIN WRAPPER -->
    <div id="wrap" >
       	   
		
        <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="<?php echo site_url('mahasiswa');?>" class="navbar-brand">
                    <!-- <img src="<?php echo site_url('assets/img/logo.png');?>" alt="" /> -->
                        
                        </a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">

                    <!--mahasiswa SETTINGS SECTIONS -->
                    <!--END mahasiswa SETTINGS -->
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
       <div id="left" style="margin-top: 10px;">
            <ul id="menu" class="collapse">   
                <li class="panel active">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle">
                        <i class="icon-tasks"> </i> Master      
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       &nbsp; <!-- <span class="label label-default">10</span>--> &nbsp;
                    </a>
                    <ul class="" id="component-nav">
						<li class="" id="menuRuangPraktikum"><a href="<?php echo site_url('mahasiswa/ruang_praktikum');?>"><i class="icon-double-angle-right "></i> Ruang Praktikum</a> </li>
                        <li class="" id="menuTawarPraktikum"><a href="<?php echo site_url('mahasiswa/tawar_praktikum');?>"><i class="icon-double-angle-right "></i> Tawar Praktikum</a> </li>
						<li class="" id="menuKelompokPraktikum"><a href="<?php echo site_url('mahasiswa/kelompok_praktikum');?>"><i class="icon-double-angle-right "></i> Kelompok Praktikum</a> </li>
						<li class="" id="menuJadwalPraktikum"><a href="<?php echo site_url('mahasiswa/jadwal_praktikum');?>"><i class="icon-double-angle-right "></i> Jadwal Praktikum</a> </li>
						

					</ul>
                </li>

                <li class="panel active">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle">
                        <i class="icon-table"></i> Transaksi
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; <!-- <span class="label label-info">6</span> --> &nbsp;
                    </a>
                    <ul class="" id="pagesr-nav">
						
						<li class="" id="menuDaftarPraktikum"><a href="<?php echo site_url('mahasiswa/daftar_praktikum');?>"><i class="icon-double-angle-right "></i> Pendaftar Praktikum</a> </li>
						<li class="" id="menuAsistenPraktikum"><a href="<?php echo site_url('mahasiswa/asisten_praktikum');?>"><i class="icon-double-angle-right "></i> Asisten Praktikum</a> </li>

                    </ul>
                </li>
                <li class="panel active">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle">
                        <i class="icon-table"></i> Akses Sistem
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; <!-- <span class="label label-info">6</span> --> &nbsp;
                    </a>
                    <ul class="" id="pagesr-nav">
						
						<li class="" id="menuDaftarPraktikum"><a href="<?php echo site_url('admin/user/login');?>"><i class="icon-double-angle-right "></i>Login</a> </li>

                    </ul>
                </li>
            </ul>

        </div>
        <!--END MENU SECTION -->



         <!--PAGE CONTENT -->
           <?php
			//echo $this->postal->get();
			?>
