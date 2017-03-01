<?php
/*
 * @file views/postcard/add.php
 * @author Raymond Byczko
 * @company self
 * @purpose This add page presents a form to starting adding a new postcard.
 * (It also goes by another name, "GetInfo".) It starts the process by
 * presenting a form to grab initial postcard details.  See p. 30 of Diary #8.
 * @start_date 2017-02-16
 * @change_history RByczko, 2017-02-26, Added subject. Change name convention
 * for relevant form (database etc) values (from, to, etc).
 * @change_history RByczko, 2017-02-28, Correct home button href. Added 'Help?'.
 * @change_history RByczko, 2017-03-01, Commented out Up, Down because they
 * are not needed.
 * @change_history RByczko, 2017-03-01, Added set_value calls to form. Trying
 * to fix Previous blue in Add complete step. It did not seem to work. Removed.
 * @todo I think I need to add a data-role (JQuery) of 'content' to follow
 * the header-content-footer pattern.
 */
?>
<!DOCTYPE hmtl>
<html>
<head>
<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
<title>Postcardit-Add</title>
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
<div id="page_add" data-role="page" data-dom-cache="true" data-fullscreen="true">
  <div data-role="header" class="ui-bar" data-position="fixed" data-theme="b">
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="info" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Information</a>
    <h1>Postcard IT</h1>
  </div>
  <div role="main" class="ui-content"><!--ui-content-->
<div class="subheader">
<pre>Hi - Please add your postcard!</pre>
</div>
<?php echo validation_errors(); ?>
<?php echo form_open('postcard/add'/*, array('data-dom-cache'=>"false")*/); ?>
<h5>From Name:</h5>
<input type="text" name="from_name" value="" size="50" />
<h5>From Email:</h5>
<input type="text" name="from_email" value="" size="50" />
<h5>To Name:</h5>
<input type="text" name="to_name" value="" size="50" />
<h5>To Email:</h5>
<input type="text" name="to_email" value="" size="50" />
<h5>Message:</h5>
<input type="text" name="message" value="" size="50" />
<h5>Subject:</h5>
<input type="text" name="subject" value="" size="50" />
<hr></hr>
<div><input type="submit" value="Submit" /></div>
</form>

<div data-role="collapsible">
	<h2>Help ?</h2>
	<p>This is the first step to making a postcard.
	First, details on the email you want to send are asked for.
	Enter the 'from' and 'to' details and click the
	submit button.  After you submit, you will be
	asked to pick an image on your computer and upload it.
	</p>
	<p>
    Cancel is not enabled because you have not added anything
	yet, until you click Submit.
	</p>
</div>
<pre>The postcard/add.php page here!</pre>

</div><!--ui-content-->
<div data-role="footer" data-fullscreen="true" ddata-id="1_postcard_footer"  class="ui-bar" data-position="fixed" data-theme="b">
  <a href="<?php echo site_url('welcomepostcard/index'); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
  <!-- REM BUTTONS
  <a href="index.html" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-arrow-u">Up</a>
  <a href="index.html" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-arrow-d">Down</a>
  REM BUTTONS -->
</div>
</div>
</body>
</html>
