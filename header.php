<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Updated theme color to a nice modern emerald green -->
  <meta name="theme-color" content="#059669" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100..900&display=swap" rel="stylesheet">
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-LY052PR0E7"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-LY052PR0E7');
  </script>

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MFGKXZN6');</script>
  <!-- End Google Tag Manager -->
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> class="prose scroll-smooth overflow-x-hidden selection:bg-emerald-100 selection:text-emerald-900 bg-slate-50/50">
<!-- Google Tag Manager (noscript) -->
<noscript>
  <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MFGKXZN6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
  
  <!-- Modernized Nav: Soft shadow, frosted glass effect -->
  <nav class="bg-white/90 backdrop-blur-md shadow-sm shadow-emerald-900/5 border-b border-emerald-50 z-40 sticky top-0 transition-all duration-300">
    <div class="mx-auto max-w-4xl px-2 sm:px-4 lg:px-8">
      <div class="flex h-20 justify-between items-center">
        <div class="flex items-center lg:hidden">
          <!-- Mobile menu button -->
          <button id="mobile-menu-button" type="button"
            class="inline-flex items-center justify-center rounded-xl p-2.5 text-emerald-700 hover:bg-emerald-50 hover:text-emerald-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500 transition-colors"
            aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <?php 
            echo get_svg_icon('bars-3', 'mobile-menu-open-icon', 'h-7 w-7');
            echo get_svg_icon('x-circle', 'mobile-menu-close-icon', 'h-7 w-7 hidden');
            ?>
          </button>
        </div>

        <div class="flex px-2 lg:px-0 w-full lg:w-auto justify-between lg:justify-start items-center">
          <div class="flex lg:flex-1 items-center justify-center">
            <a href="<?php echo home_url(); ?>" class="hover:opacity-80 transition-opacity">
              <img class="block h-10 w-auto drop-shadow-sm" src="<?php echo get_site_icon_url(); ?>" height="40" width="40"
                alt="شمس المعارف، دروس آیت الله حسینی آملی حفظه الله">
            </a>
          </div>
          <div class="hidden lg:items-center lg:mr-8 lg:flex lg:gap-1">

            <?php
            // Function to recursively output submenu items
            function output_submenu_items($submenu_items, $parent_id)
            {
              if (isset($submenu_items[$parent_id])) {
                // Modern rounded dropdown
                echo '<div id="dropdown-menu-' . $parent_id . '" class="hidden absolute right-0 z-50 mt-3 w-56 origin-top-right rounded-2xl bg-white shadow-xl shadow-emerald-900/10 ring-1 ring-emerald-100 focus:outline-none overflow-hidden py-1.5" role="menu" tabindex="-1">';
                foreach ($submenu_items[$parent_id] as $submenu_item) {
                  echo '<a href="' . $submenu_item->url . '" class="text-gray-600 hover:text-emerald-700 hover:bg-emerald-50 block px-5 py-2.5 text-sm font-medium transition-colors duration-200" role="menuitem" tabindex="-1">' . $submenu_item->title . '</a>';
                  // Check if the submenu item has further submenu items
                  output_submenu_items($submenu_items, $submenu_item->ID);
                }
                echo '</div>';
              }
            }

            $menu = wp_get_nav_menu_items('main-menu');
            $submenu_items = [];

            // Collect submenu items
            foreach ($menu as $item) {
              if ($item->menu_item_parent != 0) {
                $submenu_items[$item->menu_item_parent][] = $item;
              }
            }

            // Output menu items
            foreach ($menu as $item) {
              if ($item->menu_item_parent == 0) {
                // Check if the current item has submenu items
                $has_submenu = isset($submenu_items[$item->ID]);

                echo '<div class="relative inline-block text-right group">';

                // Output as button only if it has submenu items
                if ($has_submenu) {
                  echo '<button type="button" id="menu-button-' . $item->ID . '" aria-expanded="false" aria-haspopup="true" class="inline-flex w-full items-center justify-center gap-x-1.5 bg-transparent px-4 py-2 text-base font-semibold text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 rounded-xl transition-all duration-200">' . $item->title . '<svg class="-mr-1 h-5 w-5 text-gray-400 group-hover:text-emerald-600 transition-colors" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg></button>';
                } else {
                  echo '<a href="' . $item->url . '" class="inline-flex w-full justify-center items-center gap-x-1.5 bg-transparent px-4 py-2 text-base font-semibold text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 rounded-xl transition-all duration-200">' . $item->title . '</a>';
                }

                // Output dropdown menu if exists
                if ($has_submenu) {
                  output_submenu_items($submenu_items, $item->ID);
                }

                echo '</div>';
              }
            }
            ?>
          </div>
        </div>

        <!-- Search Button -->
        <button id="search-icon" class="flex items-center justify-center p-2.5 rounded-xl text-emerald-700 hover:bg-emerald-50 transition-colors duration-200 lg:justify-end">
          <?php echo get_svg_icon('search', '', 'h-6 w-6'); ?>
        </button>

      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="lg:hidden hidden border-t border-emerald-50 bg-white/50 backdrop-blur-md" id="mobile-menu">
      <div class="space-y-1 pb-4 pt-2 px-3">
        <?php
        foreach ($menu as $item) {
          if ($item->menu_item_parent == 0) {
            // Check if the current item has submenu items
            $has_submenu = isset($submenu_items[$item->ID]);

            echo '<div class="relative block text-right min-w-full">';

            echo '<a href="' . $item->url . '" class="block rounded-xl mx-2 my-1 py-3 px-4 text-base font-semibold text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors">' . $item->title . '</a>';

            // Output dropdown menu if exists for mobile
            if ($has_submenu) {
              echo '<div id="dropdown-menu-' . $item->ID . '" class="text-gray-600 block px-3 py-1 mr-4 border-r-2 border-emerald-100"  role="menu" aria-orientation="vertical" aria-labelledby="menu-button-' . $item->ID . '" tabindex="-1">';
              foreach ($submenu_items[$item->ID] as $submenu_item) {
                echo '<a href="' . $submenu_item->url . '" class="text-gray-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg block px-4 py-2.5 text-sm font-medium transition-colors" role="menuitem" tabindex="-1">' . $submenu_item->title . '</a>';
              }
              echo '</div>';
            }

            echo '</div>';
          }
        }
        ?>
      </div>
    </div>
  </nav>

  <!-- UX Improved Minimalistic Search Modal -->
  <!-- Dimmed the background more (bg-slate-900/30) to increase focus on the search box -->
  <div id="search-overlay"
    class="transition scale-110 opacity-0 duration-300 ease-in-out flex justify-center invisible bg-slate-900/30 backdrop-blur-sm fixed inset-0 z-[100]">
    
    <div class="max-w-2xl w-full pt-4 sm:pt-20 px-4 sm:px-0">
      
      <!-- Unified Single Card -->
      <div class="bg-white rounded-3xl shadow-2xl flex flex-col overflow-hidden max-h-[85vh]">
        
        <!-- Search Header (Input + Icons) -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
          
          <div class="flex items-center flex-1 gap-4">
            <!-- Sleek inline search icon -->
            <div class="text-emerald-500 shrink-0">
              <?php echo get_svg_icon('search', '', 'h-6 w-6'); ?>
            </div>
            
            <input id="search-field" placeholder="جستجوی دروس، موضوعات و..." type="text"
              class="flex-1 text-lg sm:text-xl text-gray-800 placeholder-gray-400 outline-none bg-transparent py-2 w-full">
          </div>

          <!-- Close button integrated gracefully on the side -->
          <div class="shrink-0 mr-4">
            <button class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-full transition-colors duration-200">
              <?php echo get_svg_icon('x-circle', 'close-overlay-icon', 'h-7 w-7'); ?>
            </button>
          </div>
          
        </div>

        <!-- Search Results Area -->
        <div class="overflow-y-auto p-4 sm:p-6 bg-slate-50/50">
          
          <p id="default-message" class="text-gray-400 text-sm sm:text-base p-8 text-center">
            عبارت مورد نظر خود را تایپ کنید تا نتایج فورا نمایش داده شوند.
          </p>

          <div id="no-results-message" class="hidden flex-col items-center justify-center p-8 text-center">
            <?php echo get_svg_icon('exclamation-triangle', '', 'h-10 w-10 text-amber-300 mb-3'); ?>
            <p class="text-gray-500 font-medium">نتیجه ای مرتبط با جستجوی شما یافت نشد.</p>
          </div>

          <div id="loading-icon" class="hidden flex justify-center p-8">
            <?php echo get_svg_icon('arrow-path', '', 'animate-spin h-8 w-8 text-emerald-500'); ?>
          </div>

          <ul id="results-area" class="hidden space-y-1">
          </ul>

        </div>
      </div>

    </div>
  </div>

  <!-- Sleek, Minimalistic List Item Template for Search Results -->
  <template id="li-template">
    <li>
      <a class="group flex items-center justify-between p-3 sm:p-4 rounded-xl hover:bg-white hover:shadow-sm hover:shadow-emerald-900/5 transition-all duration-200 border border-transparent hover:border-emerald-50" href="#">
        <div class="flex items-center gap-3">
          <div class="p-2 bg-emerald-50 text-emerald-500 rounded-lg group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-200 shrink-0">
            <?php echo get_svg_icon('document-text', '', 'h-5 w-5'); ?>
          </div>
          <span class="title-text font-bold text-gray-700 group-hover:text-emerald-800 transition-colors text-sm sm:text-base line-clamp-1">نمونه مطلب #1</span>
        </div>
        
        <span class="text-gray-300 group-hover:text-emerald-600 transition-colors shrink-0 mr-4">
          <?php echo get_svg_icon('arrow-left', '', 'h-5 w-5'); ?>
        </span>
      </a>
    </li>
  </template>