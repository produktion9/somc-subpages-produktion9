<?php
/*
Plugin Name: somc-subpages-produktion9
Plugin URI: https://github.com/produktion9/somc-subpages-produktion9
Description: Produktion9 List Subpages
Version: 1.0
Author: Martin Hansson
Author URI: http://produktion9.se
License: GPL
*/

include_once( 'src/widget.php' );
add_action( 'widgets_init', 'somc_subpages_produktion9_load_widget' );

include_once( 'src/create_shortcode.php' );
add_shortcode('somc_subpages_produktion9','somc_subpages_produktion9_shortcode');

function somc_subpages_produktion9_scripts() {
	wp_enqueue_style( 'p9-style', plugins_url('src/css/style.css', __FILE__) );
	wp_enqueue_script( 'p9-script', plugins_url('src/js/script.js', __FILE__) );
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'somc_subpages_produktion9_scripts' );

?>