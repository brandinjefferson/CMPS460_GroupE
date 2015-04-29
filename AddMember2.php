<!--
Description: Adds a member to the currently logged account.
Author: Brandin Jefferson
CLID: bej0843
-->
<html><head>
<title>New Wave Cinema: Add Member</title>
</head>
<body>
<?php
include('connecttophp.php');
include('sessioncore.php');

if (!loggedin() && isValidUser()){
	header("Location: UserIndex.php");
}

//Get variables
$mmbrAcct = $_SESSION['account_no'];
$mmbrName = $_POST['mmbrName'];
$mmbrAge = $_POST['mmbrAge'];
$mmbrAddr = $_POST['mmbrAddr'];
$mmbrPhone = $_POST['mmbrPhone'];
$mmbrEmail = $_POST['mmbrEmail'];
$mmbrPass = $_POST['mmbrPass'];

if (empty($mmbrName)||empty($mmbrAge)||empty($mmbrAddr)||empty($mmbrPhone)||empty($mmbrEmail)&&!empty($mmbrPass)){
	echo "<p>Please complete the information.</p><br>";
}
else {
	//Add member to database and attach to account
	$query = "INSERT INTO nwc_member (mb_name,account_no,phone_no,email,age,addr,main_mb,password)
			values('$mmbrName', '$mmbrAcct',$mmbrPhone,'$mmbrEmail',$mmbrAge,'$mmbrAddr',0,'$mmbrPass')";
	$exec_query = mysql_query($query);
	
	if ($exec_query){
		$query = "SELECT datediff(expire_date,start_date)
					AS diffdate
					FROM nwc_membership
					WHERE account_no = '$mmbrAcct'";
		$result = mysql_fetch_assoc(mysql_query($query));
		$mmbrPrice = '$' . $result["diffdate"] . '.00';
		echo '<p>' . $mmbrName . ' successfully added to account ' . $mmbrAcct. '</p><br>
				<p>Price: '. $mmbrPrice . '</p><br><br>';
	}
}
?>
<input type="button" value="Back" onclick="location.href='AddMember.php?<?php echo htmlspecialchars(SID); ?>' ">
<input type="button" value="Main Menu" onclick="location.href='UserIndex.php?<?php echo htmlspecialchars(SID); ?>' ">
</body>
</html>
