<?php

try{
    require('./mysqli_connect.php');

    $errors = [];
    $success = [];

    //if the form has been submitted via the post method
if($_SERVER['REQUEST_METHOD'] =='POST'){


    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);


    //checking for duplicate emails
    $check_email_query = "SELECT * FROM clients WHERE email = ?";
    $check_email_stmt = mysqli_stmt_init($dbcon);
    mysqli_stmt_prepare($check_email_stmt, $check_email_query); 
    mysqli_stmt_bind_param($check_email_stmt, 's', $email);
    mysqli_stmt_execute($check_email_stmt);

    $result = mysqli_stmt_get_result($check_email_stmt);
    if(mysqli_num_rows($result) == 1){
        //error message in the catch block
    }

    //if any of the fieds are empty
    if(empty($name) || empty($email) || empty($phone) || empty($address)) array_push($errors, "ALL FIELD ARE REQUIRED");
    else{
    //insert into db    
    $insert_query = "INSERT INTO clients (name, email, phone, address) VALUES (?,?,?,?)" ;
    $insert_stmt = mysqli_stmt_init($dbcon);
    mysqli_stmt_prepare($insert_stmt, $insert_query);
    mysqli_stmt_bind_param($insert_stmt,'ssss',$name, $email, $phone, $address);
    if(mysqli_stmt_execute($insert_stmt)){
        //if a row is affected in the DB
        if(mysqli_stmt_affected_rows($insert_stmt) == 1){
            echo "<script>alert('Inserted sucefully')</script>";
            header("Location: home.php");
        }
        else{
            array_push($errors , "No affected rows");
        }
    }
    else {
        echo "Failed to query";
    }

    }

    //traversing the errors
    foreach($errors as $error){
        echo "<div class='alert alert-danger' role='alert'>
        $error
      </div>";
    }

    //traversing the success message
    foreach($success as $complete){
        echo $complete;
    }    

}
}
catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) { // MySQL error code for duplicate entry
        array_push($errors, "Email already exists");
    } else {
        // Handle other database errors
        array_push($errors, "Database error: " . $e->getMessage());
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>My Shop</title>
</head>

<body>
    <div class="container my-5">
    <?php
        // Output errors and success messages
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger' role='alert'>$error</div>";
        }

        foreach ($success as $complete) {
            echo $complete;
        }
        ?>

        <h2>New Client</h2>
        <form action='create.php' method='post'>

            <div class='row mb-3'>
                <label for='' class='col-sm-3 col-form-label'>Name</label>
                <div class='col-sm-6'>
                    <input type='text' class="form-control" name='name' value='<?=isset($name) ? $name :'' ?>'>
                </div>
            </div>

            <div class='row mb-3'>
                <label for='' class='col-sm-3 col-form-label'>Email</label>
                <div class='col-sm-6'>
                    <input type='text' class="form-control" name='email' value='<?=isset($email) ? $email:''?>'>
                </div>
            </div>

            <div class='row mb-3'>
                <label for='' class='col-sm-3 col-form-label'>Phone</label>
                <div class='col-sm-6'>
                    <input type='text' class="form-control" name='phone' value='<?= isset($phone)? $phone :''?>'>
                </div>
            </div>

            <div class='row mb-3'>
                <label for='' class='col-sm-3 col-form-label'>Address</label>
                <div class='col-sm-6'>
                    <input type='text' class="form-control" name='address' value='<?=isset($address) ?$address :''?>'>
                </div>
            </div>

            <div class='row mb-3'>

               <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-success">Submit</button>
               </div>

               <div class="col-sm-3 d-grid">
                <a href="home.php" class="btn btn-outline-danger" role="button">Cancel</a>
               </div>

            </div>
        </form>
    </div>

</body>

</html>