<?php

get_header(); ?>

<div class="max-w-4xl mx-auto px-4">
  
  <?php if (have_posts()) {
    while(have_posts()) {
      the_post(); ?>
      <!-- start your html here -->
      <div class="flex items-center">
        <div class="w-24 shrink-0 bg-teal-500">
          <span><?php the_time('M') ?></span>
          <span><?php the_time('d') ?></span>
        </div>
        <div class="pr-6">
          <h1><?php the_title(); ?></h1>
          <p>By <?php the_author_meta('display_name') ?></p>
        </div>
      </div>
      
      
      
      <?php the_content(); ?>
      <!-- end your html here -->
    <?php }
  } ?>
</div>

<?php get_footer();
