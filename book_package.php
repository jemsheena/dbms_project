<?php


$conn = mysqli_connect("localhost", "root", "", "travelS");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

   
  
 
$conn->begin_transaction();
$hotel_id = $_POST['hotel'];
$package_id = $_POST['package_id'];
$selected_vehicle = $_POST['selectedVehicle'];
$selected_accommodation = $_POST['selectedAccommodation'];
$username = isset($_POST['username']) ? $_POST['username'] : '';

echo "Package ID: " . $package_id . "<br>";
echo "Selected Vehicle: " . $selected_vehicle . "<br>";
echo "Selected Accommodation: " . $selected_accommodation . "<br>";
echo "Selected username: " . $username . "<br>";
echo "Selected hotel_id: " . $hotel_id . "<br>";

$sql1 = "INSERT INTO pack_accomm_vehicle (P_ID, A_ID, V_ID)
VALUES ('$package_id', '$selected_accommodation', '$selected_vehicle')";

$sql2= "INSERT INTO booking (Package_ID, Vehicle_ID, Accommodation_ID, Hotel_ID, Customer_ID)
        VALUES ('$package_id', '$selected_vehicle', '$selected_accommodation', '$hotel_id', '$username')";

if ($conn->query($sql1) === TRUE) {
    echo "First insert successful.<br>";
} else {
    echo "Error in first insert: " . $sql1 . "<br>" . $conn->error;
    $conn->rollback(); 
}
echo "<p>Booking ID: $booking_id</p>";
if ($conn->query($sql2) === TRUE) {
    $booking_id = $conn->insert_id;
    
    $conn->commit(); 
    header("Location: payment.php?username=" . urlencode($username)."&Booking_ID=" . urlencode($booking_id));
    exit;
} else {
    echo "Error in second insert: " . $sql2 . "<br>" . $conn->error;
    $conn->rollback(); 
}


$conn->close();
?>
