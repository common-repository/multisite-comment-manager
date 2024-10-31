<?php 

?>
<div class="wrap comment-management-wrap">
  <h1><?php esc_html_e(get_admin_page_title()); ?></h1>

  <form action="<?php echo admin_url('admin-post.php'); ?>" method="post">
    <div class="form-group">
      <input type="hidden" name="action" value="mucm_get_multi_site_comments">
      <input type="hidden" name="comments" value="1">
      <button type="submit" value="Get Comments" class="btn btn-primary">Get Comments</button>
    </div>
  </form>

  <?php if( htmlspecialchars($_GET["comments"]) == "get"): ?>
  <div class="wrap">
    <div id="sites-dropdown"></div>
    <div id="multi-site-comments"></div>
    <button id="load-more-comments" type="button" class="btn btn-primary btn-lg">Load more
      comments</button>
  </div>
  <?php endif; ?>
</div>