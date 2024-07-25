<?php
// Initialize the session
session_start();
 

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://www.paypal.com/sdk/js?client-id=AUqTosBDN7fssA8iuojHCbsH0agTHYY8Y0k7y7EcDrFBnIcNu3aefdZcocvN3wktOEgA5dcoDDEYW90B"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <title>Rules</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

</head>
<body>
<div class="page-header">
    <h1 style="text-align: center;">Rules & Agreement</h1>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
      <h3>Overview</h3>
      <p><i>Senior Assassin</i> is a Great Valley senior tradition where students must eliminate each other with water-based warfare until only one remains.
    At the start of the game, every player is assigned a random target out of all of the players. In order to advance in the game, each player must get a substantial amount of water on their target,
     eliminating them. Once a player eliminates someone, they inherit their target's target, and the cycle continues until the last one standing. To prevent inactivity and control the pace of the game, 
     players are required to eliminate a certain amount of targets before certain "due dates". Failure to do this results in elimination. The final winner (or winners) recieves the total prize pool.
    </p>
    <h3>Joining the Game</h3>
    <p>In order to participate in <i>Senior Assassin</i>, you must do these three things:</p>
    <ul>
        <li>Sign-up on this website with <i>correct information</i></li>
        <li>Check the box at the end of this page that confirms you agree to the Rules and Conditions</li>
        <li>Submit the $5 participation fee to the gamekeepers (more information on the <i>Payment</i> page)</li>
    </ul>
    <p>The main page of the website will tell you whether or not you are confirmed to participate.</p>
    <h3>Confirming an Assassination</h3>
    <p>In order for you assassination to count, it must be confirmed. This can be done through the website. The assassin can hit the "I've assassinated my target" button, and the target and hit the 
        "I've been assassinated" button. Once both are buttons are hit, the assassination is confirmed: the assassin will recieve the target's target, and the target will be eliminated from the game.
        We also kindly ask that you DM a picture of you and your target together (6 feet apart and wearing masks preferably) so we can post about your assassination on the Instagram page. Should there be
        any disagreements between the assassin and target, a DM to the Instagram page involving details about the conflict should be made, and a Gamekeeper will find a resolution. Therefore, we recommened that you
        take some kind of video/picture evidence of your kill to remove any potential conflicts.</p>
    <h3>Rules</h3>
    <h4>Attacking</h4>
    <ul>
        <li>Any method of attack must <i>only</i> user water</li>
        <li>The target must be shot above the ankle with any source of water (water gun, balloon, snowballs, hoses, buckets- must be a substantial amount of water [visible wet spot on the article of clothing])</li>
        <li>Spitting on your target does not count</li>
        <li>You are not allowed to physically hold down your target or throw them into water sources (pools, lakes, etc.)</li>
        <li>The water must hit the target or any piece of the target’s clothing- any bag counts as a hit. You cannot wear “shields” that cover most of your body (something attached to body and covering all of body)</li>
        <li>If the attacker is shot with water by the target, the attacker is stunned for 5 minutes and is not allowed to attack in that period of time. However you may not try to re-stun someone in that amount of time. For example, if the assassin has been stunned for 5 min you cannot shoot them again to make it 10 minutes.</li>
        <li>If the target is <i>completely</i> naked [no clothing at all], they will be immune to any attack. (Please don't do this if you're in public)</li>
        <li>You may get help with your assassination. However the helpers must not make physical contact with the target and the attack must be made by the assassin</li>
        <li>ABSOLUTELY NO WATER GUNS RESEMBLING ANY REAL WEAPONS MAY BE USED (painted black, etc). USING A WATER GUN THAT RESEMBLES A REAL GUN RESULTS IN IMMEDIATE DISQUALIFICATION.</li>
    </ul>
    <h5>Off-Limits</h5>
    <ul>
        <li>Inside schools</li>
        <li>Outside schools (campus, parking lot, courtyard, sports fields, etc.)</li>
        <li>In or directly nearby places of worship</li>
        <li>In or directly nearby medical facilities</li>
        <li>Inside any business</li>
        <li>Wegman's or Target parking lot</li>
    </ul>
    <h5>Restrictions</h5>
    <ul>
        <li>You <i>must</i> follow all local, state, and federal laws.</li>
        <li>You are solely responsible for any legal issues that you may incur as a result of your actions in this game.</li>
        <li>You cannot assassinate someone while they are walking <i>to</i> work, however you may assassinate someone as they are walking <i>from</i> work.</li>
        <li>You cannot assassinate or be assassinated while in any vehicle with the engine on. Attempting to assassinate while in a moving vehicle results in immediate disqualification.</li>
        <li>You may only enter someone's home if you are allowed in by a resident. If a resident asks you to leave their property, you must comply.</li>
        <li>Shooting a Gamekeeper results in immediate disqualification</li>
    </ul>
    <h5>Other Notes</h5>
    <ul>
        <li>The game is paused on the day of Senior Prom. No assassination is allowed, and any attempts to assassinate someone on that day results in immediate disqualification. The game resumes at 9AM the day after Senior Prom.</li>
        <li>If there are any instances of someone breaking the rules, please DM the Instagram account to let us know</li>
        <li>The school, or student council, is in no way affiliated with the <i>Senior Assassin</i> game. Don't bring up any issues with the game with administration, they can't and won't do anything about it.</li>
        <li>If you have any concerns, ideas for rules, or questions, please DM the Instagram account, and the Gamekeepers will help you shortly.</li>
    </ul>
    </div>

    <div class="col-md-4">
    </div>
  </div>
</div>

</body>
</html>
