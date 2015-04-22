<?php
//Figure out how to load query into a database to use in select list
session_start();

//Get variables; name from viewhistory.html, mmbrAcct from mainmenu.html
$name = $_REQUEST['name'];
$mmbrAcct = $_SESSION['mmbrAcct'];

//Log in to mysql
error_reporting(E_ALL);
ini_set("display_errors", 1);
$host = "";
$user = "bej0843";
$password = "cmps460";
$database = "cs4601_groupE";
$connect = mysql_connect($host,$user,$password)
	 or die("Unable to connect to database");
@mysql_select_db($database) or die("Unable to select database");

//Generate and run query
if ($name != "All") {
	$query = "SELECT s.title, s.start_time
				FROM nwc_showing s, nwc_reserved r
				WHERE r.mb_name = $name AND 
						s.t_id = r.t_id AND
						r.account_no = $mmbrAcct";
}
else $query = "SELECT s.title, s.start_time
				FROM nwc_showing s, nwc_reserved r
				WHERE s.t_id = r.t_id AND
						r.account_no = $mmbrAcct";
$results = mysql_query($query);

//Show results in an html table
if($results)
{
	print '<center>';
   print '<table border=1>';
   print '<th style="width:300px">NAME<th style="width:300px">MOVIE
				<th style="width:80px">TIME';
   // Get each row of the result
   while ($row = mysql_fetch_row($results))
   {
      print '<tr>';
      // Get each attribute in the row
      foreach($row as $attribute)
      {
         print "<td>$attribute</td> ";
      }
      print '</tr>';
   }
   print '</center>';
}
else
{
   // Display the query and the MySQL error message
   print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
   die (mysql_error());
}
mysql_close($connect);	

>