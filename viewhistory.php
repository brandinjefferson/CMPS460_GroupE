<!-- www.w3schools.com/Ajax/default.asp 
stackoverflow.com/questions/11771774/creating-select-list-from-database -->
<html>
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

//Get current account number from session id
$mmbrAcct = $_SESSION['user_id'];
//$mmbrAcct = '990466567';

//Form query
$q = "SELECT mb_name FROM nwc_member WHERE account_no = '$mmbrAcct'";
$result = mysql_query($q);

//Show all members related to the account. 
print '<center><form action="GetHistory.php" method="GET"><select name="mmbrName">';
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


?>
<input type="button" value="Main Menu" onclick="location.href='UserIndex.php?<?php echo htmlspecialchars(SID); ?>'">
</body>
</html>


