<?php

if(isset($_GET['submit']))
{
  $tp = $_GET['tp'];
  $lt = $_GET['lt'];
  $sy = $_GET['sy'];
  $tex = $_GET['tex'];
  $in = $_GET['in'];
  
  $pn = trim($in,"public");
  $pn = "/storage".$pn;
  $pn = public_path($pn);
  

  // $pdf = new \setasign\Fpdi\Fpdi('l');
  $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', 'A4');

  // Reference the PDF you want to use (use relative path)
$pagecount = $pdf->setSourceFile($pn);
// echo "<script>alert('$pagecount');</script>";

// for ($j=1; $j<=($pagecount); $j++) {
//   $pdf->AddPage();
//   $import_page = $pdf->ImportPage($j);
//   $pdf->UseTemplate($import_page);
// }

// Import the first page from the PDF and add to dynamic PDF
$tpl = $pdf->importPage(1);

$pdf->AddPage();

// Use the imported page as the template
$pdf->useTemplate($tpl);

$pdf->SetFont('Times','B');
// $w = strlen($tex)+10;
$s = $pdf->GetStringWidth($tex);

// First box - the user's Name
$pdf->SetFontSize('11'); // set font size

$lt = $lt + $sy;
$pdf->SetXY($tp, $lt); // set the position of the box
$pdf->Cell(30, 4, $tex, 0, 0, 'L'); // add the text, align to Center of cell


ob_get_clean();
// render PDF to browser 
$pdf->Output('F',$pn);

}

// if(array_key_exists('button1', $_GET)) { 
//   $in = $_GET['in'];
//   button1(); 
// } 
// function button1() { 
//   $in = $_GET['in'];
//   $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', 'A4');
//   $pn = trim($in,"public");
//   $pn = "/storage".$pn;
//   $pn = public_path($pn);
//   $pagecount = $pdf->setSourceFile($pn);
//   $tpl = $pdf->importPage(2);

// $pdf->AddPage();

// // Use the imported page as the template
// $pdf->useTemplate($tpl);
//   // echo "This is Button1 that is selected"; 
//   $pdf->Output('F',$pn);
// } 





$fn = trim($in,"public");

$i = "http://127.0.0.1:8000/storage".$fn;


?> 

<!DOCTYPE html>
<html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>

body{
  margin:0px;
}
#mydiv {
  width:50px;
  position: absolute;
  z-index: 9;
  /* background-color: #f1f1f1; */
  text-align: center;
  border: 1px solid #d3d3d3;
}

#mydivheader {
  padding: 2px;
  cursor: move;
  z-index: 10;
  /* background-color: #2196F3; */
  color: #fff;
}
</style>
</head>
<body>


<!-- <button onclick="testfn()" style="margin-bottom:50px;">BTN</button> -->
<!-- <p id="demo">Hi</p> -->
<!-- <input type="submit" name="submit" value="SUBMIT" id="textform"> -->
<!-- </form> -->
<!-- </div> -->

<!-- <div id="tp">
</div> -->

<!-- <iframe src="{{$i}}" width="100%" height="500"></iframe> -->


<!-- <h1>Draggable DIV Element</h1> -->

<div id="pd" style="position:fixed;background-color:grey;width:800px;">
<p style="margin-top:10px;margin-left:5px;color:white;">Click and hold the mouse button down while moving the TEXT element</p>

<div id="mydiv">
  <div id="mydivheader">Text</div>
</div>
<form method="GET" style="margin-left:5px;">
<input type="text" id="tp" name="tp" value=0  style="display:none;">
<input type="text" id="lt" name="lt" value=0 style="display:none;">
<input type="text" id="sy" name="sy" value=0 style="display:none;">
<input type="text" id="in" name="in" value="<?php echo $in;?>" style="display:none;">
<input type="text" id="tex" name="tex" style="visibility: hidden;">
<button type="submit" value="submit" name="submit">Submit</button> 
<!-- <form method="post"> 
    <input type="submit" name="button1"
            class="button" value="Button1" /> 
</form>  -->
 
</div>

<iframe id="ifr" name="ifr" src="{{$i}}#toolbar=0&navpanes=0&scrollbar=0" frameborder="0" scrolling="no" style="width:800px; height:1180px;margin-top:65px;"></iframe>
<!-- height="650" -->

<!-- <div style="visibility: hidden;" id="formnew1"> -->
<!-- <form id="textform" method="post" action=""> -->
<!-- <form method="GET"> 
    <input type="submit" name="button1"
            class="button" value="Button1" /> 
            <input type="text" id="in" name="in" value="<?php echo $in;?>" style="display:none;">

</form>  -->


<script>


// document.getElementById("ifr").marginwidth = "0";
//Make the DIV element draggagle:
var p = dragElement(document.getElementById("mydiv"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0, t=0, l=0;
  if (document.getElementById(elmnt.id + "header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown; //(elmnt.id + "header") becomes mydivheader.
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


    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  
  }

  function closeDragElement() {
    
   
    var ifrDiv = document.getElementById("ifr");
    var demoDiv = document.getElementById("mydiv");
    const eleifrDiv = ifrDiv.getBoundingClientRect();
    const eledemoDiv = demoDiv.getBoundingClientRect();
    ifto = ifrDiv.offsetLeft;
    iflo = ifrDiv.offsetTop; 
    // console.log(ifto,iflo);
    to = demoDiv.offsetLeft;
    lo = demoDiv.offsetTop;
    
    dt = demoDiv.offsetLeft;
    dl = demoDiv.offsetTop;
    // console.log(dt,dl);

    t = eledemoDiv.left;
    t = t-6;
    // t = t-79;
    l = eledemoDiv.top;
    l=l-64;
    // console.log(t,l);

    document.getElementById('tp').value= (t * 0.2645);
    document.getElementById('lt').value= (l * 0.2645);

    document.onmouseup = null;
    
    document.onmousemove = null;
    
    document.getElementById('tex').style.visibility="visible";
    // myFunction();
  }

}

window.addEventListener("scroll", (event) => {
     var sy = this.scrollY;
     sy = sy * 0.2645;
     document.getElementById('sy').value= (sy);
    console.log(sy);
});


</script>

</body>
</html>