<?php include 'db.php';?>
<?php 
    session_start();
?>

<?php include 'functions.php';

    if(isset($_POST['register'])){
        
        
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $date = $_POST['date'];
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['confirm_password'];
            $slquery = "SELECT * FROM users WHERE email='{$email}'";
            $selectresult = mysqli_query($connection,$slquery);
            $present = mysqli_num_rows($selectresult);
            if($present>0)
            {
                echo "email is already exist";
                //$_SESSION['email']=1;
            }
            else if($password !== $cpassword){
                 echo "passwords doesn't match";
            }
            else{
                  if(!checkemail($email)){
                    echo "invalid email";
                  }else{

                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    
                    registerInsert($first_name,$last_name,$date_of_birth,$email,$hash);
                    
                   
                  }
           
            }
           


    }


?>
<?php include 'header.php';?>
    <div class="container">
        <div class="col-lg-12">
            <div class="row ">
                <div class="col-lg-3">
                        //
                </div>
                <div class="col-lg-6 mt-4">
                    <form action="" method="POST" >
                        <h1 class="text-center">New Register</h1>
                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" ><br> <br>
                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" ><br> <br>
                        <input type="date" class="form-control" name="date"  ><br> <br>

                        <input type="text" class="form-control" name="email" placeholder="Enter Email" ><br> <br>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" id=""><br><br>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" id=""><br><br>
                        <button class="btn btn-success" type="submit" name="register">Register</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
 <?php include 'footer.php';?>
