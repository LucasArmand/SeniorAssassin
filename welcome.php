<?php
// Initialize the session
session_start();
 

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";
$isAdmin = false;
$sql = "SELECT * FROM users WHERE email = '" . $_SESSION["email"] . "'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $_SESSION["first_name"] = $row["first_name"];
    $_SESSION["last_name"] = $row["last_name"];
    $_SESSION["phone"] = $row["phone"];
    $_SESSION["target"] = $row["target"];
    $_SESSION["paid"] = $row["paid"];
  }
}

//ADMIN MENU
if($_SESSION["email"] == "lucas@4116pa.com" && $_SESSION["id"] = 1){
    $isAdmin = true;
}

function getTargetName(){
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($_SESSION["target"] != null){
        $sql = "SELECT first_name, last_name FROM users WHERE email = '" . $_SESSION["target"] . "'";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
            return ($row["first_name"] . " " . $row["last_name"]);
            }
        }
    }else{
        return null;
    }

}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://www.paypal.com/sdk/js?client-id=AUqTosBDN7fssA8iuojHCbsH0agTHYY8Y0k7y7EcDrFBnIcNu3aefdZcocvN3wktOEgA5dcoDDEYW90B"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css";>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
   
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
   
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["first_name"]) . " " . htmlspecialchars($_SESSION["last_name"]); ?></b>. Welcome to Senior Assassin.</h1>
    </div>
    <div>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        
        <?php if($isAdmin){
            echo "<a href='admin.php' class='btn btn-info'>Access Admin Page</a>";
        }
        ?>
    </div>
    <hr>
    <div class="well" style="background-color:black">
    <h1 class="text-responsive" style="color:green font-family:DigitalDream" id="timer"></h1>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("April 22, 2021 15:37:25").getTime();
        function updateTimer(){
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="timer"
            document.getElementById("timer").innerHTML = days + ":" + ("0" + hours).slice(-2) + ":"
            + ("0" + minutes).slice(-2) + ":" + ("0" + seconds).slice(-2) + "";
        }
        updateTimer();
        // Update the count down every 1 second
        var x = setInterval(updateTimer(), 1000);
    </script>
    </div>
    <div class="row">
    <?php
        echo "<div class='well col-sm-4'>";
        if(getTargetName()){
            echo "<p>Your target is <b>" . getTargetName() . "</b></p>";
        }else{
            echo "<p>You don't have a target right now...</p>";
        }
        echo "</div>";
        echo "<div class='well col-sm-4'>";
        if($_SESSION["paid"]){
           echo "<p>Thank you for paying!</p>";
        }else{
            echo "<p>You still need to pay!</p>";
        }
        echo "</div>";
        echo "<div class='well col-sm-4'>";
        if($_SESSION["signedForm"]){
           echo '<a href="rules.php" class="btn btn-info">Rules</a><p>You have agreed to the rules.</p>';
        }else{
            echo '<a href="rules.php" class="btn btn-info">Rules</a><p>You still need to agree to the rules!</p>';
        }
        echo "</div>";
        ?>
    </div>
</body>
</html>