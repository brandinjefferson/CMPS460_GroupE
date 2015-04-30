<!--
Description: Receives information to add a member to an account. If the user is not the primary member of the account, then the page only displays a button back to the main menu and a message.
Author: Brandin Jefferson
CLID: bej0843
-->
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

</style>
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
if (isValidUser()){
	
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
}
else {
	echo 'Your account has expired. Please renew it.<br><br>
	<a href="extendmembership.php" class="button">Extend</a><br><br>';
	
}
?>

<!--<input type="button" value="Main Menu" onclick="location.href='UserIndex.php?<?php echo htmlspecialchars(SID); ?>' ">-->
<a href="UserIndex.php" class="button">Main Menu</a>
</body>
</html>
