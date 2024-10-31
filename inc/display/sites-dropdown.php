<div class="form-group">
  <label for="select-site">Select site</label>
  <select class="form-control" id="select-site" name="select-site">
    <option selected value="0">All Sites</option>
    <?php
        $blog_info_array = $multi_site_comment_query_results[1];
        foreach($blog_info_array as $comment_data){
            echo '<option value='. $comment_data[0] .'>' . $comment_data[1] . '</option>';
        }
      ?>
  </select>
</div>