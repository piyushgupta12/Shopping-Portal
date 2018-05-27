<html>
<head>
<title>Check box experiment</title>
<script src="../lugtu_main_site/js/jq-1.11.js" type="text/javascript"></script>
</head>
<body>
<div id="main_container">

<div id="container">
Nokia<input type="checkbox" name="comp" class="comp" value="Nokia" /><br />
Samsung<input type="checkbox" name="comp"  class="comp" value="Samsung" /><br />
HTC<input type="checkbox" name="comp"  class="comp" value="HTC" /><br />
Apple<input type="checkbox" name="comp" class="comp" value="Apple" /><br />
</div>

<div id="result"></div>

</div>
</body>

<script>
$(document).ready(function(){
	
$('.comp').click(function(){
	console.log("click");
	var companies=[];
	$("#container input:checked").each(function(){
		var cname=$(this).attr('value');
		companies.push(cname);	
		
	
		});
		
	console.log("compainies="+companies);	
	
	$.post('ref_checkbox.php',{comp:companies},function(data){
		console.log(data);
		});
	
});
	
	
});
</script>

</html>