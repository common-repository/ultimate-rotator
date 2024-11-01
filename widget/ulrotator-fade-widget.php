<?php
class Ulrotator_Fade_Widget extends WP_Widget{

	function __construct(){
		parent::__construct( 'ulrotator_fade_widget', 'Ultimate Rotator - Fade Content', array( 'description' => __('Make fade content with your rotator items.', 'ultimate_rotator') ) );
	}
	
	
	function widget( $args, $instance ){
	
		extract( $args );
		
		echo $before_widget;		
		
		
		$title = apply_filters( 'widget_title', $instance['ulrotator_fade_title'] );
		if ( preg_match( '/^image:/', $title, $match ) ){
			$url = explode( $match[0], $title );
			$img = '<img src="'. $url[1] .'" alt="" />';
			echo $before_title . htmlspecialchars_decode( apply_filters( 'widget_title', $img ) ) . $after_title;
		}else{
			if ( ! empty( $title ) )
				echo $before_title . $title . $after_title;				
		}
		
		$position = $instance['ulrotator_fade_position'];
		$rand = $instance['ulrotator_fade_rand'];
		$interval = $instance['ulrotator_fade_interval'];
		$duration = $instance['ulrotator_fade_duration'];
		$orientation = $instance['ulrotator_fade_orientation'];
		$nav = $instance['ulrotator_fade_navigation'];
		$items_per_cycle = $instance['ulrotator_fade_item_cycle'];
		$item_width = $instance['ulrotator_fade_item_width'];
		$item_height = $instance['ulrotator_fade_item_height'];
		$slide_width = $instance['ulrotator_fade_width'];
		$slide_height = $instance['ulrotator_fade_height'];
		
		
		//term slug instead of term_id
		$term = get_term( $position, 'ultimate_rotator_position' );
		
		//show the slide
		$slug = isset( $term->slug ) ? $term->slug : "";
		get_ultimate_rotator( $slug, $rand, $orientation, $nav, $items_per_cycle, $item_width, $item_height, $slide_width, $slide_height, 'ulrotator-wrap-fade' );
		echo '<input type="hidden" value="'. $interval .'" class="ulrotator_fade_interval" />';
		echo '<input type="hidden" value="'. $duration .'" class="ulrotator_fade_duration" />';
		echo '<input type="hidden" value="'. $items_per_cycle .'" class="ulrotator_fade_item" />';
		echo '<input type="hidden" value="'. $position .'" class="ulrotator_fade_position" />';
		
		echo $after_widget;
	
	}
	
	
	function update( $new_instance, $old_instance ){
	
		$instance = array();
		$instance['ulrotator_fade_position'] = strip_tags( $new_instance['ulrotator_fade_position'] );
		$instance['ulrotator_fade_rand'] = strip_tags( $new_instance['ulrotator_fade_rand'] );
		$instance['ulrotator_fade_title'] = strip_tags( $new_instance['ulrotator_fade_title'] );
		$instance['ulrotator_fade_orientation'] = strip_tags( $new_instance['ulrotator_fade_orientation'] );
		$instance['ulrotator_fade_interval'] = strip_tags( $new_instance['ulrotator_fade_interval'] );
		$instance['ulrotator_fade_duration'] = strip_tags( $new_instance['ulrotator_fade_duration'] );
		$instance['ulrotator_fade_navigation'] = strip_tags( $new_instance['ulrotator_fade_navigation'] );
		$instance['ulrotator_fade_item_cycle'] = strip_tags( $new_instance['ulrotator_fade_item_cycle'] );
		$instance['ulrotator_fade_item_width'] = strip_tags( $new_instance['ulrotator_fade_item_width'] );
		$instance['ulrotator_fade_item_height'] = strip_tags( $new_instance['ulrotator_fade_item_height'] );
		$instance['ulrotator_fade_width'] = strip_tags( $new_instance['ulrotator_fade_width'] );
		$instance['ulrotator_fade_height'] = strip_tags( $new_instance['ulrotator_fade_height'] );
			
		return $instance;	
	}
	
	
	function form( $instance ){
		$position = ( isset( $instance[ 'ulrotator_fade_position' ] ) ) ? $instance[ 'ulrotator_fade_position' ] : "";
		$rand = ( isset( $instance[ 'ulrotator_fade_rand' ] ) ) ? $instance[ 'ulrotator_fade_rand' ] : '';
		$title = ( isset( $instance[ 'ulrotator_fade_title' ] ) ) ? $instance[ 'ulrotator_fade_title' ] : '';
		$orientation = ( isset( $instance[ 'ulrotator_fade_orientation' ] ) ) ? $instance[ 'ulrotator_fade_orientation' ] : '';		
		$timeout = ( isset( $instance[ 'ulrotator_fade_interval' ] ) ) ? $instance[ 'ulrotator_fade_interval' ] : 10000;
		$speed = ( isset( $instance[ 'ulrotator_fade_duration' ] ) ) ? $instance[ 'ulrotator_fade_duration' ] : 500;
		$nav = ( isset( $instance[ 'ulrotator_fade_navigation' ] ) ) ? $instance[ 'ulrotator_fade_navigation' ] : '';
		$items_per_cycle = ( isset( $instance[ 'ulrotator_fade_item_cycle' ] ) ) ? $instance[ 'ulrotator_fade_item_cycle' ] : 1;
		$item_width = ( isset( $instance[ 'ulrotator_fade_item_width' ] ) ) ? $instance[ 'ulrotator_fade_item_width' ] : '';
		$item_height = ( isset( $instance[ 'ulrotator_fade_item_height' ] ) ) ? $instance[ 'ulrotator_fade_item_height' ] : '';
		$slide_width = ( isset( $instance[ 'ulrotator_fade_width' ] ) ) ? $instance[ 'ulrotator_fade_width' ] : '';
		$slide_height = ( isset( $instance[ 'ulrotator_fade_height' ] ) ) ? $instance[ 'ulrotator_fade_height' ] : '';

	?>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_fade_title' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_fade_title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_position' ); ?>"><?php _e( 'Position:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'ulrotator_fade_position' ); ?>" id="<?php echo $this->get_field_id( 'ulrotator_fade_position' ); ?>">
			<option value=""></option>
			<?php echo ulrotator_list_terms( 'ultimate_rotator_position', 'option', 0, $position ); ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_rand' ); ?>"><?php _e( 'Random:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'ulrotator_fade_rand' ); ?>" id="<?php echo $this->get_field_id( 'ulrotator_fade_rand' ); ?>">
				<option value="">No</option>
				<option value="rand" <?php if( $rand == "rand" ){ echo 'selected="selected"'; } ?> >Yes</option>			
			</select>
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_orientation' ); ?>"><?php _e( 'Orientation:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'ulrotator_fade_orientation' ); ?>" id="<?php echo $this->get_field_id( 'ulrotator_fade_orientation' ); ?>">
				<option value="vertical">Vertical</option>
				<option value="horizontal" <?php if( $orientation == "horizontal" ){ echo 'selected="selected"'; } ?> >Horizontal</option>			
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_item_cycle' ); ?>"><?php _e( 'Items per cycle:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_fade_item_cycle' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_fade_item_cycle' ); ?>" type="text" value="<?php echo esc_attr( $items_per_cycle ); ?>" />			
		</p>	

		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_interval' ); ?>"><?php _e( 'Timeout:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_fade_interval' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_fade_interval' ); ?>" type="text" value="<?php echo esc_attr( $timeout ); ?>" />			
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_duration' ); ?>"><?php _e( 'Speed:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_fade_duration' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_fade_duration' ); ?>" type="text" value="<?php echo esc_attr( $speed ); ?>" />			
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_navigation' ); ?>"><?php _e( 'Navigation:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'ulrotator_fade_navigation' ); ?>" id="<?php echo $this->get_field_id( 'ulrotator_fade_navigation' ); ?>">
				<option value=""></option>
				<option value="np" <?php if( $nav == "np" ){ echo 'selected="selected"'; } ?> >Next/Previous</option>
				<option value="num" <?php if( $nav == "num" ){ echo 'selected="selected"'; } ?> >Number</option>			
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_item_width' ); ?>"><?php _e( 'Item width:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_fade_item_width' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_fade_item_width' ); ?>" type="text" value="<?php echo esc_attr( $item_width ); ?>" />			
		</p>	
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_item_height' ); ?>"><?php _e( 'Item height:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_fade_item_height' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_fade_item_height' ); ?>" type="text" value="<?php echo esc_attr( $item_height ); ?>" />			
		</p>	

		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_width' ); ?>"><?php _e( 'Slide width:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_slide_width' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_fade_width' ); ?>" type="text" value="<?php echo esc_attr( $slide_width ); ?>" />			
		</p>	
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_fade_height' ); ?>"><?php _e( 'Slide height:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_fade_height' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_fade_height' ); ?>" type="text" value="<?php echo esc_attr( $slide_height ); ?>" />			
		</p>
	
			
		<?php	
	}


}

/** end */