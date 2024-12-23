<?php

$conn = mysqli_connect("localhost", "root", "", "travelS");
if (!$conn) {
    echo "fail";
    exit;
}
$username = isset($_GET['username']) ? $_GET['username'] : '';

$package_sql = "SELECT * FROM packages WHERE P_ID = 3";
$package_result = $conn->query($package_sql);
$package = $package_result->fetch_assoc();

$vehicles_sql = "SELECT * FROM vehicle";
$vehicles_result = $conn->query($vehicles_sql);

$accommodations_sql = "SELECT * FROM accommodation";
$accommodations_result = $conn->query($accommodations_sql);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $package['P_name']; ?></title>
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
        .details {
            margin: 10px 0;
        }
        .options {
            margin: 10px 0;
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
    </header>
    <h1><?php echo $package['P_name']; ?></h1>
    <p>Cost: <?php echo $package['P_cost']; ?> INR</p>
    <p>Duration: <?php echo $package['P_duration']; ?></p>
    <p>No of persons: 2</p>

    
    <form method="post" action="book_package.php">
        <input type="hidden" name="package_id" value="<?php echo $package['P_ID']; ?>">
        <input type="hidden" name="username" value="<?php echo $username; ?>"> 


        <label for="vehicleType">Select a vehicle type:</label>
        <select id="vehicleType" name="selectedVehicle">
            <option value="">Select a vehicle type</option>
            <?php while ($vehicle = $vehicles_result->fetch_assoc()) : ?>
                
                <option value="<?php echo $vehicle['V_ID']; ?>">
                    <?php echo $vehicle['V_type'] . ' (' . $vehicle['Capacity'] . ' seats) - ' . $vehicle['V_cost'] . ' Rupees'; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="accommodationType">Select an accommodation type:</label>
        <select id="accommodationType" name="selectedAccommodation" onchange="fetchHotels(this.value)">
            <option value="">Select an accommodation type</option>
            <?php while ($accommodation = $accommodations_result->fetch_assoc()) : ?>
                <option value="<?php echo $accommodation['A_ID']; ?>"><?php echo $accommodation['A_type']; ?></option>
            <?php endwhile; ?>
        </select>

        <div id="hotelOptions" class="options">
            <label for="selectedHotel">Select a hotel:</label>
            <select id="selectedHotel" name="selectedHotel">
                <option value="">Select a hotel</option>
            </select>
            

        </div>

        <button type="submit">Book Package</button>
    </form>

    <script>

        function fetchHotels(accommodationId) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_hotels.php?accommodation_id=' + accommodationId, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    document.getElementById('hotelOptions').innerHTML = this.responseText;
                };                
            };
            xhr.send();
        }

    </script>
</body>
<footer>
    <p> Note:Other expenses including hotel and vehicle expenses will be added later. They are not included in the package cost.</p>
</footer>
</html>

<?php
$conn->close();
?>
