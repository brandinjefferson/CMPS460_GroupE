<?php

//echo md5('pass123');


require 'sessioncore.php';
require 'connecttophp.php';


if(loggedinEmp()){
/////////////////////////////////////////
////////////////////////////////////////
///////Employee id is returned to this folder to link this infromation
$Empid= findempid('emp_id');
    
    
   
    echo 'Employee '.$Empid.' is logged in.';
    
    echo '<br>';

    echo '<a href="loggout.php">Log out';
    echo '<br>';
  


}


else{
include 'loginform2.php';

}





?>
