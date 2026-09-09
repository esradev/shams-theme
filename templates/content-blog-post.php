<?php
$post_id = get_the_ID();
$date_of_the_lesson = get_post_meta($post_id, 'date-of-the-lesson', true);
$the_audio_of_the_lesson = get_post_meta($post_id, 'the-audio-of-the-lesson', true);
$the_main_text_of_the_lesson = get_post_meta($post_id, 'the-main-text-of-the-lesson', true);
?>

<!-- Wrapped article in a soft modern card -->
<article class="flex flex-col min-w-full bg-white p-6 sm:p-8 rounded-3xl border border-emerald-50 shadow-md shadow-emerald-900/5 hover:shadow-xl hover:shadow-emerald-900/10 hover:border-emerald-100 transition-all duration-300 group/card relative">
  
  <!-- Date and Categories -->
  <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-xs font-medium">
    <time datetime="2020-03-16" class="text-gray-400 bg-slate-50 px-3 py-1 rounded-lg border border-slate-100"><?php echo $date_of_the_lesson; ?></time>
    
    <?php 
    $post_categories = get_the_category(); 
      if (!empty($post_categories)) {
        foreach ($post_categories as $category) { ?>
    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
      class="text-emerald-600 hover:text-emerald-800 hover:bg-emerald-50 px-3 py-1 rounded-lg transition-colors relative z-10">
      <?php echo esc_html($category->name); ?>
    </a> 
    <?php }
      }   
    ?>
  </div>

  <!-- Title & Excerpt -->
  <div class="group relative min-w-full mt-4">
    <h3 class="text-xl font-bold leading-8 text-emerald-900 group-hover/card:text-emerald-700 transition-colors duration-200">
      <a href="<?php the_permalink(); ?>">
        <span class="absolute inset-0"></span>
        <?php the_title(); ?>
      </a>
    </h3>
    
    <?php 
      if (get_the_content() !== '') { ?>
    <p class="mt-4 line-clamp-3 text-base leading-relaxed text-gray-600 prose min-w-full">
      <?php
        if (has_excerpt()) {
          echo get_the_excerpt();
        } else {
          echo wp_trim_words(get_the_content(), 55, '...');
        }
      ?></p>
    <?php } else { ?>
    <p class="mt-4 line-clamp-3 text-base leading-relaxed text-gray-500 italic bg-slate-50 p-4 rounded-xl border border-slate-100 min-w-full">
      متن کامل این جلسه هنوز آماده نشده است، اما صوت جلسه قابل دریافت و استماع می باشد.
    </p>
    <?php } ?>
  </div>

  <!-- Modernized Buttons -->
  <div class="mt-8 flex flex-wrap gap-3 relative z-10">
    <div class="flex-shrink-0">
      <a href="<?php echo $the_audio_of_the_lesson; ?>" download="true"
        class="inline-flex items-center justify-center text-sm font-semibold text-emerald-700 gap-2 border border-emerald-200 bg-emerald-50 rounded-xl px-5 py-2.5 no-underline hover:text-white hover:bg-emerald-600 hover:border-emerald-600 transition-all duration-200 shadow-sm">
        <span>دریافت صوت جلسه</span>
        <?php echo get_svg_icon('folder-arrow-down', 'download-icon', 'h-5 w-5'); ?>
      </a>
    </div>
    
    <div class="flex-shrink-0">
      <a href="<?php the_permalink(); ?>"
        class="inline-flex items-center justify-center text-sm font-semibold text-slate-600 gap-2 border border-slate-200 bg-white rounded-xl px-5 py-2.5 hover:text-emerald-700 hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 shadow-sm">
        <span>مطالعه بیشتر</span>
        <?php echo get_svg_icon('document-text', 'read-more-icon', 'h-5 w-5'); ?>
      </a>
    </div>
  </div>
</article>