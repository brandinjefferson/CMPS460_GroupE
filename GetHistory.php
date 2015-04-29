<!-- No longer being used -->
<html><head>
<title>New Wave Cinema: View History</title>
</head><body>
<?php
//Resume the session
session_start();

//Log in to mysql
include('sessioncore.php');
include('connecttophp.php');

if (!loggedin()){
	header("Location: UserIndex.php");
}

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
   print '<table border=1>';
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
   print '</center>';
}
else
{
   // Display the query and the MySQL error message
   print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
   die (mysql_error());
}

print '</table><br><br>';
//echo '<input type="button" value="Back" onclick="location.href=' . "'viewhistory.php?" . SID . "'" . '">';
?>
<input type="button" value="Back" onclick="location.href='viewhistory.php?<?php echo htmlspecialchars(SID); ?>'">
<input type="button" value="Main Menu" onclick="location.href='UserIndex.php?<?php echo htmlspecialchars(SID); ?>'">
</body></html>

