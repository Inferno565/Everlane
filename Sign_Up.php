<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="shortcut icon" href="Images/log.ico">
</head>

<body>
    <div class="container" style="height: 482px;">
        <form autocomplete="off" id="form1" method="post" action="Sign_Up.php">
            <h2>Sign Up</h2>
            <div class="input-group">
                <input type="text" name="name" required>
                <label>Name</label>
                <span class="line"></span>
            </div>
            <div class="input-group">
                <input type="text" id="email" name="email" required>
                <label id="mail-label">Email</label>
                <span class="line"></span>
            </div>
            <div class="input-group">
                <input type="password" id="pass" name="pass" required>
                <label id="pass-label">Password</label>
                <span class="line"></span>
            </div>
            <button type="submit" name="submit" value="">Done</button>
        </form>
    </div>

    <!-- PHP CODE -->
    <?php
    include('connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $encrypted_pass = password_hash($pass, PASSWORD_DEFAULT); // Encrypting the password

        if (preg_match("/([A-Za-z]+)[0-9]*@{1}([A-Za-z0-9])+.com/", $email) != 1) {
            echo "<script> alert('Please enter a valid e-mail');</script>";
        } else if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[a-zA-Z]).{8,}$/", $pass)) {
            echo "<script> alert('Password should contain at least one uppercase letter, must be a combination of letters and numbers, and should be at least 8 characters long');</script>";
        } else {
            $conn = mysqli_connect($host, $user, $password, $database_name);
            $query = "INSERT INTO `user`(`user_name`,`user_email`,`password`) VALUES ('$name', '$email', '$encrypted_pass')";
            if (!mysqli_query($conn, $query)) {
                if (mysqli_errno($conn) == 1062) {
                    echo "<script> alert('Entered email already exists in our systems');</script>";
                } else {
                    die("Error: " . mysqli_error($conn));
                }
            } else {
                echo "<script>alert('Successfully Signed up! Your email is your username');window.location.href='login.php'</script>";
            }
            mysqli_close($conn);
        }
    }
    ?>

    <script src="JS/validate.js"> </script>

</body>

</html>