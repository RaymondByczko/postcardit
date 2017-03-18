<?php
/*
 * @file sandbox/jquerymobile/grid/grid1.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page represents an experiment in doing a basic grid for layout.
 * @start_date 2017-03-10
 * @change_history RByczko, 2017-03....
 * @note This is for development research and not intended as a production
 * artifact.
 * @note What was learned in doing this?  JQueryMobile is ...
 */
?>
<!DOCTYPE html>
<html>
<head>
<title>JQueryMobile Grid 1 - Basic</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div data-role="page" id="page1" data-fullscreen="true"><!--page-->
	<div data-role="header" data-position="fixed" data-theme="d"><!-- header-->
		<a href="#page2" data-role="button" rel="external" data-ajax="false" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Grid B</a>
		<h1>The American West</h1>
	</div><!--header-->
	<div role="main" class="ui-content"><!--ui-content-->
		<div data-role="collapsible">
		<h2>The American West</h2>
		<p>The American West was explored by white men half a century
		before the first colonists set foot on Virginia's beaches, but
		it went virtually uninhabited by whites for another three
		hundred years.
		</p>
		<p> 
		p. 15, Cadillac Desert, Marc Reisner
		</p>
		</div>

		<div class="ui-grid-b">
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px">Block A:a small line</div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px">Block B:a larger larger line</div></div>
			<div class="ui-block-c"><div class="ui-bar ui-bar-a" style="height:60px">Block C:a very large large large line</div></div>
		</div><!-- /grid-b -->
	</div><!--ui-content-->
	<div data-role="footer" data-fullscreen="true" data-id="std_multipage_footer"  class="ui-bar" data-position="fixed" data-theme="d"><!--footer-->
	  <a href="#page1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
<div data-role="page" id="page2" data-fullscreen="true"><!--page-->
	<div data-role="header" data-position="fixed" data-theme="d"><!-- header-->
		<a href="#page1" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Grid A</a>
		<a href="#page1" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Page A Please</a>
		<h1>Pre Output</h1>
	</div><!--header-->
	<div role="main" class="ui-content"><!--ui-content-->

	<div class="ui-grid-b">
		<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px">Block D
		<pre>
			Line01
			Line02
			Line03
			Line04
			Line05
			Line06
			Line07
			Line08
			Line09
			Line10
		<pre>
</div></div>
		<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px">Block E</div></div>
		<div class="ui-block-c"><div class="ui-bar ui-bar-a" style="height:60px">Block F</div></div>
	</div><!-- /grid-b -->


		<div data-role="collapsible">
		<h2>Los Angeles</h2>
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
