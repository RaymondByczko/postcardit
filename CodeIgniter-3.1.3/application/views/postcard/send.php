<?php
/*
 * @file views/postcard/send.php
 * @author Raymond Byczko
 * @company self
 * @purpose This send page presents a form to send a postcard.
 * It presents:
 *		image of inprocess file (modified with text saved onto it)
 *		email parameters (from, to, subject, message)
 *		'send postcard' button
 * @start_date 2017-02-26
 * @change_history RByczko, 2017-02-26 February 26, 2017, Started this file.
 * @todo I think I need to add a data-role (JQuery) of 'content' to follow
 * the header-content-footer pattern.
 */
?>
<!DOCTYPE hmtl>
<html>
<head>
<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
<title>Postcardit-Send</title>
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
  <div data-role="header" class="ui-bar" data-position="fixed" data-theme="b"><!--header-->
    <a href="home" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="info" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Information</a>
    <h1>Postcard IT</h1>
  </div><!--header-->
	<div role="main" class="ui-content"><!--content-->
		<div class="subheader">
			<pre>Hi - Please send your postcard!</pre>
		</div>

		<div style="height:20%"><!-- EE -->
		<img style="width:30%" src="<?php echo base_url($inprocess_path_name);?>">
		</div><!-- EE -->

		<pre>The postcard/send.php page here!</pre>
	</div><!--content-->
	<div data-role="footer" class="ui-bar" data-position="fixed" data-theme="b"><!--footer-->
	  <a href="cancel" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
	  <a href="index.html" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-arrow-u">Up</a>
	  <a href="index.html" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-arrow-d">Down</a>
	</div><!--footer-->
</div>
</body>
</html>
<script>
$("#send_id").bind("click", function(event, data) {
	console.log("send_id:click");
	// $("#send_canvas_id").addClass("ui-disabled");
	$.post({
		url: "<?php echo '/index.php/postcard/send_postcard_ajax/'.$postcard_id.'/0'; ?>",
		data: ({ 
			// imagedata:dataURL,
			// moredata:'hereitis'
		})
	}).done(function(o) {
  		console.log('post for send postcard complete'); 
		console.log(o);
		if (o.ret_code == 0) {
			console.log('... sent successfully');
			// $("#send_canvas_id").removeClass("ui-disabled");
		}
		else
		{
			console.log('... not sent successfully');
		}
});
});
</script>
