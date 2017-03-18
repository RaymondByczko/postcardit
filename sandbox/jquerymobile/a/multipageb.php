<?php
/*
 * @file test/jquerymobile/a/multipage.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page represents a multipage JQueryMobile entity.
 * @start_date 2017-03-03
 * @change_history RByczko, 2017-02-26
 * @note This is for development research and not intended as a production
 * artifact.
 * @todo 
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
<body>
<div id="page1" data-role="page" data-dom-cache="false" data-fullscreen="true"><!--page-->
	<div data-role="header" class="ui-bar" data-position="fixed" data-theme="b"><!-- header-->
		<a href="#page2" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Red Queen</a>
		<a href="info" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Information</a>
		<h1>Illusion</h1>
	</div><!--header-->
	<div role="main" class="ui-content"><!--ui-content-->
		<div data-role="collapsible">
		<h2>Illusion</h2>
		<p>The American West was explored by white men half a century
		before the first colonists set foot on Virginia's beaches, but
		it went virtually uninhabited by whites for another three
		hundred years. In 1539, Don Francisco Vasquez de Coronado, a
		nobleman who had married rich and been appointed governor by the
		Spanish king, set out on horseback from Mexico with a couple of
		hundred men, driving into the unchartered north.
		</p>
		<p> 
		p. 15, Cadillac Desert, Marc Reisner
		</p>
	</div><!--ui-content-->
	<div data-role="footer" data-fullscreen="true" data-id="std_multipage_footer"  class="ui-bar" data-position="fixed" data-theme="b"><!--footer-->
	  <a href="#page_1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
<div id="page2" data-role="page" data-dom-cache="false" data-fullscreen="true"><!--page-->
	<div data-role="header" class="ui-bar" data-position="fixed" data-theme="b"><!-- header-->
		<a href="#page3" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">First Causes</a>
		<a href="info" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Information</a>
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
	</div><!--ui-content-->
	<div data-role="footer" data-fullscreen="true" data-id="std_postcard_footer"  class="ui-bar" data-position="fixed" data-theme="b"><!--footer-->
	  <a href="#page_1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
</body>
</html>
