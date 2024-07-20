<?php
function get_svg_icon($name, $id, $class = '') {
  $path = get_template_directory() . '/assets/icons/' . $name . '.svg';

  if (file_exists($path)) {
      $version = filemtime($path);
      $icon_content = file_get_contents($path);
      $icon_content .= '<!-- SVG Icon version: ' . $version . ' -->';

      // Add ID to the SVG tag
      $icon_content = preg_replace('/<svg /', '<svg id="' . esc_attr($id) . '" ', $icon_content, 1);

      // Add class to the SVG tag
      $icon_content = preg_replace('/<svg /', '<svg class="' . esc_attr($class) . '" ', $icon_content, 1);
      return $icon_content;
  } else {
      return '<!-- SVG Icon not found: ' . esc_html($name) . ' -->';
  }
}