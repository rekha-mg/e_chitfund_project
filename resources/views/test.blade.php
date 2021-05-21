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
	 $(document).ready(function() {
     var d = new Date();
     var YYYY = d.getFullYear();
     var YY = YYYY.toString().substring(2);
     var MM = ("0" + (d.getMonth() + 1)).slice(-2);
     var DD = ("0" + d.getDate()).slice(-2);
     alert(MM);
});
	}

	$(document).ready(function(){

$('#dd').change(function(){
  
  var dt = new Date( $(this).val());
  var year = dt.getFullYear();
  var month =  (dt.getMonth() < 10 ? '0' : '') + (dt.getMonth()+1);
  var day = (dt.getDate() < 10 ? '0' : '') + dt.getDate();


  alert(month);
})
});
	
</script>
	
<label>Paid Date</label><input type="date" id="dd">
<br>
<br>
<input type="submit" onclick="display();">
<h1> {{session('my_name') }} </h1>

