<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "delivary";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $Age = htmlspecialchars(trim($_POST["Age"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    if (!empty($username) && !empty($email) && !empty($Age) && !empty($password)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO register (username,email , Age ,password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $password,$Age,$password);

        // Execute statement
        if ($stmt->execute()) {
            echo "New record created successfully";
            header('location:home.html');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}

// Close connection
$conn->close();
?>
