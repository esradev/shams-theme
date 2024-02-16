<?php
$post_id = get_the_ID();
$date_of_the_lesson = get_post_meta($post_id, 'date-of-the-lesson', true);
$the_audio_of_the_lesson = get_post_meta($post_id, 'the-audio-of-the-lesson', true);
$the_main_text_of_the_lesson = get_post_meta($post_id, 'the-main-text-of-the-lesson', true);
?>
 <article class="flex flex-col min-w-full">
  <div class="flex items-center gap-x-2 text-xs">
    <time datetime="2020-03-16" class="text-gray-500"><?php echo $date_of_the_lesson; ?></time>
    <span aria-hidden="true" class="text-gray-500">•</span>
   <?php 
    $post_categories = get_the_category(); 
      if (!empty($post_categories)) {
        foreach ($post_categories as $category) { ?>
        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="text-gray-600 hover:text-indigo-600"><?php echo esc_html($category->name); ?></a> <span>.</span>
      <?php }
      }   
    ?>

  </div>
  <div class="group relative min-w-full">
    <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
      <a href="<?php the_permalink(); ?>">
        <span class="absolute inset-0"></span>
        <?php the_title(); ?>
      </a>
    </h3>
    <?php 
      if (get_the_content() !== '') { ?>
          <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600 prose min-w-full"><?php echo wp_trim_words(get_the_content(), 40, '...'); ?></p>
      <?php } else { ?>
          <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600 prose min-w-full">متن کامل این جلسه هنوز آماده نشده است، اما صوت جلسه قابل دانلود و استماع می باشد.</p>
      <?php } ?>
  </div>
  <div class="mt-6 flex gap-2 ">
    <div class="flex-shrink-0">
      <a href="<?php $the_audio_of_the_lesson ?>" download="true" class="inline-flex items-center text-sm font-medium text-indigo-600 gap-2 border rounded-lg px-4 py-2 hover:text-gray-50 hover:bg-indigo-600">
        <span>دانلود صوت جلسه</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M7.646 10.854a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 9.293V5.5a.5.5 0 0 0-1 0v3.793L6.354 8.146a.5.5 0 1 0-.708.708z"/>
          <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
        </svg>
      </a>
    </div>
    <div class="flex-shrink-0">
      <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-sm font-medium text-gray-500 gap-2 border rounded-lg px-4 py-2 hover:text-gray-50 hover:bg-gray-500">
        <span>مطالعه بیشتر</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
          <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
        </svg>
      </a>
    </div>
  </div>
</article>