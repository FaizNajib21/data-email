<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>CRUD with Photo</title>
</head>
<body>

<?php
// Include database connection file
include_once("config.php");

// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
?>

    <header>
        <h1>Database Email Siswa</h1>
    </header>

    <table width='80%' border=1>

    <tr>
        <th>Nama</th> <th>Email</th> <th>Foto</th> <th>Update</th>
    </tr>
    <?php
    while($user_data = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$user_data['nama']."</td>";
        echo "<td>".$user_data['email']."</td>";
        echo "<td><img src='uploads/".$user_data['foto']."' widht='100' height='100'></td>";
        echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]'>Delete</a></td></tr>";
    }
    ?>
    </table>
    <a id="tambahBtn" href="add.php">Tambah User</a><br/><br/>

</body>
</html>