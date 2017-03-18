<?php
/*
 * @file test/jquerymobile/a/multipaged.php
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
<div data-role="page" id="one">
	<div data-role="header">
		<h1>Illusion</h1>
	</div><!--header-->
	<div role="main" class="ui-content">
		<a href="#two" class="ui-btn ui-shadow ui-corner-all">Red Queen</a>
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
		</div>
	</div><!--ui-content-->
	<div data-role="footer" data-theme="a"><!--footer-->
	  <h4>Footer page 1</h4>
	</div><!--footer-->
</div><!--page-->
<div data-role="page" id="two" data-theme="a"><!--page-->
	<div data-role="header"><!-- header-->
		<a href="#one" class="ui-btn ui-shadow ui-corner-all">Illusion</a>
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
	<div data-role="footer" data-theme="b"><!--footer-->
	  <a href="#one" class="ui-btn ui-corner-all ui-shadow">Cancel</a>
	</div><!--footer-->
</div><!--page-->
</body>
</html>
