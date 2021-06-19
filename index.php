<?php 

// $user_ip = $_SERVER["REMOTE_ADDR"]; // This is dynamic ip
$user_ip = "43.245.140.24"; // This is static ip
$json = file_get_contents("https://api.pray.zone/v2/times/today.json?ip=" . $user_ip . "&timeformat=1");
$json_array = json_decode($json, true);
if ($json_array["status"] == "OK") {
    $imsak = $json_array["results"]["datetime"][0]["times"]["Imsak"];
    $Sunrise = $json_array["results"]["datetime"][0]["times"]["Sunrise"];
    $Fajr = $json_array["results"]["datetime"][0]["times"]["Fajr"];
    $Dhuhr = $json_array["results"]["datetime"][0]["times"]["Dhuhr"];
    $Asr = $json_array["results"]["datetime"][0]["times"]["Asr"];
    $Sunset = $json_array["results"]["datetime"][0]["times"]["Sunset"];
    $Maghrib = $json_array["results"]["datetime"][0]["times"]["Maghrib"];
    $Isha = $json_array["results"]["datetime"][0]["times"]["Isha"];
    $Midnight = $json_array["results"]["datetime"][0]["times"]["Midnight"];
    $country = $json_array["results"]["location"]["country"];
    $city = $json_array["results"]["location"]["city"];
    $timezone = $json_array["results"]["location"]["timezone"];
} else {
    echo "<h1>Not available in your country!!!</h1>";
    die();
}

?>

<!DOCTYPE html>
<!--
  This site created by Pure Coding
  ===============================================
  Website: https://akhfasoft.net/
  YouTube: https://youtube.com/PureCoding
  GitHub: https://github.com/MusabDev
  Twitter: https://twitter.com/CodingPure
  Discord: https://discord.com/invite/U3hhb6Q9De
  ===============================================
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>Prayer Time — Check your next prayer time.</title>
    <meta name="title" content="Prayer Time — Check your next prayer time.">
    <meta name="description" content="This is a Prayer Time checker. It means you can check your today prayer times.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://prayertimedev.herokuapp.com/">
    <meta property="og:title" content="Prayer Time — Check your next prayer time.">
    <meta property="og:description" content="This is a Prayer Time checker. It means you can check your today prayer times.">
    <meta property="og:image" content="https://prayertimedev.herokuapp.com/assets/screenshot/1.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://prayertimedev.herokuapp.com/">
    <meta property="twitter:title" content="Prayer Time — Check your next prayer time.">
    <meta property="twitter:description" content="This is a Prayer Time checker. It means you can check your today prayer times.">
    <meta property="twitter:image" content="https://prayertimedev.herokuapp.com/assets/screenshot/1.png">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.jpg" type="image/x-icon">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- #Hero Section# -->
    <div class="hero-section">
        <div class="container">
            <div class="content">
                <h1 class="title"><span>Prayer</span>Time</h1>
                <p class="about">This is a Prayer Time checker. It means you can check your today prayer times.</p>
                <a href="#times" class="btn">Check Now</a>
            </div>
        </div>
    </div>
    
    <!-- #Times Section# -->
    <section class="section times" id="times">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $imsak; ?></div>
                        <div class="txt">Imsak</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $Sunrise; ?></div>
                        <div class="txt">Sunrise</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $Fajr; ?></div>
                        <div class="txt">Fajr</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $Dhuhr; ?></div>
                        <div class="txt">Dhuhr</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $Asr; ?></div>
                        <div class="txt">Asr</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $Sunset; ?></div>
                        <div class="txt">Sunset</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $Maghrib; ?></div>
                        <div class="txt">Maghrib</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $Isha; ?></div>
                        <div class="txt">Isha</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $Midnight; ?></div>
                        <div class="txt">Midnight</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $country; ?></div>
                        <div class="txt">Country</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $city; ?></div>
                        <div class="txt">City</div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="time"><?php echo $timezone; ?></div>
                        <div class="txt">Timezone</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- #Footer Section# -->
    <footer>
        <div class="container">
            <p class="footer-text">Coded and maintained with ❤️ by <a href="https://www.youtube.com/PureCoding/" target="_blank">Pure Coding</a> © 2021</p>
        </div>
    </footer>
</body>
</html>
