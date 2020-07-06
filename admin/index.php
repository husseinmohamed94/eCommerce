<?php
session_start();
$nonavbar = '';
$pageTitle = 'login';


if (isset($_SESSION['Username'])) {

  header('location: deshbord.php');
}

include "init.php";

//chek if user coming form HTTP post Requse
if ($_SERVER['REQUEST_METHOD'] == "POST" ) {

$username = $_POST ['user'] ;
$password = $_POST['password'];
$hashedpass = sha1($password);

// chek if  the user exist in SQLiteDatabase
$stmt = $con->prepare(" SELECT UserID , Username , Password FROM  users WHERE
                                Username = ? 
                                AND Password = ? 
                                AND  GroupID = 1 
                                LIMIT 1 ");
$stmt->execute(array($username ,$hashedpass));
$row = $stmt->fetch();
$count = $stmt->rowcount();

// if count >0 this mean the database contion recors about this username

if ($count > 0 ) {

  $_SESSION['Username'] = $username; //Rigister session Name
  $_SESSION['ID'] = $row['UserID']; //rigister session ID
  header('location: deshbord.php'); // Redirect ti deshbord page

exit();
}

}


?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

  <h4 class="text-center">Admin login</h4>

  <input class="form-control " type="text" name="user" placeholder="Username" autocomplete="off " />
  <input  class="form-control "  type="password"  name = "password" placeholder="password" autocomplete="new-password " />
  <input  class="btn btn-primary btn-block  "   type = 'submit'  value="login"  />

</form>


<?php include $tpl . 'footer.php' ; ?>
