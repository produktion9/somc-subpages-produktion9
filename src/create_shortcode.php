<?php 
function somc_subpages_produktion9_shortcode($atts)
{
	global $post;
	extract(shortcode_atts(array(
				'title' => '',
				'depth'=>'',
				'sort_order'=>'',
				'sort_by_values'=>''
			), $atts));

	
	$title = empty($title) ? 'Sub Pages' : $title;

	$depth=empty($depth) ? '1' : $depth;
	 
	$sort_order=empty($sort_order) ? 'ASC' : $sort_order;
	 
	$sort_by_values=empty($sort_by_values) ? 'page_title ' : $sort_by_values;
	 
	$p9_str = '';
	$p9_str .= '<div class="container">';
	$p9_str .= '<h3 class="widget_title">'.$title.'</h3>';
	$p9_str .= '<input type="button" id="sort-button" value="Sort List (click again to reverse)"/>';
	$page_id= $post->ID;
	
	$args = array(
				'order' => $sort_order,
				'post_parent' => $page_id,
				'post_status' => 'publish',
				'post_type' => 'page'
	);
	
	$attachments = get_children( $args );
	
   	$p9_str .= '<ul id="sort-list">';
	   	if($attachments)
	   	{
			foreach($attachments as $attachment)
	    	{
	    		$img = get_the_post_thumbnail($attachment->ID);
					if ( ! empty( $img ) ){
						$img = get_the_post_thumbnail($attachment->ID, array(49,49));
					}
					else
					{
						$img = '<img src="' . plugins_url( 'img/sony-folder.jpg' , __FILE__ ) . '" width="49px" height="49px">';
					}
	    		$thetitle = $attachment->post_title;
					$getlength = strlen($thetitle);
					$thelength = 20;
					if ($getlength > $thelength){
						$thedots = "...";
					}
					else
					{
						$thedots = "";
					}
	    		$p9_str .= '<li>'.$img.'<a href="'.$attachment->guid.'" title="'.$attachment->post_title.'">'.substr($thetitle, 0, $thelength).''. $thedots .'</a></li>';
	    	}
	   	}
	   	else 
	   	{	$args = array(
	   	    	'title_li' => '',
	   				'echo' => 1,
	   				'depth'=> $depth,
	   				'sort_order'=>$sort_order,
	   				'post_type'    => 'page',
	   				'post_status'  => 'publish',
	   		);
				$pages = wp_list_pages($args);
				
				$p9_str .= $pages;		
	   	}
   	
   	$p9_str .= '</ul>';
	$p9_str .= '</div>';
	
	return $p9_str;
}     
?>
