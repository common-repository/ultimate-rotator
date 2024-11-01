<?php

class Ulrotator_Cycle_Widget extends WP_Widget{

	function __construct(){
		parent::__construct( 'ulrotator_cycle_widget', 'Ultimate Rotator - Cycle Content', array( 'description' => __('Cycle your rotator items every time you refresh the page.', 'ultimate_rotator') ) );
	}	
	
	function widget( $args, $instance ){
	
		extract( $args );
		
		echo $before_widget;		
		
		
		$title = apply_filters( 'widget_title', $instance['ulrotator_title'] );
		if ( preg_match( '/^image:/', $title, $match ) ){
			$url = explode( $match[0], $title );
			$img = '<img src="'. $url[1] .'" alt="" />';
			echo $before_title . htmlspecialchars_decode( apply_filters( 'widget_title', $img ) ) . $after_title;
		}else{
			if ( ! empty( $title ) )
				echo $before_title . $title . $after_title;				
		}
		
		$position = $instance['ulrotator_position'];
		$posts_per_page = $instance['ulrotator_posts_per_page'];
		$name = $instance['ulrotator_name'];
		$key = $instance['ulrotator_key'];
		$rand = $instance['ulrotator_rand'];
		$allposts = $instance['ulrotator_all'];
		$item_width = $instance['ulrotator_item_width'];
		$item_height = $instance['ulrotator_item_height'];
		$rotator_width = $instance['ulrotator_cycle_width'];
		$rotator_height = $instance['ulrotator_cycle_height'];
				
		//term slug instead of term_id
		$term = get_term( $position, 'ultimate_rotator_position' );
		
		//show the rotator
		get_cycle_loop( $posts_per_page, $term->slug, $name, $key, $rand, $allposts, $item_width, $item_height, $rotator_width, $rotator_height );
						
		echo $after_widget;
	
	}
	
	
	function update( $new_instance, $old_instance ){
	
		$instance = array();
		$instance['ulrotator_position'] = strip_tags( $new_instance['ulrotator_position'] );
		$instance['ulrotator_posts_per_page'] = strip_tags( $new_instance['ulrotator_posts_per_page'] );
		$instance['ulrotator_name'] = strip_tags( $new_instance['ulrotator_name'] );
		$instance['ulrotator_key'] = strip_tags( $new_instance['ulrotator_key'] );
		$instance['ulrotator_rand'] = strip_tags( $new_instance['ulrotator_rand'] );
		$instance['ulrotator_all'] = strip_tags( $new_instance['ulrotator_all'] );
		$instance['ulrotator_title'] = strip_tags( $new_instance['ulrotator_title'] );
		$instance['ulrotator_item_width'] = strip_tags( $new_instance['ulrotator_item_width'] );
		$instance['ulrotator_item_height'] = strip_tags( $new_instance['ulrotator_item_height'] );
		$instance['ulrotator_cycle_width'] = strip_tags( $new_instance['ulrotator_cycle_width'] );
		$instance['ulrotator_cycle_height'] = strip_tags( $new_instance['ulrotator_cycle_height'] );
			
		return $instance;
	
	}
	
	
	function form( $instance ){
		$position = ( isset( $instance[ 'ulrotator_position' ] ) ) ? $instance[ 'ulrotator_position' ] : "";
		$posts_per_page = ( isset( $instance[ 'ulrotator_posts_per_page' ] ) ) ? $instance[ 'ulrotator_posts_per_page' ] : '';
		$name = ( isset( $instance[ 'ulrotator_name' ] ) ) ? $instance[ 'ulrotator_name' ] : '';
		$key = ( isset( $instance[ 'ulrotator_key' ] ) ) ? $instance[ 'ulrotator_key' ] : '';
		$rand = ( isset( $instance[ 'ulrotator_rand' ] ) ) ? $instance[ 'ulrotator_rand' ] : '';
		$allposts = ( isset( $instance[ 'ulrotator_all' ] ) ) ? $instance[ 'ulrotator_all' ] : '';
		$title = ( isset( $instance[ 'ulrotator_title' ] ) ) ? $instance[ 'ulrotator_title' ] : '';
		$item_width = ( isset( $instance[ 'ulrotator_item_width' ] ) ) ? $instance[ 'ulrotator_item_width' ] : '';
		$item_height = ( isset( $instance[ 'ulrotator_item_height' ] ) ) ? $instance[ 'ulrotator_item_height' ] : '';
		$rotator_width = ( isset( $instance[ 'ulrotator_cycle_width' ] ) ) ? $instance[ 'ulrotator_cycle_width' ] : '';
		$rotator_height = ( isset( $instance[ 'ulrotator_cycle_height' ] ) ) ? $instance[ 'ulrotator_cycle_height' ] : '';

	?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_title' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_position' ); ?>"><?php _e( 'Position:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'ulrotator_position' ); ?>" id="<?php echo $this->get_field_id( 'ulrotator_position' ); ?>">
			<option value=""></option>
			<?php echo ulrotator_list_terms( 'ultimate_rotator_position', 'option', 0, $position ); ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_rand' ); ?>"><?php _e( 'Random:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'ulrotator_rand' ); ?>" id="<?php echo $this->get_field_id( 'ulrotator_rand' ); ?>">
				<option value="">No</option>
				<option value="rand" <?php if( $rand == "rand" ){ echo 'selected="selected"'; } ?> >Yes</option>			
			</select>
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_posts_per_page' ); ?>"><?php _e( 'Number of items:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_posts_per_page' ); ?>" type="text" value="<?php echo esc_attr( $posts_per_page ); ?>" />			
		</p>
				
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_name' ); ?>"><?php _e( 'Name:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_name' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_key' ); ?>"><?php _e( 'Key:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_key' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_key' ); ?>" type="text" value="<?php echo esc_attr( $key ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_item_width' ); ?>"><?php _e( 'Item width:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_item_width' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_item_width' ); ?>" type="text" value="<?php echo esc_attr( $item_width ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_item_height' ); ?>"><?php _e( 'Item height:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_item_height' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_item_height' ); ?>" type="text" value="<?php echo esc_attr( $item_height ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_cycle_width' ); ?>"><?php _e( 'Rotator width:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_cycle_width' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_cycle_width' ); ?>" type="text" value="<?php echo esc_attr( $rotator_width ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_cycle_height' ); ?>"><?php _e( 'Rotator height:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ulrotator_cycle_height' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_cycle_height' ); ?>" type="text" value="<?php echo esc_attr( $rotator_height ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ulrotator_all' ); ?>">
				<input id="<?php echo $this->get_field_id( 'ulrotator_all' ); ?>" name="<?php echo $this->get_field_name( 'ulrotator_all' ); ?>" type="checkbox" value="all" <?php if( $allposts == "all" ){ echo 'checked="checked"'; } ?> />
				<?php _e( 'Show all posts found' ); ?>	
			</label>						
		</p>
		
		<?php	
	}


}

/* End of ulrotator-cycle-widget.php */