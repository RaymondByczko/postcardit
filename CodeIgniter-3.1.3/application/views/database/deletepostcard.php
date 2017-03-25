<?php
/*
 * @file views/database/deletepostcard.php
 * @author Raymond Byczko
 * @company self
 * @purpose This page presents the database schema to the user.
 * @start_date 2017-03-21
 * @change_history RByczko, 2017-03-25, Basically this view accomplishes its
 * stated purpose.  @todo  However, the following remains to be done.
 * a) remove noops b) remove checkbox-v
 */
?>
<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" href="/css/sheets/postitstyles.css?version=0.2"> -->
<title>Postcardit-Delete Postcard</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.css" />
<!--<script type="text/javascript" src="/JQuery_3_1_1/jquery-3.1.1.js"></script>-->
<script type="text/javascript" src="/JQuery_1_12_4/jquery-1.12.4.js"></script>
<script type="text/javascript" src="/JQueryMobile_1_4_5/jquery.mobile-1.4.5.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<style>
</style>-->
</head>
<body>
<div id="page_deletepostcard_id" data-role="page" data-dom-cache="true"><!--page-->
  <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="b"><!-- header-->
    <a href="<?php echo site_url('welcomepostcardit/index'); ?>" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="<?php echo site_url('postcard/about'); ?>" data-rel="dialog" data-role="button" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-icon-gear">About</a>
    <h1>Postcard IT</h1>
  </div><!--header-->
  <div role="main" class="ui-content"><!--ui-content-->
<div class="subheader">
<pre>Hi - Delete a postcard here!</pre>
</div>
<div id="deletepostcard_noop1_id" data-role="controlgroup">
	<a href="<?php echo site_url('database/postcard');?>" data-ajax="false" id="delete_postcard_id" data-role="button">NOOP1</a>
</div>
<div id="deletepostcard_noop2_id" data-role="controlgroup">
	<a href="<?php echo site_url('database/viewpostcardtable');?>" data-ajax="false" id="view_postcard_table_id" data-role="button">NOOP2</a>
</div>
<!--<form>-->
<?php echo form_open('database/processdelete'); ?>
    <fieldset data-role="controlgroup">
        <legend>Delete Postcard:</legend>
		<?php
			foreach ($postcard_array as $postcard_details)
			{
				$c_name = 'checkbox-deletepostcard-'.$postcard_details->postcard_id;
				$c_id	= $c_name;
				$the_label = $postcard_details->postcard_id.'|'.$postcard_details->from_name.'|'.$postcard_details->subject;
		?>
			<input name="<?php echo $c_name; ?>" id="<?php echo $c_id; ?>" type="checkbox">
			<label for="<?php echo $c_id; ?>"><?php echo $the_label; ?></label>
		<?php
			}
		?>
        <input name="deletepostcard-next" id="deletepostcard-next-id" type="checkbox">
        <label for="deletepostcard-next-id">Next</label>

		<input type=hidden name=hidden-delete-postcard-postcard_id_start value=<?php echo $postcard_id_start; ?> >
		<input type=hidden name=hidden-delete-postcard-num_postcards value=<?php echo $num_postcards; ?> >

        <input name="checkbox-v-2a" id="checkbox-v-2a" type="checkbox">
        <label for="checkbox-v-2a">One</label>

		<div><input type="submit" value="Submit" /></div>
    </fieldset>
</form>
<div data-role="collapsible">
	<h2>Help ?</h2>
	<p>This page presents information related to the database.
	It is possible to see which tables are present, and which
	fields are present in each table.
	</p>
</div>
<pre>The database/deletepostcard.php page here!</pre>
</div><!--ui-content-->
<div data-role="footer" data-fullscreen="true" data-position="fixed" data-theme="b"><!--footer-->
  <a href="<?php echo site_url('welcomepostcard/index'); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-right ui-icon-plus ui-disabled">Cancel</a>
</div><!--footer-->
</div><!--page-->
</body>
</html>
