<?php
    require_once('startsession.php');
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
            <p class="red-text">Welcome to Moviez. Moviez is a place where you go to put reviews or a page about the movie you have watched. You can share how good or bad you thought the movie was and then other people can read it. This allows for them to see the rating and read a bit on the movie before watching it. This website has a wide variety of catergories that range from Action to Sci-Fi. This site is major critic free and is all based off the common people and the fans.</p>
        </div>
    </div>
</div>
<div id="howItWorks" class="row">
    <div class="col s12 m5 right">
        <div class="card-panel red">
            <h3 class="white-text">How It Works</h3>
          <span class="white-text">This is how the MovieZ site works: After you are done with the movie you were watching, you can go create a page on the MovieZ site then put it a category, then choose a rating (G to R) of the movie, and how good it was. It is all depending on you how good it is scored.
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
