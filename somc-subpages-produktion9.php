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
?>