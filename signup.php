<!--
Description: Gets information for creating a membership. Leads to AcctCreate.php
Author: Brandin Jefferson
CLID: bej0843
-->
<html>
<head>
<title>New Wave Cinema: Register</title>

</head>
<body>
<h2>Please enter all fields to have your membership created.</h2>
<form action="AcctCreate.php" method="POST">
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

Length <br>
<select name="mmbrLength">
<option value="30 days" selected>30 Days</option>
<option value="90 days">90 Days</option>
<option value="180 days">180 Days</option>
<option value="365 days">365 Days</option>
</select>
<br><br>
Password <br>
<input type="password" size="30" name="mmbrPass">
<br><br>
<input type="submit" value="Register"> <br> <br> <br>
</form>
<input type="button" value="Log In" onclick="location.href='UserIndex.php' ">
</body>
</html>
