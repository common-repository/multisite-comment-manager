<?php

namespace AntalTettinger\MuCommentOverview;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

use AntalTettinger\MuCommentOverview\Multi_Site_Comments;

//Admin page settings
function mucm_comment_management_settings_pages() {
  wp_enqueue_style( 'comment-manager-bootstrap-css', plugins_url( '../css/bootstrap.min.css', __FILE__ ), array(), 1.0 );
  add_menu_page(
      __('Pending Comments', 'multi-site-comment-manager'),
      'Comment Management',
      'comment_manager',
      'comment-management-plugin.php',
      __NAMESPACE__ . '\mucm_comment_management_settings_page_markup',
      'dashicons-testimonial',
      100
  );
}

function mucm_comment_management_settings_page_markup() {
  include ( MULTI_SITE_COMMENT_MANAGER_PLUGIN_PATH . 'inc/display/main-page.php');
}

//Load and localize JavaScript
function mucm_comment_management_plugin_backend_scripts( $hook ) {
  if(!isset($_GET["comments"]) ) {
    return;
  }
$multi_site_commments = new Multi_Site_Comments();
$multi_site_comment_query_results = $multi_site_commments->mucm_get_comments();
$multi_site_dropdown = $multi_site_commments->mucm_get_dropdown_html();

    if( $hook != 'toplevel_page_' . 'comment-management-plugin' ) {
      return;
    }
    $nonce = wp_create_nonce( 'mucm_comment_management_plugin_nonce' );
  
    wp_enqueue_script( 'comment-management-plugin-backend-js', plugins_url( '../js/backend-main.js', __FILE__ ), [], 1.0, true );
    wp_localize_script(
      'comment-management-plugin-backend-js',
      ' comment_management_plugin_globals',
      [
        'ajax_url'    => admin_url( 'admin-ajax.php' ),
        'nonce'       => $nonce,
        'comments_html_array' => $multi_site_comment_query_results,
        'dropdown' => $multi_site_dropdown
      ]
    );
  }
// Get comments in an async way
  function mucm_get_multi_site_comments() {
    wp_redirect(admin_url('admin.php?page=comment-management-plugin.php&comments=get'));
  }