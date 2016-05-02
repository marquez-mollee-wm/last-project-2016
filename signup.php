<html>
<head>
    <title>Signup for Moviez</title>
    <link rel="stylesheet" href="signstyle.css">
</head>
<body>
<br>
<header>
    <a href="index.html" class="logo">
        <strong><em>Moviez</em></strong>
    </a>
    <nav>
        <ul>
        </ul>
    </nav>
</header>
<section>
    <h1>Welcome to <em>Moviez</em></h1>
    <p>Make an account to be able to make a page </p>
</section>
<?php
require_once ('appvars.php');
$error_msg = "";
define('MZ_UPLOADPATH', 'images/');
$dbh = new PDO('mysql:host=localhost;dbname=MovieZ', 'root', 'root');
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $profilePic = $_FILES['profilePic']['name'];
    $profilePic_size = $_FILES['profilePic']['size'];
    $profilePic_type = $_FILES['profilePic']['type'];

    if (!empty($username) && !empty($password) && !empty($email) && !empty($profilePic)) {
        if ((($profilePic_type == 'image/gif') || ($profilePic_type == 'image/jpeg') ||
                ($profilePic_type == 'image/pjpeg') || ($profilePic_type == 'image/png')) &&
            ($profilePic_size > 0) && ($profilePic_size <= MZ_MAXFILESIZE)
        ) {
            if ($_FILES['file']['error'] == 0)
                $target = MZ_UPLOADPATH . $profilePic;
            if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $target)) {
                $name = $_POST['name'];
                $score = $_POST['score'];
                if (!empty($name) && !empty($score)) {
                    $query = "INSERT INTO users (username, password, email, profilePic) VALUES (:username, :password, :email, :picture) ";
                    $stmt = $dbh->prepare($query);
                    $result = $stmt->execute(
                        array(
                            'username' => $username,
                            'password' => $password,
                            'email' => $email,
                            'profilePic' => $profilePic,
                        )
                    );
                    echo '<p>Thanks for creating an account!</p>';
                    echo '<p><a href="index.html">&lt;&lt; Back to Main Page</a></p>';
                    // Clear the score data to clear the form
                    $username = "";
                    $passsword = "";
                    $email = "";
                } else {
                    echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no ' .
                        'greater than ' . (MZ_MAXFILESIZE / 1024) . ' KB in size.</p>';
                    @unlink($_FILES['profilePic']['tmp_name']);
                }
            } else {
                $error_msg = "Please enter all fields";
            }
        }
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
            <form class="signup-form" action="" method="post">
                <input type="text"  class="input" id="username" name="username" autocomplete="on" placeholder="Username">
                <input type="password" class="input" id="password" name="username" autocomplete="off" placeholder="Password">
                <input type="email" class="input" id="email" name="email" autocomplete="off" placeholder="Email">
                <input type="file" class="input" id="screenshot" name="screenshot">
                <input type="submit" name="submit" class="button" value="Sign Up">
            </form>
        </div>

    </div>
</div>
</body>
</html>