<?php

require_once get_template_directory() . '/inc/helpers.php';

require get_template_directory() . '/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
		'http://wpstorm.ir/update-server/?action=get_metadata&slug=shams-theme',
		__FILE__, //Full path to the main plugin file or functions.php.
		'shams-theme'
);

function boilerplate_load_assets()
{
  $posts = get_posts(array(
    'post_type' => 'post',
    'posts_per_page' => -1,
  ));
  wp_enqueue_script('shamsmainjs', get_theme_file_uri('/src/index.js'), array('wp-element'), '1.1', true);
  wp_enqueue_style('shamsmaincss', get_theme_file_uri('/build/index.css'));

  wp_localize_script('shamsmainjs', 'ourData', array(
    'root_url' => get_site_url(),
    'posts' => json_encode($posts),
  ));
}

add_action('wp_enqueue_scripts', 'boilerplate_load_assets');

function boilerplate_add_support()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('menus');
}

add_action('after_setup_theme', 'boilerplate_add_support');

function register_custom_meta_fields() {
  register_post_meta('post', 'date-of-the-lesson', array(
    'show_in_rest' => true,
    'single' => true,
    'type' => 'string',
  ));

  register_post_meta('post', 'the-audio-of-the-lesson', array(
    'show_in_rest' => true,
    'single' => true,
    'type' => 'string',
  ));

  register_post_meta('post', 'main-text-of-the-lesson', array(
    'show_in_rest' => true,
    'single' => true,
    'type' => 'string',
  ));
}

add_action('init', 'register_custom_meta_fields');

function add_custom_meta_boxes() {
  add_meta_box(
    'lesson_meta_box', // ID
    'Lesson Details', // Title
    'render_lesson_meta_box', // Callback
    'post', // Post type
    'normal', // Context
    'high' // Priority
  );
}

add_action('add_meta_boxes', 'add_custom_meta_boxes');

function render_lesson_meta_box($post) {
  // Retrieve current values
  $date_of_the_lesson = get_post_meta($post->ID, 'date-of-the-lesson', true);
  $audio_of_the_lesson = get_post_meta($post->ID, 'the-audio-of-the-lesson', true);
  $main_text_of_the_lesson = get_post_meta($post->ID, 'main-text-of-the-lesson', true);

  // Nonce field for security
  wp_nonce_field('save_lesson_meta_box_data', 'lesson_meta_box_nonce');

  // Display fields with styling
  echo '<div class="lesson-meta-box">';

  echo '<div class="form-group">';
  echo '<label for="date-of-the-lesson">تاریخ برگزاری جلسه درس</label>';
  echo '<input type="text" id="date-of-the-lesson" name="date-of-the-lesson" value="' . esc_attr($date_of_the_lesson) . '" class="widefat" />';
  echo '<p class="description">تاریخ برگزاری جلسه مثال: 1402/07/04</p>';
  echo '</div>';

  echo '<div class="form-group">';
  echo '<label for="the-audio-of-the-lesson">صوت جلسه درس</label>';
  echo '<input type="text" id="the-audio-of-the-lesson" name="the-audio-of-the-lesson" value="' . esc_attr($audio_of_the_lesson) . '" class="widefat" />';
  echo '<p class="description">لینک صوت جلسه درس به صورت کامل به عنوان مثال: https://dl.shams.com/osule/1402/1.mp3</p>';
  echo '</div>';

  echo '<div class="form-group">';
  echo '<label for="main-text-of-the-lesson">متن مرجع جلسه درس</label>';
  echo '<textarea id="main-text-of-the-lesson" name="main-text-of-the-lesson" rows="5" class="widefat">' . esc_textarea($main_text_of_the_lesson) . '</textarea>';
  echo '<p class="description">بخشی از متن کتاب مرجع که در جلسه درس، بیانات استاد حول محور آن است.</p>';
  echo '</div>';

  echo '</div>';
}

function save_lesson_meta_box_data($post_id) {
  // Check nonce for security
  if (!isset($_POST['lesson_meta_box_nonce']) || !wp_verify_nonce($_POST['lesson_meta_box_nonce'], 'save_lesson_meta_box_data')) {
    return;
  }

  // Check if not an autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Check user permissions
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Save date-of-the-lesson
  if (isset($_POST['date-of-the-lesson'])) {
    update_post_meta($post_id, 'date-of-the-lesson', sanitize_text_field($_POST['date-of-the-lesson']));
  }

  // Save the-audio-of-the-lesson
  if (isset($_POST['the-audio-of-the-lesson'])) {
    update_post_meta($post_id, 'the-audio-of-the-lesson', sanitize_text_field($_POST['the-audio-of-the-lesson']));
  }

  // Save main-text-of-the-lesson
  if (isset($_POST['main-text-of-the-lesson'])) {
    update_post_meta($post_id, 'main-text-of-the-lesson', sanitize_textarea_field($_POST['main-text-of-the-lesson']));
  }
}

add_action('save_post', 'save_lesson_meta_box_data');