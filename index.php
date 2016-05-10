<?php
?>

<?php
require_once ('header.php');
?>
<style>
    #pic1{
        width: 35em;
        left: 6em;
        margin-top: 5em;
    }
    #howItWorks{
        width: 90em;
        right: 20em;
        margin-top: -30em;
        margin-bottom: 15em;
    }
    #account-user{
        : 0em;
    }
    #non-account{

    }
</style>

<body>

<div class="row">
    <div id="pic1" class="card">
        <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="moviez.png">
        </div>
        <div class="card-content">
            <span class="card-title activator red-text text-red-4">About<i class="material-icons right">more_vert</i></span>
        </div>
        <div class="card-reveal">
            <span class="card-title red-text text-red-4">About<i class="material-icons right">close</i></span>
            <p class="red-text">Welcome to Moviez. Moviez it is a place where you go to put reviews or a page about the movie they have watch. To say how good or bad the movie is. Or other people would read upon or the rating of the movie before the they actually watch the movie.The web has a variety of categories to Action to Sci-fi. And this page is critic free, this all based off of all the fans</p>
        </div>
    </div>
</div>
<div id="howItWorks" class="row">
    <div class="col s12 m5 right">
        <div class="card-panel red">
            <h3 class="white-text">How It Works</h3>
          <span class="white-text">This is how the moviez works. After you are done with the movie you have watch, you can go make a page of the Moviez then put it a category, than in a rating (G or R) of movie, and how good it is. This is all depending on you how good it is.
          </span>
        </div>
    </div>
</div>
    <h4 class="center red-text">Who see the page?</h4>
<div id="account-user">
    <h5 class="red-text left">account user</h5>
    <span>

    </span>
</div>
<div id="non-account">
    <h5 class="red-text right">non-accout user</h5>
</div>






<?php
require_once ('footer.php');
?>

</body>
