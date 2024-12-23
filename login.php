<?php
$username = $_POST['username'];
$password = $_POST['password'];
$conn = mysqli_connect("localhost", "root", "", "travels");
if($conn)
	echo "success";
else
	echo "fail";

$sql = "SELECT pswd FROM user WHERE username='$username'";

$result = mysqli_query($conn, $sql);
if($row = mysqli_fetch_assoc($result)){
    if($row['pswd'] == $password){
        echo "Login successful!";
        
        header("Location: dashboard.php?username=" . urlencode($username));
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "Username not found.";
}
?>