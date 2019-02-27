var a = 0; 			// Start Point
var time = 2000;	// Time Between Switch
changeImg();

// Change Image
function changeImg(){
var idx;
var images=document.getElementsByClassName("slide");
for(idx=0; idx<images.length; idx++){
  images[idx].style.display ="none";
}a++;
if(a>images.length){
  a=1;
}
images[a-1].style.display="block";
	setTimeout("changeImg()", time);
}
