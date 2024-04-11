<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];


    // DataBase Connection
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "auth";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }

    //validate Login authentication
    $query = "SELECT *FROM login WHERE username='$username' AND password='$password'";

    $result = $conn->query($query);

    if($result->num_rows == 1){
        //login successful
        header("Location: success.html");
        exit();
        echo "Login Successful";

    }else{
        //login failed
        header("Location: error.html");
        echo "Login Failed";
        exit();
    }

    $conn->close();


}


?>