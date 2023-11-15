<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            text-align: left;
            max-width: 300px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
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
    <img src="uploads/<?php echo $foto;?>" widht='100' height='100'><br>

    <input type="submit" name="update" value="Update">
</form>

</body>
</html>
