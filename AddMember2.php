<!--
Description: Adds a member to the currently logged account.
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
} 
else {
	echo 'Your account has expired. Please renew it.<br><br>
	<a href="extendmembership.php" class="button">Extend</a><br><br>';
	
}
?>
<input class="button" type="button" value="Back" onclick="location.href='AddMember.php?<?php echo htmlspecialchars(SID); ?>' ">
<input class="button" type="button" value="Main Menu" onclick="location.href='UserIndex.php?<?php echo htmlspecialchars(SID); ?>' ">
</body>
</html>
