<?php

get_header(); ?>

<div class="max-w-4xl mx-auto px-2 overflow-x-hidden sm:px-4 lg:px-8">

  <?php if (have_posts()) {
    while (have_posts()) {
      the_post(); ?>

  <div class="py-12 px-2 sm:px-4 lg:px-8">
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
      <p class="mt-6 text-xl leading-8">
          <?php
		      if (has_excerpt()) {
				      echo get_the_excerpt();
		      } else {
				      echo wp_trim_words(get_the_content(), 55, '...');
		      }
          ?></p>

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
                  <?php echo get_svg_icon('forward', '', 'h-8 w-8'); ?>
                </a>
              </button>

              <button id="play-button" class="mr-4">
                <?php echo get_svg_icon('play-circle', '', 'h-8 w-8'); ?>
              </button>
              <button id="pause-button" class="hidden mr-4">
                <?php echo get_svg_icon('pause-circle', '', 'h-8 w-8'); ?>
              </button>
              <button id="audio-next" class="mr-4">
                <a href="<?php echo get_permalink(get_adjacent_post(true, '', false)); ?>" class="text-white">
                  <?php echo get_svg_icon('backward', '', 'h-8 w-8'); ?>
                </a>
              </button>


            </div>
            <div class="flex items-center justify-center md:justify-start">
              <button id="fast-rewind" class="mr-4">
                <?php echo get_svg_icon('arrow-uturn-right', '', 'h-7 w-7'); ?>
              </button>
              <button id="fast-forward" class="mr-4">
                <?php echo get_svg_icon('arrow-uturn-left', '', 'h-7 w-7'); ?>
              </button>

              <select id="play-speed" class="mr-4 bg-gray-800 text-white border-none rounded-md px-4 py-2 outline-none">
                <option value="0.5" class="bg-gray-800 text-white">0.5x</option>
                <option value="1" selected class="bg-gray-800 text-white">1x</option>
                <option value="1.5" class="bg-gray-800 text-white">1.5x</option>
                <option value="2" class="bg-gray-800 text-white">2x</option>
              </select>
              <button class="mr-4">
                <a href="<?php echo $the_audio_of_the_lesson; ?>" download="lesson-audio.mp3" class="text-white">
                  <?php echo get_svg_icon('folder-arrow-down', '', 'h-7 w-7'); ?>
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