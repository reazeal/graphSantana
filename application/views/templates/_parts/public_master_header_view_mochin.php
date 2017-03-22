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
	<link rel="stylesheet" href="<?php echo site_url('assets/mahasiswa/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/mahasiswa/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/mahasiswa/css/animate.min.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/mahasiswa/css/et-line-font.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/mahasiswa/css/nivo-lightbox.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/mahasiswa/css/nivo_themes/default/default.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/mahasiswa/css/style.css');?>">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>

		</head>
	
<body data-target=".navbar-collapse" data-offset="50">

<!-- preloader section -->
<div class="preloader">
	<div class="sk-spinner sk-spinner-circle">
       <div class="sk-circle1 sk-circle"></div>
       <div class="sk-circle2 sk-circle"></div>
       <div class="sk-circle3 sk-circle"></div>
       <div class="sk-circle4 sk-circle"></div>
       <div class="sk-circle5 sk-circle"></div>
       <div class="sk-circle6 sk-circle"></div>
       <div class="sk-circle7 sk-circle"></div>
       <div class="sk-circle8 sk-circle"></div>
       <div class="sk-circle9 sk-circle"></div>
       <div class="sk-circle10 sk-circle"></div>
       <div class="sk-circle11 sk-circle"></div>
       <div class="sk-circle12 sk-circle"></div>
    </div>
</div>

<!-- navigation section -->
<section class="navbar navbar-fixed-top custom-navbar" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand">SIMPRA <font size='2'><i>Sistem Informasi Praktikum</i></font></a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo site_url('');?>" class="smoothScroll">HOME</a></li>
				<li><a href="#about" class="smoothScroll">ABOUT</a></li>
				<li><a href="#contact" class="smoothScroll">CONTACT</a></li>
			</ul>
		</div>
	</div>
</section>

<!-- home section -->
<!-- work section -->
<section id="work">
	<div class="container">
		<div class="row">
			<a href='<?php echo site_url('mahasiswa/tawar_praktikum');?>'>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<i class="icon-cloud medium-icon"></i>
					<h3>TAWAR PRAKTIKUM</h3>
					<hr>
					<p>Tawar Praktikum adalah menu yang digunakan untuk melihat daftar mata kuliah praktikum yang ditawarkan pada semester ini..</p>
			</div>
			</a>
			<a href='<?php echo site_url('mahasiswa/ruang_praktikum');?>'>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.9s">
				<i class="icon-mobile medium-icon"></i>
					<h3>RUANG PRAKTIKUM</h3>
					<hr>
					<p>Ruang Praktikum menampilkan daftar Ruang yang akan digunakan dalam pelaksanaan praktikum oleh mahasiswa.</p>
			</div>
			</a>
			<a href='#'>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="1s">
				<i class="icon-laptop medium-icon"></i>
					<h3>KELOMPOK PRAKTIKUM</h3>
					<hr>
					<p>Praktikum dibentuk dalam kelompok yang telah ditentukan. Menu ini dapat digunakan untuk melihat daftar kelompok yang ditawarkan.</p>
			</div>
			</a>
			<a href='#'>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="1s">
				<i class="icon-compass medium-icon"></i>
					<h3>PENDAFTARAN</h3>
					<hr>
					<p>Halaman ini digunakan untuk melakukan pendaftaran agar mahasiswa dapat melaksanakan Praktikum pada semester ini.</p>
			</div>
			</a>
			<a href='#'>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="1s">
				<i class="icon-chat medium-icon"></i>
					<h3>PESERTA</h3>
					<hr>
					<p>Halaman ini digunakan untuk mengakses daftar peserta yang telah terdaftar pada sistem praktikum semester ini.</p>
			</div>
			</a>
			<a href='#'>
			<div class="col-lg-4 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="1s">
				<i class="icon-browser medium-icon"></i>
					<h3>BERKAS PRAKTIKUM</h3>
					<hr>
					<p>File-file yang dibutuhkan selama pelaksanaan praktikum akan diunggah dah dapat anda temukan pada halaman ini.</p>
			</div>
			</a>
		</div>
	</div>
</section>


