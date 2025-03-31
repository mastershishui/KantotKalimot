<?php
session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: login.html");
    exit;
}

// Default profile picture (You can replace this with user-uploaded images)
$profile_picture = "ddd.jfif"; // Make sure this image exists
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 1000vh;
            margin: 0;
            font-family: "Times New Roman", Times, serif;
            background-color:rgb(0, 0, 0);
        }
        .dashboard-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-align: left;
    background: white;
    padding: 100px;
    border-radius: 150px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 50000px;
}

.profile-picture {
    width: 250px;
    height: 250px;
    border-radius: 100%;
    object-fit: cover;
    border: 3px solid rgb(6, 66, 131);
    margin-left: 20px; /* Adds spacing between text and picture */
}

        
        h1 {
            margin-bottom: 10px;
            color: #333;
        }
        p {
            color: #555;
            font-size: 18px;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background:rgb(0, 0, 0);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" class="profile-picture">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["first_name"] . " " . $_SESSION["last_name"]); ?>!</h1>
        <p>Your email: <?php echo htmlspecialchars($_SESSION["user_email"]); ?></p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
