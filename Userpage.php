<?php 


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       $account_no= findfield('account_no');
    
$user_name= findfield('mb_name'); 
    
 
   

   
    
?>




<html>
<head>
 <title>New Wave Cinema</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<style type = "text/css">
.header-cont{width= 100%;  }
.header{
     height: 75px;
     background: #0099CC;
     border:1px solid #CCC;
  position: fixed;
    width: 100%;
    top: 0px;
     margin: 0px auto;
     



}




.content{
width: 960px;
background: #F0F0F0;
border: 1px solid #CCC;
height:2000px;
margin:70px auto;


}


.

body {
    color: red;
}

h1 {
    color: #FFFFFF;
}

p.ex {
    color: rgb(0,0,255);
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

body {
  padding: 50px;
  background: white;
}

.col {
  width: 160px;
  float: left;
}

h2 {
    position: absolute;
    
    top: 0%;
    right: 10%;
}
p.italic {
    font-style: italic;
}
</style>
</head>
<body>



<div class= "header">


<p><h1><font size="12"> New Wave Cinema </font></h1>

<div class="col">

<br><br><br>
<a href="display.php" class="button">Display</a>
 
<br><br><br>

<a href="viewhistory.php" class="button">Movie History</a>
<br><br><br>

<a href="nwc_movie_list_complex.php" class="button">Movie Listings</a>
<br><br><br>

<a href="AddMember.php" class="button">Add Members</a>
<br><br><br>

<a href="extendmembership.php" class="button">Extend Membership</a>

</div>

<h2>
        <a href="#" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user_name'] ?>
        </a>
       <form action="loggout.php">
    <input type="submit" value="Log Out">
</form> </h2>
</p>

</div>
</body>
</html>
