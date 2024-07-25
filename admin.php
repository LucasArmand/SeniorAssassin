<?php
// Initialize the session
session_start();

require_once "config.php";

if(!($_SESSION["email"] == "lucas@4116pa.com" && $_SESSION["id"] = 1)){
    header("location: welcome.php");
    exit;
}
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if($_POST!=null && isset($_POST['targets'])){
    assignTargets();
    header("location:admin.php");
}
if($_POST!=null && isset($_POST['pay'])){
    pay($_POST["pay"]);
    header("location:admin.php");
}

function pay($person){
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    echo $person;
    $sql = "UPDATE users SET paid = 1 WHERE email = '" . $person ."'";
    mysqli_query($link, $sql);

}

function assignTargets(){
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $sql = "SELECT email FROM users";
    $result = mysqli_query($link, $sql);
    $player_pool = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $player_pool[] = $row["email"];
        }
    }
    shuffle($player_pool);
    for($i = 0; $i < count($player_pool) - 1 ; $i++){
        $sql = "UPDATE users SET target='" . $player_pool[$i + 1] . "' WHERE email='" . $player_pool[$i] . "'";
        mysqli_query($link,$sql);
    }
    $sql = "UPDATE users SET target='" . $player_pool[0] . "' WHERE email='" . $player_pool[count($player_pool) - 1] . "'";
        mysqli_query($link,$sql);


}


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <meta name="google" content="notranslate">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header" id="demo">
        <h1>Admin Dashboard</h1>
    </div>
    <div style="margin: auto; max-width:1000px;">
   
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group" style="margin:20px">
            <a style="margin:10px"href="welcome.php" class="btn btn-danger"">Back to Main Page</a>
            <input style="margin:10px" type="submit" name = "targets" class="btn btn-primary" value="Assign Targets">
        </div>
    </form>
    <div class="table-responsive">
    <?php
    $sql = "SELECT * FROM users";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        echo "<table class = 'justify-content-center table table-striped table-bordered'><thead><tr><th class='text-center'>Email</th><th class='text-center'>Paid</th><th class='text-center'>First Name</th><th class='text-center'>Last Name</th><th class='text-center'>Phone</th><th class='text-center'>Target</th></tr></thead><tbody>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" 
            .$row["email"] . "</td><td>"
            .($row["paid"]?"Paid":('<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) .'" method="post"><input type="submit" name="pay" value="Pay"/> <input type="hidden" name = "pay" class="btn btn-primary" value="'.$row["email"].'"></form>')) . "</td><td>"
            .$row["first_name"] . "</td><td>" 
            .$row["last_name"] . "</td><td>" 
            .$row["phone"] . "</td><td>" 
            .$row["target"] ."</td></tr>";
        }
        echo "</tbody></table>";
    }
    ?>
    </div>

    </div>
</body>
</html>