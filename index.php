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
        <h1 class="text-3xl font-bold mb-4"><?php echo $page_title; ?></h1>
        <p class="text-lg text-gray-600 prose dark:text-gray-400">
          <?php echo $page_description; ?>
        </p>
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