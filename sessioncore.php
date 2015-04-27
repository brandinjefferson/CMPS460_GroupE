<?php

ob_start();
session_start();
$current_file = $_SERVER['SCRIPT_NAME'];

if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){

$http_referer = $_SERVER['HTTP_REFERER'];
}

//////////////FUNCTION TO CHECK TO SEE IF USER IS LOGGED IN ....
function loggedin(){
    
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    
   return true;
    }
   else{
       return false;
   }
}
//////////////FUNCTION TO CHECK TO SEE IF EMPLOYEE IS LOGGED IN ....
function loggedinEmp(){
    
    if (isset($_SESSION['empl_id']) && !empty($_SESSION['empl_id'])){
    
   return true;
    }
   else{
       return false;
   }
}
/////////////////////new
/////////////////////////////////
//////////////////FUNCTION THATS QUERYS DATA BASE TO FIND ATTRIBUTE THAT IS EQUAL TO SESSION VARIABLE FOR MEMBERS.....THIS FUNCTION CAN RETURN ANY SINGLE ATTRIBUTE IN MEMBERS TABLE.
//////////CAN BE USED IN ANYPART OF PROGRAM IF YOU REQUIRE SESSIONCORE.PHP AS USED IN USERINDEX.PHP....THIS IS NEEDED TO START SESSION 
function findfield($fieldname){
    
  $query= "SELECT `$fieldname` FROM `nwc_member` WHERE `account_no` = '".$_SESSION['user_id']."' AND `mb_name` = '".$_SESSION['user_name']."'";

  if( $query_run=mysql_query($query)){
     
     if($query_result= mysql_result($query_run, 0, $fieldname)){
         
         return $query_result;
         
     }
     
 }
}

/////////////////////new
/////////////////////////////////
//////////////////FUNCTION THATS QUERYS DATA BASE TO FIND ATTRIBUTE THAT IS EQUAL TO SESSION VARIABLE FOR EMPLOYESS COMING IN FROM LOGOUT.PHP.....THIS FUNCTION CAN RETURN ANY SINGLE ATTRIBUTE IN EMPLOYEES TABLE.
//////////CAN BE USED IN ANYPART OF PROGRAM IF YOU REQUIRE SESSIONCORE.PHP AS USED IN EMPINDEX.PHP
function findempid($fieldemp){
$query2= "SELECT `$fieldemp` FROM `nwc_employees` WHERE `emp_id` = '".$_SESSION['empl_id']."'";

    if($query_run2=mysql_query($query2)){

      if($query_result2= mysql_result($query_run2, 0, $fieldemp)){
         
         return $query_result2;
         
         
     }

}
}
//////////////////////new


?>
