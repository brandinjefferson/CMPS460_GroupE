<html>
<head>
<title>New Wave Cinema: Add Member</title>
</head>
<body>
<?php 
include('connecttophp.php');
include('sessioncore.php');
if (!loggedin()){
	header("Location: UserIndex.php");
}
$curAcct = $_SESSION['user_id'];
$curName = $_SESSION['user_name'];

$query = 'SELECT main_mb FROM nwc_member WHERE account_no = "$curAcct" AND mb_name = "$curName"';
$exec_query = mysql_query($query);
if ($exec_query == 0){
	echo "You must be a primary member to add other members.<br><br>"
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
