
<!DOCTYPE html>
<html>
<head>
    <title>Payment Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .success {
            color: green;
            font-size: 20px;
            font-weight: bold;
        }
        .error {
            color: red;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "travelS");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $username = $_POST['username'];
        $total_cost = $_POST['total_cost'];
        $sql = "INSERT INTO payment (u_name, Pay_amount) VALUES ('$username', '$total_cost')";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='success'>Payment successful.</p>";
    
        } else {
            echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
        $conn->close();
        ?>
        <a href="dashboard.php">Go Back to Home</a>
    </div>
</body>
</html>
