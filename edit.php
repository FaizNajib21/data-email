<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

<?php
// Include database connection file
include_once("config.php");

// Check if the form is submitted
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    // Process the uploaded file if a new one is provided
    if ($_FILES['foto']['size'] > 0) {
        $foto = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_path = "uploads/".$foto;

        // Move uploaded file to the designated folder
        move_uploaded_file($foto_tmp, $foto_path);

        // Update user data with the new photo
        $result = mysqli_query($mysqli, "UPDATE users SET nama='$nama',email='$email',foto='$foto' WHERE id=$id");
    } else {
        // Update user data without changing the existing photo
        $result = mysqli_query($mysqli, "UPDATE users SET nama='$nama',email='$email' WHERE id=$id");
    }

    // Redirect to the index page after updating
    header("Location: index.php");
}

// Get the user ID from the URL parameter
$id = $_GET['id'];

// Fetch user data from the database
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

while($user_data = mysqli_fetch_array($result)) {
    $nama = $user_data['nama'];
    $email = $user_data['email'];
    $foto = $user_data['foto'];
}
?>

<form action="edit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>

    <label for="nama">Nama:</label>
    <input type="text" name="nama" value="<?php echo $nama;?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $email;?>" required><br>

    <label for="foto">Foto:</label>
    <input type="file" name="foto" accept="image/*"><br>

    <!-- Display existing photo -->
    <img src="uploads/<?php echo $foto;?>" height='50' width='50'><br>

    <input type="submit" name="update" value="Update">
</form>

</body>
</html>