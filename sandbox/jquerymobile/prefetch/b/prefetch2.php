<?php
/*
 * @file sandbox/jquerymobile/prefetch/b/prefetch2.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page represents a multipage (m) JQueryMobile entity.
 * The pages are comprised of 1 internal ones, and one external ones.
 *		Page 1 has data-dom-cache true.
 *		Page 2 has data-dom-cache true.
 *		data-prefetch applied to the link of prefetch1.php in this page.
 * @start_date 2017-03-27
 * @note This is for development research and not intended as a production
 * artifact.
 * @note What was learned in doing this? See the note in prefetch1.php
 */
?>
<!DOCTYPE html>
<html>
<head>
<title>JQueryMobile Prefetch B</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div data-role="page" id="page2" data-dom-cache="true" data-fullscreen="true"><!--page-->
	<div data-role="header" data-position="fixed" data-theme="d"><!-- header-->
		<a href="prefetch1.php" data-prefetch data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Page 1</a>
		<a href="prefetch1.php" data-prefetch data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Page 1 Please</a>
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
	  <a href="prefetch1.php" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus">Cancel</a>
	</div><!--footer-->
</div><!--page-->
</body>
</html>
