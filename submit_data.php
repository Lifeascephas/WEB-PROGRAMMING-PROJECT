<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in first.";
    exit;
}

$conn = new mysqli('localhost', 'username', 'password', 'webapp');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $data = $_POST['data'];

    // Insert data into submissions table using prepared statements
    $stmt = $conn->prepare("INSERT INTO submissions (user_id, data) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $data);
    $stmt->execute();

    echo "Data submitted successfully!";
    $stmt->close();
    $conn->close();
}
?>
