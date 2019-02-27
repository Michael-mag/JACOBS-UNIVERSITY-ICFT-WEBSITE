var j = 0;
var  time = 3000;
switchVid();

function switchVid() {
  var i;
  var highlights = document.getElementsByClassName("mySlides");
  for (i = 0; i < highlights.length; i++) {
    highlights[i].style.display = "none";
  }
  j++;
  if (j > highlights.length) {j = 1}
  highlights[j-1].style.display = "block";
  setTimeout(switchVid, time);
}
