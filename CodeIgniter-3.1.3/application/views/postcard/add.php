<?php
/*
 * @file views/postcard/add.php
 * @author Raymond Byczko
 * @company self
 * @purpose This add page presents a form to starting adding a new postcard.
 * (It also goes by another name, "GetInfo".) It starts the process by
 * presenting a form to grab initial postcard details.  See p. 30 of Diary #8.
 * @start_date 2017-02-16
 * @change_history RByczko
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
<div data-role="page" data-fullscreen="true">
  <div data-role="header" class="ui-bar" data-position="fixed" data-theme="b">
    <a href="home" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="info" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Information</a>
    <h1>Postcard IT</h1>
  </div>
<div class="subheader">
<pre>Hi - Please add your postcard!</pre>
</div>
<?php echo validation_errors(); ?>
<?php echo form_open('postcard/add'); ?>
<h5>Email:</h5>
<input type="text" name="email" value="" size="50" />
<h5>From:</h5>
<input type="text" name="from" value="" size="50" />
<h5>To:</h5>
<input type="text" name="recipient" value="" size="50" />
<h5>Message:</h5>
<input type="text" name="message" value="" size="50" />
<hr></hr>
<div><input type="submit" value="Submit" /></div>
</form>
<pre>The postcard/add.php page here!</pre>
<div data-role="footer" class="ui-bar" data-position="fixed" data-theme="b">
  <a href="cancel" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
  <a href="index.html" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-arrow-u">Up</a>
  <a href="index.html" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-arrow-d">Down</a>
</div>
</div>
</body>
</html>
