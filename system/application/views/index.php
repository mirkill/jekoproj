<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Jeka" />
<meta name="description" content="Jeka" />
<title>Jeka</title>
<link type="text/css" rel="stylesheet" href="/css/reset-fonts-grids.css" />

<!-- CSS -->

<link rel="stylesheet" type="text/css" href="css/default.css" />
<link type="text/css" rel="stylesheet" href="/css/all.css" />
<link type="text/css" rel="stylesheet" href="/css/thickbox.css" />
<!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="/css/lt7.css" media="screen"/><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css" media="screen"/><![endif]-->


<!-- JavaScript -->
<script type="text/javascript" src="/js/jquery-1.3.1.pack.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script type="text/javascript" src="/js/thickbox.js"></script>
<script type="text/javascript" src="/js/user-control.js"></script>
<script type="text/javascript" src="/js/ajax.js"></script>


<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

</head>
<body>

<h1 class="logo"><a href="/">Placester</a></h1>
<div class="yui-t7 custom-doc">
<div class="bd">
<?php
$this->load->view('header');
?>
<div class="layout_box" id="body">
				<div class="layout_box_t">
					<div class="layout_box_tl"></div>
					<div class="layout_box_tr"></div>
				</div>
				<div class="layout_box_left">
					<div class="layout_box_left_ie"></div>
					<div class="layout_box_right">
						<div class="layout_box_right_ie"></div>
						<div class="layout_box_holder">
<?php 
$this->load->view($view['view_path'] . '/' . $view['view_name']);
?>
</div>
					</div>
				</div>
				<div class="layout_box_b">
					<div class="layout_box_bl"></div>
					<div class="layout_box_br"></div>
				</div>
			</div>


</div>
</div>
<?php
$this->load->view('footer');
?>
</body>
</html>
