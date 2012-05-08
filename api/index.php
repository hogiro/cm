<html>
	<head>
		<title>API TEST</title>
		<script src="lib/jquery-1.7.1.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$("#searchForm").submit(function(event){
				event.preventDefault();
				//alert($(this).serialize());
				dataString = $("#searchForm").serialize();
				$.ajax({
					type:"POST",
					url: "apiGetData.php",
					data: dataString,
					dataType: "json",
					success: function(data) {
						$("#showResult").html('<div>Ergebnis:'+data.impressions+ '</div>');
					}
				});
			});
			});
		</script>
	</head>
	<body>
	<form id="searchForm" name="searchForm" action="apiGetData.php" method="POST">
		<label>Werbetreibender: </label><br /><input type="text" name="advertiserId" id="advertiserId" />
		<label>Kampagne: </label><input type="text" name="campaignId" id="campaignId" />
		<label>Banner: </label><input type="text" name="bannerId" id="bannerId" />
		<input type="submit" name="Submit" value="Send" />
	</form>	
		
<div id="showResult"></div>
		

	</body>
</html>
