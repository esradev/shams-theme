<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100..900&display=swap" rel="stylesheet">    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <nav class="bg-white shadow">
  <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
    <div class="flex h-16 justify-between">
      <div class="flex px-2 lg:px-0">
        <div class="flex flex-shrink-0 items-center">
          <img class="block h-8 w-auto" src="<?php echo get_site_icon_url(); ?>" alt="شمس المعارف، دروس آیت الله حسینی آملی حفظه الله">
        </div>
        <div class="hidden lg:items-center lg:mr-4 lg:flex lg:gap-2">
          <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
          <?php
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
                      echo '<div id="dropdown-menu-' . $item->ID . '" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button-' . $item->ID . '" tabindex="-1">';
                      foreach ($submenu_items[$item->ID] as $submenu_item) {
                          echo '<a href="' . $submenu_item->url . '" class="text-gray-800 block p-3 text-sm" role="menuitem" tabindex="-1">' . $submenu_item->title . '</a>';
                      }
                      echo '</div>';
                  }
          
                  echo '</div>';
              }
          }
          ?>

        </div>
      </div>
      <div class="flex flex-1 items-center justify-center px-2 lg:ml-6 lg:justify-end">
        <div class="w-full max-w-lg lg:max-w-xs">
          <label for="search" class="sr-only">Search</label>
          <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
              </svg>
            </div>
            <input id="search" name="search" class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search" type="search">
          </div>
        </div>
      </div>
      <div class="flex items-center lg:hidden">
        <!-- Mobile menu button -->
        <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg id='mobile-menu-open-icon' class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg id='mobile-menu-close-icon' class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="lg:hidden hidden" id="mobile-menu">
    <div class="space-y-1 pb-3 pt-2">
      <!-- Current: "bg-indigo-50 border-indigo-500 text-indigo-700", Default: "border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800" -->
      <a href="#" class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700">Dashboard</a>
      <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Team</a>
      <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Projects</a>
      <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Calendar</a>
    </div>  
  </div>
</nav>
