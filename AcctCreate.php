<html>
<head><title>New Wave Cinema: Account Information</title></head>
<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

//Get Variables from signup.html
$mmbrName = $_POST['mmbrName'];
$mmbrAge = $_POST['mmbrAge'];
$mmbrAddr = $_POST['mmbrAddr'];
$mmbrPhone = $_POST['mmbrPhone'];
$mmbrEmail = $_POST['mmbrEmail'];
$mmbrPass = $_POST['mmbrPass'];
$mmbrLength = $_POST['mmbrLength'];

//connect to database

//Create new account number
function generateAccount(){
	$characters = '0123456789';
	$char_len = strlen($characters);
	$acct = '';
	for ($i =0;$i<10;$i++){
		$acct .= $characters[rand(0,$char_len-1)]; 
	}
	return $acct;
}
$mmbrAcct = generateAccount();
$query = 'SELECT account_no
			FROM nwc_membership
			WHERE account_no = $mmbrAcct';
$acctCheck = mysql_query($query);
if (!$acctCheck){
	die('Account check failed to execute.');
}

while (mysql_num_rows($acctCheck) > 0){
	$mmbrAcct = generateAccount();
	$acctCheck = mysql_query($query);
	if (!$acctCheck){
		die('Account check failed to execute.');
	}
}

//Get start(current) date and expiration date
$start_date = date('Y-m-d');
$expire_date = date('Y-m-d',strtotime(+$mmbrLength));

//Add account to database
$query = 'INSERT INTO nwc_membership
			values($mmbrAcct,$expire_date,$start_date)';
mysql_query($query);
//Add member to database and attach to account
$query = 'INSERT INTO nwc_membership
			values($mmbrName, $mmbrAcct,$mmbrPhone,$mmbrEmail,$mmbrAddr)';
mysql_query($query);
//Send email containing account information.
$subject = "New Wave Cinema Account Information";
$msg = "
<html><head>
<title>Account Information</title>
</head>
<body>
<p>Thank you for registering with the New Wave Cinema!<br>
Your account information is listed below.<br><br> </p>
<table>
<tr>
<th>Account Number</th>
<th>Password</th>
<th>Expiration Date</th>
</tr>
<tr>
<td>$mmbrAcct</td>
<td>$mmbrPass</td>
<td>$expire_date</td>
</tr></table>
</body></html>
";

$headers = "MIME-Version: 1.0" . "\r\n" . "Content-type:text/html;charset=UTF-8" . "\r\n";
//See if you can use a fake email for immersion.
$headers .= "From: brandinui@gmail.com" . "\r\n";
mail($mmbrEmail,$subject,$msg,$headers);

//Final information
print("Account successfully created.<br>");
print("Your credentials have been sent to the e-mail you provided. <br>");
print("Account Number: $mmbrAcct <br>");
print("Password: $mmbrPass <br> <br>");
print("Please keep track of these, as they are required in order to use our services.<br><br>");
?>

<button type="button" onclick="login.html">Log In</button>
<button type="button" onclick="mainmenu.html">Menu</button>

</body></html>