<?php include 'db.php';?>
<?php

function calculation($valueOne,$valueTwo,$oprator){
    
    switch ($oprator) {

        case '+':
            return $valueOne + $valueTwo;
            break;

        case '-':
            return $valueOne - $valueTwo; 
            break;

        case '*':
            return $valueOne * $valueTwo; 
            break;

        case '/':
            return $valueOne / $valueTwo; 
            break;
       
    }
}

function insertData($valueOne,$oprator,$valueTwo){
    global $connection;
    $query = "INSERT INTO history(valueOne,oprator,valueTwo) VALUES ('$valueOne', '$oprator', '$valueTwo')";
       
    mysqli_query($connection,$query);
   
}

function deleteQuery($id){
    global $connection;
    $query = "DELETE FROM history WHERE id={$id}";
    mysqli_query($connection,$query);
    header("Location: index.php");
    exit();
}

function deleteAll(){
    global $connection;
    $query = "TRUNCATE TABLE history";
    mysqli_query($connection,$query);
    header("Location: index.php");
    exit();
}

function logout(){
    session_destroy();
    //unset($_SESSION['login']);
    header('Location: index.php');
    exit();
}

function checkemail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }else{
        return false;
    }
}

function registerInsert($first_name,$last_name,$date_of_birth,$email,$hash){
    global $connection;
    $query = "INSERT INTO users(first_name, last_name, date_of_birth, email, password) VALUES ('$first_name', '$last_name', now(), '$email', '$hash')";
    $result = mysqli_query($connection,$query);
    
    header("Location:index.php?message=msg");
    exit();
}

function get_user_data($id){
    global $connection;
    
    $id = $_SESSION['id'];

    $oldpass = $_POST['old_password'];
    $newpass = $_POST['new_password'];
    $conpass = $_POST['new_confirm_password'];

    if ($oldpass == '' || empty($newpass) || empty($conpass)) {
        return 'all fields required';
    }     
    if($newpass !== $conpass){
        return 'New password not matched';
    }


    $query = "SELECT * FROM users WHERE id= {$id}";
    $result = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($result)){
        $db_pass = $row['password'];
        
        if(password_verify($oldpass,$db_pass)){
            //echo "passsword match";
            $new_hash = password_hash($newpass, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password= '$new_hash' WHERE id= {$id}";
            $update_pass = mysqli_query($connection,$query);
            return 'updated successfully';
        }else{
            return 'old password not match';
        }
    }
}

?>