<?php
?>

<?php
require_once ('header.php');
?>
<style>
    #pic1{
        width: 35em;
        left: 4em;
        margin-top: 5em;
    }
    #howItWorks{
        width: 90em;
        right: 20em;
        margin-top: -20em;
        margin-bottom: 8em;
    }
</style>

<body>

<div class="row">
    <div id="pic1" class="card">
        <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="moviez.png">
        </div>
        <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">About<i class="material-icons right">more_vert</i></span>
        </div>
        <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">About<i class="material-icons right">close</i></span>
            <p></p>
        </div>
    </div>
</div>

<div id="howItWorks" class="row">
    <div class="col s12 m5 right">
        <div class="card-panel red">
            <h3 class="white-text">How It Works</h3>
          <span class="white-text">I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
          </span>
        </div>
    </div>
</div>

<?php
require_once ('footer.php');
?>


</body>
