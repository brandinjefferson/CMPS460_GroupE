<!--
Description: Receives information to add a member to an account. If the user is not the primary member of the account, then the page only displays a button back to the main menu and a message.
Author: Brandin Jefferson
CLID: bej0843
-->
<html>
<head>
<title>New Wave Cinema: Add Member</title>
</head>
<body>
<?php 
include('connecttophp.php');
include('sessioncore.php');
if (!loggedin() && isValidUser()){
	header("Location: UserIndex.php");
}
$curAcct = $_SESSION['account_no'];
$curName = $_SESSION['user_name'];

$query = 'SELECT * FROM nwc_member WHERE account_no = "' . $curAcct.'" AND mb_name = "'.$curName . '" and main_mb=1';
$exec_query = mysql_fetch_assoc(mysql_query($query));

if (!$exec_query['main_mb']){
	echo "You must be a primary member to add other members.<br><br>";
}
else {
	echo '
	<h2>Please enter all fields to add member.</h2>
	<form action="AddMember2.php" method="POST">
	Name<br>
	<input type="text" name="mmbrName">
	<br><br>

	Age<br>
	<input type="text" size="3" name="mmbrAge">
	<br><br>

	Address <br>
	<input type="text" name="mmbrAddr">
	<br><br>

	Phone<br>
	<input type="text" size="10" name="mmbrPhone">
	<br><br>

	Email <br>
	<input type="text" name="mmbrEmail">
	<br><br>

	Password <br>
	<input type="password" size="30" name="mmbrPass">
	<br><br>
	<input type="submit" value="Add Member"> <br> <br> <br>
	</form>
	';
}
?>

<input type="button" value="Main Menu" onclick="location.href='UserIndex.php?<?php echo htmlspecialchars(SID); ?>' ">
</body>
</html>
