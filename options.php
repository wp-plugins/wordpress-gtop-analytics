<?php
function gtop_request($name, $default=null) {
    if (!isset($_REQUEST[$name])) return $default;
    return stripslashes_deep($_REQUEST[$name]);
}

function gtop_field_textarea($name, $label='', $tips='', $attrs='') {
	global $options;
	if(strpos($attrs, 'cols') === false) $attrs .= 'cols="70"';
	if(strpos($attrs, 'rows') === false) $attrs .= 'rows="5"';

	echo '<div><strong>'.$label.'</strong></div>';
	echo '<div><textarea style="width: 100%; height: 180px" wrap="off" name="options['.$name.']">'.htmlspecialchars($options[$name]).'</textarea></div>';
	echo '<div class="description"><small>'.$tips.'</small></div>';
}	
?>	
<div class="wrap">
	<div id="icon-plugins" class="icon32"></div>
	<h2>GTop Analytics</h2>

	<?php
if (isset($_POST['save'])) {
    if(!wp_verify_nonce($_POST['_wpnonce'], 'save')) die();
    $options = gtop_request('options');
    update_option('gtop', $options);
	echo '
		<div class="updated fade below-h2" style="background-color: rgb(255, 251, 204);">
			<p>
				Your settings have been saved.
			</p>
		</div>
	';
}
else {
    $options = get_option('gtop');
}
	?>

	<div class="updated fade below-h2" style="background-color: #f2f2f2; border-color: #eeeeee;">
		<p class="description">
			<img src="<?php echo GTOP_PLUGIN_URL;?>/gtop.jpg" alt="GTop" style="float: left; margin-right: 16px;" />
			Add your GTop Analytics code in the text area below.<br />
			<strong>Gtop.ro</strong> is a Romanian analytics system, similar to Google Analytics.<br />
			<small>This plugin was built by <a href="http://getbutterfly.com/" rel="external">getButterfly</a> for <a href="http://www.gtop.ro/" rel="external">GTop.ro</a> users. Visit <a href="http://www.gtop.ro/" rel="external"><strong>GTop.ro</strong></a> or <a href="http://www.gtop.ro/forums/" rel="external"><strong>GTop.ro forums</strong></a>!</small>
		</p>
	</div>

	<p>The code should look like this:</p>
	<p><code>
		&lt;!--/ GTop.ro - (begin) v2.1/--&gt;<br />
		&lt;script type="text/javascript" language="javascript"&gt;<br />
		var site_id = XXXXX;<br />
		var gtopSiteIcon = XX;<br />
		&lt;/script&gt;<br />
		&lt;script type="text/javascript" language="javascript" src="http://fx.gtop.ro/js/gTOP.js?v=2"&gt;&lt;/script&gt;<br />
		&lt;noscript&gt;&lt;a href="http://www.gtop.ro/"&gt;GTop.ro - &lt;/a>&lt;/noscript&gt;<br />
		&lt;!--/ GTop.ro - (end) v2.1/--&gt;
	</code></p>
	<form method="post">
		<?php wp_nonce_field('save');?>
		<div><?php gtop_field_textarea('footer', 'GTop Analytics code:', 'Add your GTop Analytics code here', 'rows="10"');?></div>
		<div class="submit"><input type="submit" name="save" value="Save settings" /> Or add the <strong>GTop widget</strong> to any widgetized area of your theme.</div>
	</form>
	<p>Make sure Your WordPress theme has the <code>wp_footer</code> template tag in the <strong>footer.php</strong> like this:</p>
	<p><code>&lt;php wp_footer();?&gt;</code></p>
</div>
