<?php
/*
 * @file sandbox/jquerymobile/hash/hashchange1.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page represents a multipage (m) JQueryMobile entity.
 * @start_date 2017-03-12
 * @change_history 
 * @note This is for development research and not intended as a production
 * artifact.
 * @note What was learned in doing this?  JQueryMobile is ..
 */
?>
<!DOCTYPE hmtl>
<html>
<head>
<title>JQueryMobile Hashchange One</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div data-role="page" id="page1" data-fullscreen="true"><!--page-->
	<div data-role="header" data-position="fixed" data-theme="d"><!-- header-->
		<a href="#page2" data-role="button" rel="external" data-ajax="false" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Red Queen</a>
		<a href="#page3" nodata-url="/sandboxjqm/dataurl/tomato/" data-role="button" norel="external" data-ajax="true" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Pick Tomato</a>
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
	  <a href="#page1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
<div data-role="page" id="page2" data-fullscreen="true"><!--page-->
<script>
$(function() {
  // Bind an event to window.onhashchange that, when the hash changes, gets the
  // hash and adds the class "selected" to any matching nav link.
  $( window ).hashchange(function() {
    var hash = location.hash;
 
	console.log("Hash is " + hash);
    // Set the page title based on the hash.
    document.title = "The hash is " + ( hash.replace( /^#/, "" ) || "blank" ) + ".";
 
    // Iterate over all nav links, setting the "selected" class as-appropriate.
    $( "#nav a" ).each(function() {
      var that = $( this );
      that[ that.attr( "href" ) === hash ? "addClass" : "removeClass" ]( "selected" );
    });
  });
  // Since the event is only triggered when the hash changes, we need to trigger
  // the event now, to handle the hash the page may have loaded with.
  $( window ).hashchange();


  $( window ).on("pagecreate", function(event) {
 
	console.log("Pagecreate detected");
  });
});
</script>
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
		</div>
	</div><!--ui-content-->
	<div data-role="footer" data-fullscreen="true" data-id="std_postcard_footer"  data-position="fixed" data-theme="d"><!--footer-->
	  <a href="#page1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
<div data-role="page" id="page3" data-url="postcardit.dev/sandboxjqm/dataurl/tomato.php" data-fullscreen="true"><!--page-->
	<div data-role="header" data-position="fixed" data-theme="d"><!-- header-->
		<a href="#page1" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Illusion</a>
		<a href="#page1" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">Page 1 Please</a>
		<h1>Tomato</h1>
	</div><!--header-->
	<div role="main" class="ui-content"><!--ui-content-->
		<div data-role="collapsible">
		<h2>Tomato</h2>
		<p>Tomatos are nice to add to salads.
		</p>
		<p> 
		A Silly Quote.
		</p>
		</div>
	</div><!--ui-content-->
	<div data-role="footer" data-fullscreen="true" data-id="std_postcard_footer"  data-position="fixed" data-theme="d"><!--footer-->
	  <a href="#page1" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
	</div><!--footer-->
</div><!--page-->
</body>
</html>
