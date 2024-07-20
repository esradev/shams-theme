<?php

require_once get_template_directory() . '/inc/helpers.php';

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