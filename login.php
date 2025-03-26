
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="shortcut icon" href="Images/log.ico">
</head>

<body>
    <div class="container">
        <form autocomplete="off" method="post" action="">
            <h2>Sign In</h2>
            <div class="input-group">
                <input type="text" name="username" required>
                <label>Username </label>
                <span class="line"></span>
            </div>
            <div class="input-group">
                <input type="password" name="pass" required>
                <label>Password</label>
                <span class="line"></span>
            </div>
            <div class="check">
                <!-- <label>
                    <input type="checkbox"> Remember Me
                </label> -->
                <a href="Reset.php">Forgot Password?</a>
            </div>
            <button type="submit" name="submit">Log in</button>
            <div class="signup">
                <p>Don't have an account? <a href="Sign_Up.php">Sign Up</a></p>
            </div>
        </form>
    </div>
    <!-- PHP CODE -->
    <?php
    // $host = "localhost";
    // $user = "root";
    // $database_name = "everlane";
    // $password = "";
    include("connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $conn = mysqli_connect($host, $user, $password, $database_name);

        $query = "SELECT * FROM `user` WHERE `user_email`='$username'";

        // Fetching result
        $result = mysqli_query($conn, $query);
        $user_info = mysqli_fetch_assoc($result);

        // Check if user exists
        if (!$user_info) { // If user not found in the database
            echo "<script> alert('Invalid username or password!!!')</script>";
        } else {
            // Verify hashed password
            if (password_verify($pass, $user_info['password'])) {
                session_start();  // Start a new session
                $_SESSION['id'] = $user_info['id'];   // Store session
                echo "<script>alert('Successfully logged in!'); window.location.href='main.php'</script>";
            } else {
                echo "<script> alert('Invalid username or password!!!')</script>";
            }
        }
        mysqli_close($conn);
    }
    ?>
</body>

</html>