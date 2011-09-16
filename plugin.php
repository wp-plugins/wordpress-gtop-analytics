<?php
/*
Plugin Name: WordPress GTop Analytics
Plugin URI: http://getbutterfly.com/wordpress-plugins/wordpress-gtop-analytics/
Description: Adds GTop Analytics code to your footer without messing with the source code.
Version: 1.0
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
?>
