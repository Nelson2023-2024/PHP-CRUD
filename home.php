<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>My Shop</title>
</head>

<body>
    <div class="container my-5 ">
        <h2>List of Clients</h2>
        <a href="create.php" class="btn btn-primary">+ New Client</a>
        <br>
        <table class="table ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                require('mysqli_connect.php');
                ?>
                <tr>
                    <td>ID</td>
                    <td>Bill Gates</td>
                    <td>bill@microsoft.com</td>
                    <td>+254115720771</td>
                    <td>New York, USA</td>
                    <td>09/01/2024</td>
                    <td>
                        <a href="edit.php" class="btn btn-primary">Edit</a>
                        <a href="delete.php" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>