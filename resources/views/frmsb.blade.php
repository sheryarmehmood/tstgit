<?php

if(isset($_POST['submit']))
{
  
  $name = $_POST['name'];
  echo $name; 
} 

?>

	
<!DOCTYPE html>
<html>
<head>
	<title>Ajax form submit without reloading page</title>
	<style type="text/css">
form {
text-align: center;
padding: 26px;
margin: 11px;
}
div {
    padding: 15px;
}
h1 {
    text-align: center;
}
	</style>
</head>
<body>
<h1>This is the simple form using Ajax</h1>
<form method="POST" action="#">
    @csrf
	<div>
	<label>Name</label>
	<input type="text" id="name" name="name">
	</div>
	<div>
	<label>Mobile No</label>
	<input type="text" id="mobile" name="mobno">
	</div>
	<div>
	<label>address</label>
	<input type="text" id="address" name="address">
	</div>
	<div>
	<label>city</label>
	<input type="text" id="city" name="city">
	</div>
	<button type="submit" value="submit" name="submit">Submit</button>
</form>
</body>
</html>

<script>
	$(document).ready(function(){
		$('button').click(function(event){
			event.preventDefault();
			var	name = $('#name').val();
			var	mobile = $('#mobile').val();
			var	address = $('#address').val();
			var	city = $('#city').val();
			$.ajax({
			    type: "POST",
			    data: { name:name, mobile:mobile, address:address, city:city },		    
			    dataType: "json",
			    success: function(result){
			    }
			});
		});
	});
</script>