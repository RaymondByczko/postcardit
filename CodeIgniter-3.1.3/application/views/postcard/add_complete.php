<?php
/*
 * @file views/postcard/add_complete.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-16, February 16, 2017
 * @purpose This presents the logged in web page.
 * @change_history
 * @todo I think I need to add a data-role of 'content' to
 * follow the pattern header-content-footer.
 * @todo Fix/clarify purpose.
 * @change_history 2017-02-21, RByczko, Enhanced upload button.
 * @change_history 2017-02-26, RByczko, Changed interface slightly
 * @change_history 2017-02-28, RByczko, Correct home button href. Added 'Help?'.
 * @change_history 2017-03-01, RByczko, Fixed Cancel button. Adjusted 'Help?'.
 * Updated 'Previous' button. @todo Previous will go back to postcard/add
 * but the relevant postcard_id will be lost. A new submit on the add wil
 * generate a new postcard record.  However, an incomplete record will be sitting
 * around.
 * to conform to better naming convention (from, to, etc).
 * @change_history 2017-03-05, RByczko, Added header, content comment markers.
 * Cleaned up footer.
 * @change_history 2017-03-07, RByczko, Fixed with respect to using data-fullscreen.
 * Removed from page, added to header, insured it is in footer.  Removed ui-bar
 * from header. Changed Info to About and put in site_url. Remember site_url requires
 * echo to work in this circumstance. Change data-dom-cache to true in page.
 * @change_history 2017-03-10, RByczko, Added rel="external" to Previous link to insure
 * the ajax behavior is disabled for anchor tag (representing the Previous button).
 * This helps for going to a link that represents a folder.
 */
?>
<html>
<head>
<title>You have added a Postcard!</title>
<!--<link rel="stylesheet" href="/css/sheets/remindmestyles.css?version=0.2"> -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<!--<script type="text/javascript" src="/JQuery_3_1_1/jquery-3.1.1.js"></script>-->
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
</head>
<style>
</style>
<!-- @todo decide on class for body -->
<body class="mybody">
<div data-role="page" data-dom-cache="true" id="page_add_complete"><!-- page -->
  <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="b"><!--header-->
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <h1>Postcard IT</h1>
    <a href="<?php echo site_url('postcard/about'); ?>" data-rel="dialog" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-info ui-btn-icon-right">About</a>
  </div><!-- header-->
  <div role="main" class="ui-content"><!--ui-content-->
	<div class="subheader">
		<pre>ADDED</pre>
		<pre>From name:<?php echo $from_name; ?></pre>
		<pre>From email:<?php echo $from_email; ?></pre>
		<pre>To name:<?php echo $to_name; ?></pre>
		<pre>To email:<?php echo $to_email; ?></pre>
		<pre>Subject:<?php echo $subject; ?></pre>
		<pre>Message:<?php echo $message; ?></pre>
	</div>
	<div id="add_complete_id" data-role="controlgroup">
		<a href="<?php echo site_url('postcard/upload_now/'.$postcard_id);?>" data-ajax="false" id="upload_choice" data-role="button">Upload</a>
	</div>
	<div data-role="collapsible">
		<h2>Help ?</h2>
		<p>The information you entered on the form is indicated above.
		Now you can go ahead and upload an image to the server, so
		you can then modify it, and send it as a postcard.
		Click Upload to proceed!  If you wish to cancel making this
		card, click Cancel.  It will delete the card.
		</p>
	</div>
    </div><!--ui-content-->
<div data-role="footer" data-fullscreen="true" class="ui-bar" data-position="fixed" data-theme="b"><!-- footer -->
	<a href="<?php echo site_url('postcard/cancel/'.$postcard_id);?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
	<a href="<?php echo site_url('postcard/add');?>" rel="external" id="add_complete_previous_id" data-role="button">Previous</a>
</div><!--footer-->
</div><!--page-->
</body>
</html>
