
<?php include 'functions.php'; ?>
<?php session_start(); ?>

<?php
    if(!isset($_SESSION['email']) ){
        header("Location: index.php");
    }
    if(isset($_SESSION['first_name'])){
       $id = $_SESSION['id'];
       $first_name = $_SESSION['first_name'];
       $last_name = $_SESSION['last_name'];

    }
    if(isset($_SESSION['date_of_birth'])){

        $date = $_SESSION['date_of_birth'];
        
        if (date('m-d', strtotime($date)) == date('m-d')) {
            $wish = "Happy Birthday";
        } 
    }

    if(isset($_POST['submit'])){
        
       $valueOne    = $_POST['valueOne'];
       $valueTwo    = $_POST['valueTwo'];
       $oprator     = $_POST['oprator'];

       $result = calculation($valueOne,$valueTwo,$oprator);
   
       insertData($valueOne,$oprator,$valueTwo);

    }

    if(isset($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            
            case 'delete': 
                deleteQuery($_GET['id']);
                break;

            case 'deleteAll':
                deleteAll();
                break;

            case 'logout':
                logout();
                break;
         
        }
    }


?>
<?php include 'header.php';?>
<?php include 'navigation.php';?>

    <div class="container">
            <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1> Hi <?php echo $first_name; echo " "; echo $last_name; echo ","; ?>  WELCOME TO CALCULATOR <br><?php if(isset($wish)) {echo $wish;}?> </h1>
                        <div class="row">
                            <div class="col-lg-2">

                            </div>
                            <div class="col-lg-4 mt-5">
                                <a class="btn btn-success" type="submit" name="logout" href="calculator.php?action=logout">Logout</a><br><br>
                                <form method="post">
                                        
                                        <input type="text" class="form-control" name="valueOne" id="" placeholder="Enter value one">
                                        <br>
                                        
                                        <input type="text" class="form-control" name="valueTwo" id="" placeholder="Enter value two">
                                        <br>
                                        <select class="form-select form-select-lg" aria-label=".form-select-sm example" name="oprator" id="oprator">
                                            <option selected value="Please Select Option">Please Select Option</option>
                                            <option value="+">+</option>
                                            <option value="-">-</option>
                                            <option value="*">*</option>
                                            <option value="/">/</option>
                                        </select><br> <br>
                                            
                                        <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
                                </form>
                                <?php 
                                    if(isset($result)){
                                        ?>
                                <div class="mt-3 card bg-dark text-white">
                                    <div class="card-body">
                                   
                                        <h1>
                                            <h3>The result is <?php echo $result; ?></h3> 
                                        </h1>
                                    </div>
                                </div> 
                               <?php     }
                                ?>
                            </div>
                            <div class="col-lg-4">
                                <h3 class="font-weight-bold">History of Calculator</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ValueOne</th>
                                            <th scope="col">Oprator</th>
                                            <th scope="col">ValueTwo</th>
                                            <th scope="col">Result</th>
                                            <th scope="col"><a href='index.php?action=deleteAll'>Delete All</a></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $fetch = "SELECT * FROM history";
                                                                                                                
                                                $select_calculator_data = mysqli_query($connection,$fetch);

                                                while($row = mysqli_fetch_assoc($select_calculator_data)){
                                                    $id = $row['id'];
                                                    $row_valueOne = $row['valueOne'];
                                                    $row_operator = $row['oprator'];
                                                    $row_valueTwo = $row['valueTwo'];
                                                    
                                                    // echo $row_valueOne;
                                                    // echo $row_operator;
                                                    // echo $row_valueTwo;                                                  

                                                    echo "<tr>";
                                                        
                                                        echo "<td> $row_valueOne</td>";
                                                        echo "<td> $row_operator</td>";
                                                        echo "<td> $row_valueTwo</td>";

                                                        $result = calculation($row_valueOne,$row_valueTwo,$row_operator);
                                                        echo "<td> $result</td>";

                                                        echo "<td><a href='index.php?action=delete&id={$id}'> Delete</a></td>";

                                                    echo "</tr>";
                                                }           
                                        ?>
                                        <?php
                                               
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-2">

                            </div>
                        </div>
                        </div>
                    </div>
            </div>
        
    </div>


<?php include "footer.php";?>
