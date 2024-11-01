<?php
add_shortcode('URFADE', 'ulrotator_fade_tag_func');
function ulrotator_fade_tag_func( $atts ) {
	extract(shortcode_atts(array(
		'position' => '',
		'random' => 'no',
		'orientation' => 'vertical',
		'items' => '1',
		'timeout' => '10000',
		'speed' => '500',
		'navigation' => '',
		'item_width' => '',
		'item_height' => '',
		'slide_width' => '',
		'slide_height' => ''
	), $atts));
	
	$output  = "";
	$output .= '<div class="ulrotator-container ulrotator-container-fade">';
	$output .= get_ultimate_rotator( $position, $random, $orientation, $navigation, $items, $item_width, $item_height, $slide_width, $slide_height, 'ulrotator-wrap-fade', false );
	$output .= '<input type="hidden" value="'. $timeout .'" class="ulrotator_fade_interval" />';
	$output .= '<input type="hidden" value="'. $speed .'" class="ulrotator_fade_duration" />';
	$output .= '<input type="hidden" value="'. $position .'" class="ulrotator_fade_position" />';
	$output .= '</div>';
	 
	return $output;
}



/** end */