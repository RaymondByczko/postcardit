<?php
/*
 * @file views/database/database.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page presents a list of functions to access the database.
 * These functions include:
 *		* View Schema
 *		* Delete Postcard
 *		* View Postcard Table
 * @start_date 2017-03-18
 * @change_history RByczko, 2017-03-21 March 21, 2017; Worked on deletepostcard.
 */
?>
<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
<title>Postcardit-Database Functions</title>
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
<div id="page_functions_id" data-role="page" data-dom-cache="true"><!--page-->
  <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="b"><!-- header-->
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="<?php echo site_url('postcard/about'); ?>" data-rel="dialog" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">About</a>
    <h1>Postcard IT</h1>
  </div><!--header-->
  <div role="main" class="ui-content"><!--ui-content-->
<div class="subheader">
<pre>Hi - Check out the database here!</pre>
</div>
<div id="database_viewschema_id" data-role="controlgroup">
	<a href="<?php echo site_url('database/viewschema');?>" data-ajax="false" id="view_schema_id" data-role="button">View Schema</a>
</div>
<div id="database_deletepostcard_id" data-role="controlgroup">
	<?php $postcard_id_start=1;$num_postcards=5; ?>
	<a href="<?php echo site_url('database/deletepostcard/'.$postcard_id_start.'/'.$num_postcards);?>" data-ajax="false" id="delete_postcard_id" data-role="button">Delete Postcard</a>
</div>
<div id="database_viewpostcardtable_id" data-role="controlgroup">
	<a href="<?php echo site_url('database/viewpostcardtable');?>" data-ajax="false" id="view_postcard_table_id" data-role="button">View Postcard Table</a>
</div>
<div data-role="collapsible">
	<h2>Help ?</h2>
	<p>This page presents the various functions you can do on the database.
	It allows you to view its schema, or to delete a postcard, or to view
	the postcard table.
	</p>
</div>
<pre>The database/database.php page here!</pre>
</div><!--ui-content-->
<div data-role="footer" data-fullscreen="true" data-position="fixed" data-theme="b"><!--footer-->
  <a href="<?php echo site_url('welcomepostcard/index'); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
</div><!--footer-->
</div><!--page-->
</body>
</html>
