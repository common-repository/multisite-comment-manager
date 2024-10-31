<?php

namespace AntalTettinger\MuCommentOverview;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Multi_Site_Comments {

    /**
     * @var array $comments_html_array
     **/
    public $comments_html_array;

    /**
     * Constructor of current class
     **/
    function __construct() {
        $this->comments_html_array = $this->mucm_get_multi_site_comments();
    }

    /**
     * Process and get return value
     **/
    function mucm_get_comments() {
        return $this->comments_html_array;
    }

    function mucm_get_dropdown_html() {
      $multi_site_comment_query_results = $this->comments_html_array;
      ob_start();
      include( MULTI_SITE_COMMENT_MANAGER_PLUGIN_PATH . 'inc/display/sites-dropdown.php' );
      $dropdown_to_render = ob_get_clean();
      return $dropdown_to_render;
    }

    function mucm_get_multi_site_comments() {
        $multi_site_array = get_sites();
        $comments_html_array = array();
        $blog_id_array = array();
        //get all the unapproved comments from across the multi site network
        foreach( $multi_site_array as $subsite ) {
            
          $blog_id = get_object_vars($subsite)["blog_id"];
          switch_to_blog( $blog_id );
          $blog_name = get_bloginfo();
          $blog_info_array[] = [$blog_id,$blog_name];

          $args = array(
            'status' => 'hold',
            );
          $comments_query = new \WP_Comment_Query;
          $comments = $comments_query->query( $args );
          foreach($comments as $comment){
            $comment_content = $comment->comment_content;
            $comment_id = $comment->comment_ID;
            $comment_ip = $comment->comment_author_IP;
            $comment_email = $comment->comment_author_email;
            $comment_date = $comment->comment_date;
            $comment_author = $comment->comment_author;
            $comment_post_id = $comment->comment_post_ID;
            $comment_path = '/?page_id=' . $comment_post_id;
            $comment_post_url = site_url($comment_path, 'https');
            $comment_edit_path = '/wp-admin/comment.php?action=editcomment&c=' . $comment_id;
            $comment_edit_url = site_url($comment_edit_path, 'https');
            $comment_array[$comment_id] = $comment_content;
            $comment_panel_unique_id = $blog_id . '-' . $comment_id;
            $meta = get_comment_meta( $comment_id, 'comment_ratings_html', true);
            $comment_star_rating = $meta ? $meta : "";
            $post_title = get_the_title($comment_post_id);
      
            ob_start();
            include( MULTI_SITE_COMMENT_MANAGER_PLUGIN_PATH . 'inc/display/comment-box.php' );
            $comment_box_to_render = ob_get_clean();
            $comments_html_array[] = [$blog_id, $comment_box_to_render];

          }
          restore_current_blog();
        }

        $return_array[0] = $comments_html_array;
        $return_array[1] = $blog_info_array;
      
        return $return_array;
      
      }
}