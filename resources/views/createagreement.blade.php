<?php
$fn = trim($fn,"public");
// $fn = "/Users/shariyarmalik/myprojects/testgit/storage/app/".$fn;
$i = "http://127.0.0.1:8000/storage".$fn;
// $i = asset('storage/$fn');
// $i = asset('storage/OXMeHsPfVXL1AKip3ruuZmCWtKHSN5nnT8hw9QP0.jpg');
// http://127.0.0.1:8000/storage/OXMeHsPfVXL1AKip3ruuZmCWtKHSN5nnT8hw9QP0.jpg
// $fn = "/".$fn;
// response()->file($fn);
?> 

<!DOCTYPE html>
<html>
<style>
#mydiv {
  width:50px;
  position: absolute;
  z-index: 9;
  background-color: #f1f1f1;
  text-align: center;
  border: 1px solid #d3d3d3;
}

#mydivheader {
  padding: 2px;
  cursor: move;
  z-index: 10;
  background-color: #2196F3;
  color: #fff;
}
</style>
<body>

<h1>Draggable DIV Element</h1>

<p>Click and hold the mouse button down while moving the DIV element</p>

<div id="mydiv">
  <div id="mydivheader">Text</div>
</div>


<input type="text" id="tp" name="tp">
<input type="text" id="lt" name="lt">

<!-- <div id="tp">
</div> -->

<iframe src="{{$i}}" width="100%" height="900"></iframe>
<script>
//Make the DIV element draggagle:
var p = dragElement(document.getElementById("mydiv"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0 ,t= 0, l= 0;
  if (document.getElementById(elmnt.id + "header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    t = elmnt.offsetTop - pos2;
    l = elmnt.offsetLeft - pos1;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    document.getElementById('tp').value=t;
    document.getElementById('lt').value=l;

  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
</script>

</body>
</html>

<!-- <file src="{{$i}}"></file> -->

<!-- {{$fn}} -->
<!-- <img src="/Users/shariyarmalik/myprojects/testgit/storage/app/public/OXMeHsPfVXL1AKip3ruuZmCWtKHSN5nnT8hw9QP0.jpg"> -->