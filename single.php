<?php

get_header(); ?>

<div class="max-w-4xl mx-auto px-2 overflow-x-hidden sm:px-4 lg:px-8">

  <?php if (have_posts()) {
    while (have_posts()) {
      the_post(); ?>

  <div class="py-32 px-2 sm:px-4 lg:px-8">
    <div class="mx-auto max-w-4xl text-base leading-7 text-gray-700">
      <?php
          $post_categories = get_the_category();
          if (!empty($post_categories)) {
            foreach ($post_categories as $category) { ?>
      <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
        class="text-base font-semibold leading-7 text-indigo-600"><?php echo esc_html($category->name); ?></a>
      <span>.</span>
      <?php }
          }
          ?>

      <h1 class="text-3xl font-bold tracking-tight text-gray-900 my-6 sm:text-4xl"><?php the_title(); ?></h1>
      <p class="mt-6 text-xl leading-8"><?php echo wp_trim_words(get_the_content(), 40, '...'); ?></p>

      <!-- add the audio download link -->
      <?php
          $post_id = get_the_ID();
          $the_audio_of_the_lesson = get_post_meta($post_id, 'the-audio-of-the-lesson', true);
          ?>
      <!-- add the audio tag -->
      <?php
          $the_audio_of_the_lesson = get_post_meta($post_id, 'the-audio-of-the-lesson', true);
          ?>

      <div id="audio-player" class="bg-gray-800 text-white p-4 my-10 rounded-xl shadow">
        <div class="flex flex-col md:flex-row items-center justify-between">
          <div id="audio-info" class="flex items-center">
            <img id="audio-cover" src="<?php echo get_template_directory_uri() . '/assets/images/photo-150.jpg' ?>"
              alt="Cover" class="w-20 h-20 object-cover ml-4 rounded-full">
            <div class="ml-4">
              <h2 id="audio-title" class="text-lg font-semibold text-white"><?php the_title(); ?></h2>
              <p id="audio-artist" class="text-sm">آیت الله حسینی آملی (حفظه الله)</p>
            </div>
          </div>
          <div id="audio-controls" class="flex flex-col items-center justify-center md:justify-start">
            <div class="flex items-center justify-center md:justify-start">
              <!-- <div class="w-20 ml-12">
                <input id="volume" type="range" min="0" max="100" value="100" class="slider">
              </div> -->
              <button id="audio-prev" class="mr-4">
                <a href="<?php echo get_permalink(get_adjacent_post(true, '', true)); ?>" class="text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811V8.69ZM12.75 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061a1.125 1.125 0 0 1-1.683-.977V8.69Z" />
                  </svg>
                </a>
              </button>

              <button id="play-button" class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                </svg>

              </button>
              <button id="pause-button" class="hidden mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-8 h-8">
                  <path stroreke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                </svg>
              </button>
              <button id="audio-next" class="mr-4">
                <a href="<?php echo get_permalink(get_adjacent_post(true, '', false)); ?>" class="text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061A1.125 1.125 0 0 1 21 8.689v8.122ZM11.25 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061a1.125 1.125 0 0 1 1.683.977v8.122Z" />
                  </svg>
                </a>
              </button>


            </div>
            <div class="flex items-center justify-center md:justify-start">
              <button id="fast-rewind" class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3" />
                </svg>

              </button>
              <button id="fast-forward" class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>

              </button>

              <select id="play-speed" class="mr-4 bg-gray-800 text-white border-none rounded-md px-4 py-2 outline-none">
                <option value="0.5" class="bg-gray-800 text-white">0.5x</option>
                <option value="1" selected class="bg-gray-800 text-white">1x</option>
                <option value="1.5" class="bg-gray-800 text-white">1.5x</option>
                <option value="2" class="bg-gray-800 text-white">2x</option>
              </select>
              <button class="mr-4">
                <a href="<?php echo $the_audio_of_the_lesson; ?>" download="lesson-audio.mp3" class="text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="m9 13.5 3 3m0 0 3-3m-3 3v-6m1.06-4.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                  </svg>

                </a>
              </button>
            </div>
          </div>
        </div>
        <div class="flex justify-between text-sm mt-2">
          <span id="audio-current-time">00:00</span>
          <span id="audio-duration">00:00</span>
        </div>
        <div id="audio-progress-container" class="h-2 bg-gray-600 rounded mt-1 cursor-pointer">
          <div id="audio-progress" class="h-2 bg-emerald-600 rounded" style="width: 0;"></div>
          <div id="audio-loading" class="h-2 w-full -mt-2 rounded hidden"></div>
        </div>
      </div>
      <audio id="audio" src="" hidden></audio>
    </div>
    <div class="mt-10 max-w-full prose">
      <?php the_content(); ?>
    </div>
  </div>
</div>

<?php }
  } ?>
</div>

<?php get_footer();