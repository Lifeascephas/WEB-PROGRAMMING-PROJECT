<?php
session_start();
$conn = new mysqli('localhost', 'username', 'password', 'webapp');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $storedHash);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $storedHash)) {
            // Set session variable and cookie
            $_SESSION['user_id'] = $userId;
            setcookie("user_session", session_id(), time() + 3600, "/"); // Set a cookie for session

            echo "Login successful!";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
    
    $stmt->close();
    $conn->close();
}
?>
