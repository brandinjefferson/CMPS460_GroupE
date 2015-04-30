<!--
Description: Displays the history of an account or individual member.
Author: Brandin Jefferson
CLID: bej0843
-->
<!-- www.w3schools.com/Ajax/default.asp 
stackoverflow.com/questions/11771774/creating-select-list-from-database -->
<html>
<style type = "text/css">

.header{
     height: 75px;
     background: #0099CC;
     border:1px solid #CCC;
  position: fixed;
    width: 100%;
    top: 0px;
     margin: 0px auto;
     



}

body {
    color: black;
}

co {
    color: #FFFFFF;
}

button, button, button,.button, input[type=submit] {
  border: 0;
  background: #6633CC;
  color: white;
  padding: 8px 14px;
  font-weight: bold;
  font-size: 18px;
  text-decoration: none;
  display: inline-block;
  /* needed for anchors */
  position: relative;
  box-shadow: 1px 0px #3a587f, 0px 1px #4171ae, 2px 1px #3a587f, 1px 2px #4171ae, 3px 2px #3a587f, 2px 3px #4171ae, 4px 3px #3a587f, 3px 4px #4171ae, 5px 4px #3a587f, 4px 5px #4171ae, 6px 5px #3a587f, 5px 6px #4171ae;
}
button:hover, button:focus, button.hover, button.focus, .button:hover, .button:focus, .button.hover, .button.focus, input[type=submit]:hover, input[type=submit]:focus, input[type=submit].hover, input[type=submit].focus {
  transform: translate(2px, 2px);
  box-shadow: 1px 0px #3a587f, 0px 1px #4171ae, 2px 1px #3a587f, 1px 2px #4171ae, 3px 2px #3a587f, 2px 3px #4171ae, 4px 3px #3a587f, 3px 4px #4171ae;
}
button:active, button.active, .button:active, .button.active, input[type=submit]:active, input[type=submit].active {
  transform: translate(4px, 4px);
  box-shadow: 1px 0px #3a587f, 0px 1px #4171ae, 2px 1px #3a587f, 1px 2px #4171ae;
}



body{
  background: #E0E0E0; 
  font-family:'Open Sans',sans-serif;
}
table td, table th {
    font-size: 1em;
    border: 2px solid #7575FF;
    padding: 3px 7px 2px 7px;
}

table th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #751975;
    color: #ffffff;
}

table tr.alt td {
    color: #ffffff;
    background-color: #000000;
}
</style>
<head>
<title>New Wave Cinema: View History</title>
</head>
<body>
<?php
//Resume the session
session_start();

include('sessioncore.php');

//Connect to the database
include('connecttophp.php');

if (!loggedin()){
	header("Location: UserIndex.php");
}
if (isValidUser()){
	//Get current account number from session id
	$mmbrAcct = $_SESSION['account_no'];
	//$mmbrAcct = '990466567';

	//Form query
	$q = "SELECT mb_name FROM nwc_member WHERE account_no = '$mmbrAcct'";
	$result = mysql_query($q);

	//Show all members related to the account. 
	print '<center><form action="" method="GET"><select name="mmbrName">';
	print '<option value = "*">All</option>';
	while ($row=mysql_fetch_array($result)) {
		print "<option value='$row[mb_name]'>$row[mb_name]</option>";
	}
	print "	</select>
		<input type='submit' value='Submit'>
		</form></center>
		<br><br>" ;
			//<br>
			//<div id='chosenName'>Results</div><br>"

	if (!empty($_GET)){
		//Get variables; name from viewhistory.php, mmbrAcct from the session
		$name = $_GET['mmbrName'];
		//For test purposes, use this acct
		//$mmbrAcct = '990466567';
		$mmbrAcct = $_SESSION['account_no'];
		//Generate and run query
		//If a name was chosen, run first query.
		if ($name != "*") {
			$query = "SELECT r.mb_name, s.title, r.day
						FROM nwc_showing s, nwc_reserved r
						WHERE r.mb_name = '$name' AND 
								s.t_id = r.t_id AND
								s.complex_name = r.complex_name AND
								s.start_time = r.time AND
								r.account_no = '$mmbrAcct' AND
								r.day <= CURDATE()
								ORDER BY r.mb_name ASC, s.title ASC";
		}
		else {
			$query = "SELECT r.mb_name,s.title, r.day
						FROM nwc_showing s, nwc_reserved r
						WHERE s.t_id = r.t_id AND
								s.complex_name = r.complex_name AND
								r.account_no = '$mmbrAcct' AND
								r.day <= CURDATE() AND
								s.start_time = r.time
								ORDER BY r.mb_name ASC, s.title ASC";
		}
		$results = mysql_query($query);

		//Show results in an html table
		if($results)
		{
			print '<center>';
		   print '<table>';
		   print '<th style="width:300px">MEMBER
					<th style="width:300px">MOVIE
					<th style="width:100px">DAY';
		   // Get each row of the result
		   while ($row = mysql_fetch_row($results))
		   {
			  print '<tr>';
			  // Get each attribute in the row
			  foreach($row as $attribute)
			  {
				 print "<td>$attribute</td> ";
			  }
			  print '</tr>';
		   }
		}
		else
		{
		   // Display the query and the MySQL error message
		   print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
		   die (mysql_error());
		}

		print '</table><br><br>';
		print '</center>';
	}
}
else {
	echo 'Your account has expired. Please renew it.<br><br>
	<a href="extendmembership.php" class="button">Extend</a><br><br>';
	
}
?>
<input class="button" type="button" value="Main Menu" onclick="location.href='UserIndex.php?<?php echo htmlspecialchars(SID); ?>'">
</body>
</html>


