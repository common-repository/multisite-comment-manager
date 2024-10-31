<?php
/**
 * Plugin Name:       Multisite Comment Manager
 * Description:       Overview and manage Multi Site Comments.
 * Version:           1.0
 * Author:            Antal Tettinger
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       multisite-comment-manager
 * 
 **/

namespace AntalTettinger\MuCommentOverview;

defined( 'ABSPATH' ) or die( 'Not allowed!' );

define( 'MULTI_SITE_COMMENT_MANAGER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
//Require utility scripts
require_once( MULTI_SITE_COMMENT_MANAGER_PLUGIN_PATH . 'inc/functions/utility-scripts.php');
//Include all the functions for the hooks.
require_once( MULTI_SITE_COMMENT_MANAGER_PLUGIN_PATH . 'inc/functions/hook-scripts.php');

add_action('admin_menu', __NAMESPACE__ . '\mucm_comment_management_settings_pages');
add_action( 'admin_post_update_management', __NAMESPACE__ . '\mucm_comment_management_handling' );
add_action( 'wp_ajax_mucm_comment_management', __NAMESPACE__ . '\mucm_comment_management' );
add_action( 'wp_ajax_nopriv_mucm_comment_management', __NAMESPACE__ . '\mucm_comment_management' );
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\mucm_comment_management_plugin_backend_scripts' );
add_action( 'admin_post_mucm_get_multi_site_comments', __NAMESPACE__ . '\mucm_get_multi_site_comments' );