<?php include 'db.php';?>
<?php include 'functions.php';?>

<?php session_start();?>

<?php
//var_dump($_SESSION);die;
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];

if(isset($_POST['update_names'])){

    $id = $_SESSION['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $query = "UPDATE users SET first_name= '$first_name', last_name= '$last_name' WHERE id= {$id}";
    $update_query = mysqli_query($connection,$query);
    $update_query = "Profile updated successfully";
}

if(isset($_POST['update_password'])){

    $id = $_SESSION['id'];
   
    $update_pass = get_user_data($id);

     
}
   
    
    

    


?>




<?php include 'header.php';?>
<?php include 'navigation.php';?>
    <div class="container">
        <div class="col-lg-12">
            <div class="row ">
                <div class="col-lg-3">
                     <?php  //echo $first_name; ?>
                </div>
                <div class="col-lg-6 mt-4">
                    <form action="" method="POST" >
                    
                  

                        <h1 class="text-center">Update Profile</h1><br>
                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="<?php if(isset($first_name)){ echo $first_name; } ?>" ><br> <br>
                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="<?php if(isset($last_name)){ echo $last_name; } ?>"><br> <br>
                        <!-- <input type="date" class="form-control" name="date"  ><br> <br> -->
                        <?php if(isset($update_query)){ echo $update_query; }?> <br>
                        <button class="btn btn-success" type="submit" name="update_names">Update</button><br> <br>

                        
                    </form>
                    <form action="" method="POST">
                        <input type="password" class="form-control" name="old_password" placeholder="Enter Old Password" ><br> <br>
                            <input type="password" class="form-control" name="new_password" placeholder="Enter New Password" id=""><br><br>
                            <input type="password" class="form-control" name="new_confirm_password" placeholder="Enter New Confirm Password" id=""><br><br>
                            <?php if(isset($update_pass)){ echo $update_pass; }?> <br>
                            <button class="btn btn-success" type="submit" name="update_password">Update Password</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
 <?php include 'footer.php';?>