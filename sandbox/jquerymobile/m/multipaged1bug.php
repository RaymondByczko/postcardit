<?php
/*
 * @file sandbox/jquerymobile/m/multipaged1bug.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page represents a multipage (m) JQueryMobile entity.
 * The pages are internal ones, not external ones.
 * This is the same file as sandbox/jquerymobile/m/multipaged1.php
 * except a bug has been introduced.  The closing /div for the collapsible
 * content (on each one) has been removed to see what happens.
 * If you bring up 'multipaged1bug.php' in a browser, you will see the
 * 'Red Queen' button (link) does not work. It blinks but the content
 * is not changed. It works in the other one.
 * @start_date 2017-03-04
 * @reference multipaged1.php
 * @note This is for development research and not intended as a production
 * artifact.
 * @note What was learned in doing this?  JQueryMobile is very sensitive to
 * the lack of a corresponding (closing) div, that is /div.  It was forgotten
 * initially in the 'collapsible' content, and the href links would not work.
 * Put it in, and it seems fine.  It is easy to assume it is a mistake in data-*
 * specification.  This file seems to bear this out.  Compare multipaged1.php
 * and multipaged1bug.php in separate browser tabs!
 */
?>
<!DOCTYPE hmtl>
<html>
<head>
<title>JQueryMobile Multipage</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body data-ajax="false">
<div data-role="page" id="page1" data-ajax="false" data-fullscreen="true"><!--page-->
	<div data-role="header" data-position="fixed" data-theme="d"><!-- header-->
		<a href="#page2" data-role="button" rel="external" data-ajax="false" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Red Queen</a>
		<h1>Illusion</h1>
	</div><!--header-->
	<div role="main" class="ui-content"><!--ui-content-->
		<div data-role="collapsible">
		<h2>Illusion</h2>
		<p>The American West was explored by white men half a century
		before the first colonists set foot on Virginia's beaches, but
		it went virtually uninhabited by whites for another three
		hundred years.
		</p>
		<p> 
		p. 15, Cadillac Desert, Marc Reisner
		</p>
		<!--</div>-->
	</div><!--ui-content-->
	<div data-role="footer" data-fullscreen="true" data-id="std_multipage_footer"  class="ui-bar" data-position="fixed" data-theme="d"><!--footer-->
	  <a href="#page1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
<div data-role="page" id="page2" data-fullscreen="true"><!--page-->
	<div data-role="header" data-position="fixed" data-theme="d"><!-- header-->
		<a href="#page1" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Illusion</a>
		<a href="#page1" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Page 1 Please</a>
		<h1>Red Queen</h1>
	</div><!--header-->
	<div role="main" class="ui-content"><!--ui-content-->
		<div data-role="collapsible">
		<h2>Red Queen</h2>
		<p>While Los Angeles moldered, San Francisco grew and grew.
		The city owned a superb natural harbor-the best on the Pacific
		Coast, one of the best in the world.
		</p>
		<p> 
		p. 52, Cadillac Desert, Marc Reisner
		</p>
		<!--</div>-->
	</div><!--ui-content-->
	<div data-role="footer" data-fullscreen="true" data-id="std_postcard_footer"  data-position="fixed" data-theme="d"><!--footer-->
	  <a href="#page1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
</body>
</html>
