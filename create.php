<?php
$name = "";
$email = "";
$phone = "";
$address = "";


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
        <h2>New Client</h2>
        <form action='create.php' method='post'>

            <div class='row mb-3'>
                <label for='' class='col-sm-3 col-form-label'>Name</label>
                <div class='col-sm-6'>
                    <input type='text' class="form-control" name='name' value='<?=$name ?>'>
                </div>
            </div>

            <div class='row mb-3'>
                <label for='' class='col-sm-3 col-form-label'>Email</label>
                <div class='col-sm-6'>
                    <input type='text' class="form-control" name='email' value='<?=$email?>'>
                </div>
            </div>

            <div class='row mb-3'>
                <label for='' class='col-sm-3 col-form-label'>Phone</label>
                <div class='col-sm-6'>
                    <input type='text' class="form-control" name='phone' value='<?=$phone?>'>
                </div>
            </div>

            <div class='row mb-3'>
                <label for='' class='col-sm-3 col-form-label'>Address</label>
                <div class='col-sm-6'>
                    <input type='text' class="form-control" name='address' value='<?=$address?>'>
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