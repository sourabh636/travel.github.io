<html>
    <head>
        <meta charset="utf-8">
        <title>request</title>

        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
      <script src="https://kit.fontawesome.com/a076d05399.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  user-select: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  background: black;

}

nav{
  background: #1b1b1b;
}
nav:after{
  content: '';
  clear: both;
  display: table;
} 
nav ul{
  float: left;
  margin-right: 40px;
  list-style: none;
  position: relative;
}
nav ul li{
  float: none;
  display: inline-block;
  background: #1b1b1b;
  margin: 0 5px;
}
nav ul li a{
  color: white;
  line-height: 70px;
  text-decoration: none;
  font-size: 18px;
  padding: 8px 15px;
}
nav ul li a:hover{
  color: white;
  border-radius: 5px;
  box-shadow:  0 0 5px white,
               0 0 10px white;
}
nav ul ul li a:hover{
  box-shadow: none;  
}
nav ul ul{
  position: absolute;
  top: 90px;
  border-top: 3px solid cyan;
  opacity: 0;
  visibility: hidden;
  transition: top .3s;
}
nav ul li:hover > ul{
  top: 70px;
  opacity: 1;
  visibility: visible;
}
nav ul ul li{
  position: relative;
  margin: 0px;
  width: 150px;
  float: none;
  display: list-item;
  border-bottom: 1px solid rgba(0,0,0,0.3);
}
nav ul ul li a{
  line-height: 50px;
}
nav ul ul li:hover{
    position:relative;
    left: 20px;
    transition: left .6s;
    background-color: rgb(49, 51, 50);
    opacity: 90%;
}

 .l1{
    color: black;
  }

  #f1 {
  font-size: 20px;
  width: 400px;
  border: 5px solid #ccc;
  padding: 30px;
  background: lightyellow;
  border-radius: 15px;
  margin: auto;
  margin-top: 35px;
  padding: 30px;
 }

 input {
  border: 2px solid #ccc;
  width: 95%;
  padding: 10px;
  margin: 10px auto;
  border-radius: 5px;
}

nav ul input{
  padding: 5px;
  width: 85%;
}

.success {
   background: #D4EDDA;
   color: #40754C;
   padding: 10px;
   width: 95%;
   border-radius: 5px;
   margin: 20px auto;
   }

.error {
   background: #F2DEDE;
   color: #A94442;
   padding: 10px;
   width: 95%;
   border-radius: 5px;
   margin: 20px auto;
}

@media all and (max-width: 968px) {
  nav ul{
    margin-right: 0px;
    float: left;
  }
  
  nav ul li,nav ul ul li{
    display: block;
    width: 100%;
  }
  nav ul li a:hover{
    box-shadow: none;
  }
  .show{
    display: block;
    color: white;
    font-size: 18px;
    padding: 0 20px;
    line-height: 70px;
    cursor: pointer;
  }
  .show:hover{
    color: cyan;
  }
  nav ul ul{
    top: 70px;
    border-top: 0px;
    float: none;
    position: static;
    display: none;
    opacity: 1;
    visibility: visible;
  }
  nav ul ul a{
    padding-left: 40px;
}
  

}
</style>
</head>
<body>
    <nav>
        <ul>
          <li style="margin-left: 70px;"><form><input type="text" placeholder="Search..." name="search">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>  
        </li>
           <li><a href="index.html">Home</a></li>
           <li>
              <a href="#">Genre</a>
              <ul>
                 <li><a href="action.html">Action</a></li>
                 <li><a href="adventure.html">Adventure</a></li>
                 <li><a href="shooting.html">Shooting</a></li>
                 <li><a href="horror.html">Horror</a></li>
              </ul>
           </li>
           <li>
              <a href="how.html">How to install</a> 
           </li>
           <li><a href="request.html">Request Games</a></li>
        </ul>
     </nav>

     <br><br>

     <h1 style="color: yellow;"><center>Request Your Game</center></h1>
     

     <form method="post" id="f1">
     	<?php if (isset($_GET['error'])) { ?>
     	    <p class="error"><?php echo $_GET['error']; ?></p>
     <?php } ?>

     <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
     <?php } ?>
     	<label class="l1">Email</label><br>
      <?php if (isset($_GET['email'])) { ?>
      
      <input 
      type="email" 
      name="email" 
      placeholder="Email" 
      value="<?php echo $_GET['email']; ?>"><br>
          <?php } else{ ?>
               <input type="email" 
                      name="email" 
                      placeholder="Email"><br>
          <?php }?>
          <br><br>

      <label class="l1">Name of the Game</label><br>
      <?php if (isset($_GET['uname'])) { ?>
      <input type="text" name="gamename" placeholder="Game_Name" value="<?php echo $_GET['gamename']; ?>"><br>
          <?php }
          else{ ?>
               <input type="text" 
                      name="gamename" 
                      placeholder="Game_Name"><br>
          <?php }?>

      <button type="submit">Submit</button>
     </form>
     
</body>
</html>

<?php 
session_start(); 
include "db_conn_request.php";

if (isset($_POST['email']) && isset($_POST['gamename'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$gamename = validate($_POST['gamename']);

	$user_data = 'email='. $email. '&gamename='. $gamename;

	if (empty($email)) {
		header("Location: request.php?error=Email is required&$user_data");
	    exit();
	}
	else if(empty($gamename)){
        header("Location: request.php?error=Name of the game is required&$user_data");
	    exit();
	}

	else{
		$sql = "SELECT * FROM request WHERE email='$email' ";
		$result = mysqli_query($conn, $sql);
	

	if (mysqli_num_rows($email) > 0) {
			header("Location: request.php?error=The email is already in use&$user_data");
	        exit();
		}
		else {
           $sql2 = "INSERT INTO request(email, gamename) VALUES('$email', '$gamename')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: request.php?success=Your account has been created successfully");
	         exit();
           }
           else {
	           	header("Location: request.php?error=unknown error occurred&$user_data");
		        exit();
           }
       }
   }
}
   else
   {
   	echo "unknow error occurred";
   }

?>