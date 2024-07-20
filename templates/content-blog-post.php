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
    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
      class="text-gray-600 hover:text-indigo-600"><?php echo esc_html($category->name); ?></a> <span>.</span>
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
    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600 prose min-w-full">
      <?php echo wp_trim_words(get_the_content(), 40, '...'); ?></p>
    <?php } else { ?>
    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600 prose min-w-full">متن کامل این جلسه هنوز آماده نشده است،
      اما صوت جلسه قابل دریافت و استماع می باشد.</p>
    <?php } ?>
  </div>
  <div class="mt-6 flex gap-2 ">
    <div class="flex-shrink-0">
      <a href="<?php echo $the_audio_of_the_lesson; ?>" download="true"
        class="inline-flex items-center text-sm font-medium text-indigo-600 gap-2 border border-indigo-600 rounded-lg px-4 py-2 no-underline hover:text-gray-50 hover:bg-indigo-600">
        <span>دریافت صوت جلسه</span>
        <?php echo get_svg_icon('folder-arrow-down', 'download-icon', 'h-6 w-6'); ?>
      </a>
    </div>
    <div class="flex-shrink-0">
      <a href="<?php the_permalink(); ?>"
        class="inline-flex items-center text-sm font-medium text-gray-500 gap-2 border rounded-lg px-4 py-2 hover:text-gray-50 hover:bg-gray-500">
        <span>مطالعه بیشتر</span>
        <?php echo get_svg_icon('document-text', 'read-more-icon', 'h-6 w-6'); ?>
      </a>
    </div>
  </div>
</article>