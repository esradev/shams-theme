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
      <div class="mt-10 max-w-full prose">
        <!-- add the audio download link -->
        <?php
            $post_id = get_the_ID();
            $the_audio_of_the_lesson = get_post_meta($post_id, 'the-audio-of-the-lesson', true);
            ?>
        <div class="mt-6 flex gap-2 border border-x-0 py-4">
          <div class="flex-shrink-0">
            <a href="<?php echo $the_audio_of_the_lesson; ?>" download="true"
              class="inline-flex items-center text-sm font-medium text-indigo-600 gap-2 border border-indigo-600 rounded-lg px-4 py-2 no-underline hover:text-gray-50 hover:bg-indigo-600">
              <span>دانلود صوت جلسه</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M7.646 10.854a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 9.293V5.5a.5.5 0 0 0-1 0v3.793L6.354 8.146a.5.5 0 1 0-.708.708z" />
                <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-
      1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
              </svg>
            </a>
          </div>
        </div>
        <?php the_content(); ?>

        <!-- add the audio tag -->
        <?php
            $the_audio_of_the_lesson = get_post_meta($post_id, 'the-audio-of-the-lesson', true);
            ?>
        <div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200">
          <div class="max-w-4xl mx-auto px-2 overflow-x-hidden sm:px-4 lg:px-8">
            <div class="flex items-center justify-between gap-2">
              <div class="hidden sm:flex items-center gap-2">
                <div class="flex-shrink-0">
                  <img src="<?php echo get_site_icon_url(); ?>" alt="audio" class="w-12 h-12" />
                </div>
                <div class="flex flex-col">
                  <h3 class="text-lg font-semibold text-gray-900"><?php the_title(); ?></h3>
                  <p class="text-sm text-gray-500"> آیت الله حسینی آملی (حفظه الله)</p>
                </div>
              </div>
              <div class="flex flex-1 items-center gap-2">
                <audio controls class="w-full">
                  <source src="<?php echo $the_audio_of_the_lesson; ?>" type="audio/mpeg">
                  Your browser does not support the audio element.
                </audio>
              </div>
            </div>
          </div>
        </div>





      </div>
    </div>
  </div>

  <?php }
  } ?>
</div>

<?php get_footer();