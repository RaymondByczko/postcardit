<?php
/*
 * @file views/postcard/upload_complete.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-16, February 16, 2017
 * @purpose 
 * @change_history 2017-02-19, RByczko, Added site_url.
 * @status working, but @todo needs cleanup
 * @note Used JQuery core 1.12.4 instead of 3.1.1 .
 * @change_history, 2017-02-20, RByczko, Adjusted links to continue
 * in content area (that is, edit).  Also corrected links in footer.
 * @change_history, 2017-02-21, RByczko, Adjust Edit button.
 * @change_history, 2017-02-21, RByczko, Put uploaded pic into upload_complete.
 * @change_history, 2017-02-28, RByczko, Correct home button href. Added 'Help?'.
 */
?>
<!DOCTYPE html>
<html>
<head>
<title>You have uploaded a Postcard!</title>
<!--<link rel="stylesheet" href="/css/sheets/remindmestyles.css?version=0.2"> -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
</head>
<style>
</style>

<body class="mybody">
<div data-role="page" id="page1" data-dom-cache="true" data-fullscreen="true"><!-- page -->
  <div data-role="header" class="ui-bar" data-position="fixed" data-theme="b"><!-- header -->
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <h1>Postcard IT</h1>
    <a href="info" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-info ui-btn-icon-right">Info</a>
  </div><!-- header -->
  <div role="main" class="ui-content"><!-- main -->
<div class="subheader">
<pre>Added postcard id:<?php echo $id; ?></pre>
<pre>Added file size:<?php echo $upload_data['file_size']; ?></pre>
</div>
<div style="height:20%"><!-- EE -->
<!--<?php echo 'upload_path_name='.$upload_path_name; ?>-->
<img style="width:30%" src="<?php echo base_url($upload_path_name);?>">
</div><!-- EE -->
<div id="upload_complete_id" data-role="controlgroup">
	<a href="<?php echo site_url('postcard/edit/'.$id);?>" id="edit_choice" data-role="button">Edit</a>
</div>

<div data-role="collapsible">
	<h2>Help ?</h2>
	<p>At this point you have uploaded your image to postcardit.
	Now click the edit button to allow you to edit your image
	on your browser.
	</p>
</div>
</div><!-- main -->
<div data-role="footer" ddata-id="postcard_footer" class="ui-bar" data-position="fixed" data-theme="b"><!-- footer-->
  <a href="<?php site_url('postcard/cancel/'.$id);?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
  <a href="<?php site_url('postcard/upload_now/'.$id);?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-back">Previousssss-uplcom</a>
</div><!-- footer -->
</div><!-- page -->
</body>
</html>
