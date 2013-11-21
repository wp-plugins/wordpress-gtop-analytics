<?php
function gtop_options_page() {
	$output = '
		<div class="wrap">
			<div id="icon-plugins" class="icon32"></div>
			<h2>GTop Analytics</h2>';

			if(isset($_POST['save'])) {
				if(!wp_verify_nonce($_POST['_wpnonce'], 'save')) die();
				$options = stripslashes_deep($_POST['gtopcode']);
				update_option('gtop', $options);
				$output .= '
					<div class="updated fade below-h2" style="background-color: rgb(255, 251, 204);">
						<p>Your settings have been saved.</p>
					</div>
				';
			}
			else {
				$options = get_option('gtop');
			}

	$output .= '
		<div class="updated fade below-h2" style="background-color: #f2f2f2; border-color: #eeeeee;">
			<p class="description">
				<img src="' . GTOP_PLUGIN_URL . '/gtop.jpg" alt="GTop" style="float: left; margin-right: 16px;" />
				Add your GTop Analytics code in the text area below.<br />
				<strong>Gtop.ro</strong> is a Romanian analytics system, similar to Google Analytics.<br />
				<small>This plugin was built by <a href="http://getbutterfly.com/" rel="external">getButterfly</a> for <a href="http://www.gtop.ro/" rel="external">GTop.ro</a> users.</small>
			</p>
		</div>

		<p>The code should look like this:</p>
		<p><code>
			&lt;!--/ GTop.ro - (begin) v2.1/--&gt;<br>
			&lt;script type="text/javascript" language="javascript"&gt;<br>
			var site_id = XXXXX;<br>
			var gtopSiteIcon = XX;<br>
			var _gtUrl = (("https:" == document.location.protocol) ? "https://secure." : "http://fx.");<br>
			document.write(unescape("%3Cscript src=\'" + _gtUrl + "gtop.ro/js/gTOP.js\' type=\'text/javascript\'%3E%3C/script%3E"));<br>
			&lt;/script&gt;<br>
			&lt;!--/ GTop.ro - (end) v2.1/--&gt;
		</code></p>
		<form method="post">
			';
			$output .= wp_nonce_field('save');
			$output .= '
			<p><strong>GTop Analytics code:</strong></p>
			<p>
				<textarea class="large-text code" rows="10" name="gtopcode">' . $options . '</textarea><br>
				<span class="description">Add your GTop Analytics code here. You can add the optional online users code in the same box above.</span>
			</p>
			<p><input type="submit" name="save" class="button button-primary" value="Save Changes"></p>
		</form>
		<p>
			Use the <strong>GTop widget</strong> to add the code to any widgetized area of your theme.<br>
			Make sure your WordPress theme has the <code>wp_footer</code> template tag in the <strong>footer.php</strong> like this:
		</p>
		<p><code>&lt;php wp_footer();?&gt;</code></p>
		</div>
	';

	echo $output;
}
?>
