<?php
/* 
 * @file fullscreen2.php
 * @purpose This is a copy of fullscreen1, except data-fullscreen="true" has been
 * added to page.
 *
 * page: data-fullscreen=true
 * header: data-fullscreen=true
 * header: data-fullscreen=true
 *
 * @outcome works, top slides, bottom slides, content there, good
 */
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
</head>
<body>

<div data-role="page" data-fullscreen="true">
  <div data-role="header" data-position="fixed" data-fullscreen="true">
    <h1>Fixed and Fullscreen Header</h1>
  </div>

  <div data-role="main" class="ui-content"><br><br>
		<pre>
		TOP OF LINES
		line01
		line02
		line03
		line04
		line05
		line06
		line07
		line08
		line09
		line10
		
  </div>
  <div data-role="footer" data-position="fixed" data-fullscreen="true">
    <h1>Fixed and Fullscreen Footer</h1>
  </div>
</div>

</body>
</html>
