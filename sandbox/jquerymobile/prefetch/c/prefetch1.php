<?php
/*
 * @file sandbox/jquerymobile/prefetch/c/prefetch1.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page represents a multipage (m) JQueryMobile entity.
 * The pages are comprised of 1 internal ones, and one external ones.
 * These are variants from b/prefetch1.php and b/prefetch2.php.
 * Lets try setting data-com-cache to false instead of true.
 *		Page 1 has data-dom-cache false.
 *		Page 2 has data-dom-cache false.
 *		data-prefetch applied to the link of prefetch2.php in this page.
 * @start_date 2017-03-27
 * @note This is for development research and not intended as a production
 * artifact.
 * @note What was learned in doing this? Firebug sees the loading of this page
 * and does preload the second one.  It will thus see 6 net requests for only this
 * page the very first time it is loaded.  Upon clicking the second page, it sees
 * no other additional page loads (net).
 *
 * It is then possible to switch back and forth between the first and second pages
 * and there is 1 additional net requests.  It gets prefetch2.php for each switch.
 *
 * Thus in steady state, this small prefetch app can be utilized with 6 initial requests in
 * total, and then one extra for each switch.
 *
 * @note It is interesting that prefetch1.php is not reloaded, beyond the 1 time it
 * was loaded.  prefetch2.php is constantly reloaded.
 *
 */
?>
<!DOCTYPE html>
<html>
<head>
<title>JQueryMobile Prefetch C</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div data-role="page" id="page1" data-dom-cache="false" data-fullscreen="true"><!--page-->
	<div data-role="header" data-position="fixed" data-theme="d"><!-- header-->
		<a href="prefetch2.php" data-prefetch data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Page 2</a>
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
		</div>
	</div><!--ui-content-->
	<div data-role="footer" data-fullscreen="true" data-id="std_multipage_footer"  class="ui-bar" data-position="fixed" data-theme="d"><!--footer-->
	  <a href="prefetch1.php" data-prefetch class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
</body>
</html>
