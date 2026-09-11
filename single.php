<?php get_header(); ?>

<!-- pb-28 on mobile, pb-32 on desktop so the sticky player doesn't hide text -->
<div class="max-w-4xl mx-auto px-2 overflow-x-hidden sm:px-4 lg:px-8 pb-28 sm:pb-32">

  <?php if (have_posts()) {
    while (have_posts()) {
      the_post(); 
      
      // Fetch adjacent posts safely for the bottom cards
      $prev_post = get_adjacent_post(true, '', true);  // Chronologically older (Previous Lesson)
      $next_post = get_adjacent_post(true, '', false); // Chronologically newer (Next Lesson)
  ?>

  <div class="py-12 px-2 sm:px-4 lg:px-8">
    <div class="mx-auto max-w-4xl text-base leading-7 text-gray-700">
      
      <!-- Modernized Category Badges -->
      <div class="flex flex-wrap gap-2 mb-6">
        <?php
        $post_categories = get_the_category();
        if (!empty($post_categories)) {
          foreach ($post_categories as $category) { ?>
        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
          class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-emerald-50 text-emerald-700 hover:bg-emerald-100 hover:text-emerald-800 transition-colors border border-emerald-100/50">
          <?php echo esc_html($category->name); ?>
        </a>
        <?php }
        }
        ?>
      </div>

      <!-- Title & Excerpt -->
      <h1 class="text-3xl font-extrabold tracking-tight text-emerald-900 my-6 sm:text-4xl leading-snug"><?php the_title(); ?></h1>
      
      <!-- Highlighted Summary Box -->
      <div class="mt-6 text-lg leading-relaxed text-gray-600 bg-slate-50/80 border border-slate-100 rounded-2xl p-6 sm:p-8 shadow-inner relative">
          <div class="absolute right-0 top-0 w-1.5 h-full bg-emerald-400 rounded-r-2xl"></div>
          <?php
		      if (has_excerpt()) {
				      echo get_the_excerpt();
		      } else {
				      echo wp_trim_words(get_the_content(), 55, '...');
		      }
          ?>
      </div>

      <!-- audio download link & tag data -->
      <?php
          $post_id = get_the_ID();
          $the_audio_of_the_lesson = get_post_meta($post_id, 'the-audio-of-the-lesson', true);
      ?>

      <!-- Modernized Content Area -->
      <div class="mt-12 max-w-full prose prose-emerald prose-lg text-gray-700 leading-loose">
        <?php the_content(); ?>
      </div>

      <!-- NEW UX: Next and Previous Lesson Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-20 border-t border-gray-100 pt-10">
        <!-- Previous Lesson (Older) -->
        <?php if (!empty($prev_post)): ?>
          <a href="<?php echo get_permalink($prev_post->ID); ?>" class="flex flex-col p-5 bg-white border border-gray-100 rounded-2xl hover:border-emerald-200 hover:bg-emerald-50/50 hover:shadow-md transition-all group">
            <span class="text-xs font-bold text-gray-400 mb-2 flex items-center gap-1.5 group-hover:text-emerald-600 transition-colors">
              <?php echo get_svg_icon('arrow-right', '', 'w-4 h-4'); ?> 
              جلسه قبلی
            </span>
            <span class="font-bold text-emerald-900 leading-relaxed text-sm sm:text-base line-clamp-2"><?php echo get_the_title($prev_post->ID); ?></span>
          </a>
        <?php else: ?>
          <div class="hidden sm:block"></div>
        <?php endif; ?>

        <!-- Next Lesson (Newer) -->
        <?php if (!empty($next_post)): ?>
          <a href="<?php echo get_permalink($next_post->ID); ?>" class="flex flex-col text-left items-end p-5 bg-white border border-gray-100 rounded-2xl hover:border-emerald-200 hover:bg-emerald-50/50 hover:shadow-md transition-all group">
            <span class="text-xs font-bold text-gray-400 mb-2 flex items-center gap-1.5 group-hover:text-emerald-600 transition-colors">
              جلسه بعدی 
              <?php echo get_svg_icon('arrow-left', '', 'w-4 h-4'); ?>
            </span>
            <span class="font-bold text-emerald-900 leading-relaxed text-sm sm:text-base line-clamp-2" dir="rtl"><?php echo get_the_title($next_post->ID); ?></span>
          </a>
        <?php else: ?>
          <div class="hidden sm:block"></div>
        <?php endif; ?>
      </div>

      <!-- COMPACT STICKY Audio Player -->
      <div id="audio-player" class="fixed bottom-0 sm:bottom-6 left-0 right-0 z-[60] mx-auto max-w-4xl w-full sm:px-4 transition-transform duration-300">
        
        <div class="bg-emerald-950/95 backdrop-blur-xl text-emerald-50 sm:rounded-2xl shadow-2xl shadow-emerald-900/40 border-t sm:border border-emerald-800/60 relative overflow-hidden flex flex-col">
          
          <!-- Thin Progress Bar -->
          <div id="audio-progress-container" class="h-1 sm:h-1.5 bg-emerald-900/50 cursor-pointer relative group">
            <div id="audio-progress" class="h-full bg-gradient-to-r from-emerald-500 to-emerald-400 relative z-10 transition-all duration-75" style="width: 0;">
              <!-- Hover glow dot -->
              <div class="absolute left-0 top-1/2 -translate-y-1/2 w-3 h-3 bg-white rounded-full opacity-0 group-hover:opacity-100 shadow-[0_0_10px_rgba(255,255,255,0.8)] transition-opacity"></div>
            </div>
            <div id="audio-loading" class="h-full w-full absolute top-0 left-0 bg-emerald-800/30 hidden animate-pulse"></div>
          </div>

          <!-- Changed to flex-row ALWAYS so it never stacks on mobile -->
          <div class="p-2 sm:p-4 flex flex-row items-center justify-between gap-2 relative z-10">
            
            <!-- Track Info & Cover (min-w-0 forces truncation to work on mobile) -->
            <div id="audio-info" class="flex items-center flex-1 min-w-0">
              <img id="audio-cover" src="<?php echo get_template_directory_uri() . '/assets/images/photo-150.jpg' ?>"
                alt="Cover" class="w-10 h-10 sm:w-14 sm:h-14 shrink-0 object-cover rounded-full border border-emerald-700/50 shadow-md">
              
              <div class="ml-2 sm:ml-4 flex-1 min-w-0">
                <h2 id="audio-title" class="text-sm sm:text-base font-bold text-white truncate"><?php the_title(); ?></h2>
                
                <div class="flex items-center gap-2 mt-0.5">
                  <p id="audio-artist" class="hidden sm:block text-emerald-400/80 text-[11px] sm:text-xs font-medium">آیت الله حسینی آملی</p>
                  <span class="hidden sm:inline text-emerald-700 text-[10px]">•</span>
                  <!-- Time Display -->
                  <div class="flex items-center text-[10px] sm:text-xs font-medium text-emerald-300/70 tracking-widest font-mono">
                    <span id="audio-current-time">00:00</span>
                    <span class="mx-1">/</span>
                    <span id="audio-duration">00:00</span>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Audio Controls (Shrink-0 prevents buttons from getting squished) -->
            <div id="audio-controls" class="flex items-center shrink-0 gap-1 sm:gap-4">

              <!-- Skip Prev/Next (Desktop Only) -->
              <div class="hidden sm:flex items-center gap-1">
                <?php if (!empty($next_post)): ?>
                <a href="<?php echo get_permalink($next_post->ID); ?>" class="p-1.5 text-emerald-100/50 hover:text-white hover:bg-emerald-800/50 rounded-full transition-colors" title="جلسه بعدی">
                  <?php echo get_svg_icon('backward', '', 'h-5 w-5'); ?>
                </a>
                <?php endif; ?>
                
                <?php if (!empty($prev_post)): ?>
                <a href="<?php echo get_permalink($prev_post->ID); ?>" class="p-1.5 text-emerald-100/50 hover:text-white hover:bg-emerald-800/50 rounded-full transition-colors" title="جلسه قبلی">
                  <?php echo get_svg_icon('forward', '', 'h-5 w-5'); ?>
                </a>
                <?php endif; ?>
              </div>

              <!-- Main Playback Controls -->
              <div class="flex items-center justify-center gap-0.5 sm:gap-2">
                <button id="fast-rewind" class="p-1.5 sm:p-2 text-emerald-100/80 hover:text-white hover:bg-emerald-800/50 rounded-full transition-colors">
                  <?php echo get_svg_icon('arrow-uturn-right', '', 'h-5 w-5 sm:h-6 sm:w-6'); ?>
                </button>
                
                <!-- Slightly smaller play button on mobile so it fits the single row perfectly -->
                <button id="play-button" class="p-1 text-emerald-400 hover:text-emerald-300 hover:scale-105 transition-all drop-shadow-md">
                  <?php echo get_svg_icon('play-circle', '', 'h-9 w-9 sm:h-12 sm:w-12'); ?>
                </button>
                <button id="pause-button" class="hidden p-1 text-emerald-400 hover:text-emerald-300 hover:scale-105 transition-all drop-shadow-md">
                  <?php echo get_svg_icon('pause-circle', '', 'h-9 w-9 sm:h-12 sm:w-12'); ?>
                </button>
                
                <button id="fast-forward" class="p-1.5 sm:p-2 text-emerald-100/80 hover:text-white hover:bg-emerald-800/50 rounded-full transition-colors">
                  <?php echo get_svg_icon('arrow-uturn-left', '', 'h-5 w-5 sm:h-6 sm:w-6'); ?>
                </button>
              </div>

              <!-- Extra Features (Hidden on Mobile to save space) -->
              <div class="hidden sm:flex items-center gap-2">
                <select id="play-speed" class="bg-emerald-900/50 text-emerald-100 border border-emerald-700/50 rounded-lg px-2 py-1 outline-none text-xs focus:border-emerald-500 transition-colors cursor-pointer appearance-none text-center">
                  <option value="0.5">0.5x</option>
                  <option value="1" selected>1x</option>
                  <option value="1.5">1.5x</option>
                  <option value="2">2x</option>
                </select>
                
                <?php if ($the_audio_of_the_lesson): ?>
                <a href="<?php echo $the_audio_of_the_lesson; ?>" download="lesson-audio.mp3" class="p-2 text-emerald-100/80 hover:text-white hover:bg-emerald-800/50 rounded-full transition-colors" title="دریافت صوت">
                  <?php echo get_svg_icon('folder-arrow-down', '', 'h-6 w-6'); ?>
                </a>
                <?php endif; ?>
              </div>

            </div>
          </div>
        </div>
      </div>
      
      <audio id="audio" src="" hidden></audio>

    </div>
  </div>

  <?php }
} ?>
</div>

<?php get_footer(); ?>