<?php
/*
Plugin Name: Ultimate Rotator
Plugin URI: http://gidd.org/wordpress-plugins/ultimate-rotator-free-image-banner-rotating-plugin/
Description: A simple & easy way to add rotator into your sidebar, post, page or anywhere else in your theme.
Version: 1.0.0
Author: Vichet Sen
Author URI: http://gidd.org
License: GPL2
*/

define('ULTIMATE_ROTATOR_PATH', plugin_dir_path( __FILE__ ));
define('ULTIMATE_ROTATOR_URL', plugin_dir_url( __FILE__ ));

// HELPER
include_once( ULTIMATE_ROTATOR_PATH . 'lib/helper.php' );

// SET UP THE BACKEND
include_once( ULTIMATE_ROTATOR_PATH . 'lib/cpt-ulrotator.php' );

// SET UP THE META
include_once( ULTIMATE_ROTATOR_PATH . 'lib/meta-ulrotator.php' );

// INCLUDE CYCLE LOOP
include_once( ULTIMATE_ROTATOR_PATH . 'lib/ulrotator-cycle-loop.php' );

// INCLUDE SHORTCODE
include_once( ULTIMATE_ROTATOR_PATH . 'shortcode/ulrotator-slide-shortcode.php' );
include_once( ULTIMATE_ROTATOR_PATH . 'shortcode/ulrotator-cycle-shortcode.php' );
include_once( ULTIMATE_ROTATOR_PATH . 'shortcode/ulrotator-fade-shortcode.php' );

// INCLUDE WIDGETS
include_once( ULTIMATE_ROTATOR_PATH . 'widget/ulrotator-cycle-widget.php' );
add_action( 'widgets_init', create_function( '', 'register_widget( "ulrotator_cycle_widget" );' ) );

include_once( ULTIMATE_ROTATOR_PATH . 'widget/ulrotator-slide-widget.php' );
add_action( 'widgets_init', create_function( '', 'register_widget( "ulrotator_slide_widget" );' ) );

include_once( ULTIMATE_ROTATOR_PATH . 'widget/ulrotator-fade-widget.php' );
add_action( 'widgets_init', create_function( '', 'register_widget( "ulrotator_fade_widget" );' ) );



/** end of ultimate-rotator.php */