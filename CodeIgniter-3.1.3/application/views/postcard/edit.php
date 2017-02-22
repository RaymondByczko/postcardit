<?php
/*
 * @file views/postcard/edit.php
 * @author Raymond Byczko
 * @company self
 * @start_date 2017-02-19
 * @change_history RByczko, 2017-02-20, Added canvas. Draft quality.
 * @change_history RByczko, 2017-02-21, Take 2nd copy of uploaded pic out.
 * Just provide the canvas one.
 * @status @todo partial draft, needs testing, enhancement
 * @note Used JQuery core 1.12.4 instead of 3.1.1 .
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
<!--<script>
var context;
$("#page1").bind("pageinit", function(event, data) {
var canvas = $('#myCanvas')[0]; // grabs the canvas element
context = canvas.getContext('2d'); // returns the 2d context object
var img = new Image(); //creates a variable for a new image

img.src = '<?php echo $upload_path_name; ?>'; // specifies the location of the image
context.drawImage(img,0,0); // draws the image at the specified x and y location
});
</script>-->
<script>
var context;
</script>
<style>
</style>
</head>
<body class="mybody">
<div data-role="page" id="page_e" data-fullscreen="true" style="height:100%"><!-- page -->
  <div data-role="header" class="ui-bar" data-position="fixed" data-theme="b"><!-- header -->
    <a href="home" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <h1>Postcard IT</h1>
    <a href="info" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-info ui-btn-icon-right">Info</a>
  </div><!-- header -->
  <div role="main" class="ui-content" style="height:inherit"><!-- main -->
<div class="subheader">
<script>function dochange() {context.fillStyle="#FF0000"; context.fillText("<?php echo $postcard_message; ?>",30,30);}</script>
<button onclick="dochange();">Change Canvas</button>
<pre>Hi - Please edit your postcard!</pre>
</div>
<div><!-- FF -->
 <canvas id="myCanvas" width="200" height="300" style="border:1px solid #000000;">
</canvas> 
</div><!-- FF -->
<div data-role="fieldcontainer">
<label for="postcardtext_id">Text:</label>
<input type="text" id="postcardtext_id" name="postcardtext">
</div>
<div id="apply_postcardtext_id" data-role="controlgroup">
	<a href="#" data-role="button">Apply</a>
</div>
<pre>The postcard/edit.php page here!</pre>
</div><!-- main -->
<div data-role="footer" data-id="postcard_footer" class="ui-bar" data-position="fixed" data-theme="b"><!-- footer-->
  <a href="<?php echo site_url('postcard/cancel/'.$postcard_id); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
  <a href="<?php echo site_url('postcard/upload_now/'.$postcard_id); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-back">Previous</a>
</div><!-- footer -->
<script>
// var context;

console.log("pageinit_bind");
// $("#page_e").bind("pageinit", function(event) {
// $("#myCanvas").onload = function() {
window.onload = function() {
// $(function() {
console.log("pageinit_start");
var canvas = $('#myCanvas')[0]; // grabs the canvas element
context = canvas.getContext('2d'); // returns the 2d context object
var img = new Image(); //creates a variable for a new image

img.src = '<?php echo $upload_path_name; ?>'; // specifies the location of the image
context.drawImage(img,0,0); // draws the image at the specified x and y location
console.log("pageinit_end");
// });
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
var canvas = $('#myCanvas')[0]; // grabs the canvas element
context = canvas.getContext('2d'); // returns the 2d context object
var img = new Image(); //creates a variable for a new image
img.onload = function() {
context.drawImage(img,0,0); // draws the image at the specified x and y location
};
img.src = '<?php echo $upload_path_name; ?>'; // specifies the location of the image
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

$("#apply_postcardtext_id").bind("click", function(event, data) {
console.log("apply_postcard_text_id:click");
// var pc_text = $("#postcardtext_id").text();
var pc_text = $("#postcardtext_id").val();
console.log(pc_text);
context.fillStyle="#FF0000";
context.fillText(pc_text,30,30);

});

</script>

</div><!-- page -->
</body>
</html>
