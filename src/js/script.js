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
        jQuery("#"+tid).html("Hide");
    } else {
        hide(tid);
        hidden.push(tid);
        jQuery("#"+tid).html("Show");
    }
  })
});