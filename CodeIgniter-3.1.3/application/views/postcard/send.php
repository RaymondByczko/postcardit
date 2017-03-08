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
 * @change_history, 2017-02-28, RByczko, Correct home button href. Added 'Help?'.
 * @change_history, 2017-03-01, RByczko, Fix Cancel button.  Update 'Help?'.
 * @todo I think I need to add a data-role (JQuery) of 'content' to follow
 * the header-content-footer pattern.
 * @change_history, 2017-03-05, RByczko, Adjust footer (add New).
 * @change_history, 2017-03-07, RByczko, Fix data-fullscreen. Removed in page,
 * added to header, added to footer. Removed ui-bar from header, footer. Change
 * Info to About.  Add send_page_id.
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
<div data-role="page" id="send_page_id" >
  <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="b"><!--header-->
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="<?php echo site_url('postcard/about'); ?>" data-rel="dialog" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">About</a>
    <h1>Postcard IT</h1>
  </div><!--header-->
	<div role="main" class="ui-content"><!--content-->
		<div class="subheader">
			<pre>Hi - Please send your postcard!</pre>
		</div>

		<div style="height:20%"><!-- EE -->
		<img style="width:30%" src="<?php echo base_url($inprocess_path_name);?>">
		</div><!-- EE -->

		<div data-role="collapsible">
			<h2>Help ?</h2>
			<p>At this point your postcard with the modified image has
			been sent. If you wish to cancel making this card, click Cancel.
			It will delete the card.
			</p>
		</div>
		<pre>The postcard/send.php page here!</pre>
	</div><!--content-->
	<div data-role="footer" data-position="fixed" data-fullscreen="true" data-theme="b"><!--footer-->
	  <a href="<?php echo site_url('postcard/cancel/'.$postcard_id);?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
	  <a href="<?php echo site_url('postcard/add/'); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">New</a>
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
