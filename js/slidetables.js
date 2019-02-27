var z = 0; 			// Start Point
var t = 4000;	// Time Between Switch
changeTable();

// Change Table
function changeTable(){
var idx;
var tables=document.getElementsByClassName("log_tables");
for(idx=0; idx<tables.length; idx++){
  tables[idx].style.display ="none";
}z++;
if(z>tables.length){
  z=1;
}
tables[z-1].style.display="block";
	setTimeout("changeTable()", t);
}
