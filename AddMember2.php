<html><head>
<title>New Wave Cinema: Add Member</title>
</head>
<body>
<?php
include('connecttophp.php');
include('sessioncore.php');

if (!loggedin()){
	header("Location: UserIndex.php");
}

//Get variables
$mmbrAcct = $_SESSION['user_id'];
$mmbrName = $_POST['mmbrName'];
$mmbrAge = $_POST['mmbrAge'];
$mmbrAddr = $_POST['mmbrAddr'];
$mmbrPhone = $_POST['mmbrPhone'];
$mmbrEmail = $_POST['mmbrEmail'];
$mmbrPass = $_POST['mmbrPass'];

if (empty($mmbrName)||empty($mmbrAge)||empty($mmbrAddr)||empty($mmbrPhone)||empty($mmbrEmail)){
	echo "<p>Please complete the information.</p><br>";
}
else {
	//Add member to database and attach to account
	$query = "INSERT INTO nwc_member (mb_name,account_no,phone_no,email,age,addr,main_mb,password)
			values('$mmbrName', '$mmbrAcct',$mmbrPhone,'$mmbrEmail',$mmbrAge,'$mmbrAddr',0,'$mmbrPass')";
	$exec_query = mysql_query($query);
	
	if ($exec_query){
		$query = "SELECT expire_date
					FROM nwc_membership
					WHERE account_no = '$mmbrAcct'";
		$curdate = date_create(date('Y-m-d'));
		$expdate = date_create('$query');
		$mmbrPrice = '$' . date_diff($curdate,$expdate)->format('%a') . '.00';
		echo '<p>$mmbrName successfully added to account $mmbrAcct.</p><br>
				<p>Price: $mmbrPrice</p><br><br>';
	}
}
?>
<input type="button" value="Back" onclick="location.href='AddMember.php?<?php echo htmlspecialchars(SID); ?>' ">
<input type="button" value="Main Menu" onclick="location.href='UserIndex.php?<?php echo htmlspecialchars(SID); ?>' ">
</body>
</html>
