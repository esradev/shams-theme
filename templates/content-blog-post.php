<?php
$post_id = get_the_ID();
$date_of_the_lesson = get_post_meta($post_id, 'date-of-the-lesson', true);
$the_audio_of_the_lesson = get_post_meta($post_id, 'the-audio-of-the-lesson', true);

// Get the view mode passed from the parent template (defaults to 'list')
$view_mode = get_query_var('current_view_mode', 'list');
?>

<!-- Simplified, minimalistic card. h-full ensures they all match height in grid mode -->
<article class="flex flex-col h-full bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-100 transition-all duration-300 group relative">
  
  <!-- Top Row: Date & Audio Indicator -->
  <div class="flex items-center justify-between mb-3">
    <?php if ($date_of_the_lesson) : ?>
      <time class="text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1.5 rounded-lg">
        <?php echo $date_of_the_lesson; ?>
      </time>
    <?php endif; ?>
    
    <!-- Subtle icon showing it's a media post -->
    <span class="text-gray-200 group-hover:text-emerald-300 transition-colors">
      <?php echo get_svg_icon('play-circle', '', 'h-6 w-6'); ?>
    </span>
  </div>

  <!-- Title & Excerpt -->
  <div class="mb-4 flex-grow">
    <h3 class="text-lg font-bold leading-relaxed text-gray-800 group-hover:text-emerald-700 transition-colors duration-200">
      <a href="<?php the_permalink(); ?>">
        <span class="absolute inset-0"></span> <!-- Makes the whole card clickable -->
        <?php the_title(); ?>
      </a>
    </h3>
    
    <!-- Only show excerpt if the user is in 'list' view mode! -->
    <?php if ($view_mode !== 'grid') { ?>
      <?php if (get_the_content() !== '') { ?>
        <p class="mt-3 line-clamp-2 text-sm leading-relaxed text-gray-500">
          <?php echo has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 40, '...'); ?>
        </p>
      <?php } else { ?>
        <p class="mt-3 line-clamp-2 text-sm leading-relaxed text-gray-400 italic">
          متن کامل این جلسه هنوز آماده نشده است، اما صوت جلسه قابل دریافت می‌باشد.
        </p>
      <?php } ?>
    <?php } ?>
  </div>

  <!-- Minimalistic Bottom Action Row -->
  <div class="mt-auto flex items-center justify-between pt-4 border-t border-gray-50 relative z-10">
    
    <!-- Elegant text link instead of a bulky button -->
    <span class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-emerald-600 transition-colors gap-1.5">
      <?php echo get_svg_icon('document-text', '', 'h-5 w-5'); ?>
      <span>ورود به جلسه</span>
    </span>

    <!-- Sleek download icon button -->
    <?php if ($the_audio_of_the_lesson) : ?>
      <a href="<?php echo $the_audio_of_the_lesson; ?>" download="true" title="دریافت صوت"
        class="p-2 -mr-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-colors">
        <?php echo get_svg_icon('folder-arrow-down', '', 'h-5 w-5'); ?>
      </a>
    <?php endif; ?>

  </div>
</article>