<!--
Description: This file allows users to extend their memberships. It takes the total number of people within the account and multiplies it by the difference between the current expiration date and new expiration date to find the price.
Author: Brandin Jefferson
CLID: bej0843
-->
<html>
<head>
<title>New Wave Cinema: Extension</title>
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
	echo "You must be a primary member to extend your membership.<br><br>";
}
else {
	echo '
	Extend By ($1 = 1 Day): 
	<form action="" method="POST">
	<select name="mmbrLength">
	<option value="30 days" selected>30 Days</option>
	<option value="90 days">90 Days</option>
	<option value="180 days">180 Days</option>
	<option value="365 days">365 Days</option>
	</select>
	<input type="submit" value="Submit"> <br> <br> <br>
	</form>
	';
	
	if (!empty($_POST)){
		$length = $_POST['mmbrLength'];
		$query = "SELECT expire_date FROM nwc_membership WHERE account_no= '".$curAcct."'";
		$result1 = mysql_fetch_assoc(mysql_query($query));
		$expdate = date($result1['expire_date']);
		if ($expdate < date('Y-m-d'))
			$expdate = date("Y-m-d");
		$newexpdate = date('Y-m-d',strtotime($expdate . '+' . $length));
		
		$query = "SELECT datediff('" . $newexpdate . "','" . $expdate . "') as diffdate";
		$result = mysql_fetch_assoc(mysql_query($query));
		$price = "$" . $result['diffdate'] . ".00";
		
		echo '
		<table border="1">
		<th style="width:300px">OLD
    	<th style="width:300px">NEW
    	<th style="width:100px">PRICE
    	<tr>
    	<td>' . $expdate . '</td>
    	<td>' . $newexpdate . '</td>
    	<td>' . $price . '</td>
		</tr>
		</table><br>
		';
		
		$query = "UPDATE nwc_membership  
						SET expire_date = '" . $newexpdate . "' 
						WHERE account_no = '" . $curAcct . "'";
		$result = mysql_query($query);
		if ($result ) echo '<br>Membership extended.<br>';
		else echo '<br>Error adding membership.<br><br>';
		
		/*<button onclick="extend('. $newexpdate . ','. $curAcct .')">Confirm Extension</button>
		if (!empty($_GET)){
			$query = "UPDATE table nwc_membership 
						SET expire_date = '" . $newexpdate . "'
						WHERE account_no = '" . $curAcct . "'";
			$result = mysql_query($query);
			echo '<br>Membership extended.<br>';
		}*/
	}
}

?>

<input type="button" value="Main Menu" onclick="location.href='UserIndex.php?<?php echo htmlspecialchars(SID); ?>'">
</body>
</html>
