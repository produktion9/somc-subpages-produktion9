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
  	//Set title
    $title = empty($instance['title']) ? 'Pages' : apply_filters('widget_title', $instance['title']);
	//Set sort order
 	//$sort_order=empty($instance['sort_order']) ? 'DESC' : apply_filters('widget_sort', $instance['sort_order']);
 	//Set sort by
 	// if(count($instance['sort_by']) > 0)
 	// {
 	// 	$sort_by_values=implode(',',$instance['sort_by']);
 	// }
 	// else
 	// {
 	// 	$sort_by_values='';
 	// }
 	//Set depth
 	// $depth=empty($instance['depth']) ? '1' : apply_filters('widget_depth', $instance['depth']);
	//Print title
    if (!empty($title))
      echo $before_title . $title . $after_title;
	
    $page_id = $post->ID;
    	$args = array(
    			'order' => 'DESC',
    			'post_parent' => $page_id,
    			'child_of' => $page_id,
    			'sort_column' => 'post_title',
    			'post_status' => 'publish',
    			'post_type' => 'page'
    	);
    	
	$attachments = get_pages( $args );
	//Check if page has subpages and set collapsebutton
	if (count($attachments) > 0)
    $collapse_p = '<span class="collapse-button-widget-p" id="pw' . $page_id . '"><img class="icon_wp" src="' . plugins_url('img/hide-icon-grey.png', __FILE__) . '" title="Collapse list"></span>'; //. $sorting_p
	else
    $collapse_p = "";
    echo $collapse_p
    //Print ul
    ?>
		<ul id="sort-list-widget" class="parent-widget-pw<?php echo $page_id ?>">
		<?php 
		$real_parent = null;
    	if($attachments)
    	{
    		foreach($attachments as $attachment)
    	    {
    	    	//Hack to check if first page is parent page
            if ($real_parent === null)
                $real_parent = $attachment->post_parent;
            if ($attachment->post_parent != $real_parent)
        	continue;
    	    	//Show thumbnail if set
            $img = get_the_post_thumbnail($attachment->ID);
            if (!empty($img)) {
                $img = get_the_post_thumbnail($attachment->ID, array(
                    35,
                    35
                ));
            } else {
                //Show default image if no thumbnail
                $img = '<img src="' . plugins_url('img/sony-folder.jpg', __FILE__) . '" width="35px" height="35px">';
            }
            //Truncate title
            $thetitle  = $attachment->post_title;
            $getlength = strlen($thetitle);
            $thelength = 20;
            if ($getlength > $thelength) {
                $thedots = "...";
            } else {
                $thedots = "";
            }
            
            //Array Children
            $args_children = array(
                'order' => 'DESC',
                'post_parent' => $attachment->ID,
                'child_of' => $attachment->ID,
                'depth' => $attachment->depth,
                'sort_column' => $attachment->sort_by_values,
                'post_status' => 'publish',
                'post_type' => 'page'
            );
            $childrens     = get_children($args_children);
            $collapse      = null;
            $sorting       = null;
            if (count($childrens) > 1)
        		$sorting = '<span class="ascending_widget" id="w' . $attachment->ID . '"><img class="icon_w" src="' . plugins_url('img/asc-icon-grey-t.png', __FILE__) . '" title="Sort ascending"></span><span class="descending_widget" id="w' . $attachment->ID . '"><img class="icon_w" src="' . plugins_url('img/desc-icon-grey-t.png', __FILE__) . '" title="Sort descending"></span>';
            else
                $sorting = "";
            if (count($childrens) > 0)
                $collapse = '<span class="collapse-button-widget" id="cw' . $attachment->ID . '"><img class="icon_w" src="' . plugins_url('img/hide-icon-grey.png', __FILE__) . '" title="Collapse list"></span>' . $sorting;
            else
                $collapse = "";
            //Print li
    	    ?>
    	    	<li><?php echo $img;?><a href="<?php echo $attachment->guid;?>"><?php echo substr($thetitle, 0, $thelength);?></a><?php echo $thedots; ?><?php echo $collapse; ?>
    	    <?php
    	    	//Check if li has children
	    	    if($childrens)
			    	{
			    		//Print children
			    		?>
			    		<ul class="child-widget-cw<?php echo $attachment->ID ?>">
			    		<?php
				    		foreach($childrens as $children)
				    	    {
				    	    	//Show thumbnail if set
				            $img = get_the_post_thumbnail($children->ID);
				            if (!empty($img)) {
				                $img = get_the_post_thumbnail($children->ID, array(
				                    35,
				                    35
				                ));
				            } else {
				                //Show default image if no thumbnail
				                $img = '<img src="' . plugins_url('img/sony-folder.jpg', __FILE__) . '" width="35px" height="35px">';
				            }
				            //Truncate title
				            $thetitle  = $children->post_title;
				            $getlength = strlen($thetitle);
				            $thelength = 20;
				            if ($getlength > $thelength) {
				                $thedots = "...";
				            } else {
				                $thedots = "";
				            }
					    	    ?>
					    	    	<li><?php echo $img;?><a href="<?php echo $children->guid;?>"><?php echo substr($thetitle, 0, $thelength);?><?php echo $thedots; ?></a></li>
					    	  <?php
				    	    }
				    	    ?>
				    	</ul>
					<?php
			    	}
	    	    ?>
	    	  </li>
	    	  <?php
    	    }
    	 }
    	 else 
    	 {	
    	 	//If page has no subpages
    	 	echo "<li>No subpages</li>";
    	  //  $args = array(
			   	// 	'title_li' => '',
    			//   'echo' => 1,
    			//   'depth' => $depth,
    			//   'sort_order'=>'DESC',
    			//   'post_type'    => 'page',
    			//   'post_status'  => 'publish',
    			// 	);
    			// $pages=wp_list_pages($args);	
    			// print_r($pages);		
    	}?>
    	</ul>
  	<?php
		echo $after_widget;
	}
			
	// Widget Backend 
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','sort_order' => '', 'sort_by'=>'','depth'=>'') );
		
		$title = $instance['title'];
		// $sort_order=$instance['sort_order'];
		// $sort_by=$instance['sort_by'];
		// $depth=$instance['depth'];
		?>
		
		<!-- Title -->
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'subpage'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
				
		<!-- Sort Order Field Starts-->
		
		<!-- <label for="help_text"><?php _e('Options for Displaying the Subpages','subpage')?></label> 
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
		</p> -->

		<!-- Sorting Criteria Field -->
		
		<!-- <label for="help_text1"><?php _e('Options for Displaying the Parent Pages when their is no subpages to be displayed','subpage');?></label>
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
		</p> -->
		<!-- Depth Level Field -->		
		<!-- <p>
			<label for="<?php echo $this->get_field_id('depth'); ?>"><?php _e('Depth Level', 'subpage'); ?></label>
			<select name="<?php echo $this->get_field_name('depth'); ?>" id="<?php echo $this->get_field_id('depth'); ?>" class="widefat">	
			<?php
				$depth_options = array('1'=>__('1st Level Depth','subpage'),
									   '2'=>__('2nd Level Depth','subpage'),
									   '3'=>__('3rd Level Depth','subpage'),
									   '4'=>__('4th Level Depth','subpage'),
									   '0'=>__('Unlimited Depth','subpage')
						);
					foreach($depth_options as $depth_number=>$depth_label) { ?>
			                <option <?php selected( $instance['depth'], $depth_number ); ?> value="<?php echo esc_attr($depth_number); ?>"><?php echo __($depth_label,'subpage'); ?></option>
			                <?php } ?>      
			</select>
		</p> -->
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    // $instance['sort_order'] = $new_instance['sort_order'];
	    // $instance['sort_by'] = $new_instance['sort_by'];
	    // $instance['depth']= $new_instance['depth'];
    return $instance;
	}
}// Class somc_subpages_produktion9_widget ends here

// Register and load the widget
function somc_subpages_produktion9_load_widget() {
	register_widget( 'somc_subpages_produktion9_widget' );
}

