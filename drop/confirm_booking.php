<?php
include '../db/dbconn.php'; // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the pickuppoint and dropoffpoint values from the form
    $pickuppoint = $_POST['pickuppoint'];
    $dropoffpoint = $_POST['dropoffpoint'];
    $dropoffTodaName = $_POST['dropoffTodaName'];
    $status = "pending";
    $fare = $_POST['fare'];
    $convenienceFee = $_POST['convenienceFee'];
    $passengerCount = $_POST['passengerCount'];
    $driverETA = $_POST['driverETA'];
    $distanceKilometers = $_POST['distanceKilometers'];


    // Perform the database update (insert or update, depending on your use case)
    $sql = "INSERT INTO booking (pickuppoint, dropoffpoint, toda, status, fare, convenienceFee, passengerCount, driverETA, distance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $pickuppoint, $dropoffpoint, $dropoffTodaName, $status, $fare, $convenienceFee, $passengerCount, $driverETA, $distanceKilometers);

    if ($stmt->execute()) {
        // Booking successfully saved in the database
        echo "Booking confirmed and saved.";
    } else {
        // Handle the case where the database update fails
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}

?>