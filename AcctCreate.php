<html>
<head><title>New Wave Cinema: Account Information</title></head>
<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
//Setup variables
$host = "";
$user = "groupE";
$password = "cmps460";
$database = "cs4601_groupE";

//Get Variables from signup.html
$mmbrName = $_POST['mmbrName'];
$mmbrAge = $_POST['mmbrAge'];
$mmbrAddr = $_POST['mmbrAddr'];
$mmbrPhone = $_POST['mmbrPhone'];
$mmbrEmail = $_POST['mmbrEmail'];
$mmbrPass = $_POST['mmbrPass'];
$mmbrLength = $_POST['mmbrLength'];
$mmbrPrice = intval(substr($mmbrLength,0,3));

//connect to database
$connect = mysql_connect($host,$user,$password)
	 or die("Unable to connect to database");
@mysql_select_db($database) or die("Unable to select database");

//Create new account number
function generateAccount(){
	$characters = '0123456789';
	$char_len = strlen($characters);
	$acct = '';
	for ($i =0;$i<9;$i++){
		$acct .= $characters[rand(0,$char_len-1)]; 
	}
	return $acct;
}
$mmbrAcct = generateAccount();
$query = 'SELECT account_no
			FROM nwc_membership
			WHERE account_no = $mmbrAcct';
$acctCheck = mysql_query($query);

if ($acctCheck){
    	while (mysql_num_rows($acctCheck) > 0){
    	$mmbrAcct = generateAccount();
    	$acctCheck = mysql_query($query);
    	if (!$acctCheck){
    		break;
    	}
    }
}


//Get start(current) date and expiration date
$start_date = date('Y-m-d');
$expire_date = date('Y-m-d',strtotime('+'. $mmbrLength));

/*$q = "insert into nwc_membership (account_no,start_date,expire_date,password) 
values(111111111,'$start_date','$expire_date','bullocks')";
$eq = mysql_query($q);
if ($eq) {
	print "It worked?<br>";
} else {
	print "Nope <br>";
}*/

//Add account to database
$query = "INSERT INTO nwc_membership (account_no,start_date,expire_date,password)
			values('$mmbrAcct','$start_date','$expire_date','$mmbrPass')";
$exec_query1 = mysql_query($query);

//Add member to database and attach to account
$query = "INSERT INTO nwc_member (mb_name,account_no,phone_no,email,age,addr)
			values('$mmbrName', '$mmbrAcct',$mmbrPhone,'$mmbrEmail',$mmbrAge,'$mmbrAddr')";
$exec_query2 = mysql_query($query);

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
<th>Price</th>
</tr>
<tr>
<td>$mmbrAcct</td>
<td>$mmbrPass</td>
<td>$expire_date</td>
<td>$mmbrPrice</td>
<td>
</tr></table>
</body></html>
";

$headers = "MIME-Version: 1.0" . "\r\n" . "Content-type:text/html;charset=UTF-8" . "\r\n";
//See if you can use a fake email for immersion.
$headers .= "From: brandinui@gmail.com" . "\r\n";
mail($mmbrEmail,$subject,$msg,$headers);

//Final information
if ($exec_query1 && $exec_query2){
	print("Account successfully created.<br>");
	print("Your credentials have been sent to the e-mail you provided. <br>");
	print("Account Number: $mmbrAcct <br>");
	print("Password: $mmbrPass <br> <br>");
	print("Please keep track of these, as they are required in order to use our services.<br><br>");
}
else {
	print("There was an error creating your information. Please ensure you've filled everything out.")
}
mysql_close($connect);
?>

<button type="button" onclick="login.html">Log In</button>
<button type="button" onclick="mainmenu.html">Menu</button>

</body></html>
