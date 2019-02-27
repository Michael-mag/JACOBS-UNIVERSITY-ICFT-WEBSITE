// When the user scrolls down 20px from the top of the document, show the scroll up button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("UpButton").style.display = "block";
  } else {
    document.getElementById("UpButton").style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
function ScrollUp() {
  if(document.documentElement.scrollTop < 5){return 0;}
  document.documentElement.scrollTop -=10;

  setTimeout("ScrollUp()",1)
}
