<?php
ob_start();
session_start();
$pageTitle = 'login';
if(isset($_SESSION['user'])){
    header('location:index.php'); // home page
}
include 'init.php';
//chek if user coming form HTTP post Requse
        if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
          if(isset($_POST['login'])){
                    $user = $_POST ['username'] ;
                    $pass= $_POST['password'];
                    $hashedpass = sha1($pass);
                    
            // chek if  the user exist in SQLiteDatabase
            $stmt = $con->prepare(" SELECT UserID,  Username , Password
                                            FROM 
                                            users
                                            WHERE
                                            Username = ? 
                                            AND Password = ? ");
            $stmt->execute(array($user ,$hashedpass));
            $get = $stmt->fetch();
            $count = $stmt->rowcount();
            
    // if count >0 this mean the database contion recors about this username
    
    if ($count > 0 ) {
    
      $_SESSION['user'] = $user; //Rigister session Name
     
      $_SESSION['uid'] = $get['UserID']; // Register User ID In session
      header('location: index.php'); // Redirect ti home page
      exit();
                }
           }else {
                $formErrors = array();
                $username   = $_POST['username'];
                $password   = $_POST['password'];
                $password2  = $_POST['password2'];
                $email      =  $_POST['email'];

                //check vaildin username
                if(isset($username)){
                    $filterUser = filter_var($username,FILTER_SANITIZE_STRING);
                    if(strlen($filterUser) < 3){
                        $formErrors[] = ' username Must Be Larger than 3 characters';
                           }
                        }
                       // check if vaildin passwod = passwor 2
                 if(isset($password) && isset($password2)){

                     if(empty($password)){
                        $formErrors[] = 'Sorry Password Is empty';
                           }

               
                if(sha1($password) !== sha1($password2)){
                    $formErrors[] = 'Sorry Password Is Not Match';
                         }
                    
                 }
                 //check vaildin email
                 if(isset($email)){
                     $filterEmail = filter_var($email,FILTER_SANITIZE_EMAIL);
                     if(filter_var($filterEmail,FILTER_VALIDATE_EMAIL) != true){
                         $formErrors[] = 'This Email Is Not Valid';
                                }
                           }
                           //check if user vo error proceed the useradd 
                           if(empty($formErrors)){
                            //check if user exist in Databse 
                
                         
                            $check = checkItem("username","users","$username");
                             if($check == 1){
                                 
                                $formErrors[] = 'This User Is Exists';
                               
                             }else{
                
                                
                            //  insert useru=info datebase w
                     $stmt = $con->prepare("INSERT INTO users(Username,Password,Email, Regstatus,Date) 
                                                        VALUES(:zuser,:zpass,:zemail,0,now())");
                       $stmt->execute(array(
                           'zuser' => $username, 
                           'zpass' => sha1($password),
                            'zemail'=> $email
                            ));
                
                         $succesMsg = 'Congrats You Are Now Register User';

                          
                
                           }
                         }
                         }

                    
                }

    ?>
        <div class="container login-page">
            <h1 class="text-center">
                 <span class="selected " data-class="login">Login</span> |
                 <span data-class="signup">signup</span></h1>
                 <!-- start login home -->
            <form class="login"  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"> 
                <div class="input-container">
                     <input class="form-control"  type="text" name="username" placeholder =" Type You username"  required="required" >
                </div>
                <div class="input-container">
                   <input class="form-control"  type="password" name="password"  placeholder =" Type You password" required="required"  >
                    </div>
                <div class="input-container">
                   <input class="btn btn-primary btn-block" name = "login"  type="submit" value="login"  >
                    </div>
                   
           </form>
            <!-- end login home -->
           <!-- start signup home -->
           <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"> 
            <div class="input-container">
                            <input class="form-control"  type="text" name="username" placeholder =" Type You username"
                            pattern=".{4,}"
                            title ="username  must be  Between 4 chars"
                            required="required" />
                        </div>
                        <div class="input-container">
                            <input class="form-control"  type="password" name="password"  placeholder =" Type compiex password" minlength="4" required="required"  />
                                </div>  
                            <div class="input-container">
                                <input class="form-control"  type="password" name="password2"  placeholder ="  Type a password again" minlength="4" required="required"/>
                                        </div>
                            <div class="input-container">   
                                <input class="form-control"  type="email" name="email" placeholder =" Type a vaild email"  />
                     </div>
                       <input class="btn btn-success btn-block" name = "signup" type="submit" value="signup"  >
                  </form>
                   <!-- end signup home -->
                   <div class="the-errors  text-center">
                        <?php if(!empty($formErrors)){
                            foreach($formErrors as $error){
                                echo '<div class="msg error">' . $error . '</div>';
                                }
                            }
                            if(isset($succesMsg)){
                                echo '<div class="msg success">'. $succesMsg .  '</div>';

                            }
                        ?>
                   </div>
        </div>

<?php
include $tpl .'footer.php';
ob_end_flush();
?>