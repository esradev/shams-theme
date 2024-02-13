<?php

get_header(); ?>

<div class="max-w-4xl mx-auto px-4">
  
  <?php if (have_posts()) {
    while(have_posts()) {
      the_post(); ?>
      <!-- start your html here -->
      <!-- <div class="flex items-center">
        <div class="w-24 shrink-0 bg-teal-500">
          <span><?php the_time('M') ?></span>
          <span><?php the_time('d') ?></span>
        </div>
        <div class="pr-6">
          <h1><?php the_title(); ?></h1>
          <p>By <?php the_author_meta('display_name') ?></p>
        </div>
      </div> -->
     <!-- <?php the_content(); ?> -->
      <!-- end your html here -->

      <div class="px-6 py-32 lg:px-8">
  <div class="mx-auto max-w-4xl text-base leading-7 text-gray-700">
    <?php 
    $post_categories = get_the_category(); 
      if (!empty($post_categories)) {
        foreach ($post_categories as $category) { ?>
        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="text-base font-semibold leading-7 text-indigo-600"><?php echo esc_html($category->name); ?></a> <span>.</span>
      <?php }
      }   
    ?>
    <h1 class="text-3xl font-bold tracking-tight text-gray-900 my-6 sm:text-4xl"><?php the_title(); ?></h1>
    <p class="mt-6 text-xl leading-8"><?php echo wp_trim_words(get_the_content(), 40, '...'); ?></p>
    <div class="mt-10 max-w-full prose">
<?php the_content(); ?>
  </div>
    
   
  </div>
</div>

    <?php }
  } ?>
</div>

<?php get_footer();
