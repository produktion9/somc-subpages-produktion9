Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};
//Get plugin url
var templateUrl = (mylocalizedscript_widget.myurl);
/* verify you are getting the correct values 
alert(templateUrl);
alert(mylocalizedscript.myurl);*/

//Hide Children
function hide_widget($id){
  jQuery(".child-widget-"+String($id)).fadeOut(200);
}
function show_widget($id){
  jQuery(".child-widget-"+String($id)).fadeIn(200);
}
var hidden = [];
jQuery( document ).ready(function() {
  jQuery(".collapse-button-widget").click(function() {
    var twid = jQuery(this).attr('id');
    if (hidden.indexOf(twid) > -1) {
        show_widget(twid);
        hidden.remove(twid);
        jQuery("#"+twid).html('<img class="icon_w" src="'+templateUrl+'hide-icon-grey.png" title="Collapse list"/>');
    } else {
        hide_widget(twid);
        hidden.push(twid);
        jQuery("#"+twid).html('<img class="icon_w" src="'+templateUrl+'show-icon-grey.png" title="Show list"/>');
    }
  })
});
//Hide Parent
function hide_widget_p($id){
  jQuery(".parent-widget-"+String($id)).fadeOut(200);
}
function show_widget_p($id){
  jQuery(".parent-widget-"+String($id)).fadeIn(200);
}
var hidden = [];
jQuery( document ).ready(function() {
  jQuery(".collapse-button-widget-p").click(function() {
    var twid = jQuery(this).attr('id');
    if (hidden.indexOf(twid) > -1) {
        show_widget_p(twid);
        hidden.remove(twid);
        jQuery("#"+twid).html('<img class="icon_pw" src="'+templateUrl+'hide-icon-grey.png" title="Collapse list"/>');
    } else {
        hide_widget_p(twid);
        hidden.push(twid);
        jQuery("#"+twid).html('<img class="icon_pw" src="'+templateUrl+'show-icon-grey.png" title="Show list"/>');
    }
  })
});

//Sorting
jQuery(document).ready(function() {
    // //when the document is ready
    // jQuery('.ascending_widget_p').click(function() {
    // var pwid = jQuery(this).attr('id');
    // //alert(pid);
    // //when the acending button is clicked run the following function
    // SORTER.sort('.parent-widget-p'+String(pwid));
    // jQuery("#"+pwid).html('<img class="icon" src="'+templateUrl+'desc-icon-grey.png"/>');
    // //sor tthe list
    // });
    // //close

    // jQuery('.descending_widget_p').click(function() {
    // var pwid = jQuery(this).attr('id');
    // //when the decending button is clicked run the following function
    // SORTER.sort('.parent-widget-p'+String(pwid), 'desc');
    // jQuery("#"+pwid).html('<img class="icon" src="'+templateUrl+'asc-icon-grey.png"/>');
    // //sor thte sortable list in a descending way
    // });
    // //close

    jQuery('.ascending_widget').click(function() {
    var swid = jQuery(this).attr('id');
    //when the acending button is clicked run the following function
    SORTER.sort('.child-widget-c'+String(swid));
    // jQuery("#"+swid).html('<img class="icon" src="'+templateUrl+'desc-icon-grey.png"/>');
    // jQuery('.ascending_widget').addClass('isHidden');
    // jQuery('.descending_widget').removeClass('isHidden');
    //sort the list
    });
    //close

    jQuery('.descending_widget').click(function() {
    var swid = jQuery(this).attr('id');
    //when the decending button is clicked run the following function
    SORTER.sort('.child-widget-c'+String(swid), 'desc');
    // jQuery("#"+swid).html('<img class="icon" src="'+templateUrl+'asc-icon-grey.png"/>');
    // jQuery('.descending_widget').addClass('isHidden');
    // jQuery('.ascending_widget').removeClass('isHidden');
    //sort the sortable list in a descending way
    });
    //close


}); var SORTER = {};
//start the varable sorter

SORTER.sort = function(which, dir) {
//run sorter and run the function wthat will sort in the right direction

SORTER.dir = (dir == "desc") ? -1 : 1;
//the sorter with run the direction which is descending, meaing -1 to the ration of 1

  jQuery(which).each(function() {
  //each item run this function
    var sorted = jQuery(this).find("> li").sort(function(a, b) {
    //sort each item from a to b
    return jQuery(a).text().toLowerCase() > jQuery(b).text().toLowerCase() ? SORTER.dir : -SORTER.dir;
    //return and sort the text to alphbetical order from B to A
  });
  //close
  jQuery(this).append(sorted);
  //the appented to the sorted list
});
  //close

};
//close

