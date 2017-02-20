<?php
/*
 * @file views/postcard/upload.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-16
 * @change_history RByczko
 * @status working, but @todo needs cleanup
 * @note Used JQuery core 1.12.4 instead of 3.1.1 .
 * @important note the data-ajax setting to false for the form!
 * Not doing this will cause hours of wasted time trying to figure
 * why the form does not work properly.
 * @change_history RByczko,2017-02-20, Added site_url to footer.  Removed commented
 * out code
 */
?>
<!DOCTYPE hmtl>
<html>
<head>
<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
<title>Postcardit-Upload</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>

<style>
</style>
</head>
<body class="mybody">
<div data-role="page" id="page1" data-fullscreen="true"><!-- page -->
  <div data-role="header" class="ui-bar" data-position="fixed" data-theme="b"><!-- header -->
    <a href="home" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <h1>Postcard IT</h1>
    <a href="info" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-info ui-btn-icon-right">Info</a>
  </div><!-- header -->
  <div role="main" class="ui-content"><!-- main -->
<div class="subheader">
<pre>Hi - Please upload your postcard!</pre>
</div>
<div><!-- AA -->
<?php echo 'Error='.$error; ?>
<?php echo form_open_multipart(site_url('postcard/upload_now/'.$id), array('data-ajax'=>'false')); ?>
<!--<input type="hidden" name="MAX_FILE_SIZE" value="10240" >-->
<input type="file" name="userfile" size="300" />
<input type="submit" value="Upload it" />
<?php echo form_close(); ?>
<!--</form>-->
<!-- AA -->
<pre>The postcard/upload.php page here!</pre>
</div><!-- main -->
<div data-role="footer" data-id="postcard_footer" class="ui-bar" data-position="fixed" data-theme="b"><!-- footer-->
  <a href="<?php echo site_url('postcard/cancel/'.$id); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
  <a href="<?php echo site_url('postcard/add/'.$id); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-back">Previous</a>
</div><!-- footer -->
</div><!-- page -->
</body>
</html>
