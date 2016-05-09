<?php
require_once ('connect.php');
require_once ('startsession.php');

if (@$_POST['formSubmit']) {
    $errorMessage = false;

    if (empty($_POST['title'])) {
        $errorMessage = "<li>Enter the movie title!</li>";
    }
    if (empty($_POST['director'])) {
        $errorMessage = "<li>Enter the director of the movie!</li>";
    }
    if (empty($_POST['releaseDate'])) {
        $errorMessage = "<li>Enter the release date!</li>";
    }

    if (empty($_POST['description'])) {
        $errorMessage = "<li>Enter your description!</li>";
    }
    if (empty($_POST['rating'])) {
        $errorMessage = "<li>Enter your rating!</li>";
    }


    $stmt = $dbh->prepare("INSERT INTO `MovieZ`.`movies` (`name`, `director`, `release`, `description`, `picture`, `approve`, `rating`, `categories_idcategories`, `users_idusers`) VALUES (:title , :director, :releaseDate, :description, null, '0', :rating, :categoryId, :userId);
");

    $result = $stmt->execute(
        array(
            'title' => $_POST['title'],
            'director' => $_POST['director'],
            'releaseDate' => $_POST['releaseDate'],
            'description' => $_POST['description'],
            'rating' => $_POST['rating'],
            'categoryId' => $_POST['category'],
            'userId' => $_SESSION['idusers']
        )

    );

    if (!$result) {

    }
}
?>

<?php
require_once('header.php');
?>

<style>
    .makePgButton {
        color: white;
        text-decoration: none;
    }
</style>

<body>
<div class="container">
    <h2 class="red-text text-darken-4">Make Your Page!</h2>
    <div id="addPgFm" class="row red-form form-darken-4">
        <form method="post" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <input id="input_text" type="text" name="title">
                    <label for="input_text">Title</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="input_text2" type="text" name="director">
                    <label for="input_text2">Director</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s3">
                    <input id="releaseDt" name="releaseDate" type="text" maxlength="4">
                    <label for="releaseDt">Release Year</label>
                </div>
            </div>
            <div class="row">
                <p>
                    <input class="with-gap" name="category" type="radio" id="actionCat" />
                    <label for="actionCat">Action</label>

                    <input class="with-gap" name="category" type="radio" id="animeCat"  />
                    <label for="animeCat">Anime</label>
                </p>
                <p>
                    <input class="with-gap" name="category" type="radio" id="comedyCat" />
                    <label for="comedyCat">Comedy</label>

                    <input class="with-gap" name="category" type="radio" id="documentaryCat"  />
                    <label for="documentaryCat">Documentary</label>
                </p>
                <p>
                    <input class="with-gap" name="category" type="radio" id="dramaCat"  />
                    <label for="dramaCat">Drama</label>

                    <input class="with-gap" name="category" type="radio" id="familyCat"  />
                    <label for="familyCat">Family</label>
                </p>
                <p>
                    <input class="with-gap" name="category" type="radio" id="horrorCat"  />
                    <label for="horrorCat">Horror</label>

                    <input class="with-gap" name="category" type="radio" id="sciFiCat"  />
                    <label for="sciFiCat">Sci-Fi</label>
                </p>
            </div>
            <div class="row">
                <div class="input-field col s11">
                    <textarea id="textarea1" name="description" class="materialize-textarea"></textarea>
                    <label for="sciFiCat">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload a Cover For Your Movie!">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <h5 class="red-text text-darken-4">Score It!</h5>
                <div class="input-field col s9">
                    <p class="range-field">
                        <input type="range" name="rating" id="test5" min="0" max="100"/>
                    </p>
                </div>
            </div>
            <button class="waves-effect waves-light btn-large" type="submit" name="formSubmit" value="1"><a
                    class="makePgButton">Submit Page</a></button>
        </form>

    </div>
</div>

<?php
require_once('footer.php');
?>

</body>
