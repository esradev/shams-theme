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

// Get the selected values from the query string (with defaults)
$order = isset($_GET['order']) ? $_GET['order'] : 'date';
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10;
$view_mode = isset($_GET['view_mode']) ? $_GET['view_mode'] : 'list';

?>

<div class="py-10 mt-2 sm:py-16">
  <div class="mx-auto max-w-4xl px-2 sm:px-4 lg:px-8">
    
<!-- Minimalist Academic Header Section -->
    <section class="mb-10 bg-white border border-gray-100 rounded-2xl shadow-sm px-6 py-10 md:py-14 text-center flex flex-col items-center">
      
      <?php if ($page_title !== '') { ?>
        
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-5 tracking-tight"><?php echo $page_title; ?></h1>
        
        <!-- Elegant Academic Accent Line -->
        <span class="block w-12 h-1 bg-emerald-600 rounded-full mb-6 opacity-80"></span>
        
        <div class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto prose prose-emerald text-center">
          <?php echo $page_description; ?>
        </div>
        
      <?php } else { ?>
        
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-5 tracking-tight">آیت الله حسینی آملی حفظه الله</h1>
        
        <!-- Elegant Academic Accent Line -->
        <span class="block w-12 h-1 bg-emerald-600 rounded-full mb-6 opacity-80"></span>
        
        <p class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto">
          تمامی دروس آیت الله سید محمدرضا حسینی آملی حفظه الله در این سایت بارگذاری خواهد شد.
        </p>
        
      <?php } ?>
      
    </section>
    <!-- Modernized Filter & View Controls -->
    <?php if (is_category()) { ?>
    <form id="filterForm" method="get">
      <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-4 rounded-2xl shadow-sm border border-emerald-50">
        
        <!-- Right side: Sort and Per Page -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 w-full md:w-auto">
          
          <!-- Order Dropdown -->
          <div class="flex items-center gap-2">
            <label for="order" class="text-sm font-semibold text-emerald-800 whitespace-nowrap">ترتیب:</label>
            <div class="relative w-full sm:w-48">
              <select id="order" name="order" onchange="this.form.submit()"
                class="block w-full py-2.5 px-4 pr-10 border border-emerald-100 bg-slate-50 text-gray-700 rounded-xl shadow-sm font-sans focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition-all cursor-pointer appearance-none">
                <option value="date_asc" <?php echo ($order === 'date_asc') ? 'selected' : ''; ?>>از اولین جلسه</option>
                <option value="date_desc" <?php echo ($order === 'date_desc') ? 'selected' : ''; ?>>از آخرین جلسه</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-emerald-600">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
              </div>
            </div>
          </div>

          <!-- Per Page Dropdown -->
          <div class="flex items-center gap-2">
            <label for="per_page" class="text-sm font-semibold text-emerald-800 whitespace-nowrap">تعداد:</label>
            <div class="relative w-full sm:w-24">
              <select id="per_page" name="per_page" onchange="this.form.submit()"
                class="block w-full py-2.5 px-4 pr-8 border border-emerald-100 bg-slate-50 text-gray-700 rounded-xl shadow-sm font-sans focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition-all cursor-pointer appearance-none">
                <option value="10" <?php echo ($per_page == 10) ? 'selected' : ''; ?>>10</option>
                <option value="20" <?php echo ($per_page == 20) ? 'selected' : ''; ?>>20</option>
                <option value="50" <?php echo ($per_page == 50) ? 'selected' : ''; ?>>50</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-emerald-600">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
              </div>
            </div>
          </div>

        </div>

        <!-- Left side: View Mode Toggle -->
        <div class="flex items-center bg-slate-50 border border-emerald-100 rounded-xl p-1 self-start md:self-auto shrink-0">
          <!-- List View Button -->
          <input type="radio" id="view_list" name="view_mode" value="list" class="hidden" onchange="this.form.submit()" <?php echo ($view_mode === 'list') ? 'checked' : ''; ?>>
          <label for="view_list" class="cursor-pointer px-4 py-2 rounded-lg flex items-center gap-2 transition-all duration-200 <?php echo $view_mode === 'list' ? 'bg-white shadow-sm text-emerald-700 font-bold' : 'text-gray-400 hover:text-emerald-600'; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
            <span class="text-sm hidden sm:block">لیست</span>
          </label>

          <!-- Grid View Button -->
          <input type="radio" id="view_grid" name="view_mode" value="grid" class="hidden" onchange="this.form.submit()" <?php echo ($view_mode === 'grid') ? 'checked' : ''; ?>>
          <label for="view_grid" class="cursor-pointer px-4 py-2 rounded-lg flex items-center gap-2 transition-all duration-200 <?php echo $view_mode === 'grid' ? 'bg-white shadow-sm text-emerald-700 font-bold' : 'text-gray-400 hover:text-emerald-600'; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            <span class="text-sm hidden sm:block">شبکه</span>
          </label>
        </div>

      </div>
    </form>
    <?php } ?>

    <!-- Container layout changes dynamically based on View Mode -->
    <?php 
      $container_class = ($view_mode === 'grid') 
        ? 'grid grid-cols-1 md:grid-cols-2 gap-6 pt-4' 
        : 'flex flex-col space-y-10 pt-4';
    ?>
    
    <div class="<?php echo $container_class; ?>">
      <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => $per_page, 
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
          
          // We pass the view mode globally so the blog-post template knows about it
          set_query_var('current_view_mode', $view_mode); 
          get_template_part('templates/content', 'blog-post');
        } ?>
    </div> <!-- Close Dynamic Grid/List Container here -->

      <!-- Modernized Pagination -->
      <div class="flex mt-16 mb-24 w-full">
        <div class="mx-auto flex flex-wrap justify-center gap-1">
          <?php
            echo paginate_links(array(
              'total' => $query->max_num_pages, // TELLS WP HOW MANY PAGES THERE ARE BASED ON PER_PAGE
              'current' => max(1, get_query_var('paged')),
              'add_args' => array(              // CARRIES YOUR FILTERS OVER TO PAGE 2, PAGE 3, ETC.
                  'order' => $order,
                  'per_page' => $per_page,
                  'view_mode' => $view_mode
              ),
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
      } else { ?>
        </div> <!-- Close Dynamic Grid/List Container even if no posts -->
      <?php } ?>
  </div>
</div>

<?php get_footer(); ?>