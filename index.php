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

  <div class="py-12 mt-2 sm:py-24">
  <div class="mx-auto max-w-4xl px-2 sm:px-4 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-6 sm:text-4xl"><?php echo $page_title; ?></h1>
      <div class="mt-2 max-w-full text-lg leading-8 text-gray-600"><?php echo $page_description; ?></div>
      <div class="mt-10 space-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16">
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
      }

   // Pagination links
    echo '<div class="pagination">';
    echo paginate_links(array(
        'total' => $query->max_num_pages
    ));
    echo '</div>';

    wp_reset_postdata();
    }    
    ?>
    </div>  
</div>
</div>

<?php get_footer();