<?php
/*
 * @file views/postcard/exception.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page provides a way to view an exception within the postcardit
 * website.
 * @start_date 2017-03-10
 * @todo - The About button presents a dialog, and then goes to the add.
 * @change_history RByczko, 2017-03-14, Fixed About button.  Instead of going to add,
 * it remains at where it should be, via data-url and e_site_url.
 */
?>
<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
<title>Postcardit-Error</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<!--<script type="text/javascript" src="/JQuery_3_1_1/jquery-3.1.1.js"></script>-->
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<style>
</style>-->
</head>
<body>
<div id="page_exception_id" data-role="page" data-url="<?php echo $e_site_url;?>" data-dom-cache="false"><!--page-->
  <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="b"><!-- header-->
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="<?php echo site_url('postcard/about'); ?>" data-rel="dialog" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">About</a>
    <h1>Postcard IT</h1>
  </div><!--header-->
  <div role="main" class="ui-content"><!--ui-content-->
<pre>Hi - Unfortunately an error has been detected.</pre>
<div class="errorinfo">
	<p>Error id: <?php echo $unique_id; ?></p>
	<p>Message: <?php echo $message; ?></p>
</div>
<div data-role="collapsible">
	<h2>Help ?</h2>
	<p>This is the is an error reporting stage.  Please note
	the unique id given above and give it to the support staff
	for postcardit.
	</p>
	<p>
    Cancel is not enabled because the only choice is to go Home.
	</p>
</div>
<pre>The postcard/exception.php page here!</pre>
</div><!--ui-content-->
<div data-role="footer" data-fullscreen="true" data-position="fixed" data-theme="b"><!--footer-->
  <a href="<?php echo site_url('welcomepostcard/index'); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
</div><!--footer-->
</div><!--page-->
</body>
</html>
