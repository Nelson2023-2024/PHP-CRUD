<?php
   // var_dump($_POST);
    try{
        require('./mysqli_connect.php');
        $errors = [];
        $success =[];
    
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $id = $_GET['id'];
    
            if(isset($_GET['id'])){
                $select_query = "SELECT name, email, phone, address FROM clients WHERE id = ?";
                $select_stmt = mysqli_stmt_init($dbcon);
                mysqli_stmt_prepare($select_stmt,$select_query);
                mysqli_stmt_bind_param($select_stmt,'i',$id);
                mysqli_stmt_execute($select_stmt);

                //gets result from prepared statement
                $result = mysqli_stmt_get_result($select_stmt);
    
                if($row = mysqli_fetch_assoc($result)){
                    //var_dump($row);
                    $name = $row['name'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $address = $row['address'];

                }
    
            }  
        } 
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            //var_dump($_POST);

            if(empty($id) || empty($name) || empty($email) || empty($phone)|| empty($address)){
                array_push($errors,"ALL FIELDS ARE REQIURED");
            }
            else{
                //checking duplicate entries on email
                $check_dupliemail_query = "SELECT email FROM clients WHERE email = ?";
                $check_dupliemail_stmt = mysqli_stmt_init($dbcon);
                mysqli_stmt_prepare($check_dupliemail_stmt, $check_dupliemail_query);
                mysqli_stmt_bind_param($check_dupliemail_stmt,'s', $email);
                mysqli_stmt_execute($check_dupliemail_stmt);
                $result = mysqli_stmt_get_result($check_dupliemail_stmt);

                if($row = mysqli_fetch_assoc($result)){
                    array_push($errors, "The email you entered already exists");
                }


                //update query
                $update_query = "UPDATE clients SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
                $update_stmt = mysqli_stmt_init($dbcon);
                mysqli_stmt_prepare($update_stmt, $update_query);
                mysqli_stmt_bind_param($update_stmt,'ssssi',$name, $email,$phone, $address, $id);
                if(mysqli_stmt_execute($update_stmt)){
                    echo "<script>alert('Succefully updated'); window.location.href = 'home.php';</script>";
                    exit();
                }
                else {
                    array_push($errors, "Failed to excecute the query");
                    
                }
            }
        }

    
    }

    catch(Exception $e){
        echo $e->getMessage();
    }
    catch(Error $e){
        echo $e->getMessage();
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
        foreach($errors as $error){
          echo "<div class='alert alert-danger' role='alert'>
          $error
        </div>";  
        }
        
        ?>
    
    <h2>Current Details </h2>
    <table class="table">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone No</th>
        <th>Address</th>
    </tr>
    <?php if(isset($row)): ?>
        <tr>
            <td><?= $row['name'] ?? '' ?></td>
            <td><?= $row['email'] ?? '' ?></td>
            <td><?= $row['phone'] ?? '' ?></td>
            <td><?= $row['address'] ?? '' ?></td>
        </tr>
    <?php endif; ?>
    </table>

        <h2>New Client</h2>
        <form action='' method='post'>
            <input type="hidden" name="id" value=<?= $id ?>>

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
                <button type="submit" class="btn btn-success">Update</button>
               </div>

               <div class="col-sm-3 d-grid">
                <a href="home.php" class="btn btn-outline-danger" role="button">Cancel</a>
               </div>

            </div>
        </form>
    </div>

</body>

</html>