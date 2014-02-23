function sortUnorderedList(ul, sortDescending) {
  if(typeof ul == "string")
    ul = document.getElementById(ul);

  var lis = ul.getElementsByTagName("LI");
  var vals = [];

  for(var i = 0, l = lis.length; i < l; i++)
    vals.push(lis[i].innerHTML);

  vals.sort();

  if(sortDescending)
    vals.reverse();

  for(var i = 0, l = lis.length; i < l; i++)
    lis[i].innerHTML = vals[i];
}

window.onload = function() {
  var desc = false;
  document.getElementById("sort-button").onclick = function() {
    sortUnorderedList("sort-list", desc);
    desc = !desc;
    return false;
  }
  document.getElementById("sort-button-widget").onclick = function() {
    sortUnorderedList("sort-list-widget", desc);
    desc = !desc;
    return false;
  }
}     