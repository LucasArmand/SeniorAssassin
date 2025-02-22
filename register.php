<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$email = $first_name = $last_name = $phone = $password = $confirm_password = "";
$email_err = $first_name_err = $last_name_err = $phone_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already in use.";
                }elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $email_err = "Invalid email format";
                }elseif(strpos($_POST["email"], "student.gvsd.org")){
                    $email_err = "Cannot use a school email.";
                }else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please enter your first name.";
    }elseif(!preg_match("/^[a-zA-Z-' ]*$/",trim($_POST["first_name"]))){
        $first_name_err = "Cannot use numbers or symbols in name.";
    }else{
        $first_name = trim($_POST["first_name"]);
    }

    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter your last name.";
    }elseif(!preg_match("/^[a-zA-Z-' ]*$/",trim($_POST["last_name"]))){
        $last_name_err = "Cannot use numbers or symbols in name.";
    }
    else{
        $last_name = trim($_POST["last_name"]);
    }

    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone number.";
    }
    elseif(!preg_match('/^[0-9]{10}+$/', $_POST["phone"])){
        $phone_err = "Please enter a correct phone number (no dashes)";
    }
    else{
        $phone = trim($_POST["phone"]);
    }
    
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($first_name_err) && empty($last_name_err) && empty($phone_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (email, first_name, last_name, phone, password) VALUES (?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_email, $param_first_name, $param_last_name, $param_phone, $param_password);
            
            

            // Set parameters
            $param_email = $email;
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_phone = $phone;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                session_start();
                // Redirect to welcome page
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["email"] = $email;
                header("location: welcome.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Personal E-mail (<i>not</i> school E-mail)</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                <span class="help-block"><?php echo $first_name_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                <span class="help-block"><?php echo $last_name_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <label>Phone Number</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                <span class="help-block"><?php echo $phone_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>