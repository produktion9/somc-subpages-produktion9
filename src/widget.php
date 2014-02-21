<?php
// Creating the widget 
class somc_subpages_produktion9_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'somc_subpages_produktion9_widget', 

		// Widget name will appear in UI
		__('somc-subpages-produktion9', 'somc_subpages_produktion9_widget_domain'), 

		// Widget description
		array( 'description' => __( 'Produktion9 List Subpages', 'somc_subpages_produktion9_widget_domain' ), ) 
		);
	}

	// Widget front-end
	public function widget( $args, $instance ) {
		global $post;
  	extract($args,EXTR_SKIP);
	
  	echo $before_widget;
    $title = empty($instance['title']) ? 'Pages' : apply_filters('widget_title', $instance['title']);
   
	 	$sort_order=empty($instance['sort_order']) ? 'ASC' : apply_filters('widget_sort', $instance['sort_order']);
	 	
	 	if(count($instance['sort_by']) > 0)
	 	{
	 		$sort_by_values=implode(',',$instance['sort_by']);
	 	}
	 	else
	 	{
	 		$sort_by_values='';
	 	}
	
    if (!empty($title))
      echo $before_title . $title . $after_title;
	
    $page_id= $post->ID;
    	$args = array(
    			'order' => $sort_order,
    			'post_parent' => $page_id,
    			'post_status' => 'publish',
    			'post_type' => 'page',
    	);
    	
    	$attachments = get_children( $args ); ?>
				<ul class="page_list">
				<?php 
		    	if($attachments)
		    	{
		    		foreach($attachments as $attachment)
		    	    {
			    	    ?>
			    	    	<li><a href="<?php echo $attachment->guid;?>"><?php echo $attachment->post_title;?></a></li>	
			    	    <?php 	
		    	    }
		    	 }
		    	 else 
		    	 {	
		    	   $args = array(
					   		'title_li' => '',
		    			  'echo' => 1,
		    			  'sort_order'=>$sort_order,
		    			  'post_type'    => 'page',
		    			  'post_status'  => 'publish',
		    				);
		    			$pages=wp_list_pages($args);	
		    			print_r($pages);		
		    	}?>
		    </ul>
  	<?php
		echo $after_widget;
	}
			
	// Widget Backend 
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','sort_order' => '', 'sort_by'=>'' ) );
		
		$title = $instance['title'];
		$sort_order=$instance['sort_order'];
		$sort_by=$instance['sort_by'];
		?>
		
		<!-- Title -->
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'subpage'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
				
		<!-- Sort Order Field Starts-->
		
		<label for="help_text"><?php _e('Options for Displaying the Subpages','subpage')?></label> 
		<p>
	  	<label for="<?php echo $this->get_field_id('sort_order'); ?>"><?php _e('Sorting Order', 'subpage'); ?></label>
			<select name="<?php echo $this->get_field_name('sort_order'); ?>" id="<?php echo $this->get_field_id('sort_order'); ?>" class="widefat">	
				<?php
					$order_options = array(
						'ASC'=>__('Ascending','subpage'), 
						'DESC'=>__('Descending','subpage'),
					);
					foreach($order_options as $option_key=>$option_value) { ?>
						<option <?php selected( $instance['sort_order'], $option_key ); ?> value="<?php echo esc_attr($option_key); ?>"><?php echo __($option_value,'subpage'); ?></option>
					<?php } 
				?>      
			</select>
		</p>

		<!-- Sorting Criteria Field -->
		
		<label for="help_text1"><?php _e('Options for Displaying the Parent Pages when their is no subpages to be displayed','subpage');?></label>
		<p>
		<label for="<?php echo $this->get_field_id('sort_by'); ?>"><?php _e('Sorting Criteria', 'subpage'); ?></label>
		<select multiple="multiple" name="<?php echo $this->get_field_name('sort_by'); ?>[]" id="<?php echo $this->get_field_id('sort_by'); ?>" class="widefat">
			<?php 
				$options = array(		 'ID'=>__('Page ID','subpage'),
								 'post_title'=>__('Page Title','subpage'),
								 'menu_order'=>__('Menu Order','subpage'),
								 'post_date'=>__('Date Created','subpage'),
								 'post_modified'=>__('Date Modified','subpage'),
								 'post_author'=>__('Page Author','subpage'),
								 'post_name'=>__('Post Slug','subpage')
							);
				foreach($options as $key=>$value) { 

	  		if (is_array($instance['sort_by'])) {
				if(in_array($key,$instance['sort_by'])) {
					$selected = "selected=selected";
				}
				else {
					$selected = "";
				}
			}
			else if($key == "ID"){
				$selected = "selected=selected";
			}
			else{
				$selected = "";			
			}?>
		  <option <?php echo $selected?> value="<?php echo esc_attr($key); ?>"><?php echo __($value,'subpage'); ?></option>
		  <?php } ?>      
		</select>
		</p>

		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['sort_order'] = $new_instance['sort_order'];
    $instance['sort_by'] = $new_instance['sort_by'];
    return $instance;
	}
}// Class somc_subpages_produktion9_widget ends here



