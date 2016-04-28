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
$error_msg = "";
$dbh = new PDO('mysql:host=localhost;dbname=', 'root', 'root');
if(isset($_POST['submit'])) {


    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $picture = $_POST['picture'];

    if(!empty($username) && !empty($password) && !empty($email) && !empty($picture)) {

        $query = "INSERT INTO users (username, password, email, picture, approve) VALUES ('$username', '$password', '$email','$picture', 0) ";
        $stmt = $dbh->prepare($query);
        $result = $stmt->execute(
            array(
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'picture' => $picture,
            )
        );
    }
    else {
        $error_msg = "Please enter all fields";
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