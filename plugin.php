<?php
/*
Plugin Name: WordPress GTop Analytics
Plugin URI: http://getbutterfly.com/wordpress-plugins/wordpress-gtop-analytics/
Description: Adds GTop Analytics code to your footer without messing with the source code.
Version: 1.1
Author: Ciprian Popescu
Author URI: http://getbutterfly.com/
*/

/*
  Copyright 2010-2011  Ciprian Popescu  (email : office@butterflymedia.ro)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

//
if(!defined('WP_CONTENT_URL'))
	define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if(!defined( 'WP_PLUGIN_URL'))
	define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if(!defined('WP_CONTENT_DIR'))
	define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if(!defined('WP_PLUGIN_DIR'))
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');

define('GTOP_PLUGIN_URL', WP_PLUGIN_URL.'/wordpress-gtop-analytics');
define('GTOP_PLUGIN_PATH', WP_PLUGIN_DIR.'/wordpress-gtop-analytics');
//

$gtop_options = get_option('gtop');

add_action('admin_menu', 'gtop_admin_menu');

function gtop_admin_menu() {
	add_options_page('GTop Analytics', 'GTop Analytics', 'manage_options', 'wordpress-gtop-analytics/options.php');
}

add_action('wp_footer', 'gtop_wp_footer');

function gtop_wp_footer() {
    global $gtop_options;
	$text = $gtop_options['footer'];
    echo $text;
}

// The widget...
function gtop_widget($gtop_code) {
	if($gtop_code != '') {
		echo $gtop_code; 	
	}
}

class gtop_widget_Class extends WP_Widget {
	function gtop_widget_Class() {
		$widget_ops = array('classname' => 'gtop', 'description' => 'A widget that displays the GTop button.');
		$control_ops = array('id_base' => 'gtop-widget');
		$this->WP_Widget('gtop-widget', 'GTop Widget', $widget_ops, $control_ops);
	}

	// How to display the widget on the screen.
	function widget($args, $instance) {
		extract($args);

		/* Our variables from the widget settings. */
		$gtop_code = $instance['gtop_code'];

		echo $before_widget;
		/* Display the widget title if one was input (before and after defined by themes). */
		gtop_widget($gtop_code);
		echo $after_widget;
	}

	// Update the widget settings.
	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['gtop_code'] 	= strip_tags($new_instance['gtop_code']);

		return $instance;
	}

	// Displays the widget settings controls on the widget panel. Make use of the get_field_id() and get_field_name() function when creating your form elements.
	function form($instance) {
		/* Set up some default widget settings. */
		$instance = wp_parse_args((array) $instance);?>

		<p>Add your <strong>GTop Analytics</strong> code here:</p>
		<p>
			<textarea id="<?php echo $this->get_field_id('gtop_code');?>" name="<?php echo $this->get_field_name('gtop_code'); ?>" rows="6" cols="40"><?php echo $instance['gtop_code'];?></textarea>
		</p>
	<?php
	}
}
add_action('widgets_init', 'gtop_load_widgets');

// Register our widget.
function gtop_load_widgets() {
	register_widget('gtop_widget_Class');
}
?>
