<?php
/*
 * @file views/postcard/about.php
 * @author Raymond Byczko
 * @company self
 * @purpose This presents a page in the form of a dialog.  It presents
 * information about the postcardit website.
 * @start_date 2017-03-06
 * @change_history RByczko, 2017-02-26, Added subject. Change name convention
 */
?>
<!DOCTYPE hmtl>
<html>
<head>
	<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
	<title>Postcardit-About</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
	<!--<script type="text/javascript" src="/JQuery_3_1_1/jquery-3.1.1.js"></script>-->
	<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div id="page_about_id" data-role="page"><!--page-->
	<div data-role="header" class="ui-bar" data-position="fixed" data-theme="b"><!-- header-->
		<h1>About</h1>
	</div><!--header-->
	<div role="main" class="ui-content"><!--ui-content-->
		<h5>Web Developer: Raymond Byczko</h5>
		<h5>Email: raymondbyczko@att.net</h5>
		<h5>JQueryMobile1.4.5,JQuery1.12.4,CodeIgniter3.1.3</h5>
		<h5>github: https://github.com/RaymondByczko/postcardit</h5>
	</div><!--ui-content-->
</div><!--page-->
</body>
</html>
