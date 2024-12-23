<?php
$conn = mysqli_connect("localhost", "root", "", "travelS");
if(!$conn)
	echo "fail";

$accommodation_id = $_GET['accommodation_id'];
$hotels_sql = "SELECT h.Hotel_ID, h.H_name,h.H_cost FROM hotel h
               JOIN Hotel_Accommodation ha ON h.Hotel_ID = ha.Hotel_ID
               WHERE ha.A_ID = $accommodation_id";
$hotels_result = $conn->query($hotels_sql);


$options = "<h3>Select Hotel</h3><select name='hotel'>";
while ($hotel = $hotels_result->fetch_assoc()) {
    $options .= "<option value='" . $hotel['Hotel_ID'] . "'>" . $hotel['H_name'] . "</option>";
    echo "<option value='" . $hotel['Hotel_ID'] . "'>" . $hotel['H_name'] . " (" . $hotel['H_cost'] . " Rupees)</option>";
    
    
}
$options .= "</select>";

echo $options;


$conn->close();
?>
