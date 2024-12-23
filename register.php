<?php

$username = $_POST["username"];
$name = $_POST["name"];
$password = $_POST["password"];
$age = $_POST["age"];
$phone = $_POST["phone"];
$gender = $_POST["gender"];
$conn = mysqli_connect("localhost", "root", "", "travelS");
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO user(username,name, pswd, age, phno, gender) VALUES ('$username','$name', '$password', $age, '$phone', '$gender')";
if (mysqli_query($conn, $sql)) {
    echo "Registration successful!";
    header("Location: dashboard.php?username=" . urlencode($username));
    exit();
}else{
    echo "Error: " ;
}
mysqli_close($conn);
?>
