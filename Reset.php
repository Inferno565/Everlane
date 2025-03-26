<?php
// if (isset($_POST)) {
//     echo "I am working";
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="shortcut icon" href="Images/log.ico">
</head>

<body>
    <div class="container">
        <form autocomplete="off" method="post" action="">
            <h2>Reset Password</h2>
            <div class="input-group">
                <input type="text" name="email" required>
                <label>Email </label>
                <span class="line"></span>
            </div>
            <button type="submit" name="submit">Get Code</button>

        </form>
    </div>
    <!-- PHP CODE -->
    <?php
    $host = "localhost";
    $user = "root";
    $database_name = "everlane";
    $password = "";
    $conn = mysqli_connect($host, $user, $password, $database_name);
    // if (!$conn) {
    //     die("Connection failed: " . mysqli_connect_error());
    // }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['email'];
        mail($username, "EverLane Reset Password", "Your Code for resetting the password is:.$code");
        $conn = mysqli_connect($host, $user, $password, $database_name);

        $query = "SELECT '$username' FROM `user` WHERE `user_email`='$username'";

        //fetching result
        $result = mysqli_query($conn, $query);
        $user_info = mysqli_fetch_assoc($result);

        // Check if user exists
        if (!$user_info) { //if user not found in the database
            echo "<script> alert('Please enter a valid email')</script>";
        } else {
            $code = rand(1, 9999);
            // echo $code;

            echo "<script>alert('An OTP was sent to your email');</script> ";
        }
        mysqli_close($conn);
    }

    ?>
</body>

</html>