<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Database Connection</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="qbuilder">

		<fieldset>
			<legend>Create Database Connection</legend>
			<label for="server">Host</label>
			<input type="text" name="server" id="server"> <small>(server host)</small> 
			<br>
			<label for="username">Username</label>
			<input type="text" name="username" id="username"> <small>(host username)</small> 
			<br>
			<label for="password">Password</label>
			<input type="password" name="password" id="password"> <small>(host password)</small> 
			<br>
			<label for="database">Database</label>
			<input type="text" name="database" id="database"> <small>(database)</small> 

			<button onclick=connect(); value="Show Query">Create connection</button>
			
			<script>
				function connect()
				{
					var result=document.getElementById('qresult');
					var server=document.getElementById('server').value;
					var username=document.getElementById('username').value;
					var password=document.getElementById('password').value;
					var database=document.getElementById('database').value;

					result.innerHTML="<p><b>$con</b> = <em>mysqli_connect</em>('" + server + "', '" + username + "', '" + password + "', '" + database + "');"
					+ "<br>&nbsp;&nbsp;if (<em>mysqli_connect_errno</em>())<br>" +
					"&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;echo &quot;Failed to connect to MySQL: &quot; . <em>mysqli_connect_error</em>();<br>&nbsp;&nbsp;}" + "<br></p>";
				}
			</script>
		</fieldset>

		<fieldset>
			<legend>LIMIT is used to specify the number of records to return.</legend>
			SELECT <input type="text" name="limitcolumn" id="limitcolumn"> <small>(* or column)</small> 
			<br>FROM <input type="text" name="limittable" id="limittable"> <small>(table)</small> 
			<br>LIMIT <input type="text" name="limitnumber" id="limitnumber"> <small>(#)</small>
			<button onclick=limit(); value="Show Query">Show LIMIT Query</button>
			<div class="result" id="limitresult">Result</div>
			<script>
				function limit()
				{
					var connectresult=document.getElementById('qresult');
					var result=document.getElementById('limitresult');
					var limitcolumn=document.getElementById('limitcolumn').value;
					var limittable=document.getElementById('limittable').value;
					var limitnumber=document.getElementById('limitnumber').value;

					result.innerHTML="SELECT " + limitcolumn + " FROM " + limittable + " LIMIT " + limitnumber;

					connectresult.innerHTML = "<p>" + connectresult.innerHTML + "<b>$result</b> = <em>mysqli_query</em>(<b>$con</b>,&quot;" + result.innerHTML + "&quot;);<br>" + 
					"while(<b>$row</b> = <em>mysqli_fetch_array</em>(<b>$result</b>))<br>" + "{<br>&nbsp;&nbsp;echo <b>$row</b>['" + limitcolumn + "']<br>};</p>";

				}
			</script>
		</fieldset>

		<fieldset>
			<legend>The AND / OR operators are used to filter records based on more than one condition.</legend>
			SELECT * FROM <input type="text" name="andortable" id="andortable"> <small>(table)</small>  
			<br>WHERE 
			<br><input type="text" name="andorcolumn1" id="andorcolumn1"> <small>(column)</small> 
			= <input type="text" name="andorcolumn1value" id="andorcolumn1value"> <small>(value)</small>  
			<br><select name="andoroperator" id="andoroperator">
				<option value="AND">AND</option>
				<option value="OR">OR</option>
			</select> 
			<br><input type="text" name="andorcolumn2" id="andorcolumn2"> <small>(column)</small> 
			= <input type="text" name="andorcolumn2value" id="andorcolumn2value"> <small>(value)</small> 
			<button onclick=andor(); value="Show Query">Show AND/OR Query</button>
			<div class="result" id="andorresult">Result</div>
			<script>
				function andor()
				{
					var connectresult=document.getElementById('qresult');
					var result=document.getElementById('andorresult');
					var andortable=document.getElementById('andortable').value;
					var andorcolumn1=document.getElementById('andorcolumn1').value;
					var andorcolumn1value=document.getElementById('andorcolumn1value').value;
					var andoroperator=document.getElementById('andoroperator').value;
					var andorcolumn2=document.getElementById('andorcolumn2').value;
					var andorcolumn2value=document.getElementById('andorcolumn2value').value;

					result.innerHTML="SELECT * FROM " + andortable + " WHERE " + andorcolumn1 + "='" + andorcolumn1value + "' " + andoroperator + " " + andorcolumn2 + "='" + andorcolumn2value + "'";

					connectresult.innerHTML = "<p>" + connectresult.innerHTML + "<b>$result</b> = <em>mysqli_query</em>(<b>$con</b>,&quot;" + result.innerHTML + ");<br>" + 
					"while(<b>$row</b> = <em>mysqli_fetch_array</em>(<b>$result</b>))<br>" + "{<br>&nbsp;&nbsp;echo <b>$row</b>['" + andorcolumn1 + "'];<br>&nbsp;&nbsp;echo <b>$row</b>['" + andorcolumn2 + "'];<br>};</p>";

				}
			</script>
		</fieldset>
	</div><br>
	<fieldset id="qresultcont">
	<legend>Result</legend>
	<div class="qresult" id="qresult">
		
	</div>
	</fieldset>

</body>
</html>