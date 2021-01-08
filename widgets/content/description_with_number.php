<div class="description">
  <div class="description-inner">
    <?php if($show_cat_small) { ?>
      <div class="category">
        <?php
        $categories2 = get_the_category();
        foreach ( $categories2 as $category2 ) {
          echo '<span style="display: inline-block;
          color: white;
          padding: 1px 8px;
          margin-right: 10px;
          background-color: #177c51;
          font-size: 11px;
          font-family: Montserrat;
          font-weight: 600; background-color:'.get_field('category_colors', $category2).';font-family:Arial;border-radius:10px;" class="acf-category-color">'.$category2->name.'</span>';
        }
        ?>
      </div>
    <?php }  ?>
    <h4 class="news-title"><?php echo esc_html(wp_trim_words(get_the_title(), $crop_small,'')); ?></h4>
    <span class="comments-views-date">
      <?php if($show_comments_small) { ?>
        <span class="comments">
          <i class="fa fa-comment"></i><?php  echo get_comments_number(); ?>
        </span>
      <?php }  ?>
      <?php if($show_views_small) { ?>
        <span class="views">
          <i class="fa fa-eye"></i><?php  echo gt_get_post_view(); ?>
        </span>
      <?php }  ?>
      <?php if($show_date_small) { ?>
        <span class="date">
          <i class="fa fa-calendar"></i><?php the_date( 'Y-m-d'); ?>
        </span>
      <?php }  ?>
    </span>
  </div>
</div>
