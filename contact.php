<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="shortcut icon" href="Images/log.ico">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <title>
        EverLane | Fashion Forward, Sustainability Centric.
    </title>
    <style>
        .header {
            background: radial-gradient(#fff, #efe1d4);
            height: 85px;
        }
    </style>
</head>

<body onload="locate()">

    <div class="header">
        <div class="container">
            <?php
            if ($_GET['session'] != 'active') {
                $GLOBALS['flag'] = 0;

                echo '
                 <div class="navbar">

                <div class="logo">
                    <a href=""><img id="logoimg" src="Images/Logo.png" alt="Insert logo here" width="200px" height="70px" onmouseout="imgmouseout(0)" onmouseover="imgmouseover(0)"></a>
                </div>


                <nav>
                    <ul id="MenuItems">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="Explore.php?session=inactive">Explore</a></li>
                        <li><a href="about.php?session=inactive">About</a></li>
                        <li><a href="contact.php?session=inactive"">Contact</a></li>

                    </ul>
                </nav>
                <a href="login.php">
                
                <img id="cartimg" src="Images/user.png" width="30px" height="30px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <img src="Images/menu.png" class="menu-icon" onclick="menutoggle()" alt="">
            </div>
            <hr color="#fff">
        </div>';
            } else {
                session_start();
                $GLOBALS['flag'] = 1;
                echo '
                     <div class="navbar">

                <div class="logo">
                    <a href=""><img id="logoimg" src="Images/Logo.png" alt="Insert logo here" width="200px" height="70px" onmouseout="imgmouseout(0)" onmouseover="imgmouseover(0)"></a>
                </div>


                <nav>
                    <ul id="MenuItems">
                        <li><a href="main.php">Home</a></li>
                        <li><a href="Explore.php?session=active">Explore</a></li>
                        <li><a href="about.php?session=active">About</a></li>
                        <li><a href="contact.php?session=active">Contact</a></li>

                    </ul>
                </nav>
               

                <a href="cart.php"><img id="cartimg" src="Images/cart.png" width="35px" height="35px" style="margin-right:20px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                 <a href="profile.php">
                    <img id="cartimg" src="Images/user.png" width="30px" height="30px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <img src="Images/menu.png" class="menu-icon" onclick="menutoggle()" alt="">
            </div>
            <hr color="#fff">
        </div>
</div>
                    ';
            }
            ?>

            <div class="feedback-container">
                <div class="feedbackform">
                    <form action="" method="post">
                        <h2>Send us your queries/comments😊</h2>
                        <div class="input-group">
                            <input type="text" name="username" id="user" required onkeyup="validateEmail()">
                            <label>Email or username </label>
                            <span class="line"></span>
                            <p id="emailValidationText" class="validation-text"></p>

                        </div>
                        <div class="input-group">
                            <label>Your Say..</label>
                            <textarea type="textarea" name="feed" required></textarea>
                            <span style="top: 100px;" class="line"></span>
                        </div>
                        <button type="submit" name="submit">Submit</button>
                    </form>
                </div>
                <h2 style="margin-top: 70px;">Our Location</h2>
                <div class="map" id="map" style="width: 700px;height:500px">
                </div>
                <button onclick="locateu()">View my location</button>
                <h2 style="margin-top: 70px;">Your Location</h2>

                <div class="map" id="map1" style="width: 600px;height:400px">
                </div>
            </div>
            <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="footer-col-1">
                            <h3>Download Our App</h3>
                            <p>Download app for Android and IOS mobile phone.</p>
                            <div class="app-logo">
                                <img src="Images/play-store.png" id="playstore" onmouseout="imgmouseout(5)" onmouseover="imgmouseover(5)" alt="">
                                <img src="Images/app-store.png" id="appstore" onmouseout="imgmouseout(6)" onmouseover="imgmouseover(6)" alt="">
                            </div>
                        </div>
                        <div class="footer-col-2">
                            <img src="Images/LOGO.png" width="200px" height="50px" style="border-style: dashed;" alt="">
                            <p>Where everything you need to know <br> is only an arm’s length away!</p>
                        </div>
                        <div class="footer-col-3">
                            <h3>Useful Links</h3>
                            <ul>
                                <a href="">
                                    <li>Coupons</li>
                                </a>
                                <a href="">
                                    <li>Blog Post</li>
                                </a>
                                <a href="">
                                    <li>Return Policy</li>
                                </a>
                                <a href="">
                                    <li>Join Affiliate</li>
                                </a>
                            </ul>
                        </div>
                        <div class="footer-col-4">
                            <h3>Follow Us</h3>
                            <ul>
                                <a href="">
                                    <li>Facebook</li>
                                </a>
                                <a href="">
                                    <li>Twitter</li>
                                </a>
                                <a href="">
                                    <li>Instagram</li>
                                </a>
                                <a href="">
                                    <li>Youtube</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <p class="copyright">Copyright 2020</p>
                </div>

            </div>
            <script>
                var MenuItems = document.getElementById("MenuItems");

                MenuItems.style.maxHeight = "0px";

                function menutoggle() {
                    if (MenuItems.style.maxHeight == "0px") {
                        MenuItems.style.maxHeight = "200px"
                    } else {
                        MenuItems.style.maxHeight = "0px"
                    }
                }

                function opencategory() {
                    window.open("categories.html", "_self");
                }
                // Creating map options
                function locate() {
                    var mapOptions = {
                        center: [18.99030796393938, 73.12766574319119],
                        zoom: 10
                    }

                    // Creating a map object
                    var map = new L.map('map', mapOptions);

                    // Creating a Layer object
                    var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

                    // Adding layer to the map
                    map.addLayer(layer);

                    // Creating a marker
                    var marker = L.marker([18.99030796393938, 73.12766574319119]);

                    // Adding marker to the map
                    marker.addTo(map);
                    var circle = L.circle([18.99030796393938, 73.12766574319119], {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.5,
                        radius: 500
                    }).addTo(map);
                }

                function locateu() {
                    var map = L.map('map1').setView([0, 0], 2);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    map.locate({
                        setView: true,
                        maxZoom: 16
                    });

                    function onLocationFound(e) {
                        var radius = e.accuracy / 2;

                        L.marker(e.latlng).addTo(map)
                            .bindPopup("You are within " + radius + " meters from this point").openPopup();

                        L.circle(e.latlng, radius).addTo(map);
                    }

                    function onLocationError(e) {
                        alert("Error locating your position: " + e.message);
                    }

                    map.on('locationfound', onLocationFound);
                    map.on('locationerror', onLocationError);


                }

                function validateEmail() {
                    const emailInput = document.getElementById("user").value;
                    const emailValidationText = document.getElementById("emailValidationText");
                    const isValidEmail = validateEmailFormat(emailInput);

                    if (!isValidEmail) {
                        emailValidationText.textContent = "Please enter a valid email";
                    } else {
                        emailValidationText.textContent = "";
                    }
                }

                function validateEmailFormat(email) {
                    const re = /\S+@\S+\.\S+/;
                    return re.test(email);
                }
            </script>
            <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>

            <?php
            include("connection.php");

            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $feed = mysqli_real_escape_string($conn, $_POST['feed']);
                // Validate email format with JavaScript
                echo '<script>
            function validateEmail(email) {
                const re = /\S+@\S+\.\S+/;
                return re.test(email);
            }
            const email = "' . $username . '";
            if (!validateEmail(email)) {
                alert("Please enter a valid email address");
            }
          </script>';

                // Validate email format with PHP
                if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                    echo '<script>
                alert("Please enter a valid email address");
                             </script>';
                } else {

                    $insert_query = "INSERT INTO `feedback` (`user_name`, `feed`) VALUES ('$username', '$feed')";
                    $insert_result = mysqli_query($conn, $insert_query);

                    if ($insert_result) {
                        echo '<script>alert("Review submitted successfully!");</script>';
                    } else {
                        echo '<script>alert("Failed to submit review.");</script>';
                    }
                }
            }
            ?>
</body>

</html>