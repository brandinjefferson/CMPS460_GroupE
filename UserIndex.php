<?php

//echo md5('pass123');


require 'sessioncore.php';
require 'connecttophp.php';

if (loggedin()){
    

///////////////////EXAMPLE TO SHOW HOW DATA COULD MOVE THROUGH ANY PHP FILE THE REQUIRES SESSIONCORE.PHP

//include 'Userpage.php';



include 'Userpage.php';
}
else{
include 'loginform2.php';

}

?>




