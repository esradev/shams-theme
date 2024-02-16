<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100..900&display=swap" rel="stylesheet">    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> class="prose scroll-smooth">
  <nav class="bg-white shadow z-10">
  <div class="mx-auto max-w-4xl px-2 sm:px-4 lg:px-8">
    <div class="flex h-16 justify-between">
      <div class="flex items-center lg:hidden">
        <!-- Mobile menu button -->
        <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg id='mobile-menu-open-icon' class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg id='mobile-menu-close-icon' class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

       <div class="flex px-2 lg:px-0">
        <div class="flex lg:flex-1 items-center justify-center">
          <a href="<?php echo home_url(); ?>">
            <img class="block h-8 w-auto" src="<?php echo get_site_icon_url(); ?>" alt="شمس المعارف، دروس آیت الله حسینی آملی حفظه الله">
          </a>
          
        </div>
        <div class="hidden lg:items-center lg:mr-4 lg:flex lg:gap-2">

          <?php
          // Function to recursively output submenu items
          function output_submenu_items($submenu_items, $parent_id) {
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
        <svg class="h-6 w-6 text-gray-700" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
        </svg>
      </button>
       <!-- Search Overlay -->
      <div id="search-overlay" class="transition scale-125 opacity-0 duration-300 ease-in-out flex justify-center invisible bg-white/90 backdrop-blur-sm fixed inset-0 z-50">
      <div class="max-w-4xl w-full pt-4 sm:pt-16 px-4 sm:px-0">
        <div class="flex justify-end mb-3">
          <svg id="close-overlay-icon" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="text-red-400 hover:text-red-600 cursor-pointer" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
          </svg>
        </div>
        <div class="flex justify-between bg-white border-gray-200 border drop-shadow-md">
          <input id="search-field" placeholder="عبارت مد نظر خود را جستجو کنید..." type="text" class="flex-1 text-xl text-gray-500 py-5 px-6 outline-none">
          <div class="flex items-center bg-indigo-600 hover:bg-indigo-700 cursor-pointer px-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="text-white" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
      </div>
        </div>

        <div class="mt-7 py-7 px-8 bg-white border-gray-200 drop-shadow-md">
          <p id="default-message" class="text-gray-400 text-xl p-5 text-center">نتایج در این جا نشان داده می شوند.</p>
          
          <p id="no-results-message" class="hidden text-red-600 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block ml-2" viewBox="0 0 16 16">
              <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
            </svg> 
            <span>نتیجه ای مرتبط با جستجوی شما یافت نشد.</span>
          </p>

          <div id="loading-icon" class="hidden text-center text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="inline-block animate-spin" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
              <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
            </svg>
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
    <li><a class="flex items-center text-sm text-teal-700 hover:text-teal-500" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mr-3" viewBox="0 0 16 16">
  <path d="M4 3.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5z"/>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
</svg> <span class="title-text">نمونه مطلب #1</span></a></li>
    </template>