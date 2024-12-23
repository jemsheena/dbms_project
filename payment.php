<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="style.css">
    <style>
        header nav ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
            text-align: right;
        }

        header nav ul li {
            display: inline-block;
            margin-left: 10px;
        }

        header nav ul li a {
            color: #eee;
            text-decoration: none;
        }
        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            }
        .button-container form {
            margin: 0 10px;
        }
        .button-container input[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-container input[type="submit"]:hover {
            background-color: #555;
        }

    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html"> Log Out</a></li>
            </ul>
        </nav>
        <h1>Payment Here</h1>

    </header>

    <main>
        <h2>Booking Details</h2>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "travelS");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $booking_id = isset($_GET['Booking_ID']) ? $_GET['Booking_ID']: '';
        $username = isset($_GET['username']) ? $_GET['username']: '';
        $sql = "SELECT * 
        FROM booking b 
        JOIN packages p ON b.Package_ID = p.P_ID 
        JOIN hotel h ON b.Hotel_ID = h.Hotel_ID 
        JOIN vehicle v ON b.Vehicle_ID = v.V_ID 

        WHERE Booking_ID='$booking_id'";
        

       

        $res = $conn->query($sql);
        if (!$res) {
            echo "fail";
        }
        
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo "<div>";
                echo "<p><strong>Booking ID:</strong> " . $row['Booking_ID'] . "</p>";
                echo "<p><strong>Booking Date:</strong> " . $row['Booking_Date'] . "</p>";

                echo "<p><strong>Customer Name:</strong> " . $row['Customer_ID'] . "</p>";
                echo "<p><strong>Package Cost:</strong> " . $row['P_cost'] . "</p>";

                echo "<p><strong>Package Duration:</strong> " . $row['P_duration'] . "</p>";
                echo "<p><strong>Hotel ID:</strong> " . $row['Hotel_ID'] . "</p>";
                echo "<p><strong>Hotel Cost:</strong> " . $row['H_cost'] . "</p>";

                echo "<p><strong>Vehicle ID:</strong> " . $row['Vehicle_ID'] . "</p>";
                echo "<p><strong>Vehicle Cost:</strong> " . $row['V_cost'] . "</p>";

                
                $v_cost = $row['V_cost'];

                $h_cost = $row['H_cost'];
                $p_duration = intval($row['P_duration']);
                $p_cost = $row['P_cost'];
                $total_cost = ($h_cost * $p_duration) + ($v_cost * $p_duration)+ $p_cost;

                echo "<p><strong>Total cost:</strong> " . number_format($total_cost, 2) . "</p>";
                


                echo "</div>";
            }
            echo '<div class="button-container">';

            echo '<form action="final.php" method="post">';
            echo '<input type="hidden" name="username" value="' . $username . '">';
            echo '<input type="hidden" name="total_cost" value="' . $total_cost . '">';
            echo '<input type="submit" name="pay_now" value="Pay Now">';
            echo '</form>';

            echo '<form action="dashboard.php" method="post">';
            echo '<input type="submit" name="cancel" value="Cancel">';
            echo '</form>';
            echo '</div>';

        } else {
            echo "<p>No booking details found.</p>";

        }
        $conn->close();
        ?>
         
    </main>
</body>
</html>
