<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>

<form action="add.php" method="post" enctype="multipart/form-data">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="foto">Foto:</label>
    <input type="file" name="foto" accept="image/*" required><br>

    <input type="submit" name="Submit" value="Tambah">
</form>

<?php
// Include database connection file
include_once("config.php");

// Check if form is submitted for user addition
if(isset($_POST['Submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    // Process the uploaded file
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_path = "uploads/".$foto;

    // Move uploaded file to the designated folder
    move_uploaded_file($foto_tmp, $foto_path);

    // Insert user data into database
    $result = mysqli_query($mysqli, "INSERT INTO users(nama,email,foto) VALUES('$nama','$email','$foto')");

    // Show success message
    echo "User added successfully. <a href='index.php'>View Users</a>";
}
?>

</body>
</html>