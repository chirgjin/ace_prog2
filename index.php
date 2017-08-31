<html>
	<head>
		<title>Web API</title>
		<link rel='stylesheet' href='css/bootswatch.css' />
		<style>
			code { display:block; }
		</style>
	</head>
	<body class='container' >
		<h3 align='center' class='alert alert-danger' >Web API to Find Shortest Route</h3>
		
		This web API accepts parameters via POST or GET request and provides JSON result.<br>
		
		<table class='table table-bordered table-striped' >
			<thead>
				<tr>
					<th>Parameter
					<th>Value Type
					<th>Required
					<th>Description
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>origin
					<td>Coordinates
					<th>Yes
					<th>Origin is the coordinates of origin/starting point of route.Example: (0,0)
				</tr>
				<tr>
					<td>routes
					<td>Array of Coordinates
					<td>Yes
					<td>Routes is an array where each element of array contains 2-n coordinates.Examples: routes[]=(0,0),(0,1),(1,0),(5,10)
				</tr>
				<tr>
					<td>format
					<td>string
					<td>No.Defaults to "json"
					<td>"json" format returns coordinates as an array while "string" format returns coordinates as an array containing string coordinates.
				</tr>
			</tbody>
		</table>
		
		<h3>Examples:</h3>
		
		<code>GET distance-api.php?origin=(0,0)&routes[]=(1,1),(2,5),(5,6)&routes[]=(2,5),(8,8),(5,6)</code>
		Output:
		<code is-json='true' >{"1":[[1,1],[2,5],[5,6]],"2":[[2,5],[8,8],[5,6]],"status":"Success","Success":true}</code>
		<hr><br>
		
		<code>GET distance-api.php?origin=(0,0)&routes[]=(1,1),(2,5),(5,6)&routes[]=(2,5),(8,8),(5,6)&format=json</code>
		Output:
		<code is-json='true' >{"1":[[1,1],[2,5],[5,6]],"2":[[2,5],[8,8],[5,6]],"status":"Success","Success":true}</code>
		<hr><br>
		
		<code>GET distance-api.php?origin=(0,0)&routes[]=(1,1),(2,5),(5,6)&routes[]=(2,5),(8,8),(5,6)&format=string</code>
		Output:
		<code is-json='true' >{"1":["1,1","2,5","5,6"],"2":["2,5","8,8","5,6"],"status":"Success","Success":true}</code>
		<hr><br>
		
		<code>$.post( "distance-api.php" , { origin : "(1,1)" , routes : [ "(5,2),(6,4),(9,9)" , "(2,4),(5,7),(9,9)" , "(4,5),(2,3),(9,9)" ] , format : "json" });</code>
		Output:
		<code is-json='true' >{"1":[[2,4],[5,7],[9,9]],"2":[[5,2],[6,4],[9,9]],"3":[[4,5],[2,3],[9,9]],"status":"Success","Success":true}</code>
		<hr><br>
		
		<code>GET distance-api.php?routes[]=(1,1),(2,5),(5,6)&routes[]=(2,5),(8,8),(5,6)</code>
		Output:
		<code is-json='true' >{"status":"Error","message":"origin is required!","Success":false}</code>
		<hr><br>
		
		<code>GET distance-api.php?routes=(1,1),(2,5),(5,6)&origin=(2,2)</code>
		Output:
		<code is-json='true' >{"status":"Error","message":"`routes` parameter must be an Array","Success":false}</code>
		
	</body>
</html>
