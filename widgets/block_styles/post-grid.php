<div class="big-wrapper">
  <?php $i = 0; ?>
  <?php while ($queryd->have_posts()) : $queryd->the_post(); ?>
  <div class="wrapper wrapper--big">
    <?php include (ELEMENTOR_AWESOMESAUCE . 'widgets/content/content-1.php'); ?>
  </div>
<?php $i++; ?>
  <?php endwhile; ?>
</div>
