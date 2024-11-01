<?php

add_shortcode('URSLIDE', 'ulrotator_slide_tag_func');
function ulrotator_slide_tag_func( $atts ) {
	extract(shortcode_atts(array(
		'position' 			=> '',
		'random' 			=> 'no',
		'orientation' 		=> 'vertical',
		'items' 			=> 1,
		'items_per_cycle' 	=> 1,
		'interval' 			=> '',
		'duration' 			=> 400,
		'navigation' 		=> '',
		'cycle' 			=> '',
		'item_width' 		=> '',
		'item_height' 		=> '',
		'slide_width' 		=> '',
		'slide_height' 		=> ''
	), $atts));
 
	$output = "";
	$output .= '<div class="ulrotator-container ulrotator-container-slide">';
	$output .= get_ultimate_rotator( $position, $random, $orientation, $navigation, $items, $item_width, $item_height, $slide_width, $slide_height, 'ulrotator-wrap-slide', false );
	$output .= '<input type="hidden" value="'. $interval .'" class="ulrotator_slide_interval" />';
	$output .= '<input type="hidden" value="'. $duration .'" class="ulrotator_slide_duration" />';
	$output .= '<input type="hidden" value="'. $cycle .'" class="ulrotator_slide_cycle" />';
	$output .= '<input type="hidden" value="'. $items_per_cycle .'" class="ulrotator_slide_item" />';
	$output .= '</div>'; 
	
	return $output;
}



/* End of ulrotator-shortcode.php */