<?php
    require_once('header.php')
?>
<head>
    <link rel="stylesheet" href="css/signstyle.css">
</head>
<body>
<section>
    <h1>Welcome to <em>Moviez</em></h1>
    <p>Make an account to be able to make a page.</p>
</section>
<?php
require_once('appvars.php');

// Connect to the database
$dbh = new PDO('mysql:host=localhost;dbname=MovieZ', 'root', 'root' );

if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    if (!empty($username) && !empty($password) && !empty($email)) {
        // Make sure someone isn't already registered using this username
        $query = "SELECT * FROM users WHERE username = '$username'";
        $stmt = $dbh->prepare($query);
        $stmt->execute(
            array(
                'username'  => $username
            )
        );

        $results = $stmt->fetchAll();
        if (count($results) == 0) {
            // The username is unique, so insert the data into the database
            $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
            $data = $dbh->prepare($query);
            $data->execute(array('username'=> $username, 'password'=> $password));

            // Confirm success with the user
            echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>';

            exit();
        }
        else {
            // An account already exists for this username, so display an error message
            echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
            $username = "";
        }
    }
    else {
        echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    }
}

?>
<div class="form-wrap">
    <div class="tabs">
        <h3 class="signup-tab"><a class="active" href="signup.php">Sign Up</a></h3>
        <h3 class="login-tab"><a href="login.php">Login</a></h3>
    </div>

    <div class="tabs-content">
        <div id="signup-tab-content" class="active">
            <form class="signup-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                 <input type="text" class="input" id="username" name="username" autocomplete="on" placeholder="Username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
                 <input type="password" class="input" id="password" name="password" autocomplete="off" placeholder="Password" /><br />
                 <input type="email" class="input" id="email" name="email" autocomplete="off" placeholder="Email" /><br />
                 <input type="submit" value="Sign Up" class="button" name="submit" />
            </form>
        </div>
    </div>
</div>
<?php
    require_once('footer.php')
?>
</body>


