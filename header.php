<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#16a34a" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100..900&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> class="prose scroll-smooth overflow-x-hidden">
  <nav class="bg-white shadow z-10">
    <div class="mx-auto max-w-4xl px-2 sm:px-4 lg:px-8">
      <div class="flex h-16 justify-between">
        <div class="flex items-center lg:hidden">
          <!-- Mobile menu button -->
          <button id="mobile-menu-button" type="button"
            class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
            aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <?php 
            echo get_svg_icon('bars-3', 'mobile-menu-open-icon', 'h-6 w-6');
            echo get_svg_icon('x-circle', 'mobile-menu-close-icon', 'h-6 w-6 hidden');
            ?>
          </button>
        </div>

        <div class="flex px-2 lg:px-0">
          <div class="flex lg:flex-1 items-center justify-center">
            <a href="<?php echo home_url(); ?>">
              <img class="block h-8 w-auto" src="<?php echo get_site_icon_url(); ?>" height="32" width="32"
                alt="شمس المعارف، دروس آیت الله حسینی آملی حفظه الله">
            </a>

          </div>
          <div class="hidden lg:items-center lg:mr-4 lg:flex lg:gap-2">

            <?php
            // Function to recursively output submenu items
            function output_submenu_items($submenu_items, $parent_id)
            {
              if (isset($submenu_items[$parent_id])) {
                echo '<div id="dropdown-menu-' . $parent_id . '" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" tabindex="-1">';
                foreach ($submenu_items[$parent_id] as $submenu_item) {
                  echo '<a href="' . $submenu_item->url . '" class="text-gray-800 block p-3 text-sm" role="menuitem" tabindex="-1">' . $submenu_item->title . '</a>';
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

                echo '<div class="relative inline-block text-right">';

                // Output as button only if it has submenu items
                if ($has_submenu) {
                  echo '<button type="button" id="menu-button-' . $item->ID . '" aria-expanded="false" aria-haspopup="true" class="inline-flex w-full justify-center gap-x-1.5 bg-white px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">' . $item->title . '<svg class="-mr-1 h-5 w-5 text-gray-700" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg></button>';
                } else {
                  echo '<a href="' . $item->url . '" class="inline-flex w-full justify-center gap-x-1.5 bg-white px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">' . $item->title . '</a>';
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
        <button id="search-icon" class="flex items-center justify-center p-2 lg:justify-end">
          <?php echo get_svg_icon('search', '', 'h-6 w-6 text-gray-700'); ?>
        </button>
        <!-- Search Overlay -->
        <div id="search-overlay"
          class="transition scale-125 opacity-0 duration-300 ease-in-out flex justify-center invisible bg-white/90 backdrop-blur-sm fixed inset-0 z-50">
          <div class="max-w-4xl w-full pt-4 sm:pt-16 px-4 sm:px-0 overflow-x-hidden">
            <div class="flex justify-end mb-3">
              <?php echo get_svg_icon('x-circle', 'close-overlay-icon', 'text-red-400 hover:text-red-600 cursor-pointer h-8 w-8'); ?>
            </div>
            <div class="flex justify-between bg-white border-gray-200 border drop-shadow-md">
              <input id="search-field" placeholder="عبارت مد نظر خود را جستجو کنید..." type="text"
                class="flex-1 text-xl text-gray-500 py-5 px-6 outline-none">
              <div class="flex items-center bg-indigo-600 hover:bg-indigo-700 cursor-pointer px-5">
                <?php echo get_svg_icon('search', '', 'h-6 w-6 text-white'); ?>
              </div>
            </div>

            <div class="mt-7 py-7 px-8 bg-white border-gray-200 drop-shadow-md">
              <p id="default-message" class="text-gray-400 text-xl p-5 text-center">نتایج در این جا نشان داده می شوند.
              </p>

              <p id="no-results-message" class="hidden text-red-600 items-center">
                <?php echo get_svg_icon('exclamation-triangle', '', 'h-6 w-6 text-red-600 inline-block ml-2'); ?>
                <span>نتیجه ای مرتبط با جستجوی شما یافت نشد.</span>
              </p>

              <div id="loading-icon" class="hidden text-center text-indigo-500">
                <?php echo get_svg_icon('arrow-path', '', 'inline-block animate-spin h-8 w-8 text-indigo-500'); ?>
              </div>

              <ul id="results-area" class="hidden space-y-4">
              </ul>
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="lg:hidden hidden" id="mobile-menu">
      <div class="space-y-1 pb-3 pt-2">
        <?php
        foreach ($menu as $item) {
          if ($item->menu_item_parent == 0) {
            // Check if the current item has submenu items
            $has_submenu = isset($submenu_items[$item->ID]);

            echo '<div class="relative block text-right min-w-full">';

            // Output as button only if it has submenu items
            echo '<a href="' . $item->url . '" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-bold text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">' . $item->title . '</a>';


            // Output dropdown menu if exists for mobile
            if ($has_submenu) {
              echo '<div id="dropdown-menu-' . $item->ID . '" class="text-gray-800 block p-3 text-lg mr-2"  role="menu" aria-orientation="vertical" aria-labelledby="menu-button-' . $item->ID . '" tabindex="-1">';
              foreach ($submenu_items[$item->ID] as $submenu_item) {
                echo '<a href="' . $submenu_item->url . '" class="text-gray-800 block p-3 text-lg" role="menuitem" tabindex="-1">' . $submenu_item->title . '</a>';
              }
            }

            echo '</div>';
          }
        }
        ?>
      </div>
    </div>
  </nav>

  <template id="li-template">
    <li>
      <a class="flex items-center text-base text-indigo-600 hover:text-indigo-700" href="#">
        <?php echo get_svg_icon('document-text', '', 'h-5 w-5 text-indigo-600 ml-2'); ?>
        <span class="title-text">نمونه مطلب #1</span>
      </a>
    </li>
  </template>