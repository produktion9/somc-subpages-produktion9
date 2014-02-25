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
        jQuery("#"+tid).html('<img class="icon" src="'+templateUrl+'/hide-icon-grey.png"/>');
    } else {
        hide(tid);
        hidden.push(tid);
        jQuery("#"+tid).html('<img class="icon" src="'+templateUrl+'/show-icon-grey.png"/>');
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
        jQuery("#"+tid).html('<img class="icon" src="'+templateUrl+'/hide-icon-grey.png"/>');
    } else {
        hide_p(tid);
        hidden.push(tid);
        jQuery("#"+tid).html('<img class="icon" src="'+templateUrl+'/show-icon-grey.png"/>');
    }
  })
});
