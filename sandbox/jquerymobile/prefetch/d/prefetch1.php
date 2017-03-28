<?php
/*
 * @file sandbox/jquerymobile/prefetch/d/prefetch1.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page represents a multipage (m) JQueryMobile entity.
 * The pages are comprised of 1 internal ones, and one external ones.
 * These are variants from c/prefetch1.php and c/prefetch2.php.
 * Lets try setting data-com-cache to false instead of true.
 *		Page 1 has data-dom-cache false.
 *		Page 2 has data-dom-cache false.
 *		data-prefetch is removed for prefetch2.php in this page.
 * @start_date 2017-03-27
 * @note This is for development research and not intended as a production
 * artifact.
 * @note What was learned in doing this? Firebug sees the loading of this page
 * and does not preload the second one.  It will thus see 5 net requests for only this
 * page the very first time it is loaded.  Upon clicking the second page, it sees
 * one other additional page loads (net).
 *
 * It is then possible to switch back and forth between the first and second
 * pages. It gets prefetch2.php for each switch involving
 * Page 2 button.  It does not get prefetch1.php for each Page 1 button.  Thats interesting.
 * I thought it would get prefetch1.php as much as prefetch2.php.
 *
 * Is the reason that prefetch1.php is the 'home' or 'start page?
 *
 * If we start our initial fetch with prefetch2.php, the only subsequent page fetches
 * are only prefetch1.php.  Interesting.  It depends on which is 'home'.
 *
 * Thus in steady state, this small prefetch app can be utilized with 5 initial requests in
 * total, and then one extra for each switch requesting Page 2. (If page1 was the home.).
 *
 * @note It is interesting that page1 was not discarded since data-com-cache was false for
 * that page.  If one starts the browser at prefetch1.php, the following is observed.
 *
 * prefetch1.php
 * prefetch2.php
 * prefetch2.php
 * prefetch2.php
 * etc
 * 
 * prefetch2.php happens whenever 'Page 2' was clicked.
 *
 */
?>
<!DOCTYPE html>
<html>
<head>
<title>JQueryMobile Prefetch D</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div data-role="page" id="page1" data-dom-cache="false" data-fullscreen="true"><!--page-->
	<div data-role="header" data-position="fixed" data-theme="d"><!-- header-->
		<a href="prefetch2.php" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Page 2</a>
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
	  <a href="prefetch1.php" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
</body>
</html>
