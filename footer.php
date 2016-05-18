<style>
    .footBtn {
        color: white;
    }
</style>

<footer class="page-footer red darken-2">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">MovieZ</h5>
                <p class="grey-text text-lighten-4">This is a wiki database for movies that allow fans to upload content to the world with details about their favorite movies.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="index.php">Home</a></li>
                    <?php if (isset($_SESSION['username'])) {
                        echo '<li><a class="footBtn" href="logout.php">Log Out (' . $_SESSION['username'] . ')</a></li>';
                        echo '<li><a class="footBtn" href="createMoviePage.php">Make A Page</a> </li>';

                    }
                    else{
                        echo '<li><a class="footBtn" href="login.php">Login</a></li>';
                        echo '<li><a class="footBtn" href="signup.php">Sign Up</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2016 Copyright MovieZ
        </div>
    </div>
</footer>
</body>
