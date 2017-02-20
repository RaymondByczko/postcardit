<?php
/*
 * @file views/postcard/upload_complete.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-16, February 16, 2017
 * @purpose 
 * @change_history
 */
?>
<html>
<head>
<title>You have uploaded a Postcard!</title>
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

<body class="mybody">
<div data-role="page" id="page1" data-fullscreen="true"><!-- page -->
  <div data-role="header" class="ui-bar" data-position="fixed" data-theme="b"><!-- header -->
    <a href="home" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <h1>Postcard IT</h1>
    <a href="info" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-info ui-btn-icon-right">Info</a>
  </div><!-- header -->
  <div role="main" class="ui-content"><!-- main -->
<div class="subheader">
<pre>Added postcard id:<?php echo $id; ?></pre>
<pre>Added file size:<?php echo $upload_data['file_size']; ?></pre>
</div>
<div class="menu">
<div class="menu_choice">
<a href="<?php echo site_url('postcard/upload/'.$id);?>"><div id="upload_choice">Upload</div></a>
<a href="/igniter/index.php/reminder/create/<?php echo $id?>"><div id="menu_create">Create</div></a>
</div><!-- comment
--><div class="menu_choice">
<a href="/igniter/index.php/reminder/delete/<?php echo 'ai'?>"><div id="menu_delete">Delete</div></a>
</div><!-- comment
-->
</div>
</div><! -- main -->
<div data-role="footer" data-id="postcard_footer" class="ui-bar" data-position="fixed" data-theme="b"><!-- footer-->
  <a href="cancel" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
  <a href="index.html" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-back">Previous</a>
</div><!-- footer -->
</div><!-- page -->
</body>
</html>