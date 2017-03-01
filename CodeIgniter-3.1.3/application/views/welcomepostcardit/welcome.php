<?php
/*
 * @file views/welcomepostcardit/welcome.php
 * @author Raymond Byczko
 * @company self
 * @purpose This welcom page represents the first first page encountered
 * when the postcardit web site is brought up.  It offers options:
 *		* add
 *		* database
 * @start_date 2017-02-28
 * @change_history RByczko, 2017-02-26, Added subject. Change name convention
 * for relevant form (database etc) values (from, to, etc).
 * @todo I think I need to add a data-role (JQuery) of 'content' to follow
 * the header-content-footer pattern.
 */
?>
<!DOCTYPE hmtl>
<html>
<head>
<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
<title>Postcardit-Welcome</title>
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
<div data-role="page" data-fullscreen="true">
  <div data-role="header" class="ui-bar" data-position="fixed" data-theme="b"><!-- header -->
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="info" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Information</a>
    <h1>Postcard IT</h1>
  </div><!-- header -->
  <div role="main" class="ui-content" style="height:inherit"><!-- main -->
		<div class="subheader">
			<pre>Hi - Welcome to postcardit!</pre>
		</div>

		<div id="add_id" data-role="controlgroup">
			<a href="<?php echo site_url('postcard/add');?>" id="add_button_id" data-role="button">Add</a>
		</div>
		<div data-role="collapsible">
			<h2>Help ?</h2>
			<p>Welcome to the postcardit website.  This is the start
			page for this site. Click the add button to start
			a new postcard.  You will be guided step by step to add
			initial email details.  From there you can upload the
			postcard image.  Third, you will edit it.  And lastly you
			can send the postcard on its way.
			</p>
		</div>
		<pre>The welcomepostcardit/welcome.php page here!</pre>
  </div><!-- main -->
<div data-role="footer" class="ui-bar" data-position="fixed" data-theme="b"><!-- footer -->
  <a href="cancel" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
  <a href="index.html" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-arrow-u">Up</a>
  <a href="index.html" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-arrow-d">Down</a>
</div><!-- footer -->
</div>
</body>
</html>
