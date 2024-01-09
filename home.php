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

                //read from DB
                //NB - If your SQL query does not have any parameters, you don't need to use mysqli_stmt_bind_param at all.
                $select_query = "SELECT * FROM clients";
                $select_stmt = mysqli_stmt_init($dbcon);
                mysqli_stmt_prepare($select_stmt, $select_query);
                mysqli_stmt_execute($select_stmt);

                $result = mysqli_stmt_get_result($select_stmt);

                while($row = mysqli_fetch_assoc($result)){
                    echo "
                <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a href='edit.php?id=$row[id]' class='btn btn-primary'>Edit</a>
                        <a href='delete.php?id=$row[id]' class='btn btn-danger'>Delete</a>
                    </td>
                </tr>
                    ";

                }
                

                ?>
                
                
            </tbody>
        </table>
    </div>

</body>

</html>