
<?php
include "header.php";
include "navbar.php";
include "dbConnection.php";
?>

<?php
if(isset($_POST['signup'])){

  trim(htmlspecialchars(extract($_POST)));
  $errors = [];

  //username
    if(empty($UserName)){
      $errors[] = "Name should not be empty";
  }elseif(!is_string($UserName)){
      $errors[] = "Name should be string only";
  }elseif(strlen($UserName)>25){
      $errors[] = "Name should be less than 25 character";
  }

  //email
      if(empty($email)){
          $errors[] = "Email should not be empty";
      }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          $errors[] = "Email is incorrect";
      }

      //Password
      if(empty($password)){
          $errors[] = "Password should not be empty";
      }elseif(strlen($password)<6){
          $errors[] = "Password should be more than 6 characters";
      }elseif(!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])(?!.*\s).{8,}$/', $password)){
        $errors[] = "Password must be at least one uppercase letter, lowercase letter, digit,
        a special character with no spaces and minimum 8 length";
    }

      //phone
      if(empty($phone)){
        $errors[] = "Phone should not be empty";
      }elseif(strlen($phone) < 12 ){
        $errors[] = "Phone number is not correct";
      }elseif(!preg_match('/^\d+$/', $phone)){
        $errors [] = "The phone  must be a number";
    
    }

    //address
    if(empty($address)){
      $errors[] = "Please enter your address";
    }

    if(empty($errors)){

          $insert_query = "insert into users (`name` , `email` , `password` , `address`) 
          values ('$UserName' , '$email' , '$password' , '$address')";

          $query_run = mysqli_query($conn , $insert_query);

          if($query_run == true){
            //echo "inserting is done successfully";
            // $_SESSION['success'] = "inserting is done successfully";
            header("location:shop.php");

        }else{
            
            // $_SESSION['errors'] = ['error in inserting data'];
            // header("location:{$_SERVER['PHP_SELF']}");
            // header("location:signup.php");

        }

    }else{
        $_SESSION['UserName'] = $UserName;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['phone'] = $phone;
        $_SESSION['address'] = $address;
        $_SESSION['errors'] = $errors;
    }

}else{
  // header("location:{$_SERVER['PHP_SELF']}");
  // header("location:signup.php");
}

// ?>


<div class="card-body px-5 py-5" style="background-color:darkgray;">

<?php
  if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {?>

        <li style="color:red;"><?php echo $error . "<br>" ; ?></li>

<?php  
  }
  unset($_SESSION['errors']);
  }
  unset($_SESSION['email'] );
  unset($_SESSION['UserName'] );
  unset($_SESSION['password'] );
  unset($_SESSION['phone']);
  unset($_SESSION['address']);

    ?>
                <h3 class="card-title text-left mb-3">Register</h3>
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control p_input" name="UserName" value="<?php if (isset($_SESSION['UserName'])) echo $_SESSION['UserName']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control p_input" name="email" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control p_input" name="password">

                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control p_input"name="phone" value="<?php if (isset($_SESSION['phone'])) echo $_SESSION['phone']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control p_input" name="address" value="<?php if(isset($_SESSION['address'])) echo $_SESSION['address'];?>">
                  </div>
              
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                    
                  <div class="text-center">
                    <button type="submit" name="signup" class="btn btn-primary btn-block enter-btn">Signup</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook col me-2">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up text-center">Already have an Account?<a href="login.php"> Login</a></p>
                  <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
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


    <!-- regex 

  $regex = /^01[0,1,2,5][0-9]{8}$/

  preg_match($regex,) 
  
  -->