<?php
/*
 * @file sandbox/jquerymobile/m/multipaged2bug2.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page represents a multipage JQueryMobile entity.
 * It is a variant of multipaged2.php but contains an intentional bugs
 * A closing div was removed from the first collapsible.
 *
 * Lets see what happens with the very long content! And with the removal
 * of the closing div!
 * @note Links on the first page to the second do not work!  And the pre
 * content after the collapsible is mistakenly absorbed by the later.
 * @start_date 2017-03-04
 * @note This is for development research and not intended as a production
 * artifact.
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
			<p>p. 15, Cadillac Desert, Marc Reisner
			</p>
		<!--</div>-->
		<pre>THE REAL LONG CONTENT HERE</pre>
		<pre>
		One
		Two
		Three
		Four
		Five
		Six
		Seven
		Eight
		Nine
		Ten
		SECOND
		One
		Two
		Three
		Four
		Five
		Six
		Seven
		Eight
		Nine
		Ten
		THIRD
		One
		Two
		Three
		Four
		Five
		Six
		Seven
		Eight
		Nine
		Ten
		FOURTH
		One
		Two
		Three
		Four
		Five
		Six
		Seven
		Eight
		Nine
		Ten
		FIFTH
		One
		Two
		Three
		Four
		Five
		Six
		Seven
		Eight
		Nine
		Ten
		</pre>
	</div><!--ui-content-->
	<div data-role="footer" data-fullscreen="true" data-id="std_multipage_footer"  class="ui-bar" data-position="fixed" data-theme="d"><!--footer-->
	  <a href="#page1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
<div data-role="page" id="page2" data-fullscreen="true"><!--page-->
	<div data-role="header" data-position="fixed" data-theme="d"><!-- header-->
		<a href="#page1" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Illusion</a>
		<a href="#page1" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Back Page 1</a>
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
		</div>
	</div><!--ui-content-->
	<div data-role="footer" data-fullscreen="true" data-id="std_postcard_footer"  data-position="fixed" data-theme="d"><!--footer-->
	  <a href="#page1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
</body>
</html>
