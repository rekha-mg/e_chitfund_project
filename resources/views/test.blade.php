<?php 





?>
<html>

<head>
<title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
<script type="text/javascript">
	function display(){
		/*var paid,due;
		paid= $('#dd').val();
		due=$('#dd2').val();


		if( paid > due ){
			alert("is late paid");
		}else{
			alert("no ");
		}

		var d = new Date();
		d.setMonth(8,1);
		//d.getMonth(); //outputs 8
		//alert(paid.getMonth());*/


		

	}
	
</script>
	
<label>Paid Date</label><input type="date" id="dd">
<br>
<label>Due Date</label><input type="date" id="dd2">
<br>
<input type="submit" onclick="display();">
<h1> {{session('my_name') }} </h1>
}
