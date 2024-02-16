<?php

get_header();

if (is_category()) {
    $page_title = single_cat_title('', false);
    $page_description = category_description();
} elseif (is_page()) {
    $page_title = get_the_title();
    $page_description = get_the_content();
} else {
    $page_title = '';
    $page_description = '';
}
?>

  <div class="py-10 mt-2 sm:py-16">
  <div class="mx-auto max-w-4xl px-2 sm:px-4 lg:px-8">
    <section class="mb-8 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-sm p-6 text-center">
      <?php 
      if ($page_title !== '') { ?>
      <h1 class="text-3xl font-bold mb-4"><?php echo $page_title; ?></h1>
      <p class="text-lg text-gray-600 prose dark:text-gray-400">
        <?php echo $page_description; ?>
      </p>
      <?php } else { ?>
        <h1 class="text-3xl font-bold mb-4">آیت الله حسینی آملی حفظه الله</h1>
        <p class="text-lg text-gray-600 mix-w-full dark:text-gray-400">
          تمامی دروس آیت الله سید محمدرضا حسینی آملی حفظه الله در این سایت بارگذاری خواهد شد.
        </p>
      <?php } ?>
        
    </section>
      <div class="space-y-16 pt-10">
    <?php
    // Example loop with pagination
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 10,
        'paged' => $paged
    );
    
    $query = new WP_Query($args);
    if (have_posts()) {
      while(have_posts()) {
        the_post();
        get_template_part('templates/content', 'blog-post');
      } ?>

   
      <div class="flex my-20">
        <div class="mx-auto">
          <?php
          // Pagination links with tailwind classes for next and previous buttons and all the numbers in between
            echo paginate_links(array(
            'prev_text' => '<span class="border border-gray-300 text-gray-600 rounded-md px-3 py-1 ml-2">قبلی</span>',
            'next_text' => '<span class="border border-gray-300 text-gray-600 rounded-md px-3 py-1 mr-2">بعدی</span>',
            'before_page_number' => '<span class="border border-gray-300 text-gray-600 rounded-md px-3 py-1 mr-2">',
            'after_page_number' => '</span>',
            'mid_size' => 3,
            'end_size' => 2,            
            ));
          ?>
        </div>
      </div>


   <?php wp_reset_postdata();
    }    
    ?>
    </div>  
</div>
</div>

<?php get_footer();