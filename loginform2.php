

<?php

if(isset($_POST['username'])&& isset($_POST['password'])){
    
  

$usern= $_POST['username'];
   $pass= $_POST['password'];
   
 //for encription password  
//////////////////$pass_hash = md5($pass);
    
         if(!empty($usern) && !empty($pass) ){
       
    

           $query= "SELECT `account_no` FROM `nwc_member` WHERE `mb_name` = '$usern'";
          
          $query2= "SELECT `mb_name` FROM `nwc_member` WHERE `mb_name` = '$usern'";
            
          
            
           if($query_run = mysql_query($query)){
           
            
                 
                     $user_id = mysql_result($query_run,0,'account_no');

                         $accountcheck= "SELECT `account_no` FROM `nwc_membership` WHERE `account_no` = '$user_id' AND `password` = '$pass' "; 

                      if($query_runcheck=mysql_query($accountcheck)){
             
              


                  $query_rows = mysql_num_rows($query_run);
           $query_rowcheck= mysql_num_rows($query_runcheck);


          $query_run2= mysql_query($query2);
          
            
            if($query_rows == 0 || $query_rowcheck == 0){
            
            
              $employequery= "SELECT `emp_id` FROM `nwc_employees` WHERE `emp_name`= '$usern' AND `emp_pass`= '$pass'";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
               if ($queryrunEmp= mysql_query($employequery)){
           $query_rowcheckemp= mysql_num_rows($queryrunEmp);
                
                   if ($query_rowcheckemp == 1){

           
             $emp_name= mysql_result($queryrunEmp,0,'emp_id');
              /// echo 'yo'; 
                  $_SESSION['empl_id']= $emp_name; 

            header('Location: EmpIndex.php');
}
else         {

                echo 'Your username and password is incorrect';
   }         
}

            
        }
        
        
      else if ($query_rows == 1 && $query_rowcheck == 1) {
        
           $user_name= mysql_result($query_run2,0,'mb_name');
         

////////////////////////Session variable is transfered to UserIndex.php it is equal to the user id.
 $_SESSION['user_id']= $user_id;
////////////////////////Session variable is transfered to UserIndex.php it is equal to the user name.
            $_SESSION['user_name']= $user_name;
          

         header('Location: UserIndex.php');
       
           
        }
           
   
}

}
   else {
            echo 'did not enter database';
             die(mysql_error());
        }
        
    



} 
      else {
             
            echo 'YOU MUST APPLY USERNAME AND PASSWORD';
      }
}


?>






    
<form action="<?php echo $current_file; ?> " method="POST">




<pre>   <font size="12">New Wave Cinema</font>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                    <font size="6">Log in:</font>  &nbsp;<font size="5">User Name:</font> <input type="text" name="username"> <font size="5">Password:</font> <input type="password" name="password"><input type="submit" value="Log in">
</pre></form>
<a href="signup.html"> Sign up Now





