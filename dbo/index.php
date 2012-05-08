<html>
	<head>
		<title>DB Operations</title>
		<script src="../lib/jquery-1.7.2.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$("#dboperations").submit(function(event){
				event.preventDefault();
				//alert($(this).serialize());
				dataString = $("#dboperations").serialize();
				$.ajax({
					type:"POST",
					url: "dbrun.php",
					data: dataString,
					dataType: "json",
					success: function(data) {
						$("#showResult").html('<div>Ergebnis:'+data.respond+ '</div><div>Result:'+data.rows[0]['name']+'</div>');
					}
				});
			});
			});
		</script>
	</head>
	<body>
			<form id="dboperations" name="dboperations" action="dbrun.php" method="POST">
		<label>SQL-Command: </label><br /><textarea type="text" name="sql" id="sql" style="height:300px;width:600px"></textarea>
		<br />
		<input type="submit" name="Submit" value="Send" />
	</form>	
		
<div id="showResult"></div>
	</body>
	
</html>