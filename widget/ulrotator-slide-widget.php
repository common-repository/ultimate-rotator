<?php
class Ulrotator_Slide_Widget extends WP_Widget{

	function __construct(){
		parent::__construct( 'ulrotator_slide_widget', 'Ultimate Rotator - Slide Content', array( 'description' => __('Make slide content with your rotator items.', 'ultimate_rotator') ) );
	}
	
	
	function widget( $args, $instance ){
	
		extract( $args );
		
		echo $before_widget;		
		
		
		$title = apply_filters( 'widget_title', $instance['ulrotator_slide_title'] );
		if ( preg_match( '/^image:/', $title, $match ) ){
			$url = explode( $match[0], $title );
			$img = '<img src="'. $url[1] .'" alt="" />';
			echo $before_title . htmlspecialchars_decode( apply_filters( 'widget_title', $img ) ) . $after_title;
		}else{
			if ( ! empty( $title ) )
				echo $before_title . $title . $after_title;				
		}
		
		$position = $instance['ulrotator_slide_position'];
		$rand = $instance['ulrotator_slide_rand'];
		$interval = $instance['ulrotator_slide_interval'];
		$duration = $instance['ulrotator_slide_duration'];
		$orientation = $instance['ulrotator_slide_orientation'];
		$nav = $instance['ulrotator_slide_navigation'];
		$cycle = $instance['ulrotator_slide_cycle'];
		$items_per_cycle = $instance['ulrotator_slide_item_cycle'];
		$item_width = $instance['ulrotator_slide_item_width'];
		$item_height = $instance['ulrotator_slide_item_height'];
		$slide_width = $instance['ulrotator_slide_width'];
		$slide_height = $instance['ulrotator_slide_height'];
		
		
		//term slug instead of term_id
		$term = get_term( $position, 'ultimate_rotator_position' );
		
		//show the slide
		get_ultimate_rotator( $term->slug, $rand, $orientation, $nav, $items_per_cycle, $item_width, $item_height, $slide_width, $slide_height );
		echo '<input type="hidden" value="'. $interval .'" class="ulrotator_slide_interval" />';
		echo '<input type="hidden" value="'. $duration .'" class="ulrotator_slide_duration" />';
		echo '<input type="hidden" value="'. $cycle .'" class="ulrotator_slide_cycle" />';
		echo '<input type="hidden" value="'. $items_per_cycle .'" class="ulrotator_slide_item" />';
		
		echo $after_widget;
	
	}
	
	
	function update( $new_instance, $old_instance ){
	
		$instance = array();
		$instance['ulrotator_slide_position'] = strip_tags( $new_instance['ulrotator_slide_position'] );
		$instance['ulrotator_slide_rand'] = strip_tags( $new_instance['ulrotator_slide_rand'] );
		$instance['ulrotator_slide_title'] = strip_tags( $new_instance['ulrotator_slide_title'] );
		$instance['ulrotator_slide_orientation'] = strip_tags( $new_instance['ulrotator_slide_orientation'] );
		$instance['ulrotator_slide_interval'] = strip_tags( $new_instance['ulrotator_slide_interval'] );
		$instance['ulrotator_slide_duration'] = strip_tags( $new_instance['ulrotator_slide_duration'] );
		$instance['ulrotator_slide_navigation'] = strip_tags( $new_instance['ulrotator_slide_navigation'] );
		$instance['ulrotator_slide_cycle'] = strip_tags( $new_instance['ulrotator_slide_cycle'] );
		$instance['ulrotator_slide_item_cycle'] = strip_tags( $new_instance['ulrotator_slide_item_cycle'] );
		$instance['ulrotator_slide_item_width'] = strip_tags( $new_instance['ulrotator_slide_item_width'] );
		$instance['ulrotator_slide_item_height'] = strip_tags( $new_instance['ulrotator_slide_item_height'] );
		$instance['ulrotator_slide_width'] = strip_tags( $new_instance['ulrotator_slide_width'] );
		$instance['ulrotator_slide_height'] = strip_tags( $new_instance['ulrotator_slide_height'] );
			
		return $instance;
	
	}
	
	
	function form( $instance ){
		$position = ( isset( $instance[ 'ulrotator_slide_position' ] ) ) ? $instance[ 'ulrotator_slide_position' ] : "";
		$rand = ( isset( $instance[ 'ulrotator_slide_rand' ] ) ) ? $instance[ 'ulrotator_slide_rand' ] : '';
		$title = ( isset( $instance[ 'ulrotator_slide_title' ] ) ) ? $instance[ 'ulrotator_slide_title' ] : '';
		$orientation = ( isset( $instance[ 'ulrotator_slide_orientation' ] ) ) ? $instance[ 'ulrotator_slide_orientation' ] : '';		
		$interval = ( isset( $instance[ 'ulrotator_slide_interval' ] ) ) ? $instance[ 'ulrotator_slide_interval' ] : '';
		$duration = ( isset( $instance[ 'ulrotator_slide_duration' ] ) ) ? $instance[ 'ulrotator_slide_duration' ] : 400;
		$nav = ( isset( $instance[ 'ulrotator_slide_navigation' ] ) ) ? $instance[ 'ulrotator_slide_navigation' ] : '';
		$cycle = ( isset( $instance[ 'ulrotator_slide_cycle' ] ) ) ? $instance[ 'ulrotator_slide_cycle' ] : "";
		$items_per_cycle = ( isset( $instance[ 'ulrotator_slide_item_cycle' ] ) ) ? $instance[ 'ulrotator_slide_item_cycle' ] : 1;
		$item_width = ( isset( $instance[ 'ulrotator_slide_item_width' ] ) ) ? $instance[ 'ulrotator_slide_item_width' ] : '';
		$item_height = ( isset( $instance[ 'ulrotator_slide_item_height' ] ) ) ? $instance[ 'ulrotator_slide_item_height' ] : '';
		$slide_width = ( isset( $instance[ 'ulrotator_slide_width' ] ) ) ? $instance[ 'ulrotator_slide_width' ] : '';
		$slide_height = ( isset( $instance[ 'ulrotator_slide_height' ] ) ) ? $instance[ 'ulrotator_slide_height' ] : '';
				
	?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_slide_title' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_slide_title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_position' ); ?>"><?php _e( 'Position:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'ulrotator_slide_position' ); ?>" id="<?php echo $this->get_field_id( 'ulrotator_slide_position' ); ?>">
			<option value=""></option>
			<?php echo ulrotator_list_terms( 'ultimate_rotator_position', 'option', 0, $position ); ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_rand' ); ?>"><?php _e( 'Random:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'ulrotator_slide_rand' ); ?>" id="<?php echo $this->get_field_id( 'ulrotator_slide_rand' ); ?>">
				<option value="">No</option>
				<option value="rand" <?php if( $rand == "rand" ){ echo 'selected="selected"'; } ?> >Yes</option>			
			</select>
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_orientation' ); ?>"><?php _e( 'Orientation:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'ulrotator_slide_orientation' ); ?>" id="<?php echo $this->get_field_id( 'ulrotator_slide_orientation' ); ?>">
				<option value="vertical">Vertical</option>
				<option value="horizontal" <?php if( $orientation == "horizontal" ){ echo 'selected="selected"'; } ?> >Horizontal</option>			
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_item_cycle' ); ?>"><?php _e( 'Items per cycle:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_slide_item_cycle' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_slide_item_cycle' ); ?>" type="text" value="<?php echo esc_attr( $items_per_cycle ); ?>" />			
		</p>	

		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_interval' ); ?>"><?php _e( 'Interval:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_slide_interval' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_slide_interval' ); ?>" type="text" value="<?php echo esc_attr( $interval ); ?>" />			
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_duration' ); ?>"><?php _e( 'Duration:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_slide_duration' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_slide_duration' ); ?>" type="text" value="<?php echo esc_attr( $duration ); ?>" />			
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_navigation' ); ?>"><?php _e( 'Navigation:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'ulrotator_slide_navigation' ); ?>" id="<?php echo $this->get_field_id( 'ulrotator_slide_navigation' ); ?>">
				<option value=""></option>
				<option value="np" <?php if( $nav == "np" ){ echo 'selected="selected"'; } ?> >Next/Previous</option>
				<option value="num" <?php if( $nav == "num" ){ echo 'selected="selected"'; } ?> >Number</option>			
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_item_width' ); ?>"><?php _e( 'Item width:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_slide_item_width' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_slide_item_width' ); ?>" type="text" value="<?php echo esc_attr( $item_width ); ?>" />			
		</p>	
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_item_height' ); ?>"><?php _e( 'Item height:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_slide_item_height' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_slide_item_height' ); ?>" type="text" value="<?php echo esc_attr( $item_height ); ?>" />			
		</p>	

		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_width' ); ?>"><?php _e( 'Slide width:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_slide_width' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_slide_width' ); ?>" type="text" value="<?php echo esc_attr( $slide_width ); ?>" />			
		</p>	
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_height' ); ?>"><?php _e( 'Slide height:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_slide_height' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_slide_height' ); ?>" type="text" value="<?php echo esc_attr( $slide_height ); ?>" />			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_slide_cycle' ); ?>">
				<input id="<?php echo $this->get_field_id( 'ulrotator_slide_cycle' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_slide_cycle' ); ?>" type="checkbox" value="endless" <?php if( $cycle == "endless" ){ echo 'checked="checked"'; } ?> />
				<?php _e( 'Endless Cycle' ); ?>	
			</label>						
		</p>
		
			
		<?php	
	}


}

/** end */