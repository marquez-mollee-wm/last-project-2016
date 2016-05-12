<<?php
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
    #card1{
        width: 70em;
    }
    #card2{
        width: 70em;
        margin-top: -90em;
        margin-bottom: 15em;
    }
    #card3{
        width: 70em;
        margin-top: -90em;
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
          <span class="white-text">This is how the MovieZ site works: After you are done with the movie you were watching, you can go create a page on the MovieZ site then put it a category, then choose a rating (0 to 100) of the movie, and how good it was. It is all depending on you how good it is scored.
          </span>
        </div>
    </div>
</div>
<h5 class="red-text center">~ Who can see the page? ~</h5>

<div id="card1" class="row">
    <div class="col s12 m5 center left">
        <div class="card-panel red">
            <h5 class="white-text">Moviez famliy</h5>
            <span class="white-text">
                blarg blagr blarg blarg blarg
            </span>
        </div>
    </div>
</div>
<div id="card2" class="row">
    <div class="col s12 m5 center center">
        <div class="card-panel red">
            <h5 class="white-text">The community</h5>
            <span class="white-text">
                blarg blarg blarg blarg blarg blarg blarg
            </span>
        </div>
    </div>
</div>
<div id="card3" class="row">
    <div class="col s12 m5 center right">
        <div class="card-panel red">
            <h5 class="white-text">The over looker</h5>
            <span class="white-text">
                blarg blarg blarg blarg blarg blarg blarg blarg
            </span>
        </div>
    </div>
</div>

<?php
require_once ('footer.php');
?>

</body>
