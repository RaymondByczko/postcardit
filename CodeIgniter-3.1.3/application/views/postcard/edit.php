<?php
/*
 * @file views/postcard/edit.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-19
 * @change_history RByczko, 2017-02-20, Added canvas. Draft quality.
 * @change_history RByczko, 2017-02-21, Take 2nd copy of uploaded pic out.
 * Just provide the canvas one.
 * @change_history RByczko, 2017-02-22, Added Save and Send buttons.
 * Disabling the save button works.  @todo Need to enhance and remove
 * commented out code.
 * @change_history RByczko, 2017-02-22, Cleaned up code.
 * @change_history RByczko, 2017-02-22, Move and change 'Change Canvas' button.
 * @change_history RByczko, 2017-02-22, Removed:
 *		$("#send_canvas_id").onload = function() { ...
 *		It was not called. @todo research button onload possibilities.
 * 
 * @change_history RByczko, 2017-02-22, Removed the following:
 *	$("#save_canvas_id").attr("disabled", "disabled");
 *	$("#save_canvas_id").button("disable");
 * These don't seem to work but are possible @todo research subjects.
 * Further code cleanup.
 * @change_history RByczko, 2017-02-25, Added ajax call.  POST works, but
 * only roughly.  Needs significant enhancement and cleanup.
 * @change_history RByczko, 2017-02-25, Some cleanup to ajax post call.
 * @change_history RByczko, 2017-02-25, Enhanced ajax post done.
 * @change_history RByczko, 2017-02-26, Worked on send button.
 * @change_history RByczko, 2017-02-28, Correct home button href. Added 'Help?'.
 * @status @todo partial draft, needs testing, enhancement
 * @note Used JQuery core 1.12.4 instead of 3.1.1 .
 * @change_history RByczko, 2017-03-05, Removed data-id from footer, its not
 * required to be persistent at this time.  Added data-ajax false to Previous link.
 */
?>
<!DOCTYPE hmtl>
<html>
<head>
<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
<title>Postcardit-Edit</title>
<script>
</script>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
<script>
var context;
var canvas;
</script>
<style>
</style>
</head>
<body class="mybody">
<div data-role="page" id="page_e" data-fullscreen="true" style="height:100%"><!-- page -->
  <div data-role="header" class="ui-bar" data-position="fixed" data-theme="b"><!-- header -->
    <a href="<?php site_url('welcomepostcardit/index'); ?>" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <h1>Postcard IT</h1>
    <a href="info" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-info ui-btn-icon-right">Info</a>
  </div><!-- header -->
  <div role="main" class="ui-content" style="height:inherit"><!-- main -->
<div class="subheader">
<script>function dochange() {
	// dochange - applies the message $postcard_message to canvas.
	context.fillStyle="#FF0000";
	context.fillText("<?php echo $postcard_message; ?>",30,30);
	console.log("dochange called");
}
</script>
<pre>Hi - Please edit your postcard!</pre>
</div>
<div><!-- FF -->
 <canvas id="myCanvas" width="200" height="300" style="border:1px solid #000000;">
</canvas> 
<button onclick="dochange();">Apply Message</button>
</div><!-- FF -->
<div data-role="fieldcontainer">
<label for="postcardtext_id">Text:</label>
<input type="text" id="postcardtext_id" name="postcardtext">
</div>
<div id="apply_postcardtext_id" data-role="controlgroup">
	<a href="#" data-role="button" id="apply_canvas_id">Apply</a>
	<a href="#" data-role="button" ui-disabled="true" id="save_canvas_id">Save</a>
	<a href="<?php echo site_url('postcard/send/'.$postcard_id); ?>" data-role="button" ui-disabled="true" id="send_canvas_id">Send</a>
</div>

<div data-role="collapsible">
	<h2>Help ?</h2>
	<p>Your are now presented a copy of your uploaded image on
	a local canvas.  Type in some text into the entry field and
	click apply.  Upon applying the text, the canvas will be modified.
	You can then save the canvas image.  Clicking save will save it
	to the server.  Then, finally, upon it successfully being saved,
	you can send it.  Each button will go from disabled to enabled
	as it makes sense for the process.
	</p>
