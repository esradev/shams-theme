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

// Get the selected order value from the query string
$order = isset($_GET['order']) ? $_GET['order'] : 'date';

?>

<div class="py-10 mt-2 sm:py-16">
  <div class="mx-auto max-w-4xl px-2 sm:px-4 lg:px-8">
    <section class="mb-8 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-sm p-6 text-center">
      <?php
      if ($page_title !== '') { ?>
      <h1 class="text-3xl font-bold mb-4"><?php echo $page_title; ?></h1>
      <p class="text-lg text-gray-600 prose">
        <?php echo $page_description; ?>
      </p>
      <?php } else { ?>
      <h1 class="text-3xl font-bold mb-4">آیت الله حسینی آملی حفظه الله</h1>
      <p class="text-lg text-gray-600 max-w-full">
        تمامی دروس آیت الله سید محمدرضا حسینی آملی حفظه الله در این سایت بارگذاری خواهد شد.
      </p>
      <?php } ?>

    </section>

    <!-- Add the select input for post order -->
    <?php if (is_category()) { ?>
    <form id="orderForm" method="get">
      <div class="mb-4">
        <label for="order" class="block text-base font-medium text-gray-700">ترتیب نمایش جلسات:</label>
        <select id="order" name="order"
          class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow font-sans focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option value="date_asc" <?php echo ($order === 'date_asc') ? 'selected' : ''; ?>>از اولین جلسه</option>
          <option value="date_desc" <?php echo ($order === 'date_desc') ? 'selected' : ''; ?>>از آخرین جلسه</option>
        </select>
      </div>
    </form>
    <?php } ?>


    <div class="space-y-16 pt-10">
      <?php
      // Example loop with pagination
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 10,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'ASC'
      );

      // If it's a category page, add the current category to the query
      if (is_category()) {
        $args['cat'] = get_queried_object_id();
        if ($order === 'date_desc') {
          $args['order'] = 'DESC';
        } elseif ($order === 'date_asc') {
          $args['order'] = 'ASC';
        }
      }


      $query = new WP_Query($args);
      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          get_template_part('templates/content', 'blog-post');
        } ?>


      <div class="flex my-20">
        <div class="mx-auto">
          <?php
            // Pagination links with tailwind classes for next and previous buttons and all the numbers in between
            echo paginate_links(array(
              'prev_text' => '<span class="inline-block border border-gray-300 text-gray-600 rounded-md px-3 py-1 my-2">قبلی</span>',
              'next_text' => '<span class="inline-block border border-gray-300 text-gray-600 rounded-md px-3 py-1 my-2">بعدی</span>',
              'before_page_number' => '<span class="inline-block border border-gray-300 text-gray-600 rounded-md px-3 py-1 mr-1 my-2">',
              'after_page_number' => '</span>',
              'mid_size' => 1,
              'end_size' => 1,
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