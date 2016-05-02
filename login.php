<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/signstyle.css">
    <meta charset="UTF-8">
    <title>Log in for BeanLeaf</title>
</head>
<body>
<br>
<header>
    <a href="index.html" class="logo">
        <em>Moviez</em>
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
$error_msg = "";
$dbh = new PDO('mysql:host=localhost;dbname=', 'root', 'root');
if(!isset($_POST['submit'])) {




    if (!empty($username) && !empty($password)) {
        $query = "SELECT idusers, username FROM users WHERE username= '$username' AND passoword = '$password'";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(
           'username' => $username,
            'password' => $password,
        ));
        $results = $stmt->fetchAll();

        if(count($results) == 1) {
            $row = $results[0];

        }
        else {
            $error_msg = 'Sorry, Enter a valid username and password to log in';
        }
    }
    else {
        $error_msg = "Sorry, enter your userame and password to log in";
    }
}
?>
<div class="form-wrap">
    <div class="tabs">
        <h3 class="signup-tab"><a  href="signup.php">Sign Up</a></h3>
        <h3 class="login-tab"><a class="active" href="login.php">Login</a></h3>
    </div>
    <div class="tabs-content">
        <div id="signup-tab-content" class="active">
            <form class="signup-form" action="" method="post">
                <input type="text" class="input" id="username" name="username" autocomplete="off" placeholder="Username">
                <input type="password" class="input" id="password" name="password" autocomplete="off" placeholder="Password">
                <input type="submit" class="button" value="Login">
            </form>
        </div>
    </div>
</div>
</body>
</html>