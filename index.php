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
    
    <!-- Modernized Header/Hero Section -->
    <section class="mb-10 bg-white border border-emerald-50 rounded-3xl shadow-xl shadow-emerald-900/5 p-8 md:p-12 text-center relative overflow-hidden">
      
      <!-- Decorative subtle Islamic/Academic background glows -->
      <div class="absolute top-0 right-0 -mt-16 -mr-16 w-64 h-64 bg-emerald-50 rounded-full opacity-60 blur-3xl pointer-events-none"></div>
      <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-64 h-64 bg-emerald-100 rounded-full opacity-40 blur-3xl pointer-events-none"></div>

      <div class="relative z-10">
        <?php
        if ($page_title !== '') { ?>
        <h1 class="text-3xl md:text-4xl font-extrabold mb-5 text-emerald-900 font-sans tracking-tight"><?php echo $page_title; ?></h1>
        <div class="text-lg text-gray-600 prose prose-emerald mx-auto leading-relaxed">
          <?php echo $page_description; ?>
        </div>
        <?php } else { ?>
        <h1 class="text-3xl md:text-4xl font-extrabold mb-5 text-emerald-900 font-sans tracking-tight">آیت الله حسینی آملی حفظه الله</h1>
        <p class="text-lg text-gray-600 max-w-full leading-relaxed">
          تمامی دروس آیت الله سید محمدرضا حسینی آملی حفظه الله در این سایت بارگذاری خواهد شد.
        </p>
        <?php } ?>
      </div>
    </section>

    <!-- Modernized Select Input for post order -->
    <?php if (is_category()) { ?>
    <form id="orderForm" method="get">
      <div class="mb-8 flex flex-col sm:flex-row sm:items-center gap-4 bg-white p-4 rounded-2xl shadow-sm border border-emerald-50">
        <label for="order" class="block text-sm font-semibold text-emerald-800 whitespace-nowrap">ترتیب نمایش جلسات:</label>
        <div class="relative w-full sm:w-64">
          <select id="order" name="order"
            class="block w-full py-2.5 px-4 pr-10 border border-emerald-100 bg-slate-50 text-gray-700 rounded-xl shadow-sm font-sans focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition-all cursor-pointer appearance-none">
            <option value="date_asc" <?php echo ($order === 'date_asc') ? 'selected' : ''; ?>>از اولین جلسه</option>
            <option value="date_desc" <?php echo ($order === 'date_desc') ? 'selected' : ''; ?>>از آخرین جلسه</option>
          </select>
          <!-- Custom elegant dropdown arrow -->
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-emerald-600">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>
      </div>
    </form>
    <?php } ?>

    <!-- Lessons/Posts Container -->
    <div class="space-y-12 pt-6">
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

      <!-- Modernized Pagination -->
      <div class="flex mt-16 mb-24">
        <div class="mx-auto flex flex-wrap justify-center gap-1">
          <?php
            // Pagination links upgraded with soft shadows, emerald hovers, and rounded-xl
            echo paginate_links(array(
              'prev_text' => '<span class="inline-flex items-center justify-center bg-white border border-emerald-100 text-emerald-700 hover:bg-emerald-50 hover:text-emerald-800 rounded-xl px-4 py-2 mx-1 my-1 transition-all shadow-sm font-medium">قبلی</span>',
              'next_text' => '<span class="inline-flex items-center justify-center bg-white border border-emerald-100 text-emerald-700 hover:bg-emerald-50 hover:text-emerald-800 rounded-xl px-4 py-2 mx-1 my-1 transition-all shadow-sm font-medium">بعدی</span>',
              'before_page_number' => '<span class="inline-flex items-center justify-center bg-white border border-emerald-100 text-emerald-700 hover:bg-emerald-50 rounded-xl px-4 py-2 mx-1 my-1 transition-all shadow-sm font-medium min-w-[2.5rem]">',
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

<?php get_footer(); ?>