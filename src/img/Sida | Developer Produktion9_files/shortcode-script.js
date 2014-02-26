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
var templateUrl = (mylocalizedscript.myurl);
/* verify you are getting the correct values 
alert(templateUrl);
alert(mylocalizedscript.myurl);*/

//Hide Children
function hide($id){
  jQuery(".child-"+String($id)).fadeOut(200);
}
function show($id){
  jQuery(".child-"+String($id)).fadeIn(200);
}
var hidden = [];
jQuery( document ).ready(function() {
  jQuery(".collapse-button").click(function() {
    var tid = jQuery(this).attr('id');

    if (hidden.indexOf(tid) > -1) {
        show(tid);
        hidden.remove(tid);
        jQuery("#"+tid).html('<img class="icon" src="'+templateUrl+'hide-icon-grey.png" title="Collapse list"/>');
    } else {
        hide(tid);
        hidden.push(tid);
        jQuery("#"+tid).html('<img class="icon" src="'+templateUrl+'show-icon-grey.png" title="Show list"/>');
    }
  })
});
//Hide Parent
function hide_p($id){
  jQuery(".parent-"+String($id)).fadeOut(200);
}
function show_p($id){
  jQuery(".parent-"+String($id)).fadeIn(200);
}
var hidden = [];
jQuery( document ).ready(function() {
  jQuery(".collapse-button-p").click(function() {
    var tid = jQuery(this).attr('id');

    if (hidden.indexOf(tid) > -1) {
        show_p(tid);
        hidden.remove(tid);
        jQuery("#"+tid).html('<img class="icon_p" src="'+templateUrl+'hide-icon-grey.png" title="Collapse list"/>');
    } else {
        hide_p(tid);
        hidden.push(tid);
        jQuery("#"+tid).html('<img class="icon_p" src="'+templateUrl+'show-icon-grey.png" title="Show list"/>');
    }
  })
});

//Sorting
jQuery(document).ready(function() {
    // //when the document is ready
    // jQuery('.ascending_p').click(function() {
    // var pid = jQuery(this).attr('id');
    // //alert(pid);
    // //when the acending button is clicked run the following function
    // SORTER.sort('.parent-p'+String(pid));
    // jQuery("#"+pid).html('<img class="icon" src="'+templateUrl+'desc-icon-grey.png"/>');
    // //sor tthe list
    // });
    // //close

    // jQuery('.descending_p').click(function() {
    // var pid = jQuery(this).attr('id');
    // //when the decending button is clicked run the following function
    // SORTER.sort('.parent-p'+String(pid), 'desc');
    // jQuery("#"+pid).html('<img class="icon" src="'+templateUrl+'asc-icon-grey.png"/>');
    // //sor thte sortable list in a descending way
    // });
    // //close

    jQuery('.ascending').click(function() {
    var sid = jQuery(this).attr('id');
    //when the acending button is clicked run the following function
    SORTER.sort('.child-c'+String(sid));
    // jQuery('.descending').html('<img class="icon" src="'+templateUrl+'desc-icon-blue-t.png"/>');
    // jQuery('.ascending').html('<img class="icon" src="'+templateUrl+'asc-icon-grey-t.png"/>');
    //jQuery("#"+sid).html('<img class="icon" src="'+templateUrl+'desc-icon-grey.png"/>');
    //jQuery("#"+sid).removeClass('ascending').addClass('descending');
    // jQuery('.ascending').addClass('isHidden');
    // jQuery('.descending').removeClass('isHidden');
    //sor tthe list
    });
    //close

    jQuery('.descending').click(function() {
    var sid = jQuery(this).attr('id');
    //when the decending button is clicked run the following function
    SORTER.sort('.child-c'+String(sid), 'desc');
    // jQuery('.ascending').html('<img class="icon" src="'+templateUrl+'asc-icon-blue-t.png"/>');
    // jQuery('.descending').html('<img class="icon" src="'+templateUrl+'desc-icon-grey-t.png"/>');
    // jQuery('.descending').addClass('isHidden');
    // jQuery('.ascending').removeClass('isHidden');
    //sor thte sortable list in a descending way
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

