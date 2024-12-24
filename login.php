<?php
include "header.php";
include "navbar.php";
include "dbConnection.php";
?>
<?php

if(isset($_POST['login'])){
  trim(htmlspecialchars(extract($_POST)));

  $errors = [];

  if(empty($email)){
    $errors [] = "Please enter your email";
  }

  if(empty($password)){
    $errors [] = "Please enter your password";
  }

  if(empty($errors)){
    
    $query = "select *  from users where email = '$email'";
    $run_query = mysqli_query($conn , $query);

    if(mysqli_num_rows($run_query)==1){

      $user = mysqli_fetch_assoc($run_query);
      // header("location:shop.php");

      $user_password = $user['password'];
      $user_role = $user['role'];

      if($user_password == $password){
        header("location:shop.php");
      }else{
        $_SESSION['errors'] = ["Wrong Credentials"];
        // echo "<p style='color:red;'><strong>Invalid Password</strong></p>";
      }

      if($user_role == "admin"){
        header("location:admin/view/layout.php");
      }else{
        header("location:shop.php");
      }

    }else{
      $_SESSION['errors'] = ["User is not found"];
      // echo "<p style='color:red;'><strong>User is not found</strong></p>";
    }

  }else{
    $_SESSION['email'] = $email;
    $_SESSION['errors'] = $errors;

  }
}
?>


<div class="card-body px-5 py-5" style="background-color:darkgray;">

<?php
  if(isset($_SESSION['errors'])){
    foreach ($_SESSION['errors'] as $error) {?>
      <li style = "color:red;" > <?php echo $error; ?> </li>
      <?php
  }
unset($_SESSION['errors']);
}
unset($_SESSION['email']);
unset($_SESSION['password']);
?>

            
              
                <h3 class="card-title text-left mb-3">Login</h3>
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                  <div class="form-group">
                    <label>email *</label>
                    <input type="email" name="email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="text" name="password" class="form-control p_input" >
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="login" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook me-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <?php include "footer.php" ?>


    //table user, product, cart ,, review comment , rating  = session