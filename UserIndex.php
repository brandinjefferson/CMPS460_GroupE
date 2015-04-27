<?php

//echo md5('pass123');


require 'sessioncore.php';
require 'connecttophp.php';

if (loggedin()){
    $firstname= findfield('account_no');
    
    
   
    echo 'User '.$firstname.' is logged in.';
    
    echo '<br>';

    echo '<a href="loggout.php">Log out';
    echo '<br>';

///////////////////EXAMPLE TO SHOW HOW DATA COULD MOVE THROUGH ANY PHP FILE THE REQUIRES SESSIONCORE.PHP
echo 'This is an example of user id session data carried over from loggout.php=  ';
$try= $_SESSION['user_id'];
  echo $try;
}
else{
include 'loginform2.php';

}






?>
