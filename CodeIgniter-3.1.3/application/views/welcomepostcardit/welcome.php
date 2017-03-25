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
 * @change_history RByczko, 2017-03-01, Fixed Cancel button.  Removed up, down
 * buttons because they are not need.  Commented out, and left for future ref.
 * Updated 'Help?'.
 * @todo I think I need to add a data-role (JQuery) of 'content' to follow
 * the header-content-footer pattern.
 * @change_history RByczko, 2017-03-05, Assigned unique page id to page.
 * Removed style for content. Code cleanup.  Adjust footer. Adjust help.
 * @change_history RByczko, 2017-03-06, Fixed header and footer sliding
 * up and down upon click.  Use data-fullscreen='true' in each. And don't
 * use it in page.  Contrary to book.
 * @change_history RByczko, 2017-03-06, Changed Information to About and
 * fixed its cutoff problem. Changed hmtl to html for DOCTYPE.
 * @advice  Don't use class='ui-bar' in header.
 * @change_history RByczko, 2017-03-07, Cleanup.  Insure data-fullscreen=true
 * is not in page, but in header, and footer. Insure ui-bar is not in header
 * nor footer.
 * @change_history RByczko, 2017-03-10, Added closing div which was missing.
 * @change_history RByczko, 2017-03-14, Added rel=external to Add button
 * since the postcard add page presents a form, and we want to do regular
 * http and avoid ajax (jquery mobile).
 * @change_history RByczko, 2017-03-21, Added the Database button so that
 * schema can be viewed, etc.
 */
?>
<!DOCTYPE html>
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
<div id="page_welcome_id" data-role="page" data-dom-cache="true" >
  <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="b"><!-- header -->
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="<?php echo site_url('postcard/about'); ?>" data-rel="dialog" data-transition="pop" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">About</a>
    <h1>Postcard IT</h1>
  </div><!-- header -->
  <div role="main" class="ui-content"><!-- main -->
		<div class="subheader">
			<pre>Hi - Welcome to postcardit!</pre>
		</div>
		<div id="add_id" data-role="controlgroup">
<a href="<?php echo site_url('postcard/add');?>" id="add_button_id" rel="external" data-role="button">Add</a>
		</div>
		<div id="database_id" data-role="controlgroup">
<a href="<?php echo site_url('database/database');?>" id="database_button_id" rel="external" data-role="button">Database</a>
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
			<p>Click the database button to interact with the database
			more directly.  Through it, you can view the schema, delete
			a postcard, or view the postcard table.
			</p>
			<p>And by the way, Cancel is disabled because it is not
			useful here.  There is nothing to Cancel from at the
			start page.
			</p>
		</div>
		<pre>The welcomepostcardit/welcome.php page here!</pre>
  </div><!-- main -->
<div data-role="footer" data-position="fixed" data-fullscreen="true" data-theme="b"><!-- footer -->
  <a href="<?php echo site_url('welcomepostcardit/index'); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
</div><!-- footer -->
</div>
</body>
</html>
