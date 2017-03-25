<?php
/*
 * @file views/database/processdelete.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page presents the fact that a row was deleted.
 * @start_date 2017-03-22
 * @change_history RByczko, 2017-03-25 March 25, 2017, An initial
 * implementation is in place. @todo need to specify exact record
 * that was deleted and status (success or failure).
 */
?>
<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
<title>Postcardit-Process Delete</title>
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
<div id="page_processdelete_id" data-role="page" data-dom-cache="true"><!--page-->
  <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="b"><!-- header-->
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="<?php echo site_url('postcard/about'); ?>" data-rel="dialog" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">About</a>
    <h1>Postcard IT</h1>
  </div><!--header-->
  <div role="main" class="ui-content"><!--ui-content-->
<div class="subheader">
<pre>Hi - A postcard was deleted here!</pre>
</div>
<div id="viewschema_noop1_id" data-role="controlgroup">
	<a href="<?php echo site_url('database/postcard');?>" data-ajax="false" id="delete_postcard_id" data-role="button">NOOP1 Proc Del</a>
</div>
<div id="viewschema_noop2_id" data-role="controlgroup">
	<a href="<?php echo site_url('database/viewpostcardtable');?>" data-ajax="false" id="view_postcard_table_id" data-role="button">NOOP2 Proc Del</a>
</div>
<div data-role="collapsible">
	<h2>Help ?</h2>
	<p>This page presents information about which row was
	deleted in the database.
	</p>
</div>
<pre>The database/processdelete.php page here!</pre>
</div><!--ui-content-->
<div data-role="footer" data-fullscreen="true" data-position="fixed" data-theme="b"><!--footer-->
  <a href="<?php echo site_url('welcomepostcard/index'); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
</div><!--footer-->
</div><!--page-->
</body>
</html>
