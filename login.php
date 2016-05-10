<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="signstyle.css">
    <meta charset="UTF-8">
    <title>Log in for Moviez</title>
</head>
<body>
<br>
<header>
    <a href="index.php" class="logo">
        <strong><em>Moviez</em></strong>
    </a>
    <nav>
        <ul>
        </ul>
    </nav>
</header>
<section>
    <h1>Welcome to <em>Moviez</em></h1>
    <p>Log in to make more pages or edit your existing ones</p>
</section>
<?php
// Start the session
session_start();
// Clear the error message
$error_msg = "";
// If the user isn't logged in, try to log them in
if (!isset($_SESSION['idusers'])) {
    if (isset($_POST['submit'])) {
        // Connect to the database
        $dbh = new PDO('mysql:host=localhost;dbname=MovieZ', 'root', 'root' );

        // Grab the user-entered log-in data
        $user_username = trim($_POST['username']);
        $user_password = trim($_POST['password']);

        if (!empty($user_username) && !empty($user_password)) {
            // Look up the username and password in the database
            $query = "SELECT idusers, username FROM users WHERE username = '$user_username' AND password = '$user_password'";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(
                'user_username' => $user_username,
                'user_password' => $user_password
            ));

            $results = $stmt->fetchAll();

            if (count($results) == 1) {
                // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
                $row = $results[0];
                $_SESSION['idusers'] = $row['idusers'];
                $_SESSION['username'] = $row['username'];
                setcookie('idusers', $row['idusers'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
                setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
                $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
                header('Location: ' . $home_url);
            }
            else {
                // The username/password are incorrect so set an error message
                $error_msg = 'Sorry, you must enter a valid username and password to log in.';
            }
        }
        else {
            // The username/password weren't entered so set an error message
            $error_msg = 'Sorry, you must enter your username and password to log in.';
        }
    }
}
// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
if (empty($_SESSION['idusers'])) {
    echo '<p class="error">' . $error_msg . '</p>';
    ?>
<div class="form-wrap">
    <div class="tabs">
        <h3 class="signup-tab"><a  href="signup.php">Sign Up</a></h3>
        <h3 class="login-tab"><a class="active" href="login.php">Login</a></h3>
    </div>
    <div class="tabs-content">
        <div id="signup-tab-content" class="active">
            <form class="signup-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                     <input type="text" class="input" id="username" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" autocomplete="off" placeholder="Username" /><br />
                     <input type="password" class="input" name="password" id="password" autocomplete="off" placeholder="Password"/>
                     <input type="submit" class="button" value="Log In" name="submit" />
            </form>
        </div>
    </div>
</div>
    <?php
}
else {
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
}
?>
</body>
</html>