<div class="panel-group container border border-info rounded m-1" id="<?php echo($comment_panel_unique_id); ?>-panel">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5 class="panel-title mt-2">
        <span class="panel-header" data-toggle="collapse" data-unique="<?php echo($comment_panel_unique_id); ?>"><span
            id="<?php echo($comment_panel_unique_id); ?>-title"> Site: <?php echo($blog_name);?> </span>
          <hr><strong>
            Post Title: <?php echo($post_title);?></strong></span>
      </h5>
    </div>
    <div id="<?php echo($comment_panel_unique_id); ?>" class="panel-collapse collapse show">
      <div class="panel-body">
        <div class="row">
          <div class="col">Comment Date: <?php echo esc_attr($comment_date); ?></div>
        </div>
        <div class="row">
          <div class="col">Comment Author IP: <?php echo esc_attr($comment_ip); ?></div>
        </div>
        <div class="row">
          <div class="col">Comment Author Email: <?php echo esc_attr($comment_email); ?></div>
        </div>
        <div class="comment-container--content row my-1">
          <blockquote class="col blockquote">
            <p class="mb-0"><?php echo esc_attr($comment_content); ?></p>
            <footer class="blockquote-footer"><?php echo($comment_author);?></footer>
          </blockquote>
        </div>
      </div>
    </div>
  </div>
</div>