</div>
<pre>The postcard/edit.php page here!</pre>
</div><!-- main -->
<div data-role="footer" ddddata-id="postcard_footer" class="ui-bar" data-position="fixed" data-theme="b"><!-- footer-->
  <a href="<?php echo site_url('postcard/cancel/'.$postcard_id); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
  <a href="<?php echo site_url('postcard/upload_now/'.$postcard_id); ?>" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-back">Previous</a>
</div><!-- footer -->
<script>
console.log("pageinit_bind");
window.onload = function() {
console.log("pageinit_start");
canvas = $('#myCanvas')[0]; // grabs the canvas element
context = canvas.getContext('2d'); // returns the 2d context object
var img = new Image(); //creates a variable for a new image

img.src = '<?php echo $upload_path_name; ?>'; // specifies the location of the image
context.drawImage(img,0,0); // draws the image at the specified x and y location
$("#save_canvas_id").attr("disabled", "disabled");
$("#send_canvas_id").attr("disabled", "disabled");
console.log("pageinit_end");
};


$("#myCanvas").onload = function() {
console.log("myCanvas_start");
};


$("#page_e").bind("pagebeforecreate", function(event, data) {
console.log("page_e_pagebeforecreate");
});

$("#page_e").bind("pagecreate", function(event, data) {
console.log("page_e_pagecreate");
});

$("#page_e").bind("pageinit", function(event, data) {
console.log("page_pageinit");
canvas = $('#myCanvas')[0]; // grabs the canvas element
context = canvas.getContext('2d'); // returns the 2d context object
var img = new Image(); //creates a variable for a new image
img.onload = function() {
context.drawImage(img,0,0); // draws the image at the specified x and y location
};
img.src = '<?php echo $upload_path_name; ?>'; // specifies the location of the image

$("#save_canvas_id").addClass("ui-disabled");
$("#send_canvas_id").addClass("ui-disabled");

$("#send_canvas_id").onload = function() {
	console.log("send_canvas_id_onload");
	$("#send_canvas_id").button("disable");
}
$("#send_canvas_id").data("disabled", true);
});

$("#page_e").bind("pageremove", function(event, data) {
console.log("page_e_pageremove");
});

$("#page_e").bind("pagebeforeload", function(event, data) {
console.log("page_e_pagebeforeload");
});

$("#page_e").bind("pageload", function(event, data) {
console.log("page_e_pageload");
});

$("#page_e").bind("pageloadfailed", function(event, data) {
console.log("page_e_pageloadfailed");
});

$("#apply_canvas_id").bind("click", function(event, data) {
console.log("apply_canvas_id:click");
var pc_text = $("#postcardtext_id").val();
console.log(pc_text);
context.fillStyle="#FF0000";
context.fillText(pc_text,30,30);
$("#save_canvas_id").removeClass("ui-disabled");
});

$("#save_canvas_id").bind("click", function(event, data) {
	console.log("save_canvas_id:click");
	$("#send_canvas_id").addClass("ui-disabled");
	var dataURL = canvas.toDataURL();
	$.post({
		url: "<?php echo '/index.php/postcard/save_postcard/'.$postcard_id; ?>",
		data: ({ 
			imagedata:dataURL,
			moredata:'hereitis'
		})
	}).done(function(o) {
  		console.log('post for canvas complete'); 
		console.log(o);
		if (o.ret_code == 0) {
			console.log('... saved successfully');
			$("#send_canvas_id").removeClass("ui-disabled");
		}
		else
		{
			console.log('... not saved successfully');
		}
	    // If you want the file to be visible in the browser 
	    // - please modify the callback in javascript. All you
	    // need is to return the url to the file, you just saved 
	    // and than put the image in your browser.
});
});

</script>

</div><!-- page -->
</body>
</html>
