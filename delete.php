<?php
// Include database connection file
include_once("config.php");

// Get the user ID from the URL parameter
$id = $_GET['id'];

// Delete user data from the database
$result = mysqli_query($mysqli, "DELETE FROM users WHERE id=$id");

// Redirect to the index page after deleting
header("Location:index.php");
?>