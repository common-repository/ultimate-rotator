<?php

add_shortcode('URCYCLE', 'ulrotator_cycle_tag_func');
function ulrotator_cycle_tag_func( $atts ) {
	extract(shortcode_atts(array(
		'items' => '',
		'position' => '',
		'random' => 'no',
		'name' => '',
		'key' => '',
		'show_all' => '',
		'item_width' => '',
		'item_height' => '',
		'rotator_width' => '',
		'rotator_height' => ''
	), $atts));
	
	$output = get_cycle_loop( $items, $position, $name, $key, $random, $show_all, $item_width, $item_height, $rotator_width, $rotator_height, false );
	return $output;
}



/** end */