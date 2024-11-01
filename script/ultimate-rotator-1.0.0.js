jQuery(document).ready(function($){

	var ulrotator = $('.ulrotator-wrap').length;	
	if ( ulrotator > 0 ){
		
		//slide effect	
		$('.ulrotator-wrap-slide').each(function(index){
			
			var items_per_page = $(this).parent().find('.ulrotator_slide_item').val();
			var interval = $(this).parent().find('.ulrotator_slide_interval').val();
			var duration = $(this).parent().parent().find('.ulrotator_slide_duration').val();
			var cycle = $(this).parent().find('.ulrotator_slide_cycle').val();
			
			if ( cycle == "endless" )
				cycle = true;
			else
				cycle = false;				
			
			var items = 'div.ulrotator-item';
			if ( items_per_page > 1 )
				items = 'div.ulrotator-item-group';
			
			$(this).serialScroll({
				target:'div.ulrotator-content',
				items:items, // Selector to the items ( relative to the matched elements, '#sections' in this case )
				prev:'.ulrotator-prev',// Selector to the 'prev' button (absolute!, meaning it's relative to the document)
				next:'.ulrotator-next',// Selector to the 'next' button (absolute too)
				axis:'xy',// The default is 'y' scroll on both ways
				navigation:'',			
				interval:interval,
				duration:duration,// Length of the animation (if you scroll 2 axes and use queue, then each axis take half this time)
				force:true, // Force a scroll to the element specified by 'start' (some browsers don't reset on refreshes)
				//queue:false,// We scroll on both axes, scroll both at the same time.
				//event:'click',// On which event to react (click is the default, you probably won't need to specify it)
				//stop:false,// Each click will stop any previous animations of the target. (false by default)
				//lock:true, // Ignore events if already animating (true by default)
				//start: 0, // On which element (index) to begin ( 0 is the default, redundant in this case )
				cycle:cycle,// Cycle endlessly ( constant velocity, true is the default )
				step:parseInt(items_per_page), // How many items to scroll each time ( 1 is the default, no need to specify )
				//jump:false, // If true, items become clickable (or w/e 'event' is, and when activated, the pane scrolls to them)
				//lazy:false,// (default) if true, the plugin looks for the items on each event(allows AJAX or JS content, or reordering)
				//interval:1000, // It's the number of milliseconds to automatically go to the next
				//constant:true, // constant speed
				onBefore:function( e, elem, $pane, $items, pos ){
					/**
					* 'this' is the triggered element
					* e is the event object
					* elem is the element we'll be scrolling to
					* $pane is the element being scrolled
					* $items is the items collection at this moment
					* pos is the position of elem in the collection
					* if it returns false, the event will be ignored
					*/
					//those arguments with a $ are jqueryfied, elem isn't.
					e.preventDefault();
					if( this.blur )
						this.blur();
															
				},				
				onAfter:function( elem ){
					
					/*//pause the slide when mouseover
					$(elem).hover(function(){
						$(this).stop().trigger('stop');
					},function(){
						$(this).stop().trigger('start');
					});*/
					
				}
			});

		});	
		

		
		//fade effect
		$('.ulrotator-wrap-fade').each(function(index){
		
			var timeout = $(this).parent().find('.ulrotator_fade_interval').val();
			var speed = $(this).parent().find('.ulrotator_fade_duration').val();
			var position = $(this).parent().find('.ulrotator_fade_position').val();
			var pager = $(this).find('#navpager');
			
			if ( pager.length > 0 ){
				$(this).find('.ulrotator-box').before('<div id="nav-'+ position +'" class="nav"></div>');
				$(this).find('.ulrotator-box')
				.cycle({
				
					delay: 0,
					fit: 0,
					pause: 1,
					pager: '#nav-' + position,
					timeout: parseInt(timeout),
					speed: parseInt(speed),
				
				});
			
			}else{
			
				$(this).find('.ulrotator-box')
				.cycle({
				
					delay: 0,
					fit: 0,
					pause: 1,
					prev: '.ulrotator-prev-' + position, 
					next: '.ulrotator-next-' + position, 
					timeout: parseInt(timeout),
					speed: parseInt(speed),
				
				});
			
			}
			
			
		});
				
		$('.nav a').eq(0).click();
		
	}

});
