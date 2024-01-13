<?php
require('./mysqli_connect.php');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
   if(isset($_GET['id'])){
    $id = $_GET['id'];
    $delete_query = "DELETE FROM clients WHERE id = ?";
    $delete_stmt = mysqli_stmt_init($dbcon);
    mysqli_stmt_prepare($delete_stmt, $delete_query);
    mysqli_stmt_bind_param($delete_stmt,'i',$id);
    if(mysqli_stmt_execute($delete_stmt)){
        echo "<script>alert('Deleted succefully'); window.location.href = 'home.php'</script>";
    }
   }
}

?>
