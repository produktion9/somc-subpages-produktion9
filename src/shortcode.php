<?php
function somc_subpages_produktion9_shortcode($atts)
{
    global $post;
    // Extract values from shortcode
    extract(shortcode_atts(array(
        'title' => '',
        'depth' => '',
        'sort_order' => '',
        'sort_by_values' => ''
    ), $atts));
    
    //Set title
    $title = empty($title) ? 'Sub Pages' : $title;
    //Set depth
    $depth = empty($depth) ? '1' : $depth;
    //Set sort order
    $sort_order = empty($sort_order) ? 'ASC' : $sort_order;
    //Set sort by
    $sort_by_values = empty($sort_by_values) ? 'page_title ' : $sort_by_values;
    //Parent page id
    $page_id = $post->ID;
    
    
    //Array level one pages
    $args = array(
        'order' => $sort_order,
        'post_parent' => $page_id,
        'child_of' => $page_id,
        'depth' => $depth,
        'sort_column' => $sort_by_values,
        'post_status' => 'publish',
        'post_type' => 'page'
    );
    
    $attachments = get_pages($args);
    //Check if page has subpages and set title and collapsebutton
    if(count($attachments) > 0) $collapse_p = '<h3 class="widget_title">' . $title . '</h3><span class="collapse-button-p" id="p'.$page_id.'"><img class="icon" src="' . plugins_url('img/hide-icon-grey.png', __FILE__) . '"></span>';
    else $collapse_p = "";

	//Begin HTML string
    $p9_str = '';
    $p9_str .= '<div class="container">';
    $p9_str .= $collapse_p;

    $real_parent = null;
    $p9_str .= '<ul id="sort-list" class="parent-p' . $page_id. '">';
    //	$p9_str .= '<pre style="font-size:6px;">' . print_r($attachments, true). '</pre>';
    if ($attachments) {
    	//Loop level one pages
        foreach ($attachments as $attachment) {
        	//Hack to check if first page is parent page
            if ($real_parent === null)
                $real_parent = $attachment->post_parent;
            if ($attachment->post_parent != $real_parent)
                continue;
            //Show thumbnail if set
            $img = get_the_post_thumbnail($attachment->ID);
            if (!empty($img)) {
                $img = get_the_post_thumbnail($attachment->ID, array(
                    49,
                    49
                ));
            } else {
            //Show default image if no thumbnail
                $img = '<img src="' . plugins_url('img/sony-folder.jpg', __FILE__) . '" width="49px" height="49px">';
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
                'order' => $attachment->sort_order,
                'post_parent' => $attachment->ID,
                'child_of' => $attachment->ID,
                'depth' => $attachment->depth,
                'sort_column' => $attachment->sort_by_values,
                'post_status' => 'publish',
                'post_type' => 'page'
            );
            $childrens     = get_children($args_children);
            $collapse = null;

            if(count($childrens) > 0) $collapse = '<span class="collapse-button" id="c'.$attachment->ID.'"><img class="icon" src="' . plugins_url('img/hide-icon-grey.png', __FILE__) . '"></span>';
            else $collapse = "";
            //Print level one pages
            $p9_str .= '<li>' . $img . '<a href="' . $attachment->guid . '" title="' . $attachment->post_title . '">' . substr($thetitle, 0, $thelength) . '' . $thedots . '</a>'.$collapse.'</li>';
            
            //listArrayRecursive?
            if ($childrens) {
                $p9_str .= '<ul class="child-c' . $attachment->ID . '">';
                //Loop children
                foreach ($childrens as $children){
                	//Show thumbnail if set
                    $img = get_the_post_thumbnail($children->ID);
                    if (!empty($img)) {
                        $img = get_the_post_thumbnail($children->ID, array(
                            49,
                            49
                        ));
                    } else {
                    //Show default image if no thumbnail
                        $img = '<img src="' . plugins_url('img/sony-folder.jpg', __FILE__) . '" width="49px" height="49px">';
                    }
                   
                    $thetitle  = $children->post_title;
                    $getlength = strlen($thetitle);
                    $thelength = 20;
                    if ($getlength > $thelength) {
                        $thedots = "...";
                    } else {
                        $thedots = "";
                    }
                    $p9_str .= '<li>' . $img . '<a href="' . $children->guid . '" title="' . $children->post_title . '">' . substr($thetitle, 0, $thelength) . '' . $thedots . '</a></li>';
                }
                $p9_str .= '</ul>';
            }
        }
    } else {
        $args  = array(
            'title_li' => '',
            'echo' => 1,
            'depth' => $depth,
            'sort_order' => $sort_order,
            'post_type' => 'page',
            'post_status' => 'publish'
        );
        $pages = wp_list_pages($args);
        
        $p9_str .= $pages;
    }
    
    $p9_str .= '</ul>';
    $p9_str .= '</div>'; //End HTML string
    //Print HTML
    return $p9_str;
}
?>