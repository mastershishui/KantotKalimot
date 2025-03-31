<?php
session_start();
$conn = new mysqli("localhost", "root", "", "webs_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        die("Error: Email or Password is missing!");
    }

    // Fetch user details
    $stmt = $conn->prepare("SELECT id, first_name, last_name, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $first_name, $last_name, $user_email, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $user_id;
            $_SESSION["first_name"] = $first_name;
            $_SESSION["last_name"] = $last_name;
            $_SESSION["user_email"] = $user_email;

            header("Location: dashboard.php");
            exit;
        } else {
            die("Incorrect password.");
        }
    } else {
        die("No user found with that email.");
    }

    $stmt->close();
}
$conn->close();
?>
