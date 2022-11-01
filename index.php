<?php include 'db.php';?>

<?php
session_start();

if(isset($_GET['message'])){
   echo "thanks for you registration, please log in here";
}
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $query = "SELECT * FROM users WHERE email = '{$email}'";
    //die($query);
    $users_data_fetch = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($users_data_fetch)){
        $id = $row['id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $date_of_birth = $row['date_of_birth'];

       // $email = $row['email'];
        
        $email = $row['email'];
        $password = $row['password'];

        // var_dump($email);
        if($email == $_POST['email']){
            

            if(password_verify($_POST['password'],$password)){
                $_SESSION['id'] = $id;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['date_of_birth'] = $date_of_birth;

                $_SESSION['email'] = $email;
                
                header('Location: calculator.php');
            } else{
                echo "Password not matched";
            }
        } else{
            echo "email not matched";
        }
    }
   
    // $password_check = 123;
    // if($_POST['password'] == $password_check){
    //     $_SESSION['login'] = true; 
       

    //     header('Location: calculator.php'); //go to location after successful login.
    //die();
    // }else{
    //     echo "Wrong Password";
    // }
}

?>

<?php include 'header.php';?>

        <div class="container">
            
                <div class="col-lg-12">
                    <div class="row">
                    
                        <div class="col-lg-3">
                                //
                        </div>
                        
                            <div class="col-lg-6">
                                <h3 class="text-center">Enter Login Details</h3>
                                <form action="index.php" method="post">
                                    <input type="email" class="form-control" name="email" placeholder="Enter Emaill"><br> <br>
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password" id=""><br><br>
                                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                                    <a href="register.php" class="btn btn-primary">New Register</a>
                                </form>
                            </div>
                        
                    </div>
                </div>
            
        </div>

<?php include "footer.php" ?>
