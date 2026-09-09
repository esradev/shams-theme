<?php get_header(); ?>

<div class="max-w-4xl mx-auto px-2 overflow-x-hidden sm:px-4 lg:px-8">

  <?php if (have_posts()) {
    while (have_posts()) {
      the_post(); ?>

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
      <div class="mt-6 text-lg leading-relaxed text-gray-600 bg-slate-50/50 border border-slate-100 rounded-2xl p-6 shadow-inner">
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

      <!-- Modernized Audio Player (Kept all IDs intact for your JS) -->
      <div id="audio-player" class="bg-gradient-to-r from-emerald-900 to-emerald-950 text-emerald-50 p-6 my-10 rounded-3xl shadow-2xl shadow-emerald-900/20 border border-emerald-800 relative overflow-hidden">
        
        <!-- Decorative blurred glow inside player -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-emerald-500 rounded-full opacity-20 blur-3xl pointer-events-none"></div>

        <div class="flex flex-col md:flex-row items-center justify-between relative z-10">
          <div id="audio-info" class="flex items-center w-full md:w-auto mb-6 md:mb-0">
            <img id="audio-cover" src="<?php echo get_template_directory_uri() . '/assets/images/photo-150.jpg' ?>"
              alt="Cover" class="w-20 h-20 object-cover ml-4 rounded-full border-2 border-emerald-700/50 shadow-md">
            <div class="ml-4">
              <h2 id="audio-title" class="text-lg font-bold text-white mb-1"><?php the_title(); ?></h2>
              <p id="audio-artist" class="text-emerald-300 text-sm font-medium">آیت الله حسینی آملی (حفظه الله)</p>
            </div>
          </div>
          
          <div id="audio-controls" class="flex flex-col items-center justify-center md:justify-end w-full md:w-auto gap-4">
            
            <div class="flex items-center justify-center md:justify-end gap-2">
              <button id="audio-prev" class="p-2 hover:bg-emerald-800 rounded-full transition-colors">
                <a href="<?php echo get_permalink(get_adjacent_post(true, '', true)); ?>" class="text-emerald-100 hover:text-white transition-colors">
                  <?php echo get_svg_icon('forward', '', 'h-7 w-7'); ?>
                </a>
              </button>

              <button id="play-button" class="p-1 text-emerald-400 hover:text-emerald-300 hover:scale-105 transition-all">
                <?php echo get_svg_icon('play-circle', '', 'h-12 w-12'); ?>
              </button>
              <button id="pause-button" class="hidden p-1 text-emerald-400 hover:text-emerald-300 hover:scale-105 transition-all">
                <?php echo get_svg_icon('pause-circle', '', 'h-12 w-12'); ?>
              </button>
              
              <button id="audio-next" class="p-2 hover:bg-emerald-800 rounded-full transition-colors">
                <a href="<?php echo get_permalink(get_adjacent_post(true, '', false)); ?>" class="text-emerald-100 hover:text-white transition-colors">
                  <?php echo get_svg_icon('backward', '', 'h-7 w-7'); ?>
                </a>
              </button>
            </div>

            <div class="flex items-center justify-center md:justify-end gap-3">
              <button id="fast-rewind" class="p-2 hover:bg-emerald-800 rounded-full text-emerald-100 hover:text-white transition-colors">
                <?php echo get_svg_icon('arrow-uturn-right', '', 'h-6 w-6'); ?>
              </button>
              <button id="fast-forward" class="p-2 hover:bg-emerald-800 rounded-full text-emerald-100 hover:text-white transition-colors">
                <?php echo get_svg_icon('arrow-uturn-left', '', 'h-6 w-6'); ?>
              </button>

              <select id="play-speed" class="bg-emerald-950 text-emerald-100 border border-emerald-700/50 rounded-lg px-3 py-1.5 outline-none text-sm focus:border-emerald-500 transition-colors cursor-pointer appearance-none text-center">
                <option value="0.5">0.5x</option>
                <option value="1" selected>1x</option>
                <option value="1.5">1.5x</option>
                <option value="2">2x</option>
              </select>
              
              <a href="<?php echo $the_audio_of_the_lesson; ?>" download="lesson-audio.mp3" class="p-2 hover:bg-emerald-800 rounded-full text-emerald-100 hover:text-white transition-colors">
                <?php echo get_svg_icon('folder-arrow-down', '', 'h-6 w-6'); ?>
              </a>
            </div>
          </div>
        </div>
        
        <div class="flex justify-between text-xs font-medium text-emerald-300 mt-6 mb-2 tracking-wider">
          <span id="audio-current-time">00:00</span>
          <span id="audio-duration">00:00</span>
        </div>
        <div id="audio-progress-container" class="h-2.5 bg-emerald-950 border border-emerald-800/50 rounded-full cursor-pointer relative overflow-hidden">
          <div id="audio-progress" class="h-full bg-gradient-to-r from-emerald-500 to-emerald-400 rounded-full relative z-10" style="width: 0;">
            <div class="absolute left-0 top-0 w-2 h-full bg-white opacity-50 rounded-full blur-[1px]"></div>
          </div>
          <div id="audio-loading" class="h-full w-full absolute top-0 left-0 bg-emerald-800/30 rounded-full hidden animate-pulse"></div>
        </div>
      </div>
      
      <audio id="audio" src="" hidden></audio>
    </div>
    
    <!-- Modernized Content Area -->
    <div class="mt-12 max-w-full prose prose-emerald prose-lg text-gray-700 leading-loose pb-16">
      <?php the_content(); ?>
    </div>
  </div>
</div>

  <?php }
} ?>
</div>

<?php get_footer(); ?>