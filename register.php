<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match";
        // Optionally, you can redirect back to the registration page with an error message
        // header("Location: registration.php?error=passwords_mismatch");
        exit();
    }

    // Database Connection
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "auth";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert new user into the database
    $insert_query = "INSERT INTO login (username, password) VALUES ('$username', '$password')";

    if ($conn->query($insert_query) === TRUE) {
        // Registration successful
        header("Location: success.html"); // Redirect to success page
        exit();
    } else {
        // Registration failed
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }

    $conn->close();
}
?>