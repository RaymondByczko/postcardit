<?php
/*
 * @file views/database/viewschema.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page presents the database schema to the user.
 *		In this page you can see:
 *			* Tables in the schema
 *			* Fields in each table
 * @start_date 2017-03-20
 * @change_history RByczko, 2017-03-21, @todo Adjust NOOP site_urls. 
 */
?>
<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
<title>Postcardit-View Schema</title>
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
<div id="page_viewschema_id" data-role="page" data-dom-cache="true"><!--page-->
  <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="b"><!-- header-->
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="<?php echo site_url('postcard/about'); ?>" data-rel="dialog" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">About</a>
    <h1>Postcard IT</h1>
  </div><!--header-->
  <div role="main" class="ui-content"><!--ui-content-->
<div class="subheader">
<pre>Hi - Check out the schema here!</pre>
</div>
<div id="viewschema_noop1_id" data-role="controlgroup">
	<a href="<?php echo site_url('database/postcard');?>" data-ajax="false" id="delete_postcard_id" data-role="button">NOOP1</a>
</div>
<div id="viewschema_noop2_id" data-role="controlgroup">
	<a href="<?php echo site_url('database/viewpostcardtable');?>" data-ajax="false" id="view_postcard_table_id" data-role="button">NOOP2</a>
</div>

<div data-role="collapsible">
	<h2>Schema ?</h2>
	<pre>
	<?php
		echo "\n";
		echo '<H1>TABLES</H1>';
		foreach ($tables as $table)
		{
			echo $table."\n";
		}
		echo '<H1>FIELDS</H1>';
		foreach ($tables as $table)
		{
			$table_fields = $fields[$table];
			echo $table."\n";
			foreach ($table_fields as $field)
			{
				echo '...'.$field."\n";
			}
		}
	?>
	</pre>
</div>
<div data-role="collapsible">
	<h2>Help ?</h2>
	<p>This page presents information related to the database.
	It is possible to see which tables are present, and which
	fields are present in each table.
	</p>
</div>
<pre>The database/viewschema.php page here!</pre>
</div><!--ui-content-->
<div data-role="footer" data-fullscreen="true" data-position="fixed" data-theme="b"><!--footer-->
  <a href="<?php echo site_url('welcomepostcard/index'); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
</div><!--footer-->
</div><!--page-->
</body>
</html>
