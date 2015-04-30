<!--
Description: This file allows users to extend their memberships. It takes the total number of people within the account and multiplies it by the difference between the current expiration date and new expiration date to find the price.
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
<title>New Wave Cinema: Extension</title>
</head>
<body>
<?php

include('connecttophp.php');
include('sessioncore.php');
if (!loggedin()){
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
	echo '<center>
	Extend By ($1 = 1 Day):
	<form action="" method="POST">
	<select name="mmbrLength" class="dropdown">
	<option value="30 days" selected>30 Days</option>
	<option value="90 days">90 Days</option>
	<option value="180 days">180 Days</option>
	<option value="365 days">365 Days</option>
	</select><br>
	<input type="submit" value="Submit"> <br> <br> <br>
	</form>
	';
	
	if (!empty($_POST)){
		$length = $_POST['mmbrLength'];
		$query = "SELECT expire_date FROM nwc_membership WHERE account_no= '".$curAcct."'";
		$result1 = mysql_fetch_assoc(mysql_query($query));
		$realexpdate = date($result1['expire_date']);
		$expdate = $realexpdate;
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
    	<td>' . $realexpdate . '</td>
    	<td>' . $newexpdate . '</td>
    	<td>' . $price . '</td>
		</tr>
		</table><br>
		';
		
		$query = "UPDATE nwc_membership  
						SET expire_date = '" . $newexpdate . "' 
						WHERE account_no = '" . $curAcct . "'";
		$result = mysql_query($query);
		if ($result ) echo '<br>Membership extended.<br><br></center>';
		else echo '<br>Error adding membership.<br><br></center>';
		
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

<input type="button" class="button" value="Main Menu" onclick="location.href='UserIndex.php?<?php echo htmlspecialchars(SID); ?>'">
</body>
</html>
