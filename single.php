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
          <div id="audio-info" class="flex items-center mb-4 md:mb-0">
            <img id="audio-cover" src="<?php echo get_template_directory_uri() . '/assets/images/photo-150.jpg' ?>"
              alt="Cover" class="w-20 h-20 object-cover ml-4 rounded-full">
            <div class="ml-4">
              <h2 id="audio-title" class="text-lg font-semibold text-white"><?php the_title(); ?></h2>
              <p id="audio-artist" class="text-sm">آیت الله حسینی آملی (حفظه الله)</p>
            </div>
          </div>
          <div id="audio-controls" class="flex items-center justify-center md:justify-start">
            <button id="audio-next" class="mr-4">
              <span class="text-white">بعدی</span>
              <a href="<?php echo get_permalink(get_adjacent_post(true, '', false)); ?>" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                  <path
                    d="M4.79 5.093A.5.5 0 0 0 4 5.5v5a.5.5 0 0 0 .79.407L7.5 8.972V10.5a.5.5 0 0 0 .79.407L11 8.972V10.5a.5.5 0 0 0 1 0v-5a.5.5 0 0 0-1 0v1.528L8.29 5.093a.5.5 0 0 0-.79.407v1.528z" />
                  <path
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                </svg>
              </a>

            </button>

            <button id="play-button" class="mr-4">
              <span class="text-white">پخش</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-play-btn"
                viewBox="0 0 16 16">
                <path d="M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z" />
                <path
                  d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
              </svg>
            </button>
            <button id="pause-button" class="hidden mr-4">
              <span class="text-white">توقف</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pause-btn"
                viewBox="0 0 16 16">
                <path
                  d="M6.25 5C5.56 5 5 5.56 5 6.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C7.5 5.56 6.94 5 6.25 5m3.5 0c-.69 0-1.25.56-1.25 1.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C11 5.56 10.44 5 9.75 5" />
                <path
                  d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
              </svg>
            </button>

            <button id="audio-prev" class="mr-4">
              <span class="text-white">قبلی</span>
              <a href="<?php echo get_permalink(get_adjacent_post(true, '', true)); ?>" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                  class="bi bi-skip-backward-btn" viewBox="0 0 16 16">
                  <path
                    d="M11.21 5.093A.5.5 0 0 1 12 5.5v5a.5.5 0 0 1-.79.407L8.5 8.972V10.5a.5.5 0 0 1-.79.407L5 8.972V10.5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 1 0v1.528l2.71-1.935a.5.5 0 0 1 .79.407v1.528z" />
                  <path
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                </svg>
              </a>
            </button>

            <button class="mr-4">
              <span class="text-white
              ">دانلود</span>
              <a href="<?php echo $the_audio_of_the_lesson; ?>" download="lesson-audio.mp3" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                  class="bi bi-download" viewBox="0 0 16 16">
                  <path
                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                  <path
                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                </svg>
              </a>
            </button>
          </div>
        </div>
        <div class="flex justify-between text-sm mt-2">
          <span id="audio-current-time">00:00</span>
          <span id="audio-duration">00:00</span>
        </div>
        <div id="audio-progress-container" class="h-2 bg-gray-600 rounded mt-4 cursor-pointer">
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